<?php

use Bramus\Router\Router;

$router = new Router();

$router->mount('/api', function () use ($router) {
    $router->get('/packages/{letter}', function ($letter) {
        header('Content-Type: application/json');
        $json = file_get_contents("../.cache/" .$letter. ".json");
        echo $json;
    });

    $router->get('/package/{slug}', function ($slug) {
        header('Content-Type: application/json');
       
        $file = json_decode(file_get_contents("../.cache/" .$slug['0']. ".json"), true);

        $key = array_search($slug, array_column($file, 'name'));
        
        echo json_encode($file[$key]);
    });
});

$router->get('/(.*)', function () {
    require 'views/spa.view.php';
});

$router->run();
