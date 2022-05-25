<?php

    function connect ()
    {
        $connect = mysqli_connect('localhost', 'root', '', 'work5');
        mysqli_set_charset($connect, 'utf8');
        return $connect;
    }

    function generateToken ($size = 32)
    {
        $symbols = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g'];
        $symbolsLength = count($symbols);
        $token = "";
        for ($i = 0; $i < $size; $i++) {
            $token .= $symbols[rand(0, $symbolsLength - 1)];
        }
        return $token;
    }

function checkAuthorized ($connect)
{
    if(!isset($_COOKIE['uid']) || !isset($_COOKIE['t']) || !isset($_COOKIE['tt'])) {
        return false;
    }
    $userId = htmlentities($_COOKIE['uid']);
    $token = htmlentities($_COOKIE['t']);
    $tokenTime = htmlentities($_COOKIE['tt']);
    $query = "
                    SELECT `connect_id`
                    FROM `connects`
                    WHERE `connect_user_id` = $userId
                    AND `connect_token` = '$token';
                ";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) === 0) {
        return  false;
    }
    if ($tokenTime < time()) {
        $newToken = generateToken();
        $newTokenTime = time() + 30 * 60;
        setcookie("uid", $userId, time() + 2 * 24 * 3600, '/');
        setcookie("t", $newToken, time() + 2 * 24 * 3600, '/');
        setcookie("tt", $newTokenTime, time() + 2 * 24 * 3600, '/');
        $connectId = $result['connect_id'];
        $query = "
                        UPDATE `connects`
                            SET `token` = '$newToken',
                                `token_time` = FROM_UNIXTIME($newTokenTime)
                            WHERE `connect_id` = $connectId;
                    ";
        mysqli_query($connect, $query);
    }
    return true;
}
