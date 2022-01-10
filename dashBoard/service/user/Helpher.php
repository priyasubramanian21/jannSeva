<?php

namespace Helpher;

use database\connection as conn;
use Service\user\UserServiceImpl as Service;



class Helpher
{

    public $conn;

    public function __construct()
    {

        $db = new conn();
        $this->conn = $db->connect();
    }

    public function clearNotify($userId)
    {

        $sql = "UPDATE `pay_history` SET `status`= 1,`deleted`=1 WHERE `sender_id`='$userId' AND `receiver_id`='$userId'";

        if ($this->conn->query($sql) === TRUE) {

            $message = "<label class='badge badge-success'>Data Cleared.</label>";
        } else {

            $message = "<label class='badge badge-danger'>Something went worng</label>";
        }

        return $message;
    }

    public function userProfile($userId, &$res)
    {

        $res = array();

        $profileQuery = mysqli_query($this->conn, "SELECT user_first_name, user_phone, user_last_name, user_email, profile_img, contact_info, uid  FROM `customer` WHERE `user_id` = $userId;");

        if (mysqli_num_rows($profileQuery) > 0) {

            $profileData = mysqli_fetch_assoc($profileQuery);

            $user = array(
                'FistName' => $profileData['user_first_name'],
                'LastName' => $profileData['user_last_name'],
                'EmailId' => $profileData['user_email'],
                'profileImg' => $profileData['profile_img'],
                'user_phone' => $profileData['user_phone'],
                'contact_info' => $profileData['contact_info'],
                'uid' => $profileData['uid']
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

        $Query = mysqli_query($this->conn, "SELECT * FROM `pay_history` WHERE `sender_id` = $userID AND `receiver_id` != $userID ORDER BY  notification_id DESC");

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
        $generalNotify = $res = array();
        $getStatus = $this->checkGiveHelpStatus($userID); 
        if(!empty($getStatus))      
        $count = count($getStatus);
        else
        $count = 0;
        
        $Query = mysqli_query($this->conn, "SELECT * FROM `pay_history` WHERE `receiver_id` = $userID  AND deleted = 0 ORDER BY  notification_id DESC");

        if (mysqli_num_rows($Query) > 0) {
            while ($row = mysqli_fetch_assoc($Query)) {
                if ($row['receiver_id'] == $row['sender_id']) {
                    $generalNotify[] = $row;
                } else {
                    $res[] = $row;
                }
            }
        } else {
            $res = 0;
        }
        if (!empty($res))
            $qCount = count($res);
        else
            $qCount = 0;

        $getconnect = $this->getConnect($userID);
        $Data = array();
        $service = new Service();
        $getData = $service->getAllConnect($getconnect);
        for ($m = 0; $m <= count($getData); $m++) {
            if (!empty($getData[$m])) {
                $Data[] = $getData[$m];
            }
        }
        $checkCount = count($Data);
        if ($count >= $checkCount) {
            $response['receiver'] = $res;
        } elseif ($count >= 1  &&  $qCount >= 1 || $count == 0 && $qCount >= 1) {
            $response['status'] = 'Available';
            $response['count'] = count($res);
        } else {
            $response = 0;
        }
        $response['generalNotify'] = $generalNotify;
        return $response;
    }

    public function getConnect($UserId)
    {

        $myConnectionTable = mysqli_query($this->conn, "SELECT connect FROM customer Where `user_id` = '$UserId';");
        if (mysqli_num_rows($myConnectionTable) > 0) {
            $myConnectionData = mysqli_fetch_array($myConnectionTable);
            $MyConn = $myConnectionData['connect'];
        }

        return $MyConn;
    }

    public function checkGiveHelpStatus($userID)
    {
        $res = array();

        $Query = mysqli_query($this->conn, "SELECT * FROM `pay_history` WHERE `sender_id` = $userID AND `receiver_id` != $userID AND deleted = 1 ORDER BY  notification_id DESC");

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
        $payq = mysqli_query($this->conn, "SELECT  `amount`  FROM `pay_history` WHERE `receiver_id` = $userID AND `sender_id` != $userID AND `status`= 1");

        while ($prow = mysqli_fetch_assoc($payq)) {
            $checkamount += $prow['amount'];
        }

        $total_amount = 0;
        // $checkamount = 5000;
        $total_pmf = 0;

        $Query = mysqli_query($this->conn, "SELECT Amount , PMF FROM `payment` WHERE `user_id` = $userID  AND status ='Paid'");
        if (mysqli_num_rows($Query) > 0) {
            while ($row = mysqli_fetch_assoc($Query)) {
                $total_amount += $row['Amount'];
                $total_pmf += $row['PMF'];
            }

            $getPmfCount = $checkamount / $total_amount;

            // $getInt = (int)$getPmfCount;
            if ($getPmfCount >= 10) {
                $status = $this->setNotification($userID, 500, $userID);
                $res = 1;
            } else {
                $res = 0;
            }
        } else {
            $res = 0;
        }

        return $res;
    }


    public function checkInitialPSC($userID)
    {
        $Query = mysqli_query($this->conn, "SELECT * FROM `payment` WHERE `user_id` = $userID  AND status ='Paid'");

        if (mysqli_num_rows($Query) > 0) {
            $getstatus =  $this->checkPSC($userID);

            if ($getstatus == 1) {
                $res = 0;
            } else {
                $res = 1;
            }
        } else {
            $res = 0;
        }

        return $res;
    }
}