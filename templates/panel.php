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
?>
<!DOCTYPE html>
<html">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assessts/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assessts/css/all.min.css" rel="stylesheet">
        <link href="../assessts/css/style-panel.css" rel="stylesheet">
        <script src="../assessts/js/bootstrap.bundle.min.js"></script>
        <title>Task Manager</title>
    </head>

    <body>

        <div class="header">
            <button class="dark-toggle position-absolute" onclick="toggleDark()">Dark mod 🌓</button>
            <button class="position-absolute exit"><a href="logout.php">Exit 🚪</a></button>

        </div>

        <div class="container">
            <h1>Task Manager</h1>
            <div id="task-list">
                <?php
                for ($i = 0; $i < $num_rows; $i++) {
                    for ($j = 0; $j < 4; $j++) {
                        $out[$i][$j] = $output[$i][$j];
                    } 
                    if($out[$i][3]=="medium"){
                        $border='priority-medium';
                    }else if($out[$i][3]=="high"){
                        $border='priority-high';
                    }else{
                        $border='priority-low';
                    }
                    ?>
                    <div class="task <?php echo $border; ?>">
                        <input status="" type="checkbox" id="task-41cmrn9z6">
                        <label for="task-41cmrn9z6"><?php echo $out[$i][1]; ?></label>
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












        <!-- <div class="modal" id="taskModal">

            <div class="modal-content">
                <h3 style="color:#d63384;text-align:center;">add task</h3>
                <input type="text" id="taskTitle" placeholder="title">
                <select id="taskPriority">
                    <option value="high">important</option>
                    <option value="medium">average</option>
                    <option value="low">unimportant</option>
                </select>
                <button onclick="addTask()">add</button>
            </div>
        </div> -->


        <!-- function addTask() {
                const title = document.getElementById('taskTitle').value;
                const priority = document.getElementById('taskPriority').value;

                if (title.trim() === '') {
                    alert('please enter title task !');
                    return;
                }

                let priorityClass = '';
                if (priority === 'high') priorityClass = 'priority-high';
                else if (priority === 'medium') priorityClass = 'priority-medium';
                else priorityClass = 'priority-low';

                const taskList = document.getElementById('task-list');
                const taskId = 'task-' + Math.random().toString(36).substr(2, 9);
                const taskHTML = `
      <div class="task ${priorityClass}">
        <input type="checkbox" id="${taskId}">
        <label for="${taskId}">${title}</label>
      </div>
    `;
                taskList.insertAdjacentHTML('beforeend', taskHTML);
                document.getElementById('taskTitle').value = '';
                document.getElementById('taskPriority').value = 'high';
                document.getElementById('taskModal').style.display = 'none';
            } -->