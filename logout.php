<?php

    require_once "./functions.php";
    $connect = connect();

    if(isset($_COOKIE['uid']) || isset($_COOKIE['t'])) {
        $userId = htmlentities($_COOKIE['uid']);
        $token = htmlentities($_COOKIE['t']);
        $query = "
                            DELETE FROM `connects`
                                WHERE `connect_user_id` = $userId
                                AND `connect_token` = '$token';
                        ";
        mysqli_query($connect, $query);
    }

    mysqli_close($connect);

    header("Location: ./users.php");