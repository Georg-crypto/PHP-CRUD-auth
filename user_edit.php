<?php

    include_once "./functions.php";

    if (isset($_GET['id'])) {
        $userId = htmlentities($_GET['id']);
        $connect = connect();
        include_once "./templates/common/header.php";
        if (isset($_POST['user_fio'])) {
            $fio = htmlentities($_POST['user_fio']);
            $password = htmlentities($_POST['user_password']);
            $hashPassword = md5($password);
            $query = "
            UPDATE `users`
                SET `user_fio` = '$fio',
                    `user_password` = '$hashPassword'
                WHERE `user_id` = $userId;
            ";
            mysqli_query($connect, $query);
            mysqli_close($connect);
            header ("Location: ./users.php");
        }
        $query = "
                SELECT `user_fio` AS `fio`
                FROM `users`
                WHERE `user_id` = $userId;
            ";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "Страница не существует";
        } else {
            $initialFio = mysqli_fetch_assoc($result)['fio'];
            include_once "./templates/users/edit.php";
        }
        mysqli_close($connect);
    } else {
        echo "Страница не существует";
    }


