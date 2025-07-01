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
$check = mysqli_query($conn, "SELECT * FROM `task` WHERE `user_id` = '$userNumber'");
$num_rows = mysqli_num_rows($check);
$output = mysqli_fetch_all($check, MYSQLI_NUM);
$darkMode = isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'on';

?>
<!DOCTYPE html>
<html">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url(); ?>/assessts/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/assessts/css/all.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>/assessts/css/style-panel.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>/assessts/js/jquery-3.7.1.min.js"></script>
        <script src="<?php echo base_url(); ?>/assessts/js/bootstrap.bundle.min.js"></script>
        <title> </title>
        <style>
            .delete {
                display: none;
            }

            .task {
                width: 95% !important;

            }

            .container {
                width: 1200px !important;
            }

            .text-dark {
                position: absolute;
                right: 50px;
                top: 50px;
                background-color: var(--container-bg);
                color: var(--text-color) !important;
                border-radius: 20px;
                padding: 10px;
            }
        </style>
    </head>

    <body class="<?php if ($darkMode) {
                        echo 'dark-mode';
                    } else {
                        echo '';
                    } ?>">

        <div id="task-list" class="container m-0 pt-4">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="m-0 mt-3">All Tasks</h1>
                <a href="panel.php" class="btn btn-outline-secondary">
                    <i class="fas fa-door-open me-2"></i>exit
                </a>
            </div>
            <?php
            for ($i = 0; $i < $num_rows; $i++) {
                for ($j = 0; $j < 7; $j++) {
                    $out[$i][$j] = $output[$i][$j];
                }
                $current_datetime = time();
                $task_datetime = $out[$i][6];
                $is_expired = (strtotime($task_datetime) < $current_datetime);
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
                <div class="task <?php echo $border; ?>">
                    <div class="d-flex" style="width: 100%; height: 87%;">

                        <form action="handle.php" method="POST" style="margin-top: -5px;">
                            <input type="hidden" name="tid" value="<?php echo $out[$i][0]; ?>">
                            <input type="hidden" name="status" value="<?php echo $out[$i][2]; ?>">
                            <button status="<?php echo $out[$i][2]; ?>" type="submit" name="checkbox2" id="checkbutton" class="<?php echo $color; ?>"><i class="<?php echo $checkbox; ?> fas fa-check text-primary position-absolute" id="check"></i></button>
                        </form>
                        <label><a class="t-none p-2 <?php echo $color; ?>" href="<?php echo $config['base_url']; ?>/edit?t_id=<?php echo $out[$i][0]; ?>&t_title=<?php echo $out[$i][1]; ?>&t_border=<?php echo $border; ?>"><?php echo $out[$i][1]; ?></a></label>
                        <div class="delete">
                            <a href="<?php echo $config['base_url']; ?>/handle.php?task_id=<?php echo $out[$i][0] ?>" class="cursor-pointer btn">Delete</a>
                        </div>
                        <i class="fas fa-ellipsis-v px-3 py-2 mt-2 pe-1 cursor-pointer"></i>
                    </div>
                    <p class="ps-2 py-1 mb-2 rounded-3" style="width: 17%; background-color: <?= $bg_time ?>;color:var(--text-color)">
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
        <script>
            $(document).ready(function() {
                $('.fa-ellipsis-v').click(function() {
                    $(this).siblings('div').fadeToggle(300);
                });
            });
        </script>

        <?php
        require_once "footer.php";

        ?>