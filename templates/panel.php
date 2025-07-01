<?php
require_once 'loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("location:$base_url/login");
}
$userNumber = $_SESSION['user'];
$conn = db_conn();

if (isset($_POST['sort'])) {
    $sort = $_POST['sort_by'];
    if ($sort == 'recent') {
        $sort = "`create_date` DESC";
    } else if ($sort == 'status_asc') {
        $sort = "`status` ASC";
    } else if ($sort == 'status_desc') {
        $sort = "`status` DESC";
    }
} else {
    $sort = "`create_date` DESC";
}

$check = mysqli_query($conn, "SELECT * FROM `task` WHERE `user_id` = '$userNumber' ORDER BY $sort");
$num_rows = mysqli_num_rows($check);
$output = mysqli_fetch_all($check, MYSQLI_NUM);

$check2 = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_id` = '$userNumber'");
$num_rows2 = mysqli_num_rows($check2);
$output2 = mysqli_fetch_row($check2);

$darkMode = isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'on';
require_once 'header2.php';
?>
<meta charset="UTF-8">
<title>Task Manager</title>
<style>
    .delete {
        display: none;
    }
</style>
</head>

<body class="<?php if ($darkMode) {
                    echo 'dark-mode';
                } else {
                    echo '';
                } ?>">
    <div class="laye"></div>
    <div class="header">
        <div class="d-flex gap-3">
            <div class="position-relative">
                <button id="mode" status="0">Dark mod 🌓</button>
                <form action="handle.php" method="POST" class="mode position-absolute">
                    <input type="hidden" name="mode" value="toggleDarkMode">
                    <button type="submit" name="darkModeBtn"><?php if ($darkMode) {
                                                                    echo 'light';
                                                                } else {
                                                                    echo 'dark';
                                                                } ?></button>
                </form>
            </div>

            <form method="POST" action="">
                <label for="sort_by" style="color: var(--text-color);">Sort by:</label>
                <select name="sort_by" id="sort_by" class="form-select w-auto d-inline-block">
                    <option value="recent">
                        Recent
                    </option>
                    <option value="status_desc">
                        Completed
                    </option>
                    <option value="status_asc">
                        in Progress
                    </option>
                </select>
                <button type="submit" name="sort">click</button>
            </form>
        </div>
        <h1 class="position-absolute">Task Manager</h1>

        <button class="bars"><i class="fa-solid fa-bars" status="0"></i></button>

        <div class="menu-container position-absolute">
            <ul class="menu d-flex flex-column gap-2">
                <li class="d-flex gap-3">
                    <div id="photo"><img src="<?php echo base_url() . '/uploads/' . $output2['4']; ?>"></div>
                    <p class="m-0 align-content-center"><?php echo $output2['1']; ?></p>
                </li>
                <li>
                    <i class="fas fa-camera me-3"></i><button id="upload">upload a photo</button>
                    <form action="handle.php" method="POST" enctype="multipart/form-data" id="file">
                        <input type="file" name="files" id="files">
                        <button type="submit" name="uploadfile" class="border p-2 up">upload</button>
                    </form>
                </li>
                <li><button onclick="openModal()"><i class="fas fa-plus me-3"></i>add a task</button></li>
                <li><a href="<?php base_url() ?>alltask" class="t-none"><i class="fa-solid fa-quote-right me-2"></i>Show all tasks</a></li>
                <!-- <li><a href="" class="t-none"><i class="fas fa-pen me-2"></i>edit a task</a></li> -->
                <!-- <li><a href="" class="t-none"><i class="fas fa-cog me-2"></i>settings</a></li> -->
                <li></li>
                <li class="exit"><a href="<?php base_url() ?>logout" class="t-none">🚪Sign out</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        <div id="task-list" class="row d-flex justify-content-between">
            <?php
            for ($i = 0; $i < $num_rows; $i++) {
                for ($j = 0; $j < 7; $j++) {
                    $out[$i][$j] = $output[$i][$j];
                }
                $current_datetime = time();
                $task_datetime = $out[$i][6];
                $is_expired = (strtotime($task_datetime) <$current_datetime);
                $bg_time = $is_expired ? '#ff6b6b' : '#2ed573 ';

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
                if ($out[$i][2] == 1) {
                    $checkbox = 'd-block';
                } else {
                    $checkbox = 'd-none';
                }
            ?>
                <div class="task <?php echo $border; ?> col-4">
                    <div class="d-flex" style="width: 100%; height: 87%;">
                        <form action="handle.php" method="POST" style="margin-top: -5px;">
                            <input type="hidden" name="tid" value="<?php echo $out[$i][0]; ?>">
                            <input type="hidden" name="status" value="<?php echo $out[$i][2]; ?>">
                            <button status="<?php echo $out[$i][2]; ?>" type="submit" name="checkbox" id="checkbutton" class="<?php echo $color; ?>"><i class="<?php echo $checkbox; ?> fas fa-check text-primary position-absolute" id="check"></i></button>
                        </form>
                        <label><a class="t-none p-2 <?php echo $color; ?>" href="<?php echo $config['base_url']; ?>/edit?t_id=<?php echo $out[$i][0]; ?>&t_title=<?php echo $out[$i][1]; ?>&t_border=<?php echo $border; ?>"><?php echo $out[$i][1]; ?></a></label>
                        <div class="delete">
                            <a href="<?php echo $config['base_url']; ?>/handle.php?task_id=<?php echo $out[$i][0] ?>" class="cursor-pointer btn">Delete</a>
                        </div>
                        <i class="fas fa-ellipsis-v px-3 py-2 pe-1 cursor-pointer"></i>
                    </div>

                    <p class="w-50 ps-2 py-1 mb-2 rounded-3" style="background-color: <?= $bg_time ?>;color:var(--text-color)">
                        <?= 
                        htmlspecialchars($task_datetime);
                     ?>
                    </p>



                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <button class="add-button" onclick="openModal()">+</button>

    <form action="handle.php" method="post">
        <div class="modal" id="taskModal">
            <div class="modal-content">
                <h3 style="color:#d63384;text-align:center;">add task</h3>
                <input type="text" id="taskTitle" placeholder="title" name="title" required>
                <input type="date" name="date" required>
                <input type="time" name="time" required>
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
                $('.header .mode').fadeOut();

            });
        });
        $(document).ready(function() {
            $('.header button i').click(function() {
                $sw = $(this).attr('status');

                if ($sw == 0) {
                    $(this).attr('status', '1');
                    $('.header .mode').fadeOut();

                    $('.header .bars i').removeClass('fa-bars').addClass('fa-times');
                    $('.header .menu-container').css('display', 'block');
                    $('.laye').css('display', 'block');

                } else {
                    $(this).attr('status', '0');
                    $('.header .bars i').removeClass('fa-times').addClass('fa-bars');
                    $('.header .menu-container').css('display', 'none');
                    $('.laye').css('display', 'none');
                    $('.loow i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    $('.loot i').removeClass('fa-chevron-up').addClass('fa-chevron-down');

                }
            });
            $('.header #upload').click(function() {
                $('.header #file').css('display', 'block');
            });
            $('.header #mode').click(function() {
                $x = $(this).attr('status');

                if ($x == 0) {
                    $(this).attr('status', '1');
                    $('.header .mode').fadeIn();
                } else {
                    $(this).attr('status', '0');
                    $('.header .mode').fadeOut();
                }
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