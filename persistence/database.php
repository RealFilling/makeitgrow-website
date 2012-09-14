<?php
$db = new mysqli("localhost", "greendream", "InTheGarden1", "thegreendream");
if ($db->connect_errno) {
    echo "DB Connection failed: " . $db->connect_error;
}