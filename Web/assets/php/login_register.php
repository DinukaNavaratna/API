<?php
    
session_start();

if(isset($_POST['func'])){
  $url = '';
  if($_POST['func'] == "register"){
    $url = 'http://localhost:5000/register';
    $data = array(
      'fname' => $_POST['register_fname'],
      'lname' => $_POST['register_lname'],
      'email' => $_POST['register_email'],
      'user_type' => $_POST['register_type'],
      'user_password' => $_POST['register_password']
    );
  } else if($_POST['func'] == "login"){
    $url = 'http://localhost:5000/login';
    $data = array(
      'email' => $_POST['login_email'],
      'password' => $_POST['login_password']
    );
  } else if($_POST['func'] == "logout"){
    unset($_SESSION['user_id']);
    echo "success";
    exit();
  }
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/json\r\n",
          'method'  => 'POST',
          'content' => json_encode($data)
      )
  );

  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  if ($result === FALSE) {
    echo "Error";
  } else {
    $json = json_decode(json_decode($result, true), true);
    if($json["msg"] == "success"){
      $_SESSION["user_id"] = $json['user_id'];
      $_SESSION["user_type"] = $json['user_type'];
      echo $json["msg"];
    } else {
      echo $json["msg"]." - ".$json['response'];
    }
  }
}
exit();


$url = 'http://localhost:5000/register';
$data = array(
  'email' => 'assd@gmai.com',
  'password' => '123456'
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
  echo "Error";
} else {
  $as = json_decode($result, true);
  echo $as['Ben'];
}

?>