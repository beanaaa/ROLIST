<!doctype html>
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

$permitUser = $_SESSION['MM_UserGroup'];

if ($_POST['permit'] != NULL) {
    $permitUser = $_POST['permit'];
}
if ($_GET['permit'] != NULL) {
    $permitUser = $_GET['permit'];
}

} ?>


<?php 
    
	if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
	require_once('Connections/test.php');
	mysqli_select_db($database_test );
       
	//session_destroy();
	//echo $permitUser;
	}
	else{
 		$MM_restrictGoTo = "testphpr2.php";
 		header("Location: ". $MM_restrictGoTo); 
 		require_once('Connections/test.php'); 
 		mysqli_select_db($database_test );
       
	}
	//session_start();
	 ?>

<html lang="ko">
<head>
  <meta http-equiv="refresh" content="600;url=index.php">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="js/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  

	
  <link rel="stylesheet" href="js/jquery-ui.css"/>
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>

  <title>Registration...</title>

<style type="text/css">
 

.table.type1 {
	border-collapse: collapse;
    width: 100%;
}
.type1 th, type1 td {
	
	white-space:nowrap;
	padding: 8px;
    text-align: left;
    border-bottom: 1px;
    
 	font-family: verdana;
	font-weight: 250;
	font-size: 18px;
    
}
modal_th {
	font-family: verdana;
	font-weight: 400;
	font-size: 15px;
}
	  	  
</style>
  
  
   
 


  <title>New Patient</title>
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


  </style>
  

	

<p style="font-size: 8px; font-weight: bold; color: #999999;" valign = "top" align = "right"> 
	<a href="index.php" style=color: #999999>LOGOUT </a> 
		| SITEMAP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

</head>


<body>
<!-- Body starts here!!! -->
<?php 


require_once('Connections/test.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
//Insert//

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  	$h_id = trim($_POST['txt_hospital_id']);
  	if(is_numeric($h_id)==0){
	   echo "<script>window.alert('Not a numeric character. Please check the primary chart number'); window.location.replace('N_register_all.php?permit=$permitUser');</script>";
}



  	$h_id = trim($h_id);
  	$hid = trim($_POST['txt_hospital_id']);
  	$sql_test = sprintf("select * from PatientInfo where Hospital_ID = '$h_id'");
  	$sql_test = mysqli_query($test, $sql_test);
  	$sql_test_rows = mysqli_num_rows($sql_test); // mysql row 수를 판단하여 중복 유/무 판별
  	
  	// 입력할 때 hospital id 가 원래 있는 것인지 아닌 것인지 판별
  	if($sql_test_rows!='0') // 원래 있을 경우 --> Update가 필요합니다. 곧 업데이트 하겠습니다.
  	{
  	echo($sql_test_rows);

      $UpdateIDX = mysqli_query($test, "select idx from TreatmentInfo where Hospital_ID = '$h_id'");
  		$Total_Dose= mysqli_query($test, "select dose_sum from TreatmentInfo where Hospital_ID = '$h_id'");
  		$Total_Fx = mysqli_query($test, "select Fx_sum from TreatmentInfo where Hospital_ID = '$h_id'");       
       
  		$UpdateIDX = mysqli_result($UpdateIDX,0,"idx");
  		$Total_Dose = mysqli_result($Total_Dose,0,"dose_sum");
  		$Total_Fx = mysqli_result($Total_Fx,0,"Fx_sum");
       
  		if($UpdateIDX=='' || $UpdateIDX==0){
  			$UpdateIDX=0;
       	}
       
	   	$Method_ = $_POST['Method'];
	   	$Linac_ = $_POST['Linac'];
	   	$Site_ = $_POST['Site'];
		
	   	$Dose_ = $_POST['Dose'];
	   	$Fx_ = $_POST['Fx'];
		
	   	$Start_ = $_POST['Start'];
	   	$CT_ = $_POST['CT'];
	   	$Finish_ = $_POST['Finish'];
		
	   	$Plan = count($Method_);
	   	
		$Q_idx = 0;
	   	
	   	for($i = 0; $i < $Plan; $i++){
			if($Dose_[$i]==''){
				$Dose_[$i] = 0.0;
			}
			if($Fx_[$i]==''){
				$Fx_[$i] = 0.0;
			}
			
			$idx = $UpdateIDX+$i+1;
			
			if($i==0){
				$Dose_sum = $Dose_[$i];
				$Fx_sum = $Fx_[$i];
			}else{
				
				$Dose_sum = $Total_Dose + $Dose_[$i];
				$Fx_sum = $Total_Fx + $Fx_[$i];
			}
			
				
			$Q_RT_start = "RT_start"."$idx";
			$Q_dose = "dose"."$idx";
			$Q_Fx = "Fx"."$idx";
			$Q_method = "RT_method"."$idx";
			$Q_Linac = "Linac"."$idx";
			$Q_Site = "Site"."$idx";
			$Q_CT = "CT_Sim"."$idx";
			$Q_Finish = "RT_fin"."$idx";
			
			$insertSQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '$Start_[$i]', RT_start_f = '$Start_[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]', dose_sum = '$Dose_sum', Fx_sum = '$Fx_sum', $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', $Q_Site = '$Site_[$i]', site_f = '$Site_[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', idx = '$idx', $Q_CT = '$CT_[$i]', CT_Sim_f = '$CT_[$i]', $Q_Finish = '$Finish_[$i]', RT_fin_f = '$Finish_[$i]' WHERE Hospital_ID = '$h_id' ");
			
			$Insert_Result3 = mysqli_query($test, $insertSQL3);
			if($Insert_Result3 == TRUE){
				$Q_idx = $Q_idx + 1;
			}
		}
	if($Q_idx == $Plan){

	   echo "<script>window.alert('Duplicate ID!'); window.alert('Update Success!');
		window.location.replace('N_edit_all.php?permit=$permitUser&H_ID=$hid');</script>";

	}else{
		echo "<script>window.alert('Update Fail');</script>";
	}
  }

//////////////////hospital id 가 없을 때 ///////////////////
if($sql_test_rows=='0'){   
$hidNew1 = $_POST['txt_hospital_id'];
$hid = trim($hidNew1);
  	if(is_numeric($hid)==0){
	   echo "<script>window.alert('Not a numeric character. Please check the primary chart number'); window.location.replace('N_register_all.php?permit=$permitUser');</script>";
}
	
  	$insertSQL = sprintf("INSERT INTO PatientInfo (Hospital_ID) VALUES ('%s')",$hid);
  
	$insertSQL1 = sprintf("INSERT INTO ClinicalInfo (Hospital_ID) VALUES ('%s')",$hid);
                       

  	$insertSQL2 = sprintf("INSERT INTO TreatmentInfo (Hospital_ID) VALUES ('%s')",$hid);
	
	$ii = 0;
	echo($insertSQL."<br>".$insertSQL1."<br>".$insertSQL2."<br>");
	// 혹시 쿼리가 안들어 갈 경우를 대비하여 100번 반복을 하였
	mysqli_select_db($database_test );
    while($ii<100){
		$Result1 = mysqli_query($test, $insertSQL ); 
		$Result2 = mysqli_query($test, $insertSQL1 );
		$Result3 = mysqli_query($test, $insertSQL2 );
		
		if($Result1 == True && $Result2 == True && $Result3 == True){
			break;
		}
		$ii++;	
	}
	
 

    
  	$Method_ = $_POST['Method'];
  	$Linac_ = $_POST['Linac'];
  	$Site_ = $_POST['Site'];
		
	$Dose_ = $_POST['Dose'];
	$Fx_ = $_POST['Fx'];
		
	$Start_ = $_POST['Start'];
	$CT_ = $_POST['CT'];
	$Finish_ = $_POST['Finish'];
		
	$Plan = count($Method_);
		
	$Q_idx = 0;
		
	//echo $Site_[0];
	if($Result1 == True && $Result2 == True && $Result3 == True){
		for($i = 0; $i < $Plan; $i++){
			if($Dose_[$i]==''){
				$Dose_[$i] = 0.0;
			}
			if($Fx_[$i]==''){
				$Fx_[$i] = 0.0;
			}
			
			$idx = $i + 1;
			
			if($i==0){
				$Dose_sum = $Dose_[$i];
				$Fx_sum = $Fx_[$i];
			}else{
				
				$sql_dose = mysqli_query($test, "select dose_sum from TreatmentInfo where Hospital_ID = $h_id");
				$sql_dose_result = mysqli_result($sql_dose,0,"dose_sum");
					
				
				$sql_fx = mysqli_query($test, "select Fx_sum from TreatmentInfo where Hospital_ID = $h_id"); 
				$sql_fx_result = mysqli_result($sql_fx,0,"Fx_sum");
				
				$Dose_sum = $sql_dose_result + $Dose_[$i];

             
			}
			
				
			$Q_RT_start = "RT_start"."$idx";
			$Q_dose = "dose"."$idx";
			$Q_Fx = "Fx"."$idx";
			$Q_method = "RT_method"."$idx";
			$Q_Linac = "Linac"."$idx";
			$Q_Site = "Site"."$idx";
			$Q_CT = "CT_Sim"."$idx";
			$Q_Finish = "RT_fin"."$idx";
			
			$insertSQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '$Start_[$i]', RT_start_f = '$Start_[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]', dose_sum = '$Dose_sum', Fx_sum = '$Fx_sum', $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', $Q_Site = '$Site_[$i]', site_f = '$Site_[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', idx = '$idx', $Q_CT = '$CT_[$i]', CT_Sim_f = '$CT_[$i]', $Q_Finish = '$Finish_[$i]', RT_fin_f = '$Finish_[$i]' WHERE Hospital_ID = '$h_id' ");
			
			$Insert_Result3 = mysqli_query($test, $insertSQL3);
			if($Insert_Result3 == TRUE){
				$Q_idx = $Q_idx + 1;
			}
				//echo $insertSQL4;
				
		}
	}
	
	
	$Comment = $_POST['Comment'];
	$CommentDate = $_POST['CommentDate'];
	$C_Plan = count($Comment);
	$C_idx = 0;
	
	for($j = 1; $j<=$C_Plan; $j++){
		$jj = $j-1;
		$insertComment = sprintf("INSERT INTO MemoTemp (Hospital_ID, Memo1, Date1, idx) VALUES ($h_id, '$Comment[$jj]', %s, $j)", GetSQLValueString($CommentDate[$jj] ,"text"));
		if($insertQuery == TRUE){
			$C_idx = $C_idx + 1;
		}
	}
	$ii=0;
	
    if($Result1 == True && $Result2 == True && $Result3 == True && $Q_idx == $Plan && $C_idx == $C_Plan){

		$hidNew1 = $_POST['txt_hospital_id'];
		$hid = trim($hidNew1);

	   echo "<script>window.alert('Insert Success!');
		window.location.replace('N_edit_all.php?permit=$permitUser&H_ID=$h_id');</script>";


	}else{
		echo "<script>window.alert('Insert Fail');</script>";
	}

  	}
  	$insertGoTo = "N_register_all.php";
}
?>















<body>
<br>
<br>
<form id="form1" name="form1" method="POST" action="N_register_all.php">
 <table class="type1" width="70%" border="0" cellspacing="1" cellpadding="1" align="center">

 
 <tr>
    <th align = "right" width="80px" scope="row" style="color: #805515">Hospital ID</th>
    <td width="150px"><input class="form-control" style="height:25px; width:120px" type="text" name="txt_hospital_id" id="txt_hospital_id" required = "required"   /></td>
 </tr>
 
 </table>




  <hr>
  <center>
    <input class="btn btn-default" type="submit" name="btn_reg" id="btn_reg" value="Register"  />
    <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
  </center>
















  
  <input type="hidden" name="MM_insert" value="form1" />
</form>

<p>&nbsp;</p>

	<div class="modal fade" id="Routine1" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Head & Neck
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R1" name="Method_R1">
									<option value="" selected="selected">Select</option>
									<option value="2D Conventional">2D Conventional</option>
									<option value="3D Conformal">3D Conformal</option>
									<option value="IMRT">IMRT</option>
									<option value="IGRT">IGRT</option>
									<option value="SBRT">SBRT</option>
									<option value="VMAT">VMAT</option>
									<option value="Brachytherapy">Brachytherapy</option>
									<option value="Proton">Proton</option>
									<option value="Hyperthermia">Hyperthermia</option>
									<option value="Other">Other</option>
									</select>
								</td>
								<td></td>
								<td>
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_R1" name= "Start_R1">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "Routine1_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine1 -->
    
    <div class="modal fade" id="Routine2" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		WhBrain
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R2" name="Method_R2">
									<option value="" selected="selected">Select</option>
									<option value="2D Conventional">2D Conventional</option>
									<option value="3D Conformal">3D Conformal</option>
									<option value="IMRT">IMRT</option>
									<option value="IGRT">IGRT</option>
									<option value="SBRT">SBRT</option>
									<option value="VMAT">VMAT</option>
									<option value="Brachytherapy">Brachytherapy</option>
									<option value="Proton">Proton</option>
									<option value="Hyperthermia">Hyperthermia</option>
									<option value="Other">Other</option>
									</select>
								</td>
								<td></td>
								<td>
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_R2" name= "Start_R2">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "Routine2_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine2 -->
    
    <div class="modal fade" id="Routine3" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Cervix & PAN
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R3" name="Method_R3">
									<option value="" selected="selected">Select</option>
									<option value="2D Conventional">2D Conventional</option>
									<option value="3D Conformal">3D Conformal</option>
									<option value="IMRT">IMRT</option>
									<option value="IGRT">IGRT</option>
									<option value="SBRT">SBRT</option>
									<option value="VMAT">VMAT</option>
									<option value="Brachytherapy">Brachytherapy</option>
									<option value="Proton">Proton</option>
									<option value="Hyperthermia">Hyperthermia</option>
									<option value="Other">Other</option>
									</select>
								</td>
								<td></td>
								<td>
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_R3" name= "Start_R3">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "Routine3_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine2 -->

    <div class="modal fade" id="Routine4" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Lung
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R4" name="Method_R4">
									<option value="" selected="selected">Select</option>
									<option value="2D Conventional">2D Conventional</option>
									<option value="3D Conformal">3D Conformal</option>
									<option value="IMRT">IMRT</option>
									<option value="IGRT">IGRT</option>
									<option value="SBRT">SBRT</option>
									<option value="VMAT">VMAT</option>
									<option value="Brachytherapy">Brachytherapy</option>
									<option value="Proton">Proton</option>
									<option value="Hyperthermia">Hyperthermia</option>
									<option value="Other">Other</option>
									</select>
								</td>
								<td></td>
								<td>
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_R4" name= "Start_R4">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "Routine4_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine2 -->


    
    <div class="modal fade" id="Routine5" role="dialog"> <!-- div id 값 수정--> 
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Breast
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R5" name="Method_R5">
									<option value="" selected="selected">Select</option>
									<option value="2D Conventional">2D Conventional</option>
									<option value="3D Conformal">3D Conformal</option>
									<option value="IMRT">IMRT</option>
									<option value="IGRT">IGRT</option>
									<option value="SBRT">SBRT</option>
									<option value="VMAT">VMAT</option>
									<option value="Brachytherapy">Brachytherapy</option>
									<option value="Proton">Proton</option>
									<option value="Hyperthermia">Hyperthermia</option>
									<option value="Other">Other</option>
									</select>
								</td>
								<td></td>
								<td>
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_R5" name= "Start_R5">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "Routine5_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine2 -->


</html>


        

<?php
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);
?>

<script type="text/javascript">
function fnCngList(sVal){

    var f = document.form1; 
    var opt = $("#sub_site option").length; 
  
    if(sVal == "") { 
        num = new Array("Select"); 
        vnum = new Array(""); 
    }else if(sVal == "CNS") { 
        num = new Array("Select","Brain","Spinal cord","Other"); 
        vnum = new Array("","Brain","Spinal cord","Other"); 
    }else if(sVal == "HN") { 
        num = new Array("Select","Eye and Orbit","Ear","Nasopharyx","Nasal cavity & Pns","Oropharynx","Larynx","Hypopharyx","Salivary gland","Thyroid gland","Oral Cavity","Other"); 
        vnum = new Array("","Eye and Orbit","Ear","Nasopharyx","Nasal cavity & Pns","Oropharynx","Larynx","Hypopharyx","Salivary gland","Thyroid gland","Oral Cavity","Other");     
    }else if(sVal == "THX"){
	    num = new Array("Select","Lung","Thymus","Other");
	    vnum = new Array("","Lung","Thymus","Other");
    }else if(sVal == "BRST"){
	    num = new Array("Select","Breast","Other");
		vnum = new Array("","Breast","Other");
    }else if(sVal == "GI"){
	    num = new Array("Select","Esophagus","Stomach","Pancreas","Hepatobiliary","Duodenum","Colorectum","Anus","Other");
		vnum = new Array("","Esophagus","Stomach","Pancreas","Hepatobiliary","Duodenum","Colorectum","Anus","Other");
    }else if(sVal == "GU"){
	    num = new Array("Select","Kidney","Ureter","Bladder","Prostate","External genitalia","Other");
		vnum = new Array("","Kidney","Ureter","Bladder","Prostate","External genitalia","Other");
    }else if(sVal == "GY"){
	    num = new Array("Select","Cervix","Endometrium","Ovary","Vagnia","Vulva","Other");
	    vnum = new Array("","Cervix","Endometrium","Ovary","Vagnia","Vulva","Other");
    }else if(sVal == "MS"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "SKIN"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "HMT"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "PD"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "BENIGN"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "CUPS"){
	    num = new Array("Select","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
	    vnum = new Array("","Brain","Head and Neck","Chest","Abdomen","Pelvis","Extremity","Other");
    }else if(sVal == "OTHER"){
	    num = new Array("Select","Other");
	    vnum = new Array("","Other");
    }

    for(var i=0; i<opt; i++) { 
        f.sub_site.options[0] = null; 
    } 
  
    for(k=0;k < num.length;k++) { 
        f.sub_site.options[k] = new Option(num[k],vnum[k]); 
    } 
} 


$(function() {
              //오늘 날짜를 출력

              //datepicker 한국어로 사용하기 위한 언어설정
              $('#Test_Datepicker1, #Test_Datepicker2, #Test_Datepicker3, #Test_Datepicker4, #Test_Datepicker5, #Test_Datepicker6, #Test_Datepicker7, #Test_Datepicker8, #Test_Datepicker9, #Test_Datepicker10, #Test_Datepicker11, #Test_Datepicker12, #Test_Datepicker13, #Test_Datepicker14, #Test_Datepicker15, #Test_Datepicker16, #Test_Datepicker17, #Test_Datepicker18, #Test_Datepicker_R1, #Test_Datepicker_R2, #Test_Datepicker_R3, #Test_Datepicker_R4,#Test_Datepicker_R5, #CommentPicker1, #CommentPicker2, #CommentPicker3, #CommentPicker4, #CommentPicker5').datepicker({
	              dateFormat:'m/d/y'
              });
});

var count = 0;
var count_ = 0;
var DateStart = 1;
var DateFinish = 2;
var DateCT = 3;

var CDate = 1;
var Fx = [18,12,3,7];
var Fx_ = [22, 6];
var fXLung = [15, 10, 5, 6];
var fXBreast = [28, 5];

var CommentDate = new Date();
var Comment_year = CommentDate.getFullYear()%2000;
var Comment_month = CommentDate.getMonth()+1;
var Comment_date = CommentDate.getDate();
			
var Comment_Finish_ = [Comment_month,Comment_date,Comment_year];
var Comment_Finish = Comment_Finish_.join("/");




$(function() {
	$("#addTR").click(function () {
		count++;
		
		
		var row = "<tr>";
			row += "<td>"+count+"</td>";
			row += "<td><select class = 'form-control input-sm' name='Method[]'><option value='' selected='selected'>Select</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
			row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
			row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]'></td>"
			
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.
	
		$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
		DateStart = DateStart+3;
		DateFinish = DateFinish+3;
		DateCT = DateCT+3;

	});
	
	$("#Routine1_F").click(function () {
		
		var Routine1_S = [];
		var Routine1_Fi = [];
		var Routine1_C = [];
		var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
		var Method = $('#Method_R1').val();
		var Start = $('input[name=Start_R1]').val();
		Routine1_S[0] = Start;
	
		
		var P_Start = new Date(Start); 
			
		var idx = 0;
		var idx_ = 0;
			 
		for(var i=0; i<4; i++){
		
			if(i>0){
				var S_Start = new Date(Routine1_Fi[i-1]);
				
				var idx_ = 0;
			
				while(idx_ < 2){
					var S_day = S_Start.getDay();
				
					var S_year = S_Start.getFullYear()%2000;
					var S_month = S_Start.getMonth()+1;
					var S_date = S_Start.getDate();
			
					var S_Finish_ = [S_month,S_date,S_year];
					var S_Finish = S_Finish_.join("/");

					var FindIndex = holiday.indexOf(S_Finish);
					if(FindIndex == '-1' && S_day !='6' && S_day !='0'){
						idx_ = idx_ + 1;
					}
					
					S_Start.setDate(S_Start.getDate() + 1);
					
				}
				Routine1_S[i] = S_Finish;
				var P_Start = new Date(S_Finish);
			}
			
			var idx_ = 0;
			
			//Finish
			while(idx_ < Fx[i]){
				var P_day = P_Start.getDay();
					
				var P_year = P_Start.getFullYear()%2000;
				var P_month = P_Start.getMonth()+1;
				var P_date = P_Start.getDate();
			
			
				var P_Finish_ = [P_month,P_date,P_year];
				var P_Finish = P_Finish_.join("/");

				var FindIndex = holiday.indexOf(P_Finish);
				if(FindIndex == '-1' && P_day !='6' && P_day !='0'){
					idx_ = idx_ + 1;
				}
				idx = idx + 1;
				P_Start.setDate(P_Start.getDate() + 1);
			}
			Routine1_Fi[i] = P_Finish;
			
			
			//CT
			var C_Start = new Date(Routine1_S[i]);
		
			var idx_ = 0;
			
			while(idx_ <= 2){
				var C_day = C_Start.getDay();
				
				var C_year = C_Start.getFullYear()%2000;
				var C_month = C_Start.getMonth()+1;
				var C_date = C_Start.getDate();
			
				var C_Finish_ = [C_month,C_date,C_year];
				var C_Finish = C_Finish_.join("/");

				var FindIndex = holiday.indexOf(C_Finish);
				if(FindIndex == '-1' && C_day !='6' && C_day !='0'){
					idx_ = idx_ + 1;
				}
				C_Start.setDate(C_Start.getDate() - 1);
					
			}
			if(i<2){
				Routine1_C[i] = C_Finish;
			}else{
				Routine1_C[i] = '';
			}
		}	
		
		for(var i=0; i<4; i++){
			count++;
			
			var row = "<tr>";
				row += "<td>"+count+"</td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
				
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+Fx[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine1_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine1_Fi[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine1_C[i]+"'></td>"
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
			DateStart = DateStart+3;
			DateFinish = DateFinish+3;
			DateCT = DateCT+3;
		}
	});
	
	
	$("#Routine2_F").click(function () {
			//holiday 배열 가져오기
			var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
			var Method = $('#Method_R2').val();
			var Start = $('input[name=Start_R2]').val();
			
			var P_Start = new Date(Start); 
			var C_Start = new Date(Start);
			
			var idx_ = 0;
			//Finish 
			while(idx_ < 10){
				var P_day = P_Start.getDay();
				
				var P_year = P_Start.getFullYear()%2000;
				var P_month = P_Start.getMonth()+1;
				var P_date = P_Start.getDate();
			
			
				var P_Finish_ = [P_month,P_date,P_year];
				var P_Finish = P_Finish_.join("/");

				var FindIndex = holiday.indexOf(P_Finish);
				if(FindIndex == '-1' && P_day !='6' && P_day !='0'){
					idx_ = idx_ + 1;
				}
				P_Start.setDate(P_Start.getDate() + 1);
			}
			//CT
			var idx_ = 0;
			
			while(idx_ < 2){
				var C_day = C_Start.getDay();
				
				var C_year = C_Start.getFullYear()%2000;
				var C_month = C_Start.getMonth()+1;
				var C_date = C_Start.getDate();
			
			
				var C_Finish_ = [C_month,C_date,C_year];
				var C_Finish = C_Finish_.join("/");

				var FindIndex = holiday.indexOf(C_Finish);
				if(FindIndex == '-1' && C_day !='6' && C_day !='0'){
					idx_ = idx_ + 1;
				}
				C_Start.setDate(C_Start.getDate() - 1);
				
			}
			
			
			
			count++;
			
			var row = "<tr>";
				row += "<td>"+count+"</td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"' selected='selected'>"+Method+"</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='30' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '10' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Start+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value ='"+P_Finish+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+C_Finish+"'></td>"
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
			DateStart = DateStart+3;
			DateFinish = DateFinish+3;
			DateCT = DateCT+3;
		
	});
	
	$("#Routine3_F").click(function () {
		var Dose_R3 = [39.6, 10.8];
		var Routine3_S = [];
		var Routine3_Fi = [];
		var Routine3_C = [];
		var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
		var Method = $('#Method_R3').val();
		var Start = $('input[name=Start_R3]').val();
		Routine3_S[0] = Start;
	
		
		var P_Start = new Date(Start); 
			
		var idx = 0;
		var idx_ = 0;
			 
		for(var i=0; i<2; i++){
		
			if(i>0){
				var S_Start = new Date(Routine3_Fi[i-1]);
				
				var idx_ = 0;
			
				while(idx_ < 2){
					var S_day = S_Start.getDay();
				
					var S_year = S_Start.getFullYear()%2000;
					var S_month = S_Start.getMonth()+1;
					var S_date = S_Start.getDate();
			
					var S_Finish_ = [S_month,S_date,S_year];
					var S_Finish = S_Finish_.join("/");

					var FindIndex = holiday.indexOf(S_Finish);
					if(FindIndex == '-1' && S_day !='6' && S_day !='0'){
						idx_ = idx_ + 1;
					}
					
					S_Start.setDate(S_Start.getDate() + 1);
					
				}
				Routine3_S[i] = S_Finish;
				var P_Start = new Date(S_Finish);
			}
			
			var idx_ = 0;
			
			//Finish
			while(idx_ < Fx_[i]){
				var P_day = P_Start.getDay();
					
				var P_year = P_Start.getFullYear()%2000;
				var P_month = P_Start.getMonth()+1;
				var P_date = P_Start.getDate();
			
			
				var P_Finish_ = [P_month,P_date,P_year];
				var P_Finish = P_Finish_.join("/");

				var FindIndex = holiday.indexOf(P_Finish);
				if(FindIndex == '-1' && P_day !='6' && P_day !='0'){
					idx_ = idx_ + 1;
				}
				idx = idx + 1;
				P_Start.setDate(P_Start.getDate() + 1);
			}
			Routine3_Fi[i] = P_Finish;
			
			
			//CT
			var C_Start = new Date(Routine3_S[i]);
		
			var idx_ = 0;
			
			while(idx_ <= 2){
				var C_day = C_Start.getDay();
				
				var C_year = C_Start.getFullYear()%2000;
				var C_month = C_Start.getMonth()+1;
				var C_date = C_Start.getDate();
			
				var C_Finish_ = [C_month,C_date,C_year];
				var C_Finish = C_Finish_.join("/");

				var FindIndex = holiday.indexOf(C_Finish);
				if(FindIndex == '-1' && C_day !='6' && C_day !='0'){
					idx_ = idx_ + 1;
				}
				C_Start.setDate(C_Start.getDate() - 1);
					
			}

			Routine3_C[i] = C_Finish;

		}	
		
		for(var i=0; i<2; i++){
			count++;
			
			var row = "<tr>";
				row += "<td>"+count+"</td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
				
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R3[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+Fx_[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
			DateStart = DateStart+3;
			DateFinish = DateFinish+3;
			DateCT = DateCT+3;
		}
	});
	
		$("#Routine4_F").click(function () {
		var Dose_R4 = [27, 18, 9, 10.8];
		var Routine4_S = [];
		var Routine4_Fi = [];
		var Routine4_C = [];
		var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
		var Method = $('#Method_R4').val();
		var Start = $('input[name=Start_R4]').val();
		Routine4_S[0] = Start;
	
		
		var P_Start = new Date(Start); 
			
		var idx = 0;
		var idx_ = 0;
			 
		for(var i=0; i<4; i++){
		
			if(i>0){
				var S_Start = new Date(Routine4_Fi[i-1]);
				
				var idx_ = 0;
			
				while(idx_ < 2){
					var S_day = S_Start.getDay();
				
					var S_year = S_Start.getFullYear()%2000;
					var S_month = S_Start.getMonth()+1;
					var S_date = S_Start.getDate();
			
					var S_Finish_ = [S_month,S_date,S_year];
					var S_Finish = S_Finish_.join("/");

					var FindIndex = holiday.indexOf(S_Finish);
					if(FindIndex == '-1' && S_day !='6' && S_day !='0'){
						idx_ = idx_ + 1;
					}
					
					S_Start.setDate(S_Start.getDate() + 1);
					
				}
				Routine4_S[i] = S_Finish;
				var P_Start = new Date(S_Finish);
			}
			
			var idx_ = 0;
			
			//Finish
			while(idx_ < fXLung[i]){
				var P_day = P_Start.getDay();
					
				var P_year = P_Start.getFullYear()%2000;
				var P_month = P_Start.getMonth()+1;
				var P_date = P_Start.getDate();
			
			
				var P_Finish_ = [P_month,P_date,P_year];
				var P_Finish = P_Finish_.join("/");

				var FindIndex = holiday.indexOf(P_Finish);
				if(FindIndex == '-1' && P_day !='6' && P_day !='0'){
					idx_ = idx_ + 1;
				}
				idx = idx + 1;
				P_Start.setDate(P_Start.getDate() + 1);
			}
			Routine4_Fi[i] = P_Finish;
			
			
			//CT
			var C_Start = new Date(Routine4_S[i]);
		
			var idx_ = 0;
			
			while(idx_ <= 2){
				var C_day = C_Start.getDay();
				
				var C_year = C_Start.getFullYear()%2000;
				var C_month = C_Start.getMonth()+1;
				var C_date = C_Start.getDate();
			
				var C_Finish_ = [C_month,C_date,C_year];
				var C_Finish = C_Finish_.join("/");

				var FindIndex = holiday.indexOf(C_Finish);
				if(FindIndex == '-1' && C_day !='6' && C_day !='0'){
					idx_ = idx_ + 1;
				}
				C_Start.setDate(C_Start.getDate() - 1);
					
			}

			if(i<2){
				Routine4_C[i] = C_Finish;
			}else{
				Routine4_C[i] = '';
			}

		}	
		
		for(var i=0; i<4; i++){
			count++;
			
			var row = "<tr>";
				row += "<td>"+count+"</td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
				
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R4[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXLung[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine4_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine4_Fi[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine4_C[i]+"'></td>"
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
			DateStart = DateStart+3;
			DateFinish = DateFinish+3;
			DateCT = DateCT+3;
		}
	});




/***********************************************************************************************/
/* 																							   */
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 		// 	Main routing function starts from here....//									   */  
/* 																							   */  
/* 																							   */  
/***********************************************************************************************/
	
	$("#Routine5_F").click(function () {
		var Dose_R3 = [50.4, 9];
		var Routine3_S = [];
		var Routine3_Fi = [];
		var Routine3_C = [];
		var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
		var Method = $('#Method_R5').val();
		var Start = $('input[name=Start_R5]').val();
		Routine3_S[0] = Start;
	
		
		var P_Start = new Date(Start); 
			
		var idx = 0;
		var idx_ = 0;
			 
		for(var i=0; i<2; i++){
		
			if(i>0){
				var S_Start = new Date(Routine3_Fi[i-1]);
				
				var idx_ = 0;
			
				while(idx_ < 2){
					var S_day = S_Start.getDay();
				
					var S_year = S_Start.getFullYear()%2000;
					var S_month = S_Start.getMonth()+1;
					var S_date = S_Start.getDate();
			
					var S_Finish_ = [S_month,S_date,S_year];
					var S_Finish = S_Finish_.join("/");

					var FindIndex = holiday.indexOf(S_Finish);
					if(FindIndex == '-1' && S_day !='6' && S_day !='0'){
						idx_ = idx_ + 1;
					}
					
					S_Start.setDate(S_Start.getDate() + 1);
					
				}
				Routine3_S[i] = S_Finish;
				var P_Start = new Date(S_Finish);
			}
			
			var idx_ = 0;
			
			//Finish
			while(idx_ < fXBreast[i]){
				var P_day = P_Start.getDay();
					
				var P_year = P_Start.getFullYear()%2000;
				var P_month = P_Start.getMonth()+1;
				var P_date = P_Start.getDate();
			
			
				var P_Finish_ = [P_month,P_date,P_year];
				var P_Finish = P_Finish_.join("/");

				var FindIndex = holiday.indexOf(P_Finish);
				if(FindIndex == '-1' && P_day !='6' && P_day !='0'){
					idx_ = idx_ + 1;
				}
				idx = idx + 1;
				P_Start.setDate(P_Start.getDate() + 1);
			}
			Routine3_Fi[i] = P_Finish;
			
	
			//CT
			var C_Start = new Date(Routine3_S[i]);
		
			var idx_ = 0;
			
			while(idx_ <= 3){
				var C_day = C_Start.getDay();
				
				var C_year = C_Start.getFullYear()%2000;
				var C_month = C_Start.getMonth()+1;
				var C_date = C_Start.getDate();
			
				var C_Finish_ = [C_month,C_date,C_year];
				var C_Finish = C_Finish_.join("/");

				var FindIndex = holiday.indexOf(C_Finish);
				if(FindIndex == '-1' && C_day !='6' && C_day !='0'){
					idx_ = idx_ + 1;
				}
				C_Start.setDate(C_Start.getDate() - 1);
					
			}
			

			if(i<1){
				Routine3_C[i] = C_Finish;
			}else{
				Routine3_C[i] = '';
			}
		}	
		
		for(var i=0; i<2; i++){
			count++;
			
			var row = "<tr>";
				row += "<td>"+count+"</td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R3[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+Fx_[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'}); 
		
			DateStart = DateStart+3;
			DateFinish = DateFinish+3;
			DateCT = DateCT+3;
		}
	});
	
	
/***********************************************************************************************/
/* 																							   */
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 																							   */  
/* 		// 	Main routing function ENDs from here....//									   */  
/* 																							   */  
/* 																							   */  
/***********************************************************************************************/
	
	
	





	
	$("#DataTable").on("click", "button", function() {
		$(this).closest("tr").remove();
		count--;
		DateStart = DateStart-3;
		DateFinish = DateFinish-3;
		DateCT = DateCT-3;
	});
	
	$("#addComment").click(function () {
		count_++;
		
		
		var row = "<tr>";
			row += "<td><center>"+count_+"</center></td>";
			row += "<td><input class = 'form-control input-sm ' type='Comment' name= 'Comment[]' ></td>"
			row += "<td><input class = 'form-control input-sm ' id = 'CommentPicker"+CDate+"' type='CommentDate' name= 'CommentDate[]' value ='"+Comment_Finish+"' ></td>"
			
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#CommentTable").append(row);
		
		$(document).find("input[name='CommentDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		CDate++;	
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.

	});
	
	$("#CommentTable").on("click", "button", function() {
		$(this).closest("tr").remove();
		count--;
		CDate--;
		
	});
});
</script> 



