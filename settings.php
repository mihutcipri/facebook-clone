<?php
include 'include/header.php';

?>
<div class="settings-wrap">
    <div class="user-setting-wrap justify" style="border-top-left-radius:5px; border-top-right-radius:5px; background-color: gainsboro;">
        <h3 class="align-middle" style="color: #3f51b5">Settings</h3>
    </div>
    <div class="user-name-wrap justify" data-userid="<?php echo $userid; ?>">
        <div class="sett-head">Change Username</div><span class="set-changed-name"><?php echo ''.$userData->first_name.' '.$userData->last_name.''; ?></span>
    </div>
    <div class="user-link-wrap justify" data-userid="<?php echo $userid; ?>">
        <div class="sett-head">Change User Link</div><span class="set-changed-userLink"><?php echo $userData->userLink; ?></span>
    </div>
    <div class="mobile-number-wrap justify" data-userid="<?php echo $userid; ?>">
       <?php if(!empty($userData->mobile)){ ?>
        <div class="sett-head">Change Mobile Number</div><span class="set-changed-mobile"><?php echo $userData->mobile; ?></span>
        <?php }else{?>
        <div class="sett-head">Change Mobile Number</div><span class="set-changed-mobile">No mobile number has found. Add one.</span>
          <?php } ?>
    </div>
      <div class="email-id-wrap justify" data-userid="<?php echo $userid; ?>">
       <?php if(!empty($userData->email)){ ?>
        <div class="sett-head">Change Your Email</div><span class="set-changed-email"><?php echo $userData->email; ?></span>
        <?php }else{?>
        <div class="sett-head">Change Your Email</div><span class="set-changed-email">No email has found. Add one.</span>
          <?php } ?>
    </div>
    <div class="user-password-wrap justify" data-userid="<?php echo $userid; ?>">
        <div class="sett-head">Change Password</div><span class="set-changed-password">*******</span>
    </div>




</div>

<div class="top-box-show2">




</div>



  <script src="assets/js/jquery.js "></script>

        <script src="assets/dist/emojionearea.min.js"></script>
        <script src="assets/js/main.js"></script>

<script>

$(function(){
    $(document).on('click','.user-name-wrap', function(){
        var userid = $(this).data('userid');
        var firstName='<?php echo $userData->firstName; ?>';
        var lastName='<?php echo $userData->lastName; ?>';
        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input"><h3>Change your name</h3><label for="first-name-change">First Name: </label><input type="text" name="" id="first-name-change" value="'+firstName+'" class="input-style"><label for="last-name-change"> Last Name: </label><input type="text" name="" id="last-name-change" value="'+lastName+'" class="input-style"><br><br><input type="submit" value="Submit" id="name-change-submit" data-userid="'+userid+'" class="input-style"></div></div>');

})

    $(document).on('click', '#name-change-submit', function(){
        var firstName = $('#first-name-change').val();
        var lastName = $('#last-name-change').val();
        var userid = $(this).data('userid');
        if(firstName == '' || lastName == ''){
            alert('All field must be filled.')
        }else{
            $.post('http://localhost/facebook/core/ajax/settings.php', {
                changeName: userid,
                firstName : firstName,
                lastName : lastName
            }, function(data){
                $('.set-changed-name').html(''+firstName+' '+lastName+'');
                $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                setTimeout(function(){
                    $('.top-box-show2').empty();
                    location.reload();
                }, 3000);
            })
        }
    })

    $(document).on('click','.user-link-wrap', function(){
        var userid = $(this).data('userid');
        var userLink='<?php echo $userData->userLink; ?>';
        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input"><h3>Change User Link</h3><label for="user-link-change">User Link: </label><input type="text" name="" id="user-link-change" value="'+userLink+'" class="input-style"><br><br><input type="submit" value="Submit" id="user-link-submit" data-userid="'+userid+'" class="input-style"></div></div>');

})

    $(document).on('click', '#user-link-submit', function(){
        var userLink = $('#user-link-change').val();
        var userid = $(this).data('userid');
        if(userLink == ''){
            alert('Field is empty.')
        }else{
            $.post('http://localhost/facebook/core/ajax/settings.php', {
                userLink: userLink,
                userid: userid
            }, function(data){
                    if(data.trim() == '<h3 style="color:#4caf50;">User Link has changed successfully.</h3>'){
                                    $('.set-changed-userLink').html(userLink);
                                    $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);
                        }else{
                              $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);
                        }
            })
        }
    })
 $(document).on('click','.mobile-number-wrap', function(){
        var userid = $(this).data('userid');
        var mobileChange='<?php echo $userData->mobile; ?>';
        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input"><h3>Change Your Mobile Number</h3><label for="mobile-number-change">Mobile Number: </label><input type="text" name="" id="mobile-number-change" value="'+mobileChange+'" class="input-style"><br><br><input type="submit" value="Submit" id="mobile-number-submit" data-userid="'+userid+'" class="input-style"></div></div>');

})


    $(document).on('click', '#mobile-number-submit', function(){
        var mobileChange = $('#mobile-number-change').val();
        var userid = $(this).data('userid');
        if(mobileChange == ''){
            alert('Field is empty.')
        }else{
            $.post('http://localhost/facebook/core/ajax/settings.php', {
                mobileChange: mobileChange,
                userid: userid
            }, function(data){
                    if(data.trim() == '<h3 style="color:#4caf50;">Mobile number has changed successfully.</h3>'){
                        $('.set-changed-mobile').html(mobileChange);
                                    $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);
                    }else{
                        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);

                    }

            })
        }
    })

    $(document).on('click','.email-id-wrap', function(){
        var userid = $(this).data('userid');
        var emailChange='<?php echo $userData->email; ?>';
        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input"><h3>Change Your Email</h3><label for="email-id-change">Email: </label><input type="email" name="" id="email-id-change" value="'+emailChange+'" class="input-style"><br><br><input type="submit" value="Submit" id="email-id-submit" data-userid="'+userid+'" class="input-style"></div></div>');

})


    $(document).on('click', '#email-id-submit', function(){
        var emailChange = $('#email-id-change').val();
        var userid = $(this).data('userid');
        if(emailChange == ''){
            alert('Field is empty.')
        }else{
            $.post('http://localhost/facebook/core/ajax/settings.php', {
                emailChange: emailChange,
                userid: userid
            }, function(data){
                    if(data.trim() == '<h3 style="color:#4caf50;">Email has changed successfully.</h3>'){
                        $('.set-changed-email').html(emailChange);
                                    $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);
                    }else{
                        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);

                    }

            })
        }
    })
    $(document).on('click','.user-password-wrap', function(){
        var userid = $(this).data('userid');
        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input"><h3>Change Password</h3><label for="old-password">Old Password: </label><input type="password" name="" id="old-password" value="" class="input-style"><label for="new-password">New Password: </label><input type="password" name="" id="new-password" value="" class="input-style"><br><br><input type="submit" value="Submit" id="password-submit" data-userid="'+userid+'" class="input-style"></div></div>');

})


    $(document).on('click', '#password-submit', function(){
        var oldPassword = $('#old-password').val();
        var newPassword = $('#new-password').val();
        var userid = $(this).data('userid');
        if(oldPassword == '' || newPassword == ''){
            alert('All field must be filled.');
        }else{
            $.post('http://localhost/facebook/core/ajax/settings.php', {
                oldPassword: oldPassword,
                newPassword: newPassword,
                userid: userid
            }, function(data){
                    if(data.trim() == '<h3 style="color:#4caf50;">Password has changed successfully.</h3>'){
                                    $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        window.location.href="logout.php";
                                    }, 3000);
                    }else{
                        $('.top-box-show2').html('<div class="change-input-wrap"><div class="change-input">'+data+'</div></div>');
                                    setTimeout(function(){
                                        $('.top-box-show2').empty();
                                        location.reload();
                                    }, 3000);

                    }

            })
        }
    })


  $(document).mouseup(function(e) {
                    var container = new Array();
                    container.push($('.change-input'));

                    $.each(container, function(key, value) {
                        if (!$(value).is(e.target) && $(value).has(e.target).length === 0) {
                            $('.top-box-show2').empty();
                        }
                    })


                })


})

</script>




</body>
</html>