<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if(isset($_POST['lastpersonid'])){
    $lastpersonid = $_POST['lastpersonid'];
    $userid = $_POST['userid'];
    $messageData = $loadFromPost->messageData($userid, $lastpersonid);

    foreach($messageData as $message){
if($message->messageFrom == $userid){ ?>

    <div class="right-msg">
        <div class="right-receiver-text-time">
            <div class="receiver-text" style="background-color:#03A9F4;color:white;"><?php echo $message->message; ?></div>
            <div class="receiver-time" style="margin-right:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
        </div>
        <div class="receiver-img">
            <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
        </div>
    </div>

    <?php
}else{ ?>
  <div class="left-msg">
       <div class="receiver-img">
            <img src="<?php echo $message->profilePic; ?>" alt="" style="height:30px; width:30px; border-radius:50%;">
        </div>
        <div class="receiver-text-time">
            <div class="receiver-text" style="background-color:ghostwhite;"><?php echo $message->message; ?></div>
            <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
        </div>

    </div>


<?php
}

    }






}


if(isset($_POST['loadUserid'])){
    $userid = $_POST['loadUserid'];

    $allusers= $loadFromPost->lastPersonWithAllUserMSG($userid);
    foreach($allusers as $user){ ?>
<li class="msg-user-name-wrap align-middle" data-profileid="<?php echo $user->user_id; ?>">
<div class="msg-user-photo-name-wrap align-middle" data-profileid="<?php echo $user->user_id; ?>">
    <div class="msg-user-photo">
        <img src="<?php echo $user->profilePic; ?>" alt="">
    </div>
    <div class="msg-user-name-text">
        <div class="msg-user-name">
            <?php echo ''.$user->firstName.' '.$user->lastName.''; ?>
        </div>
        <div class="msg-user-text">
           <div class="msg-previ">
            <?php echo $user->message; ?>
            </div>
            <div class="msg-date">
                <?php echo $loadFromUser->timeAgoForCom($user->messageOn); ?>
            </div>
        </div>
    </div>


</div>
<div class="msg-date-setting">
        <div class="msg-setting">
            <img src="../../facebook/assets/image/messenger/userSetting.JPG" alt="" class="msg-setting-img" >
        </div>
    </div>

</li>

   <?php
    }
}


?>