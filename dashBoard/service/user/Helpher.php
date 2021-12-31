<?php

namespace Helpher;

use database\connection as conn;



class Helpher
{

    public $conn;

    public function __construct()
    {

        $db = new conn();
        $this->conn = $db->connect();
    }

    public function userProfile($userId, &$res)
    {

        $res = array();

        $profileQuery = mysqli_query($this->conn, "SELECT user_first_name, user_phone, user_last_name, user_email, profile_img FROM `customer` WHERE `user_id` = $userId;");

        if (mysqli_num_rows($profileQuery) > 0) {

            $profileData = mysqli_fetch_assoc($profileQuery);

            $user = array(
                'FistName' => $profileData['user_first_name'],
                'LastName' => $profileData['user_last_name'],
                'EmailId' => $profileData['user_email'],
                'profileImg' => $profileData['profile_img'],
                'user_phone' => $profileData['user_phone']
            );

            $res["profile"] = true;
            $res["user"] = $user;
        } else {
            $res["profile"] = false;
        }

        return $res;
    }

    public function setNotification($receiver, $amount, $sender)
    {
        $sql = "INSERT INTO `pay_history`(`receiver_id`, `amount`, `sender_id`) VALUES ('$receiver', '$amount', '$sender')";

        if ($this->conn->query($sql) === TRUE) {

            $status = 1;
        } else {

            $status = 0;
        }

        return $status;
    }
    public function checknotify($userID)
    {

        $res = array();

        $Query = mysqli_query($this->conn, "SELECT * FROM `pay_history` WHERE `sender_id` = $userID ORDER BY  notification_id DESC");

        if (mysqli_num_rows($Query) > 0) {
            while ($row = mysqli_fetch_assoc($Query)) {
                $res[] = $row;
            }
        } else {
            $res = 0;
        }
        return $res;
    }
    public function getStatus($ID, $data)
    {
        $status  = '';
        if ($data) {
            for ($x = 0; $x < count($data); $x++) {

                if ($data[$x]['receiver_id'] == $ID) {

                    #check status
                    if ($data[$x]['status'] == 1) {
                        $status = "<label class='badge badge-success'>Completed</label>";
                    } else {
                        $status = "<label class='badge badge-dark'>Waiting for conformation</label>";
                    }
                    return  $status;
                } else {
                    $status = 'Pending';
                }
            }
        } else {
            $status = 'Pending';
        }

        return $status;
    }

    public function myNotification($userID)
    {
        $res = array();

        $Query = mysqli_query($this->conn, "SELECT * FROM `pay_history` WHERE `receiver_id` = $userID  AND deleted =0 ORDER BY  notification_id DESC");

        if (mysqli_num_rows($Query) > 0) {
            while ($row = mysqli_fetch_assoc($Query)) {
                $res[] = $row;
            }
        } else {
            $res = 0;
        }

        return $res;
    }
    public function setConfirmed($sender_id)
    {

        $sql = "UPDATE `pay_history` SET `status`= 1,`deleted`=1 WHERE `sender_id`='$sender_id'";

        if ($this->conn->query($sql) === TRUE) {

            $message = "<label class='badge badge-success'>Permission granted.</label>";
        } else {

            $message = "<label class='badge badge-danger'>Something went worng</label>";
        }

        return $message;
    }

    public function checkPSC($userID)
    {
        $total_amount = 0;
        $checkamount = 5000;

        $Query = mysqli_query($this->conn, "SELECT Amount FROM `payment` WHERE `user_id` = $userID  AND status ='Paid'");
        if (mysqli_num_rows($Query) > 0) {
            while ($row = mysqli_fetch_assoc($Query)) {
                $total_amount += $row['Amount'];
            }

            for ($x = 1; $x <= 10; $x++) {
                $checkval =  $checkamount * $x;
                if ($total_amount == $checkval) {

                    $status = $this->setNotification($userID, 500, $userID,);
                }
            }

            $res = $total_amount;
        } else {
            $res = 0;
        }

        return $res;
    }
}
