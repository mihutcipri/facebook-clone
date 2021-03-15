<?php

include 'database/connection.php';
include 'classes/users.php';
include 'classes/post.php';

global $pdo;

$loadFromUser = new User($pdo);
$loadFromPost = new Post($pdo);

define("BASE_URL", "http://localhost/facebook/");


?>
