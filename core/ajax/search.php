<?php

include '../load.php';
include '../../connect/login.php';


$user_id = login::isLoggedIn();

if(isset($_POST['searchText'])){
    $searchText = $_POST['searchText'];

    $searchResult = $loadFromPost->searchText($searchText, $user_id);

echo '<ul style="background-color:white;padding:5px;margin-top:0; box-shadow: 0 0 5px gray;  border-radius:3px" >';

   foreach($searchResult as $search) {

       if($search->userId == $user_id){}else{

?>

<li class="mention-individuals align-middle" style="background-color:#4267b2; color:white; font-size:12px; padding:3px; margin-bottom:5px; cursor:pointer;">
<a href="<?php echo BASE_URL.'/profile.php?username='.$search->userLink; ?>" class="align-middle" style="color:white;">
    <img src="<?php echo BASE_URL.$search->profilePic; ?>" style="height:20px; width:20px;" alt="">
    <div class="mention-name" style="margin-left:3px;"><?php echo ''.$search->first_name.' '.$search->last_name.''; ?></div>
</a>

      </li>

<?php
                                             }
}
echo '</ul>';
       }

if(isset($_POST['msgUser'])){
    $msgUser = $_POST['msgUser'];
    $userid = $_POST['userid'];
    $searchResult = $loadFromPost->searchMsgUser($msgUser, $userid);
    echo '<ul style="background-color:white; padding:5px; margin-top:0; box-shadow: 0 0 5px gray; border-radius:3px;" >';
    foreach($searchResult as $search){

    ?>
    <li class="mention-individuals align-middle"  style="background-color:#4267b2; color:white; font-size:12px; padding:3px; margin-bottom:5px; cursor:pointer;" data-profileid="<?php echo $search->user_id; ?>" >
        <img src="<?php echo BASE_URL.$search->profilePic; ?>" class="search-image" alt="" style="height:30px; width:20px;">
        <div class="mention-name" style="margin-left:3px;font-size:13px;"><?php echo ''.$search->first_name.' '.$search->last_name.''; ?></div>
    </li>

       <?php
}
echo '</ul>';
}
?>