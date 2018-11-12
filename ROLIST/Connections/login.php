<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_login = "localhost";
$database_login = "login";
$username_login = "root";
$password_login = "password";
$login = mysqli_connect($hostname_login,$username_login,$password_login,$database_login); 
?>