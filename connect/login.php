<?php

include 'DB.php';

class login{

    public static function isLoggedIn(){
        if(isset($_COOKIE['FBID'])){
            if(DB::query('SELECT user_id FROM token WHERE token = :token', array(':token' => sha1($_COOKIE['FBID'])))){

                $user_id = DB::query('SELECT user_id FROM token WHERE token = :token', array(':token' => sha1($_COOKIE['FBID'])))[0]['user_id'];

                return $user_id;



            }

        }
    }

}


?>
