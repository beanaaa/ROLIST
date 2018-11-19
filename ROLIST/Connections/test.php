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
     
$holiday_query = sprintf("SELECT solar_date FROM Holiday WHERE memo != ' '");
$holiday_query = mysqli_query($test, $holiday_query);
$holiday = [];
$i = -1;
do{
	$holiday[$i] = date('n/j/y',strtotime($holiday_insert['solar_date']));
	//echo $holiday[$i];
	$i++;
	
}while($holiday_insert = mysqli_fetch_assoc($holiday_query));

?>