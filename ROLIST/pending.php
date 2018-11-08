<!doctype html>
<link rel="stylesheet" href="normalize.css">
<meta charset="utf-8">
<?php 	
if (!isset($_SESSION)) {
session_cache_expire(10000000);  

session_start();
  
  function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$curPage = "daily_report.php";
$permitUser = $_SESSION['MM_UserGroup'];
include("configuration.php");

include("idc.php");

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
    $week_post = $_POST['weekago'];
    

	$searchQ = $_POST['txt_search'];
	$searchQ=preg_replace("/\s+/","",$searchQ); 

// 	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '%$searchQ%' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
				$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}

	for($phsIds=0;$phsIds<$numphyss;$phsIds++){

		if(strcmp($uid,$phyInt[$phsIds])==0){
			$md2 = $phyInt[$phsIds];
		}


}


	$md2t = $_POST['mdname'];
	if(strlen($md2t)>0){
		$md2 = $md2t;
	}
	$md = $md2;		


	for($idphyss=0;$idphyss<$numphyss;$idphyss++){
		if(strcmp($md2,$phyInt[$idphyss])==0){
			$md = $phyIdd[$idphyss];		
		}
	}





	$screenRatio = 1.2;
	$siteInput = $_POST['site'];	
	if(strlen($uid)<1){ 
	$uid=$_POST['username'];
	}
}

?>

<?php 
    
	if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
	require_once('Connections/test.php'); 
	}
	else{
 		$MM_restrictGoTo = "index.php";
 		header("Location: ". $MM_restrictGoTo); 
	require_once('Connections/test.php'); 

	}
	 ?>

<?php


if (!isset($_SESSION)) {
	session_start();
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup){
        // For security, start by assuming the visitor is NOT authorized.
		$isValid = False;
        
        // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
        // Therefore, we know that a user is NOT logged in if that Session variable is blank.
		if (!empty($UserName)) {
            // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
            // Parse the strings into arrays.
			$arrUsers  = explode(",", $strUsers);
			$arrGroups = explode(",", $strGroups);
			if (in_array($UserName, $arrUsers)) {
				$isValid = true;
				}
            // Or, you may restrict access to only certain users based on their username.
            if (in_array($UserGroup, $arrGroups)) {
                $isValid = true;
            }
            if (($strUsers == "") && false) {
                $isValid = true;
            }
        }
        return $isValid;
    }
    if ($_POST['permit'] != NULL) {
        $permitUser = $_POST['permit'];
    }
    if ($_GET['permit'] != NULL) {
        $permitUser = $_GET['permit'];
    }
    $week_post = $_POST['weekago'];
	$md = $_POST['mdname'];	
}


if ($permitUser == 1 | $permitUser == 2 | $permitUser == 3) {
	require_once('Connections/test.php');
} else {
	$MM_restrictGoTo = "index.php";
	header("Location: " . $MM_restrictGoTo);
	require_once('Connections/test.php');
}
?>
<html lang="ko">


<head>


</head>

<body>
	


<?php
		require_once('Connections/login.php'); 
		$result = mysql_select_db($database_login, $login);
		$uid = $_POST['btn_comment'];
		$pass = $_POST['ids'];
		$cat = $_POST['cat'];
		$access = $_POST['access'];
		mysql_query("set session character_set_connection=latin1;");
		mysql_query("set session character_set_results=latin1;");
		mysql_query("set session character_set_client=latin1;");
		
		if($cat==1 and strcmp($uid,"Accept")==0){
			$openquery = "select * from loginpend where h_id like '$pass'";
			$insertFetch = mysql_fetch_assoc(mysql_query($openquery));
 			$updateQuery = "Insert Into login (h_id,h_password,access) values ('$insertFetch[h_id]','$insertFetch[h_password]',$access)";
 			$deleteQuery = "Delete from loginpend where h_id like '$insertFetch[h_id]'";
 			mysql_query($updateQuery);
 			echo("<br>");
 			mysql_query($deleteQuery); 			
			
		}
		if($cat==1 and strcmp($uid,"Reject")==0){
			$openquery = "select * from loginpend where h_id like '$pass'";
			$insertFetch = mysql_fetch_assoc(mysql_query($openquery));
 			$updateQuery = "Insert Into login (h_id,h_password,'access') values ($insertFetch[h_id],$insertFetch[h_password],$access)";
 			$deleteQuery = "Delete from loginpend where h_id like '$insertFetch[h_id]'";
 			mysql_query($deleteQuery); 			
			
		}
		
		if($cat==2 and strcmp($uid,"Change")==0){
			$openquery = "select * from login where h_id like '$pass'";
			$insertFetch = mysql_fetch_assoc(mysql_query($openquery));
 			$updateQuery = "Update login Set access= $access where h_id like '$insertFetch[h_id]'";
 			mysql_query($updateQuery);
			
		}
		if($cat==2 and strcmp($uid,"Delete")==0){
			$openquery = "select * from login where h_id like '$pass'";
			$insertFetch = mysql_fetch_assoc(mysql_query($openquery));
 			$deleteQuery = "Delete from login where h_id like '$insertFetch[h_id]'";
 			mysql_query($deleteQuery); 			
			
		}
		

?>
<!DOCTYPE html>










	


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Authentication</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>


      <article class="container">
        <div class="page-header">
          <h3>Pending Registrations</h3>
        </div>



        <?php
$queries = mysql_query("select * from loginpend");
$numPends = mysql_num_rows($queries);




?>

<form action="pending.php" method=post>
<table class="table">
  <thead class="thead-dark">	
	<tr>
		<td>
			Id
		</td>
		<td>
			Message
		</td>
		<td>
			Permission
		</td>
		<td align=right>
			Action
		</td>
		
	</tr>
  </thead>
	
<?php
$queries = mysql_query("select * from loginpend");
$abss = mysql_num_rows($queries);

for($idx = 0;$idx<$numPends;$idx++){
	$data = mysql_fetch_assoc($queries);
	
	
	echo("<tr>");
	echo("<td>");	
	echo($data[h_id]);
	echo("</td>");	
	echo("<td>");	
	echo($data[msg]);
	echo("</td>");	
	
	$val1 = $data[h_id]."1";
	$val2 = $data[h_id]."2";
	$val3 = $data[h_id]."3";
	echo("<form id=form5 name=form5 method=post  action=pending.php ><td>");	
	echo("<select class='form-control' name='access'>");
	echo("<option value='3'>Reader</option>");		
	echo("<option value='2'>Writer</option>");
	echo("<option value='1'>Administrator</option>");
	echo("</select>");
	
	echo("</td>");	
	
	
	echo  "<td align=right bgcolor=$bgcolorF>";
	echo "<input class = 'btn btn-info btn-sm' type=submit name=btn_comment id=btn_comment value=Accept />";
	echo "<input class = 'btn btn-danger btn-sm' type=submit name=btn_comment id=btn_comment value=Reject />";
	echo "<input name=ids type=hidden id=ids  value=$data[h_id]>";
	echo "<input name=cat type=hidden id=cat  value='1'></form></td>";
	
	
	echo("</tr>");	
}
	
?>
</table>
</form>

      </article>

      <article class="container">
        <div class="page-header">
          <h3>Registered Users</h3>
        </div>



<table class="table">
  <thead class="thead-dark">	
	<tr>
		<td>
			Id
		</td>
		<td>
			
		</td>
		<td >
			Permission
		</td>
		<td align=right>
			Action
		</td>
		
	</tr>
  </thead>
<?php
$queries = mysql_query("select * from login");
$abss = mysql_num_rows($queries);
$numPends = mysql_num_rows($queries);

for($idx = 0;$idx<$numPends;$idx++){
	$data = mysql_fetch_assoc($queries);
	
	
	echo("<tr>");
	echo("<td>");	
	echo($data[h_id]);
	echo("</td>");	
	echo("<td>");	
	echo($data[msg]);
	echo("</td>");	
	
	echo("<form id=form5 name=form5 method=post  action=pending.php ><td>");
	if($data[access]==1){
		$selAccess = "Administrator";
	}
	if($data[access]==2){
		$selAccess = "Writer";		
	}
	if($data[access]==3){
		$selAccess = "Reader";		
	}	

		
	echo("<select class='form-control' name='access'>");
	echo("<option value='$data[access]' select='selected'>$selAccess</option>");	
	echo("<option value='1'>Administrator</option>");
	echo("<option value='2'>Writer</option>");
	echo("<option value='3'>Reader</option>");		
	echo("</select>");
	
	echo("</td>");	
	
	
	echo  "<td align=right bgcolor=$bgcolorF>";
	echo "<input class = 'btn btn-info btn-sm' type=submit name=btn_comment id=btn_comment value=Change />";
	echo "<input class = 'btn btn-danger btn-sm' type=submit name=btn_comment id=btn_comment value=Delete />";
	echo "<input name=ids type=hidden id=ids  value=$data[h_id]>";
	echo "<input name=cat type=hidden id=cat  value='2'></form></td>";
	
	
	echo("</tr>");	
}
	
?>
</table>
      </article>










    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
	
	
	
	
	
	
	
</body>




</html>
