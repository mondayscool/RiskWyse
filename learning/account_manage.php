<?php
    session_start();

    include('auth_check.php');
    include('../global.php');

    $details_updated = filter_input(INPUT_GET, "details_updated");
    $password_updated = filter_input(INPUT_GET, "password_updated");

    $warnings = "";

    if(isset($_GET["details_updated"])) {
        if ($details_updated === "true") {
            $warnings .= "<div class='alert alert-success alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Details updated successfully.</div>";
        } else {
            $warnings .= "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Something went wrong, please try again.</div>";
        }
    }

    if(isset($_GET["password_updated"])) {
        if($password_updated === "true") {
            $warnings .= "<div class='alert alert-success alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Password updated successfully.</div>";
        } else {
            $warnings .= "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Password update failed.</div>";
        }
    }s
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
            <a class="btn btn-secondary" href="user_dashboard.php"><< Back</a>

            <?php echo $warnings; ?>

            <h3>Manage Account</h3>

            <form action="user_update_account.php" method="POST">
                <div class="mb-3">
                    <label for="f_name" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="f_name" value="<?php echo $_SESSION["f_name"]; ?>" name="f_name">
                </div>
                <div class="mb-3">
                    <label for="l_name" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="l_name" value="<?php echo $_SESSION["l_name"]; ?>" name="l_name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <h3>Manage Subscriptions</h3>

            <h3>Change Password</h3>

            <form action="user_change_password.php" method="POST">
                <div class="mb-3">
                    <label for="old_password" class="form-label">Old Password:</label>
                    <input type="password" class="form-control" id="old_password" placeholder="Enter old password" name="old_password">
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password">
                </div>
                <div class="mb-3">
                    <label for="new_password_confirm" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="new_password_confirm" placeholder="Confirm new password" name="new_password_confirm">
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </body>
</html>