<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Application\Middleware\JwtMiddleware;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Bienvenido a la API de prueba');
        return $response;
    });

    // ruta para autenticación
    $app->post('/login', [AuthController::class, 'login']);

    // creamos la ruta de la api
    $app->group('/api', function (Group $group) {
        // listar usuarios
        $group->get('/listUsers', [UserController::class, 'listUsers']);
        // crear un usuario
        $group->post('/createUser', [UserController::class, 'createUser']);
    })->add(new JwtMiddleware());

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
