<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;

class AuthController {
    public function login(Request $request, Response $response): Response {
        $body = $request->getParsedBody();
        $username = $body['username'] ?? '';
        $password = $body['password'] ?? '';

        // simulamos una autenticación
        if ($username !== 'admin' || $password !== '123456') {
            $response->getBody()->write(json_encode(['error' => 'Credenciales inválidas']));
            return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
        }

        // generamos el token JWT
        $payload = [
            'iss' => 'localhost',
            'iat' => time(),
            // que expire en 1 día
            'exp' => time() + 60 * 60 * 24,
            'sub' => $username
        ];

        $token = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');

        $response->getBody()->write(json_encode(['token' => $token]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
