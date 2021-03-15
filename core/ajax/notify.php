<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['notificationUpdate'])){
$userid = $_POST['notificationUpdate'];

    $notification = $loadFromPost->notificationCount($userid);

    echo count($notification);



}
if(isset($_POST['requestNotificationUpdate'])){
$userid = $_POST['requestNotificationUpdate'];

    $notification = $loadFromPost->requestNotificationCount($userid);

    echo count($notification);



}
if(isset($_POST['messageNotificationUpdate'])){
$userid = $_POST['messageNotificationUpdate'];

    $notification = $loadFromPost->messageNotificationCount($userid);

    echo count($notification);



}

if(isset($_POST['notify'])){
$userid = $_POST['notify'];

   $loadFromPost->notificationCountReset($userid);


}
if(isset($_POST['requestNotify'])){
$userid = $_POST['requestNotify'];

   $loadFromPost->notificationCountReset2($userid, 'request');


}if(isset($_POST['messageNotify'])){
$userid = $_POST['messageNotify'];

   $loadFromPost->notificationCountReset2($userid, 'message');


}
if(isset($_POST['statusUpdate'])){
$userid = $_POST['statusUpdate'];
    $profileid = $_POST['profileid'];
    $notificationId = $_POST['notificationId'];
    $postid = $_POST['postid'];
    $notification = $loadFromPost->notificationStatusUpdate($userid, $notificationId);


}