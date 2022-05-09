<?php

$userid = $_SESSION["user_id"];
$usertpe = $_SESSION["user_type"];
$complaintid = 0;
if(isset($_GET['id'])){
    $complaintid = $_GET['id'];
}

$msgs = array();

$url = 'http://localhost:5000/complaints';
$data = array(
    'complaintid' => $complaintid
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
  $msgs = explode('|', $json['msgs']);
  array_pop($msgs);
}

?>