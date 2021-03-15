<?php

$hostDetails = 'mysql:host=127.0.0.1; dbname=facebook; charset=utf8mb4';
$userAdmin = 'cipri';
$pass = 'mihut';

try{
    $pdo = new PDO($hostDetails,$userAdmin,$pass);
} catch(PDOExecption $e){
    echo 'Connection error!' . $e->getMessage();
}

?>
