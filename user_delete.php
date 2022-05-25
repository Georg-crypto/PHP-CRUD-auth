<?php

    require_once "./functions.php";

    if (isset($_GET['id'])) {
        $id = htmlentities($_GET['id']);
        $connect = connect();
        $query = "
            DELETE FROM `users`
                WHERE `user_id` = $id;
        ";
        mysqli_query($connect, $query);
        mysqli_close($connect);
    }

    header ("Location: ./users.php");
