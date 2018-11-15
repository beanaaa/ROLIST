<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DB Set up</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <!-- Custom style -->
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">
  </head>




<?php
	error_reporting(0);	

$rootId = $_POST['Id'];
$rootPassword = $_POST['Password'];

if(strlen($rootId) !=0){
    $servername = "localhost";
    $username = $rootId;
    $password = $rootPassword;
    $conn = new mysqli($servername, $username, $password);
    $sql = "Drop DATABASE test";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $query = "select 1 from Information_schema.SCHEMATA where SCHEMA_NAME = 'test'";
    $testExt = mysqli_num_rows(mysqli_query($conn,$query));
    if($testExt==0){
        $sql = "CREATE DATABASE test";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $db_handle = mysqli_connect("test", $username, $password);
        $query = '';
        $sqlScript = file('DBStructure/TableStructure.sql');
        $connTest =new mysqli('localhost', $username, $rootPassword , "test");

        foreach ($sqlScript as $line)	{
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
                
            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($connTest,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
                $query= '';		
            }
        }
        echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
    }
    $sql = "drop DATABASE login";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $query = "select 1 from Information_schema.SCHEMATA where SCHEMA_NAME = 'login'";
    $testExt = mysqli_num_rows(mysqli_query($conn,$query));
    if($testExt==0){
        $sql = "CREATE DATABASE login";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        $db_handle = mysqli_connect("login", $username, $password);
        $connLogin =new mysqli('localhost', $username, $rootPassword , "login");

        $query = '';
        $sqlScript = file('DBStructure/member.sql');
        foreach ($sqlScript as $line)	{
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
                
            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($connLogin,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
                $query= '';		
            }
        }
        echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
        





        
    }




    // echo($testExt);

}



// $servername = "localhost";
// // $username = "username";
// // $password = "password";

// // Create connection
// $conn = new mysqli($servername, $username, $password);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// // Create database
// $sql = "CREATE DATABASE myDB";
// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . $conn->error;
// }

// $conn->close();
?>


<form action="install.php" method=post>

<article class="container">
  <div class="page-header">
    <h1>Database Installation</h1>
  </div>
  <div class="col-md-6 col-md-offset-3">
      <div class="form-group">
        <label for="InputId">Root ID</label>
        <input type="text" class="form-control" id="Id" name = "Id" placeholder="Id">
      </div>
      
      <div class="form-group">
        <label for="InputPassword1">Password</label>
        <input type="password" class="form-control" id="Password" name = "Password"  placeholder="Password">
      </div>
            
      <div class="form-group text-center">
        <button type="submit" class="btn btn-info">Install<i class="fa fa-check spaceLeft"></i></button>
      </div>
  </div>

</article>
</form>
