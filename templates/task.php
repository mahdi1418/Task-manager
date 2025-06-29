<?php
require_once '../loader.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$conn = db_connection();

$userNumber = $_SESSION['user'];
if (isset($_POST['submit-task'])) {
    $title = $_POST['title'];
    $option = $_POST['option'];
    $data = [
        'title' => $title,
        'option' => $option,
        'user_id' => $userNumber
    ];
    $insert = db_insert('task', $data);
    if ($insert) {
        $success = 'Added task successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'Added task failed. Please try again.';
        require_once 'panel.php';
        exit;
    }

}else if(isset($_POST['edit-task'])){
    $updatetitle = $_POST['title'];
    $updateoption = $_POST['option'];
    $id = $_POST['taskID'];
    
    $update = mysqli_query($conn, "UPDATE `task` SET `title`= '$updatetitle', `option`='$updateoption' WHERE `task`.`task_id` = '$id'");
    header('location: panel.php');

}else if(isset($_GET['n_id']) && !empty($_GET['n_id'])){
    $id = $_GET['n_id'];
    mysqli_query($conn,"DELETE FROM `task` WHERE `task`.`task_id` = '$id'");
    header('location: panel.php');
}else if(isset($_POST['uploadfile'])) {
        $tempFile = $_FILES['files']['tmp_name'];
        $folder = '../uploads/';
        $new_name = 'file_' . time() . '.png';
        $status = move_uploaded_file($tempFile, $folder . $new_name);

        
    $update = mysqli_query($conn, "UPDATE `users` SET `file`= '$new_name' WHERE `users`.`user_id` = '$userNumber'");
        if ($update) {
        $success = 'Added photo successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'Added photo failed. Please try again.';
        require_once 'panel.php';
        exit;
    }
}else if(isset($_POST['mode']) && $_POST['mode'] === 'toggleDarkMode') {
    if(isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'on'){
        $newMode = 'off';
    }else{
        $newMode = 'on';
    }
    setcookie('darkMode', $newMode, time() + 86400,'/');

    header('location: panel.php');
    exit;
}else {
    header('location: panel.php');
}
