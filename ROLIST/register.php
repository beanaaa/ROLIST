

<?php
		require_once('Connections/login.php'); 
		$result = mysql_select_db($database_login, $login);
		@mysql_query("set names utf8", $connect_db);
          mysql_query("set session character_set_connection=latin1;");
          mysql_query("set session character_set_results=latin1;");
          mysql_query("set session character_set_client=latin1;");

		$uid = $_POST['Id'];
		$pass = $_POST['Password'];
		$pass2 = $_POST['Password2'];
		$msg = $_POST['msg'];

		if(strcmp($pass,$pass2)==0 and strlen($pass2)>0){
 			$query = "Insert Into loginpend(h_id, h_password, msg) values ('$uid','$pass','$msg')";
			$res = mysql_query($query,$login);
		}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SIGN-UP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<form action="register.php" method=post>

      <article class="container">
        <div class="page-header">
          <h1>Sign up</h1>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
              <label for="InputId">User ID</label>
              <input type="text" class="form-control" id="Id" name = "Id" placeholder="Id">
            </div>
			
            <div class="form-group">
              <label for="InputPassword1">Password</label>
              <input type="password" class="form-control" id="Password" name = "Password"  placeholder="Password">
            </div>
			
            <div class="form-group">
              <label for="InputPassword2">Password check</label>
              <input type="password" class="form-control" id="Password2" name = "Password2"  placeholder="Password check">
              <p class="help-block">re-Enter password to verify</p>
            </div>
            <div class="form-group">
              <label for="InputPassword2">Message</label>
              <input type="msg" class="form-control" id="msg" name = "msg"  placeholder="Message to administrator">
              <p class="help-block">Leave a message to administrator (name, affliation, ...)</p>
            </div>
			
            <div class="form-group text-center">
              <button type="submit" class="btn btn-info">Register<i class="fa fa-check spaceLeft"></i></button>
            </div>
        </div>

      </article>
</form>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
