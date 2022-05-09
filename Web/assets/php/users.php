<?php

$users = array();

$url = 'http://localhost:5000/get_users';
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
  $users = explode('|', $json['users']);
  array_pop($users);
}

?>