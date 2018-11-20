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



<!-- READ PHYSICIANS FROM CFG FILE -->

<?php
include("configuration.php");

?>
<?php 
// ${"D_fin_".$j} = "RT_fin"."$j";
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

$statVar = ["","CT","2D","Canceled(M)","Canceled(P)"];
$permitUser = $_POST['permit'];
$prevst = $_POST['prevst'];
$preved = $_POST['preved'];
$prevpp = $_POST['prevpp'];
$prevsite = $_POST['prevsite'];
$prevds = $_POST['prevds'];
$prevfx = $_POST['prevfx'];
$prevfd = $_POST['prevfd'];
$prev = "";

$courseid = $_POST['courseid'];
$hf_edit = $_POST['hf_edit'];

$delcourse = $_POST['delcourse'];
$chartid = $_POST['chartid'];

if(strlen($chartid)>3){
	$delquery = "delete from TreatmentInfoHist where Hospital_ID like '$chartid' and courseid like '$delcourse'";
	echo($delquery."<br>");
	mysqli_query($test, $delquery);
	$delquery = "delete from ClinicalInfoHist where Hospital_ID like '$chartid' and courseid like '$delcourse'";
	echo($delquery."<br>");
	mysqli_query($test, $delquery);
?>
<script language="javascript" type="text/javascript"> 
// 	setTimeout("window.close();", 500);
</script>

<?php	
}



if(strlen($prevst)>4){ 
  $prev = $prevpp." RT to ".$prevsite." ".$prevds." Gy/".$prevfd." fx. @PNUYH (".$prevst." - ".$preved.")";
}
$fUpCh = $_POST['fup'];

if(strcmp($fUpCh,"1")==0){

  $h_id = $_POST['hf_edit'];
  $u_id=$_POST['username'];

  $path = "atch"; // 오픈하고자 하는 폴더 
  $entrys = array(); // 폴더내 Entry를 저장하기 위한 배열 
  $dirs = dir($path); // 오픈하기 
  while(false !== ($entry = $dirs->read())){ // 읽기 
     $entrys[] = $entry; 
  } 
  $dirs->close(); // 닫기 

  // var_export($entrys); 

  $fCh = 0;

  for($idcount=0; $idcount<count($entrys);$idcount++){
    if(strcmp($entrys[$idcount],$h_id)==0){
      $fCh = 1;
      $folderName = $path."/".$h_id;

      break;
    }
  }

  if($fCh==0){
    $folderName = $path."/".$h_id;
    mkdir($path."/".$h_id);
  }


  $uploads_dir = $folderName;
  $allowed_ext = array('jpg','jpeg','png','bmp','gif','txt','rtf','pdf');
   
  // 변수 정리
  $error = $_FILES['myfile']['error'];
  $name = $_FILES['myfile']['name'];
  $ttime = date("YmdHis");
  $name = $ttime.$name;
  $ext = array_pop(explode('.', $name));

  // 오류 확인
  if( $error != UPLOAD_ERR_OK ) {
    switch( $error ) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        echo "파일이 너무 큽니다. ($error)";
        break;
      case UPLOAD_ERR_NO_FILE:
        echo "파일이 첨부되지 않았습니다. ($error)";
        break;
      default:
        echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    exit;
  }
   
  // 확장자 확인
  if( !in_array($ext, $allowed_ext) ) {
    echo "허용되지 않는 확장자입니다.";
    exit;
  }
   
  // 파일 이동
  move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");


}


if($_GET['permit']){
  	$permitUser = $_GET['permit'];
  // 	$uid = $_GET['user'];
}

$uid=$_POST['username'];

include("idc.php");

} ?>




<?php 
    
	if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
		require_once('Connections/test.php'); 
		mysqli_select_db($database_test);
     
	}
	else{
 		$MM_restrictGoTo = "testphpr2.php";
 		header("Location: ". $MM_restrictGoTo); 
 		require_once('Connections/test.php'); 
 		mysqli_select_db($database_test);
     

	}

  $dFileName = $_POST['filenameD'];
if(strlen($dFileName)>1){
  echo "<font color=red size=2><strong>".$dFileName." was successfully deleted</strong></font>";
  unlink($dFileName);
}


	 ?>


<html lang="ko">
<head>
<meta http-equiv="refresh" content="600000;url=index.php">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="bootsample.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<link rel="stylesheet" href="js/jquery-ui.css"/>


<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery-ui.min.js"></script>


<title>Radiation Oncology Record</title>

<style type="text/css">
.photo3 {
    width: 100px; height: 100px;
    object-fit: cover;
    border-radius: 50%;
}

.table.type1 {
	border-collapse: collapse;
    width: 960px;
}
.type1 th, type1 td {	
	white-space:nowrap;
	padding: 3px;
    text-align: left;
    border-bottom: 1px;    
 	font-family: arial;
	font-size: 12px;    
	
}
modal_th {
	font-family: arial;
	font-size: 12px;
}
.noresize {

}	
ol,li {
    margin: 0;
    padding: 0;
}

ol {
    counter-reset: foo;
    display: table;
}

li {
    list-style: none;
    counter-increment: foo;
    display: table-row;
}

li::before {
    content: "•";;
    display: table-cell;
    text-align: right;
    padding-right: .3em;
}

tr.border_bottom td {
  border-bottom:1pt solid black;
}
input{
    margin: 0px ; 
    padding: 0px;
	font-size: 12px;	
}
input.han {ime-mode:active;}

body, th, td, tr {
    /*background-color: #AAAAAA;*/
    margin: 0px ; 
    padding: 0px;
	font-size: 12px;
	font-family: arial;
	
    
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

table.type03 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid #365;
	margin : 20px 10px;
}
table.type03 th {
    width: 147px;
    padding: 10px;
    font-weight: bold;
    vertical-align: top;
    color: #153d73;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type03 td {
    width: 349px;
    padding: 10px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type04 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(240, 117, 119, 0.98); /* red 50 (ibm design colors) */
	margin : 20px 10px;
}
table.type04 th {
/*     width: 147px; */
    padding: 1px;
    font-weight: bold;
    vertical-align: top;
    color: #f13e5c;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type04 td {
/*     width: 349px; */
    padding: 1px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type05 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(117, 154, 240, 0.98); /* red 50 (ibm design colors) */
	margin : 20px 10px;
}
table.type05 th {
/*     width: 147px; */
    padding: 1px;
    font-weight: bold;
    vertical-align: top;
    color: #f13e5c;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type05 td {
/*     width: 349px; */
    padding: 1px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

  </style>
  



</head>


<body>
<!-- Body starts here!!! -->


<?php require_once('Connections/test.php'); ?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");


$colname_Hospital_ID = "-1";
if (isset($_POST['hf_edit'])) {
  $colname_Hospital_ID = $_POST['hf_edit'];
}
if (isset($_POST['ho_id'])){
	$colname_Hospital_ID = $_POST['ho_id'];
}
if (isset($_POST['plus_plan'])){
	$colname_Hospital_ID = $_POST['plus_plan'];
}
if (isset($_POST['H_ID'])){
	$colname_Hospital_ID = $_POST['H_ID'];
}
if($_GET['H_ID']){
	$colname_Hospital_ID = $_GET['H_ID'];
}










mysqli_select_db($database_test);
$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfoHist WHERE Hospital_ID = '%s' and courseid like '$courseid'", ($colname_Hospital_ID));
// echo("<br>".$query_clinicalinfo."<br>");
$clinicalinfo = mysqli_query($test, $query_clinicalinfo) or die(mysqli_error());
$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);

mysqli_select_db($database_test);
$query_patientinfo = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = '%s' ", ($colname_Hospital_ID));
$patientinfo = mysqli_query($test, $query_patientinfo) or die(mysqli_error());
$row_patientinfo = mysqli_fetch_assoc($patientinfo);
$totalRows_patientinfo = mysqli_num_rows($patientinfo);

mysqli_select_db($database_test);
$query_treatmentinfo = sprintf("SELECT * FROM TreatmentInfoHist WHERE Hospital_ID = '%s' and courseid like '$courseid'", ($colname_Hospital_ID));
$treatmentinfo = mysqli_query($test, $query_treatmentinfo) or die(mysqli_error());
$row_treatmentinfo = mysqli_fetch_assoc($treatmentinfo);
$totalRows_treatmentinfo = mysqli_num_rows($treatmentinfo);

$query_TempMemo = sprintf("SELECT * FROM MemoTemp WHERE Hospital_ID = '%s'", ($colname_Hospital_ID));
$MemoInfo = mysqli_query($test, $query_TempMemo) or die(mysqli_error());
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

$query_TempOrder = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = '%s'", ($colname_Hospital_ID));
$OrderInfo = mysqli_query($test, $query_TempOrder) or die(mysqli_error());
$row_Orderinfo = mysqli_fetch_assoc($OrderInfo);
$total_Orderinfo = mysqli_num_rows($OrderInfo);






// Compute prescription

?>

<!-- Attachment -->



<?php
            $sttitle = (date('Y-m-d',strtotime($row_treatmentinfo[RT_start1])));
	
// 	strtotime($row_treatmentinfo[RT_start1])
	
?>








<table width = "1000px">
	<tr>
		<td>


  	<table width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
    	<br>
		<td valign="middle" width="810px" scope="row" colspan="2" height="60" valign="middle"> 
			
			<p style="font-family: arial; font-size:24px; color: #252e6a">&nbsp;<strong>Radiation Oncology History (<?php echo($sttitle);?>)</strong></p> 
		</td>
			
			
			

		
		
		
		<td width="50px" scope="row">
			<form id=form11 name=form11 method=post action="N_edit_history.php">
				<th align=right ><input class = "btn btn-default" type=submit name=btn_home id=btn_home value=Delete-course >
					<input class = "btn btn-default" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>>
					<input class = "btn btn-default" name=delcourse type=hidden id=delcourse  value= <?php echo $courseid ?>>					
					<input class = "btn btn-default" name=chartid type=hidden id=chartid  value= <?php echo $hf_edit ?>>					
					<?php
				    echo "<input name=permit type=hidden id=permit  value=$permitUser >";            
				    echo "<input name=hf_edit type=hidden id=hf_edit value= $hf_edit >";      
				    echo "<input name=H_ID type=hidden id=H_ID value= $hf_edit >";      
				    echo "<input name=courseid type=hidden id=courseid value= $courseid >";      
				    ?>
					
				</th>
			</form>
			
		</td>
  
  	</table>
  	<br>

	    <?php
      for($iddrsel=0;$iddrsel<$numphyss;$iddrsel++){
	      $drSel = $row_treatmentinfo['physician'];
        if (strcmp($row_treatmentinfo['physician'],$phyIdd[$iddrsel])==0){
          $drSel = $phyInt[$iddrsel];

        }        

      }
      
      ?>




	    <?php
			if(file_exists("PatientPhoto/". $row_patientinfo['RO_ID'].".jpg")==1){
				$photoPath = "PatientPhoto/". $row_patientinfo['RO_ID'].".jpg";
			}
			elseif(strcmp($row_patientinfo['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_patientinfo['RO_ID'].".jpg")!=1){
								$photoPath = "/PatientPhoto/m.jpg";

			}
			elseif(strcmp($row_patientinfo['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_patientinfo['RO_ID'].".jpg")!=1){
								$photoPath = "/PatientPhoto/f.jpg";

			}
			else{
			         $photoPath = "/PatientPhoto/icon.png";
	
			}



		?>
		
  	<table class = "type03" width="960px" border="1" cellspacing="5" cellpadding="5" align="left">
  		<tr>
	  		<td cellspacing="0"  rowspan="2" align="center">
		  		<img  src=<?php echo $photoPath; ?> width="70px">
	  		</td>
  			<td width="80px" bgcolor="#153d73"><font color="white">Chart Number</font></td>
  			<td width="120px" bgcolor="#153d73"><font color="white">Name</font></td>    
  			<td width="120px" bgcolor="#153d73" colspan="2"><font color="white">S/A</font></td> 
  			  
  			<td width="120px" bgcolor="#153d73" ><font color="white">Physician</font></td>
  			<td width="240px" bgcolor="#153d73" colspan="2"><font color="white" >Clinic(hospital)</font></td>
<!--   			<td width="120px" bgcolor="#153d73"><font color="white"><br></font></td> -->
  			<td width="120px" bgcolor="#153d73"><font color="white">Refer.<br>physician</font></td>
		</tr>

		<tr valign="middle">
			<td valign="middle">
								<strong><font size="3"><?php echo $row_patientinfo['Hospital_ID']; ?></font><strong>	<br><?php echo $row_patientinfo['RO_ID']; ?>			

			</td>
			
			<td valign="middle">
<!-- 								<?php echo substr($row_patientinfo['RO_ID'],5,7); ?>				 -->
				<strong><font size="3"><input class="form-control" name="txt_name" type="text" id="txt_name" style="width:100%;height:100%; font-size:11pt; ime-mode:active"  value="<?php echo $row_patientinfo['KorName']; ?>" /></font></strong>        

			</td>
			
			<td>
		  		<select class="form-control" style="width:100%;" name="txt_search_sex" id="txt_search_sex" >
		  		<option value="<?php echo $row_patientinfo['Sex']; ?>" selected="selected"><?php echo $row_patientinfo['Sex']; ?></option>
		  		<option value="M">M</option>
		  		<option value="F">F</option>
	      		</select>	      

					      
      		</td>
	  		
	  		<td>
	      		<input class="form-control" style="font-size: 10pt" name="txt_age" type="text" id="txt_age" value="<?php echo $row_patientinfo['Age']; ?>" />
		  		
	  		</td>
	  		
	  		<td>
		  			  			<select class="form-control" style="width:100%; font-size: 10pt" name="txt_physician" id="txt_physician" >
	  			<option value="<?php echo $row_treatmentinfo['physician']; ?>" selected="selected"><?php echo $drSel; ?></option>

          <?php for($idN=0;$idN<$numphyss;$idN++){  ?>
            <option value=<?php echo($phyIdd[$idN]); ?>><?php echo($phyInt[$idN]); ?></option>

          <?php } ?>


				</select>	      
    

	  		</td>
<!--
		  		<select name="txt_search_sex" id="txt_search_sex" >
		  		<option value="<?php echo $row_patientinfo['Sex']; ?>" selected="selected"><?php echo $row_patientinfo['Sex']; ?></option>
		  		<option value="F">F</option>
		  		<option value="M">M</option>
	      		</select>	      
-->
      		</td>      
	  		
<!-- 	  		<td> -->
<!-- 	  			<input class="form-control" style="height:25px; width:80px" name="txt_age" type="text" id="txt_age" value="<?php echo $row_patientinfo['Age']; ?>" /> -->
<!-- 	  			<?php echo $row_patientinfo['Age']; ?> -->
<!--       		</td> -->
	  		
	  		<td colspan="2">
				<input class="form-control" style="font-size: 10pt; width: 200px" name="txt_clinic" type="text" id="txt_clinic" value="<?php echo $row_treatmentinfo['Clinic']; ?>" />
		  		
			</td>
			
<!--
			<td>
			</td>
-->
			
			<td>
				<input class="form-control" style="font-size: 10pt" name="txt_doctor" type="text" id="txt_doctor" value="<?php echo $row_treatmentinfo['diagnosis']; ?>" />
			</td>
   		</tr>
   		
  		<tr>
	  		 <td  bgcolor="#153d73" rowspan="2"><font color="white">Site</font></td>	  		
  			<td  colspan="1">
	  			<select  class="form-control" style=" width:100%; font-size: 12px;" name="primary_menu" id="primary_menu" class="required" onchange="fnCngList(this.value);" >
	  				<option value="<?php echo $row_treatmentinfo['primarysite']; ?>" selected="selected"><?php echo $row_treatmentinfo['primarysite']; ?></option>



            <?php for($idN=0;$idN<$numcatg;$idN++){  ?>
            <option value=<?php echo($catgInt[$idN]); ?>><?php echo($catgInt[$idN]); ?></option>
            <!-- <option value="CNS">CNS</option>  -->

            <?php } ?>

	  			</select>
  			</td>
  			 <td  colspan="3">
	  			<strong><input class="form-control" style="width:100%; font-size: 11pt " name="sub_site" type="text" id="sub_site" value="<?php echo $row_treatmentinfo['subsite']; ?>" /></strong>
  			</td>

  			  			<td bgcolor="#153d73"><font color="white">Stage</font></td>      
  			<td colspan=3><strong><input class="form-control" style="width:100%; font-size: 11pt " name="txt_tnmstage" type="text" id="txt_tnmstage" value="<?php echo $row_treatmentinfo['tnm']; ?>" /> </strong></td>

		</tr>
		

		
		
  		<tr>

  			<td  colspan="4">
	  			<input class="form-control"  name="sub_siteDet" type="text" id="sub_siteDet" value="<?php echo $row_treatmentinfo['subsiteDet']; ?>" />	  			
  			</td>  			 

  			<td bgcolor="#153d73" rowspan="1"><font color="white">Pathology</font></td>
  			<td colspan="3"  rowspan="1">
  				<strong><input class="form-control" style="width:100%; font-size: 11pt" name="pathology_menu" type="text" id="pathology_menu" value="<?php echo $row_treatmentinfo['pathol']; ?>" /></strong>
	  			
	  		</td>
		</tr>
	  	

		<tr>
			<td bgcolor="#153d73" rowspan=1><font color="white">Prescription</font></td>
  			<td colspan=8>
	  			<?php
		  			$fxDose = (float)$row_treatmentinfo['dose_sum']/(float)$row_treatmentinfo['Fx_sum'];
		  			$fxDoseStr = sprintf("%.2f", $fxDose);		  			
		  		?>
	  			<font size="2" color="red"><strong><?php echo $row_treatmentinfo['dose_sum']?> Gy (<?php echo $fxDoseStr." Gy X ".$row_treatmentinfo['Fx_sum']?> fx.)</strong></font>
	  			
	  				  			<?php
		  		$cropN = 100;

					for($planIdx=1;$planIdx<$row_treatmentinfo[idx]+1;$planIdx++){
						    
						$SiteX       = "Site" . "$planIdx";
						$SiteX=(substr($row_treatmentinfo[$SiteX],0,$cropN));
						if(strlen($SiteX)==0){
							$SiteX = "N/A";
						}
						$doseX     = "dose" . "$planIdx";
						$fxX       = "Fx" . "$planIdx";
								
							echo "<font  face=arial>$planIdx.$SiteX:</font><font color=blue face=arial>$row_treatmentinfo[$doseX]($row_treatmentinfo[$fxX])&nbsp;</font>";
					
					}
		  		?>

	  			
	  			
	  			
	  			
	  			
  			</td>


		
		


    

		
		
				</tr>


      
  	</table>


<!--
  	<table class = "type1" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">
  		<tr>
  			<td width="240px">Primary site/site: &nbsp;
	  			<select name="primary_menu" id="primary_menu" class="required" onchange="fnCngList(this.value);" >
	  				<option value="<?php echo $row_treatmentinfo['primarysite']; ?>" selected="selected"><?php echo $row_treatmentinfo['primarysite']; ?></option>
	  				<option value="CNS">CNS</option> 
	  				<option value="HN">HN</option>
	  				<option value="THX">THX</option>
	  				<option value="BRST">BRST</option>
	  				<option value="GI">GI</option>
	  				<option value="GU">GU</option>
	  				<option value="GY">GY</option>
	  				<option value="MS">MS</option>
	  				<option value="SKIN">SKIN</option>
	  				<option value="HMT">HMT</option>
	  				<option value="PD">PD</option>
	  				<option value="BENIGN">BENIGN</option>
	  				<option value="CUPS">CUPS</option>
	  				<option value="OTHER">OTHER</option>
	  			</select>
  			</td>
  			<td width="240px">
	  			<input class="form-control" style="height:25px; width:150px" name="sub_site" type="text" id="sub_site" value="<?php echo $row_treatmentinfo['subsite']; ?>" />	  			
  			</td>
  			<td width="480px">
	  			
  			</td>      
		</tr>
		
  	</table>  	
-->


<!--
  	<table class = "type03" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">
		
		

	</table>  	
-->
  	

  	
  	<table class = "type03" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">
  		<tr>
	  	  	<td width="480px" colspan="1" bgcolor="#153d73"><font color="white">Radiation therapy history</font></td>
	  		
	  	  	<td width="480px" colspan = "1" bgcolor="#153d73">
		  	  	<font color="white">Lab findings </font>		  	  	
	  	  	</td>

		</tr>
  		<tr>
	  	  	<td width="480px" colspan="1" rowspan="1">
            <?php 
            if(strlen($row_clinicalinfo['RadioHistory'])>1){
              $rthist = $row_clinicalinfo['RadioHistory']."&nbsp;\r".$prev;
            }
            else{
              $rthist = $prev;

            }

            ?>
		  	  			  	  	<textarea style="width:100%; resize:none;"   class="noresize" width="480px" rows="3" cols = "65" name="txt_ClinicalHistoryRadioHistory" type="text" id="txt_ClinicalHistoryRadioHistory"><?php echo $rthist; ?></textarea>

	  	  	</td>
	  		
	  	  	<td width="480px" colspan = "1">
		  	  	<textarea style="width:100%; resize:none;"   style="resize:none;" class="noresize" width="480px" rows="3" cols = "65" name="txt_ClinicalHistoryTumor" type="text" id="txt_ClinicalHistoryTumor"><?php echo $row_clinicalinfo['TumorMarker']; ?></textarea>
		  	  	
	  	  	</td>

		</tr>	  	
	  	
	  	
	  	
	  	
  		<tr>
  			<td bgcolor="#153d73"><font color="white">Operation</font></td>
  			<td bgcolor="#153d73"><font color="white">Chemotherapy</font></td>      
		</tr>
  		<tr>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="3" cols = "65" name="txt_ClinicalHistoryOp" type="text" id="txt_ClinicalHistoryOp"><?php echo $row_clinicalinfo['Op']; ?></textarea></td>      
	  		
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="3" cols = "65" name="txt_ClinicalHistoryChemo" type="text" id="txt_ClinicalHistoryChemo"><?php echo $row_clinicalinfo['chemo']; ?></textarea></td>
		</tr>
  	</table>  	

  	<table class = "type03" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">
  		<tr>
  			<td bgcolor="#153d73"><font color="white">Pathologic findings</font></td>
  			<td bgcolor="#153d73"><font color="white">Radiologic findings</font></td>      
		</tr>
  		<tr>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="19" cols = "65" name="txt_ClinicalHistoryPathol" type="text" id="txt_ClinicalHistoryPathol"><?php echo $row_clinicalinfo['Pathol']; ?></textarea></td>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="19" cols = "65" name="txt_ClinicalHistoryRadio" type="text" id="txt_ClinicalHistoryRadio"><?php echo $row_clinicalinfo['Radio']; ?></textarea></td>      
		</tr>
  	</table>  	

  	<table class = "type03" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">
  		<tr>
  			<td bgcolor="#153d73"><font color="white">Referral letter</font></td>
  			<td bgcolor="#153d73"><font color="white">Reply</font></td>      
		</tr>
  		<tr>
        <?php $ltr = $row_clinicalinfo['ConsultTemplate'];  ?>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="5" cols = "65" name="txt_ClinicalHistoryConsult" type="text" id="txt_ClinicalHistoryConsult"><?php echo "$ltr"; ?></textarea></td>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="5" cols = "65" name="txt_ClinicalHistoryReply" type="text" id="txt_ClinicalHistoryReply"><?php echo $row_clinicalinfo['ConsultReply']; ?></textarea></td>      
		</tr>
  	</table>  	










  

<script type = "text/javascript">
	  function btn_danger(){
		  alert("Please specify first start date!");
	  }
</script>
	  
<?php 
	$Today_Date = Date("n/j/y");    
	$curManual = $row_patientinfo[ManualEdit];    
	if(strcmp($curManual,"1")==0){
		$manualStat = "Manual";
		$manualVal = "1";
	}
	else{
		$manualStat = "Auto";
	}
	echo $row_patientinfo[ManualEdit];
?>


	<table class = "type1" width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
  	<td>
		<font style="font-family: arial; font-size:18px; color:#FF7E79">&nbsp;&nbsp;Radiotherapy Planning</font> <br> <font color="red" size="2"> &nbsp;&nbsp;&nbsp;<strong>Notice: (달력 날짜 표시가 "년/월/일"으로 변경되었습니다!</strong>.</font>

		
		
		
		
  	</td>
    </tr>  
	</table>






          <?php
            $fxDose = (float)$row_treatmentinfo['dose_sum']/(float)$row_treatmentinfo['Fx_sum'];
            $fxDoseStr = sprintf("%.2f", $fxDose);            
          ?>

          <?php 
          $prevst = $row_treatmentinfo[RT_start1];
          $preved = $row_treatmentinfo[RT_fin_f];
          $prevpp = $row_treatmentinfo['purpose'];
          $prevsite = $row_treatmentinfo['subsite'];
          $prevds = $row_treatmentinfo['dose_sum'];
          $prevfx = $fxDoseStr; //평균 dose
          $prevfd = $row_treatmentinfo['Fx_sum'];

          $CourseRemarker = "<font size=2 color=black face=arial><strong>(".$row_treatmentinfo[RT_start1]." - ".$row_treatmentinfo[RT_fin_f].")</font>"."<font size='2' color='red'>
            ".$row_treatmentinfo['purpose']." RT to ".$row_treatmentinfo['subsite']." ".$row_treatmentinfo['dose_sum']. " Gy (".$fxDoseStr." Gy X ".$row_treatmentinfo['Fx_sum']." fx.)</strong></font>";
          ?>


                    <?php
          $cropN = 100;

          for($planIdx=1;$planIdx<$row_treatmentinfo[idx]+1;$planIdx++){
                
            $SiteX       = "Site" . "$planIdx";
            $SiteX=(substr($row_treatmentinfo[$SiteX],0,$cropN));
            if(strlen($SiteX)==0){
              $SiteX = "N/A";
            }

            $doseX     = "dose" . "$planIdx";
            $fxX       = "Fx" . "$planIdx";
            if(strcmp($row_treatmentinfo[$fxX],"0")!=0){

              $CourseRemarker = $CourseRemarker."<font  face=arial> ".$planIdx.". ".$SiteX.":</font><font color=blue face=arial>".$row_treatmentinfo[$doseX]."(".$row_treatmentinfo[$fxX].")&nbsp;</font>";
            }  
          
          }

          ?>


  


	<table class="type04" width="960px" align="left">
		
		    <tr>
		
  			<td width="120px" colspan="1">
		 	<select class="form-control" name="Manual" >
		 		<option value=" <?php echo $manualVal; ?>" selected="selected"><?php echo $manualStat; ?></option>
		 		<option value="1">Manual</option>
		 		<option value="0">Auto</option>
        	</select>
	  		</td>
	  		
	  				
		  	<td width="120px" bgcolor="#FF7E79" valign="middle">Aim:</td>
  			<td width="180px" colspan="1">
			  <select  class="form-control" name="purpose_menu" id="purpose_menu" >
	          <option value="<?php echo $row_treatmentinfo['purpose']; ?>"  selected="selected"><?php echo $row_treatmentinfo['purpose']; ?></option>
	          <option value="Definitive">Definitive</option>
	          <option value="Adjuvant">Adjuvant</option>
	          <option value="Neoadjuvant">Neoadjuvant</option>
	          <option value="Local Control">Local Control</option>
	          <option value="Salvage">Salvage</option>          
	          <option value="Prophylactic">Prophylactic</option>          
	          <option value="Palliative">Palliative</option>
	          <option value="Other">Other</option>
	  		</td>
  			<td width="80px" bgcolor="#FF7E79">CCRT:</td>
  			<?php $CCRTs = $row_treatmentinfo['Modality_var1']; ?>
	  		<td width="150px" colspan="1">
        			<select class="form-control" name="txt_modality" >
			 		<option value= "<?php echo($CCRTs); ?>" selected="selected"><?php echo($CCRTs); ?></option>
			 		<option value="CCRT">CCRT</option>
			 		<option value="">N/A</option>
			 		</select>
	  		</td>
			<td valign="middle">
				<strong><font size="3"><input class="form-control" name="txt_chemo" type="text" id="txt_chemo" style="width:250px;height:100%; font-size:11pt"  value="<?php echo $row_treatmentinfo['Modality_var2']; ?>" /></font></strong>        

			</td>

			
		  	<td width="120px" bgcolor="#FF7E79" valign="middle">Planner</td>
  			<td width="80px" colspan="1">
			  <select  class="form-control" name="txt_planner" id="txt_planner" >
	          <option value="<?php echo $row_treatmentinfo['planner']; ?>"  selected="selected"><?php echo $row_treatmentinfo['planner']; ?></option>

          <?php for($idN=0;$idN<$numplnss;$idN++){  ?>
            <option value=<?php echo($plnInt[$idN]); ?>><?php echo($plnInt[$idN]); ?></option>

          <?php } ?>

	  		</td>
</tr>
	</table>



<!-- <table class = "type1" width="960px" border="0" cellspacing="1" cellpadding="1" align="center"> -->
<!--
	<tr>
      	<th width="5%" scope="row" style="color: #FF7E79">Plan #</th>
	  		<td width="10%">
        <?php echo $row_treatmentinfo['idx']; ?></td>
		<th width="5%" style="color: #FF7E79">Update</th>
			<td width="10%">
					<input class="form-control" style="height:25px; width:80px" name="txt_birth" type="text" id="txt_birth" value="<?php echo $Today_Date; ?>" size = "5" />
    		</td>
    </tr>
-->
<!--
    <tr>
      <th width="150" nowrap="nowrap" scope="row" style="color: #FF7E79">Purpose</th>
      <td width="500">
	      <label for="purpose_menu"></label>
		  <select name="purpose_menu" id="purpose_menu" >
          <option value="<?php echo $row_treatmentinfo['purpose']; ?>"  selected="selected"><?php echo $row_treatmentinfo['purpose']; ?></option>
          <option value="Definitive">Definitive</option>
          <option value="Adjuvant">Adjuvant</option>
          <option value="Neoadjuvant">Neoadjuvant</option>
          <option value="Local Control">Local Control</option>
          <option value="Salvage">Salvage</option>          
          <option value="Prophylactic">Prophylactic</option>          
          <option value="Palliative">Palliative</option>
          <option value="Other">Other</option>
          </select>
        </td>
    </tr>
    <tr>
      <th height="23" nowrap="nowrap" scope="row" style="color: #FF7E79">CCRT</th>
      	<td>
        	<input class="form-control" style="height:25px; width:80px" name="txt_modality" type="text" id="txt_modality" value="<?php echo $row_treatmentinfo['Modality_var1']; ?>" size = "7"/>
        </td>
        
    </tr>
</table>
-->

<!--
<table class="type04" width="960px" align="center">
	<tr>
		<th>
		<a href = "#Routine1"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Head & Neck</a>					
		<a href = "#Routine2"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>WhBrain</a>
		<a href = "#Routine3"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Cervix & PAN</a>
		<a href = "#Routine4"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Lung</a>
		<a href = "#Routine5"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Breast</a>
		<a href = "#RoutineProstate"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Prostate</a>
		<button type = "button" id="addTR" class = "btn btn-default">+</button>
		</th>
		
	</tr>
	
</table>
-->


<table class="type05" width="960px" align="center">
  <tr>
    <th>
    <!-- 루틴을 만들기 위한 설정 1. 버튼을 만든다. 페이지에 있는 Modal창(#Routine5)으로 이동하기 위해 # Routine5의 모달창 정의 변수명을 적절한 것으로 변경할것!-->
    <button type = "button" id="addTR" class = "btn btn-default">Add schedule</button>
    </th>
    <th>
<?php
    // echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    // echo "<a href=edit.php>";            
    // echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    // echo "<input name=permit type=hidden id=permit  value=$permitUser/>"; 
    //   echo "<input name=username type=hidden id=username  value=$uid/>";      
               
    // echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

?>






    </th>
    
  </tr>
  
</table>



<table class="type04" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
		<th width="10px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; I </th>  
		<th width="80px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Room </th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Method </th>
		<th width="200px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Site </th>		
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Gy</th>
		<th width="40px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; fx.</th>
		<th width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT  </th>
		<th width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Start  </th>
		<th width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Finish   </th>

<!-- 		<th width="80px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT sch  </th>		 -->
		<th width="50px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CE  </th>		
		<th colspan ="3" align=left width="85px" scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Delay  </th>		
		<th width="20px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
		<th width="40px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF">Status</th>
    
  	</tr>
  
  
    <?php 
	   
       $sql_idx_result = mysqli_result($treatmentinfo,0,"idx");
       $rt_menu_last = "rt_menu"."$sql_idx_result";
       $txt_field_last = "txt_field"."$sql_idx_result";
       $txt_linca_last = "txt_linac"."$sql_idx_result";
       $txt_site_last = "txt_site"."$sql_idx_result";
       $txt_rt_start_last = "txt_rt_start"."$sql_idx_result";
       $txt_ct_sim_last = "txt_ct_sim"."$sql_idx_result";
       $idxx = $sql_idx_result; 
	   
       $n_CT = 3;
	   $n_Fin = 2;
	   $n_RT = 1;
       ?>
    <?php for($i=0;$i<$sql_idx_result;$i++){ 
	   		$j = $i+1;
	   
	   		$Site_f = "Site"."$j";
	   		$Linac_f = "Linac"."$j";
	   		$Field_f = "Field"."$j"; 
	   		$dose_f = "dose"."$j";
	   		$fx_f = "Fx"."$j";
	   		$RT_start_f = "RT_start"."$j";
	   		$RT_method_f = "RT_method"."$j";
	   		$CT_sim_f = "CT_Sim"."$j";
	   		$RT_fin_f = "RT_fin"."$j";

	   		$sim_f = "CT_Time"."$j";
	   		$ce_f = "CT_Ce"."$j";	   		

	   		$Delay_idx_f = "Delay_idx"."$j";     
                
	   		$D_idx = $row_treatmentinfo[$Delay_idx_f];
	   
	   
	   		if($D_idx == ''){ $D_idx = 0;} 

			$rt_menu_f = "rt_menu"."$j";
			$txt_field_f = "txt_field"."$j";
			$txt_linca_f = "txt_linac"."$j";
			$txt_site_f = "txt_site"."$j";
			$txt_dose_gy_f = "txt_dose_gy"."$j";
			
			$txt_CT_order_f = "txt_ct_order"."$j";
			$txt_CT_ce_f = "txt_ct_ce"."$j";
									
			$txt_dose_fx_f = "txt_dose_fx"."$j";
			$txt_rt_start_f = "txt_rt_start"."$j";
			$txt_ct_sim_f = "txt_ct_sim"."$j";
			$txt_rt_fin_f = "txt_rt_fin"."$j";
			$txt_tn_f = "txt_tn"."$j";
	   
			$txt_pre_finish_f = "txt_pre_finish"."$j";
	   
			$n_CT = 3+3*($j-1);
			$n_Fin = 2+3*($j-1);
			$n_RT = 1+3*($j-1);
			$RT_date = "Test_Datepicker"."$n_RT";
			$FIN_date = "Test_Datepicker"."$n_Fin";
			$CT_date = "Test_Datepicker"."$n_CT";
			$DelayID = "Delay"."$j";
			$Delay_Plus = "Plus"."$j";
			$Delay_Minus = "Minus"."$j";
// 			print_r($techIdd)
    ?>
    
 
    <tr>
      <td><?php echo $j ?> 
    </td>
      	<td scope="row">
		 	<select class="form-control" name="Linac[]" >
		 		<option value=" <?php echo trim($row_treatmentinfo[$Linac_f]); ?>" selected="selected"><?php echo trim($row_treatmentinfo[$Linac_f]); ?></option>
		 		<option value="Versa">Versa</option>
		 		<option value="IX">IX</option>
		 		<option value="Infinity">Infinity</option>
        	</select>
      	</td>
    
      	<td scope="row">
		 	<select class="form-control" name="Method[]" >
		 		<option value=" <?php echo trim($row_treatmentinfo[$RT_method_f]); ?>" selected="selected"><?php echo trim($row_treatmentinfo[$RT_method_f]); ?></option>

        <?php for($idN=0;$idN<$numtech;$idN++){ ?>
        <option value="<?php echo($techIdd[$idN]); ?>"><?php echo($techIdd[$idN]); ?></option>
        <?php } ?>


        	</select>
      	</td>



        <?php
          if(strlen($row_treatmentinfo[$CT_sim_f])>0){ 
            $ctD = (date('y/n/j',strtotime($row_treatmentinfo[$CT_sim_f])));
          }
          else{
             $ctD = "";
          }
          if(strlen($row_treatmentinfo[$RT_start_f])>0){ 
          $stD = (date('y/n/j',strtotime($row_treatmentinfo[$RT_start_f])));
          }
          else{
             $stD = "";
          }

          if(strlen($row_treatmentinfo[$RT_fin_f])>0){ 
          $edD = (date('y/n/j',strtotime($row_treatmentinfo[$RT_fin_f])));
          }
          else{
             $edD = "";
          }

        ?>

        
        <td ><input class="form-control" name="Site[]" type="text" value="<?php echo $row_treatmentinfo[$Site_f]; ?>" size="3" /></td>
        
        <td ><input class="form-control" name="Dose[]" type="text" value="<?php echo $row_treatmentinfo[$dose_f]; ?>" size="3" /></td>
        <td ><input class="form-control" name="Fx[]" type="text" value="<?php echo $row_treatmentinfo[$fx_f]; ?>" size="3" /></td>
        <td ><input class="form-control" name="CT[]" id = "<?php echo $CT_date; ?>" type="text" value="<?php echo $ctD; ?>" size="10"/></td>        
        <td ><input class="form-control" name="Start[]" id = "<?php echo $RT_date; ?>" type="text" value="<?php echo $stD; ?>" size="10" /> </td>
        <td ><input class="form-control" name="Finish[]" id = "<?php echo $FIN_date; ?>" type="text" value="<?php echo $edD; ?>" size="10"/>
        </td>




        <?php
        if($row_treatmentinfo[$sim_f]==1){$cInd = "1: 08:30";}
        elseif($row_treatmentinfo[$sim_f]==2){$cInd = "2: 09:20";}        
        elseif($row_treatmentinfo[$sim_f]==3){$cInd = "3: 10:10";}        
        elseif($row_treatmentinfo[$sim_f]==4){$cInd = "4: 11:00";}        
        elseif($row_treatmentinfo[$sim_f]==5){$cInd = "5: 13:30";}        
        elseif($row_treatmentinfo[$sim_f]==6){$cInd = "6: 14:20";}        
        elseif($row_treatmentinfo[$sim_f]==7){$cInd = "7: 15:10";}        
        elseif($row_treatmentinfo[$sim_f]==8){$cInd = "8: 16:00";}        
        elseif($row_treatmentinfo[$sim_f]==0){$cInd = "Other";}        
        
        ?>
        
		<td ></select>			
		<select class="form-control" name="Ce[]" >
			<option value=" <?php $row_treatmentinfo[$ce_f]; ?>" selected="selected"> <?php echo $row_treatmentinfo[$ce_f]; ?></option>
			<option value="CE">CE</option>
			<option value="NCE">NCE</option>									
		</select></td>
        
        <td><input type="text" class="form-control" id = "<?php echo $DelayID; ?>" name = "Delay[]"  value ="<?php if($row_treatmentinfo[$Delay_idx_f]){echo $row_treatmentinfo[$Delay_idx_f];}else{};?>" /> </td>
		<td><center><input type="button"   value = "+" id = "<?php echo $Delay_Plus; ?>" ></center></td>
		<td><center><input type="button"   value = "-" id = "<?php echo $Delay_Minus; ?>" ></center></td>
        
		<td><center><button type = "button"  class="btn btn-default" >-</button></center>
			
		</td>
<!--
		<td><center>
			
<-- 			<?php echo($statMarker[$i]);?> -->
			
		</td>

      	<td scope="row">
		 	<select class="form-control" name="StatusCheck[]" >
		 		<option value=" <?php echo $statMarker[$i]; ?>" selected="selected"><?php echo $statMarker[$i]; ?></option>
		 		<option value="N">N</option>
		 		<option value="T">T</option>
		 		<option value="P">P</option>
		 		<option value="A">A</option>
        	</select>
      	</td>

    </tr>
   
  
    <?php } ?>
</table>  





<!--


<table class="type04" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
<tr>
<td>
	<?php echo $CTDat;?>의 각 방별 신환수: Versa <?php echo($numStartVersa);?>, IX <?php echo($numStartIx);?>, Infinity <?php echo($numStartInfinity);?>

</td>
</tr>	  
</table>
-->

</td>
</tr>
</table>


