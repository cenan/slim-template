<?php
require '../vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => '../templates',
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => '../logs',
        'name_format' => 'y-m-d'
    ))
));

// Prepare view
\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view(new \Slim\Extras\Views\Twig());

$app->notFound(function () use ($app) {
	$app->render('404.twig', [
		'resourceURI' => $app->request()->getResourceUri()
		]);
});

// Define routes
$app->get('/', function () use ($app) {
    $app->render('index.twig');
});

// Run app
$app->run();
