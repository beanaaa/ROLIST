<?php
$hostname_test = "localhost";
$database_test = "test";
$username_test = "root";
$password_test = "dbsgksqls";
//$test = mysql_pconnect($hostname_test, $username_test, $password_test) or trigger_error(mysql_error(),E_USER_ERROR); 

$test = mysqli_connect("localhost","root","dbsgksqls","test");
     

?>