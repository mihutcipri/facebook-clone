<?php

include '../load.php';
include '../../connect/login.php';

$userid =login::isLoggedIn();

if(isset($_POST['sharedPostid'])){
$postid = $_POST['sharedPostid'];
    $userid = $_POST['userid'];
    $editedTextVal = $_POST['editedTextVal'];

    $loadFromPost->sharedPostUpd($userid, $postid,$editedTextVal);

    echo $editedTextVal;
}
if(isset($_POST['deletePost'])){
$postid = $_POST['deletePost'];
    $userid = $_POST['userid'];
 $loadFromUser->delete('post',array('post_id'=>$postid, 'userId'=>$userid));
    $loadFromUser->delete('comments', array('commentOn'=>$postid, 'commentBy'=>$userid));
    $loadFromUser->delete('react', array('reacBy'=>$userid, 'reactOn'=>$postid));

}



    ?>