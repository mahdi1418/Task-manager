<?php
require_once 'loader.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user'])) {
  header('location: templates/panel.php');
}

// $request = $_REQUEST['q'];

// $requests = explode('/',$request);

// $first = $requests[0];

// $routes = [
//     'register' => 'index.php',
//     '' => 'index.php',
//     'sign' => 'index.php',
//     'edit' => 'templates/panel.php',
//     'login' => 'templates/login.php'
// ];

// if(isset($routes[$first])){
//     require_once $routes[$first];
// }else{
//     header('location: ');
// }


// require_once 'templates/header.php'
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assessts/css/bootstrap.min.css" rel="stylesheet">
    <link href="assessts/css/all.min.css" rel="stylesheet">
    <link href="assessts/css/style.css" rel="stylesheet">
    <script src="assessts/js/bootstrap.bundle.min.js"></script>
    <title> Register </title>
  </head>
  <body class="row m-0">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger col-10" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)):  ?>
                <div class="alert alert-success col-10" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
    <div class="container" id="form-container">
      <h2>Register</h2>
      <form action="handle.php" method="POST">
        <input type="text" placeholder="name" name="name" required>
        <input type="email" placeholder="email" name="email" required>
        <input type="password" placeholder="password" name="password" required>
        <input type="Password" placeholder="Confirm password" name="confirmPassword" required>
        <input type="hidden" name="type" value="register">
        <button type="submit" name="submit">Register</button>
      </form>
      <div class="switch">
        Already have an account? <a href="templates/login.php">Login here</a>
      </div>
    </div>
    
    <?php

    require_once "templates/footer.php";
    ?>