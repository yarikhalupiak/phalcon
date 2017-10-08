<?php

$router = $di->getRouter();

$route = $router->add(
    "user/edit/{id}",
    [
        "controller" => "user",
        "action"     => "edit",
    ]
)->setName('user-edit');

$route = $router->add(
    "user/create",
    [
        "controller" => "user",
        "action"     => "create",
    ]
)->setName('user-create');

$router->handle();
