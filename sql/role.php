<?php
$link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$type = substr($link, strpos($link, "?") + 1); 

session_start();

$_SESSION['actor'] = $type;
$role = $type;


header('Location: ../panel/user-homepage.php?type=dashboard');

?>