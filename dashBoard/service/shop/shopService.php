<?php

namespace shopService;

use database\connection as conn;


class Shop
{

    public $conn;

    public function __construct()
    {

        $db = new conn();
        $this->conn = $db->connect();
    }

    public function getShopDetails($userID)
    {
        $myShop = mysqli_query($this->conn, "SELECT * FROM merchants Where `created_by` = '$userID';");

        if (mysqli_num_rows($myShop) > 0) {
            $myShopData = mysqli_fetch_array($myShop);
            return $myShopData;
        } else {
            return false;
        }
    }


    public function getShopDetailsByArea($country, $state, $city)
    {
        $myShop = mysqli_query($this->conn, "SELECT * FROM merchants Where `city` = '$city' AND `country`='$country' AND `state`='$state' ");

        if (mysqli_num_rows($myShop) > 0) {
            $myShopData = mysqli_fetch_array($myShop);
            return $myShopData;
        } else {
            return false;
        }
    }

    public function shopInsert($shopName, $ownerName, $phone, $discount, $shopType, $shopCategory, $address, $state, $address1, $pin, $city, $country, $userId)
    {

        $shopNameI = mysqli_real_escape_string($this->conn, $shopName);
        $ownerNameI = mysqli_real_escape_string($this->conn, $ownerName);
        $phoneI = mysqli_real_escape_string($this->conn, $phone);
        $discountI = mysqli_real_escape_string($this->conn, $discount);
        $shopTypeI = mysqli_real_escape_string($this->conn, $shopType);
        $shopCategoryI = mysqli_real_escape_string($this->conn, $shopCategory);
        $addressI = mysqli_real_escape_string($this->conn, $address);
        $stateI = mysqli_real_escape_string($this->conn, $state);
        $address1I = mysqli_real_escape_string($this->conn, $address1);
        $pinI = mysqli_real_escape_string($this->conn, $pin);
        $cityI = mysqli_real_escape_string($this->conn, $city);
        $countryI = mysqli_real_escape_string($this->conn, $country);

        $sql = " INSERT INTO `merchants`(`shop_name`, `owner_name`, `phone`, `discount`, `shop_type`, `shop_category`, `address1`, `address2`, `state`, `country`, `city`, `postcode`, `created_by`) VALUES ('$shopNameI','$ownerNameI', '$phoneI', '$discountI', '$shopTypeI', '$shopCategoryI', '$addressI', '$address1I', '$stateI', '$countryI', '$cityI', '$pinI', '$userId')";

        if ($this->conn->query($sql) === TRUE) {
            $response = 'true';
        } else {
            $response = 'false';
        }
        return $response;
    }


    public function shopUpdate($shopName, $ownerName, $phone, $discount, $shopType, $shopCategory, $address, $state, $address1, $pin, $city, $country, $shopID, $userId)
    {

        $shopNameI = mysqli_real_escape_string($this->conn, $shopName);
        $ownerNameI = mysqli_real_escape_string($this->conn, $ownerName);
        $phoneI = mysqli_real_escape_string($this->conn, $phone);
        $discountI = mysqli_real_escape_string($this->conn, $discount);
        $shopTypeI = mysqli_real_escape_string($this->conn, $shopType);
        $shopCategoryI = mysqli_real_escape_string($this->conn, $shopCategory);
        $addressI = mysqli_real_escape_string($this->conn, $address);
        $stateI = mysqli_real_escape_string($this->conn, $state);
        $address1I = mysqli_real_escape_string($this->conn, $address1);
        $pinI = mysqli_real_escape_string($this->conn, $pin);
        $cityI = mysqli_real_escape_string($this->conn, $city);
        $countryI = mysqli_real_escape_string($this->conn, $country);

        $sql =  "UPDATE `merchants` SET `shop_name`='$shopNameI',`owner_name`='$ownerNameI',`phone`='$phoneI',`discount`='$discountI',`shop_type`='$shopTypeI',`shop_category`='$shopCategoryI',`address1`='$addressI',`address2`='$address1I',`state`='$stateI',`country`='$countryI',`city`='$cityI',`postcode`='$pinI' WHERE `shop_id`='$shopID'";

        if ($this->conn->query($sql) === TRUE) {

            $response = 'true';
        } else {
            $response = 'false';
        }
        return $response;
    }
}
