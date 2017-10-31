<?php

require_once __DIR__.'/../app/bootstrap.php';

use \Symfony\Component\HttpFoundation\Request;

$app->get('/artist/{artistID}/', function (Request $request, $artistID) use ($app) {
    $controller = new Griff\ArtistController($request, $app, $artistID);
    return $controller->index();
});

$app->get('/{route}', function (Request $request, $route) use ($app) {
    $route = explode('/', $route);

    $controller = (!empty($route[0])) ? $route[0] : 'dashboard';
    $controller = ucfirst($controller);
    unset($route[0]);

    $method = (!empty($route[1])) ? $route[1] : 'index';
    unset($route[1]);

    $variables = $route;

    $controller = 'Griff\\'.$controller."Controller";
    $controller = new $controller($request, $app, ...$variables);

    return $controller->$method();
})->assert('route', '(?:.*?\/*)*');

//Dasboard
// $app->get('/', 'Griff\DashboardController::index');

// //Search
// $app->get('/search-results/', 'Griff\SearchController::results');

// //Queue
// $app->get('/queue/add/', 'Griff\QueueController::add');
// $app->get('/queue/clear/', 'Griff\QueueController::clear');
// $app->get('/queue/reset-most-recent/', 'Griff\QueueController::resetMostRecent');

// //Artist
// $app->get('/artist/{artistID}/', 'Griff\ArtistController::index');


$app->run();
