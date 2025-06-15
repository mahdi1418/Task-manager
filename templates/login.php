<?php
require_once '../loader.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    header('location: panel.php');
}
?>
<!DOCTYPEhtml>
    <html>

        <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../assessts/css/bootstrap.min.css" rel="stylesheet">
      <link href="../assessts/css/all.min.css" rel="stylesheet">
      <link href="../assessts/css/style.css" rel="stylesheet">
      <script src="../assessts/js/bootstrap.bundle.min.js"></script>
            <title> Login </title>
        </head>

        <body>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mx-3" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($success)):  ?>
                <div class="alert alert-success mx-3" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
            <div class="container" id="form-container">
                <h2>Login</h2>
                <form action="../handle.php" method="POST">
                    <input type="email" placeholder="email" name="email" required>
                    <input type="password" placeholder="password" name="password" required>
                    <input type="hidden" name="type" value="login">
                    <button type="submit" name="submit">Login</button>
                </form>
                <div class="switch">
                    Don't have an account? <a href="../index.php">Register here</a>
                </div>
            </div>
            <?php
            require_once "footer.php";
            ?>