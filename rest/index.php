<?php
require 'Slim/Slim.php';
require_once 'dbconn.php';
//require_once 'user.php';
require_once 'tags.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->setName('kmsim');
/*
$app->get('/users', 'getUsers');
$app->get('/users/:id', 'getUser');
$app->get('/users/search/:query', 'findByName');
$app->post('/users', 'addUser'); 
$app->put('/users/:id', 'updateUser'); 
$app->delete('/users/:id', 'deleteUser'); 
*/
$app->get('/tag/:id', 'getTag');
$app->get('/tagsByTipo/:query','tagsByTipo');
$app->get('/tagsSearch/:query/:tipo','tagsSearch');
$app->post('/tag', 'addTag'); 
$app->delete('/tag/:id', 'deleteTag'); 

$app->run();
?>