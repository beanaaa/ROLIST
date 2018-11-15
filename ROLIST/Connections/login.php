<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$fp=fopen("Connections/auth.cfg","rb");
$ids = 0;

$id=fgets($fp);
$pass=fgets($fp);
fclose($fp);

$hostname_login = "localhost";
$database_login = "login";
$username_login = trim($id);
$password_login = trim($pass);
$login = mysqli_connect($hostname_login,$username_login,$password_login,$database_login); 
?>