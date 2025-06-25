<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userNumber = $_SESSION['user'];

if (isset($_GET['t_id']) && isset($_GET['t_title'])) {
    $id = $_GET['t_id'];
    $title = $_GET['t_title'];
    $border = $_GET['t_border'];
    // $data = [
    //     'task_id' => $id,
    //     'title' => $title
    // ];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assessts/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assessts/css/all.min.css" rel="stylesheet">
        <link href="../assessts/css/style-panel.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <script src="../assessts/js/bootstrap.bundle.min.js"></script>
        <title> </title>
        <style>
            form {
                height: 90%;
                width: 90%;
            }

            textarea {
                outline: none;
                border: none;
                background-color: transparent;
                padding: 0 250px 400px 0;
                width: 98%;
            }

            button {
                width: 10%;
                padding: 12px;
                border: none;
                border-radius: 10px;
                background-color: #ff69b4;
                color: #fff;
            }

            select {
                width: 10%;
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 10px;
                border: 1px solid #ccc;
                font-size: 16px;
                margin-right: 20px;
            }
        </style>
    </head>

    <body>
        <form action="task.php" method="POST">

            <div class="task <?php echo $border; ?>">
                <input status="" type="checkbox" id="task-41cmrn9z6">
                <textarea for="task-41cmrn9z6" name="title"><?php echo $title; ?></textarea>
            </div>
                <input type="hidden" name="taskID" value="<?php echo $id; ?>">
            <select id="taskPriority" name="option">
                <option value="high">important</option>
                <option value="medium">average</option>
                <option value="low">unimportant</option>
            </select>
            <button type="submit" name="edit-task">save</button>


        </form>

    </body>

    </html>

<?php
} else {
    header('location: panel.php');
}
?>