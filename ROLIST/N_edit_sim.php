<!doctype html>
<meta charset="utf-8">
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


$permitUser = $_POST['permit'];
$datePick = $_POST['datePick'];



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
		mysql_select_db($database_test, $test);
     
	}
	else{
 		$MM_restrictGoTo = "testphpr2.php";
 		header("Location: ". $MM_restrictGoTo); 
 		require_once('Connections/test.php'); 
 		mysql_select_db($database_test, $test);
     

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

 <script>
      $( document ).ready( function() {
        var jbOffset = $( '.jbMenu' ).offset();
        $( window ).scroll( function() {
          if ( $( document ).scrollTop() > jbOffset.top ) {
            $( '.jbMenu' ).addClass( 'jbFixed' );
          }
          else {
            $( '.jbMenu' ).removeClass( 'jbFixed' );
          }
        });
      } );
    </script>

<script>
      
      $( document ).ready( function() {
        var jbOffset = $( '.jbMenuBlank' ).offset();
        $( window ).scroll( function() {
          if ( $( document ).scrollTop() > jbOffset.top ) {
            $( '.jbMenuBlank' ).addClass( 'jbFixedBlank' );
          }
          else {
            $( '.jbMenuBlank' ).removeClass( 'jbFixedBlank' );
          }
        });
      } );
	
	</script>
	
	<title>RO Editor, Desk</title>

<style type="text/css">
table.type03 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid #365;
	margin : 5px 5px;
/* 	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
}
table.type03 th {
/*     width: 147px; */
    padding: 10px;
/*     font-weight: bold; */
    vertical-align: middle;
    color: #153d73;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type03 td {
/*     width: 349px; */
    padding: 10px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

.bxShadow {
	background-color: white;
	padding: 0px 0px;
	width: 980px;
	 box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }

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
	
.jbTitle {
text-align: center;
}
.jbMenu {
	text-align: center;
	background-color: white;
	padding: 0px 0px;
	width: 980px;
	 box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }

}
.jbMenuBlank {
	width: 970px;

}
.jbContent {
height: 2000px;
}
.jbFixed {
position: fixed;
top: 0px;
}
.jbFixedBlank {
/* position: fixed; */

height: 150px;
top: 50px;
}
	
	
	
.table.type1 {
	border-collapse: collapse;
    width: 960px;
}
.type1 th, type1 td {	
	white-space:nowrap;
	padding: 0px;
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
  resize: none; /* 사용자 임의 변경 불가 */

}	  	  
tr.border_bottom td {
  border-bottom:1pt solid black;
}
table.type05 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(117, 154, 240, 0.98); /* red 50 (ibm design colors) */
	margin : 20px 10px;
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


  </style>
  



</head>


<body>
<!-- Body starts here!!! -->


<?php require_once('Connections/test.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");


// 
// 
// 
// 


// 시간 스케쥴러 계산을 위한 변수 불러오기(input 박스에서 불러오는 변수)
$datetime = $_POST['datetime'];
$datetimeend = $_POST['hf_fin'];
$spctime = $_POST['spctime'];
$durtime = $_POST['durtime'];
$ontime = $_POST['ontime'];



if (strlen($datetime)>2 and strlen($datetimeend)>2){ 

$datetime = substr($datetime,0,strlen($datetime)-1);
$datetime = date("n/j/y", strtotime($datetime));
$datetimeend = date("n/j/y", strtotime($datetimeend."+1 day"));
$idH = $_POST['hf_edit'];
$fDate = $datetime;
$dateSum = 0;
if(strcmp($ontime,"1")==0){ 
	while(strcmp($fDate,$datetimeend)!=0){
		$fDate = date("n/j/y", strtotime($datetime."+".$dateSum." day"));
	
		$dateSum = $dateSum+1;
		
		$queryTimer = "SELECT * FROM Timer where Hospital_ID like '$idH' and date1 like '$fDate'" ;	
	// 	echo($queryTimer);
		
		$Timers = mysql_query($queryTimer, $test) or die(mysql_error());
		$Timers = mysql_num_rows($Timers);
		
		if($Timers==0){
			$queries = "insert into Timer (Hospital_ID, date1, time1, Duration) values ('$idH', '$fDate', '$spctime', '$durtime')";
			echo($queries);
			mysql_query($queries);
		}
		else{
			$queries = "update Timer set time1='$spctime', Duration='$durtime' where  (Hospital_ID like '$idH' and date1 like '$fDate')";
			echo($queries);
			mysql_query($queries);
		}
		
		
		
		
	}
}
else{
	
	$fDate = date("n/j/y", strtotime($datetime));

	$dateSum = $dateSum+1;
	
	$queryTimer = "SELECT * FROM Timer where Hospital_ID like '$idH' and date1 like '$fDate'" ;	
	
	$Timers = mysql_query($queryTimer, $test) or die(mysql_error());
	$Timers = mysql_num_rows($Timers);
	
	if($Timers==0){
		$queries = "insert into Timer (Hospital_ID, date1, time1, Duration) values ('$idH', '$fDate', '$spctime', '$durtime')";
		mysql_query($queries);
	}
	else{
		$queries = "update Timer set time1='$spctime', Duration='$durtime' where  (Hospital_ID like '$idH' and date1 like '$fDate')";
		mysql_query($queries);
	}
		
		
		
		
	
	
	
	
	
	
	
	
	
	
	
}

}










//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////// U P D A T E //////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////



// Delay 구현 하는 부붙....
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  	$h_result = sprintf("select idx from TreatmentInfo where Hospital_ID = %s", GetSQLValueString($_POST['txt_hospital_id'],"text"));
  	$h_result = mysql_query($h_result);		
  	$h_idx = mysql_result($h_result,0,"idx");
  	$ID_ = $_POST['H_ID'];


$UPDATESQLManual = sprintf("UPDATE PatientInfo SET ManualEdit=%s WHERE Hospital_ID='$ID_'",GetSQLValueString($_POST['Manual'],"text"));

mysql_query($UPDATESQLManual);


$UPDATESQL = sprintf("UPDATE TreatmentInfo SET Hospital_ID=%s, Modality_var1=%s WHERE Hospital_ID='$ID_'",
                       GetSQLValueString($_POST['txt_hospital_id'], "text"),
                       GetSQLValueString($_POST['txt_modality'], "text"));
        $Result1 = mysql_query($UPDATESQL);


mysql_select_db($database_test, $test);
$query_manualEdit = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = %s", GetSQLValueString($_POST['txt_hospital_id'],"text"));
$editinfo = mysql_query($query_manualEdit, $test) or die(mysql_error());
$row_editinfo = mysql_fetch_assoc($editinfo);
$UPDATESQL = sprintf("UPDATE PatientInfo SET TimeTD=%s WHERE Hospital_ID like '$ID_'",
                       GetSQLValueString($_POST['txt_reservation'], "text"));
        $Result1 = mysql_query($UPDATESQL);
echo($UPDATESQL);


// echo($UPDATESQLManual);





  	$manuals = $_POST['Manual'];



  	$Method_ = $_POST['Method'];
  	$Linac_ = $_POST['Linac'];
  	$Site_ = $_POST['Site'];
		
  	$Dose_ = $_POST['Dose'];
	$Fx_ = $_POST['Fx'];
	$Order_ = $_POST['CTOrder'];
	$Ce_ = $_POST['Ce'];
		
	$Start_ = $_POST['Start'];
	$CT_ = $_POST['CT'];
	$Finish_ = $_POST['Finish'];
	
	$Delay_ = $_POST['Delay'];
	for($iddelay = 0; $iddelay<count($Delay_);$iddelay++){
		if(strlen($Delay_[$iddelay])==0){
			$Delay_[$iddelay] = '0';
		}
	}
	
	for($iddelay = 0; $iddelay<count($Dose_);$iddelay++){
		if(strlen($Dose_[$iddelay])==0){
			$Dose_[$iddelay] = '0';
		}
	}
	for($iddelay = 0; $iddelay<count($Fx_);$iddelay++){
		if(strlen($Fx_[$iddelay])==0){
			$Fx_[$iddelay] = '0';
		}
	}
	
		
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
	$RecordsetTelegram = mysql_query($query_Telegram, $test) or die(mysql_error());
	$row_RecordsetTelegram       = mysql_fetch_assoc($RecordsetTelegram);
	if($row_RecordsetTelegram[CurrentStatus]!=GetSQLValueString($_POST['CurrentStatus_menu'],"int")){
		if(GetSQLValueString($_POST['CurrentStatus_menu'],"int")==0){
			$curStat = "Active";			
		}
		elseif(GetSQLValueString($_POST['CurrentStatus_menu'],"int")==1){
			$curStat = "Finish";					
		}
		elseif(GetSQLValueString($_POST['CurrentStatus_menu'],"int")==2){
			$curStat = "Stop";			
		}
		elseif(GetSQLValueString($_POST['CurrentStatus_menu'],"int")==3){
			$curStat = "Drop";			
		}
		elseif(GetSQLValueString($_POST['CurrentStatus_menu'],"int")==4){
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

		$CTChecker = sprintf("Select %s from TreatmentInfo where Hospital_ID like  %s", $CTCurs, GetSQLValueString($_POST['H_ID'],"text"));
		$PrevCT = mysql_query($CTChecker, $test) or die(mysql_error());
		$row_PrevCT = mysql_fetch_assoc($PrevCT);


		
		if(($Order_[$i])>0){
			$Timeupdate = " $Q_CTTime = '$Order_[$i]',";
		}
		else{
			$Timeupdate = "";
		}
/*
		if(($Order_[$i])==0){
			$Timeupdate = " $Q_CTTime = '$Order_[$i]',";
		}
		else{
			$Timeupdate = "";
		}
*/
		
		
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
 			"UPDATE TreatmentInfo SET $Q_RT_start = '$Start_[$i]', RT_start_f = '$Start_[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]', $Timeupdate $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$CT_[$i]', CT_Sim_f = '$CT_[$i]', $Q_Finish = '$Finish_[$i]', RT_fin_f = '$Finish_[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', $Q_Delay='$Delay_[$i]', $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");

 		
 		echo($UPDATESQL3);

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

	 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '$Start_Date[$i]', RT_start_f = '$Start_Date[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]', $Timeupdate $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$Start_CT[$i]', CT_Sim_f = '$Start_CT[$i]', $Q_Finish = '$Finish_Date[$i]', RT_fin_f = '$Finish_Date[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]', $Q_Delay='$Delay_[$i]', $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");
	 	 		echo($UPDATESQL3);

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
		$UPDATE_Result3 = mysql_query($UPDATESQL3);
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
			if(strcmp($row_RecordsetTelegram[physician],'myki')==0){$curlPhy ="KI"; $chatId = "@rodbki";}
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
			mysql_query($logquery);
*/
			
		}



		if(strlen($titleSum)>0){
			$post_title = "$row_RecordsetTelegram[Hospital_ID]($row_RecordsetTelegram[FirstName] $row_RecordsetTelegram[SecondName] $row_RecordsetTelegram[KorName])의 ". $titleSum. "일정 추가/변경($uid)";

			$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
			if(strcmp($row_RecordsetTelegram[physician],'myki')==0){$curlPhy ="KI"; $chatId = "@rodbki";}
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
			
			mysql_query($logquery);
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
		$UPDATE_Result3 = mysql_query($UPDATESQL3);

/*
		echo($UPDATESQL3);
		echo("<br>");
*/

			
	}





	


	
	$Meet = $_POST['Meet'];
	$MeetDate = $_POST['MeetDate'];
	$MeetTime = $_POST['MeetTime'];
	$M_Plan = count($Meet);
	//echo $M_Plan;
	
	$M_idx = 0;
	$deleteMeetingDate = sprintf("DELETE FROM MeetingList WHERE Hospital_ID = '$ID_'");
	mysql_query($deleteMeetingDate);
	for($j = 1; $j<=$M_Plan; $j++){
		$jj = $j-1;
		$insertMeeting = sprintf("INSERT INTO MeetingList (Hospital_ID, Memo, Date, Time1, idxMeet) VALUES ('$ID_', '$Meet[$jj]', %s, %s, $j)", GetSQLValueString($MeetDate[$jj] ,"text"), GetSQLValueString($MeetTime[$jj] ,"text"));
		//echo $insertComment;
		$insertQuery = mysql_query($insertMeeting, $test);
		if($insertQuery == TRUE){
			$M_idx = $M_idx + 1;
		}
	}

                      
  	$Comment = $_POST['Comment'];
	$CommentDate = $_POST['CommentDate'];
	$C_Plan = count($Comment);
	$C_idx = 0;
	$deleteComment = sprintf("DELETE FROM MemoTemp WHERE Hospital_ID = '$ID_'");
	mysql_query($deleteComment);
	for($j = 1; $j<=$C_Plan; $j++){
		$jj = $j-1;
		$insertComment = sprintf("INSERT INTO MemoTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$Comment[$jj]', %s, $j)", GetSQLValueString($CommentDate[$jj] ,"text"));
		//echo $insertComment;
		$insertQuery = mysql_query($insertComment, $test);
		if($insertQuery == TRUE){
			$C_idx = $C_idx + 1;
		}
	}

  	$Order = $_POST['Order'];
	$OrderDate = $_POST['OrderDate'];
	$C_Order = count($Order);
	$C_idxOrder = 0;
	$deleteOrder = sprintf("DELETE FROM OrderTemp WHERE Hospital_ID = '$ID_'");
	mysql_query($deleteOrder);
	for($j = 1; $j<=$C_Order; $j++){
		$jj = $j-1;
		$insertOrder = sprintf("INSERT INTO OrderTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$Order[$jj]', %s, $j)", GetSQLValueString($OrderDate[$jj] ,"text"));
		echo($insertOrder);
		//echo $insertComment;
		$insertQuery = mysql_query($insertOrder, $test);
		if($insertQuery == TRUE){
			$C_idxOrder = $C_idxOrder + 1;
		}
	}


	
	$ii=0;  	
	mysql_select_db($database_test, $test);	
	$Today_Date = Date("n/j/y");    
	
	if(strcmp(GetSQLValueString($_POST['txt_Category']),"Surgery")==0 or strcmp(GetSQLValueString($_POST['txt_Category']),"Chemotherapy")==0 or strcmp(GetSQLValueString($_POST['txt_Category']),"Previous history")==0 or strcmp(GetSQLValueString($_POST['txt_Category']),"Pathology")==0 or strcmp(GetSQLValueString($_POST['txt_Category']),"Tumor markers & other specific lab findings")==0 or strcmp(GetSQLValueString($_POST['txt_Category']),"Radiologic findings")==0){			   

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


mysql_select_db($database_test, $test);
$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = %s", GetSQLValueString($colname_Hospital_ID, "text"));
$clinicalinfo = mysql_query($query_clinicalinfo, $test) or die(mysql_error());
$row_clinicalinfo = mysql_fetch_assoc($clinicalinfo);
$totalRows_clinicalinfo = mysql_num_rows($clinicalinfo);

mysql_select_db($database_test, $test);
$query_patientinfo = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = %s", GetSQLValueString($colname_Hospital_ID, "text"));
$patientinfo = mysql_query($query_patientinfo, $test) or die(mysql_error());
$row_patientinfo = mysql_fetch_assoc($patientinfo);
$totalRows_patientinfo = mysql_num_rows($patientinfo);

mysql_select_db($database_test, $test);
$query_treatmentinfo = sprintf("SELECT * FROM TreatmentInfo WHERE Hospital_ID = %s", GetSQLValueString($colname_Hospital_ID, "text"));
$treatmentinfo = mysql_query($query_treatmentinfo, $test) or die(mysql_error());
$row_treatmentinfo = mysql_fetch_assoc($treatmentinfo);
$totalRows_treatmentinfo = mysql_num_rows($treatmentinfo);

$query_TempMemo = sprintf("SELECT * FROM MemoTemp WHERE Hospital_ID = %s", GetSQLValueString($colname_Hospital_ID, "text"));
$MemoInfo = mysql_query($query_TempMemo, $test) or die(mysql_error());
$row_Memoinfo = mysql_fetch_assoc($MemoInfo);
$total_Memoinfo = mysql_num_rows($MemoInfo);

$query_TempOrder = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = %s", GetSQLValueString($colname_Hospital_ID, "text"));
$OrderInfo = mysql_query($query_TempOrder, $test) or die(mysql_error());
$row_Orderinfo = mysql_fetch_assoc($OrderInfo);
$total_Orderinfo = mysql_num_rows($OrderInfo);





// 치료시작날짜 부터 끝나는 날짜까지 치료 시간표를 만들어 준다.
$idH = $_POST['hf_edit'];
// $fDate = $datetime;

$eDate = date("n/j/y", strtotime($row_treatmentinfo[RT_fin_f]));

$dateSum = 0;
$failchk = 0;
while(strcmp($fDate,$eDate)!=0 and $failchk<150){
	$fDate = date("n/j/y", strtotime($row_treatmentinfo[RT_start1]."+".$dateSum." day"));
	
	$dateSum = $dateSum+1;

	$queryTimer = "SELECT * FROM Timer where Hospital_ID like '$row_patientinfo[Hospital_ID]' and date1 like '$fDate'" ;	

	
	$Timers = mysql_query($queryTimer, $test) or die(mysql_error());
	$Timers = mysql_num_rows($Timers);
	
	if($Timers==0){
		$queries = "insert into Timer (Hospital_ID, date1) values ('$idH', '$fDate')";
		echo($queries); echo("<br>");
		mysql_query($queries);
	}
	$failchk++;
	
}











// Compute prescription



?>



<form id="form1" name="form1" method="POST" action="N_edit_sim.php">
  	<table  class="type05" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
    	<br>
		<td valign="middle" width="810px" scope="row" colspan="2" height="60" valign="middle"> 
			<p style="font-family: arial; font-size:24px; color: #a83845">Radiation Oncology Record</p>
		</td>
		<td width='40px'>
			<right> RESERVATION </right>
		</td>
		<td width="35px">
			<td>
				<input class="form-control" style="height:25px; width:50px" type="text" name="txt_reservation" id="txt_reservation" value="<?php echo $row_patientinfo['TimeTd']; ?>"   />				
				
			</td>
			
		</td>
		<td width="25px" scope="row">
			<form></form>
			<form id="formr" name="formr" method="POST" action="N_report_all.php">
		  		<input class = "btn btn-default" type="submit" name="btn_report" id="btn_report" value="Report" />
		  		<input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
		  		<input type="hidden" name="hr_field" id = "hr_field" value="<?php echo $row_patientinfo['Hospital_ID']; ?>" />
			</form>	
			</td>
		<td width="50px" scope="row">
			<form id="formd" name="formd" method="POST" action="N_edit_sim_manual.php">		  	
		      <input class = "btn btn-default" type="submit" name="btn_edit" id="btn_edit" value="Manual-edit" />
		      <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
		      <input type="hidden" name="hf_edit" id = "hf_edit" value="<?php echo $row_patientinfo['Hospital_ID']; ?>" />
	      </form>	
			    	    	    
		</td>
		<td width="50px" scope="row">
			<form id="form5" name="form5" method="POST" action="ShortDue.php">		  	
		      <input class = "btn btn-default" type="submit" name="btn_edit" id="btn_edit" value="Due" />
		      <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
			  <input name= username type=hidden id=username  value=<?php echo $uid?> />		      
		      <input type="hidden" name="hc_field" id = "hc_field" value="<?php echo $row_patientinfo['Hospital_ID']; ?>" />
	      </form>	
			    	    	    
		</td>



		<td width="50px" scope="row">
			<form id=form11 name=form11 method=post target=_blank action="N_register_all.php">
				<th align=right ><input class = "btn btn-default" type=submit name=btn_home id=btn_home value=NEW-PATIENT />
					<input class = "btn btn-default" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
				</th>
			</form>
			
		</td>
  
  	</table>
  	<hr>
	    <?php
			if (strcmp($row_treatmentinfo['physician'],"mjnam")==0){$drSel = "JN";} 
			if (strcmp($row_treatmentinfo['physician'],"myki")==0){$drSel = "KI";} 			
			if (strcmp($row_treatmentinfo['physician'],"mjlee")==0){$drSel = "JaL";} 			
			if (strcmp($row_treatmentinfo['physician'],"mhlee")==0){$drSel = "JuL";} 			

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
 <div class="jbMenuBlank">
 </div>		
		
 <div class="jbMenu">		
  	
  	<table  class="type05" width="960px" border="1" cellspacing="5" cellpadding="5" align="center">
  		<tr>
	  		<td align="center" style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 0px" width="70px" cellspacing="0"  cellpadding="0" rowspan="4" align="center" >
		  		<img  src=<?php echo $photoPath; ?> width="70px">
	  		</td>


  			<td height="30px" width="120px" bgcolor="#153d73" align="center"><font color="white">Name</font></td> 
  			<td width="120px" bgcolor="#153d73" align="center"><font color="white">Chart no.</font></td>
  			<td width="140px" bgcolor="#153d73" align="center"><font color="white">RO no.</font></td>      
  			<td width="60px" bgcolor="#153d73" align="center"><font color="white">S</font></td>
  			<td width="60px" bgcolor="#153d73" align="center"><font color="white">A</font></td>  			
  			<td width="80px" bgcolor="#153d73" align="center"><font color="white">Physician</font></td>
  			<td width="220px" bgcolor="#153d73" align="center"><font color="white">Clinic (hospital)</font></td>
  			<td width="100px" bgcolor="#153d73" align="center"><font color="white">Ref. physician</font></td>
		</tr>

		<tr>
			<td align="center">
				<input class="form-control"  name="txt_name" type="text" id="txt_name"  style="width:90%;height:100%; font-size:11pt; text-align: center"  value="<?php echo $row_patientinfo['KorName']; ?>"  />        
			</td>
			
			<td align="center">
				<input class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" type="text" name="txt_hospital_id" id="txt_hospital_id" value="<?php echo $row_patientinfo['Hospital_ID']; ?>"   />				
				
			</td>
			
			<td align="center">
				<input class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" type="text" name="txt_ro_id" id="txt_ro_id" value="<?php echo $row_patientinfo['RO_ID']; ?>"   />				
				
					      
      		</td>
	  		
	  		<td align="center">
		  		<select class="form-control" name="txt_search_sex" id="txt_search_sex"  style="width:90%;height:100%; font-size:11pt; text-align: center">
		  		<option value="<?php echo $row_patientinfo['Sex']; ?>" selected="selected"><?php echo $row_patientinfo['Sex']; ?></option>
		  		<option value="F">F</option>
		  		<option value="M">M</option>
	      		</select>	      
	  		</td>
	  		<td align="center">
	      		<input class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" name="txt_age" type="text" id="txt_age" value="<?php echo $row_patientinfo['Age']; ?>" />
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
	  		
	  		<td align="center">
		  			  			<select class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" name="txt_physician" id="txt_physician" >
	  			<option value="<?php echo $row_treatmentinfo['physician']; ?>" selected="selected"><?php echo $drSel; ?></option>

          <?php for($idN=0;$idN<$numphyss;$idN++){  ?>
            <option value=<?php echo($phyIdd[$idN]); ?>><?php echo($phyInt[$idN]); ?></option>

          <?php } ?>
			
			<td align="center">
				<input class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" name="txt_clinic" type="text" id="txt_clinic" value="<?php echo $row_treatmentinfo['Clinic']; ?>" />
			</td>
			
			<td align="center">
				<input class="form-control"  style="width:90%;height:100%; font-size:11pt; text-align: center" name="txt_doctor" type="text" id="txt_doctor" value="<?php echo $row_treatmentinfo['diagnosis']; ?>" />
			</td>
   		</tr>
   		
<!--
  		<tr>
  			<td bgcolor="#b4e876">Prescription</td>
  			<td colspan=4>
	  			
	  			
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
								
							echo "<font  face=arial>$planIdx.$SiteX:</font><font color=red face=arial>$row_treatmentinfo[$doseX]($row_treatmentinfo[$fxX])&nbsp;</font>";
					
					}
		  		?>

	  			
	  			
	  			
	  			
	  			
  			</td>
  			<td bgcolor="#b4e876">Pathology</td>      
  			<td colspan=4><input class="form-control" style="height:25px; width:300px" name="pathology_menu" type="text" id="pathology_menu" value="<?php echo $row_treatmentinfo['pathol']; ?>" /> </td>
		</tr>
-->
<!--
  		<tr>
  			<td></td>
  			<td valign="top" colspan=4>
	  			<input class="form-control" style="height:25px; width:200px" name="txt_px" type="text" id="txt_px" value="<?php echo $row_treatmentinfo['px']; ?>" />
  			</td>
  			<td bgcolor="#b4e876">Stage</td>      
  			<td colspan=4><input class="form-control" style="height:25px; width:300px" name="txt_tnmstage" type="text" id="txt_tnmstage" value="<?php echo $row_treatmentinfo['tnm']; ?>" /> </td>
		</tr>   		
-->
  	</table>
</div>





  

	  
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

?>

	
	
		<?php
			if ($row_patientinfo['CurrentStatus'] == '0' || $row_patientinfo['CurrentStatus'] == '111'){
				$CurrentStatus = 'Active';
			
		    	}else if ($row_patientinfo['CurrentStatus'] == '1'){
					$CurrentStatus = 'Finhish';
				}else if ($row_patientinfo['CurrentStatus'] == '2'){
					$CurrentStatus = 'Stop';
				}else if ($row_patientinfo['CurrentStatus'] == '3'){
					$CurrentStatus = 'Drop';
				}else if ($row_patientinfo['CurrentStatus'] == '4'){
					$CurrentStatus = 'Hold';
				}
			
			if ($row_patientinfo['NextStatus'] == '0'){
				$NextStatus = 'Fin';
		    	}else if ($row_patientinfo['NextStatus'] == '1'){
				$NextStatus = 'CTsim';
				}else if ($row_patientinfo['NextStatus'] == '2'){
				$NextStatus = 'CD w/o Sim';
			}			
			?>
			<tr><th height="15"></th></tr>
 
		<?php
			if(strcmp($CurrentStatus,"Active")==0){
				$curstatVal = 0;
			}	
			elseif(strcmp($CurrentStatus,"Finish")==0){
				$curstatVal = 1;
			}	
			elseif(strcmp($CurrentStatus,"Stop")==0){
				$curstatVal = 2;
			}	
			elseif(strcmp($CurrentStatus,"Drop")==0){
				$curstatVal = 3;
			}	
			elseif(strcmp($CurrentStatus,"Hold")==0){
				$curstatVal = 4;
			}	
		?>


<div  >



   		 <table class = "type05" width="960px" border="1" cellspacing="5" cellpadding="5" align="left">

   		
   		
   		
  		<tr>
	  		<td width="70px"  bgcolor="#153d73" rowspan="2"><font color="white">Site</font></td>	  		
  			<td width="120px">
	  			<select  class="form-control" style=" width:100%; font-size: 12px;" name="primary_menu" id="primary_menu" class="required" onchange="fnCngList(this.value);" >
	  				<option value="<?php echo $row_treatmentinfo['primarysite']; ?>" selected="selected"><?php echo $row_treatmentinfo['primarysite']; ?></option>



            <?php for($idN=0;$idN<$numcatg;$idN++){  ?>
            <option value=<?php echo($catgInt[$idN]); ?>><?php echo($catgInt[$idN]); ?></option>

            <?php } ?>

	  			</select>
  			</td>
  			
  			
  			
  			
  			 <td  colspan="1">
	  			<strong><input class="form-control" style="width:100%; font-size: 11pt " name="sub_site" type="text" id="sub_site" value="<?php echo $row_treatmentinfo['subsite']; ?>" /></strong>
  			</td>

  			  			<td bgcolor="#153d73" width="100px"><font color="white">Stage</font></td>      
  			<td><strong><input class="form-control" style="width:100%; font-size: 11pt " name="txt_tnmstage" type="text" id="txt_tnmstage" value="<?php echo $row_treatmentinfo['tnm']; ?>" /> </strong></td>

		</tr>
		

		
		
  		<tr>

  			<td  colspan="2">
	  			<input class="form-control"  name="sub_siteDet" type="text" id="sub_siteDet" value="<?php echo $row_treatmentinfo['subsiteDet']; ?>" />	  			
  			</td>  			 
  			<td bgcolor="#153d73" rowspan="1" width="100px"><font color="white">Pathology</font></td>
  			<td>
  				<strong><input class="form-control" style="width:100%; font-size: 11pt" name="pathology_menu" type="text" id="pathology_menu" value="<?php echo $row_treatmentinfo['pathol']; ?>" /></strong>	  			
	  		</td>
		</tr>
		



	  	

		<tr>
			<td bgcolor="#153d73" rowspan=1 width="72px"><font color="white">Px.</font></td>
  			<td colspan=4>
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

<br>
</div>



<br>



<div  >
	

	<table  class="type05"  width="960px" border="0" cellspacing="1" cellpadding="1" align="center">

  	<td>
		<font style="font-family: arial; font-size:18px; color:#FF7E79">Radiotherapy Planning</font> <br> <font color="gray" size="2"> 전체 치료 스케쥴을 입력합니다.</font>

		
		
		
		
  	</td>  
	</table>
	<table class="type05" width="960px" align="center">
		
			<tr>
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					Edit Mode
				</td>
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					Aim
				</td>
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					CCRT
				</td>
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					Total Dose
				</td>
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					Status
				</td>				
				<td height="30px" align=center scope="row" bgcolor="#FF7E79" align="center" style="color: #FFFFFF"> 					
					Add Schedule
				</td>				
			</tr>
			
			<tr>
				
  			<td colspan="1">
		 	<select class="form-control" name="Manual" >
		 		<option value=" <?php echo $manualVal; ?>" selected="selected"><?php echo $manualStat; ?></option>
		 		<option value="1">Manual</option>
		 		<option value="0">Auto</option>
        	</select>
	  		</td>
		
		
		
		

  			<td >
<!-- 	      <label for="purpose_menu"></label> -->
		  <select class="form-control" name="purpose_menu" id="purpose_menu" >
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

	  		<td width="360px" colspan="1">
        		<input class="form-control" name="txt_modality" type="text" id="txt_modality" value="<?php echo $row_treatmentinfo['Modality_var1']; ?>"/>
		  	</td>
		
		  	
	    <td align="center"><?php echo $row_treatmentinfo['dose_sum']?> Gy, &nbsp;&nbsp; <?php echo $row_treatmentinfo['Fx_sum']?> Fx</aa> </td>
		<td >
		  <select class="form-control" name="CurrentStatus_menu" id="CurrentStatus_menu" >
	          <option value="<?php echo $curstatVal ?>"  selected="selected"><?php echo $CurrentStatus ?></option>
	          <option value="0">Active</option>
	          <option value="1">Finish</option>
	          <option value="2">Stop</option>
	          <option value="3">Drop</option>
	          <option value="4">Hold</option>
          </select>          
		</td>
		<td align="right">
		<button type = "button" id="addTR" class = "btn btn-default">+</button>
		</td>
		
		  	<tr>
	</table>
	
	
	
	<?php

		$datePick2 = substr($row_treatmentinfo[$simTag],0,strlen($row_treatmentinfo[$simTag]));
		$numSlot = array_fill(0,9, 0);	
		$numActive = array_fill(0,8, '');	
			$timeSlot[1] = "<option value=1>1: 08:40</option>";
			$timeSlot[2] = "<option value=2>2: 09:20</option>";
			$timeSlot[3] = "<option value=3>3: 10:20</option>";
			$timeSlot[4] = "<option value=4>4: 11:00</option>";
			$timeSlot[5] = "<option value=5>5: 13:30</option>";
			$timeSlot[6] = "<option value=6>6: 14:20</option>";
			$timeSlot[7] = "<option value=7>7: 15:10</option>";
			$timeSlot[8] = "<option value=8>8: 16:00</option>"; 				
		
		for($iddds = 1;$iddds<8;$iddds++){ 
		$Sim_ID = 			"CT_Sim".$iddds;
// 		echo($datePick2);
		
		$query_Recordset1 = "SELECT * FROM TreatmentInfo where $Sim_ID like  '$datePick2'" ;	
		$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
		$total_Memoinfo2 = mysql_num_rows($Recordset1);
		$numSim = "CT_Sim". $iddds;
		$timSim = "CT_Time". $iddds;
// 				echo($query_Recordset1);
// 				echo("<br>");
				
// 		$numSlot = [0,0,0,0,0,0,0,0];
			
/*
		for($i=0; $i<$total_Memoinfo2; $i = $i+1){ 
		    $IDs = mysql_result($Recordset1, $i,"Hospital_ID");
		    $CTdate = mysql_result($Recordset1, $i,$numSim);
		    $CTkor = mysql_result($Recordset1, $i,$timSim);
	    
		    if($CTkor !=0){
			    $TimeTable[$CTkor] = $IDs;
			    $numSlot[$CTkor] = $numSlot[$CTkor]+1;
			    $timeSlot[$CTkor] = "";
			    
		    }
		}
*/

		}
		
	?>




<table class="type05" width="960px" align="center">
	<tr>
	</tr>
	
</table>

<table class="type05" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
		<th width="100px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Method </th>
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Room </th>
		<th width="160px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Site </th>		
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Gy</th>
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Fx</th>
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT  </th>
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Start  </th>
		<th width="60px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Finish   </th>

		<th width="80px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT sch  </th>		
		<th width="50px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CE  </th>		
		<th colspan ="3" align=left width="10%" scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Delay  </th>		
		<th width="64px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
    
  	</tr>
  
  
    <?php 
	   
       $sql_idx_result = mysql_result($treatmentinfo,0,"idx");
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
			
    ?>
<?php


?>    
 
    <tr>
      	<td scope="row">
		 	<select class="form-control" name="Method[]" >
		 		<option value=" <?php echo $row_treatmentinfo[$RT_method_f]; ?>" selected="selected"><?php echo $row_treatmentinfo[$RT_method_f]; ?></option>
		 		<option value="2D Conventional">2D Conventional</option>
		 		<option value="3D Conformal">3D Conformal</option>
		 		<option value="EB">Electron</option>
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

<!--         <td width="10%"><input class="form-control" name="Dose[]" type="text" value="<?php echo $row_treatmentinfo[$dose_f]; ?>" size="3" /></td> -->

      	<td scope="row">
		 	<select class="form-control" name="Linac[]" >
		 		<option value=" <?php echo $row_treatmentinfo[$Linac_f]; ?>" selected="selected"><?php echo $row_treatmentinfo[$Linac_f]; ?></option>
		 		<option value="Versa">Versa</option>
		 		<option value="IX">IX</option>
		 		<option value="Infinity">Infinity</option>
		 		
        	</select>
      	</td>
      	
        <td ><input class="form-control" name="Site[]" type="text" value="<?php echo $row_treatmentinfo[$Site_f]; ?>" size="3" /></td>
      	
        <td ><input class="form-control" name="Dose[]" type="text" value="<?php echo $row_treatmentinfo[$dose_f]; ?>" size="3" /></td>
        <td ><input class="form-control" name="Fx[]" type="text" value="<?php echo $row_treatmentinfo[$fx_f]; ?>" size="3" /></td>
        <td ><input class="form-control" name="CT[]" id = "<?php echo $CT_date; ?>" type="text" value="<?php echo $row_treatmentinfo[$CT_sim_f]; ?>" size="10"/></td>        
        <td ><input class="form-control" name="Start[]" id = "<?php echo $RT_date; ?>" type="text" value="<?php echo $row_treatmentinfo[$RT_start_f]; ?>" size="10" /> </td>
        <td ><input class="form-control" name="Finish[]" id = "<?php echo $FIN_date; ?>" type="text" value="<?php echo $row_treatmentinfo[$RT_fin_f]; ?>" size="10"/>
        </td>

        <?php
        if($row_treatmentinfo[$sim_f]==1){$cInd = "1: 08:40";}
        if($row_treatmentinfo[$sim_f]==2){$cInd = "2: 09:20";}        
        if($row_treatmentinfo[$sim_f]==3){$cInd = "3: 10:20";}        
        if($row_treatmentinfo[$sim_f]==4){$cInd = "4: 11:00";}        
        if($row_treatmentinfo[$sim_f]==5){$cInd = "5: 13:30";}        
        if($row_treatmentinfo[$sim_f]==6){$cInd = "6: 14:20";}        
        if($row_treatmentinfo[$sim_f]==7){$cInd = "7: 15:10";}        
        if($row_treatmentinfo[$sim_f]==8){$cInd = "8: 16:00";}        
        if($row_treatmentinfo[$sim_f]==0){$cInd = "Other";}        
        
        ?>
        
		<td >
			
			<select class="form-control" name="CTOrder[]" >			
			<option value=" <?php $cInd; ?>" selected="selected"><?php echo $cInd; ?></option>
			<?php echo($timeSlot[1]); ?>
			<?php echo($timeSlot[2]); ?>
			<?php echo($timeSlot[3]); ?>
			<?php echo($timeSlot[4]); ?>
			<?php echo($timeSlot[5]); ?>
			<?php echo($timeSlot[6]); ?>
			<?php echo($timeSlot[7]); ?>
			<?php echo($timeSlot[8]); ?>
			
			
<!--
			<option value="1">1: 08:40</option>
			<option value="2">2: 09:20</option>
			<option value="3">3: 10:20</option>
			<option value="4">4: 11:00</option>
			<option value="5">5: 13:30</option>
			<option value="6">6: 14:20</option>
			<option value="7">7: 15:10</option>
			<option value="8">8: 16:00</option>
-->
			<option value="0">Other</option>
		</select></td>							
		<td ></select>			
		<select class="form-control" name="Ce[]" >
			<option value=" <?php $row_treatmentinfo[$ce_f]; ?>" selected="selected"> <?php echo $row_treatmentinfo[$ce_f]; ?></option>
			<option value="CE">CE</option>
			<option value="NCE">NCE</option>									
		</select></td>
        
        <td><input type="text" class="form-control" id = "<?php echo $DelayID; ?>" name = "Delay[]"  value ="<?php if($row_treatmentinfo[$Delay_idx_f]){echo $row_treatmentinfo[$Delay_idx_f];}else{};?>" /> </td>
		<td><center><input type="button" class="btn btn-basic"  value = "+" id = "<?php echo $Delay_Plus; ?>" ></center></td>
		<td><center><input type="button" class="btn btn-basic"  value = "-" id = "<?php echo $Delay_Minus; ?>" ></center></td>
        
		<td><center><button type = "button"  class="btn btn-default" >-</button></center>
			
		</td>

    </tr>
   
    


    <?php } ?>
</table>  
    
<!--
<table class="type05" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
   

	    <th width="10%">Total</th><td width="10%"><?php echo $row_treatmentinfo['dose_sum']?> Gy, &nbsp;&nbsp; <?php echo $row_treatmentinfo['Fx_sum']?> Fx</aa> </td></tr>
	<tr>
		<?php
			if ($row_patientinfo['CurrentStatus'] == '0' || $row_patientinfo['CurrentStatus'] == '111'){
				$CurrentStatus = 'Active';
			
		    	}else if ($row_patientinfo['CurrentStatus'] == '1'){
					$CurrentStatus = 'Finhish';
				}else if ($row_patientinfo['CurrentStatus'] == '2'){
					$CurrentStatus = 'Stop';
				}else if ($row_patientinfo['CurrentStatus'] == '3'){
					$CurrentStatus = 'Drop';
				}else if ($row_patientinfo['CurrentStatus'] == '4'){
					$CurrentStatus = 'Hold';
				}
			
			if ($row_patientinfo['NextStatus'] == '0'){
				$NextStatus = 'Fin';
		    	}else if ($row_patientinfo['NextStatus'] == '1'){
				$NextStatus = 'CTsim';
				}else if ($row_patientinfo['NextStatus'] == '2'){
				$NextStatus = 'CD w/o Sim';
			}			
			?>
			<tr><th height="15"></th></tr>
 
		<?php
			if(strcmp($CurrentStatus,"Active")==0){
				$curstatVal = 0;
			}	
			elseif(strcmp($CurrentStatus,"Finish")==0){
				$curstatVal = 1;
			}	
			elseif(strcmp($CurrentStatus,"Stop")==0){
				$curstatVal = 2;
			}	
			elseif(strcmp($CurrentStatus,"Drop")==0){
				$curstatVal = 3;
			}	
			elseif(strcmp($CurrentStatus,"Hold")==0){
				$curstatVal = 4;
			}	
		?>
		<th width="56">Current status</th>
		<td width="10%">
		  <select name="CurrentStatus_menu" id="CurrentStatus_menu" >
	          <option value="<?php echo $curstatVal ?>"  selected="selected"><?php echo $CurrentStatus ?></option>
	          <option value="0">Active</option>
	          <option value="1">Finish</option>
	          <option value="2">Stop</option>
	          <option value="3">Drop</option>
	          <option value="4">Hold</option>
          </select>          
          </tr>
  </table>
  
-->
  
  	<table class = "type05" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
		<tr height="30">
		<th width="60px" align=center scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> Sim </th>  
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 08:40 </th>  
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 09:20 </th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 10:20 </th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 11:00 </th>		
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 13:30</th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 14:20</th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 15:10  </th>
		<th width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; 16:00  </th>    
  		</tr>


<?php
	for($idxx=0;$idxx<$row_treatmentinfo[idx];$idxx++){
		$simNums = $idxx+1;
		$simTag = "CT_Sim".$simNums;
// 		echo($row_treatmentinfo[$simTag]);	  
		if(strlen($row_treatmentinfo[$simTag]>5)){ 
	?>

	<?php

		$datePick2 = substr($row_treatmentinfo[$simTag],0,strlen($row_treatmentinfo[$simTag]));
		$numSlot = array_fill(0,9, 0);	
		$numActive = array_fill(0,8, '');	
			$timeSlot[1] = "<option value=1>1: 08:40</option>";
			$timeSlot[2] = "<option value=2>2: 09:20</option>";
			$timeSlot[3] = "<option value=3>3: 10:20</option>";
			$timeSlot[4] = "<option value=4>4: 11:00</option>";
			$timeSlot[5] = "<option value=5>5: 13:30</option>";
			$timeSlot[6] = "<option value=6>6: 14:20</option>";
			$timeSlot[7] = "<option value=7>7: 15:10</option>";
			$timeSlot[8] = "<option value=8>8: 16:00</option>"; 				
		
		for($iddds = 1;$iddds<8;$iddds++){ 
		$Sim_ID = 			"CT_Sim".$iddds;
// 		echo($datePick2);
		
		$query_Recordset1 = "SELECT * FROM TreatmentInfo where $Sim_ID like  '$datePick2'" ;	
		$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
		$total_Memoinfo2 = mysql_num_rows($Recordset1);
		$numSim = "CT_Sim". $iddds;
		$timSim = "CT_Time". $iddds;
			
		for($i=0; $i<$total_Memoinfo2; $i = $i+1){ 
		    $IDs = mysql_result($Recordset1, $i,"Hospital_ID");
		    $CTdate = mysql_result($Recordset1, $i,$numSim);
		    $CTkor = mysql_result($Recordset1, $i,$timSim);
		    if($CTkor !=0 or strlen($CTkor)>0){
			    $TimeTable[$CTkor] = $IDs;
			    $numSlot[$CTkor] = $numSlot[$CTkor]+1;
			    $timeSlot[$CTkor] = "";
			    
		    }
		}

		}
		
	?>
  				<tr height="30">
<th width="60px" align=center scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> <?php echo(substr($datePick2,0,strlen($datePick2)-3)); ?> </th>  

			<?php
				for($secInd = 1;$secInd<9; $secInd++){ 
				$txVal = $TimeTable[$secInd];
				if(strcmp($txVal,$row_treatmentinfo[Hospital_ID])==0 and $numSlot[$secInd]>0){
					$bgcols = "#e62325"; /* red 50 (ibm design colors) */
				}
				else{
					$bgcols = "#FFFFFF";
				}
				
				echo "<th bgcolor=$bgcols align=left>";
				if(strlen($txVal)>5 and $numSlot[$secInd]>0){ 
					echo "<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value= $txVal >";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$datePick />";												
					echo "<input name=hf_edit type=hidden id=hf_edit value= $txVal /> </form>";
					echo($numSlot[$secInd]);
				}
				echo("</th>");
				}
			?> 
  		</tr>

<?php
	
	}}
	?>
	</table>
	<br>
	
</div>
<br>
<!-- Short orders -->
<div  >

<br>
<table class="type1" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
<tr>
	<td width="420px" valign="top">		
		<font style="font-family: arial; font-size:18px; color:#1C73B9">&nbsp;&nbsp;Short order</font> <br> <font color="gray" size="2"> &nbsp;&nbsp;&nbsp;30자 이내의 짤막한 오더를 적어주세요.</font>
	</td>
	<td width="50px" valign="top">
		<button type = "button" id="addOrder" class = "btn btn-default">+</button>		
	</td>

	<td width="420px" valign="top">
		<font style="font-family: arial; font-size:18px; color:#1C73B9">&nbsp;&nbsp;Remark</font> <br> <font color="gray" size="2"> &nbsp;&nbsp;&nbsp;간단한 히스토리를 메모합니다.</font>
	</td>
	<td width="50px" valign="top">
		<button type = "button" id="addComment" class = "btn btn-default">+</button>		
	</td>
	
</tr>
</table>


<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="3" align="center">
<tr>
	<td valign="top">
		
		<?php	    

		$Today_Date = Date("n/j/y");
		$sql_Memo = mysql_query("select Memo1 from OrderTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'");
		$sql_Date = mysql_query("select Date1 from OrderTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'"); 
		$sql_idx = mysql_query("select idx from OrderTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'");  
		?>
		<table    id="OrderTable" width="480px" border="0" cellspacing="1" cellpadding="1" align="center">
		  	<tr height="30">
			  	<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></th>
				<th width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></th> 
				<th width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></th> 
				<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
		  	</tr>
		  	<?php for($i=0; $i<$total_Orderinfo; $i = $i+1){ 
			    $Memo = mysql_result($sql_Memo, $i,"Memo1");
			    $Date = mysql_result($sql_Date, $i,"Date1");
			    $i_ = $i+1;
			    $OrderPicker = "OrderPicker"."$i_";
		   	?>
		   	<tr height="30">
		    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
		    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $OrderPicker; ?>' type='OrderDate' name= 'OrderDate[]' value ='<?php echo $Date?>' ></td>
				<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Order' name= 'Order[]' value='<?php echo $Memo; ?>' ></td></td>
				<td><center><button type='button' class='btn btn-default'>-</button></center></td>
		  	</tr>
		  	<?php } ?>
		</table>

	</td>


	<td valign="top">




<?php	    
$Today_Date = Date("n/j/y");
$sql_Memo = mysql_query("select Memo1 from MemoTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'");
$sql_Date = mysql_query("select Date1 from MemoTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'"); 
$sql_idx = mysql_query("select idx from MemoTemp where Hospital_ID = '$row_patientinfo[Hospital_ID]'");  
?>
<table  id="CommentTable" width="480px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></th>
		<th width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></th> 
		<th width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></th> 
		<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
  	</tr>
  	<?php for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
	    $Memo = mysql_result($sql_Memo, $i,"Memo1");
	    $Date = mysql_result($sql_Date, $i,"Date1");
	    $i_ = $i+1;
	    $CommentPicker = "CommentPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $CommentPicker; ?>' type='CommentDate' name= 'CommentDate[]' value ='<?php echo $Date?>' ></td>
		<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Comment' name= 'Comment[]' value='<?php echo $Memo; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>



	</td>
	
</tr>
</table>
<br>
</div>

  
  
<br>  
<div  >

<!--   MEETING LIST TEMPORARY REMOVED -->
  
<table class="type1" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
	<td width="20%" scope="row" colspan="2" height="60" valign="middle"> <p style=" font-size:18px; color:#339900">&nbsp;&nbsp;Exam Scheduling</p></td> </table> 

<table  class="type05"  width="960px" align="center">

	<tr>
		<td>
			<button type = "button" id="addMeetingDate" class = "btn">1주간격</button>

		</td>
		<td>
			<button type = "button" id="addMeetingDateDouble" class = "btn">2주간격</button>

		</td>
	</tr>
	<tr>
		<th>
			<button type = "button" id="addMeet" class = "btn btn-default">+</button>
		</th>
	</tr>
</table> 
<?php
   
	$Meet_Memo = mysql_query("select Memo from MeetingList where Hospital_ID = '$colname_Hospital_ID' order by STR_TO_DATE(Date, '%m/%d/%Y')");
	$Meet_Date = mysql_query("select Date from MeetingList where Hospital_ID = '$colname_Hospital_ID' order by STR_TO_DATE(Date, '%m/%d/%Y')"); 
	$Meet_idx = mysql_query("select idxMeet from MeetingList where Hospital_ID = '$colname_Hospital_ID' order by STR_TO_DATE(Date, '%m/%d/%Y') ");
	$Meet_Time = mysql_query("select Time1 from MeetingList where Hospital_ID = '$colname_Hospital_ID' order by STR_TO_DATE(Date, '%m/%d/%Y') ");
	$total_Meetinfo = mysql_num_rows($Meet_Memo);	
?>
  
  
<table  class="type05"  id="MeetingTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<th width="20px" scope="row" bgcolor="#339900" style="color: #FFFFFF"><center> No.  </center></th>
		<th width="150px" scope="row" bgcolor="#339900" style="color: #FFFFFF"><center>Date</center></th> 
		<th width="600px" scope="row" bgcolor="#339900" style="color: #FFFFFF"> <center>Free comment</center></th> 
		<th width="220px" scope="row" bgcolor="#339900" style="color: #FFFFFF"> <center>시간확인</center></th> 
		<th width="1%" scope="row" bgcolor="#339900" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
  	</tr>
  	<?php for($i=0; $i<$total_Meetinfo; $i = $i+1){ 
	    $Memo = mysql_result($Meet_Memo, $i,"Memo");
	    $Date = mysql_result($Meet_Date, $i,"Date");
	    $Times = mysql_result($Meet_Time, $i,"Time1");
	    $i_ = $i+1;
	    $MeetPicker = "MeetPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="20px" scope="row" style="color: #71f80b"><center><?php echo $i+1 ?></center></td>
    	<td width="150px" scope="row" style="color: #71f80b"><input class = 'form-control input-sm ' id = '<?php echo $MeetPicker; ?>' type='MeetDate' name= 'MeetDate[]' value ='<?php echo $Date?>' ></td>
		<td width="600px" scope="rpw" style="color: #71f80b"><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' value='<?php echo $Memo; ?>' ></td></td>
		<td width="220px" scope="rpw" style="color: #71f80b"><input class = 'form-control input-sm ' type='MeetTime' name= 'MeetTime[]' value='<?php echo $Times; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>



<br>
</div>
<br>

<div  >


<table class="type05" id="MeetingTable" width="960px" border="1" cellspacing="1" cellpadding="1" align="center" >
  	<tr height="30" valign="top">
<!-- 	  	<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> Sun  </center></th>	  	 -->
	  	<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> MON  </center></th>
		<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Tue</center></th> 
		<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Wed</center></th> 
		<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Thu</center></th>
		<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Fri</center></th>		
<!-- 	  	<th width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> Sat  </center></th> -->
		
  	</tr>

  	<?php
// 	echo($row_treatmentinfo[CT_Sim1]);	  	
// 	echo($row_treatmentinfo[RT_fin_f]);	  	
 	$weekDays= date("w",strtotime($row_treatmentinfo[CT_Sim1]));  

	$Rtdate = strtotime($row_treatmentinfo[CT_Sim1]); // 20120101 같은 포맷도 잘됨
	$mondayChecker = "-".$weekDays." days";
	$stDate = date("m/d/y",strtotime($mondayChecker,strtotime($row_treatmentinfo[CT_Sim1])));

	$RtdateF = strtotime($row_treatmentinfo[RT_fin_f]);
	$diff = abs(strtotime($row_treatmentinfo[RT_fin_f]) - strtotime($row_treatmentinfo[CT_Sim1]));
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff/(60*60*24)));
	
	
 
 
// 	echo(floor($days/7));

	$numWeeks = floor($days/7);
	
	
	$dayPlus = 0;
	$Mon = substr($stDate,0,2);
	for ($idWeeks = 0; $idWeeks<$numWeeks+3; $idWeeks++){ 
  	?>
  	
  	<tr height="30" valign="top">
	  	<?php
		  	
	  		for ($idDays = 0; $idDays<7; $idDays++){ 		  	
		  	
		  	?>
		  	
		  	

	  		
		  	
		  	<?php
// 			  	Date Checker 
		  		$todayChecker = "+".$dayPlus." days";
			  	$tDate = date("m/d/y",strtotime($todayChecker,strtotime($stDate)));
			  	$Mon = substr($tDate,0,2);
			  	
			  	if($dayPlus==0 or strcmp($Mon,$MonPre)!=0){
				  	$strInits = 0;
				  	$strLens = 5;				  	
				  	$MonPre = $Mon;
			  	}
			  	else{
				  	$strInits = 3;
				  	$strLens = 2;				  	
				  	
			  	}
			  	$dayPlus = $dayPlus+1;
			  	if(strcmp(Date("n/j/y"),date("n/j/y",strtotime($tDate)))==0){
				  	$tCol = "red"; /* red 60 (ibm design colors) */
			  	}
			  	else{
				  	$tCol = "gray";				  	 /* cool-gray 50 (ibm design colors) */
			  	}
				  	$bCol = "white";				  	 /* aqua 1 (ibm design colors) */
			  	
			  	if(strtotime($row_treatmentinfo[RT_start1])<=strtotime($tDate) and strtotime($row_treatmentinfo[RT_fin_f])>=strtotime($tDate)){
				  	$bCol = "#e1ebf7"; /* blue 1 (ibm design colors) */
			  	}
			  	if(strcmp(Date("n/j/y"),date("n/j/y",strtotime($tDate)))==0){
				  	$bCol = "#f5e7eb";				  	 /* magenta 1 (ibm design colors) */
			  	}
			  	
			  	?>
			  	
			  	
			  	<?php
				  	 	if(date("w",strtotime($tDate))!=6 and date("w",strtotime($tDate))!=0){   

				?>
	  			<th height="120px" width="192px" scope="row" bgcolor=<?php echo($bCol);?> style="color: #000000">

		  		<p align="right">

<?php			  	
			  	echo("<font color=$tCol>");
				echo(substr($tDate,$strInits,$strLens));  	
				echo("</font>");
				$tDates = date("n/j/y",strtotime($tDate));			
				

			?>
		  	</p>

		  	<?php
			  	if(strtotime($row_treatmentinfo[RT_start1])<=strtotime($tDate) and strtotime($row_treatmentinfo[RT_fin_f])>=strtotime($tDate)){

		  	?>

	  		<?php
		  	$datetimeTd = substr($tDate,0,strlen($tDate));
		  	$datetimeTd = date("n/j/y", strtotime($datetimeTd));
	
			mysql_select_db($database_test, $test);
			$query_timerinfo = sprintf("SELECT * FROM Timer WHERE Hospital_ID like %s and date1 like '%s'", GetSQLValueString($colname_Hospital_ID, "text"),$datetimeTd);
// 			echo($tDate);
			$timerinfo = mysql_query($query_timerinfo, $test) or die(mysql_error());
			$row_timerinfo = mysql_fetch_assoc($timerinfo);
// 			echo($row_timerinfo[time1]);

		  		
		  		
		  		
		    echo "<form id=form111 name=form111></form>";
		    echo "<form id=form3 name=form3 method=post action=N_edit_sim.php>"; 
		    echo "<input size=3 name=spctime id=spctime value=$row_timerinfo[time1]>";                       
		    echo "<input size=3 name=durtime id=durtime value=$row_timerinfo[Duration]>";   

			echo "<input type='checkbox' name='ontime' value='1'>";		                        
		    echo "<input type=submit name=btn_edit id=btn_edit value='on'>";
		    echo "<input name=datetime type=hidden id=datetime  value=$tDate/>";            

		    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
		    echo "<input name=username type=hidden id=username  value=$uid/>";           
		    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_patientinfo[Hospital_ID] /></a>";    
		    echo "<input name=hf_fin type=hidden id=hf_fin value= $row_treatmentinfo[RT_fin_f] /></a></form>";    

		    ?>




			<?php } ?>			  	
		  	<?php
// 			echo($row_treatmentinfo[RT_start1]);
			
			if(strcmp($row_treatmentinfo[RT_start1],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose1]/$row_treatmentinfo[Fx1];
				echo("<font color=red>Start ($row_treatmentinfo[Site1]) <br> $row_treatmentinfo[dose1] Gy: $fxDose Gy X $row_treatmentinfo[Fx1] fx.</font>");
			}
			if(strcmp($row_treatmentinfo[RT_fin_f],$tDates)==0){
				echo("<font color=red>Fin</font>");
			}
			
			if(strcmp($row_treatmentinfo[RT_start2],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose2]/$row_treatmentinfo[Fx2];
				echo("<font color=blue>RF ($row_treatmentinfo[Site2]) <br> $row_treatmentinfo[dose2] Gy: $fxDose Gy X $row_treatmentinfo[Fx2] fx.</font>");
			}
			if(strcmp($row_treatmentinfo[RT_start3],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose3]/$row_treatmentinfo[Fx3];
				echo("<font color=blue>RF ($row_treatmentinfo[Site3]) <br> $row_treatmentinfo[dose3] Gy: $fxDose Gy X $row_treatmentinfo[Fx3] fx.</font>");
			}
			if(strcmp($row_treatmentinfo[RT_start4],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose4]/$row_treatmentinfo[Fx4];
				echo("<font color=blue>RF ($row_treatmentinfo[Site4]) <br> $row_treatmentinfo[dose4] Gy: $fxDose Gy X $row_treatmentinfo[Fx4] fx.</font>");

			}
			if(strcmp($row_treatmentinfo[RT_start5],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose5]/$row_treatmentinfo[Fx5];
				echo("<font color=blue>RF ($row_treatmentinfo[Site5]) <br> $row_treatmentinfo[dose5] Gy: $fxDose Gy X $row_treatmentinfo[Fx5] fx.</font>");
			}
			if(strcmp($row_treatmentinfo[RT_start6],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose6]/$row_treatmentinfo[Fx6];
				echo("<font color=blue>RF ($row_treatmentinfo[Site6]) <br> $row_treatmentinfo[dose6] Gy: $fxDose Gy X $row_treatmentinfo[Fx6] fx.</font>");
			}
			if(strcmp($row_treatmentinfo[RT_start7],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose7]/$row_treatmentinfo[Fx7];
				echo("<font color=blue>RF ($row_treatmentinfo[Site7]) <br> $row_treatmentinfo[dose7] Gy: $fxDose Gy X $row_treatmentinfo[Fx7] fx.</font>");
			}
			
			if(strcmp($row_treatmentinfo[CT_Sim1],$tDates)==0){
				echo("<font color=#00884b>Simulation</font>"); /* green 50 (ibm design colors) */
			}
			
			if(strcmp($row_treatmentinfo[CT_Sim2],$tDates)==0){
				echo("<font color=#00884b>Resim</font>");
			}
			if(strcmp($row_treatmentinfo[CT_Sim3],$tDates)==0){
				echo("<font color=#00884b>Resim</font>");
			}
			if(strcmp($row_treatmentinfo[CT_Sim4],$tDates)==0){
				echo("<font color=#00884b>Resim</font>");
			}
			if(strcmp($row_treatmentinfo[CT_Sim5],$tDates)==0){
				echo("<font color=#00884b>Resim</font>");
			}
			if(strcmp($row_treatmentinfo[CT_Sim6],$tDates)==0){
				echo("<font color=#00884b>Resim</font>");
			}
			  	
			  	echo("<br>");
			?>

		  	<?php
		  		$hisID = $row_patientinfo['Hospital_ID'];
				$queryMemo = "Select * from MeetingList where (Date like '$tDates' AND Hospital_ID like $hisID)";

				$MemoInfo = mysql_query($queryMemo, $test) or die(mysql_error());
				$row_Memoinfo = mysql_fetch_assoc($MemoInfo);
				$total_Memoinfo = mysql_num_rows($MemoInfo);
				$sql_Memo = mysql_query($queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$Memo = mysql_result($sql_Memo, $i,"Memo");
					if(strlen($Memo)>1){
					echo("Exam: "); echo($Memo); echo("<br>");
					}
					else{
						echo("Exam"); echo("<br>");

					}
					}
			  	?>

		  	
		  	<?php
		  		$hisID = $row_patientinfo['Hospital_ID'];
				$queryMemo = "Select * from MemoTemp where (Date1 like '$tDates' AND Hospital_ID like $hisID)";

				$MemoInfo = mysql_query($queryMemo, $test) or die(mysql_error());
				$row_Memoinfo = mysql_fetch_assoc($MemoInfo);
				$total_Memoinfo = mysql_num_rows($MemoInfo);
				$sql_Memo = mysql_query($queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$Memo = mysql_result($sql_Memo, $i,"Memo1");
					 echo($Memo); echo("<br>");
					}
			  	?>
		  	<?php
		  		$hisID = $row_patientinfo['Hospital_ID'];
				$queryMemo = "Select * from OrderTemp where (Date1 like '$tDates' AND Hospital_ID like $hisID)";

				$MemoInfo = mysql_query($queryMemo, $test) or die(mysql_error());
				$row_Memoinfo = mysql_fetch_assoc($MemoInfo);
				$total_Memoinfo = mysql_num_rows($MemoInfo);
				$sql_Memo = mysql_query($queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$Memo = mysql_result($sql_Memo, $i,"Memo1");
					 echo($Memo); echo("<br>");
					}
			  	?>
		  	
		  	
		  	
		  	
	  	</th>
	  	<?php
		  	}
		  	}
		  	?>
	
  	</tr>

  	
  	
  	
  	
  	<?php
	  	}
	  	?>


</table>
<br>
</div>
<!--

<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
	<td width="20%" scope="row" colspan="2" height="60" valign="middle"> <font style="font-family: arial; font-size:18px; color:#1C73B9">Short order (아직 미완성!! 30자 이내의 짤막한 오더를 적어주세요)</font></td>
</table>

<table class="type05" width="960px" align="center">
	<tr>
		<th>
			<button type = "button" id="addOrder" class = "btn btn-default">+</button>
		</th>
	</tr>
</table>

<?php	    
$Today_Date = Date("n/j/y");
$sql_Memo = mysql_query("select Memo1 from OrderTemp where Hospital_ID = '$colname_Hospital_ID'");
$sql_Date = mysql_query("select Date1 from OrderTemp where Hospital_ID = '$colname_Hospital_ID'"); 
$sql_idx = mysql_query("select idx from OrderTemp where Hospital_ID = '$colname_Hospital_ID'");  
?>
<table class="type05" id="OrderTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></th>
		<th width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></th> 
		<th width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></th> 
		<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
  	</tr>
  	<?php for($i=0; $i<$total_Orderinfo; $i = $i+1){ 
	    $Memo = mysql_result($sql_Memo, $i,"Memo1");
	    $Date = mysql_result($sql_Date, $i,"Date1");
	    $i_ = $i+1;
	    $OrderPicker = "OrderPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $OrderPicker; ?>' type='OrderDate' name= 'OrderDate[]' value ='<?php echo $Date?>' ></td>
		<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Order' name= 'Order[]' value='<?php echo $Memo; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>
-->

<br>









<!--

<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
	<td width="20%" scope="row" colspan="2" height="60" valign="middle"> <font style="font-family: arial; font-size:18px; color:#1C73B9">Remarks</font></td>
</table>

<table class="type05" width="960px" align="center">
	<tr>
		<th>
			<button type = "button" id="addComment" class = "btn btn-default">+</button>
		</th>
	</tr>
</table>

<?php	    
$Today_Date = Date("n/j/y");
$sql_Memo = mysql_query("select Memo1 from MemoTemp where Hospital_ID = '$colname_Hospital_ID'");
$sql_Date = mysql_query("select Date1 from MemoTemp where Hospital_ID = '$colname_Hospital_ID'"); 
$sql_idx = mysql_query("select idx from MemoTemp where Hospital_ID = '$colname_Hospital_ID'");  
?>
<table class="type05" id="CommentTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></th>
		<th width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></th> 
		<th width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></th> 
		<th width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </th>
  	</tr>
  	<?php for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
	    $Memo = mysql_result($sql_Memo, $i,"Memo1");
	    $Date = mysql_result($sql_Date, $i,"Date1");
	    $i_ = $i+1;
	    $CommentPicker = "CommentPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $CommentPicker; ?>' type='CommentDate' name= 'CommentDate[]' value ='<?php echo $Date?>' ></td>
		<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Comment' name= 'Comment[]' value='<?php echo $Memo; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>
-->

  <hr>

  	  
    <center><input class="btn btn-default" type="submit" name="btn_update" id="btn_update" value="UPDATE" />
    <input type="hidden" name="H_ID" id = "H_ID" value = "<?php echo $row_treatmentinfo['Hospital_ID'];  ?>" />
    <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
    <input type="hidden" name="datePick" id = "permit" value="<?php echo $datePick?>" />
    <input type="hidden" name="MM_update" value="form1" />
    </center>     
  
  
  <hr>
  <hr>
</form>

<!-- Routine select -->

<div class="modal fade" id="Routine1" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Head & Neck
       	 		</div>
	         	<div class="modal-body">
		         		<table  class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
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
		         		<table class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
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
		         		<table  class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
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
		         		<table class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
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
		         		<table class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
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
    
    
    
    <div class="modal fade" id="RoutineProstate" role="dialog"> <!-- div id 값 수정--> 
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Prostate
       	 		</div>
	         	<div class="modal-body">
		         		<table class="type05"  id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<th>Method</th>
				         		<th></th>
				         		<th>Start</th>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_Prostate" name="Method_Prostate">
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
									<input class = "form-control input-sm" type="text" id = "Test_Datepicker_Prostate" name= "Start_Prostate">
						
								</td>

			         		</tr>
			         		
		         		</table>
		         </div>
				 <div class="modal-footer">
					 
					<button type="button" class="btn btn-default" id = "RoutineProstate_F" data-dismiss="modal"></span>SUBMIT</button>
					
					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	
				 </div>
        		
      		</div>
    	</div>
    </div> <!-- Routine2 -->    

<?php
	
	
mysql_free_result($clinicalinfo);

mysql_free_result($patientinfo);

mysql_free_result($treatmentinfo);
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
	    num = new Array("Select","Breast Rt.","Breast Lt.","Other");
		vnum = new Array("","Breast Rt.","Breast Lt.","Other");
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




// Generate routines
$(function() {
              //오늘 날짜를 출력

              //datepicker 한국어로 사용하기 위한 언어설정
              $('#Test_Datepicker1, #Test_Datepicker2, #Test_Datepicker3, #Test_Datepicker4, #Test_Datepicker5, #Test_Datepicker6, #Test_Datepicker7, #Test_Datepicker8, #Test_Datepicker9, #Test_Datepicker10, #Test_Datepicker11, #Test_Datepicker12, #Test_Datepicker13, #Test_Datepicker14, #Test_Datepicker15, #Test_Datepicker16, #Test_Datepicker17, #Test_Datepicker18, #Test_Datepicker19, #Test_Datepicker20, #Test_Datepicker21, #Test_Datepicker22, #Test_Datepicker23, #Test_Datepicker24, #Test_Datepicker25, #Test_Datepicker26, #Test_Datepicker27, #Test_Datepicker_R1, #Test_Datepicker_R2, #Test_Datepicker_R3, #Test_Datepicker_R4, #Test_Datepicker_R5, #Test_Datepicker_Prostate, #CommentPicker_, #CommentPicker1, #CommentPicker2, #CommentPicker3, #CommentPicker4, #CommentPicker5, #CommentPicker6, #CommentPicker7, #CommentPicker8, #CommentPicker9, #OrderPicker_, #OrderPicker1, #OrderPicker2, #OrderPicker3, #OrderPicker4, #OrderPicker5, #OrderPicker6, #OrderPicker7, #OrderPicker8, #OrderPicker9, #OrderPicker10, #OrderPicker11, #OrderPicker12, #OrderPicker13, #OrderPicker14, #OrderPicker15, #OrderPicker16, #MeetPicker1, #MeetPicker2, #MeetPicker3, #MeetPicker4, #MeetPicker5, #MeetPicker6, #MeetPicker7, #MeetPicker8, #MeetPicker9, #MeetPicker10, #MeetPicker11, #MeetPicker12').datepicker({
	              dateFormat:'m/d/y'
              });
});

var count = <?php if($j){echo $j;}else{echo 0;} ?>;
var count_ = <?php if($i){echo $i;}else{echo 0;} ?>;
var DateStart = <?php if($n_RT){echo $n_RT+3;}else{echo 1;} ?>;
var DateFinish = <?php if($n_Fin){echo $n_Fin+3;}else{echo 2;} ?>;
var DateCT = <?php if($n_CT){echo $n_CT+3;}else{echo 3;} ?>;
var Meet_Count_;
if(<?php echo $total_Meetinfo; ?>){ Meet_Count_ = <?php echo $total_Meetinfo; ?>;}else{Meet_Count_ = 1;}

var CDate = <?php if($i_){echo $i_;}else{echo 0;}?>;
var Fx = [18,12,3,7];
var Fx_ = [22, 6];
var fXLung = [15, 10, 5, 6];
var fXBreast = [20, 5];
var fXProstate = [21, 9];

var CommentDate = new Date();
var Comment_year = CommentDate.getFullYear()%2000;
var Comment_month = CommentDate.getMonth()+1;
var Comment_date = CommentDate.getDate();
			
var Comment_Finish_ = [Comment_month,Comment_date,Comment_year];
var Comment_Finish = Comment_Finish_.join("/");

var OrderDate = new Date();
var Order_year = OrderDate.getFullYear()%2000;
var Order_month = OrderDate.getMonth()+1;
var Order_date = OrderDate.getDate();
			
var Order_Finish_ = [Order_month,Order_date,Order_year];
var Order_Finish = Order_Finish_.join("/");





var HistoryDate = new Date();
var History_year = HistoryDate.getFullYear()%2000;
var History_month = HistoryDate.getMonth()+1;
var History_date = HistoryDate.getDate();
			
var History_Finish_ = [History_month,History_date,History_year];
var History_Finish = History_Finish_.join("/");



var Delay1_ = 0, Delay2_ = 0, Delay3_ = 0, Delay4_ = 0, Delay5_ = 0, Delay6_ = 0, Delay7_ = 0;

var Start_Date = <?php echo json_encode($row_treatmentinfo['RT_start1']);?>; //진료가 시작되는  날짜
var CT_Date = <?php echo json_encode($row_treatmentinfo['CT_Sim1']);?>; //진료가 시작되는  날짜
var Finish_Date = <?php echo json_encode($row_treatmentinfo[$RT_fin_f]); ?>; //진료가 끝나는 날짜	


var Start_Date = <?php echo json_encode($row_treatmentinfo['RT_start1']);?>; //진료가 시작되는  날짜
var CT_Date = <?php echo json_encode($row_treatmentinfo['CT_Sim1']);?>; //진료가 시작되는  날짜
var Finish_Date = <?php echo json_encode($row_treatmentinfo[$RT_fin_f]); ?>; //진료가 끝나는 날짜	
$(function() {
	$("#addMeetingDate").click(function() {
		var phys = $('#txt_physician').val();
		if(phys=="myki"){
			var fm = 3;
			var nm = 4;
		}
		if(phys=="mjlee"){
			var fm = 1;
			var nm = 3;
			
		}
		if(phys=="mhlee"){
			var fm = 3;
			var nm = 4;
			
		}
			
		Start_Date = new Date(Start_Date);
		Finish_Date = new Date(Finish_Date);
		CT_Date = new Date(CT_Date);
// 		alert(phys);
		
		var FD_year = Finish_Date.getFullYear()%2000;
		var FD_month = Finish_Date.getMonth()+1;
		var FD_date = Finish_Date.getDate();
				
		var Finish_Date_ = [FD_month,FD_date,FD_year];
		var Finish_Date_ = Finish_Date_.join("/");
					
/*
			var weekdays = prompt ('재진 요일을 입력해 주세요');
			var weekdays = prompt ('초진 요일을 입력해 주세요');
*/
			
			
			
			var Meet=[];
			var MeetComment=[];
			var SD_year = Start_Date.getFullYear()%2000;
			var SD_month = Start_Date.getMonth()+1;
			var SD_date = Start_Date.getDate();
			var SD_yoil = Start_Date.getDay();
			
			var etc = nm - SD_yoil;							// 목요일(4)
			var Start_Date_ = [SD_month,SD_date,SD_year];
			var Start_Date_ = Start_Date_.join("/");;
			
			
			var CD_year = CT_Date.getFullYear()%2000;
			var CD_month = CT_Date.getMonth()+1;
			var CD_date = CT_Date.getDate();
			var CD_yoil = CT_Date.getDay();
			
// 			var etc = nm - CD_yoil;							// 목요일(4)
			var CT_Date_ = [CD_month,CD_date,CD_year];
			var CT_Date_ = CT_Date_.join("/");;			
				
			Meet[0] = CT_Date_;			// 초진은 CT sim 하는날!
			MeetComment[0] = "초진";			// 초진은 CT sim 하는날!
			Start_Date.setDate(Start_Date.getDate() + etc); // 목요일로 맞추기 위해
			Start_Date.setDate(Start_Date.getDate() + 7);	// 2주 후부터 1주 단위로
			//alert(Start_Date);
			var i=1;
			
			while(Start_Date<Finish_Date){
				var SD_year = Start_Date.getFullYear()%2000;
				var SD_month = Start_Date.getMonth()+1;
				var SD_date = Start_Date.getDate();
				
				var Start_Date_ = [SD_month,SD_date,SD_year];
				var Start_Date_ = Start_Date_.join("/");
				Meet[i] = Start_Date_;
				MeetComment[i] = "";				
				Start_Date.setDate(Start_Date.getDate() + 7);
				i++;

			}
// 			치료가 끝나는 날은 따로 재진을 하지는 않는다.
// 			Meet[i] = Finish_Date_;
			
			for(var j=0; j<i; j++){
				
				var Meet_Count = j+1;
				var	row = "<tr>";
					row += "<td><center>"+Meet_Count+".</center></td>";
					row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count+"' type='MeetDate' name= 'MeetDate[]' value ='"+Meet[j]+"' ></td>"
					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' value ='"+MeetComment[j]+"'  ></td>"
 					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'MeetTime[]'></td>"
			
			
					row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
					row += "</tr>";
				$("#MeetingTable").append(row);
				$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		
			}
			
		}		
		
	);
	
		$("#addMeetingDateDouble").click(function() {
		var phys = $('#txt_physician').val();
		if(phys=="myki"){
			var fm = 3;
			var nm = 4;
		}
		if(phys=="mjlee"){
			var fm = 1;
			var nm = 3;
			
		}
		if(phys=="mhlee"){
			var fm = 3;
			var nm = 4;
			
		}
			
		Start_Date = new Date(Start_Date);
		Finish_Date = new Date(Finish_Date);
		CT_Date = new Date(CT_Date);
// 		alert(phys);
		
		var FD_year = Finish_Date.getFullYear()%2000;
		var FD_month = Finish_Date.getMonth()+1;
		var FD_date = Finish_Date.getDate();
				
		var Finish_Date_ = [FD_month,FD_date,FD_year];
		var Finish_Date_ = Finish_Date_.join("/");
					
/*
			var weekdays = prompt ('재진 요일을 입력해 주세요');
			var weekdays = prompt ('초진 요일을 입력해 주세요');
*/
			
			
			
			var Meet=[];
			var MeetComment=[];
			var SD_year = Start_Date.getFullYear()%2000;
			var SD_month = Start_Date.getMonth()+1;
			var SD_date = Start_Date.getDate();
			var SD_yoil = Start_Date.getDay();
			
			var etc = nm - SD_yoil;							// 목요일(4)
			var Start_Date_ = [SD_month,SD_date,SD_year];
			var Start_Date_ = Start_Date_.join("/");;
			
			
			var CD_year = CT_Date.getFullYear()%2000;
			var CD_month = CT_Date.getMonth()+1;
			var CD_date = CT_Date.getDate();
			var CD_yoil = CT_Date.getDay();
			
// 			var etc = nm - CD_yoil;							// 목요일(4)
			var CT_Date_ = [CD_month,CD_date,CD_year];
			var CT_Date_ = CT_Date_.join("/");;			
				
			Meet[0] = CT_Date_;			// 초진은 CT sim 하는날!
			MeetComment[0] = "초진";			// 초진은 CT sim 하는날!
			Start_Date.setDate(Start_Date.getDate() + etc); // 목요일로 맞추기 위해
			Start_Date.setDate(Start_Date.getDate() + 14);	// 2주 후부터 1주 단위로
			//alert(Start_Date);
			var i=1;
			
			while(Start_Date<Finish_Date){
				var SD_year = Start_Date.getFullYear()%2000;
				var SD_month = Start_Date.getMonth()+1;
				var SD_date = Start_Date.getDate();
				
				var Start_Date_ = [SD_month,SD_date,SD_year];
				var Start_Date_ = Start_Date_.join("/");
				Meet[i] = Start_Date_;
				MeetComment[i] = "";				
				Start_Date.setDate(Start_Date.getDate() + 14);
				i++;

			}
// 			치료가 끝나는 날은 따로 재진을 하지는 않는다.
// 			Meet[i] = Finish_Date_;
			
			for(var j=0; j<i; j++){
				
				var Meet_Count = j+1;
				var	row = "<tr>";
					row += "<td><center>"+Meet_Count+".</center></td>";
					row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count+"' type='MeetDate' name= 'MeetDate[]' value ='"+Meet[j]+"' ></td>"
					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' value ='"+MeetComment[j]+"'  ></td>"
 					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'MeetTime[]'></td>"
			
			
					row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
					row += "</tr>";
				$("#MeetingTable").append(row);
				$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		
			}
			
		}		
		
	);
	
	
	$("#addTR").click(function () {
		count++;
		
		
		var row = "<tr>";
			row += "<td>"+count+"</td>";
			row += "<td><select class = 'form-control input-sm' name='Method[]'><option value='' selected='selected'>Select</option><option value='2D Conventional'>2D Conventional</option><option value='3D Conformal'>3D Conformal</option><option value='IMRT'>IMRT</option><option value='IGRT'>IGRT</option><option value='SBRT'>SBRT</option><option value='VMAT'>VMAT</option><option value='Brachytherapy'>Brachytherapy</option><option value='Proton'>Proton</option><option value='Hyperthermia'>Hyperthermia</option><option value='Other'>Other</option></select></td>";
			row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
// 			row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Site[]' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]'></td>"
			
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"			
			
			row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
			row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
			row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";

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
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine1_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine1_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine1_Fi[i]+"'></td>"
				
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
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+C_Finish+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Start+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value ='"+P_Finish+"'></td>"
				
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
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
				
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
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine4_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine4_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine4_Fi[i]+"'></td>"
				
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
	
	$("#Routine5_F").click(function () {
		var Dose_R3 = [50, 10];
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
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXBreast[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
				
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
	
	
		$("#RoutineProstate_F").click(function () {
		var Dose_R3 = [50.4, 21.6];
		var Routine3_S = [];
		var Routine3_Fi = [];
		var Routine3_C = [];
		var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
			
		var Method = $('#Method_Prostate').val();
		var Start = $('input[name=Start_Prostate]').val();
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
			while(idx_ < fXProstate[i]){
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
			
// 			Routine3_C[i] = C_Finish;
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
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXProstate[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
				
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$("#DataTable").on("click", "button", function() {
		var r = confirm("Delete?");
		if(r == true){
		$(this).closest("tr").remove();
			count--;
			DateStart = DateStart-3;
			DateFinish = DateFinish-3;
			DateCT = DateCT-3;
		}
		else{}
	});

	$("#addOrder").click(function () {
		count_++;
		
		var row = "<tr>";
			row += "<td><center>"+count_+".</center></td>";
			row += "<td><input class = 'form-control input-sm ' id = 'OrderPicker"+CDate+"' type='OrderDate' name= 'OrderDate[]' value ='"+Order_Finish+"' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='Order' name= 'Order[]' ></td>"
			
			
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#OrderTable").append(row);
		
		$(document).find("input[name='OrderDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		CDate++;	
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.

	});
	
	
	$("#addComment").click(function () {
		count_++;
		
		var row = "<tr>";
			row += "<td><center>"+count_+".</center></td>";
			row += "<td><input class = 'form-control input-sm ' id = 'CommentPicker"+CDate+"' type='CommentDate' name= 'CommentDate[]' value ='"+Comment_Finish+"' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='Comment' name= 'Comment[]' ></td>"
			
			
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#CommentTable").append(row);
		
		$(document).find("input[name='CommentDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		CDate++;	
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.

	});
	
	$("#addHistory").click(function () {
		count_++;		
		var row = "<tr>";
			row += "<td><center>"+count_+".</center></td>";
			row += "<td><input class = 'form-control input-sm ' id = 'HistoryPicker"+CDate+"' type='HistoryDate' name= 'HistoryDate[]' value ='"+History_Finish+"' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='History' name= 'History[]' ></td>"
			
			
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#HistoryTable").append(row);
		
		$(document).find("input[name='HistoryDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     
		CDate++;			
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.
	});
	
	$("#CommentTable").on("click", "button", function() {
		var r = confirm("Delete?");
		if(r == true){
			$(this).closest("tr").remove();
			count--;
			CDate--;
		}else{}		
	});
	$("#OrderTable").on("click", "button", function() {
		var r = confirm("Delete?");
		if(r == true){
			$(this).closest("tr").remove();
			count--;
			CDate--;
		}else{}		
	});

	$("#HistoryTable").on("click", "button", function() {
		var r = confirm("Delete?");
		if(r == true){
			$(this).closest("tr").remove();
			count--;
			CDate--;
		}else{}		
	});
	
	$("#addMeet").click(function () {
		
		Meet_Count_++;
		var row = "<tr>";
			row += "<td><center>NEW. </center></td>";
			row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count_+"' type='MeetDate' name= 'MeetDate[]' value ='"+Comment_Finish+"' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' ></td>"						
			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#MeetingTable").append(row);		
		$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'m/d/y'});     		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.
	});
	$("#MeetingTable").on("click", "button", function() {
		var r = confirm("Delete?");
		if(r == true){
			$(this).closest("tr").remove();
			Meet_Count_--;
			
		}else{}
		
	});			
	
	
	
	
// 	Applying delays
	$("#DataTable").on("click", "#Plus1", function(){
		var Delay1 = $("#Delay1").val();
		if(!Delay1){Delay1=0;}
		if(Delay1_ ==0){Delay1_ = parseInt(Delay1) + 1; }else{Delay1_++; }
		document.getElementById("Delay1").value = Delay1_;
		
	});
	$("#DataTable").on("click", "#Minus1", function(){
		var Delay1 = $("#Delay1").val();
		if(Delay1_ ==0){Delay1_ = Delay1 - 1; }else{Delay1_--; }
		document.getElementById("Delay1").value = Delay1_;
		
		if(Delay1_<0){
			alert("Not -1");
			Delay1_=0;
			document.getElementById("Delay1").value = Delay1_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus2", function(){
		var Delay2 = $("#Delay2").val();
		if(!Delay2){Delay2=0;}
		if(Delay2_ ==0){Delay2_ = parseInt(Delay2) + 1; }else{Delay2_++; }
		document.getElementById("Delay2").value = Delay2_;
		
	});
	$("#DataTable").on("click", "#Minus2", function(){
		var Delay2 = $("#Delay2").val();
		if(Delay2_ ==0){Delay2_ = Delay2 - 1; }else{Delay2_--; }
		document.getElementById("Delay2").value = Delay2_;
		
		if(Delay2_<0){
			alert("Not -1");
			Delay2_=0;
			document.getElementById("Delay2").value = Delay2_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus3", function(){
		var Delay3 = $("#Delay3").val();
		if(!Delay3){Delay3=0;}
		if(Delay3_ ==0){Delay3_ = parseInt(Delay3) + 1; }else{Delay3_++; }
		document.getElementById("Delay3").value = Delay3_;
		
	});
	$("#DataTable").on("click", "#Minus3", function(){
		var Delay3 = $("#Delay3").val();
		if(Delay3_ ==0){Delay3_ = Delay3 - 1; }else{Delay3_--; }
		document.getElementById("Delay3").value = Delay3_;
		
		if(Delay3_<0){
			alert("Not -1");
			Delay3_=0;
			document.getElementById("Delay3").value = Delay3_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus4", function(){
		var Delay4 = $("#Delay4").val();
		if(!Delay4){Delay4=0;}
		if(Delay4_ ==0){Delay4_ = parseInt(Delay4) + 1; }else{Delay4_++; }
		document.getElementById("Delay4").value = Delay4_;
		
	});
	$("#DataTable").on("click", "#Minus4", function(){
		var Delay4 = $("#Delay4").val();
		if(Delay4_ ==0){Delay4_ = Delay4 - 1; }else{Delay4_--; }
		document.getElementById("Delay4").value = Delay4_;
		
		if(Delay4_<0){
			alert("Not -1");
			Delay4_=0;
			document.getElementById("Delay4").value = Delay4_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus5", function(){
		var Delay5 = $("#Delay5").val();
		if(!Delay5){Delay5=0;}
		if(Delay5_ ==0){Delay5_ = parseInt(Delay5) + 1; }else{Delay5_++; }
		document.getElementById("Delay5").value = Delay5_;
		
	});
	$("#DataTable").on("click", "#Minus5", function(){
		var Delay5 = $("#Delay5").val();
		if(Delay5_ ==0){Delay5_ = Delay5 - 1; }else{Delay5_--; }
		document.getElementById("Delay5").value = Delay5_;
		
		if(Delay5_<0){
			alert("Not -1");
			Delay5_=0;
			document.getElementById("Delay5").value = Delay5_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus6", function(){
		var Delay6 = $("#Delay6").val();
		if(!Delay6){Delay6=0;}
		if(Delay6_ ==0){Delay6_ = parseInt(Delay6) + 1; }else{Delay6_++; }
		document.getElementById("Delay6").value = Delay6_;
		
	});
	$("#DataTable").on("click", "#Minus6", function(){
		var Delay6 = $("#Delay6").val();
		if(Delay6_ ==0){Delay6_ = Delay6 - 1; }else{Delay6_--; }
		document.getElementById("Delay6").value = Delay6_;
		
		if(Delay6_<0){
			alert("Not -1");
			Delay6_=0;
			document.getElementById("Delay6").value = Delay6_;	
		}
	});
	
	$("#DataTable").on("click", "#Plus7", function(){
		var Delay7 = $("#Delay7").val();
		if(!Delay7){Delay7=0;}
		if(Delay7_ ==0){Delay7_ = parseInt(Delay7) + 1; }else{Delay7_++; }
		document.getElementById("Delay7").value = Delay7_;
		
	});
	$("#DataTable").on("click", "#Minus7", function(){
		var Delay7 = $("#Delay7").val();
		if(Delay7_ ==0){Delay7_ = Delay7 - 1; }else{Delay7_--; }
		document.getElementById("Delay7").value = Delay7_;
		
		if(Delay7_<0){
			alert("Not -1");
			Delay7_=0;
			document.getElementById("Delay7").value = Delay7_;	
		}
	});
	
});
</script> 
