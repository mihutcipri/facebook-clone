<?php
include '../load.php';
include '../../connect/login.php';

$user_id = login::isLoggedIn();

if(isset($_POST['useridForAjax'])){

$useridForAjax = $_POST['useridForAjax'];
    $otherid = $_POST['otherid'];
    $msg = $_POST['msg'];

    $loadFromUser->create('messages', array("message" => $msg, 'messageTo'=>$otherid, 'messageFrom'=> $useridForAjax, 'messageOn' => date('Y-m-d H:i:s') ));

    $loadFromUser->delete('notification', array("notificationFrom"=>$useridForAjax, 'notificationFor' => $otherid, 'type' => 'message'));


    if($otherid != $useridForAjax){

    $loadFromUser->create('notification',array('notificationFrom'=> $useridForAjax , 'notificationFor' => $otherid, 'postid' => '0', 'type'=>'message', 'status'=> '0', 'notificationCount'=>'0', 'notificationOn'=>date('Y-m-d H:i:s')));
    }



        $messageData = $loadFromPost->messageData($useridForAjax, $otherid);

    foreach($messageData as $message){
if($message->messageFrom == $useridForAjax){ ?>

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
            <div class="receiver-text" style="background-color: ghostwhite;
    box-shadow: 0 0 2px;
"><?php echo $message->message; ?></div>
            <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
        </div>

    </div>


<?php
}

    }
}

if(isset($_POST['showmsg'])){

$otherid = $_POST['showmsg'];
    $useridForAjax = $_POST['yourid'];

        $messageData = $loadFromPost->messageData($useridForAjax, $otherid);
echo '<div class="past-data-count" data-datacount="'.count($messageData).'"></div>';
    foreach($messageData as $message){
if($message->messageFrom == $useridForAjax){ ?>

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
            <div class="receiver-text" style="background-color: ghostwhite;
"><?php echo $message->message; ?></div>
            <div class="receiver-time" style="margin-left:10px;"><?php echo $loadFromUser->timeAgoForCom($message->messageOn);  ?></div>
        </div>

    </div>


<?php
}

    }
}

if(isset($_POST['dataCount'])){
$otherid = $_POST['dataCount'];
    $useridForAjax = $_POST['profileid'];

        $messageData = $loadFromPost->messageData($useridForAjax, $otherid);
    echo count($messageData);


}




?>