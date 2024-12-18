<?php
// routes.php

<<<<<<< HEAD
require_once 'app/controllers/materiController.php';

$controller = new MateriController();
=======
require_once 'app/controllers/UserController.php';

$controller = new UserController();
>>>>>>> 6f134d350850fe2af444b26465d4536909963489
$url = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($url == '/materi/index' || $url == '/') {
    $controller->index();
} elseif ($url == '/materi/create' && $requestMethod == 'GET') {
    $controller->create();
} elseif ($url == '/materi/store' && $requestMethod == 'POST') {
    $controller->store();
} elseif (preg_match('/\/materi\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controller->edit($materiId);
} elseif (preg_match('/\/materi\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $materiId = $matches[1];
    $controller->update($materiId, $_POST);
} elseif (preg_match('/\/materi\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controller->delete($materiId);
} else {
    http_response_code(404);
    echo "hihi";
}