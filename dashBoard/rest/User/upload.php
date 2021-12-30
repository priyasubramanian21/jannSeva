<?php
// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES['fileToUpload']["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }
?>





<?php


include '../../service/profile/impProfileService.php';
include '../../core/support/session.php';

use service\profile\impProfileService as profile;
$profile = new profile();



if(isset($_FILES['file']['name'])){

  /* Getting file name */
  $filename = $_FILES['file']['name'];

  /* Location */
  $location = "../../storage/uploads/".$filename;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
  $imageFileType = strtolower($imageFileType);

  /* Valid extensions */
  $valid_extensions = array("jpg","jpeg","png");

  $response = 0;
  /* Check file extension */
  if(in_array(strtolower($imageFileType), $valid_extensions)) {
     /* Upload file */
     if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){

      $response = $location;

       $profile->avatar($response);

     }
  }
  echo $response;

//   echo $response;
  exit;
}

echo 0;


// $target_dir = "uploads/";
// $target_file = $target_dir . basename($_FILES["fd"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fd"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fd"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fd"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["fd"]["name"])). " has been uploaded.";
//     // echo json_encode("")
//     echo json_encode(array("status"=>200));
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }
?>