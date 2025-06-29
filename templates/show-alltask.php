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
$darkMode = isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] ==='on';

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
        <title> </title>
        <style>
            .delete {
                display: none;
            }
            .task{
                width: 95% !important;
            }
            .container{
                width: 1200px !important;
            }
            .text-dark{
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

    <body class="<?php if($darkMode){
        echo 'dark-mode';
    }else{
        echo '';
    } ?>">
    <a href="panel.php" class="t-none text-dark">🚪Exit</a>

        <div id="task-list" class="container m-0">
                <h1>All Tasks</h1>
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