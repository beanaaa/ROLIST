<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_db = "localhost";
$database_db = "db";
$username_db = "root";
$password_db = "dbsgksqls";
$db = mysql_pconnect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(),E_USER_ERROR); 
?>