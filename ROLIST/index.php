<!doctype html>
<?php
	
	session_start();
	session_unset();
  require_once('Connections/login.php'); ?>
<?php
	
	// var_dump($_SESSION);
	

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
  
  if($loginUsername=="nurse"){ 
  $MM_redirectLoginSuccess = "daily_report_nurse_r2.php";
  }
  elseif($loginUsername=="tcr"){ 
  $MM_redirectLoginSuccess = "activelistctrlr.php";
  }
  elseif($loginUsername=="TCR"){ 
  $MM_redirectLoginSuccess = "activelistctrlr.php";
  }
  elseif($loginUsername=="Tcr"){ 
  $MM_redirectLoginSuccess = "activelistctrlr.php";
  }
  else{
  $MM_redirectLoginSuccess = "daily_report.php";
	  
  }
  
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;

  $LoginRS__query=	"Select h_id, h_password, access From login where h_id = '$loginUsername' and h_password='$password'";
  // $LoginRS__query=sprintf("SELECT h_id, h_password, access FROM login WHERE h_id=%s AND h_password=%s",
  // GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($login,$LoginRS__query);
  
  // echo($LoginRS__query);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  echo($loginFoundUser);

  if ($loginFoundUser !=0) {
 
    $temp = mysqli_fetch_assoc($LoginRS);
    $loginStrGroup= $temp[access];
    echo($MM_redirectLoginSuccess);
    session_regenerate_id(true);
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
    // $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    // echo($MM_redirectLoginSuccess);
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }

    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    // echo($loginFoundUser);
    // echo( $LoginRS__query);
    // echo($loginFoundUser);    
     echo "<script>window.alert('Login Fail');
		    window.location.href='index.php';</script>";
  }
}
?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>ROLIST</title>

 


  <meta charset="utf-8">

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



<div class="header" style="padding:30px;">
  <p style="font-size: 20px; font-weight: bold; color: #999999;" > <a href="index.php">     
<!--     <img src="logo.gif" alt="" width="221" height="40" /> -->
    </a>  
    </p>
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
	
    <center><input type="submit" class = "btn btn-info" name="login_btn" id="login_btn" value="SIGN-IN" />
</form>

<input type="button" class="btn btn-info" value="SIGN-UP" onclick="location.href = 'register.php';"></center>  

</th>
  </tr>
  <tr>
	  
  </tr>
  
  
  
  
</table>
</div>
<font color= #116639>
<?php


	?>
</font>
</body>
</html>


