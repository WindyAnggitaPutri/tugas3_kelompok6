<?php
// routes.php

require_once 'app/controllers/UserController.php';
require_once 'app/controllers/MateriController.php';
require_once 'app/controllers/KursusController.php';

$controllerUser = new UserController();
$controllerMateri = new MateriController();
$controllerKursus = new KursusController();

$url = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// milik kursus
if ($url == '/kursus/halaman_kursus' ) {
    $controllerKursus->halaman_kursus();
} elseif ($url == '/Kursus/index' ) {
    $controllerKursus->index();
}elseif ($url == '/Kursus/index' ) {
    $controllerKursus->home();
} elseif ($url == '/'){
    $controllerKursus ->index(); 
}elseif ($url == '/kursus/halaman_kursus' ) {
    $controllerKursus->simpan();
}elseif ($url == '/kursus/create' && $requestMethod == 'GET') {
    $controllerKursus->create();
} elseif ($url == '/kursus/store' && $requestMethod == 'POST') {
    $controllerKursus->store();
} elseif (preg_match('/\/kursus\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerKursus->edit($userId);
} elseif (preg_match('/\/kursus\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $userId = $matches[1];
    $controllerKursus->update($userId, $_POST);
} elseif (preg_match('/\/kursus\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerKursus->delete($userId);
} elseif ($url == '/materi/halaman_materi' ) {
    $controllerMateri->halaman_materi();
} elseif ($url == '/materi/kursus' ) {
    $controllerMateri->simpan();
}elseif ($url == '/materi/create' && $requestMethod == 'GET') {
    $controllerMateri->create();
} elseif ($url == '/materi/store' && $requestMethod == 'POST') {
    $controllerMateri->store();
} elseif (preg_match('/\/materi\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controllerMateri->edit($materiId);
} elseif (preg_match('/\/materi\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $materiId = $matches[1];
    $controllerMateri->update($materiId, $_POST);
} elseif (preg_match('/\/materi\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $materiId = $matches[1];
    $controllerMateri->delete($materiId);
} elseif ($url == '/user/halaman_user' ) {
    $controllerUser->halaman_user();
} elseif ($url == '/user/kursus' ) {
    $controllerUser->simpan();
}elseif ($url == '/user/create' && $requestMethod == 'GET') {
    $controllerUser->create();
} elseif ($url == '/user/store' && $requestMethod == 'POST') {
    $controllerUser->store();
} elseif (preg_match('/\/user\/edit\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerUser->edit($userId);
} elseif (preg_match('/\/user\/update\/(\d+)/', $url, $matches) && $requestMethod == 'POST') {
    $userId = $matches[1];
    $controllerUser->update($userId, $_POST);
} elseif (preg_match('/\/user\/delete\/(\d+)/', $url, $matches) && $requestMethod == 'GET') {
    $userId = $matches[1];
    $controllerUser->delete($userId);
} else {
    http_response_code(404);
    echo "hihi";
}