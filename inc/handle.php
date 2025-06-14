<?php

if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    if ($type == 'register') {
        require_once 'register.php';
    } else if ($type == 'login') {
        require_once 'login.php';
    } else {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}

?>