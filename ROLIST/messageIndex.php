<!doctype html>
<?php
	
	session_start();
	session_unset();
    require_once('Connections/login.php'); ?>
<?php
	
	//var_dump($_SESSION);
	
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['ID_txt'])) {
  $loginUsername=$_POST['ID_txt'];
  $password=$_POST['Password_txt'];
  $MM_fldUserAuthorization = "access";
  $MM_redirectLoginSuccess = "daily_report.php";
  $MM_redirectLoginFailed = "messageIndex.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_login, $login);
  	
  $LoginRS__query=sprintf("SELECT h_id, h_password, access FROM login WHERE h_id=%s AND h_password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $login) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'access');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    echo "<script>window.alert('Login Fail');
		   window.location.href='messageIndex.php';</script>";
  }
}
?>
<html lang="ko">
<head>
  <!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
  <!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Treatment info...</title>

 


  <meta charset="utf-8">
  <title>Fixed Header</title>
  <style>

  body {
    /*background-color: #AAAAAA;*/
    margin: 0px ; 
    padding: 0px;
  }
  .header {
    text-align: left;
  }
  .jq_menu {
    text-align: left;
    background: rgba(0,85,160,0.8);
    padding: 10px 0px;
    width: 100%;
    height:50px;
    z-index:99;
    position:relative;
    -webkit-box-shadow: 0 2px 4px 0 #777;
    box-shadow: 0 2px 4px 0 #777;
  }
  #center { 
		  position:absolute;
		  top:50%;
		  left:50%;
		  width:400px;
		  height:200px;
		  margin:-100px 0 0 -200px;
		 
	
		
		
	}

  </style>


<p style="font-size: 8px; font-weight: bold; color: #999999;" valign = "top" align = "right"> LOGIN | SITEMAP | <target = "_popup" style="color: #999999">NEW PATIENT</a>&nbsp;&nbsp;|&nbsp;&nbsp; <style="color: #999999">NEW PATIENTs</a></a> &nbsp;&nbsp;</p></style>

<div class="header" style="padding:30px;">
  <p style="font-size: 20px; font-weight: bold; color: #999999;" > <a href="messageIndex.php">     
    <img src="logo.gif" alt="" width="221" height="40" /></a>  </p>
  </h1></th>

  <p> </p>
  <p> </p>

</div>
<div class="jq_menu">          
</div>
</head>


<body>
<!-- Body starts here!!! -->
<div id ="center">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th height="223" scope="col"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  
	<div class="input-group">
    	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    	<input class="form-control" type="text" name="ID_txt" id="ID_txt" placeholder="Enter ID" />
	</div>
	<br>
	<div class="input-group">
    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		<input class="form-control" type="password" name="Password_txt" id="Password_txt" placeholder="Enter Password" />
	</div>
	<br>
    <center><input type="submit" class = "btn btn-default" name="login_btn" id="login_btn" value="Login" /></center>
  
</form></th>
  </tr>
</table>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>

