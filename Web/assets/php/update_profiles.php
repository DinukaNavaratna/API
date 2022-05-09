<?php
    
session_start();

if(isset($_POST['func'])){
  $url = '';
  if($_POST['func'] == "update"){
    $url = 'http://localhost:5000/update/'.$_POST['userid'];
    $data = array(
      'user_designation' => $_POST['user_designation'],
      'user_mobile' => $_POST['user_mobile'],
      'user_industry' => $_POST['user_industry'],
      'user_highest_education' => $_POST['user_highest_education'],
      'user_expected_salary' => $_POST['user_expected_salary'],
      'user_address' => $_POST['user_address'],
      'user_nic' => $_POST['user_nic'],
      'user_dob' => $_POST['user_dob'],
      'user_country' => $_POST['user_country'],
      'user_postcode' => $_POST['user_postcode'],
      'user_city' => $_POST['user_city'],
      'user_about' => $_POST['user_about'],
      'user_skill1' => $_POST['user_skill1'],
      'user_skill2' => $_POST['user_skill2'],
      'user_skill3' => $_POST['user_skill3']
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'PUT',
            'content' => json_encode($data)
        )
    );
  } else if($_POST['func'] == "approve" || $_POST['func'] == "disapprove"){
    $url = 'http://localhost:5000/approval/'.$_POST['userid'];
    $data = array();
    if($_POST['func'] == "approve"){
      $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'PUT',
            'content' => json_encode($data)
          )
      );
    } else if($_POST['func'] == "disapprove"){
      $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'DELETE',
            'content' => json_encode($data)
          )
      );
    }
  }

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  if ($result === FALSE) {
    echo "Error";
  } else {
    $json = json_decode(json_decode($result, true), true);
    if($json["msg"] == "success"){
      echo $json["msg"];
    } else {
      echo $json["msg"]." - ".$json['response'];
    }
  }
}
exit();

?>