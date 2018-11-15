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

$nowa = $_POST['nowa'];
$toda = $_POST['toda'];


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
  // MUST BE DELETED!!!!
  // echo($uid);

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
    border-left: 1px solid #000000;
	margin : 0px 0px;
}
table.type03 th {
    width: 147px;
    padding: 2px;
    font-weight: bold;
    vertical-align: top;
    color: #000000;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type03 td {
/*     width: 320px; */
    padding: 3px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type04 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(0, 0, 0, 0.98); /* red 50 (ibm design colors) */
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


//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// U P D A T E //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////


// echo($query_Telegram);

$ct1 = $_POST['ct1'];
$ct2 = $_POST['ct2'];
$ct3 = $_POST['ct3'];
$ct4 = $_POST['ct4'];
$ct5 = $_POST['ct5'];
$ct6 = $_POST['ct6'];
$ct7 = $_POST['ct7'];






// Delay 구현 하는 부붙....
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  	$h_result = sprintf("select idx from TreatmentInfo where Hospital_ID = %s", ($_POST['H_ID']));
  	$h_result = mysqli_query($test, $h_result);
  	$h_idx = mysqli_result($h_result,0,"idx");
  	$ID_ = $_POST['H_ID'];


	$UPDATESQLManual = sprintf("UPDATE PatientInfo SET ManualEdit=%s WHERE Hospital_ID='$ID_'",($_POST['Manual']));
	
	mysqli_query($test, $UPDATESQLManual);	
	
	
	mysqli_select_db($database_test);
	$query_manualEdit = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = %s", ($_POST['H_ID']));
	$editinfo = mysqli_query($test, $query_manualEdit) or die(mysqli_error());
	$row_editinfo = mysqli_fetch_assoc($editinfo);




  $manuals = $_POST['Manual'];

  $Method_ = $_POST['Method'];
  $Linac_ = $_POST['Linac'];
  $Site_ = $_POST['Site'];

  $Dose_ = $_POST['Dose'];
  $Fx_ = $_POST['Fx'];
	
// 	$Order_ = $_POST['CTOrder'];
// 	print_r($Order_);
// 	print_r($Order_);

	$Ce_ = $_POST['Ce'];
// 	print_r($Ce_);
			
  $Start_ = $_POST['Start'];
  for($idss=0;$idss<count($Start_); $idss++){
    if(strlen($Start_[$idss])>1){ 
        $myDateTime = DateTime::createFromFormat('y/n/j', $Start_[$idss]);
        $newDateString = $myDateTime->format('n/j/y');

        $Start_[$idss] =  $newDateString;
    }
  }

  $CT_ = $_POST['CT'];
  for($idss=0;$idss<count($CT_); $idss++){
    if(strlen($CT_[$idss])>1){ 
        $myDateTime = DateTime::createFromFormat('y/n/j', $CT_[$idss]);
        $newDateString = $myDateTime->format('n/j/y');
        $CT_[$idss] =  $newDateString;
    }
  }




  $Finish_ = $_POST['Finish'];
  for($idss=0;$idss<count($Finish_); $idss++){
    if(strlen($Finish_[$idss])>1){ 
        $myDateTime = DateTime::createFromFormat('y/n/j', $Finish_[$idss]);
        $newDateString = $myDateTime->format('n/j/y');
        $Finish_[$idss] =  $newDateString;
    }
  }



	
	$Delay_ = $_POST['Delay'];


// 	print_r($planStat);

		
	$Plan = count($Method_);
	
	$All_Dose = 0;
    $All_Fx = 0;
    $Stop = 0;
    
    for($i =0; $i<$Plan; $i++){
	    $All_Dose = $All_Dose + $Dose_[$i];
	    $All_Fx = $All_Fx + $Fx_[$i];
    }
	
// 	이전과 달라진 부분을 체크하기 위해 해당 entry를 모두 가져온다.
	$query_Telegram = sprintf("SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.Hospital_ID like '%s'", $_POST['H_ID']);
// 	echo($query_Telegram);
	$RecordsetTelegram = mysqli_query($test, $query_Telegram) or die(mysqli_error());
	$row_RecordsetTelegram       = mysqli_fetch_assoc($RecordsetTelegram);

	




	




	if($row_RecordsetTelegram[CurrentStatus]!=($_POST['CurrentStatus_menu'])){
		if(($_POST['CurrentStatus_menu'])==0){
			$curStat = "Active";			
		}
		elseif(($_POST['CurrentStatus_menu'])==1){
			$curStat = "Finish";					
		}
		elseif(($_POST['CurrentStatus_menu'])==2){
			$curStat = "Stop";			
		}
		elseif(($_POST['CurrentStatus_menu'])==3){
			$curStat = "Drop";			
		}
		elseif(($_POST['CurrentStatus_menu'])==4){
			$curStat = "Hold";			
		}
		else{			$curStat = "";			
}
		if($row_RecordsetTelegram[CurrentStatus]==0){
			$preStat = "Active";			
		}
		elseif($row_RecordsetTelegram[CurrentStatus]==1){
			$preStat = "Finish";					
		}
		elseif($row_RecordsetTelegram[CurrentStatus]==2){
			$preStat = "Stop";			
		}
		elseif($row_RecordsetTelegram[CurrentStatus]==3){
			$preStat = "Drop";			
		}
		elseif($row_RecordsetTelegram[CurrentStatus]==4){
			$preStat = "Hold";			
		}
		else{$preStat="";}
		if(strcmp($preStat,$curStat)!=0){ 
		$statChange = $preStat. "->". $curStat;
		}
		else{		$statChange = "";
 }
	}
	else{
		$statChange = "";
		}	
// 	if



	$query_numOrder = mysqli_query($test, sprintf("Update TreatmentInfo Set NumOrder = '0' where Hospital_ID like '%s'", $_POST['H_ID']));

	$UPDATESQL = sprintf("UPDATE TreatmentInfo SET  Modality_var1=%s, Modality_var2=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_modality']),($_POST['txt_chemo']));
	$UPDATESQL21 = sprintf("UPDATE ClinicalInfo SET  TumorMarker=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryTumor']));
    $Result41 = mysqli_query($test, $UPDATESQL21);    
	$UPDATESQL22 = sprintf("UPDATE ClinicalInfo SET  chemo=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryChemo']));
    $Result42 = mysqli_query($test, $UPDATESQL22);    
	$UPDATESQL23 = sprintf("UPDATE ClinicalInfo SET   Radio=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryRadio']));
    $Result43 = mysqli_query($test, $UPDATESQL23);    
	$UPDATESQL24 = sprintf("UPDATE ClinicalInfo SET   Pathol=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryPathol']));
    $Result44 = mysqli_query($test, $UPDATESQL24);
	$UPDATESQL25 = sprintf("UPDATE ClinicalInfo SET   Op=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryOp']));
    $Result45 = mysqli_query($test, $UPDATESQL25);    
	$UPDATESQL26 = sprintf("UPDATE ClinicalInfo SET   RadioHistory=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryRadioHistory']));
    $Result46 = mysqli_query($test, $UPDATESQL26);
	$UPDATESQL26 = sprintf("UPDATE ClinicalInfo SET   ConsultTemplate=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryConsult']));
    $Result46 = mysqli_query($test, $UPDATESQL26);
	$UPDATESQL27 = sprintf("UPDATE ClinicalInfo SET   ConsultReply=%s WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryReply']));
    $Result46 = mysqli_query($test, $UPDATESQL27);
				  
  
	$UPDATESQL1 = sprintf("UPDATE PatientInfo SET   Sex=%s, Age=%s, KorName=%s, dateOfBirth=%s, CurrentStatus=%s, NextStatus=%s, PatientStatus=%s, ManualEdit=%s WHERE Hospital_ID='$ID_'",
                       ($_POST['txt_search_sex']),
                       ($_POST['txt_age']),
                       ($_POST['txt_name']),
                       ($_POST['txt_birth']),
                       ($_POST['CurrentStatus_menu']),
                       ($_POST['NextStatus_menu']),
                       ($_POST['txt_pStatus']),
                       ($_POST['Manual'])                 	     
                       );
    
    $UPDATESQL2 = sprintf("UPDATE TreatmentInfo SET   Clinic=%s, diagnosis=%s, purpose=%s, CurrentStatus=%s, px=%s, wbc=%s, ast=%s, primarysite=%s, subsite = %s, subsiteDet = %s, pathol=%s, grade=%s, stage=%s, tnm=%s, physician =%s,planner =%s, dose_sum='$All_Dose', Fx_sum = '$All_Fx' WHERE Hospital_ID='$ID_'",
                       ($_POST['txt_clinic']),
                       ($_POST['txt_doctor']),
                       ($_POST['purpose_menu']),
                       ($_POST['CurrentStatus_menu']),
                       
                       ($_POST['txt_px']),
                       ($_POST['txt_wbc']),
                       ($_POST['txt_ast']),
                       ($_POST['primary_menu']),
                       ($_POST['sub_site']),
                       ($_POST['sub_siteDet']),
                       ($_POST['pathology_menu']),
                       ($_POST['grade_menu']),
                       ($_POST['stage_menu']),
                       ($_POST['txt_tnmstage']),
					   ($_POST['txt_physician']),
					   ($_POST['txt_planner']));
					   					   
	
    $Result1 = mysqli_query($test, $UPDATESQL);
    $Result2 = mysqli_query($test, $UPDATESQL1);
    $Result3 = mysqli_query($test, $UPDATESQL2);

    

	$planStat = $_POST['StatusCheck'];;
    for($iPlan =0; $iPlan<$Plan; $iPlan++){
	    $checkerPlan = trim($planStat[$iPlan]);
	    
		$tCounter = $iPlan+1;
			$TsI = "0";
			$PsI = "0";
			$AsI = "0";				

		if(strcmp($checkerPlan,"T")==0){
			$TsI = "1";
			$PsI = "0";
			$AsI = "0";				
			
		}
		if(strcmp($checkerPlan,"P")==0){
			$TsI = "1";
			$PsI = "1";
			$AsI = "0";				
			
		}
		if(strcmp($checkerPlan,"A")==0){
			$TsI = "1";
			$PsI = "1";
			$AsI = "1";		
	
			
		}
		$tName = "T".$tCounter;
		$pName = "P".$tCounter;
		$aName = "A".$tCounter;				
		$UPDATESQL = "UPDATE TreatmentInfo SET  $tName='$TsI', $pName='$PsI', $aName='$AsI' WHERE Hospital_ID='$ID_'";

		$Result1 = mysqli_query($test, $UPDATESQL);


    }


// Auto calculate dates....
    $Start_Date_Null = $Start_Date[0];

    $Start_Date[0] = date('n/j/y',strtotime($Start_[0]));
	$Q_idx = 0;
	$startend="";
	$simstart="";
    for($i = 0; $i < $Plan; $i++){ 	     
	    $idx_ = $i+1;                 
		$Q_RT_start = "RT_start"."$idx_";
		$Q_dose = "dose"."$idx_";
		$Q_Fx = "Fx"."$idx_";
		$Q_Linac = "Linac"."$idx_";
		$Q_method = "RT_method"."$idx_";
		$Q_CT = "CT_Sim"."$idx_";
		$Q_CTTime = "CT_Time"."$idx_";		
		$Q_CTCe = "CT_Ce"."$idx_";				
		$Q_Finish = "RT_fin"."$idx_";
		$Q_Delay = "Delay_idx"."$idx_";
		$Q_Site = "Site"."$idx_";
	
		$Total_Delay = $Fx_[$i] + $Delay_[$i];
		$Start_Date_ = $Start_Date[$i];
		
		
		//RT_FINISH
   		$c=1;
   		while($c<$Total_Delay){   
	    	$Start_Date_ = date('n/j/y',strtotime($Start_Date_."+1 day"));			
	    	$val = array_search($Start_Date_, $holiday);
			$yoil = date('w', strtotime($Start_Date_));	    
			if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
		}
		


		$Finish_Date[$i] = $Start_Date_;
		if (strcmp($Fx_[$i], '0')==0){
			$Start_Date[$i] = $Start_[$i];
			$Finish_Date[$i] = $Finish_Date[$i-1];
			$Finish_[$i] = $Finish_[$i-1];
		}

		
		//CT_SIM
		if($i<2){
			$Start_CT_ = $Start_Date[$i];
			$c=1;		
			while($c<3){
	    		$Start_CT_ = date('n/j/y',strtotime($Start_CT_."-1 day"));
				$val = array_search($Start_CT_, $holiday);
				$yoil = date('w', strtotime($Start_CT_));
	    
				if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
    		}
			$Start_CT[$i] = $Start_CT_;
    	}
    	
    	if(!$CT_[$i]){
	    	$Start_CT[$i] = NULL;
    	}
    	if($CT_[$i]!=$Start_CT[$i]){
	    	$Start_CT[$i] = $CT_[$i];
    	}
    	
    	//NEXT RT_START
    	$c=1;
    	$Finish_Date_ = $Finish_Date[$i];
		while($c<2){
			$Finish_Date_ = date('n/j/y',strtotime($Finish_Date_."+1 day"));
			$val = array_search($Finish_Date_, $holiday);
	   		$yoil = date('w', strtotime($Finish_Date_));
	    
			if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
	    
		}
		$Start_Date[$i+1] = $Finish_Date_;
		
    	
    	
		if(strlen($Ce_[$i])>1){
			$CEupdate = "$Q_CTCe = '$Ce_[$i]',";
		}
		else{
			$CEupdate = "";
		}
		
		
		$CTCurs = "CT_Sim".($i+1);

		$CTChecker = sprintf("Select %s from TreatmentInfo where Hospital_ID like  %s", $CTCurs, ($_POST['H_ID']));
		$PrevCT = mysqli_query($test, $CTChecker) or die(mysqli_error());
		$row_PrevCT = mysqli_fetch_assoc($PrevCT);


		
		if(($Order_[$i])>0){
			$Timeupdate = " $Q_CTTime = '$Order_[$i]',";
		}
		else{
			$Timeupdate = "";
		}
		
		if(strcmp($row_PrevCT[$CTCurs],$CT_[$i])!=0){
			$Timeupdate = " $Q_CTTime = '0',";
		}
		


// 		업데이트! Manual을 선택하면 자동 계산되는 파트가 무시됨
		if(strcmp($row_editinfo[ManualEdit],"1")==0){
// 			echo("Manual!!");
			if(strtotime($Start_[$i])<strtotime("1/1/00")){
				$Start_Date[$i] = "";
			}
			if(strtotime($Start_[$i])<strtotime("1/1/00")){
				$Finish_Date[$i] = "";
			}
			
 		$UPDATESQL3 = sprintf(
 			"UPDATE TreatmentInfo SET $Q_RT_start = '$Start_[$i]', RT_start_f = '$Start_[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]',  $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$CT_[$i]', CT_Sim_f = '$CT_[$i]', $Q_Finish = '$Finish_[$i]', RT_fin_f = '$Finish_[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', $Q_Delay='$Delay_[$i]', $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");

 		
 		

		if (strcmp($row_RecordsetTelegram[$Q_RT_start], $Start_[$i])!=0 or strcmp($row_RecordsetTelegram[$Q_Finish],$Finish_[$i])!=0 or $row_RecordsetTelegram[idx]<$idx_){
			
			if(strlen($startend)<1){
			$startend = $idx_;
			}
			else{
			$startend=$startend.",".$idx_;				
			}
			
		}
		if (strcmp($row_RecordsetTelegram[$Q_CT],$CT_[$i])!=0 or $row_RecordsetTelegram[idx]<$idx_){
			if(strlen($simstart)<1){
			$simstart = $idx_;
			}
			else{
			$simstart=$simstart.",".$idx_;				
			}
			
		}


 		}
 		else{
	 		
	 		if(strtotime($Start_Date[$i])<strtotime("1/1/00")){
				$Start_Date[$i] = "";
			}
			if(strtotime($Finish_Date[$i])<strtotime("1/1/00")){
				$Finish_Date[$i] = "";
			}

	 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '$Start_Date[$i]', RT_start_f = '$Start_Date[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]',  $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$Start_CT[$i]', CT_Sim_f = '$Start_CT[$i]', $Q_Finish = '$Finish_Date[$i]', RT_fin_f = '$Finish_Date[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', $Q_Delay='$Delay_[$i]', $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");
	 	
		if (strcmp($row_RecordsetTelegram[$Q_RT_start], $Start_Date[$i])!=0 or strcmp($row_RecordsetTelegram[$Q_Finish],$Finish_Date[$i])!=0 or $row_RecordsetTelegram[idx]<$idx_){
			$tm = 0;
			if(strcmp($row_RecordsetTelegram[$Q_RT_start], $Start_Date[$i])!=0){ 
				$preD = substr($row_RecordsetTelegram[$Q_RT_start],0,strlen($row_RecordsetTelegram[$Q_RT_start])-3);
				$postD = substr($Start_Date[$i],0,strlen($Start_Date[$i])-3);
				$marker = "시작";
				$tm = 1;
			}
			if(strcmp($row_RecordsetTelegram[$Q_Finish],$Finish_Date[$i])!=0){
				$preD = substr($row_RecordsetTelegram[$Q_Finish],0,strlen($row_RecordsetTelegram[$Q_Finish])-3);
				$postD = substr($Finish_Date[$i],0,strlen($Finish_Date[$i])-3);
				$marker = "종결";
				if($tm==1){
					$marker = "시작/종결";
				}				
			}
			
			if(strlen($startend)<1){
			$startend = $idx_."번".$marker."(".$preD."->".$postD.")";
			}
			else{
			$startend=$startend.", ".$idx_."번".$marker."(".$preD."->".$postD.")";				
			}

		}
		if (strcmp($row_RecordsetTelegram[$Q_CT],$Start_CT[$i])!=0 or $row_RecordsetTelegram[idx]<$idx_){
			$preD = substr($row_RecordsetTelegram[$Q_CT],0,strlen($row_RecordsetTelegram[$Q_CT])-3);
			$postD = substr($Start_CT[$i],0,strlen($Start_CT[$i])-3);

			if(strlen($simstart)<1){
			$simstart = $idx_."번(".$preD."->".$postD.")";
			}
			else{
			$simstart=$simstart.", ".$idx_."번(".$preD."->".$postD.") ";				
			}
			
		}

 		}

	

		//echo $UPDATESQL3;
		$UPDATE_Result3 = mysqli_query($test, $UPDATESQL3);
		if($UPDATE_Result3 == TRUE){
				$Q_idx = $Q_idx + 1;
		}
			
	}
	
	
// 		echo($simstart);
		if(strlen($startend)>0){ 
			$titleStart = $startend." , ";
		}
		else{
			$titleStart = "";
		}
		if(strlen($simstart)>0){ 
			$titleSim = $simstart." 시뮬레이션 ";
		}
		else{
			$titleSim = "";
		}
		$titleSum = $titleStart.$titleSim;
// 		echo($titleSum);

		$Dates = Date("n/j/y");    



		if(strlen($statChange)>0){
			$post_title = "$row_RecordsetTelegram[Hospital_ID]($row_RecordsetTelegram[FirstName] $row_RecordsetTelegram[SecondName] $row_RecordsetTelegram[KorName])의 상태변경 ".$statChange."($uid)";
			$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
			if(strcmp($row_RecordsetTelegram[physician],'myki')==0){$curlPhy ="Ki"; $chatId = "@rodbki";}
			if(strcmp($row_RecordsetTelegram[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhro";}
			if(strcmp($row_RecordsetTelegram[physician],'mjlee')==0){$curlPhy ="JaL";$chatId = "@rodbjal";}
			if(strcmp($row_RecordsetTelegram[physician],'mhlee')==0){$curlPhy ="JuL";$chatId = "@pnuyhrojul";}
			if(strcmp($row_RecordsetTelegram[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhrojul";}
			$telegram_text = "{$post_title}";
			$query_array = array(
			    'chat_id' => $chatId,
			    'text' => $telegram_text,
			);
			$request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?" . http_build_query($query_array);
			$curl_opt = array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $request_url,
			);
/*
			$curl = curl_init($request_url);
			echo("<font color=#FFFFFF size='1px'> ");	
			$resCurl = curl_exec($curl);
			echo("</font>");	
*/
/*
			$logquery = "insert into Log (date1, content, author, Hospital_ID) values('$Dates', '$post_title', '$uid', '$row_RecordsetTelegram[Hospital_ID]')";
			mysqli_query($test, $logquery);
*/
			
		}



		if(strlen($titleSum)>0){
			$post_title = "$row_RecordsetTelegram[Hospital_ID]($row_RecordsetTelegram[FirstName] $row_RecordsetTelegram[SecondName] $row_RecordsetTelegram[KorName])의 ". $titleSum. "일정 추가/변경($uid)";

			$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
			if(strcmp($row_RecordsetTelegram[physician],'myki')==0){$curlPhy ="Ki"; $chatId = "@rodbki";}
			if(strcmp($row_RecordsetTelegram[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhro";}
			if(strcmp($row_RecordsetTelegram[physician],'mjlee')==0){$curlPhy ="JaL";$chatId = "@rodbjal";}
			if(strcmp($row_RecordsetTelegram[physician],'mhlee')==0){$curlPhy ="JuL";$chatId = "@pnuyhrojul";}
			if(strcmp($row_RecordsetTelegram[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhrojul";}
			$telegram_text = "{$post_title}";
			$query_array = array(
			    'chat_id' => $chatId,
			    'text' => $telegram_text,
			);
			$request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?" . http_build_query($query_array);
			$curl_opt = array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $request_url,
			);
/*
			$curl = curl_init($request_url);
			echo("<font color=#FFFFFF size='1px'> ");	
			$resCurl = curl_exec($curl);
			echo("</font>");	
*/

/*
			$logquery = "insert into Log (date1, content, author, Hospital_ID) values('$Dates', '$post_title', '$uid', '$row_RecordsetTelegram[Hospital_ID]')";
			
			mysqli_query($test, $logquery);
*/
			
// 		echo($logquery);
					
			
		}
		
	
	
	$tVals = $idx_;
    for($i = $tVals; $i < 8; $i++){ 	     
	    $idx_ = $i+1;
		$Q_RT_start = "RT_start"."$idx_";
		$Q_dose = "dose"."$idx_";
		$Q_Fx = "Fx"."$idx_";
		$Q_Linac = "Linac"."$idx_";
		$Q_method = "RT_method"."$idx_";
		$Q_CT = "CT_Sim"."$idx_";
		$Q_CTTime = "CT_Time"."$idx_";		
		$Q_CTCe = "CT_Ce"."$idx_";				
		$Q_Finish = "RT_fin"."$idx_";
		$Q_Delay = "Delay_idx"."$idx_";
		$Q_Site = "Site"."$idx_";
	
		$Total_Delay = $Fx_[$i] + $Delay_[$i];
		$Start_Date_ = $Start_Date[$i];
		
		
		//RT_FINISH
   		$c=1;
   		while($c<$Total_Delay){   
	    	$Start_Date_ = date('n/j/y',strtotime($Start_Date_."+1 day"));			
	    	$val = array_search($Start_Date_, $holiday);
			$yoil = date('w', strtotime($Start_Date_));	    
			if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
		}
		
		$Finish_Date[$i] = $Start_Date_;
		//CT_SIM
		if($i<2){
			$Start_CT_ = $Start_Date[$i];
			$c=1;		
			while($c<3){
	    		$Start_CT_ = date('n/j/y',strtotime($Start_CT_."-1 day"));
				$val = array_search($Start_CT_, $holiday);
				$yoil = date('w', strtotime($Start_CT_));
	    
				if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
    		}
			$Start_CT[$i] = $Start_CT_;
    	}
    	
    	if(!$CT_[$i]){
	    	$Start_CT[$i] = NULL;
    	}
    	if($CT_[$i]!=$Start_CT[$i]){
	    	$Start_CT[$i] = $CT_[$i];
    	}
    	//NEXT RT_START
    	$c=1;
    	$Finish_Date_ = $Finish_Date[$i];
		while($c<2){
			$Finish_Date_ = date('n/j/y',strtotime($Finish_Date_."+1 day"));
			$val = array_search($Finish_Date_, $holiday);
	   		$yoil = date('w', strtotime($Finish_Date_));
	    
			if($val != TRUE && $yoil != '6' && $yoil !='0'){$c++;}
	    
		}
		$Start_Date[$i+1] = $Finish_Date_;
		
    	
    	
		if(strlen($Ce_[$i])>1){
			$CEupdate = "$Q_CTCe = '$Ce_[$i]',";
		}
		else{
			$CEupdate = "";
		}
				
		if(($Order_[$i])>1){
			$Timeupdate = " $Q_CTTime = '$Order_[$i]',";
		}
		else{
			$Timeupdate = "";
		}
		
	 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '', $Q_dose = '', $Q_Fx = '', $Q_method = '', $Q_CT = '', $Q_Finish = '', $Q_Linac = '', $Q_Delay='', $Q_Site=''  WHERE Hospital_ID = '$ID_'");
		$UPDATE_Result3 = mysqli_query($test, $UPDATESQL3);

/*
		echo($UPDATESQL3);
		echo("<br>");
*/

			
	}






	
	$Meet = $_POST['Meet'];
	$MeetDate = $_POST['MeetDate'];
	$M_Plan = count($Meet);
	//echo $M_Plan;
	

	if (strcmp($uid, "Nurse")==0 or strcmp($uid, "nurse")==0 or strcmp($uid, "NURSE")==0){
	$M_idx = 0;
	$deleteMeetingDate = sprintf("DELETE FROM MeetingList WHERE Hospital_ID = '$ID_'");
	mysqli_query($test, $deleteMeetingDate);
	for($j = 1; $j<=$M_Plan; $j++){
		$jj = $j-1;
		$insertMeeting = sprintf("INSERT INTO MeetingList (Hospital_ID, Memo, Date, idx) VALUES ('$ID_', '$Meet[$jj]', %s, $j)", ($MeetDate[$jj] ));
		//echo $insertComment;
		$insertQuery = mysqli_query($test, $insertMeeting);
		if($insertQuery == TRUE){
			$M_idx = $M_idx + 1;
		}
	}
	}


                      
  $Comment = $_POST['Comment'];
	$CommentDate = $_POST['CommentDate'];

  // 저장하기 위해 comment의 날짜를 불러와서 포맷을 변경한다.
  // Y-m-d에서 n/j/y로 

  for($idss=0;$idss<count($CommentDate); $idss++){
    if(strlen($CommentDate[$idss])>1){ 
        $myDateTime = DateTime::createFromFormat('y/n/j', $CommentDate[$idss]);
        $newDateString = $myDateTime->format('n/j/y');

        $CommentDate[$idss] =  $newDateString;
        echo "$CommentDate[$idss]";
    }
  }

























	$C_Plan = count($Comment);
	$C_idx = 0;
	$deleteComment = sprintf("DELETE FROM MemoTemp WHERE Hospital_ID = '$ID_'");
	mysqli_query($test, $deleteComment);
	for($j = 1; $j<=$C_Plan; $j++){
		$jj = $j-1;
		$insertComment = sprintf("INSERT INTO MemoTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$Comment[$jj]', %s, $j)", ($CommentDate[$jj] ));

		echo $insertComment."<br>";
		$insertQuery = mysqli_query($test, $insertComment);
		if($insertQuery == TRUE){
			$C_idx = $C_idx + 1;
		}
	}

  	$Order = $_POST['Order'];
	$OrderDate = $_POST['OrderDate'];
  for($idss=0;$idss<count($OrderDate); $idss++){
    if(strlen($OrderDate[$idss])>1){ 
        $myDateTime = DateTime::createFromFormat('y/n/j', $OrderDate[$idss]);
        $newDateString = $myDateTime->format('n/j/y');

        $OrderDate[$idss] =  $newDateString;
    }
  }






	$C_Order = count($Order);
	$C_idxOrder = 0;
	$deleteOrder = sprintf("DELETE FROM OrderTemp WHERE Hospital_ID = '$ID_'");
	mysqli_query($test, $deleteOrder);

	$query_numOrder = sprintf("SELECT NumOrder FROM TreatmentInfo where Hospital_ID like '%s'", $_POST['H_ID']);
	
// 	echo($query_Telegram);
	$RecordsetNumOrder = mysqli_query($test, $query_numOrder) or die(mysqli_error());
	$numOrder       = mysqli_fetch_assoc($RecordsetNumOrder);

	for($j = 1; $j<=$C_Order; $j++){
		$query_numOrder = sprintf("Update TreatmentInfo Set NumOrder = '$C_Order' where Hospital_ID like '%s'", $_POST['H_ID']);
		mysqli_query($test, $query_numOrder);
		
		$jj = $j-1;
		$insertOrder = sprintf("INSERT INTO OrderTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$Order[$jj]', %s, $j)", ($OrderDate[$jj] ));
		$insertQuery = mysqli_query($test, $insertOrder);
		if($insertQuery == TRUE){
			$C_idxOrder = $C_idxOrder + 1;
		}
	}

	if (strcmp($numOrder[NumOrder],$C_Order)!=0){
// 		Change TCRNOTICE to 1 if MD's Order was added. To appear in Top of the RTP page (Action required)
		mysqli_query($test, "Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $ID_");
		
	}
	
	$ii=0;  	
	mysqli_select_db($database_test);	
	$Today_Date = Date("n/j/y");    
	
	if(strcmp(($_POST['txt_Category']),"Surgery")==0 or strcmp(($_POST['txt_Category']),"Chemotherapy")==0 or strcmp(($_POST['txt_Category']),"Previous history")==0 or strcmp(($_POST['txt_Category']),"Pathology")==0 or strcmp(($_POST['txt_Category']),"Tumor markers & other specific lab findings")==0 or strcmp(($_POST['txt_Category']),"Radiologic findings")==0){			   

	}
}





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
$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = %s", ($colname_Hospital_ID));
$clinicalinfo = mysqli_query($test, $query_clinicalinfo) or die(mysqli_error());
$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);

mysqli_select_db($database_test);
$query_patientinfo = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = %s", ($colname_Hospital_ID));
$patientinfo = mysqli_query($test, $query_patientinfo) or die(mysqli_error());
$row_patientinfo = mysqli_fetch_assoc($patientinfo);
$totalRows_patientinfo = mysqli_num_rows($patientinfo);

mysqli_select_db($database_test);
$query_treatmentinfo = sprintf("SELECT * FROM TreatmentInfo WHERE Hospital_ID = %s", ($colname_Hospital_ID));
$treatmentinfo = mysqli_query($test, $query_treatmentinfo) or die(mysqli_error());
$row_treatmentinfo = mysqli_fetch_assoc($treatmentinfo);
$totalRows_treatmentinfo = mysqli_num_rows($treatmentinfo);

$query_TempMemo = sprintf("SELECT * FROM MemoTemp WHERE Hospital_ID = %s", ($colname_Hospital_ID));
$MemoInfo = mysqli_query($test, $query_TempMemo) or die(mysqli_error());
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

$query_TempOrder = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = %s", ($colname_Hospital_ID));
$OrderInfo = mysqli_query($test, $query_TempOrder) or die(mysqli_error());
$row_Orderinfo = mysqli_fetch_assoc($OrderInfo);
$total_Orderinfo = mysqli_num_rows($OrderInfo);





?>

<!-- Attachment -->



<?php
	
$query_Telegram = "select * from TreatmentInfo where Hospital_ID =".$row_patientinfo['Hospital_ID'];
// 	echo($query_Telegram);
$RecordsetTelegram = mysqli_query($test, $query_Telegram) or die(mysqli_error());
$row_RecordsetTelegram       = mysqli_fetch_assoc($RecordsetTelegram);

for ($statId=0;$statId<$row_RecordsetTelegram[idx];$statId++){
	$statsId = $statId+1;
	$Ts = "T".$statsId;
	$Ps = "P".$statsId;
	$As = "A".$statsId;
	$statMarker[$statId] = "N";
	if(strcmp($row_RecordsetTelegram[$Ts],"1")==0){ 
		$statMarker[$statId] = "T";
	}
	if(strcmp($row_RecordsetTelegram[$Ps],"1")==0){ 
		$statMarker[$statId] = "P";
	}
	if(strcmp($row_RecordsetTelegram[$As],"1")==0){ 
		$statMarker[$statId] = "A";
	}
}
	
	
?>












	    <?php
      for($iddrsel=0;$iddrsel<$numphyss;$iddrsel++){
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
	  	<div style="padding: 5px; width: 200px">

  	<table class = "type03" width="200px" border="1"  align="left">
	  	<tr>		
		  	<td align="center">
		  	<img  src=<?php echo $photoPath; ?> width="130px">			
			</td>
	  	</tr>
  	</table>
  	
  	<table class = "type03" width="200px" border="1"  align="left">
	  	<tr>
		  	<td  align="center">
			  	<strong><font size="2"><?php echo($toda); ?></font></strong>
			  	<strong><font size="2">
			  	<?php if(intval($nowa)==1){ echo("");}
			  			else{echo("");}
			  	?>
			  	<?php
				  	$curs = "Linac".$nowa;
				  	echo($row_treatmentinfo[$curs]);
				  	$curs = "RT_method".$nowa;
				  	echo("/".substr(trim($row_treatmentinfo[$curs]),0,2));
				  	
				  	?>
			  	</font></strong>

		  	</td>
	  	</tr>
	<tr>
		<td align="center" width="150px">
			<strong><font size="2"><?php echo $row_patientinfo['Hospital_ID']; ?></font><strong>				
			<strong><font size="2"><?php echo $row_patientinfo['KorName']; ?></font></strong>        
			<strong>(<font size="2"><?php echo $row_patientinfo['Sex']; ?></font>/</strong>        
			<strong><font size="2"><?php echo $row_patientinfo['Age']; ?></font>)</strong>        
			<br>
			<font size="1"><?php echo $row_treatmentinfo['primarysite']; ?></font>
			<font size="1"><?php echo $row_treatmentinfo['subsite']; ?></font><br>
			
		</td>
		
	</tr>
	</table>
	
  	<table class = "type03" width="200px" border="1"  align="left">
				  			<?php
		  			$fxDose = (float)$row_treatmentinfo['dose_sum']/(float)$row_treatmentinfo['Fx_sum'];
		  			$fxDoseStr = sprintf("%.2f", $fxDose);		  			
		  		?>
	  			
	  				  			<?php
		  		$cropN = 100;
		  			if(intval($nowa)<3){ 
					for($planIdx=intval($nowa);$planIdx<intval($nowa)+2;$planIdx++){
						$bgst = "";
						$bged = "";						

						$ftst = "";
						$fted = "";						
						
						if(intval($nowa)==$planIdx){ 
							$bgst = "bgcolor=#000000";
							$bged = "</span>";						
	
							$ftst = "<font color = white>";
							$fted = "</font>";						
						}
						$SiteX       = "Site" . "$planIdx";
						$SiteX=(substr($row_treatmentinfo[$SiteX],0,$cropN));
						
						if(strlen($SiteX)==0){
							$SiteX = "N/A";
						}
						$doseX     = "dose" . "$planIdx";
						$fxX       = "Fx" . "$planIdx";
						
					
					}
					}
					else{
					for($planIdx=intval($nowa);$planIdx<intval($nowa)+2;$planIdx++){
						$bgst = "";
						$bged = "";						

						$ftst = "";
						$fted = "";						
						
						if(intval($nowa)==$planIdx){ 
							$bgst = "bgcolor=#000000";
							$bged = "</span>";						
	
							$ftst = "<font color = white>";
							$fted = "</font>";						
						}
						$SiteX       = "Site" . "$planIdx";
						$SiteX=(substr($row_treatmentinfo[$SiteX],0,$cropN));
						
						if(strlen($SiteX)==0){
							$SiteX = "N/A";
						}
						$doseX     = "dose" . "$planIdx";
						$fxX       = "Fx" . "$planIdx";
								
					
					}
						
						
						
						
					}
		  		?>

<!-- 	</table> -->

<!-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> -->
<script src="js/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/jquery-barcode.js"></script>





	<?php
		$nquery = "Select * from PlannerNote where Hospital_ID like '$row_patientinfo[Hospital_ID]' and PlanNo = $nowa";
		$notes = mysqli_fetch_assoc(mysqli_query($test, $nquery));
	?>

<!-- 	<br> <font size=0.1>&nbsp;</font> -->
<!--   	<table class = "type03" width="200px" border="1"  align="left"> -->

<tr>
	<td colspan=2>
	</td>
</tr>
<tr>
	<td colspan=2>
		<?php
// 			echo($nquery);
			$a=floatval($notes[cx]);
			echo ("<font size='1'>X: ".sprintf("%2.2f" ,$a));
			echo(" cm, ");
			$a=floatval($notes[cy]);
			echo ("Y: ".sprintf("%2.2f" ,$a));
			echo(" cm, ");
			$a=floatval($notes[cz]);
			echo ("Z: ".sprintf("%2.2f" ,$a)." cm</font>");
		?>
		
		<?php
			if(strlen($notes[Bolus])>0){
				echo(' ('.$notes[Bolus].')');
			}
		?>

	</td>
</tr>	

<!--
<tr  >
	<td  colspan=2 colspan=2>
		<?php
			echo("<font size='1'>".nl2br($notes[PlanNote])."</font>");
		?>

	</td>
</tr>
-->
  	<tr>
	  	<td colspan=2 align="center">
		 <div id="bcTarget"></div>

		 </td>
  	</tr>

	  	
  	</table>
  	
  	</td>
  	</tr>
  	</table>
  		  	</div>


</body>

<script type="text/javascript">
    $("#bcTarget").barcode("<?php echo $row_patientinfo['Hospital_ID']; ?>", "codabar", {barWidth:1, barHeight:30});
</script>



<script language="javascript" type="text/javascript">
  
window.print(); setTimeout("window.close();", 500);
</script>
