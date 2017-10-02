<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['determineRouteBeforeAppMiddleware'] = true;

$app = new \Slim\App(["settings" => $config]);


/* Asking application to use DIC dependency injection container */
$container = $app->getContainer();

/* Setting up mono logger using DIC logger */
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

/*$app->add( new authmiddleware());*/

$app->get('/courses', function (Request $request, Response $response) {
    $customer = new customer();
    $data = $customer->getAllSubject();
    return $response->withJson($data,200);
});

$app->get('/question', function (Request $request, Response $response) {
    $customer = new customer();
    $data = $customer->getAllQuestions();
    return $response->withJson($data,200);
});

$app->get('/answer/{question_id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('question_id');
    $customer = new customer();
    $data = $customer->getAnswer_By_QuestionId($id);

    return $response->withJson($data,200);
});

$app->get('/answer/{question_id}/{answer_id}', function (Request $request, Response $response) {
    $qid = $request->getAttribute('question_id');
    $aid = $request->getAttribute('answer_id');
    $customer = new customer();
    $data = $customer->getAnswerStatus($qid,$aid);
    if (empty($data['result'])){
        return $response->getBody()->write('Try Again');
    }else{
       return $response->withJson($data,200);
    }
});


$app->run();
