<?php
$host = 'localhost'; 
$database = 'furniture'; 
$user = 'roketstemp'; 
$password = 'dayn123123';

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
?>
