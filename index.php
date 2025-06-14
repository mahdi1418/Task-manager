<?php
require_once 'loader.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user'])) {
  header('location: templates/panel.php');
}

?>
<!DOCTYPEhtml>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="assessts/css/bootstrap.min.css" rel="stylesheet">
      <link href="assessts/css/all.min.css" rel="stylesheet">
      <link href="assessts/css/style.css" rel="stylesheet">
      <script src="assessts/js/bootstrap.bundle.min.js"></script>
      <title> Register </title>
      <style>    body {
        background-color: #ffe6eb;
        font-family: 'Segoe UI', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff0f5;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        width: 450px;
        text-align: center;
    }

    h2 {
        color: #d63384;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #f5c2c7;
        border-radius: 10px;
        outline: none;
        font-size: 16px;
        background-color: #fffafc;
    }

    button {
        background-color: #ff69b4;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: 0.3s;
    }

    button:hover {
        background-color: #ff4da6;
    }

    .switch {
        margin-top: 15px;
        font-size: 14px;
    }

    .switch a {
        color: #d63384;
        text-decoration: none;
        font-weight: bold;
    }</style>
    </head>

    <body>

      <div class="container" id="form-container">
        <h2>Register</h2>
        <form action="inc/handle.php" method="POSt">
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