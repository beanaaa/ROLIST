<?php
$hostname_test = "localhost";
$database_test = "test";
$username_test = "root";
$password_test = "dbsgksqls";
//$test = mysql_pconnect($hostname_test, $username_test, $password_test) or trigger_error(mysql_error(),E_USER_ERROR); 

$test = mysql_connect("localhost","root","dbsgksqls") or die(mysql_error());
mysql_select_db($database_test, $test);
     
/*
$conn = mysql_connect("localhost","root","dbsgksqls") or die(mysql_error());
mysql_select_db("test",$conn);

*/
$holiday_query = sprintf("SELECT solar_date FROM Holiday WHERE memo != ' '");
$holiday_query = mysql_query($holiday_query);
$holiday = [];
$i = -1;
do{
	$holiday[$i] = date('n/j/y',strtotime($holiday_insert['solar_date']));
	//echo $holiday[$i];
	$i++;
	
}while($holiday_insert = mysql_fetch_assoc($holiday_query));

?>