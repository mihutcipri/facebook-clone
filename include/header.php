<?php

include 'connect/login.php';
include 'core/load.php';

if(login::isLoggedIn()){
    $userid = login::isLoggedIn();
}else{
header('location: sign.php');
}

if(isset($_GET['username']) == true && empty($_GET['username']) === false){
    $username = $loadFromUser->checkInput($_GET['username']);
    $profileId = $loadFromUser->userIdByUsername($username);
}else{
    $profileId = $userid;
}
    $profileData = $loadFromUser->userData($profileId);
    $userData = $loadFromUser->userData($userid);
    $requestCheck =$loadFromPost->requestCheck($userid, $profileId);
    $requestConf = $loadFromPost->requestConf($profileId, $userid);
    $followCheck= $loadFromPost->followCheck($profileId, $userid);

    $notification = $loadFromPost->notification($userid);
    $notificationCount = $loadFromPost->notificationCount($userid);
    $requestNotificationCount = $loadFromPost->requestNotificationCount($userid);
  $messageNotification = $loadFromPost->messageNotificationCount($userid);



?>

    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>
            <?php echo ''.$profileData->firstName.' '.$profileData->lastName.''; ?>
        </title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/dist/emojionearea.min.css">

        <style>


        </style>
    </head>

    <body>
        <div class="u_p_id" data-uid="<?php echo $userid ?>" data-pid="<?php echo $profileId ?>"></div>
           <header>
            <div class="top-bar">
                <div class="top-left-part">
                    <div class="profile-logo"><img src="assets/image/logo.jpg" alt=""></div>
                    <div class="search-wrap" style="display: inline;z-index:1;">
                        <div class="search-input" style="display:flex;justify-content:center;align-items:center;width:100%;">
                            <input type="text" name="main-search" id="main-search">
                            <div class="s-icon top-icon top-css">
                                <img src="assets/image/icons8-search-36.png" alt="">
                            </div>
                        </div>
                        <div id="search-show" style="position:relative;">
                            <div class="search-result" style="position:absolute;">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-right-part">
                    <div class="top-pic-name-wrap">
                        <a href="profile.php?username=<?php echo $userData->userLink; ?>" class="top-pic-name ">
                            <div class="top-pic"><img src="<?php echo $userData->profilePic; ?>" alt=""></div>
                            <span class="top-name top-css border-left ">
                            <?php echo $userData->firstName; ?>
                        </span>
                        </a>

                    </div>
                    <a href="index.php">
                        <span class="top-home top-css border-left">Home</span>
                    </a>
                    <div class="request-top-notification top-css top-icon border-left " style="position:relative;">
                        <?php if(empty(count($requestNotificationCount))){echo '<div class="request-count"></div>'; }else{echo '<div class="request-count">'.count($requestNotificationCount).'</div>'; } ?>

                        <svg xmlns="http://www.w3.org/2000/svg" class="request-svg" viewBox="0 0 15.8 13.63" style="height:20px; width:20px;"><defs><style>.cls-1{fill:#1a2947;}</style></defs><title>request</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1 <?php if(empty(count($requestNotificationCount))){}else{echo 'active-noti'; }?>" d="M13.2,7.77a7.64,7.64,0,0,0-1.94-.45,7.64,7.64,0,0,0-1.93.45,3.78,3.78,0,0,0-2.6,3.55.7.7,0,0,0,.45.71,12.65,12.65,0,0,0,4.08.59A12.7,12.7,0,0,0,15.35,12a.71.71,0,0,0,.45-.71A3.79,3.79,0,0,0,13.2,7.77Z"/><ellipse class="cls-1 <?php if(empty(count($requestNotificationCount))){}else{echo 'active-noti'; }?>" cx="11.34" cy="4.03" rx="2.48" ry="2.9"/><path class="cls-1 <?php if(empty(count($requestNotificationCount))){}else{echo 'active-noti'; }?>" d="M7.68,7.88a9,9,0,0,0-2.3-.54,8.81,8.81,0,0,0-2.29.54A4.5,4.5,0,0,0,0,12.09a.87.87,0,0,0,.53.85,15.28,15.28,0,0,0,4.85.68,15.25,15.25,0,0,0,4.85-.68.87.87,0,0,0,.53-.85A4.49,4.49,0,0,0,7.68,7.88Z"/><ellipse class="cls-1 <?php if(empty(count($requestNotificationCount))){}else{echo 'active-noti'; }?>" cx="5.47" cy="3.44" rx="2.94" ry="3.44"/></g></g></svg>
                        <div class="request-notification-list-wrap">

                            <ul style="margin:0; padding:0;" class="notify-ul">
                                <?php if(empty($requestNotificationCount)){}else{
                                foreach($requestNotificationCount as $notify){

                                ?>

                                <li class="item-notification-wrap <?php echo ($notify->status == '0') ? 'unread-notification': 'read-notification' ?>" data-postid="<?php echo $notify->postid; ?>" data-notificationid="<?php echo $notify->ID; ?>" data-profileid="<?php echo $notify->userId; ?>">
                                    <?php if($notify->type == 'request'){ ?>
                                    <a href="<?php echo $notify->userLink; ?>" target="_blank" class="item-notification">

                                        <?php }else if($notify->type == 'message'){

                                }else{ ?>
                                        <a href="post.php?username=<?php echo $notify->userLink; ?>&postid=<?php echo $notify->postid; ?>&profileid=<?php echo $notify->userId; ?>" target="_blank" class="item-notification">
                                            <?php } ?>
                                            <img src="<?php echo $notify->profilePic; ?>" style="height:40px; width:40px; border-radius:50%;" alt="">
                                            <div class="notification-type-details">
                                                <span style="font-weight:600; font-size:14px; color:#CDDC39;margin-left:5px;">
                                   <?php echo ''.$notify->firstName.' '.$notify->lastName.''; ?></span>
                                                <?php echo ($notify->type == 'comment') ? 'commented on your <span>post</span>' : (($notify->type == 'postReact')? 'reacted on your <span>post</span>' : (($notify->type=='request' && $notify->friendStatus == '1' && $notify->notificationFrom == $userid  ) ? 'accepted your friend request': (($notify->type=='request'  && $notify->notificationFor == $userid && $notify->notificationCount=='0'  )? 'Sent you a friend request': 'reacted on your <span>comment</span>'))); ?>

                                            </div>
                                        </a>
                                </li>

                                <?php  }  }  ?>
                            </ul>
                        </div>

                    </div>
                    <a href="messenger.php" class="message-top-notification">

                        <div class="top-messenger top-css top-icon border-left " style="position:relative;">
                            <?php if(empty(count($messageNotification))){echo '<div class="message-count"></div>'; }else{echo '<div class="message-count">'.count($messageNotification).'</div>'; } ?>
                            <svg xmlns="http://www.w3.org/2000/svg" class="message-svg" style="height:20px; width:20px;" viewBox="0 0 12.64 13.64"><defs><style>.cls-1{fill:#1a2947;}</style></defs><title>message</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1 <?php if(empty(count($messageNotification))){}else{echo 'msg-active-noti'; }?>"  d="M6.32,0A6.32,6.32,0,0,0,1.94,10.87c.34.33-.32,2.51.09,2.75s1.79-1.48,2.21-1.33a6.22,6.22,0,0,0,2.08.35A6.32,6.32,0,0,0,6.32,0Zm.21,8.08L5.72,6.74l-2.43,1,2.4-3,.84,1.53,2.82-.71Z"/></g></g></svg>
                        </div>
                    </a>
                    <div class="top-notification top-css top-icon border-left " style="position: relative;">
                        <?php if(empty(count($notificationCount))){echo '<div class="notification-count"></div>'; }else{echo '<div class="notification-count">'.count($notificationCount).'</div>'; } ?>

                        <svg xmlns="http://www.w3.org/2000/svg" class="notification-svg" style="height:20px; width:20px;" viewBox="0 0 12.06 13.92"><defs><style>.cls-1{fill:#1a2947;}.cls-2{fill:none;stroke:#1a2947;stroke-miterlimit:10;}</style></defs><title>notification</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1  <?php if(empty(count($notificationCount))){}else{echo 'active-noti'; }?>" d="M11.32,9A10.07,10.07,0,0,0,7.65,2.1,2.42,2.42,0,0,0,4.8,2,9.66,9.66,0,0,0,.74,9a2,2,0,0,0-.25,2.81H11.57A2,2,0,0,0,11.32,9Z"/><path class="cls-1 <?php if(empty(count($notificationCount))){}else{echo 'active-noti'; }?>" d="M8.07,12.32a1.86,1.86,0,0,1-2,1.6,1.86,1.86,0,0,1-2-1.6"/><ellipse class="cls-2 <?php if(empty(count($notificationCount))){}else{echo 'active-noti2'; }?>" cx="6.17" cy="1.82" rx="1.21" ry="1.32"/></g></g></svg>
                        <div class="notification-list-wrap">
                            <ul style="margin:0; padding:0;" class="notify-ul">
                                <?php if(empty($notification)){}else{
                                foreach($notification as $notify){
                                    if($notify->type == 'request' || $notify->type == 'message'){}else{
                                ?>

                                <li class="item-notification-wrap <?php echo ($notify->status == '0') ? 'unread-notification': 'read-notification' ?>" data-postid="<?php echo $notify->postid; ?>" data-notificationid="<?php echo $notify->ID; ?>" data-profileid="<?php echo $notify->userId; ?>">
                                    <?php if($notify->type == 'request'){ ?>
                                    <a href="<?php echo $notify->userLink; ?>" target="_blank" class="item-notification">

                                        <?php }else if($notify->type == 'message'){

                                }else{ ?>
                                        <a href="post.php?username=<?php echo $notify->userLink; ?>&postid=<?php echo $notify->postid; ?>&profileid=<?php echo $notify->userId; ?>" target="_blank" class="item-notification">
                                            <?php } ?>
                                            <img src="<?php echo $notify->profilePic; ?>" style="height:40px; width:40px; border-radius:50%;" alt="">
                                            <div class="notification-type-details">
                                                <span style="font-weight:600; font-size:14px; color:#CDDC39;margin-left:5px;">
                                   <?php echo ''.$notify->firstName.' '.$notify->lastName.''; ?></span>
                                                <?php echo ($notify->type == 'comment') ? 'commented on your <span>post</span>' : (($notify->type == 'postReact')? 'reacted on your <span>post</span>' : (($notify->type=='request' && $notify->friendStatus == '1' && $notify->notificationFrom == $userid  ) ? 'Friend request accepted': (($notify->type=='request'  && $notify->notificationFor == $userid && $notify->notificationCount=='0' )? 'Sent you a friend request': 'reacted on your <span>comment</span>'))); ?>

                                            </div>
                                        </a>
                                </li>

                                <?php } } }  ?>
                            </ul>
                        </div>
                    </div>
                    <div class="top-help top-css top-icon border-left ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="help-svg" style="height:20px; width:20px;" viewBox="0 0 13.69 13.69"><defs><style>.cls-1{fill:#1a2947;}</style></defs><title>help</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M6.85,0a6.85,6.85,0,1,0,6.84,6.85A6.85,6.85,0,0,0,6.85,0ZM7.4,10.44a.77.77,0,0,1-.19.28.75.75,0,0,1-.28.18,1,1,0,0,1-.35.07,1,1,0,0,1-.35-.07.79.79,0,0,1-.29-.18.92.92,0,0,1-.19-.28,1,1,0,0,1-.06-.34,1,1,0,0,1,.06-.35,1.07,1.07,0,0,1,.19-.28,1,1,0,0,1,.64-.25.84.84,0,0,1,.35.07.75.75,0,0,1,.28.18.87.87,0,0,1,.19.28.81.81,0,0,1,.07.35A.8.8,0,0,1,7.4,10.44Zm1.48-5a1.93,1.93,0,0,1-.3.53,2.4,2.4,0,0,1-.39.39l-.41.31c-.12.09-.23.19-.33.28a.6.6,0,0,0-.17.31l-.14.78h-1L6,7.19a.76.76,0,0,1,.07-.46,1.35,1.35,0,0,1,.28-.36c.12-.1.25-.21.39-.31l.41-.32a1.9,1.9,0,0,0,.31-.39,1,1,0,0,0,.13-.51.72.72,0,0,0-.25-.58,1,1,0,0,0-.66-.21,1.75,1.75,0,0,0-.5.06l-.36.15-.25.14a.32.32,0,0,1-.2.07.34.34,0,0,1-.31-.18l-.4-.63a3.65,3.65,0,0,1,.43-.31,2.54,2.54,0,0,1,.49-.26,3.43,3.43,0,0,1,.57-.17,2.87,2.87,0,0,1,.67-.07A2.72,2.72,0,0,1,7.71,3a2.09,2.09,0,0,1,.69.38,1.86,1.86,0,0,1,.44.6A2,2,0,0,1,9,4.75,2.18,2.18,0,0,1,8.88,5.47Z"/></g></g></svg>
                    </div>
                    <div class="top-more top-css top-icon border-left ">
                        <div class="watchmore-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="more-svg" style="height:20px; width:20px;" viewBox="0 0 14.54 6.57"><defs><style>.cls-1{fill:#1a2947;}</style></defs><title>more</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><polygon class="cls-1" points="0 0 14.54 0 7.27 6.57 0 0"/></g></g></svg>
                        </div>
                        <div class="setting-logout-wrap" style="position:relative;margin-top: 41px;display:none;">
                            <div class="s-1-wrap" style="position:absolute;background-color:white;color:gray;padding: 10px 10px; box-shadow: 0 0 5px gray; border-radius: 2px;    margin-left: -60px;">
                            <div class="setting-option align-middle" style="padding:10px;">
                                <img src="assets/image/setting.jpg" alt="" style="border-radius:50%; margin-right:5px;"> <div>Settings</div>
                            </div>
                               <div class="logout-option align-middle" style="padding:10px;">
                                <img src="assets/image/logout.jpg" alt="" style="border-radius:50%;margin-right:5px;"> <div>Logout</div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>