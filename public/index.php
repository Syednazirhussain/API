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

$app->get('/getlocation/{place}', function (Request $request, Response $response) {
   /* return $response->getBody()->write($request->getAttribute('place'));*/

    $address = $request->getAttribute('place');

    $Geocoder = new GoogleMapsGeocoder($address);



    $location = $Geocoder->geocode();

    return $response->withJson($location,200);

});

$app->get('/getlocation/{source}/{destination}', function (Request $request, Response $response) {
    /* return $response->getBody()->write($request->getAttribute('place'));*/

    $source = $request->getAttribute('source');
    $destination = $request->getAttribute('destination');

    $formattedAddrFrom = str_replace(' ','+',$source);
    $formattedAddrTo = str_replace(' ','+',$destination);

    $url='http://maps.googleapis.com/maps/api/directions/json?';
    $url .= 'origin='.urlencode($formattedAddrFrom); //origin from form
    $url .= '&destination='.urlencode($formattedAddrTo).'&waypoints='; //destination from form
    $url.=urlencode('tariq road').','.urlencode('karachi').','.urlencode('pakistan');
    $url.='|';
    $url=substr($url, 0, -1); 
    $url .='&sensor=false';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $directions = curl_exec ($ch);

/*    return $response->getBody()->write($directions);*/

    $array = json_decode($directions,true);
    for ($i = 0 ; $i<count($array['routes'][0]['legs']) ; $i++){
        echo " Direction no.".($i+1)."<br><br><br>";
        for ($j = 0 ; $j<count($array['routes'][0]['legs'][$i]['steps']) ; $j++){
            echo $array['routes'][0]['legs'][0]['steps'][$j]['html_instructions']."<br><br>";
        }
        echo "<br><br>";
    }
});



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
