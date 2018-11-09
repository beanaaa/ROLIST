<!doctype html>
<meta charset="utf-8">
<?php
function mysqli_result($res,$row=0,$col=0)
{ 
	$nums=mysqli_num_rows($res);
	if($nums && $row<=($nums-1) && $row>=0)
	{
		mysqli_data_seek($res,$row);
		$resrow=(is_numeric($col))?mysqli_fetch_row($res):mysqli_fetch_assoc($res);
		if(isset($resrow[$col]))
		{
			return $resrow[$col];
		}
	}
	return false;
}
	
	error_reporting(0);	
?>


<?php 
$permitUser = 0;
if (!isset($_SESSION)) {
  session_start();
  
  function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

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

$permitUser = $_POST['permit'];


if($_POST['rev']==''){
	$menu = 0;
}
if($_POST['rev']!='' && $_POST['rev'] ==0 ){
$menu = 1;
	
}
if($_POST['rev']!='' && $_POST['rev'] ==1 ){
$menu = 0;	
}
if($_POST['insert_rev']==0){
	$insert_menu = 0;	
}

if($_POST['insert_rev']==1){
	$insert_menu = 1;	
}


//echo $menu;// MUST BE DELETED!!!!
//echo $insert_menu;
} ?>
,

<?php 
    
	if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
	require_once('Connections/test.php'); 
	mysqli_select_db($database_test );
	}
	else{
 		$MM_restrictGoTo = "testphpr2.php";
 		header("Location: ". $MM_restrictGoTo); 
	require_once('Connections/test.php'); 
	mysqli_select_db($database_test );

	}
	 ?>
	 
<html lang="ko">
<head>
	<meta http-equiv="refresh" content="600;url=index.php">
  <!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
  <!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->

  <title>Treatment info...</title>

  <style type="text/css">
	  
input[type=text] {
    padding:5px; 
    border:2px solid #ccc; 
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

input[type=text]:focus {
    border-color:#333;
}

input[type=submit] {
    padding:5px 10px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 2px;
    border-radius: 2px; 
}	  
input[type=button] {
    padding:5px 10px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 2px;
    border-radius: 2px; 
}	  
select {
    padding:5px; 
    border:2px solid #ccc; 
    height: 20px;
    width: 70px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}	  

  #apDiv1 {
    position: absolute;
    width: 1055px;
    height: 115px;
    z-index: 1;
    left: -1px;
    top: 111px;
  }
  
 body,td,th {
    font-family:  Century Gothic, sans-serif;
    color: rgba(0, 0, 0, 0.76);
    font-size: 12px;
    text-align: left;
  }
 

  a:link {
    color: #09C;
  }
  a:visited {
    color: #06C;
  }
  a:hover {
    color: #0075BE;
    font-weight:  100;
  }
  a:active {
    color: #069;
  }
  body table tr td p {
    color: #900;
  }
    </style>
  <link type="text/css" rel="stylesheet" href="js/modalLayer.css" />
  <script type="text/javascript" src="js/jquery-latest.min.js"></script>
  <script type="text/javascript" src="js/jquery.modalLayer.js"></script>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.open_modal').modalLayer();
  });
  </script>

  <meta charset="utf-8">
  <title>Fixed Header</title>
  <style>
  #mask {  
    position:absolute;  
    z-index:9000;  
    background-color:#000;  
    display:none;  
    left:0;
    top:0;
  } 
  #MainTable {
    width: 100%;
    background-color: #D8F0DA;
    border: 0px;
    min-width: 100%;
    /*position: relative;*/
    opacity: 0.5;
    background: transparent;
  }
  .window{
    display: none;
    position:relative;  

    width: 100%;
    height: 100%;
    left:30%;
    top:30%;
    z-index:10000;
  }
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
  .wrapper {
    min-height: 500px;
  }
  .jq_fixed {
    position: fixed;
    top: 0px;

  }
  #layer_fixed
  {
    height:40px;
    width:100%;
    color: #555;
    font-size:12px;
    position:fixed;
    z-index:999;
    bottom:0px;
    left:0px;
    -webkit-box-shadow: 0 1px 2px 0 #777;
    box-shadow: 0 1px 2px 0 #777;
    background: rgba(47,137,50,0.8);

  }

  </style>

  <script src="js/jquery-1.11.0.min.js"></script>
  <script>
  $( document ).ready( function() {
    var jbOffset = $( '.jq_menu' ).offset();
    $( window ).scroll( function() {
      if ( $( document ).scrollTop() > jbOffset.top ) {
        $( '.jq_menu' ).addClass( 'jq_fixed' );
      }
      else {
        $( '.jq_menu' ).removeClass( 'jq_fixed' );
      }
    });
  } );
  </script>

	

<p style="font-size: 8px; font-weight: bold; color: #999999;" valign = "top" align = "right"> 
	<a href="index.php" style=color: #999999>LOGOUT </a> 
		| SITEMAP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


</head>


<body>
<!-- Body starts here!!! -->


<?php require_once('Connections/test.php'); ?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST['hd_del'])) && ($_POST['hd_del'] != "")) {
  
  $deleteSQL = sprintf("delete from OrderTemp where idx = %s and Hospital_ID = %s",
  $_POST['hd_del'],
  $_POST['ho_id']);
  echo($deleteSQL);
  $Result1 = mysqli_query($test, $deleteSQL );

  $deleteGoTo = "testphpr2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  //header(sprintf("Location: %s", $deleteGoTo));
}

mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");


//echo GetSQLValueString($h_id, "int");
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
 	$h_id = $_POST['txt_hospital_id'];
 	$sql_test = mysqli_query($test, "select * from OrderTemp where Hospital_ID = '$h_id'");
 	$sql_test_rows = mysqli_num_rows($sql_test); // mysql row 수를 판단하여 중복 유/무 판별
  
 	if($sql_test_rows>'0'){
 	$sql_idx = mysqli_query($test, "select idx from OrderTemp where Hospital_ID = '$h_id'");   
 	$n = mysqli_num_rows($sql_idx);
 	$idxx = mysqli_result($sql_idx,$n-1,'idx');
 	$j = $idxx + 1;
 
 	$txt_comment = "txt_comment"."$n";
 	$txt_comment_date = "txt_comment_date"."$n";
     
 	if(strlen($_POST['txt_Memo']) !=0){
 	  $updateSQL = sprintf("insert into OrderTemp(Hospital_ID, Memo1, Date1, idx) values ('%s', '%s', '%s', $j)" ,
                       $_POST['txt_hospital_id'],
                       $_POST['txt_Memo'],
                       $_POST['txt_Date']
                       //GetSQLValueString($colname_patientinfo, "int"),
                       );

 	  // $updateSQL = mysqli_query($test, sprintf("Update TreatmentInfo Set NumOrder='$j' where Hospital_ID like '%s'", $colname_patientinfo));

     echo $updateSQL;

		 	$Result1 = mysqli_query($test, $updateSQL );
		 	mysqli_query($test, "Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $h_id");
		 	
 
  		}
  	if(strlen($_POST['txt_Memo']) ==0 && $insert_menu==1){
 		         
    for($i=0; $i<$sql_test_rows; $i++){
	    
	$idx_i = mysqli_result($sql_idx,$i,"idx");
    $txt_comment = "txt_comment"."$idx_i";
	$txt_comment_date = "txt_comment_date"."$idx_i";
    	
    $updateSQL = sprintf("update OrderTemp SET Memo1 = %s, Date1=%s where Hospital_ID = $h_id and idx = '$idx_i'",
    				$_POST[$txt_comment],
    				$_POST[$txt_comment_date]);
            echo $updateSQL;

		$C_result = mysqli_query($test, $updateSQL );
    mysqli_query($test, "Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $h_id");
		
		    //echo $updateSQL1;
    	}
    }
  }
  if($sql_test_rows=='0'){
    echo($_POST['txt_Memo']);
	if(strlen($_POST['txt_Memo']) !=0){
 	  $colname_patientinfo = $_POST['ho_id'];
	$updateSQL = sprintf("insert into OrderTemp(Hospital_ID, Memo1, Date1, idx) values ('%s', '%s', '%s', 1)" ,
                       $colname_patientinfo,
                       $_POST['txt_Memo'],
                       $_POST['txt_Date']
                       //GetSQLValueString($colname_patientinfo, "int"),
                       );
    echo $updateSQL;
    
    	$Result1 = mysqli_query($test, $updateSQL );
      mysqli_query($test, "Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $h_id");
    	
		
    } 
	  
  }
  
  sleep(1);
  $updateGoTo = "testphpr2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  // header(sprintf("Location: %s", $updateGoTo));
}


$colname_patientinfo = "-1";
if (isset($_POST['hc_field'])) {
  $colname_patientinfo = $_POST['hc_field'];
}
if (isset($_POST['ho_id'])){
	$colname_patientinfo = $_POST['ho_id'];
}

//echo $colname_patientinfo;
mysqli_select_db($database_test );

$query_TempMemo = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = %s", $colname_patientinfo);
$MemoInfo = mysqli_query($test, $query_TempMemo ) or die(mysqli_error());
//$a_MemoInfo = mysqli_data_seek($MemoInfo, 8);
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

//echo $total_Memoinfo;
// $h_id = GetSQLValueString($colname_patientinfo, "string");
$h_id = $colname_patientinfo;


?>
<title>EDIT</title>
<style type="text/css">
</style>
<table width="70%" border="0" cellspacing="1" cellpadding="1" align ="center">
<tr>
<td width="40%"><p style="font-family: Century Gothic, sans-serif; font-size:30px"> Radiation Oncology Record for patient <?php echo $h_id ?> </p></td></tr>
</table>
<hr>
<table width="70%" border="0" cellspacing="1" cellpadding="1" align ="center">

<tr>
 <td valign="middle" width="40%" scope="row" colspan="2" height="60" valign="middle"> </td>
 <td width="40%">
<form id = "form11" name = "form11" method="POST" action = "shortorder.php">
	<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser?> />
	<input type = "hidden" name = "ho_id" id = "ho_id" value=<?php echo $colname_patientinfo ?> />
	<input type = "hidden" name = "rev" id = "rev" value="<?php echo $menu?>"/>
 	<input type = "submit" name = "revise" id = "revise" value="Edit-mode" />
						
</form></td>
</tr>
</table>

<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">



  <table width="70%" border="0" cellspacing="1" cellpadding="1" align ="center">
    
    <?php
	    
	$Today_Date = Date("n/j/y");
	//echo $Today_Date;    
	$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$h_id'");
	$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$h_id'"); 
	$sql_idx = mysqli_query($test, "select idx from OrderTemp where Hospital_ID = '$h_id'");  
	
	     ?>
    <tr>
      <th width="70px" scope="row" style="color: #1C73B9">Hospital ID </th>
      <th width="400px"><input name="txt_hospital_id" type="text" id="txt_hospital_id" value="<?php echo $h_id; ?>" /></th>
      <th width="10px"></th><form></form>
    </tr>
    
    <?php if($menu==1){ ?>
    <?php for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
	    $Memo = mysqli_result($sql_Memo, $i,"Memo1");
	    $Date = mysqli_result($sql_Date, $i,"Date1");
	    $idx = mysqli_result($sql_idx, $i, "idx");
	    
	    $txt_comment = "txt_comment"."$idx";
	    $txt_comment_date = "txt_comment_date"."$idx";
   ?>
      <tr><th scope="row" width="70px" style="color: #1C73B9"><?php echo $i+1;?>. Note : </th>
      <td rows="2" cols="50"><input = "text" id = "<?php echo $txt_comment?>" name = "<?php echo $txt_comment ?>" value = "<?php echo $Memo; ?>"/></td>
      <th width="50">Date : </th> <td><input = "text" id = "<?php echo $txt_comment_date?>" name = "<?php echo $txt_comment_date?>" value="<?php echo $Date;?>" size = "5"/> <td>
<form id="form2" name="form2" method="POST" action="shortorder.php">
	  	
      <?php
	  echo "<input onclick=\"return confirm('Delete??');\" type=submit name=btn_del id=btn_del value=DELETE />";
	  ?>	
      
      <input type="hidden" name="hd_del" id = "hd_del" value="<?php echo $idx?>" />
      <input type="hidden" name="ho_id" id = "ho_id" value="<?php echo $h_id?>" />
      <input type="hidden" name="permit" id = "permit" value ="<?php echo $permitUser?>"/>
      </form></td>    
      

</td>
  </td>
      
    
    </tr>
    <?php }}?>
    <?php if($menu==0){ ?>
    <?php for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
	    $Memo = mysqli_result($sql_Memo, $i,"Memo1");
	    $Date = mysqli_result($sql_Date, $i,"Date1");
	    $idx = mysqli_result($sql_idx, $i, "idx");
	    
	    $txt_comment = "txt_comment"."$idx";
	    $txt_comment_date = "txt_comment_date"."$idx";
   ?>
      <tr><th scope="row" width="70px" style="color: #1C73B9"><?php echo $i+1;?>. Note : </th>
      <td rows="2" cols="50" style="color: #1C73B9"><?php echo $Memo; ?></td>
      <th width="50" style="color: #1C73B9">Date : </th> <td style="color: #1C73B9"><?php echo $Date;?><td>

<form id="form2" name="form2" method="POST" action="shortorder.php">
	<?php
	  echo "<input onclick=\"return confirm('Delete?');\" type=submit name=btn_del id=btn_del value=DELETE />";
	  ?>	
      <input type="hidden" name="hd_del" id = "hd_del" value="<?php echo $idx?>" />
      <input type="hidden" name="ho_id" id = "ho_id" value="<?php echo $h_id?>" />
      <input type="hidden" name="permit" id = "permit" value ="<?php echo $permitUser?>"/>
      
      </form></td>    
      

</td>
  </td>
      
    
    </tr>
    <?php }}?>
    
    <tr><th width="70px" scope="row" style="color: #1C73B9">Add Note : </th>
      <td><textarea name="txt_Memo" id = "txt_Memo" type = "text" rows = "2" cols = "70" ></textarea>
         <th width="20" style="color: #1C73B9">Date : </th> <td width="100"><input name="txt_Date" type="text" id="txt_Date" value=<?php echo $Today_Date; ?> size = "3" /></td>
  
      </td></tr> 
  </table>

  
  <hr>

  <p>&nbsp;</p>
 
    <input type="submit" name="btn_update" id="btn_update" value="UPDATE" />
    <input type="hidden" name="ho_id" id = "ho_id" value="<?php echo $h_id?>" />
    <input type="hidden" name="permit" id = "permit" value ="<?php echo $permitUser?>"/>
    <input type = "hidden" name = "insert_rev" id = "insert_rev" value="<?php echo $menu?>"/>
 	
    
      
  </p>
  <input type="hidden" name="MM_update" value="form1" />
</form>

<?php
mysqli_free_result($Memoinfo);
?>
