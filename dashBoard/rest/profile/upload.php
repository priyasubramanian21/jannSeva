<?php


include '../../core/support/session.php';
include '../../core/config/inc.php';
include '../../service/user/UserServiceImpl.php';

use Service\user\UserServiceImpl as Service;
use core\support\session as session;

$session = new session();

$session->start();

$rootFolder = "../../../";

$userID = $_SESSION['user']['UserId'];

if (isset($_FILES['file']['name'])) {

  $Service = new Service();
  /* Getting file name */
  $filename = $_FILES['file']['name'];
  /* Location */
  $location = $rootFolder."storage/profile/" . $filename;
  $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
  $imageFileType = strtolower($imageFileType);

  /* Valid extensions */
  $valid_extensions = array("jpg", "jpeg", "png");


  $response = 0;
  /* Check file extension */
  if (in_array(strtolower($imageFileType), $valid_extensions)) {
    /* Upload file */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {

      $response = $updatePath = soPath . "storage/profile/" . $filename;
      $Service->updateProfileImage($updatePath, $userID);
    }
  }
  header('profile');
  echo $response;
  exit;
}

echo 0;
