<?php


namespace service\user;


interface UserService
{

    public function userLoginSystem($userName, $password, $post, array &$res);

    public function userSignUpSystem($firstName, $lastName, $phoneNumber, $email, $password, $state, $district, $connect, $post, &$res);

}