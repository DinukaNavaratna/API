<?php
    
session_start();

if(isset($_POST['func'])){
  $url = '';
  if($_POST['func'] == "send_msg"){
    $url = 'http://localhost:5000/complaints';
    $data = array(
      'userid' => $_POST['userid'],
      'complaintid' => $_POST['complaintid'],
      'msg' => $_POST['msg']
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'PUT',
            'content' => json_encode($data)
        )
    );
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