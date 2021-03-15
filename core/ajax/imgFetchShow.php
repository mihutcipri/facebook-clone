<?php
include '../load.php';
include '../../connect/login.php';


$userid = login::isLoggedIn();

if(isset($_POST['fetchImgInfo'])){
    $userid = $_POST['fetchImgInfo'];
    $postid = $_POST['postid'];
    $imgSrc = $_POST['imageSrc'];
            $main_react = $loadFromPost->main_react($userid, $postid);
            $react_max_show = $loadFromPost->react_max_show($postid);
            $main_react_count = $loadFromPost-> main_react_count($postid);

            $commentDetails = $loadFromPost->commentFetch($postid);
            $totalCommentCount = $loadFromPost->totalCommentCount($postid);
            $totalShareCount = $loadFromPost->totalShareCount($postid);

            ?>
    <div class="top-wrap" style="position:fixed;top:0px; bottom:0px;right:0px;justify-content:center;left:0px;display:flex;background-color:#000000c4;    z-index: 99;">
        <div class="post-img-wrap" style="display:flex;background-color:white;width:70%;justify-content:center;align-items:center; height:100vh;">
            <div class="post-img-action" style="background-color:#0000008c; height:100%; align-items:center;display:flex;">
                <img src="<?php echo $imgSrc; ?>" alt="" style="width:500px;">
            </div>
            <div class="post-img-details" style="width:100%; padding:20px;align-self:flex-start;">

                <div class="nf-3">

                    <div class="react-comment-count-wrap" style="width:100%; display:flex; justify-content:space-between; align-items:center;">
                        <div class="react-count-wrap align-middle">
                            <div class="nf-3-react-icon">
                                <div class="react-inst-img align-middle">
                                    <?php
            foreach($react_max_show as $react_max){
echo '<img class = "'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:15px; width:15px; margin-right:2px; cursor:pointer;">';
            }

            ?>
                                </div>
                            </div>
                            <div class="nf-3-react-username">
                                <?php
            if($main_react_count->maxreact == '0'){}else{
                echo $main_react_count->maxreact;
            }            ?>
                            </div>
                        </div>
                        <div class="comment-share-count-wrap align-middle" style="font-size:13px; color:gray;">
                            <div class="comment-count-wrap" style="margin-right:10px;">
                                <?php if(empty($totalCommentCount->totalComment)){}else{
                echo ''.$totalCommentCount->totalComment.' comments';
            } ?>
                            </div>
                            <div class="share-count-wrap">
                                <?php if(empty($totalShareCount->totalShare)){}else{ echo ''.$totalShareCount->totalShare.' Share'; } ?>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="nf-4">
                    <div class="like-action-wrap" data-postid="<?php echo $postid; ?>" data-userid="<?php echo $userid; ?>" style="position:relative;">
                        <div class="react-bundle-wrap">

                        </div>

                        <div class="like-action ra">
                            <?php  if(empty($main_react)){ ?>
                            <div class="like-action-icon">
                                <img src="assets/image/likeAction.JPG" alt="">
                            </div>
                            <div class="like-action-text"><span>Like</span></div>

                            <?php }else{
            ?>

                            <div class="like-action-icon" style="display: flex;align-items: center;">
                                <img src="assets/image/react/<?php echo $main_react->reactType; ?>.png" alt="" class="reactIconSize" style="margin-top:0;">
                                <div class="like-action-text"><span class="<?php echo $main_react->reactType;  ?>-color"><?php echo $main_react->reactType; ?></span></div>
                            </div>







                            <?php
        } ?>
                        </div>

                    </div>
                    <div class="comment-action ra">
                        <div class="comment-action-icon">
                            <img src="assets/image/commentAction.JPG" alt="">
                        </div>
                        <div class="comment-action-text">
                            <div class="comment-count-text-wrap">
                                <div class="comment-wrap"></div>
                                <div class="comment-text">Comment</div>
                            </div>
                        </div>
                    </div>
                    <div class="share-action ra" data-postid="<?php echo $postid; ?>" data-userid="<?php echo $userid ?>" data-profileid="<?php echo $profileId; ?>" data-profilePic="<?php echo $post->profilePic; ?>">
                        <div class="share-action-icon">
                            <img src="assets/image/shareAction.JPG" alt="">
                        </div>
                        <div class="share-action-text">Share</div>
                    </div>

                </div>

                <div class="nf-5">
                    <div class="comment-list">
                        <ul class="add-comment" style="height: 75vh;overflow-y: scroll;">
                            <?php
if(!empty($commentDetails)){
             foreach($commentDetails as $comment){
                 $com_react_max_show = $loadFromPost->com_react_max_show($comment->commentOn, $comment->commentID);
                 $com_main_react_count = $loadFromPost->com_main_react_count($comment->commentOn, $comment->commentID);
                 $commentReactCheck = $loadFromPost->commentReactCheck($userid, $comment->commentOn, $comment->commentID);



            ?>
                                <li class="new-comment">
                                    <div class="com-details">
                                        <div class="com-pro-pic">
                                            <a href="#">
                                                <span class="top-pic"><img src="<?php echo $comment->profilePic; ?>" alt=""></span>
                                            </a>
                                        </div>
                                        <div class="com-pro-wrap">
                                            <div class="com-text-react-wrap">
                                                <div class="com-text-option-wrap align-middle">
                                                    <div class="com-pro-text align-middle">
                                                        <div class="com-react-placeholder-wrap align-middle">
                                                            <div>
                                                                <span class="nf-pro-name">
                                                            <a href="" class="nf-pro-name"><?php echo ''.$comment->firstName.' '.$comment->lastName.'' ?> </a>
                                                        </span>
                                                                <span class="com-text" style="margin-left:5px; " data-postid="<?php echo $comment->commentOn; ?> " data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $comment->commentID;  ?>" data-profilepic="<?php echo $userdata->profilePic; ?>"><?php echo $comment->comment; ?></span>
                                                            </div>
                                                            <div class="com-nf-3-wrap">
                                                                <?php
                                                            if($com_main_react_count->maxreact == '0'){}else{
                                                                ?>
                                                                    <div class="com-nf-3 com- align-middle">
                                                                        <div class="nf-3-react-icon">
                                                                            <div class="react-inst-img align-middle">
                                                                                <?php
                                                                foreach($com_react_max_show as $react_max){
                                                                    echo '<img class="'.$react_max->reactType.'-max-show" src="assets/image/react/'.$react_max->reactType.'.png" alt="" style="height:12px; width:12px;margin-right:2px;cursor:pointer;">';
                                                                }
                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="nf-3-react-username">
                                                                            <?php
                                                                if($com_main_react_count->maxreact == '0'){}else{echo $com_main_react_count->maxreact;}
                                                                ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                            }


                                                            ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if($userid == $comment->commentBy){
                                                        ?>
                                                        <div class="com-dot-option-wrap">
                                                            <div class="com-dot" style="color:gray; margin-left:5px; cursor:pointer;font-weight:600;" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $comment->commentID; ?>">...</div>
                                                            <div class="com-option-details-container">

                                                            </div>
                                                        </div>

                                                        <?php
                                                    }else{}
                                                    ?>
                                                </div>
                                                <div class="com-react">
                                                    <div class="com-like-react" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $comment->commentID; ?>">
                                                        <div class="com-react-bundle-wrap" data-commentid="<?php echo $comment->commentID; ?>"></div>
                                                        <?php
                                                    if(empty($commentReactCheck)){
                                                        echo '<div class="com-like-action-text"><span>Like</span></div>';
                                                    }else{
                                                        echo '<div class="com-like-action-text"><span class="'.$commentReactCheck->reactType.'-color">'.$commentReactCheck->reactType.'</span></div>';
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="com-reply-action" data-postid="<?php echo $comment->commentOn; ?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $comment->commentID; ?>" data-profilepic="<?php echo $userdata->profilePic;?>">
                                                        Reply
                                                    </div>
                                                    <div class="com-time">
                                                        <?php echo $loadFromPost->timeAgo($comment->commentAt); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="reply-wrap">
                                                <div class="reply-text-wrap">
                                                    <ul class="old-reply">
                                                        <?php
                 $replyDetails = $loadFromPost->replyFetch($comment->commentOn, $comment->commentID);

                 foreach($replyDetails as $reply){
                     $reply_react_count = $loadFromPost->reply_main_react_count($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $reply_react_max_show = $loadFromPost->reply_react_max_show($reply->commentOn, $reply->commentID, $reply->commentReplyID);
                     $replyReactCheck = $loadFromPost->replyReactCheck($userid, $reply->commentOn, $reply->commentID, $reply->commentReplyID);
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
                                                                            <div class="reply-text-option-wrap align-middle" style="justify-content: flex-start;">
                                                                                <div class="com-pro-text align-middle">
                                                                                    <a href="">
                                                                                        <span class="nf-pro-name"><?php echo ''.$reply->firstName.' '.$reply->lastName.'' ?></span>
                                                                                    </a>

                                                                                    <div class="com-react-placeholder-wrap align-middle">
                                                                                        <div class="com-text" data-commentid="<?php echo $comment->commentID; ?>" data-postid="<?php echo $comment->commentOn;?>" data-profilepic="<?php echo $userdata->profilePic; ?>" data-replyid="<?php echo $reply->commentID; ?>" data-userid="<?php echo $userid;?>" style="margin-left:5px;">
                                                                                            <?php echo $reply->comment; ?>
                                                                                        </div>
                                                                                        <div class="com-nf-3-wrap">
                                                                                            <?php
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
                     ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="reply-dot-option-wrap">
                                                                                    <div class="reply-dot" style="margin-left:5px;cursor:pointer;color:gray;" data-postid="<?php echo $comment->commentOn?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $comment->commentID; ?>" data-replyid="<?php echo $reply->commentID; ?>">
                                                                                        ...
                                                                                    </div>
                                                                                    <div class="reply-option-details-container"></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="com-react">
                                                                                <div class="com-like-react-reply" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">
                                                                                    <div class="com-react-bundle-wrap reply" data-commentid="<?php
                    echo $reply->commentID; ?>" data-commentparentid="<?php echo $reply->commentReplyID; ?>">

                                                                                    </div>
                                                                                    <?php if(empty($replyReactCheck)){
                        echo '<div class="reply-like-action-text"><span>Like</span></div>';
                    }else{echo '<div class="reply-like-action-text"><span class="'.$replyReactCheck->reactType.'-color">'.$replyReactCheck->reactType.'</span></div>';} ?>

                                                                                </div>
                                                                                <div class="com-reply-action-child" style="cursor:pointer;" data-postid="<?php echo $reply->commentOn; ?>" data-userid="<?php echo $userid; ?>" data-commentid="<?php echo $reply->commentReplyID; ?>" data-profilepic="<?php echo $userdata->profilePic; ?>">
                                                                                    Reply
                                                                                </div>
                                                                                <div class="com-time">
                                                                                    <?php echo  $loadFromPost->timeAgoForCom($reply->commentAt);  ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <?php
                 }


                 ?>
                                                    </ul>
                                                </div>
                                                <div class="replyInput">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
   }
             }
    ?>

                        </ul>
                    </div>
                    <div class="comment-write">
                        <div class="com-pro-pic" style="margin-top:4px;">
                            <a href="#">
                                <span class="top-pic"><img src="<?php echo $userdata->profilePic; ?>" alt=""></span>
                            </a>
                        </div>
                        <div class="com-input">
                            <div class="comment-input" style="flex-basis:90%;">
                                <input type="text" name="" id="" class="comment-input-style comment-submit" placeholder="Write a comment..." data-postid="<?php echo $postid; ?>" data-userid="<?php echo $userid; ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
}
?> ?>
