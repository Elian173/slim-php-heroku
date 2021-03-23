<?php
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
// require_once './middlewares/Logger.php';

require_once './controllers/UsuarioController.php';


$app = AppFactory::create();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Usuarios
$app->group('/usuarios', function () {
    $this->get('[/]', \UsuarioController::class . ':TraerTodos');
    $this->get('/{usuario}', \UsuarioController::class . ':TraerUno');
    $this->post('[/]', \UsuarioController::class . ':CargarUno');
  });

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;

});

$app->run();
