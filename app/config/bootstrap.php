<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Griff\Application;

$app['debug'] = true;
error_reporting(E_ALL);

$viewsPaths = glob(__DIR__.'/../views/{,**/}', GLOB_BRACE);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $viewsPaths,
));

