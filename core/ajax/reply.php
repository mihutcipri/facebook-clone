<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if(isset($_POST['replyComment'])){
    $comment_text = $loadFromUser->checkInput($_POST['replyComment']);
    $userid=$_POST['userid'];
    $postid=$_POST['postid'];
    $commentid=$_POST['commentid'];
    $profileid = $_POST['profileid'];

    $replyCommentId = $loadFromUser->create('comments', array('commentBy'=>$userid, 'comment_parent_id'=> $postid, 'commentReplyID' => $commentid, 'comment' =>$comment_text, 'commentOn'=>$postid, 'commentAt'=>date('Y-m-d H:i:s')));

if($profileid != $userid){

    $loadFromUser->create('notification',array('notificationFrom'=>$userid, 'notificationFor' => $profileid, 'postid' => $postid, 'type'=>'comment', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }

    $replyDetails = $loadFromPost->lastReplyFetch($replyCommentId);

    foreach($replyDetails as $reply){
                     $reply_react_count = $loadFromPost->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $reply_react_max_show = $loadFromPost->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $replyReactCheck = $loadFromPost->replyReactCheck($user_id, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     ?>

    <li class="new-reply" style="margin-top:10px">
        <div class="com-details">
            <div class="com-pro-pic">
                <a href="">
                    <div class="top-pic"><img src="<?php echo $reply->profilePic ?>" alt=""></div>
                </a>
            </div>
            <div class="com-pro-wrap">
                <div class="com-text-react-wrap">
                    <div class="reply-text-option-wrap align-middle">
                        <div class="com-pro-text align-middle">
                            <a href="">
                                <span class="nf-pro-name"><?php echo ''.$reply->firstName.' '.$reply->lastName.'' ?></span>
                            </a>

                            <div class="com-react-placeholder-wrap align-middle">
                                <div class="com-text" data-commentid="<?php echo $comment->commentID; ?>" data-postid="<?php echo $comment->commentOn;?>" data-profilepic="<?php echo $userdata->profilepic; ?>" data-replyid="<?php echo $reply->commentID; ?>" data-userid="<?php echo $user_id;?>" style="margin-left:5px;">
                                    <?php echo $reply->comment; ?>
                                </div>
                                <div class="com-nf-3-wrap">
                                    <?php
                     if($reply_react_count == '0'){}else{

                         ?>
                                        <div class="com-nf-3 align-middle">
                                            <div class="nf-3-react-icon">
                                                <div class="react-inst-img align-middle">
                                                    <?php
                foreach($reply_react_max_show as $react_max){
                echo '<img class="'.$react_max_show->reactType.'-max-show" src="assets/images/react/'.$react_max->reactType.'.png" alt="" style="height:12px; width:12px; margin-right:2px; cursor:pointer;';
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
                     ?>
                                </div>
                            </div>
                        </div>
                        <div class="reply-dot-option-wrap">
                            <div class="reply-dot" style="margin-left:5px;cursor:pointer;color:gray;" data-postid="<?php echo $comment->commentOn?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $comment->commentID; ?>" data-replyid="<?php echo $reply->commentID; ?>">
                                ...
                            </div>
                            <div class="reply-option-details-container"></div>
                        </div>
                    </div>
                    <div class="com-react">
                        <div class="com-like-react-reply" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">
                            <div class="com-react-bundle-wrap reply" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">

                            </div>
                            <?php if(empty($replyReactCheck)){
                        echo '<div class="reply-like-action-text"><span>Like</span></div>';
                    }else{echo 'reply-'.$replyReactCheck->reactType.'-action-text"><span>'.$replyReactCheck->reactType.'</span></div>';} ?>

                        </div>
                        <div class="com-reply-action-child" style="cursor:pointer;" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $user_id; ?>" data-commentid="<?php echo $reply->commentReplyID; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">
                            Reply
                        </div>
                        <div class="com-time">
                            <?php echo  $loadFromPost->timeAgo($reply->commentAt);  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <?php
                 }
}



?>
