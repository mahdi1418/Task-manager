<?php
require_once '../loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('location: login.php');
}
$userNumber = $_SESSION['user'];
$conn = db_connection();
$check = mysqli_query($conn, "SELECT * FROM `task` WHERE `user_id` = '$userNumber'");
$num_rows = mysqli_num_rows($check);
$output = mysqli_fetch_all($check, MYSQLI_NUM);

$check2 = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$userNumber'");
$num_rows2 = mysqli_num_rows($check2);
$output2 = mysqli_fetch_row($check2);

?>
<!DOCTYPE html>
<html">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assessts/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assessts/css/all.min.css" rel="stylesheet">
        <link href="../assessts/css/style-panel.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <script src="../assessts/js/jquery-3.7.1.min.js"></script>
        <script src="../assessts/js/bootstrap.bundle.min.js"></script>
        <script src="../assessts/js/main.js"></script>
        <title>Task Manager</title>
        <style>
            .delete {
                display: none;
            }
        </style>
    </head>

    <body>
        <div class="laye"></div>
        <div class="header">
            <button class="" onclick="toggleDark()">Dark mod 🌓</button>
            <button class="bars"><i class="fa-solid fa-bars" status="0"></i></button>

            <div class="menu-container position-absolute">
                <ul class="menu d-flex flex-column gap-2">
                    <li class="d-flex gap-3"><div id="photo"><img src="<?php echo base_url() .'uploads/'.$output2['4']; ?>"></div><p class="m-0 align-content-center"><?php echo $output2['1']; ?></p></li>
                    <li>
                        <i class="fas fa-camera me-3"></i><button id="upload">upload a photo</button>
                        <form action="task.php" method="POST" enctype="multipart/form-data" id="file">
                            <input type="file" name="files">
                            <button type="submit" name="uploadfile" class="border p-2">upload</button>
                        </form>
                </li>
                    <li><i class="fas fa-plus me-3"></i><button onclick="openModal()">add a task</button></li>
                    <li><i class="fa-solid fa-quote-right me-2"></i><a href="show-alltask.php" class="t-none">Show all tasks</a></li>
                    <li><i class="fas fa-pen me-2"></i><a href="" class="t-none">edit a task</a></li>
                    <li></li>
                    <li class="exit"><a href="logout.php" class="t-none">🚪Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <h1>Task Manager</h1>
            <div id="task-list">
                <?php
                for ($i = 0; $i < $num_rows; $i++) {
                    for ($j = 0; $j < 4; $j++) {
                        $out[$i][$j] = $output[$i][$j];
                    }
                    if ($out[$i][3] == "medium") {
                        $border = 'priority-medium';
                        $color = 'color-medium';
                    } else if ($out[$i][3] == "high") {
                        $border = 'priority-high';
                        $color = 'color-high';
                    } else if ($out[$i][3] == "low") {
                        $border = 'priority-low';
                        $color = 'color-low';
                    }
                ?>
                    <div class="task <?php echo $border; ?>">
                        <input status="" type="checkbox">
                        <label><a class="t-none p-2 <?php echo $color; ?>" href="<?php echo $config['base_url']; ?>/templates/edit-task.php?t_id=<?php echo $out[$i][0]; ?>&t_title=<?php echo $out[$i][1]; ?>&t_border=<?php echo $border; ?>"><?php echo $out[$i][1]; ?></a></label>
                        <div class="delete">
                            <a href="<?php echo $config['base_url']; ?>/templates/task.php?n_id=<?php echo $out[$i][0] ?>" class="cursor-pointer btn">Delete</a>
                            <!-- <a href="#"></a> -->
                        </div>
                        <i class="fas fa-ellipsis-v px-3 py-2 mt-2 pe-1 cursor-pointer"></i>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <button class="add-button" onclick="openModal()">+</button>

        <form action="task.php" method="post">
            <div class="modal" id="taskModal">
                <div class="modal-content">
                    <h3 style="color:#d63384;text-align:center;">add task</h3>
                    <input type="text" id="taskTitle" placeholder="title" name="title">
                    <select id="taskPriority" name="option">
                        <option value="high">important</option>
                        <option value="medium">average</option>
                        <option value="low">unimportant</option>
                    </select>
                    <button type="submit" name="submit-task">add</button>
                </div>
            </div>
        </form>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger position-absolute" role="alert" id="alert-box">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)):  ?>
                <div class="alert alert-success position-absolute" role="alert" id="alert-box">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

        <script>
            function toggleDark() {
                document.body.classList.toggle('dark-mode');
            }
            function openModal() {
                document.getElementById('taskModal').style.display = 'flex';
            }
            window.onclick = function(event) {
                if (event.target == document.getElementById('taskModal')) {
                    document.getElementById('taskModal').style.display = 'none';
                }
            }

            $(document).ready(function() {
                $('.fa-ellipsis-v').click(function() {
                    $(this).siblings('div').fadeToggle(300);
                });
            });
            $(document).ready(function() {
                $('.header button i').click(function() {
                    $sw = $(this).attr('status');

                    if ($sw == 0) {
                        $(this).attr('status', '1');

                        $('.header button i').removeClass('fa-bars').addClass('fa-times');
                        $('.header .menu-container').css('display', 'block');
                        $('.laye').css('display', 'block');

                    } else {
                        $(this).attr('status', '0');
                        $('.header button i').removeClass('fa-times').addClass('fa-bars');
                        $('.header .menu-container').css('display', 'none');
                        $('.laye').css('display', 'none');
                        $('.loow i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                        $('.loot i').removeClass('fa-chevron-up').addClass('fa-chevron-down');

                    }
                });
                $('.header #upload').click(function(){
                    $('.header #file').css('display', 'block');
                });
            });

            setTimeout(function() {
                var alertBox = document.getElementById('alert-box');
                if (alertBox) {
                    alertBox.remove();
                }
            }, 5000);
        </script>


        <?php
        require_once "footer.php";

        ?>












 