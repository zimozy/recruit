<?php

function BasicRoute(\Slim\App $app, String $page) {
    $app->get($page, function ($request, $response) {
        return $this->view->render($response, $page . '.twig');
    })->setName($page);
}

//MAIN GROUP
$app->group('/', function () {

    //HOME
    BasicRoute($this, 'home');

    //JS/CSS MINIFIER
    $this->get('minify/f=', function ($request, $response) {
        return $response; //necessary?
    })->setName('minify');

});

//APPLY GROUP
$app->group('/apply', function () {

    $this->get('/{applicationId}', function ($req, $res, $args) {
        $args['position'] = 'Android Developer';
        $args['rate'] = '40.00';

        $this->view->render($res, 'apply.twig', $args);
    })->setName('apply');

    $this->post('/{applicationId}', function($req, $res, $args) {
        //
    });

});