<?php

    session_start();
    if(!isset($_SESSION["user_id"]) && !(strpos($_SERVER['REQUEST_URI'], "login") || strpos($_SERVER['REQUEST_URI'], "register"))){
        header("Location: login.php");
        die();
    } else if(isset($_SESSION["user_id"]) && (strpos($_SERVER['REQUEST_URI'], "login") || strpos($_SERVER['REQUEST_URI'], "register"))){
        header("Location: index.php");
        die();
    }

?>