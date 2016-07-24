<?php

require_once __DIR__.'/../app/config/bootstrap.php';

$app->get('/', 'Griff\DashboardController::index');

$app->run();
