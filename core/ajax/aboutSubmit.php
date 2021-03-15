<?php

include '../load.php';
include '../../connect/login.php';


$user_id = login::isLoggedIn();

if(isset($_POST['submitType'])){
    $submitType = $_POST['submitType'];
    $inputVal = $_POST['inputVal'];
    $userid = $_POST['userid'];
    $profileid = $_POST['profileid'];

    $loadFromUser->update('profile', $userid, array($submitType => $inputVal));
    echo $inputVal;
}



    if(isset($_POST['overview'])){
    $userid = $_POST['overview'];
    $profileid = $_POST['profileid'];

    $userData= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap" style="flex-basis:70%; ">
    <div class="overview-left">
        <div class="about-work-heading">WORK</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileid, 'Add a workplace'); ?>

        <div class="about-work-heading">SCHOOL</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileid, 'Add high school'); ?>
        <div class="about-work-heading">PLACE</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('address', $userid, $profileid, 'Add your current place'); ?>
        <div class="about-work-heading">RELATIONSHIP</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('relationship', $userid, $profileid, 'Add your relationship status'); ?>

    </div>
    <div class="overview-right" style="flex-basis:30%;">
        <a href="setting.php" class="overview-right">
            <div class="overview-mobile align-middle" style="margin-bottom:10px;">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20mobile.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->mobile; ?></div>
            </div>
            <div class="overview-birthday align-middle">
                <div class="overview-mobile-icon align-middle"><img src="assets/image/profile/overview%20birthday.JPG" alt="" style="margin-right:5px;"></div>
                <div class="overview-mobile-number"><?php echo $userData->birthday; ?></div>
            </div>
        </a>

    </div>
</div>


<?php
}if(isset($_POST['workEducation'])){
    $userid = $_POST['workEducation'];
    $profileid = $_POST['profileid'];

    $userdata= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap">
    <div class="overview-left">
        <div class="about-work-heading">WORK</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('workplace', $userid, $profileid, 'Add        workplace'); ?>

        <div class="about-work-heading">PROFESSIONAL SKILL</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('professional', $userid, $profileid, 'Add your professional skills'); ?>
        <div class="about-work-heading">COLLEGE</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('college', $userid, $profileid, 'Add college'); ?>
        <div class="about-work-heading">HIGH SCHOOL</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('highSchool', $userid, $profileid, 'Add high school'); ?>
    </div>
</div>


<?php
}if(isset($_POST['placesLived'])){
    $userid = $_POST['placesLived'];
    $profileid = $_POST['profileid'];

    $userdata= $loadFromUser->userdata($profileid);
    ?>
<div class="overview-wrap">
    <div class="overview-left">
        <div class="about-work-heading">CURRENT CITY</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('currentCity', $userid, $profileid, 'Add your current city'); ?>

        <div class="about-work-heading">HOMETOWN</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverview('hometown', $userid, $profileid, 'Add hometown'); ?>
        <div class="about-work-heading">OTHER PLACES LIVED</div>
        <div class="about-border"></div>
        <?php $loadFromPost->aboutOverviewAlt('otherPlace', $userid, $profileid, 'Add other place'); ?>
    </div>
</div>


<?php
}
if(isset($_POST['contactBasic'])){
    $userid = $_POST['contactBasic'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">BASIC INFO</div>
        <div class="about-border"></div>
        <div class="contact-mobile" style="width: 100%;display:flex; ">
            <div class="contact-mobile-text setting" style="flex-basis:40%">Mobile Phones</div>
            <div class="contact-mobile-number setting" style="flex-basis:60%"><?php echo $userdata->mobile;?></div>
        </div>
        <div class="about-border"></div>
        <div class="contact-id" style="width: 100%;display:flex; ">
            <div class="contact-id-text setting" style="flex-basis:40%">Facebook</div>
            <div class="contact-id-number setting" style="flex-basis:60%"><?php echo $userdata->userLink;?></div>
        </div>
        <br><br>
        <div class="about-work-heading">Address</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('address', $user_id, $profileid, 'Add your address' );   ?>
        <div class="about-work-heading">WEBSITE AND SOCIAL LINKS</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('website', $user_id, $profileid, 'Add your website' );   ?>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('socialLink', $user_id, $profileid, 'Add your social link' );?>
        <div class="about-work-heading">BASIC INFORMATION</div>
        <div class="about-border"></div>
        <div class="contact-birthday setting" style="width: 100%;display:flex; ">
            <div class="contact-birthday-text" style="flex-basis:40%;font-size: 13px;color: gray;">Birth Date</div>
            <div class="contact-birthday-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userdata->birthday;?></div>
        </div>
        <div class="about-border "></div>
        <div class="contact-birthyear setting" style="width: 100%;display:flex; ">
            <div class="contact-birthyear-text" style="flex-basis:40%;font-size: 13px;color: gray;"> Birth Year</div>
            <div class="contact-birthyear-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userdata->birthday;?></div>
        </div>
        <div class="about-border "></div>
        <div class="contact-gender setting" style="width: 100%;display:flex; ">
            <div class="contact-gender-text" style="flex-basis:40%;font-size: 13px;color: gray;">Gender</div>
            <div class="contact-gender-date" style="flex-basis:60%;font-size: 13px;color: black;"><?php echo $userdata->gender;?></div>
        </div>
        <br>
        <div class="about-work-heading">LANGUAGE</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('language', $user_id, $profileid, 'Add your language' );?>
        <br>
        <div class="about-work-heading">RELIGIOUS VIEWS</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('religion', $user_id, $profileid, 'Add your religion' );?>
        <br>
        <div class="about-work-heading">POLITICAL VIEWS</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('politicalViews', $user_id, $profileid, 'Add your political views' );?>
    </div>
</div>
<?php
}
if(isset($_POST['familyRelation'])){
    $userid = $_POST['familyRelation'];
    $profileid = $_POST['profileid'];
  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">RELATIONSHIP</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverview('relationship', $user_id, $profileid, 'Add your relationship status' );?>
    </div>
</div>
<?php
}
if(isset($_POST['aboutYou'])){
    $userid = $_POST['aboutYou'];
    $profileid = $_POST['profileid'];
  $userdata = $loadFromUser->userdata($profileid);?>
<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">ABOUT YOU</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('aboutYou', $user_id, $profileid, 'Write about you' );?><br>
        <div class="about-work-heading"> OTHER NAMES</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('otherName', $user_id, $profileid, 'Add your other name' );?>
        <br>
        <div class="about-work-heading">FABORIT QUOTES</div>
        <div class="about-border"></div>
        <?php  $loadFromPost->aboutOverviewAlt('quotes', $user_id, $profileid, 'Add your favourite quotes' );?>
    </div>
</div>
<?php
}
if(isset($_POST['lifeEvent'])){
    $userid = $_POST['lifeEvent'];
    $profileid = $_POST['profileid'];

  $userdata = $loadFromUser->userdata($profileid);
    ?>

<div class="overview-wrap" style="">
    <div class="overview-left">
        <div class="about-work-heading">LIFE EVENTS</div>
        <div class="about-border"></div>
        <div class="contact-add-life-event" style="width: 100%;display:flex;color: #3578e5;cursor: pointer; ">
            <?php  $loadFromPost->aboutOverviewAlt('lifeEvent', $user_id, $profileid, 'Add life event' );?>
        </div>
    </div>
</div>


<?php

}



?>
