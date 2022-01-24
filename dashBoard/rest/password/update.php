<?php


include "../../core/config/dataBase/connection.php";

use database\connection as conn;

$db = new conn();
$conn = $db->connect();

if ($_POST['action'] == 'verify') {
    $connectID = mysqli_real_escape_string($conn, $_POST['connectID']);
    $profileQuery = mysqli_query($conn, "SELECT user_first_name, user_last_name, user_email, profile_img FROM `customer` WHERE `user_id` = $connectID;");
    $profileData = mysqli_fetch_assoc($profileQuery);

    if (!empty($profileData)) {
        echo json_encode($profileData);
        exit;
    } else {
        echo false;
    }
} elseif ($_POST['action'] == 'conform') {


    $connectID = mysqli_real_escape_string($conn, $_POST['connectID']);
    $userID = $_POST['user'];

    $sql = "UPDATE `customer` SET `connect`='$connectID' WHERE `user_id`=$userID";

    if ($conn->query($sql) === TRUE) {
        echo true;
    } else {
        echo false;
    }
}
