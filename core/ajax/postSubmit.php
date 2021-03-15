<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['onlyStatusText'])){
    $statusText = $_POST['onlyStatusText'];
      $mention_user = $_POST['mention_user'];
    $ment = str_replace('@', '', $mention_user);
    $ment_userlink = $ment[0];
   
    $mention_user_details = $loadFromPost->mention_user_details($ment_userlink);
    $mention_profileid = $mention_user_details->user_id;
    $postid = $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postedOn'=>date('Y-m-d H:i:s')));
    
    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $mention_profileid, 'postid'=> $postid, 'type'=>'mention', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    
    
    
}
if(isset($_POST['stIm'])){
    $stIm = $_POST['stIm'];
    $statusText = $_POST['statusText'];
    
    $mention_user = $_POST['mention_user'];
    $ment = str_replace('@', '', $mention_user);
    $ment_userlink = $ment[0];
    echo $ment_userlink;
    $mention_user_details = $loadFromPost->mention_user_details($ment_userlink);
    $mention_profileid = $mention_user_details->user_id;

    $postid = $loadFromUser->create('post', array('userId'=>$userid, 'post'=>$statusText, 'postBy'=>$userid, 'postImage'=>$stIm, 'postedOn'=>date('Y-m-d H:i:s')));
    
      $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $mention_profileid, 'postid'=> $postid, 'type'=>'mention', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
}


?>
