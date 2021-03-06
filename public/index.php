<?php

date_default_timezone_set("America/Los_Angeles");

require '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim([
    'templates.path' => '../app/views',
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter([
        'path' => '../logs',
        'name_format' => 'y-m-d'
    ])
]);

// Prepare view
$view = new \Slim\Views\Twig();
$view->parserOptions = [
    'charset' => 'utf-8',
    'cache' => realpath('../app/views/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
];
$view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
];
$app->view($view);

$app->notFound(function () use ($app) {
    $app->render('404.twig', [
        'resourceURI' => $app->request->getResourceUri()
        ]);
});

// Define routes
$app->get('/', function () use ($app) {
    $app->render('index.twig');
});

// Run app
$app->run();
