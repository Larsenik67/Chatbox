<?php

require_once 'config/configuration.php';
require_once 'config/connect.php';

if (isset($_POST['message']) && !empty($_POST['message']) && isset($_SESSION['user'])) {
    $date_at = date('Y-m-d H:i:s');
    $user = $_SESSION['user']['id'];
    $message = strip_tags($_POST['message']);
    $sql = "INSERT INTO messenger (user_id,message,date_at) VALUES ('$user','$message','$date_at')";
    if ($result = $mysqli->query($sql)) {
        echo 'true';
    } else {
        echo 'false';
    }
}
