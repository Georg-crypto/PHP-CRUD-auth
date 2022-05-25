<?php

    include_once "./functions.php";

    $connect = connect();

    include_once "./templates/common/header.php";

    if (mysqli_connect_error() !== "") {
        $query = "
            SELECT *
            FROM `users`
            ORDER BY `user_fio`;
        ";
        $result = mysqli_query($connect, $query);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        include_once "./templates/users/table.php";
        include_once "./templates/common/footer.php";
    } else {
        echo "Не удалось подключиться к БД";
    }

    mysqli_close($connect);

