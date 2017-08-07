<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

// Simple Name Slim Test to check if working - remove for Production 
//$app->get('/hello/{name}', function (Request $request, Response $response) {
 //  $name = $request->getAttribute('name');
 // $response->getBody()->write("Hello, $name");
//  return $response;
//});

//Products and Pricing SRC Routes
require '../src/routes/pricing.php';

$app->run();
 ?>