<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['postid'])){
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $editedTextVal = $_POST['editedTextVal'];
    $commentid = $_POST['commentid'];
    $replyid = $_POST['replyid'];

    $loadFromPost->replyUpd($userid, $postid, $editedTextVal,$replyid);

    echo $editedTextVal;


}

if(isset($_POST['deleteReply'])){
    $deleteReply = $_POST['deleteReply'];
    $userid = $_POST['userid'];
    $commentid = $_POST['commentid'];
    $replyid = $_POST['replyid'];

    $loadFromUser->delete('comments', array('commentID'=>$replyid, 'commentOn' =>$deleteReply, 'commentBy'=>$userid));

    $loadFromUser->delete('react', array('reactReplyOn'=>$replyid, 'reactBy'=>$userid, 'reactOn'=>$deleteReply));
}

?>