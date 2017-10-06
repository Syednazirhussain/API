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

    // get complete location in array
/*    echo "<pre>";
    echo print_r($location);die();*/


    // precise location
    echo "Precise Location :  <b>".$location['results'][0]['formatted_address']."</b><br>";
    // get latitute and longitude
    echo "Latitude : <b>".$location['results'][0]['geometry']['location']['lat']."</b><br>";
    echo "Longitude : <b>".$location['results'][0]['geometry']['location']['lng']."</b><br><br><br>";


    // get address component

    $html = "<table border=\"1\">";
    $html .= "<thead>";
    $html .= "<td>LONG NAME</td>";
    $html .= "<td>SHORT NAME</td>";
    $html .= "<td>TYPE</td>";
    $html .= "</thead>";
    for ($i = 0 ; $i<count($location['results'][0]['address_components']) ; $i++){
        $html .= "<tr>";
        $html .= "<td>".$location['results'][0]['address_components'][$i]['long_name']."</td>>";
        $html .= "<td>".$location['results'][0]['address_components'][$i]['short_name']."</td>>";
        $html .= "<td>";
        for ($j = 0 ; $j<count($location['results'][0]['address_components'][$i]['types']) ; $j++){
            ($j < count($location['results'][0]['address_components'][$i]['types'])-1 )? $html .= $location['results'][0]['address_components'][$i]['types'][$j]."<b>&nbsp;/&nbsp;</b>" : $html .= $location['results'][0]['address_components'][$i]['types'][$j];
        }
        $html .= "</td>";
        $html .= "</tr>";
    }

    echo $html;

    // for get complete information in json array
/*    return $response->withJson($location,200);*/

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
        echo "<h1>Direction no.".($i+1)."</h1><br>&nbsp;&nbsp;&nbsp;<code>Steps</code><br><ol>";
        for ($j = 0 ; $j<count($array['routes'][0]['legs'][$i]['steps']) ; $j++){
            echo "<li>".$array['routes'][0]['legs'][0]['steps'][$j]['html_instructions']."</li><br><br>";
        }
        echo "</ol><br><br>";
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
