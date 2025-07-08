<?php
require_once "loader.php";
$conn = db_conn();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    if ($type === "register") {
        $data = [
            'name' => $_POST['name'],
            'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
            'password' => md5($_POST['password'])
        ];
        $pass2 = md5($_POST['confirmPassword']);
        if (
            empty($data['email']) || empty($data['password']) || empty($pass2)
        ) {
            $error = 'please  fill out all fields';
            require_once "templates/register.php";
            exit;
        }
        if ($data['password'] != $pass2) {
            $error = 'passwords do not match';
            require_once "templates/register.php";
            exit;
        }
        $email = $data['email'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $check_1 = db_select_one($sql);
        if ($check_1) {
            $error = "there is already an account with this email";
            require_once "templates/register.php";
            exit;
        }
        $result = db_insert('users', $data);
        if ($result) {
            $msql = mysqli_query(db_conn(), $sql);
            $user = mysqli_fetch_assoc($msql);
            $_SESSION['user'] = $user['user_id'];
            header("location:$base_url/panel");
            exit;
        } else {
            $error = "something went wrong! please try again later";
            require_once "templates/register.php";
            exit;
        }
    }
    if ($type === "login") {
        $data = [
            'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
            'password' => md5($_POST['password'])
        ];
        if (empty($data['email']) || empty($data['password'])) {
            $error = 'please  fill out all fields';
            require_once "templates/login.php";
            exit;
        }
        $email = $data['email'];
        $pass = $data['password'];
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'";
        $result = db_select($sql);
        if ($result) {
            $msql = mysqli_query(db_conn(), $sql);
            $user = mysqli_fetch_assoc($msql);
            $_SESSION['user'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $success = "you are logged in, going to panel";
            header("location:$base_url/panel");
            exit;
        } else {
            $error = "email or password is wrong!";
            require_once "templates/login.php";
            exit;
        }
    }
} else if (isset($_POST['submit-task'])) {
    $conn = db_conn();
    $userNumber = $_SESSION['user'];
    $title = $_POST['title'];
    $option = $_POST['option'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $due = $date . ' ' . $time . ':00';
    $data = [
        'title' => $title,
        'option' => $option,
        'user_id' => $userNumber,
        'due_datetime' => $due
    ];

    $insert = db_inser3t('task', $data);
    if ($insert) {
        $success = 'Added task successfully';
        header("location:$base_url/panel");
        exit;
    } else {
        $error = 'Added task failed. Please try again.';
        header("location:$base_url/panel");
        exit;
    }
} else if (isset($_POST['edit-task'])) {
    $conn = db_conn();
    $updatetitle = $_POST['title'];
    $updateoption = $_POST['option'];
    $id = $_POST['taskID'];

    $update = mysqli_query($conn, "UPDATE `task` SET `title`= '$updatetitle', `option`='$updateoption' WHERE `task`.`task_id` = '$id'");
    header("location:$base_url/panel");
    exit;
} else if (isset($_GET['task_id']) && !empty($_GET['task_id'])) {
    $conn = db_conn();
    $id = $_GET['task_id'];
    mysqli_query($conn, "DELETE FROM `task` WHERE `task`.`task_id` = '$id'");
    header("location:$base_url/panel");
} else if (isset($_POST['uploadfile'])) {
    $conn = db_conn();
    $userNumber = $_SESSION['user'];
    $tempFile = $_FILES['files']['tmp_name'];
    $folder = 'uploads/';
    $new_name = 'file_' . time() . '.png';
    $status = move_uploaded_file($tempFile, $folder . $new_name);


    $update = mysqli_query($conn, "UPDATE `users` SET `file`= '$new_name' WHERE `users`.`user_id` = '$userNumber'");
    if ($update) {
        $success = 'Added photo successfully';
        header("location:$base_url/panel");
        exit;
    } else {
        $error = 'Added photo failed. Please try again.';
        header("location:$base_url/panel");
        exit;
    }
} else if (isset($_POST['mode']) && $_POST['mode'] === 'toggleDarkMode') {
    if (isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'on') {
        $newMode = 'off';
    } else {
        $newMode = 'on';
    }
    setcookie('darkMode', $newMode, time() + 86400, '/');

    header("location:$base_url/panel");
    exit;
} else if (isset($_POST['checkbox'])) {
    $conn = db_conn();
    $tid = $_POST['tid'];
    $status = $_POST['status'];
    if ($status == 0) {
        $status = 1;
    } else {
        $status = 0;
    }
    $update = mysqli_query($conn, "UPDATE `task` SET `status`= '$status' WHERE `task_id` = '$tid'");
    header("location:$base_url/panel");
    exit;
} else if (isset($_POST['checkbox2'])) {
    $tid = $_POST['tid'];
    $status = $_POST['status'];
    if ($status == 0) {
        $status = 1;
    } else {
        $status = 0;
    }
    $update = mysqli_query($conn, "UPDATE `task` SET `status`= '$status' WHERE `task_id` = '$tid'");

    header("location:$base_url/alltask");
    exit;
}
