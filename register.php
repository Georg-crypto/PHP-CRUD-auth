<?php

    include_once "./functions.php";
    $connect = connect();
    include_once "./templates/common/header.php";

    $errors = [];

    if (isset($_POST['user_fio'])) {
        $login = htmlentities($_POST['user_login']);
        $fio = htmlentities($_POST['user_fio']);
        $email = htmlentities($_POST['user_email']);
        $password = htmlentities($_POST['user_password']);
        $repeatPassword = htmlentities($_POST['repeat_password']);
        if ($password !== $repeatPassword) {
            $errors[] = "Пароли не совпадают";
        } else {
            $query = "
                SELECT COUNT(*) AS `count`
                FROM `users`
                WHERE `user_email` = '$email';
            ";
            $result = mysqli_query($connect, $query);
            $count = mysqli_fetch_assoc($result) ['count'];
            if ($count === '1') {
                $errors[] = "Такой email уже зарегистрирован";
                mysqli_close($connect);
            }
            if (empty($errors)) {
                $hashPassword = md5($password);
                $query = "
                    INSERT INTO `users`
                        SET `user_login` = '$login',
                            `user_fio` = '$fio',
                            `user_email` = '$email',
                            `user_password` = '$hashPassword';
                ";
                mysqli_query($connect, $query);
                header("Location: ./users.php");
            }
        }
    }

    include_once "./templates/users/reg.php";
    mysqli_close($connect);
