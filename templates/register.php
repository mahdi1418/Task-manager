<?php
if (isset($_SESSION['user'])) {
    header("location:$base_url/panel");
    exit;
}
require_once "header.php";
require_once "loader.php"; ?>
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
            already have an account?<a href="<?php base_url() ?>login">Login here</a>
            </form>
        </div>
    </div>
    <?php require_once "footer.php";
