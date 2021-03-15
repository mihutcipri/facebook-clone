<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if(isset($_POST['profileid'])){
    $profileid = $_POST['profileid'];
    $userid = $_POST['userid'];

    $loadFromUser->create('block', array('blockerID'=>$userid, 'blockedID'=>$profileid, 'blockOn'=>date('Y-m-d H:i:s')));

    $loadFromUser->delete('request', array('reqtReceiver'=>$profileid, 'reqtSender'=>$userid));

    $loadFromUser->delete('request', array('reqtReceiver'=>$userid, 'reqtSender'=>$profileid));

       $loadFromUser->delete('follow', array('sender'=>$userid, 'receiver' =>$profileid));
       $loadFromUser->delete('follow', array('sender'=> $profileid, 'receiver' => $userid));



}

?>
