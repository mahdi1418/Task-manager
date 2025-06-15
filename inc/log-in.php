<?php

require_once 'loader.php';

$email = $_POST['email'];
$password = $_POST['password'];
$conn = db_connection();

$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
$check = db_select_one($sql);
// $check = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'");
$output = mysqli_fetch_row($check);
if (!$check || !mysqli_num_rows($check) > 0) {
    $error = 'Invalid email or password.';
    require_once 'templates/login.php';
}

$new_password = md5($password);

if ($new_password == $output[3]) {
    $success = 'Login successful.';
    session_start();
    $_SESSION['user'] = $output[0];

    require_once 'index.php';
    header("refresh:3;url=templates/panel.php");
    exit;
} else {
    $error = 'Invalid email or password.';
    require_once 'templates/login.php';
    exit;
}
