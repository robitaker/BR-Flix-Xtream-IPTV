<?php


    $msg = json_decode(json_encode([

        // Errors

        "name_invalid" => "Name can contain a maximum of 60 characters.",
        "email_invalid" => "This email is invalid, please enter a valid email.",
        "username_invalid" => "Username contains illegal characters or is longer than 30 characters.",
        "pass_invalid" => "Password can contain a maximum of 50 characters.",
        "user_already_exists" => "User already exists, create a new one.",
        "pass_user_invalid" => "Incorrect username or password.",
        "generic" => "An error occurred, please try again.",

        // Success

        "create_account" => "User successfully registered."

    ]), false);

?>