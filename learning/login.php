<?php
    include('../global.php');

    $flagged = filter_input(INPUT_GET, "flag");
    $acc_created = filter_input(INPUT_GET, 'acc_created');

    $warnings = "";
    if($flagged) {
        $warnings .= "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>You must be logged in to view this feature.</div>";
    }

    if($acc_created) {
        $warnings .= "<div class='alert alert-success alert-dismissible fade show'><button type='button' class='btn-close' data-bs-dismiss='alert'></button>Account created! Please log in below.</div>";
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

        <div class="container w-50 mt-4 mb-4">

            <?php echo $warnings; ?>

            <form action="user_auth.php" method="POST">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            Don't have an account? <a href="create_account.php">Create one</a>.

        </div>
    </body>
</html>