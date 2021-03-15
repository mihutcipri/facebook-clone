<?php
include 'connect/login.php';
include 'core/load.php';


if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
}else{
    header('Location: sign.php');
}

$loadFromUser->delete('token', array('user_id'=>$userid));

if(isset($_COOKIE['FBID'])){
    unset($_COOKIE['FBID']);
    header('Refresh:0');
}


?>