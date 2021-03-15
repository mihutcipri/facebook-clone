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
                                    <img src="assets/image/setting.jpg" alt="" style="border-radius:50%; margin-right:5px;">
                                    <div>Settings</div>
                                </div>
                                <div class="logout-option align-middle" style="padding:10px;">
                                    <img src="assets/image/logout.jpg" alt="" style="border-radius:50%;margin-right:5px;">
                                    <div>Logout</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="main-area">

            </div>
            <div class="top-box-show"></div>
            <div id="adv_dem "></div>

        </main>




        <script src="assets/js/jquery.js "></script>
        <script src="assets/dist/emojionearea.min.js"></script>
        <!--        <script src="assets/js/main.js"></script>-->
        <script>
            $(function() {

                var u_id = $('.u_p_id').data('uid');
                var p_id = $('.u_p_id').data('pid');
                var BASE_URL = "http://localhost/facebook/";

                function notificationUpdate(userid) {
                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        notificationUpdate: userid
                    }, function(data) {
                        if (data.trim() == '0') {
                            $('.notification-count').empty();
                            $('.notification-count').css({
                                "background-color": "transparent"
                            });

                        } else {
                            $('.notification-count').html(data);
                            $('.notification-count').css({
                                "background-color": "red"
                            });



                            //
                        }
                    })
                }

                function requestNotificationUpdate(userid) {
                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        requestNotificationUpdate: userid
                    }, function(data) {
                        if (data.trim() == '0') {
                            $('.request-count').empty();
                            $('.request-count').css({
                                "background-color": "transparent"
                            });

                        } else {
                            $('.request-count').html(data);
                            $('.request-count').css({
                                "background-color": "red"
                            });

                        }
                    })
                }

                function messageNotificationUpdate(userid) {
                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        messageNotificationUpdate: userid
                    }, function(data) {
                        if (data.trim() == '0') {
                            $('.message-count').empty();
                            $('.message-count').css({
                                "background-color": "transparent"
                            });

                        } else {
                            $('.message-count').html(data);
                            $('.message-count').css({
                                "background-color": "red"
                            });

                        }
                    })
                }

                $(document).on('click', '.top-notification', function() {
                    $('.notification-list-wrap').toggle();
                    var userid = u_id;

                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        notify: userid
                    }, function(data) {

                    })
                })

                $(document).on('click', '.request-top-notification', function() {
                    $('.request-notification-list-wrap').toggle();
                    var userid = u_id;

                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        requestNotify: userid
                    }, function(data) {

                    })
                })
                $(document).on('click', '.message-top-notification', function() {

                    var userid = u_id;

                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        messageNotify: userid
                    }, function(data) {

                    })
                })



                var notificationInterval;
                var userid = u_id;
                notificationInterval = setInterval(function() {
                    notificationUpdate(userid);
                }, 1000);
                var requestNotificationInterval;
                var userid = u_id;
                requestNotificationInterval = setInterval(function() {
                    requestNotificationUpdate(userid);
                }, 1000);

                var messageNotificationInterval;
                var userid = u_id;
                messageNotificationInterval = setInterval(function() {
                    messageNotificationUpdate(userid);
                }, 1000);



                $(document).on('click', '.unread-notification', function() {
                    $(this).removeClass('unread-notification').addClass('read-notification');
                    var postid = $(this).data('postid');
                    var notificationId = $(this).data('notificationid');
                    var profileid = $(this).data('profileid');
                    var userid = u_id;
                    $.post('http://localhost/facebook/core/ajax/notify.php', {
                        statusUpdate: userid,
                        profileid: profileid,
                        postid: postid,
                        notificationId: notificationId
                    }, function(data) {

                    })
                })

                $('.profile-pic-upload').on('click', function() {
                    $('.top-box-show').html('<div class="top-box align-vertical-middle profile-dialoge-show "> <div class="profile-pic-upload-action "> <div class="pro-pic-up "> <div class="file-upload "> <label for="profile-upload " class="file-upload-label "> <snap class="upload-plus-text align-middle "> <snap class="upload-plus-sign ">+</snap>Upload Photo</snap> </label> <input type="file" name="file-upload " id="profile-upload " class="file-upload-input "> </div> </div> <div class="pro-pic-choose "></div> </div> </div>')
                })
                $(document).on('change', '#profile-upload', function() {

                    var name = $('#profile-upload').val().split('\\').pop();
                    var file_data = $('#profile-upload').prop('files')[0];
                    var file_size = file_data['size'];
                    var file_type = file_data['type'].split('/').pop();
                    var userid = u_id;
                    var imgName = 'user/' + userid + '/profilePhoto/' + name + '';
                    var form_data = new FormData();
                    form_data.append('file', file_data);

                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profilePhoto.php', {
                            imgName: imgName,
                            userid: userid
                        }, function(data) {
                            //                            $('#adv_dem').html(/data);
                        })

                        $.ajax({
                            url: 'http://localhost/facebook/core/ajax/profilePhoto.php',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,
                            type: 'post',
                            success: function(data) {
                                $('.profile-pic-me').attr('src', " " + data + " ");
                                $('.profile-dialoge-show').hide();
                            }
                        })

                    }

                })


                $('.add-cover-photo').on('click', function() {
                    $('.add-cov-opt').toggle();
                })

                $('#cover-upload').on('change', function() {
                    var name = $('#cover-upload').val().split('\\').pop();
                    var file_data = $('#cover-upload').prop('files')[0];
                    var file_size = file_data["size "];
                    var file_type = file_data['type'].split('/').pop();

                    var userid = u_id;
                    var imgName = 'user/' + userid + '/coverphoto/' + name + '';

                    var form_data = new FormData();

                    form_data.append('file', file_data);

                    if (name != '') {
                        $.post('http://localhost/facebook/core/ajax/profile.php', {
                            imgName: imgName,
                            userid: userid
                        }, function(data) {
                            //                            alert(data);

                        })
                    }
                    $.ajax({
                        url: 'http://localhost/facebook/core/ajax/profile.php',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(data) {
                            $('.profile-cover-wrap').css('background-image', 'url(' + data + ')');
                            $('.add-cov-opt').hide();
                        }

                    })
                });

                $('#statusEmoji').emojioneArea({
                    pickPosition: "right",
                    spellcheck: true
                });

                $(document).on('click', '.emojionearea-editor', function() {
                    $('.status-share-button-wrap').show('0.5');
                })
                $(document).on('click', '.status-bot', function() {
                    $('.status-share-button-wrap').show('0.5');
                })

                var fileCollection = new Array();

                $(document).on("change", "#multiple_files", function(e) {
                    var count = 0;
                    var files = e.target.files;
                    $(this).removeData();
                    var text = "";

                    $.each(files, function(i, file) {
                        fileCollection.push(file);
                        var reader = new FileReader();

                        reader.readAsDataURL(file);

                        reader.onload = function(e) {
                            var name = document.getElementById("multiple_files").files[i].name;
                            var template = '<li class="ui-state-default del" style="position:relative;"><img id="' + name + '" style="width:60px; height:60px" src="' + e.target.result + '"></li>';
                            $("#sortable").append(template);
                        }
                    })

                    $("#sortable").append('<div class="remImg" style="position:absolute; top:0;right:0;cursor:pointer; display:flex;justify-content:center; align-items:center; background-color:white; border-radius:50%; height:1rem; width:1rem; font-size: 0.694rem;">X</div>')

                })
                $(document).on('click', '.remImg', function() {
                    $('#sortable').empty();
                    $('.input-restore').empty().html('<label for="multiple_files" class="file-upload-label"><div class="status-bot-1"><img src="assets/image/photo.JPG" alt=""><div class="status-bot-text">Photo/Video</div></div></label><input type="file" name="file-upload" id="multiple_files" class="file-upload-input" data-multiple-caption="{count} files selected" multiple="">');
                })

                $('.status-share-button').on('click', function() {
                    var statusText = $('.emojionearea-editor').html();

                    var formData = new FormData()

                    var storeImage = [];

                    var error_images = [];

                    var files = $('#multiple_files')[0].files;

                    if (files.length != 0) {
                        if (files.length > 10) {
                            error_images += 'You can not select more than 10 images';
                        } else {
                            for (var i = 0; i < files.length; i++) {
                                var name = document.getElementById('multiple_files').files[i].name;

                                storeImage += '{\"imageName\":\"user/' + u_id + '/postImage/' + name + '\"},';

                                var ext = name.split('.').pop().toLowerCase();

                                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                                    error_images += '<p>Invalid ' + i + ' File </p>';
                                }

                                var ofReader = new FileReader();

                                ofReader.readAsDataURL(document.getElementById('multiple_files').files[i]);

                                var f = document.getElementById('multiple_files').files[i];

                                var fsize = f.size || f.fileSize;

                                if (fsize > 2000000) {
                                    error_images += '<p>' + i + ' File Size is very big</p>';
                                } else {
                                    formData.append('file[]', document.getElementById('multiple_files').files[i]);
                                }

                            }
                        }

                        if (files.length < 1) {

                        } else {
                            var str = storeImage.replace(/,\s*$/, "");

                            var stIm = '[' + str + ']';
                        }
                        if (error_images == '') {
                            $.ajax({
                                url: 'http://localhost/facebook/core/ajax/uploadPostImage.php',
                                method: "POST",
                                data: formData,
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function() {
                                    $('#error_multiple_files').html('<br/><label> Uploading...</label>');
                                },
                                success: function(data) {
                                    $('#error_multiple_files').html(data);
                                    $('#sortable').empty();
                                }
                            })
                        } else {
                            $('#multiple_files').val('');
                            $('#error_multiple_files').html("<span> " + error_images + "</span>");
                            return false;
                        }
                    } else {
                        var stIm = '';
                    }
                    if (stIm == '') {
                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
                            onlyStatusText: statusText
                        }, function(data) {
                            $('adv_dem').html(data);
                            location.reload();
                        })
                    } else {
                        $.post('http://localhost/facebook/core/ajax/postSubmit.php', {
                            stIm: stIm,
                            statusText: statusText

                        }, function(data) {
                            $('#adv_dem').html(data);
                            //                            location.reload();
                        })
                    }
                })

                $(document).on('click', '.postImage', function() {
                    var userid = $(this).data('userid');
                    var postid = $(this).data('postid');
                    var profileid = $(this).data('profileid');
                    var imageSrc = $(this).attr('src');

                    $.post('http://localhost/facebook/core/ajax/imgFetchShow.php', {
                        fetchImgInfo: userid,
                        postid: postid,
                        imageSrc: imageSrc
                    }, function(data) {

                        $('.top-box-show').html(data);
                        commentHover();
                        replyHover();
                        $(document).on('click', '.comment-action', function() {
                            $(this).parents('.nf-4').siblings('.nf-5').find('input.comment-input-style.comment-submit').focus();
                        })

                        $('.comment-submit').keyup(function(e) {
                            if (e.keyCode == 13) {
                                var inputNull = $(this);
                                var comment = $(this).val();
                                var postid = $(this).data('postid');
                                var userid = $(this).data('userid');
                                var profileid = p_id;
                                var commentPlaceholder = $(this).parents('.nf-5').find('ul.add-comment');

                                if (comment == '') {
                                    alert("Please Enter Some Text");
                                } else {
                                    $.ajax({
                                        type: "POST",
                                        url: "http://localhost/facebook/core/ajax/comment.php",
                                        data: {
                                            comment: comment,
                                            userid: userid,
                                            postid: postid,
                                            profileid: profileid
                                        },
                                        cache: false,
                                        success: function(html) {
                                            $(commentPlaceholder).append(html);
                                            $(inputNull).val('');
                                            commentHover();
                                        }
                                    })
                                }



                            }
                        })
                    })

                })

                //...........................post option......................
                $(document).on('click', '.post-option', function() {
                    $('.post-option').removeAttr('id');
                    $(this).attr('id', 'opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');

                    var postDetails = $(this).siblings('.post-option-details-container');
                    $(postDetails).show().html('<div class="post-option-details"><ul><li class="post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">Privacy</li></ul></div>');
                })

                $(document).on('click', 'li.post-edit', function() {
                    var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text');
                    var addId = $(statusTextContainer).attr('id', 'editPostPut');
                    var getPostText1 = $(statusTextContainer).text();
                    var postid = $(statusTextContainer).data('postid');
                    var userid = $(statusTextContainer).data('userid');
                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var profilePic = $(statusTextContainer).data('profiePic');
                    var getPostText = getPostText1.replace(/\s+/g, " ").trim();

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"> <div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "> <div class="edit-post-text">Edit Post</div> <div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div> </div> <div class="edit-post-value" style="border-bottom: 1px solid lightgray;"> <div class="status-med"> <div class="status-prof"> <div class="top-pic"><img src="' + profilePic + '" alt=""></div> </div> <div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div> </div> </div> <div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"> <div class="status-privacy-wrap"> <div class="status-privacy "> <div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div> <div class="privacy-text">Public</div> <div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div> </div> <div class="status-privacy-option"></div> </div> <div class="edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div> </div> </div>');



                })

                $(document).on('click', '.edit-post-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editStatus');
                    var editedTextVal = $(editedText).val();

                    $.post('http://localhost/facebook/core/ajax/editPost.php', {
                        editedTextVal: editedTextVal,
                        postid: postid,
                        userid: userid

                    }, function(data) {
                        $('#editPostPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();
                    })
                })

                $(document).on('click', '.post-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postContainer = $(this).parents('.profile-timeline');
                    var r = confirm("Do you want to delete the post?");

                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/editPost.php', {
                            deletePost: postid,
                            userid: userid
                        }, function(data) {
                            $(postContainer).empty();

                            alert(data);




                        })
                    }
                })


                //...........................post option end......................


                //...........................Main react......................
                $(document).on('click', '.like-action', function() {
                    var likeActionIcon = $(this).find('.like-action-icon img');
                    var likeReactParent = $(this).parents('.like-action-wrap');
                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
                    var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
                    var reactNumText = $(reactCount).text();
                    var postId = $(likeReactParent).data('postid');
                    var userId = $(likeReactParent).data('userid');
                    var typeText = $(this).find('.like-action-text span');
                    var typeR = $(typeText).text();
                    var spanClass = $(this).find('.like-action-text').find('span');


                    if ($(spanClass).attr('class') !== undefined) {

                        if ($(likeActionIcon).attr('src') == 'assets/image/likeAction.JPG') {
                            (spanClass).addClass('like-color');
                            $(likeActionIcon).attr('src', 'assets/image/react/like.png').addClass('reactIconSize');
                            spanClass.text('like');
                            mainReactSubmit(typeR, postId, userId, nf_3);
                        } else {
                            $(likeActionIcon).attr('src', 'assets/image/likeAction.JPG');
                            spanClass.removeClass();
                            spanClass.text('Like');
                            mainReactDelete(typeR, postId, userId, nf_3);
                        }
                    } else if ($(spanClass).attr('class') === undefined) {
                        (spanClass).addClass('like-color');
                        $(likeActionIcon).attr('src', 'assets/image/react/like.png').addClass('reactIconSize');
                        spanClass.text('like');
                        mainReactSubmit(typeR, postId, userId, nf_3);
                    } else {
                        (spanClass).addClass('like-color');
                        $(likeActionIcon).attr('src', 'assets/image/react/like.png').addClass('reactIconSize');
                        spanClass.text('like');
                        mainReactSubmit(typeR, postId, userId, nf_3);
                    }


                })

                function mainReactSubmit(typeR, postId, userId, nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        reactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid
                    }, function(data) {
                        $(nf_3).empty().html(data);
                    })
                }

                function mainReactDelete(typeR, postId, userId, nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/react.php', {
                        deleteReactType: typeR,
                        postId: postId,
                        userId: userId,
                        profileid: profileid
                    }, function(data) {
                        $(nf_3).empty().html(data);
                    })
                }

                $('.like-action-wrap').hover(function() {
                    var mainReact = $(this).find('.react-bundle-wrap');
                    $(mainReact).html(' <div class="react-bundle align-middle" style="position:absolute;margin-top: -43px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;"> <div class="like-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/like.png " alt=""></div> <div class="love-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/love.png " alt=""></div> <div class="haha-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/haha.png " alt=""></div> <div class="wow-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/wow.png " alt=""></div> <div class="sad-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/sad.png " alt=""></div> <div class="angry-react-click align-middle"> <img class="main-icon-css" src="' + BASE_URL + 'assets/image/react/angry.png " alt=""></div> </div>');
                }, function() {
                    var mainReact = $(this).find('.react-bundle-wrap');
                    $(mainReact).html('');
                })

                $(document).on('click', '.main-icon-css', function() {
                    var likeReact = $(this).parent();
                    reactReply(likeReact);
                })

                function reactReply(sClass) {
                    if ($(sClass).hasClass('like-react-click')) {
                        mainReactSub('like', 'blue');
                    } else if ($(sClass).hasClass('love-react-click')) {
                        mainReactSub('love', 'red');
                    } else if ($(sClass).hasClass('haha-react-click')) {
                        mainReactSub('haha', 'yellow');
                    } else if ($(sClass).hasClass('wow-react-click')) {
                        mainReactSub('wow', 'yellow');
                    } else if ($(sClass).hasClass('sad-react-click')) {
                        mainReactSub('sad', 'yellow');
                    } else if ($(sClass).hasClass('angry-react-click')) {
                        mainReactSub('angry', 'red');
                    } else {
                        console.log('Not found');
                    }
                }

                function mainReactSub(typeR, color) {
                    var reactColor = '' + typeR + '-color';
                    var pClass = $('.' + typeR + '-react-click.align-middle');
                    var likeReactParent = $(pClass).parents('.like-action-wrap');
                    var nf4 = $(likeReactParent).parents('.nf-4');
                    var nf_3 = $(nf4).siblings('.nf-3').find('.react-count-wrap');
                    var reactCount = $(nf4).siblings('.nf-3').find('.nf-3-react-username');
                    var reactNumText = $(reactCount).text();

                    var postId = $(likeReactParent).data('postid');
                    var userId = $(likeReactParent).data('userid');
                    var likeAction = $(likeReactParent).find('.like-action');
                    var likeActionIcon = $(likeAction).find('.like-action-icon img');
                    var spanClass = $(likeAction).find('.like-action-text').find('span');

                    if ($(spanClass).hasClass(reactColor)) {
                        $(spanClass).removeClass();
                        spanClass.text('Like');
                        $(likeActionIcon).attr('src', 'assets/image/likeAction.JPG');
                        mainReactDelete(typeR, postId, userId, nf_3);
                    } else if ($(spanClass).attr('class') !== undefined) {
                        $(spanClass).removeClass().addClass(reactColor);
                        spanClass.text(typeR);
                        $(likeActionIcon).removeAttr('src').attr('src', 'assets/image/react/' + typeR + '.png').addClass('reactIconSize');
                        mainReactSubmit(typeR, postId, userId, nf_3);
                    } else {
                        $(spanClass).addClass(reactColor);
                        //                        $(likeActionIcon).attr('src', 'assets/image/react/' + typeR + '.png').addClass('reactIconSize');
                        spanClass.text(typeR);
                        $(likeActionIcon).removeAttr('src').attr('src', 'assets/image/react/' + typeR + '.png').addClass('reactIconSize');
                        mainReactSubmit(typeR, postId, userId, nf_3);
                    }


                }


                //...........................Main react end ......................


                //...........................Comment start ......................

                $(document).on('click', '.comment-action', function() {
                    $(this).parents('.nf-4').siblings('.nf-5').find('input.comment-input-style.comment-submit').focus();
                })

                $('.comment-submit').keyup(function(e) {
                    if (e.keyCode == 13) {
                        var inputNull = $(this);
                        var comment = $(this).val();
                        var postid = $(this).data('postid');
                        var userid = $(this).data('userid');
                        var profileid = p_id;
                        var commentPlaceholder = $(this).parents('.nf-5').find('ul.add-comment');

                        if (comment == '') {
                            alert("Please Enter Some Text");
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "http://localhost/facebook/core/ajax/comment.php",
                                data: {
                                    comment: comment,
                                    userid: userid,
                                    postid: postid,
                                    profileid: profileid
                                },
                                cache: false,
                                success: function(html) {
                                    $(commentPlaceholder).append(html);
                                    $(inputNull).val('');
                                    commentHover();
                                }
                            })
                        }



                    }
                })

                commentHover();

                function commentHover() {

                    $('.com-like-react').hover(function() {

                        var mainReact = $(this).find('.com-react-bundle-wrap');
                        $(mainReact).html('<div class="react-bundle align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/like.png " alt=""></div><div class="com-love-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/love.png " alt=""></div><div class="com-haha-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/haha.png " alt=""></div><div class="com-wow-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/wow.png " alt=""></div><div class="com-sad-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/sad.png " alt=""></div><div class="com-angry-react-click align-middle"><img class="com-main-icon-css" src="' + BASE_URL + 'assets/image/react/angry.png " alt=""></div></div>');
                    }, function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap');
                        $(mainReact).html('');
                    })
                }

                $(document).on('click', '.com-main-icon-css', function() {
                    var com_bundle = $(this).parents('.com-react-bundle-wrap');
                    var commentID = $(com_bundle).data('commentid');
                    var likeReact = $(this).parent();
                    comReactApply(likeReact, commentID);

                })

                function comReactApply(sClass, commentID) {
                    if ($(sClass).hasClass('com-like-react-click')) {
                        comReactSub('like', commentID);
                    } else if ($(sClass).hasClass('com-love-react-click')) {
                        comReactSub('love', commentID);
                    } else if ($(sClass).hasClass('com-haha-react-click')) {
                        comReactSub('haha', commentID);
                    } else if ($(sClass).hasClass('com-wow-react-click')) {
                        comReactSub('wow', commentID);
                    } else if ($(sClass).hasClass('com-sad-react-click')) {
                        comReactSub('sad', commentID);
                    } else if ($(sClass).hasClass('com-angry-react-click')) {
                        comReactSub('angry', commentID);
                    } else {
                        console.log('Not found');
                    }
                }

                function comReactSub(typeR, commentID) {
                    var reactColor = '' + typeR + '-color';
                    var parentClass = $('.com-' + typeR + '-react-click.align-middle');
                    var grandParent = $(parentClass).parents('.com-like-react');
                    var postid = $(grandParent).data('postid');
                    var userid = $(grandParent).data('userid');

                    var spanClass = $(grandParent).find('.com-like-action-text').find('span');
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
                    if ($(spanClass).attr('class') !== undefined) {
                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text('Like');
                            comReactDelete(typeR, postid, userid, commentID, com_nf_3);
                        } else {
                            $(spanClass).removeClass().addClass(reactColor);
                            spanClass.text(typeR);
                            comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
                        }
                    } else {
                        $(spanClass).addClass(reactColor);
                        spanClass.text(typeR);
                        comReactSubmit(typeR, postid, userid, commentID, com_nf_3)
                    }
                }

                $(document).on('click', '.com-like-action-text', function() {
                    var thisParents = $(this).parents('.com-like-react');
                    var postid = $(thisParents).data('postid');
                    var userid = $(thisParents).data('userid');
                    var commentID = $(thisParents).data('commentid');
                    var typeText = $(thisParents).find('.com-like-action-text');
                    var typeR = $(typeText).text();
                    var com_nf_3 = $(thisParents).parents('.com-react').siblings('.com-text-option-wrap').find('.com-nf-3-wrap');
                    var spanClass = $(thisParents).find('.com-like-action-text').find('span');

                    if ($(spanClass).attr('class') !== undefined) {
                        $(spanClass).removeAttr('class');
                        spanClass.text('Like');
                        comReactDelete(typeR, postid, userid, commentID, com_nf_3);
                    } else {
                        $(spanClass).addClass('like-color');
                        spanClass.text('Like');
                        comReactSubmit(typeR, postid, userid, commentID, com_nf_3);
                    }
                })

                function comReactSubmit(typeR, postid, userid, commentID, com_nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                            commentid: commentID,
                            reactType: typeR,
                            postid: postid,
                            userid: userid,
                            profileid: profileid
                        },
                        function(data) {
                            $(com_nf_3).empty().html(data);

                        });
                }

                function comReactDelete(typeR, postid, userid, commentID, com_nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/commentReact.php', {
                            deleteReactType: typeR,
                            delCommentid: commentID,
                            postid: postid,
                            userid: userid,
                            profileid: profileid
                        },
                        function(data) {
                            $(com_nf_3).empty().html(data);
                        });
                }

                $(document).on('click', '.com-dot', function() {
                    $('.com-dot').removeAttr('id');
                    $(this).attr('id', 'com-opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var comDetails = $(this).siblings('.com-option-details-container');
                    $(comDetails).show().html('<div class="com-option-details" style="z-index:2;"><ul><li class="com-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="com-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Delete</li><li class="com-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })

                $(document).on('click', 'li.com-edit', function() {
                    var comTextContainer = $(this).parents('.com-dot-option-wrap').siblings('.com-pro-text').find('.com-text');
                    var addId = $(comTextContainer).attr('id', 'editComPut');
                    var getComText1 = $(comTextContainer).text();
                    var postid = $(comTextContainer).data('postid');
                    var userid = $(comTextContainer).data('userid');
                    var commentid = $(comTextContainer).data('commentid');
                    var profilepic = $(comTextContainer).data('profilepic');
                    var getComText = getComText1.replace(/\s+/g, " ").trim();
                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editCom align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/image/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/image/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-com-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" >Save</div></div></div>');
                })

                $(document).on('click', '.edit-com-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editCom');
                    var editedTextVal = $(editedText).val();
                    $.post('http://localhost/facebook/core/ajax/editComment.php', {
                        postid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal,
                        commentid: commentid
                    }, function(data) {
                        $('#editComPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();
                    })
                })
                $(document).on('click', '.com-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var comContainer = $(this).parents('.new-comment');
                    var profileid = p_id;

                    var r = confirm('Do you want to delete the comment?');
                    if (r === true) {
                        $.post('http://localhost/facebook/core/ajax/editComment.php', {
                            deletePost: postid,
                            userid: userid,
                            commentid: commentid
                        }, function(data) {
                            $(comContainer).empty();
                        })
                    }
                })


                //...........................Comment end ......................


                //...........................Reply Start ......................
                $(document).on('click', '.com-reply-action', function() {
                    $('.reply-input').empty();
                    $('.reply-write').hide();
                    var BASE_URL = 'http://localhost/facebook';
                    var userid = $(this).data('userid');
                    var postid = $(this).data('postid');
                    var commentid = $(this).data('commentid');
                    var profilepic = $(this).data('profilepic');

                    var input_field = $(this).parents('.com-text-react-wrap').siblings('.reply-wrap').find('.replyInput');

                    input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div></div></div>');

                    replyInput(input_field);

                })
                $(document).on('click', '.com-reply-action-child', function() {
                    $('.reply-input').empty();
                    $('.reply-write').hide();
                    var BASE_URL = 'http://localhost/facebook';
                    var userid = $(this).data('userid');
                    var postid = $(this).data('postid');
                    var commentid = $(this).data('commentid');
                    var profilepic = $(this).data('profilepic');

                    var input_field = $(this).parents('.reply-wrap').find('.replyInput');

                    input_field.html('<div class="reply-write"><div class="com-pro-pic" style="margin-top: 4px;"><a href="#"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></a></div><div class="com-input" style=""><div class="reply-input" style="flex-basis:96%;"><input type="text" name="" id="" class="reply-input-style reply-submit" style="" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" placeholder="Write a reply..."></div></div></div>');

                    replyInput(input_field);

                })

                function replyInput(input_field) {
                    console.log(input_field);
                    $(input_field).find('input.reply-input-style.reply-submit').focus();
                    $('input.reply-input-style.reply-submit').keyup(function(e) {
                        if (e.keyCode == 13) {
                            var inputNull = $(this);
                            var comment = $(this).val();
                            var postid = $(this).data('postid');
                            var userid = $(this).data('userid');
                            var commentid = $(this).data('commentid');
                            var profileid = p_id;
                            var replyPlaceholder = $(this).parents('.replyInput').siblings('.reply-text-wrap').find('.old-reply');
                            if (comment == '') {
                                alert("Please Enter Some Text.");
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "http://localhost/facebook/core/ajax/reply.php",
                                    data: {
                                        replyComment: comment,
                                        userid: userid,
                                        postid: postid,
                                        commentid: commentid,
                                        profileid: profileid
                                    },
                                    cache: false,
                                    success: function(html) {
                                        $(replyPlaceholder).append(html)
                                        $(inputNull).val('');
                                        replyHover();
                                    }
                                })
                            }

                        }
                    })
                }
                replyHover();

                function replyHover() {
                    $('.com-like-react-reply').hover(function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap.reply');
                        $(mainReact).html(' <div class="react-bundle  align-middle" style="position:absolute;margin-top: -45px; margin-left: -40px; display:flex; background-color:white;padding: 0 2px;border-radius: 25px; box-shadow: 0px 0px 5px black; height:45px; width:270px; justify-content:space-around; transition: 0.3s;z-index:2"><div class="com-like-react-click  align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/like.png " alt=""></div><div class="com-love-react-click align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/love.png " alt=""></div><div class="com-haha-react-click  align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/haha.png " alt=""></div><div class="com-wow-react-click  align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/wow.png " alt=""></div><div class="com-sad-react-click  align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/sad.png " alt=""></div><div class="com-angry-react-click  align-middle"><img class="reply-main-icon-css " src="' + BASE_URL + 'assets/image/react/angry.png " alt=""></div></div>');
                    }, function() {
                        var mainReact = $(this).find('.com-react-bundle-wrap');
                        $(mainReact).html('');
                    })
                }

                $(document).on('click', '.reply-main-icon-css', function() {
                    var com_bundle = $(this).parents('.com-react-bundle-wrap');
                    var commentID = $(com_bundle).data('commentid');
                    var commentparentid = $(com_bundle).data('commentparentid');
                    var likeReact = $(this).parent();
                    replyReactApply(likeReact, commentID, commentparentid);
                })

                function replyReactApply(sClass, commentID, commentparentid) {
                    if ($(sClass).hasClass('com-like-react-click')) {
                        replyReactSub('like', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-love-react-click')) {
                        replyReactSub('love', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-haha-react-click')) {
                        replyReactSub('haha', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-wow-react-click')) {
                        replyReactSub('wow', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-sad-react-click')) {
                        replyReactSub('sad', commentID, commentparentid);
                    } else if ($(sClass).hasClass('com-angry-react-click')) {
                        replyReactSub('angry', commentID, commentparentid);
                    } else {
                        console.log('not found');
                    }
                }

                function replyReactSub(typeR, commentID, commentparentid) {
                    var reactColor = '' + typeR + '-color';
                    var parentClass = $('.com-' + typeR + '-react-click.align-middle');
                    var grandParent = $(parentClass).parents('.com-like-react-reply');
                    var postid = $(grandParent).data('postid');
                    var userid = $(grandParent).data('userid');

                    var spanClass = $(grandParent).find('.reply-like-action-text').find('span');
                    var com_nf_3 = $(grandParent).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');

                    if ($(spanClass).attr('class') !== undefined) {
                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text('Like');
                            replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                        } else {
                            $(spanClass).removeClass().addClass('reactColor');
                            spanClass.text(typeR);
                            replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                        }
                    } else {
                        $(spanClass).addClass(reactColor);
                        spanClass.text(typeR);
                        replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                    }

                }

                $(document).on('click', '.reply-like-action-text', function() {
                    var thisParents = $(this).parents('.com-like-react-reply');
                    var postid = $(thisParents).data('postid');
                    var userid = $(thisParents).data('userid');
                    var commentID = $(thisParents).data('commentid');
                    var commentparentid = $(thisParents).data('commentparentid');
                    var typeText = $(thisParents).find('.reply-like-action-text span');

                    var typeR = $(typeText).text();
                    var reactColor = '' + typeR + '-color';
                    var com_nf_3 = $(thisParents).parent('.com-react').siblings('.reply-text-option-wrap').find('.com-nf-3-wrap');

                    var spanClass = $(thisParents).find('.reply-like-action-text').find('span');

                    if ($(spanClass).attr('class') !== undefined) {
                        if ($(spanClass).hasClass(reactColor)) {
                            $(spanClass).removeAttr('class');
                            spanClass.text('Like');
                            replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                        } else {
                            $(spanClass).removeClass().addClass(reactColor);
                            spanClass.text(typeR);
                            replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                        }
                    } else {
                        $(spanClass).addClass(reactColor);
                        spanClass.text('Like');
                        replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3);
                    }
                })

                function replyReactSubmit(typeR, postid, userid, commentID, commentparentid, com_nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        commentid: commentID,
                        reactType: typeR,
                        postid: postid,
                        userid: userid,
                        commentparentid: commentparentid,
                        profileid: profileid
                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                    })
                }

                function replyReactDelete(typeR, postid, userid, commentID, commentparentid, com_nf_3) {
                    var profileid = p_id;
                    $.post('http://localhost/facebook/core/ajax/replyReact.php', {
                        delcommentid: commentID,
                        deleteReactType: typeR,
                        postid: postid,
                        userid: userid,
                        commentparentid: commentparentid,
                        profileid: profileid
                    }, function(data) {
                        $(com_nf_3).empty().html(data);
                    })
                }

                $(document).on('click', '.reply-dot', function() {

                    $('.reply-dot').removeAttr('id');
                    $(this).attr('id', 'reply-opt-click');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');

                    var replyDetails = $(this).siblings('.reply-option-details-container');
                    $(replyDetails).html('<div class="reply-option-details" style="z-index:2;"><ul style="padding:0;"><li class="reply-edit" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '">Edit</li><li class="reply-delete" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Delete</li><li class="reply-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })
                $(document).on('click', 'li.reply-edit', function() {
                    var comTextContainer = $(this).parents('.reply-dot-option-wrap').siblings('.com-pro-text').find('.com-text');

                    var addId = $(comTextContainer).attr('id', 'editReplyPut');
                    var getComText1 = $(comTextContainer).text();
                    var postid = $(comTextContainer).data('postid');
                    var userid = $(comTextContainer).data('userid');
                    var commentid = $(comTextContainer).data('commentid');
                    var replyid = $(comTextContainer).data('replyid');
                    var profilepic = $(comTextContainer).data('profilepic');
                    var getComText = getComText1.replace(/\s+/g, " ").trim();

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Comment</div><div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="editReply align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getComText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/images/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/images/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="edit-reply-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-commentid="' + commentid + '" data-replyid="' + replyid + '">Save</div></div></div>');

                });

                $(document).on('click', '.edit-reply-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.editReply');

                    var editedTextVal = $(editedText).val();

                    $.post('http://localhost/facebook/core/ajax/editReply.php', {
                        postid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal,
                        commentid: commentid,
                        replyid: replyid
                    }, function(data) {
                        $('#editReplyPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();
                    })
                })


                $(document).on('click', '.reply-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var commentid = $(this).data('commentid');
                    var replyid = $(this).data('replyid');
                    var replyContainer = $(this).parents('.new-reply');
                    var r = confirm("Do you want to delete the comment?");
                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/editReply.php', {
                            deleteReply: postid,
                            userid: userid,
                            commentid: commentid,
                            replyid: replyid
                        }, function(data) {

                            $(replyContainer).empty();
                        })
                    }
                })

                //...........................Reply end ......................


                //...........................Share ......................

                $(document).on('click', '.share-action', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var profilePic = $(this).data('profilepic');
                    var profileid = $(this).data('profileid');

                    var nf_1 = $(this).parents('.nf-4').siblings('.nf-1').html();
                    var nf_2 = $(this).parents('.nf-4').siblings('.nf-2').html();

                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="overflow: hidden;background-color: rgb(236, 236, 236);"> <div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "> <div class="edit-post-text">Share Post</div> <div class="edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div> </div> <div class="edit-post-value" style=""> <div class="status-med"> <div class="status-prof"> <div class="top-pic"><img src="' + profilePic + '" alt=""></div> </div> <div class="status-prof-textarea"> <textarea data-autoresize rows="5" columns="5" placeholder="Tell something about the post.." name="textStatus" class="shareText align-middle" style="padding-top: 10px;"></textarea> </div> </div> </div> <div class="news-feed-text" style=" display: flex; flex-direction: column; align-items: baseline; margin:5px;box-shadow:0 0 2px darkgray;overflow: hidden;"> ' + nf_1 + ' ' + nf_2 + ' </div> <div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px; z-index: 1;"> <div class="status-privacy-wrap"> <div class="status-privacy " style="background-color: #f5f6f8;"> <div class="privacy-icon align-middle"> <img src="assets/image/profile/publicIcon.JPG" alt=""> </div> <div class="privacy-text">Public</div> <div class="privacy-downarrow-icon align-middle"> <img src="assets/image/watchmore.png" alt=""> </div> </div> <div class="status-privacy-option"> </div> </div> <div class="post-Share" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px;cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-profileid="' + profileid + '" >Share</div> </div> <div style=" position: absolute; bottom: 0; height: 43px; width: 100%; text-align: center; background: lightgrey;box-shadow: -1px -1px 5px grey;"></div> </div>');

                    $('.nf-1-right-dott').hide();
                })
                $(document).on('click', '.post-Share', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    var shareText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.shareText').val();

                    $.post('http://localhost/facebook/core/ajax/share.php', {
                        shareText: shareText,
                        profileid: profileid,
                        postid: postid,
                        userid: userid

                    }, function(data) {
                        $('.top-box-show').empty();
                    })
                })
                $(document).on('click', '.share-container', function() {
                    var userLink = $(this).data('userlink');
                    window.location.href = "http://localhost/facebook/profile.php?username=" + userLink + "";
                })
                $(document).on('click', '.shared-post-option', function() {
                    $('.shared-post-option').removeAttr('id');
                    $('.post-option').removeAttr('id');
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    $(this).attr('id', 'opt-click');

                    var postDetails = $(this).siblings('.shared-post-option-details-container');
                    $(postDetails).show().html('<div class="shared-post-option-details"><ul style="padding:0;"><li class="shared-post-edit" data-postid="' + postid + '" data-userid="' + userid + '">Edit</li><li class="shared-post-delete" data-postid="' + postid + '" data-userid="' + userid + '">Delete</li><li class="post-privacy" data-postid="' + postid + '" data-userid="' + userid + '">privacy</li></ul></div>');
                })

                $(document).on('click', 'li.shared-post-edit', function() {
                    var statusTextContainer = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-text-span');
                    var addId = $(statusTextContainer).attr('id', 'editPostPut');
                    var getPostText1 = $(statusTextContainer).text();
                    var getPostText = getPostText1.replace(/\s+/g, " ").trim();
                    var postid = $(statusTextContainer).data('postid');
                    var userid = $(statusTextContainer).data('userid');
                    var getPostImg = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var thiss = $(this).parents('.nf-1').siblings('.nf-2').find('.nf-2-img');
                    var profilepic = $(statusTextContainer).data('profilepic');
                    $('.top-box-show').html('<div class="top-box profile-dialog-show" style="top: 12.5%;left: 22.5%;width: 55%;"><div class="edit-post-header align-middle " style="justify-content: space-between; padding: 10px; height: 20px; background-color: lightgray;font-size: 14px; font-weight:600; "><div class="edit-post-text">Edit Post</div><div class="shared-edit-post-close" style="padding: 5px; color: gray; cursor:pointer;">x</div></div><div class="edit-post-value" style="border-bottom: 1px solid lightgray;"><div class="status-med"><div class="status-prof"><div class="top-pic"><img src="' + profilepic + '" alt=""></div></div><div class="status-prof-textarea"><textarea data-autoresize rows="5" columns="5" placeholder="" name="textStatus" class="sharedEditStatus align-middle" style="font-family:sens-serif; font-weight:400; padding:5px;">' + getPostText + '</textarea></div></div></div><div class="edit-post-submit" style="position: absolute;right:0; bottom: 0; display: flex; align-items: center; margin: 10px;"><div class="status-privacy-wrap"><div class="status-privacy  "><div class="privacy-icon align-middle"><img src="assets/image/profile/publicIcon.JPG" alt=""></div><div class="privacy-text">Public</div><div class="privacy-downarrow-icon align-middle"><img src="assets/image/watchmore.png" alt=""></div></div><div class="status-privacy-option"></div></div><div class="shared-edit-post-save" style="padding: 3px 15px; background-color: #4267bc;color: white; font-size: 14px; margin-left:5px; cursor:pointer;" data-postid="' + postid + '" data-userid="' + userid + '" data-tag="' + thiss + '">Save</div></div></div>')
                })

                $(document).on('click', '.shared-edit-post-save', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var editedText = $(this).parents('.edit-post-submit').siblings('.edit-post-value').find('.sharedEditStatus');
                    var editedTextVal = $(editedText).val();
                    $.post('http://localhost/facebook/core/ajax/sharedEditPost.php', {
                        sharedPostid: postid,
                        userid: userid,
                        editedTextVal: editedTextVal
                    }, function(data) {
                        $('#editPostPut').html(data).removeAttr('id');
                        $('.top-box-show').empty();
                    })
                })

                $(document).on('click', '.shared-post-delete', function() {
                    var postid = $(this).data('postid');
                    var userid = $(this).data('userid');
                    var postContainer = $(this).parents('.profile-timeline');
                    var r = confirm("Do you want to delete the post?");

                    if (r == true) {
                        $.post('http://localhost/facebook/core/ajax/sharedEditPost.php', {
                            deletePost: postid,
                            userid: userid,
                        }, function(data) {

                            $(postContainer).empty();
                        })
                    }
                })
                //...........................Share end ......................

                //...........................Live Search ......................
                $(document).on('keyup', 'input#main-search', function() {
                    var searchText = $(this).val();
                    if (searchText == '') {
                        $('.search-result').empty();
                    } else {
                        $.post('http://localhost/facebook/core/ajax/search.php', {
                            searchText: searchText
                        }, function(data) {
                            if (data == '') {
                                $('.search-result').html('<p>No user found</p>')
                            } else {
                                $('.search-result').html(data);
                            }
                        })
                    }
                })
                //...........................Live Search end ......................

                //...........................Request ......................

                $(document).on('click', '.profile-add-friend', function() {
                    $(this).parents('.profile-action').find('.profile-follow-button').removeClass().addClass('profile-unfollow-button').html('<img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');
                    $(this).find('.edit-profile-button-text').text('Friend Request Sent');
                    $(this).removeClass().addClass('profile-friend-sent');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        request: profileid,
                        userid: userid
                    }, function(data) {

                    })

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        follow: profileid,
                        userid: userid
                    }, function(data) {})
                })

                $(document).on('click', '.accept-req', function() {

                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $(this).parent().empty().html('<div class="con-req align-middle"><img src="assets/image/rightsignGray.JPG" alt="">Friend</div><div class="request-unfriend" data-userid="' + userid + '" data-profileid="' + profileid + '">Unfriend</div>');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        confirmRequest: profileid,
                        userid: userid
                    }, function(data) {})
                });

                $(document).on('click', '.profile-friend-sent', function() {
                    $(this).parents('.profile-action').find('.profile-unfollow-button').removeClass().addClass('profile-unfollow-button').html('<img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
                    $(this).find('.edit-profile-button-text').text('Add Friend');
                    $(this).removeClass().addClass('profile-add-friend');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        cancelSentRequest: profileid,
                        userid: userid
                    }, function(data) {})

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfollow: profileid,
                        userid: userid
                    }, function(data) {})
                })
                $(document).on('click', '.request-cancel', function() {
                    $(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html(' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        cancelSentRequest: userid,
                        userid: profileid
                    }, function(data) {})
                })

                $(document).on('click', '.request-unfriend', function() {
                    $(this).parents('.profile-friend-confirm').removeClass().addClass('profile-add-friend').html(' <img src="assets/image/friendRequestGray.JPG" alt=""><div class="edit-profile-button-text">Add Friend</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');
                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfriendRequest: profileid,
                        userid: userid
                    }, function(data) {})
                })

                $(document).on('mouseenter', '.edit-profile-confirm-button', function() {
                    var reqCancel = $(this).find('.request-cancel');
                    var reqUnfriend = $(this).find('.request-unfriend');
                    $(reqCancel).show();
                    $(reqUnfriend).show();
                })
                $(document).on('mouseleave', '.profile-friend-confirm', function() {
                    var reqCancel = $(this).find('.request-cancel');
                    var reqUnfriend = $(this).find('.request-unfriend');
                    $(reqCancel).hide();
                    $(reqUnfriend).hide();
                })
                //...........................Request end ......................


                //...........................follow  ......................
                $(document).on('click', '.profile-follow-button', function() {
                    $(this).removeClass().addClass('profile-unfollow-button').html(' <img src="assets/image/rightsignGray.JPG" alt=""><div class="profile-activity-button-text">Following</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        follow: profileid,
                        userid: userid
                    }, function(data) {})
                })
                $(document).on('click', '.profile-unfollow-button', function() {
                    $(this).removeClass().addClass('profile-follow-button').html(' <img src="assets/image/followGray.JPG" alt=""><div class="profile-activity-button-text">Follow</div>');
                    var userid = $(this).data('userid');
                    var profileid = $(this).data('profileid');

                    $.post('http://localhost/facebook/core/ajax/request.php', {
                        unfollow: profileid,
                        userid: userid
                    }, function(data) {})
                })



                //...........................follow end ......................


                //...........................Settings ......................
                $(document).on('click', '.watchmore-wrap', function() {

                    $('.setting-logout-wrap').toggle();
                })
                $(document).on('click', '.setting-option', function() {

                    window.location.href = "settings.php";
                })
                $(document).on('click', '.logout-option', function() {

                    window.location.href = "logout.php";

                })

                //...........................Settings end ......................






                $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push($('.add-cov-opt'));
                    container.push($('.profile-dialoge-show'));
                    container.push($('.notification-list-wrap'));

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
                            $(value).hide();
                        }
                    })

                })

                $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push($('.post-option-details-container'));
                    container.push($('.top-box-show'));
                    container.push($('.com-option-details-container'));
                    container.push($('.reply-option-details-container'));
                    container.push($('.shared-post-option-details-container'));

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
                            $(value).empty();
                        }
                    })

                })

                $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push($('.profile-status-write'));

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
                            $('.status-share-button-wrap').hide('0.2');
                        }
                    })


                })

                $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push($('.post-img-wrap'));

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
                            $('.top-box-show').empty();
                        }
                    })


                })


            })

        </script>
    </body>

    </html>
