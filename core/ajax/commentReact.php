<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['commentid'])){
    $commentid = $_POST['commentid'];
    $reactType = $_POST['reactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->delete('react', array('reactBy'=>$userid, 'reactOn' => $postid, 'reactCommentOn'=>$commentid));

    $loadFromUser->create('react', array('reactBy'=>$userid, 'reactOn'=>$postid, 'reactCommentOn'=>$commentid, 'reactType'=>$reactType, 'reactTimeOn'=>date('Y-m-d H:i:s')));

    if($profileid != $userid){

    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'commentReact', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

    $com_react_max_show = $loadFromPost->com_react_max_show($postid, $commentid);
    $com_main_react_count = $loadFromPost->com_main_react_count($postid, $commentid);

    ?>
    <div class="com-nf-3 align-middle">
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
    foreach($com_react_max_show as $react_max){
        echo '<img class="'.$react_max->reactType.'-max-show" id="'.$react_max->reactType.'" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:13px;width:13px: margin-right:2px; cursor:pointer;">';
    }
    ?>
            </div>
        </div>
        <div class="nf-3-react-username" style="font-size:12px;">
            <?php
    if($com_main_react_count->maxreact == 0){}else{echo $com_main_react_count->maxreact; }
    ?>
        </div>
    </div>
    <?php
}

    if(isset($_POST['deleteReactType'])){
        $deleteReactType = $_POST['deleteReactType'];
        $delCommentid = $_POST['delCommentid'];
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];
        $profileid = $_POST['profileid'];

        $loadFromUser->delete('react', array('reactBy'=>$userid, 'reactOn'=>$postid, 'reactCommentOn'=>$delCommentid));
        $com_react_max_show = $loadFromPost->com_react_max_show($postid, $delCommentid);
    $com_main_react_count = $loadFromPost->com_main_react_count($postid, $delCommentid);
        if(!empty($com_react_max_show)){
        ?>
        <div class="com-nf-3 align-middle">
            <div class="nf-3-react-icon">
                <div class="react-inst-img align-middle">
                    <?php
         if($com_main_react_count->maxreact == '0'){}else{
    foreach($com_react_max_show as $react_max){
        echo '<img class="'.$react_max->reactType.'-max-show" id="'.$react_max->reactType.'" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:13px;width:13px: margin-right:2px; cursor:pointer;">';
    }
    ?>
                </div>
            </div>
            <div class="nf-3-react-username" style="font-size:12px;">
                <?php
    if($com_main_react_count->maxreact == 0){}else{echo $com_main_react_count->maxreact; }
    ?>
            </div>
        </div>

        <?php
         }
            }
    }

    ?>
