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
    $query = "INSERT INTO game_users (`user_id`, `name`, `first_name`, `last_name`, `password`, `email`, `farm`, `date`, `fb_id`, `location`)
                                VALUES (NULL, '".$profile["name"]."', '".$profile["first_name"]."', '".$profile["last_name"]."', NULL, '".$profile["email"]."', '".$profile["first_name"].' '.$profile["last_name"]."\'s', NULL, ".$profile["id"].", '".$profile["location"]."')
                                ON DUPLICATE KEY UPDATE fb_id=fb_id; ";
    $res = mysql_query($query);
    if ($res) {
        return get_user_by_id($profile["id"]);
    }
    return mysql_error();
}

function save_game($id, $gameState, $hypertime) {
    $query = "INSERT INTO `thegreendream`.`game_saves` (`id`, `user_id`, `gamestate`, `date`, `hypertime`)
                                                VALUES (NULL, ".$id.", \"".$gameState."\", CURRENT_TIMESTAMP, \"".sprintf("%1$04d",$array["hypertime"]).""\" );";
    return mysql_query($query);

}

function load_game($id) {
    $query = "SELECT * FROM game_saves WHERE user_id=".$id." ORDER BY date DESC LIMIT 1;";
    $res = mysql_query($query) or die(mysql_error());
    if (mysql_num_rows($res) == 1) {
        $array = mysql_fetch_array($res);

        $hourCap = 288;
        $rate = 4;

        if ($array["hypertime"] < $hourCap)
        {
            $datetime1 = new DateTime($array["timestamp"]);
            $datetime2 = new DateTime();
            $interval = $datetime1->diff($datetime2);
            $array["hypertime"] = $interval->format("%h")*$rate;
            
            if ($array["hypertime"] > $hourCap):
                $array["hypertime"] = $hourCap;
            endif;
        }

        return array(
                "gamestate" => $array["gamestate"],
                "hypertime" => sprintf("%1$04d",$array["hypertime"])
            );
    }
    return "";
}