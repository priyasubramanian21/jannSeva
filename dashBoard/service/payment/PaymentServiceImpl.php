<?php


namespace service\payment;


use core\support\session;
use database\connection as conn;

class PaymentServiceImpl
{

    public $conn;



    public function __construct()
    {

        $db = new conn();
        $this->conn = $db->connect();

    }

    public function paymentRegister($userId, $attributes, $rep_id, $pdfStore, $PMF)
    {

        $session = new session();


        $order_id = $attributes["razorpay_order_id"];
        $payment_id = $attributes["razorpay_payment_id"];

        $signature = $attributes["razorpay_signature"];      
        
       
       if($_SESSION['PMF_amount'] && $_SESSION['PMF_count']){
       
             $Amount = $_SESSION['PMF_amount'];
             $PMF = $_SESSION['PMF_count'];
             
       }else{ 
       
           $Amount = $attributes['amount'];
       }        


        $sql = "INSERT INTO payment(`id`, `user_id`, `Amount`, PMF, `order_id`, `payment_id`, `signature`, `receipt_id`, `receipt`, `status`) VALUES ( NULL, '$userId','$Amount','$PMF','$order_id','$payment_id','$signature', '$rep_id', '$pdfStore','Paid')";        

        if ($this->conn->query($sql) === TRUE) {
 

            $updateUserStatus = "UPDATE `customer` SET `user_status` = '1' WHERE `user_id` = $userId;";

            if ($this->conn->query($updateUserStatus) === TRUE) {

                $session->start();

                $_SESSION["login"] = true;

                header("location: profile");

            } else {
                header("location: logout");
            }
        } else {

            $_SESSION["payment"] = false;

        }
        return null;


    }

        public function PMFPay($userId, $attributes, $rep_id, $pdfStore, $PMF){


        $order_id = $attributes["razorpay_order_id"];
        $payment_id = $attributes["razorpay_payment_id"];

        $signature = $attributes["razorpay_signature"];
        $Amount = $attributes['amount'];


        $sql = "INSERT INTO payment(`id`, `user_id`, `Amount`, PMF, `order_id`, `payment_id`, `signature`, `receipt_id`, `receipt`, `status`) VALUES ( NULL, '$userId','$Amount','$PMF','$order_id','$payment_id','$signature', '$rep_id', '$pdfStore','Paid')";

        if ($this->conn->query($sql) === TRUE) {


            $_SESSION["payment-Message"] = false;
            header("location: receipt");

        } else {

            echo 'Some Error';

        }
        return null;

    }


    public function paymentCheck($userId)
    {

        $paymentCheck = mysqli_query($this->conn, "select status from payment where user_id = '$userId' ");

        if (mysqli_num_rows($paymentCheck) > 0) {

            $userData = mysqli_fetch_assoc($paymentCheck);

            $res = $userData['status'];

        }
        else
        {
            $res = null;
        }
        return $res;

    }
}
