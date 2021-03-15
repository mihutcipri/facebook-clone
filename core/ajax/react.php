<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['reactType'])){
$reactType = $_POST['reactType'];
$postid = $_POST['postId'];
$userid = $_POST['userId'];
$profileid = $_POST['profileid'];

   $loadFromUser->delete('react', array('reactBy'=>$userid, 'reactOn' => $postid, 'reactCommentOn' => '0', 'reactReplyOn'=>'0'));

    $loadFromUser->create('react',array('reactBy'=>$userid, 'reactOn' => $postid, 'reactType' => $reactType, 'reactTimeOn'=>date('Y-m-d H:i:s')));
    

    if($profileid != $userid){

    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'postReact', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

$react_max_show = $loadFromPost->react_max_show($postid);
$main_react_count = $loadFromPost->main_react_count($postid);

    ?>
    <div class="nf-3-react-icon">
        <div class="react-inst-img align-middle">
            <?php
    foreach($react_max_show as $react_max){
        echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">' ;
    }

    ?>
        </div>
    </div>
    <div class="nf-3-react-username">
        <?php
    if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact ;}
    ?>
    </div>

    <?php


}

if(isset($_POST['deleteReactType'])){
    $deleteReactType = $_POST['deleteReactType'];
$postid = $_POST['postId'];
$userid = $_POST['userId'];
$profileid = $_POST['profileid'];

    $loadFromUser->delete('react', array('reactBy'=>$userid, 'reactOn' => $postid, 'reactCommentOn' => '0', 'reactReplyOn'=>'0'));


$react_max_show = $loadFromPost->react_max_show($postid);
$main_react_count = $loadFromPost->main_react_count($postid);

    ?>
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
    foreach($react_max_show as $react_max){
        echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">' ;
    }

    ?>
            </div>
        </div>
        <div class="nf-3-react-username">
            <?php
    if($main_react_count->maxreact == '0'){}else{echo $main_react_count->maxreact ;}
    ?>
        </div>

        <?php
}
