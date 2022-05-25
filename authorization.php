<?php

    include_once "./functions.php";
    $connect = connect();
    include_once "./templates/common/header.php";

    $errors = [];

    if (isset($_POST['email'])) {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $hashPassword = md5($password);
        $query = "
                SELECT COUNT(*) AS `count`, `user_id`
                FROM `users`
                WHERE `user_email` = '$email' AND `user_password` = '$hashPassword';
        ";
        $result = mysqli_query($connect, $query);
        $userInfo = mysqli_fetch_assoc($result);
        $count = $userInfo['count'];
        if ($count === '0') {
            $errors[] = "Такой связки email / пароль не существует";
            mysqli_close($connect);
        }
        if (empty($errors)) {
            $token = generateToken();
            $tokenTime = time() + 30 * 60;
            $userId = $userInfo['user_id'];
            $query = "
                    INSERT INTO `connects`
                        SET `connect_user_id` = $userId,
                            `connect_token` = '$token',
                            `connect_token_time` = FROM_UNIXTIME($tokenTime);
            ";
            mysqli_query($connect, $query);
            setcookie("uid", $userInfo['user_id'], time() + 2 * 24 * 3600, '/');
            setcookie("t", $token, time() + 2 * 24 * 3600, '/');
            setcookie("tt", $tokenTime, time() + 2 * 24 * 3600, '/');

            header("Location: ./users.php");
        }

    }

    include_once "./templates/users/auth.php";

    mysqli_close($connect);
