<?php

namespace App\Application\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Exception\HttpUnauthorizedException;

class JwtMiddleware {
    public function __invoke(Request $request, RequestHandler $handler): Response {
        $headers = $request->getHeader('Authorization');

        if (!$headers || empty($headers[0])) {
            throw new HttpUnauthorizedException($request, "Token no proporcionado");
        }

        $token = str_replace('Bearer ', '', $headers[0]);

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            $request = $request->withAttribute('user', $decoded);
        } catch (\Exception $e) {
            throw new HttpUnauthorizedException($request, "Token inválido o expirado");
        }

        return $handler->handle($request);
    }
}
