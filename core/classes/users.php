<?php

class User  {
    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;

    }
public function checkInput($variable){
    $variable = htmlspecialchars($variable);
    $variable = trim($variable);
    $variable = stripslashes($variable);
    return $variable;
}

    public function checkEmail($email_mobile){
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email_mobile, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            return true;
        }else{
            return false;
        }


    }
    

public function create($table, $fields=array()){
    $columns = implode(',', array_keys($fields));
//first-name,last-name,mobile

    $values = ':'.implode(', :', array_keys($fields));

//    :first-name, :last-name, :mobile
$sql = "INSERT INTO {$table}({$columns})VALUES ({$values})";

    if($stmt = $this->pdo->prepare($sql)){
        foreach($fields as $key => $data){
            $stmt->bindValue(':'.$key, $data);
        }
        $a=$stmt->execute();
        
        return $this->pdo->lastInsertId();
    }
}

    public function userIdByUsername($username){
        $stmt = $this->pdo->prepare('SELECT user_id FROM users WHERE userLink = :username');
        $stmt->bindparam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        return $user->user_id;

    }
    public function userData($profileId){
       $stmt = $this->pdo->prepare("SELECT * FROM users LEFT JOIN profile ON users.user_id = profile.userId WHERE users.user_id = :user_id");
        $stmt->bindParam(':user_id', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($table, $user_id, $fields = array()){
        $columns = '';
        $i = 1;

        foreach($fields as $name => $value){
            $columns .= "{$name} = :{$name}";
//            coverPic = :coverPic, profilePic = :profilePic,
            if($i < count($fields)){
                $columns .= ', ';
            }
            $i++;


        }
         $sql = "UPDATE {$table} SET {$columns} WHERE userId = {$user_id}";
//        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if($stmt = $this->pdo->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();

    }
public function userUpdate($table, $user_id, $fields = array()){
        $columns = '';
        $i = 1;

        foreach($fields as $name => $value){
            $columns .= "{$name} = :{$name}";
//            coverPic = :coverPic, profilePic = :profilePic,
            if($i < count($fields)){
                $columns .= ', ';
            }
            $i++;


        }
         $sql = "UPDATE {$table} SET {$columns} WHERE user_id = {$user_id}";
//        UPDATE profile SET coverPic = :coverPic, profilePic = :profilePic WHERE userId = 10;
        if($stmt = $this->pdo->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(':'.$key, $value);
            }
        }
        $stmt->execute();

    }

    public function timeAgo($datetime){
 $time = strtotime($datetime);
        $current = time();
        $seconds = $current-$time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600);
        $months = round($seconds/2600640);

        if($seconds <= 60){
            if($seconds == 0){
                return '0s';

            }else{
                return ''.$seconds.'s';
            }

        }else if($minutes <= 60){
            return ''.$minutes.'m';
        }else if($hours <= 24){
            return ''.$hours.'h';
        }else if($months <= 24){
            return ''.date('M j', $time);
        }else{
            return ''.date('j M Y', $time);
        }
    }
    public function timeAgoForCom($datetime){
        $time = strtotime($datetime);
        $current = time();
        $seconds = $current-$time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600);
        $months = round($seconds/2600640);

        if($seconds <= 60){
            if($seconds == 0){
                return '0s';

            }else{
                return ''.$seconds.'s';
            }

        }else if($minutes <= 60){
            return ''.$minutes.'m';
        }else if($hours <= 24){
            return ''.$hours.'h';
        }else if($months <= 24){
            return ''.date('M j', $time);
        }else{
            return ''.date('j M Y', $time);
        }
    }

    public function delete($table, $array){
        $sql = "DELETE FROM `{$table}`";
        $where = " WHERE ";
        foreach($array as $name=>$value){
            $sql .= "{$where} `{$name}` = :{$name}";
            $where = " AND ";
        }
        if($stmt = $this->pdo->prepare($sql)){
            foreach($array as $name=>$value){
                $stmt->bindValue(':'.$name, $value);
            }
             $stmt->execute();
        }

    }


}

?>
