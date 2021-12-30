<?php

namespace Service\user;

error_reporting(0);

use database\connection as conn;
use Level\Level as level;
use Helpher\Helpher as Helpher;

include 'UserService.php';

include "../../core/config/dataBase/connection.php";
include "Level.php";
include "Helpher.php";

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

        $myConnectionTable = mysqli_query($this->conn, "SELECT connect FROM customer Where `user_id` = '$UserId';");
        if (mysqli_num_rows($myConnectionTable) > 0) {
            $myConnectionData = mysqli_fetch_array($myConnectionTable);
            $MyConn = $myConnectionData['connect'];
        }
        $Helpher = new Helpher();
        #Connected To
        $siteUrl = 'http://localhost/jannSeva/';

        #GET All Connect below us
        #level 1
        $getData = $this->getAllConnect($MyConn);

        $getDataID = $Helpher->checknotify($UserId);

        if (!empty($getData)) {

            for ($x = 1; $x <= count($getData); $x++) {
                #set Amount
                $getData[$x]['amount'] = 500;
                if (isset($getData[5])) {
                    $getData[5]['amount'] = 800;
                }


                $status = $Helpher->getStatus($getData[$x]['user_id'], $getDataID);
                #Status 
                if ($x == 1) {
                    $Redirecturl = $siteUrl . 'dashBoard/rest/User?userID=' . $getData[$x]['user_id'] . '&amount=' . $getData[$x]['amount'];

                    if ($status == 'Pending') {
                        $statushtml = " <a href=" . $Redirecturl . "><label class='badge badge-info' >Open  </label></a> ";
                    } else {
                        $statushtml = $status;
                    }
                } else {
                    #redirect URL
                    $Redirecturl = $siteUrl . 'dashBoard/rest/User?userID=' . $getData[$x]['user_id'] . '&amount=' . $getData[$x]['amount'];

                    if ($status == 'Pending') {
                        $statushtml = " <a href=''><label class='badge badge-warning' > Pending </label></a> ";
                    } else {
                        $statushtml = $status;
                    }
                    if (isset($getDataID) && !empty($getDataID)) {

                        $resetX = 1 + count($getDataID);

                        if ($x == $resetX && $getDataID[0]['deleted'] == 1)
                            $statushtml = " <a href=" . $Redirecturl . "><label class='badge badge-info' >Open  </label></a> ";
                    }
                }


                #check pmf for user 
                $checkPSC = $Helpher->checkPSC($getData[$x]['user_id']);

                if ($checkPSC >= 3000) {
                    $statushtml = " <a href=''><label class='badge badge-warning' > Pending </label></a> ";
                }
                // elseif ($getData[$x]['user_id'] == 1006 && $status == 'Pending') {
                //     $statushtml = " <a href=" . $Redirecturl . "><label class='badge badge-info' >Open  </label></a> ";
                // }

                $res = "<tr>
                        <td> </td>
                        <td>" . $getData[$x]['user_first_name'] . " " . $getData[$x]['user_last_name'] . " </td>
                        <td>" . $getData[$x]['user_id'] . "</td>
                        <td> " . $getData[$x]['amount'] . " </td>
                        <td>" . $statushtml . " </td>
                        <td>" . $getData[$x]['user_phone'] . " </td>
                        </tr>";
                if ($checkPSC >= 50000) {
                    continue;
                } else {
                    echo $res;
                }
            }
        }
    }

    public function getAllConnect($connectID)
    {
        $data = array();

        #ref 1
        $data[1] = $this->conQuery($connectID);
        if (empty($data[1])) return false;
        #ref 2
        $data[2] = $this->conQuery($data[1]['connect']);
        #ref 3
        $data[3] = $this->conQuery($data[2]['connect']);
        #ref 4
        $data[4] = $this->conQuery($data[3]['connect']);
        #ref 5
        $data[5] = $this->conQuery($data[4]['connect']);

        #check pmf for user 
        $Helpher = new Helpher();
        $num = 0;
        $num = count($data) + 1;

        for ($x = 1; $x <= $num; $x++) {

            $checkPSC = $Helpher->checkPSC($data[$x]['user_id']);
            if ($checkPSC >= 50000) {
                unset($data[$x]);
            }
        }
        return $data;
    }
    public function conQuery($connectID)
    {
        $getConnect = mysqli_query($this->conn, "SELECT *  FROM customer Where `user_id` = '$connectID' AND user_status =1");
        if (mysqli_num_rows($getConnect) > 0) {
            $row = mysqli_fetch_array($getConnect);
        }

        return $row;
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
