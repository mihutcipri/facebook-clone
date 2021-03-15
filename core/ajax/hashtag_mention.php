<?php
include '../load.php';
include '../../connect/login.php';

$userid = login::isLoggedIn();


if(isset($_POST['regex_text_placeholder'])){
    
    $hash_ment = implode($_POST['regex_text_placeholder']);
    if(substr($hash_ment,0,1) === '@'){
        $mention = str_replace('@', '', $hash_ment);
        $mention_user = $loadFromPost->loadMentionUser($mention);
       
        foreach($mention_user as $ment){
         
            ?>
<li class="mention-user align-middle" style="background-color:#4267b2; color:white; font-size:12px; padding:3px; margin-bottom:5px; cursor:pointer;display: flex;justify-content: space-between;" data-profileid="<?php echo $ment->user_id; ?>">
    <img src="<?php echo BASE_URL.$ment->profilePic; ?>" class="search-image" alt="" style="height:30px; width:30px;">
    <div class="mention-name" data-profileid="<?php echo $ment->user_id; ?>"  data-userlink="<?php echo $ment->userLink; ?>" style="margin-left:3px;font-size:13px;width:100%;"><?php echo ''.$ment->first_name.' '.$ment->last_name.''; ?></div>
</li>

<?php
        }
    }
    
    
}

?>
