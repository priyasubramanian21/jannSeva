<?php


namespace Service\user;

use database\connection as conn;
use Level\Level as level;

include 'UserService.php';

include "../../core/config/dataBase/connection.php";
include "Level.php";

class UserServiceImpl
{

    public $conn;

    public function __construct()
    {
        $db = new conn();
        $this->conn = $db->connect();
    }

    public function userMainProfile($userId, &$res)
    {

        $res = array();

        $profileQuery = mysqli_query($this->conn, "SELECT user_first_name, user_last_name, user_email, profile_img FROM `customer` WHERE `user_id` = $userId;");

        if (mysqli_num_rows($profileQuery) > 0) {

            $profileData = mysqli_fetch_assoc($profileQuery);

            $user = array(
                'FistName' => $profileData['user_first_name'],
                'LastName' => $profileData['user_last_name'],
                'EmailId' => $profileData['user_email'],
                'profileImg' => $profileData['profile_img']
            );

            $res["profile"] = true;
            $res["user"] = $user;
        } else {
            $res["profile"] = false;
            //header("location: login");
        }

        return $res;
    }

    public function userLoginSystem($userName, $password, $post, array &$res)
    {

        $res = array();

        $userIdI = mysqli_real_escape_string($this->conn, $userName);
        $passwordI = mysqli_real_escape_string($this->conn, $password);
        $postI = mysqli_real_escape_string($this->conn, $post);

        $userLoginQuery = mysqli_query($this->conn, "SELECT user_first_name, user_id, user_last_name, user_email, user_role, user_status, user_phone  FROM `customer` WHERE `user_id` = '$userIdI' AND `user_password` = '$passwordI'");


        if (mysqli_num_rows($userLoginQuery) > 0) {

            $userData = mysqli_fetch_assoc($userLoginQuery);

            $user = array(
                'FistName' => $userData['user_first_name'],
                'LastName' => $userData['user_last_name'],
                'EmailId' => $userData['user_email'],
                'UserId' => $userData['user_id'],
                'UserRoll' => $userData['user_role'],
                "UserStatus" => $userData['user_status'],
                "UserPhone" => $userData['user_phone']
            );

            if ($userData['user_status'] == 0) {

                $res['login'] = false;
                $res["pay"] = true;
                $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">PSC Pending</span>';
                $res["user"] = $user;
            } else {

                $res["pay"] = false;
                $res['login'] = true;
                $res["message"] = '<span style="color: #49a578;font-size: smaller;font-style: normal;">Login Done</span>';
                $res["user"] = $user;
            }
        } else {
            $res["pay"] = false;
            $res['login'] = false;
            $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check userId and password</span>';
        }

        return $res;
    }


    public function userSignUpSystem($firstName, $lastName, $phoneNumber, $email, $password, $state, $district, $connect, $post, &$res)
    {
        $firstNameI = mysqli_real_escape_string($this->conn, $firstName);
        $lastName = mysqli_real_escape_string($this->conn, $lastName);
        $phoneNumberI = mysqli_real_escape_string($this->conn, $phoneNumber);
        $emailI = mysqli_real_escape_string($this->conn, $email);
        $passwordI = mysqli_real_escape_string($this->conn, $password);
        $stateI = mysqli_real_escape_string($this->conn, $state);
        $districtI = mysqli_real_escape_string($this->conn, $district);
        $connectI = mysqli_real_escape_string($this->conn, $connect);

        $res = array();

        $userMail = mysqli_query($this->conn, "SELECT user_email FROM `customer` WHERE `user_email` = '$emailI' ");
        $userPhone = mysqli_query($this->conn, "SELECT  user_phone  FROM `customer` WHERE `user_phone` = '$phoneNumberI'");
        $userConnectId = mysqli_query($this->conn, "SELECT user_email FROM `customer` WHERE `user_id` = '$connectI' ");


        if (mysqli_num_rows($userConnectId) == 1) {

            if (mysqli_num_rows($userMail) < 1) {

                if (mysqli_num_rows($userPhone) < 5) {

                    $sql = " INSERT INTO customer(user_first_name,user_last_name,user_email,user_phone,state, district, user_password, connect) VALUES ('$firstNameI','$lastName', '$emailI', '$phoneNumberI', '$stateI', '$districtI', '$passwordI', '$connectI')";

                    if ($this->conn->query($sql) === TRUE) {



                        $userLoginQuery = mysqli_query($this->conn, "SELECT user_first_name, user_id, user_last_name, user_email, user_role, user_status, user_phone  FROM `customer` WHERE `user_email` = '$emailI' ");

                        if (mysqli_num_rows($userLoginQuery) > 0) {

                            $userData = mysqli_fetch_assoc($userLoginQuery);

                            $user = array(
                                'FistName' => $userData['user_first_name'],
                                'LastName' => $userData['user_last_name'],
                                'EmailId' => $userData['user_email'],
                                'UserId' => $userData['user_id'],
                                'UserRoll' => $userData['user_role'],
                                "UserStatus" => $userData['user_status'],
                                "UserPhone" => $userData['user_phone']
                            );


                            $res['signup'] = true;
                            $res['login'] = false;
                            $res["pay"] = false;

                            $res["user"] = $user;

                            $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Registered Successfully</span>';
                        } else {

                            $res["message"] = '<span style="color: #49a578;font-size: smaller;font-style: normal;">error</span>';
                        }
                    } else {

                        $res['signup'] = false;

                        $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Failed</span>';
                    }
                } else {
                    $res['signup'] = false;

                    $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Your phone number limit has exceeded</span>';
                }
            } else {

                $res['signup'] = false;

                $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Your Mail Id limit has exceeded</span>';
            }
        } else {
            $res['signup'] = false;

            $res["message"] = '<span style="color: brown;font-size: smaller;font-style: normal;">Please check connectId</span>';
        }

        return $res;
    }

    public function myConnectionShort($userId)
    {
        $myConnectionTable = mysqli_query($this->conn, "SELECT connect FROM customer Where `user_id` = '$userId';");

        if (mysqli_num_rows($myConnectionTable) > 0) {

            $myConnectionData = mysqli_fetch_array($myConnectionTable);

            $MyConn = $myConnectionData['connect'];

            $mynTable = mysqli_query($this->conn, "SELECT user_first_name, user_last_name , user_phone  FROM customer Where `user_id` = '$MyConn';");

            if (mysqli_num_rows($mynTable) > 0) {

                $res = $this->myConnectionShortListing($mynTable);
            } else {
                $res = null;
            }
        } else {
            $res = null;
        }


        return $res;
    }

    private function myConnectionShortListing($myConnectionTable)
    {

        while ($myConnectionData = mysqli_fetch_array($myConnectionTable)) {

            $color = array("card card-tale", "card card-dark-blue", "card card-light-blue", "card card-light-danger");

            $rand_color = array_rand($color, 2);

            $res = '<div class="col-md-6 mb-4 stretch-card transparent"><div class="' . $color[$rand_color[0]] . '">
		                <div class="card-body"> 
			                <p class="mb-4">Invited Member</p>
			                <p class="fs-30 mb-2"><small><a href="#" style="text-decoration: none;color: #FFF;"> ' . $myConnectionData['user_first_name'] . " " . $myConnectionData['user_last_name'] . '</a></small></p>
			                <p> ' . $myConnectionData['user_phone'] . ' </p>
		            </div></div></div>';
        }
        return $res;
    }


    public function totalPayedPMF($userID)
    {

        $totalPayedPMFAmount = mysqli_query($this->conn, "SELECT SUM(Amount) AS totalAmount FROM `payment` WHERE user_id = '$userID' AND status = 'Paid';");

        $totalPayedPMF = 0;

        if (mysqli_num_rows($totalPayedPMFAmount) > 0) {

            $walletData = mysqli_fetch_array($totalPayedPMFAmount);

            $totalPayedPMF = $walletData['totalAmount'] == null ? $totalPayedPMF : $walletData['totalAmount'];

            $res = $totalPayedPMF / 118 * 100;
        } else {
            $res = $totalPayedPMF;
        }

        return $res;
    }

    public function totalPayedTax($amount)
    {

        return $amount / 100 * 18;
    }

    public function myConnection($userId)
    {

        $myConnectionTable = mysqli_query($this->conn, "SELECT user_first_name, user_last_name, profile_img, user_id as connect_id , user_phone, user_email FROM customer Where `connect` = '$userId' ORDER BY user_id  ASC LIMIT 4;");

        if (mysqli_num_rows($myConnectionTable) > 0) {

            $res = $this->myConnectionListing($myConnectionTable);
        } else {
            $res = null;
        }

        return $res;
    }


    private function myConnectionListing($myConnectionTable)
    {

        while ($myConnectionData = mysqli_fetch_array($myConnectionTable)) {



            $VC = $this->subConnectionStatusCount($myConnectionData['connect_id']);



            if ($myConnectionData['profile_img'] == null) {
                $profile = 'https://as1.ftcdn.net/v2/jpg/01/01/26/18/500_F_101261832_dc3LJnbGibseN6d95sIjFoErXP37Kmpo.jpg';
            } else {
                $profile = $myConnectionData['profile_img'];
            }

            $res = '<tr>
	            <td class="py-1"> <img src="' . $profile . '" alt="image" /> </td>
	            <td> ' . $myConnectionData['user_first_name'] . " " . $myConnectionData['user_last_name'] . ' </td>
	            <td> ' . $myConnectionData['connect_id'] . ' </td>
	            <td> ' . $myConnectionData['user_phone'] . ' </td>
	            <td> ' . $myConnectionData['user_email'] . ' </td>
	            
	            <td>
	             	<div class="progress">
			            <div class="progress-bar ' . $VC['color'] . '" role="progressbar" style="width: ' . $VC['value'] . '%" aria-valuenow="' . $VC['value'] . '" aria-valuemin="0" aria-valuemax="100"></div>
		            </div>
	            </td>
                </tr>';

            echo $res;
        }
    }

    public function subConnectionStatusCount($userId)
    {

        $myConnectionTable = mysqli_query($this->conn, "SELECT * FROM `connection` WHERE `main_user_id` = '$userId'");

        $rest['value'] = "1";
        $rest['color'] = "bg-danger";

        if (mysqli_num_rows($myConnectionTable) == 1) {

            $rest['value'] = "25";
            $rest['color'] = "bg-danger";
        } elseif (mysqli_num_rows($myConnectionTable) == 2) {
            $rest['value'] = "50";
            $rest['color'] = "bg-warning";
        } elseif (mysqli_num_rows($myConnectionTable) == 3) {
            $rest['value'] = "75";
            $rest['color'] = "bg-info";
        } elseif (mysqli_num_rows($myConnectionTable) >= 4) {
            $rest['value'] = "100";
            $rest['color'] = "bg-success";
        }

        return $rest;
    }


    public function myReceiptListing($user_id)
    {
        $myReceiptTable = mysqli_query($this->conn, "SELECT * FROM `payment` WHERE `user_id` = $user_id");
        $X = 0;
        while ($myConnectionData = mysqli_fetch_array($myReceiptTable)) {


            $res = '<tr>
	            <td>' . $X . '</td>
	            <td> ' . $myConnectionData['receipt_id'] . ' </td>
	            <td> ' . $myConnectionData['PMF'] . ' </td>
	            <td> ' . $myConnectionData['Amount'] . ' </td>
	            <td> <label class="badge badge-success">' . $myConnectionData['status'] . '</label> </td>
	            <td> <label class="badge badge-info"><a href="' . getenv("soPath") . $myConnectionData['receipt'] . '" style="color: #fff;text-decoration: none;">Receip</a></label></td>
                </tr>';
            $X++;
        }
        return $res;
    }



    public function myHelp($UserId)
    {
        $getsubData = $userArray = array();
        $myConnectionTable = mysqli_query($this->conn, "SELECT connect FROM customer Where `user_id` = '$UserId';");
        if (mysqli_num_rows($myConnectionTable) > 0) {
            $myConnectionData = mysqli_fetch_array($myConnectionTable);
            $MyConn = $myConnectionData['connect'];
        }
        #Connected To
        $Data = $this->getConnect($MyConn);

        if (!empty($Data)) {
            $res = "<tr>
                        <td> </td>
                        <td>" . $Data['user_first_name'] . " " . $Data['user_last_name'] . " </td>
                        <td>" . $Data['user_id'] . "</td>
                        <td> ₹ 800 </td>
                        <td> <label class='badge badge-primary'>Open  </label> </td>
                        <td>" . $Data['user_phone'] . " </td>
                        </tr>";
            echo $res;
        }



        #GET All Connect below us
        #level 1
        $getData = $this->getAllConnect($UserId);
    }

    public function getAllConnect($connectID)
    {
        #Immediate sub
        $getConnect = $this->conQuery($connectID);
        $addConnect = array();

        if (mysqli_num_rows($getConnect) > 0) {
            while ($row = mysqli_fetch_array($getConnect)) {

                $res = "<tr>
                        <td></td>
                        <td>" . $row['user_first_name'] . " " . $row['user_last_name'] . " </td>
                        <td>" . $row['user_id'] . "</td>
                        <td> ₹ 500 </td>
                        <td> <label class='badge badge-success'>Pending</label> </td>
                        <td>" . $row['user_phone'] . " </td>
                        </tr>";
                echo $res;

                $getsubData = $this->getAllConnect($row['user_id']);
            }
        }
    }
    public function conQuery($connectID)
    {
        $getConnect = mysqli_query($this->conn, "SELECT *  FROM customer Where `connect` = '$connectID'");
        return $getConnect;
    }

    public function getConnect($Connect_id)
    {
        $ConnectVal = mysqli_query($this->conn, "SELECT user_first_name, user_last_name , user_phone, connect, `user_id`  FROM customer Where `user_id` = '$Connect_id';");
        if (mysqli_num_rows($ConnectVal) > 0) {
            $ConnectValue = mysqli_fetch_array($ConnectVal);
        } else {
            $ConnectValue = 0;
        }
        return $ConnectValue;
    }
    public function getPercentageConnect($connectID)
    {
        $stage = array();

        $level = new level();

        #level 1
        $stage['level1'] = $level->level1($connectID);

        #level 2
        $stage['level2'] = $level->level2($stage['level1']);

        #level 3
        $stage['level3'] = $level->level3($stage['level2']);

        #level 4
        $stage['level4'] = $level->level4($stage['level3']);

        #level 5
        $stage['level5'] = $level->level5($stage['level4']);

        return $stage;
    }

    public function numberOfPMF($userId)
    {

        $totalPayedPMFAmount = mysqli_query($this->conn, "SELECT SUM(PMF) AS totalPMFCOUNT FROM `payment` WHERE user_id = '$userId' AND status = 'Paid';");

        $totalPMF = 0;

        if (mysqli_num_rows($totalPayedPMFAmount) > 0) {

            $walletData = mysqli_fetch_array($totalPayedPMFAmount);

            $totalPMF = $walletData['totalPMFCOUNT'] == null ? $totalPMF : $walletData['totalPMFCOUNT'];

            $res = $totalPMF;
        } else {
            $res = $totalPMF;
        }

        return $res;
    }
}
