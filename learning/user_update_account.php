<?php
    session_start();

    $user_id = $_SESSION["user_id"];
    $f_name = filter_input(INPUT_POST, "f_name");
    $l_name = filter_input(INPUT_POST, "l_name");

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");
    $update_account_query = "UPDATE users SET f_name='${f_name}', l_name='${l_name}' WHERE ID='${user_id}';";
    mysqli_query($connection, $update_account_query) or die(mysqli_error($connection));

    if(mysqli_errno($connection) == 0) {
        $_SESSION["f_name"] = $f_name;
        $_SESSION["l_name"] = $l_name;

        header("Location: account_manage.php?details_updated=true");
    } else {
        header("Location: account_manage.php?details_updated=false");
    }