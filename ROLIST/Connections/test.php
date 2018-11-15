<?php
$fp=fopen("Connections/auth.cfg","rb");
$ids = 0;

$id=fgets($fp);
$pass=fgets($fp);
fclose($fp);

$hostname_test = "localhost";
$database_test = "test";
$username_test = trim($id);
$password_test = trim($pass);
$test = mysqli_connect($hostname_test,$username_test,$password_test,$database_test);
     

?>