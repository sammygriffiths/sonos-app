<?php

require_once __DIR__.'/../app/config/bootstrap.php';

//Dasboard
$app->get('/', 'Griff\DashboardController::index');

//Search
$app->get('/search-results/', 'Griff\SearchController::results');

//Queue
$app->get('/queue/add/', 'Griff\QueueController::add');
$app->get('/queue/clear/', 'Griff\QueueController::clear');
$app->get('/queue/reset-most-recent/', 'Griff\QueueController::resetMostRecent');

$app->run();
