<?php require_once "header.php";
require_once "loader.php";
if (isset($_SESSION['user'])) {
    header("location:$base_url/panel");
    exit;
}
?>

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
        <h2>Login</h2>
        <form action="handle.php" method="POST">
            <input type="email" placeholder="email" name="email" required>
            <input type="password" placeholder="password" name="password" required>
            <input type="hidden" name="type" value="login">
            <button type="submit" name="submit">Login</button>
        </form>
        <div class="switch">
            don't have an account?<a href="<?php base_url() ?>register">register here</a>
        </div>
    </div>
    </form>
    </div>
    </div>
    <?php require_once "footer.php";
