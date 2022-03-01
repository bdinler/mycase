<?php

use App\Controller\FeedController;
use App\Core\Application;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->router->get('/feed/{class}/{type}', [FeedController::class, 'feedBuild']);

$app->run();
