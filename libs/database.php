<?php
$db = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NAME);
if ($db->connect_errno) {
    echo "DB Connection failed: " . $db->connect_error;
}