<?php

$router->get('/', 'MainController@index');

$router->get('/main/get-items', 'MainController@getItems');

$router->get('/main/item/:id', 'MainController@getFindItem');

$router->get('/main/user/:id/:email', 'MainController@getUser');

$router->post('/main/item/add', 'MainController@add');

$router->put('/main/item/update', 'MainController@update');