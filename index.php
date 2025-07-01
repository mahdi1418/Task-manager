<?php
session_start();
require_once 'loader.php';
$request = $_REQUEST['q'];

$requests = explode('/', $request);

$first = $requests[0];

$routes = [
    '' => 'templates/register.php',
    'register' => 'templates/register.php',
    'login' => 'templates/login.php',
    'panel' => 'templates/panel.php',
    'logout' => 'templates/logout.php',
    'edit' => 'templates/edit-task.php',
    'alltask' => 'templates/show-alltask.php'
];

if (isset($routes[$first])) {
    require_once $routes[$first];
} else {
    header('location:register');
}
if ($routes[$first] === 'panel' && !isset($_SESSION['user_id'])) {
    header("Location$baseurl/login");
    exit();
}

