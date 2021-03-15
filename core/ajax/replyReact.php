<?php

include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();

if(isset($_POST['commentid'])){
    $commentid = $_POST['commentid'];
    $reactType = $_POST['reactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $commentparentid = $_POST['commentparentid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn'=>$commentid, 'reactReplyOn'=>$commentparentid));

    $loadFromUser->create('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn'=>$commentid, 'reactReplyOn'=>$commentparentid, 'reactType'=>$reactType, 'reactTimeOn' =>date('Y-m-d H:i:s')));

    if($profileid != $userid){

    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'commentReact', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

                    $reply_react_count = $loadFromPost->reply_main_react_count($postid, $commentid, $commentparentid);
                     $reply_react_max_show = $loadFromPost->reply_react_max_show($postid, $commentid, $commentparentid);

                     if(empty($reply_react_count) || empty($reply_react_max_show)){}else{

                         ?>
    <div class="com-nf-3 align-middle">
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
                foreach($reply_react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;">';
                }
?>
            </div>
        </div>
        <div class="nf-3-react-username">
            <?php if($reply_react_count->maxreact == '0'){}else{
            echo $reply_react_count->maxreact;
                } ?>
        </div>
    </div>


    <?php

}


}

if(isset($_POST['delcommentid'])){
    $delcommentid = $_POST['delcommentid'];
    $deleteReactType = $_POST['deleteReactType'];
    $postid = $_POST['postid'];
    $userid = $_POST['userid'];
    $commentparentid = $_POST['commentparentid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->delete('react', array('reactBy' => $userid, 'reactOn' => $postid, 'reactCommentOn'=>$delcommentid, 'reactReplyOn'=>$commentparentid));

                    $reply_react_count = $loadFromPost->reply_main_react_count($postid, $delcommentid, $commentparentid);
                     $reply_react_max_show = $loadFromPost->reply_react_max_show($postid, $delcommentid, $commentparentid);

                     if(empty($reply_react_count) || empty($reply_react_max_show)){}else{

                         ?>
    <div class="com-nf-3 align-middle">
        <div class="nf-3-react-icon">
            <div class="react-inst-img align-middle">
                <?php
                foreach($reply_react_max_show as $react_max){
                echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;';
                }
?>
            </div>
        </div>
        <div class="nf-3-react-username">
            <?php if($reply_react_count->maxreact == '0'){}else{
            echo $reply_react_count->maxreact;
                } ?>
        </div>
    </div>


    <?php

}

}


?>
