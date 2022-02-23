<?php
    include('../global.php');

    $acc_exists = filter_input(INPUT_GET, 'acc_exists');
    $warnings = "";

    if($acc_exists) {
        $warnings = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>An account already exists for this email address, please try a different email.</div>";
    }
?>
<html>
    <head>
        <title>RiskWyse : Financial Learning</title>
        <link rel="stylesheet" href="<?php if (isset($css_path)) {
            echo $css_path;
        } ?>" />
        <script src="<?php if (isset($js_path)) {
            echo $js_path;
        } ?>"></script>
    </head>

    <body>

        <?php include('navbar.php'); ?>

        <div class="container w-50">
            <a class="btn btn-secondary" href="login.php"><< Back</a>
            <h3>Create Account</h3>

            <?php
                echo $warnings;
            ?>

            <form action="apply_account.php" method="POST">
                <div class="mb-3">
                    <label for="f_name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="f_name" placeholder="First name" name="f_name">
                </div>
                <div class="mb-3">
                    <label for="l_name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="l_name" placeholder="Last name" name="l_name">
                </div>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="password-confirm" placeholder="Confirm password" name="password-confirm">
                </div>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
        </div>
    </body>
</html>
