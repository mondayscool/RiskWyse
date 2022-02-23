<?php
    session_start();

    $email = filter_input(INPUT_POST, 'email');
    $pwd = filter_input(INPUT_POST, 'password');

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");
    $auth_query = "SELECT * FROM users WHERE email='${email}' AND password=SHA1('${pwd}');";

    $auth_result = mysqli_query($connection, $auth_query) or die(mysqli_error($connection));

    $auth_result_array = mysqli_fetch_array($auth_result);

    $_SESSION["user_id"] = $auth_result_array["ID"];
    $_SESSION["email"] = $email;
    $_SESSION["f_name"] = $auth_result_array["f_name"];
    $_SESSION["l_name"] = $auth_result_array["l_name"];

    if(mysqli_num_rows($auth_result) == 1) {
        header('Location: user_dashboard.php');
    } else {
        header('Location: login.php?failed_login=true');
    }

