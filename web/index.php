<?php

require_once __DIR__.'/../app/config/bootstrap.php';

$app->get('/', 'Griff\DashboardController::index');
$app->get('/search-results/', 'Griff\SearchController::results');

$app->run();
