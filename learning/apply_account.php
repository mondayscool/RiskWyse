<?php
    $f_name = filter_input(INPUT_POST, "f_name");
    $l_name = filter_input(INPUT_POST, "l_name");
    $email = filter_input(INPUT_POST, "email");
    $pwd = filter_input(INPUT_POST, "password");

    $connection = mysqli_connect("69.172.204.200", "mondaysc_riskwyse_user", "Spaceballs1!", "mondaysc_riskwyse");

    //check if the account exists
    $account_check_query = "SELECT * FROM users WHERE email='${email}';";
    $account_check_result = mysqli_query($connection, $account_check_query) or die(mysqli_error($connection));

    if(mysqli_num_rows($account_check_result) != 0) {
        header('Location: create_account.php?acc_exists=true');
    } else {
        $create_account_query = "INSERT INTO users(f_name, l_name, email, password) values('${f_name}', '${l_name}', '${email}', SHA1('${pwd}'));";
        $create_account_result = mysqli_query($connection, $create_account_query) or die(mysqli_error($connection));

        header('Location: login.php?acc_created=true');
    }
