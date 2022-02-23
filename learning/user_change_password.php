<?php
    session_start();

    $user_id = $_SESSION["user_id"];
    $old_password = filter_input(INPUT_POST, "old_password");
    $new_password = filter_input(INPUT_POST, "new_password");

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");
    $check_password_query = "SELECT * FROM users WHERE ID=${user_id} AND password=SHA1('${old_password}');";
    $check_password_result = mysqli_query($connection, $check_password_query) or die(mysqli_error($connection));

    if(mysqli_num_rows($check_password_result) == 1) {
        $change_password_query = "UPDATE users SET password=SHA1('${new_password}') WHERE ID=${user_id};";
        mysqli_query($connection, $change_password_query) or die(mysqli_error($connection));
        header("Location: account_manage.php?password_updated=true");
    } else {
        header("Location: account_manage.php?password_updated=false");
    }