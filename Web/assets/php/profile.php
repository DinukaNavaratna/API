<?php

$userid = $_SESSION["user_id"];
$editable = True;
$show_approve = False;
$approved = False;
$edit = False;

if(isset($_GET['edit'])){
    $edit = True;
}

if($_SESSION["user_type"] != "1"){
    if(!isset($_GET['user'])){
        exit("User not found!");
    } else {
        $userid = $_GET['user'];
    }
    $editable = False;
    $edit = False;
} else if($_SESSION["user_type"] != "2" && $_SESSION["user_type"] != "3"){
    $show_approve = True;
}



$firstname = "";
$lastname = "";
$email = "";
$fullname = "";
$skill1 = "";
$skill2 = "";
$skill3 = "";
$designation = "Designation";
$mobile = "";
$address = "";
$city = "";
$postalcode = "";
$country = "";
$dob = "";
$nic = "";
$about = "";
$industry = "";
$highest_education = "";
$expected_salary = "";
$profile_status = "";
$c1_id = "";
$c1_msg = "";
$c1_time = "";
$c2_id = "";
$c2_msg = "";
$c2_time = "";
$c3_id = "";
$c3_msg = "";
$c3_time = "";
$imageurl = "https://static.vecteezy.com/system/resources/thumbnails/005/544/718/small/profile-icon-design-free-vector.jpg";


$url = 'http://localhost:5000/get_user_1/'.$userid;
$data = array(
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'GET',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
  echo "Error";
} else {
  $json = json_decode(json_decode($result, true), true);
  $firstname = $json['fname'];
  $lastname = $json['lname'];
  $email = $json['email'];
  $fullname = $json['fname']." ".$json['lname'];
  $c1_id = $json['c1_id'];
  $c1_msg = $json['c1_msg'];
  $c1_time = $json['c1_time'];
  $c2_id = $json['c2_id'];
  $c2_msg = $json['c2_msg'];
  $c2_time = $json['c2_time'];
  $c3_id = $json['c3_id'];
  $c3_msg = $json['c3_msg'];
  $c3_time = $json['c3_time'];
}


$url = 'http://localhost:5000/get_user_2/'.$userid;
$data = array(
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'GET',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
  echo "Error";
} else {
  $json = json_decode(json_decode($result, true), true);
  $designation = $json['current_job_title'];
  $mobile = $json['mobile'];
  $address = $json['address_home'];
  $city = $json['address_city'];
  $postalcode = $json['address_postal_code'];
  $country = $json['address_country'];
  $dob = $json['dob'];
  $nic = $json['nic'];;
  $about = $json['about'];
  $industry = $json['industry'];
  $highest_education = $json['highest_education'];
  $expected_salary = $json['expected_salary'];
  $profile_status = $json['profile_status'];
  $skill1 = $json['skill1'];
  $skill2 = $json['skill2'];
  $skill3 = $json['skill3'];
}

if($profile_status == "1"){
    $approved = True;
}


$filename_bc = "My BC";
$filename_cv = "My CV";
$filename_nic = "My NIC";
$filename_other = "Other Docs";



?>