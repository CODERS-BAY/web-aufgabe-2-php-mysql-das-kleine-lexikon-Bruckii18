<?php
$host = "127.0.0.1";
$pw = "Michael18";
$user = "Bruckii";
$db = "michael_web";

$con = new mysqli($host, $user, $pw, $db);
if($con->connect_errno) {
    die("Connect failed! " .  $con->connect_error);
}

?>