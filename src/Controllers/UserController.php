<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use GuzzleHttp\Client;

class UserController {

    public function listUsers(Request $request, Response $response): Response {
        $client = new Client();
        $apiResponse = $client->request('GET', 'https://67cfeffb823da0212a83e2b1.mockapi.io/api/v1/users');
        $data = $apiResponse->getBody()->getContents();

        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createUser(Request $request, Response $response): Response {
        $body = $request->getParsedBody();
        $client = new Client();
        $apiResponse = $client->request('POST', 'https://67cfeffb823da0212a83e2b1.mockapi.io/api/v1/users', [
            'json' => $body
        ]);
        $data = $apiResponse->getBody()->getContents();

        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }

}
