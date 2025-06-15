<?php
require_once '../loader.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userNumber = $_SESSION['user'];

if (isset($_POST['submit-task'])) {
    $title = $_POST['title'];
    $option = $_POST['option'];
$conn = db_connection();
$data=[
    'title' => $title,
    'option' => $option,
    'user_id' => $userNumber
];
    $insert = db_insert('task',$data);
    // $insert = mysqli_query($conn, "INSERT INTO `task` (`title`,`option`,`user_id`) VALUES ('$title','$option','$userNumber')");
        if ($insert) {
        $success = 'Added task successfully';
        require_once 'panel.php';
        exit;
    } else {
        $error = 'Added task failed. Please try again.';
        require_once 'panel.php';
        exit;
    }
} else {
    header('location: panel.php');
}


// if (isset($_POST['add-update'])) {
//     require_once 'loader.php';
//     $conntentu = $_POST['contentu'];
//     $titleu = $_POST['titleu'];
//     $id = $_POST['noteID'];
//     $update = mysqli_query($connection, "UPDATE `notes` SET `note_title`= '$titleu',`note_content`= '$conntentu' WHERE `notes`.`note_id` = '$id'");
//     if ($update) {
//         $success = 'update text successfully';
//     header('location: panel.php');
//     } else {
//         $error = 'update text failed. Please try again.';
//         header('location: panel.php');
//     }
// }else {
//     header('location: panel.php');
// }