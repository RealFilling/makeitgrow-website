<?php

function get_user_by_id($id) {
    $query = "SELECT * FROM game_users WHERE fb_id=".$id.";";
    $res = mysql_query($query);
    if (mysql_num_rows($res) == 1) {
        return mysql_fetch_array($res);
    }
    return false;
}

function register_user($profile) {
    $query = "INSERT INTO game_users (`user_id`, `name`, `first_name`, `last_name`, `password`, `email`, `farm`, `date`, `fb_id`)
                                VALUES (NULL, '".$profile["name"]."', '".$profile["first_name"]."', '".$profile["last_name"]."', NULL, '".$profile["email"]."', '".$profile["farm"]."', NULL, ".$profile["id"].")
                                ON DUPLICATE KEY UPDATE fb_id=fb_id; ";
    $res = mysql_query($query);
    if ($res) {
        return get_user_by_id($profile["id"]);
    }
    return mysql_error();
}