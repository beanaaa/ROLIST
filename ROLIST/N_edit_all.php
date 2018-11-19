<!doctype html>
<meta charset="utf-8">

<!-- READ PHYSICIANS FROM CFG FILE -->
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
  $ext = array_pop(explode('.', $name));
  
  $uid=$_POST['username'];
  echo($uid);
  if(strcmp($uid,'tcr/')==0 or strcmp($uid,'tcr')==0 or strcmp($uid,'Tcr/')==0 or strcmp($uid,'Tcr')==0){
	  echo("This file was uploaded by tcr");
	  $name = $ttime."TCR".$name;
	  
  }
  else{
	  	  $name = $ttime.$name;

  }

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
     
	}
	else{
 		$MM_restrictGoTo = "testphpr2.php";
 		header("Location: ". $MM_restrictGoTo); 
 		require_once('Connections/test.php'); 
     

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
<title>Radiation Oncology Record</title>

<style>
 @media (min-width:1000px){
 /*
 화면의 크기가 20rem보다 작을 때 보여지는 CSS코드
 */
  .float-button-marker {position: fixed;
width: 123px;
height: 200px;
top: 357px;
left: 1010px;
margin-right: -355px;}

 
 
.float-button-update {position: fixed;
width: 43px;
height: 200px;
top: 97px;
left: 980px;
margin-right: -355px;}

.button-update {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	background-color:#61BB46;
	color:#FFF;
	border-radius:50px;
	border: 0;

	text-align:center;

	box-shadow: 2px 2px 3px #999;}
.button-update:hover {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	border: 0;

	background-color:#378EDA;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;}
	
	
/*
.float-button-close {
	position: fixed;
	width: 43px;
	height: 200px;
	top: 107px;
	right: 50%;
	margin-right: -355px;}
*/

	
.button-close {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	background-color:#61BB46;
	color:#FFF;
	border-radius:50px;
	border: 0;

	text-align:center;

	box-shadow: 2px 2px 3px #999;}
.button-close:hover {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	border: 0;

	background-color:#378EDA;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;}

 }
 @media (max-width:1000px){
 /*
 화면의 크기가 50rem보다 작을 때 보여지는 CSS코드
 */
 

 
 
.float-button-update {position: fixed;
width: 43px;
height: 200px;
top: 97px;
left: 920px;
margin-right: -355px;}

.button-update {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	background-color:#61BB46;
	color:#FFF;
	border-radius:50px;
	border: 0;

	text-align:center;

	box-shadow: 2px 2px 3px #999;}
.button-update:hover {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	border: 0;

	background-color:#378EDA;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;}
	
	
/*
.float-button-close {
	position: fixed;
	width: 43px;
	height: 200px;
	top: 107px;
	right: 50%;
	margin-right: -355px;}
*/

	
.button-close {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	background-color:#61BB46;
	color:#FFF;
	border-radius:50px;
	border: 0;

	text-align:center;

	box-shadow: 2px 2px 3px #999;}
.button-close:hover {
    width: 40px;
    height: 40px;
/*
	bottom:40px;
	right:40px;
*/
	border: 0;

	background-color:#378EDA;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;}
 }
 </style>




<style type="text/css">
	

.jbTitle {
text-align: center;
}
.jbMenu {
	text-align: center;
	background-color: white;
	padding: 0px 0px;
	width: 970px;
		box-shadow: 2px 2px 3px #999;}

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
	
	
.photostd td{
	padding: 0px;
}	
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
table.type04 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(240, 117, 119, 0.98); /* red 50 (ibm design colors) */
	margin : 5px 5px;
}
table.type04 th {
/*     width: 147px; */
    padding: 1px;
/*     font-weight: bold; */
    vertical-align: middle;
    color: #f13e5c;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type04 td {
/*     width: 349px; */
    padding: 1px;
    vertical-align: middle;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type05 {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(117, 154, 240, 0.98); /* red 50 (ibm design colors) */
	margin : 5px 5px;
}
table.type05 th {
/*     width: 147px; */
    padding: 1px;
/*     font-weight: bold; */
    vertical-align: middle;
    color: #f13e5c;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.type05 td {
/*     width: 349px; */
    padding: 1px;
    vertical-align: middle;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}

table.typeCal {
    border-collapse: collapse;
    text-align: left;
    line-height: 1.5;
    border-top: 1px solid #ccc;
    border-left: 3px solid rgba(117, 154, 240, 0.98); /* red 50 (ibm design colors) */
	margin : 5px 5px;
}
table.typeCal th {
/*     width: 147px; */
    padding: 1px;
/*     font-weight: bold; */
    vertical-align: top;
    color: #f13e5c;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
table.typeCal td {
/*     width: 349px; */
    padding: 1px;
    vertical-align: top;
    border-right: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}



/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 5px 5px;
    transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 5px;
    border: 1px solid #ccc;
    border-top: none;
}

table.out { box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }


  </style>
  



</head>


<body>
<!-- Body starts here!!! -->


<?php require_once('Connections/test.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
    $conn = new mysqli('localhost', 'username', 'password', 'dbname');

    $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

    $theValue = $conn->real_escape_string($theValue); 
    switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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


$ctNow = $_POST['CT'];

// print_r($ctNow);
$his = $_POST['H_ID'];
for($idssn = 0; $idssn<count($ctNow); $idssn++){


	$isCT = $idssn+1;
	$curs = "CT_Sim".$isCT;
	$corders = "CT_Time".$isCT;
	$ctupQuery ="Select * from TreatmentInfo where Hospital_ID like '$his'";
	$ctPrev = mysqli_fetch_assoc(mysqli_query($test, $ctupQuery));

// 	echo(strlen($ctNow[$idssn]));
	if(strlen($ctNow[$idssn])>4){

	    $myDateTime = DateTime::createFromFormat('y/n/j', $ctNow[$idssn]);
	    $newDateString = $myDateTime->format('n/j/y');
	    $CTNow =  $newDateString;
	
	
		if(strcmp($ctPrev[$curs],$CTNow)!=0){
			echo("<strong><font color=red>".$ctNow[$idssn]."의 CT 촬영 날짜가 변경되어 CT 시간 테이블이 초기화 되었습니다.</font></strong><br>");		
			$deleter = "Update TreatmentInfo set $corders='0' where Hospital_ID like '$his'";
			mysqli_query($test, $deleter);		
		}


	}
}


// Delay 구현 하는 부붙....
if ((isset($_POST["MM_update"])) && (($_POST["MM_update"] == "form1") or ($_POST["MM_update"] == "form3"))) {
	
  	$h_result = sprintf("select idx from TreatmentInfo where Hospital_ID = '%s'", $colname_Hospital_ID);
  	$h_result = mysqli_query($test, $h_result);
  	$h_idx = mysqli_result($h_result,0,"idx");
  	$ID_ = $_POST['H_ID'];

  	

	$UPDATESQLManual = sprintf("UPDATE PatientInfo SET ManualEdit='%s' WHERE Hospital_ID='$ID_'",$_POST['Manual']);
	
 	mysqli_query($test, $UPDATESQLManual);
// 	echo($UPDATESQLManual);	
// 	echo($_POST['Manual']);
	
	
	
	$query_manualEdit = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
	$editinfo = mysqli_query($test, $query_manualEdit )  ;
	$row_editinfo = mysqli_fetch_assoc($editinfo);




  $manuals = $_POST['Manual'];

  //   Method나 Linac이 비어 있다면 이전 엔트리를 복사한다.
  $Method_ = $_POST['Method'];
  for($idmtd=1;$idmtd<count($Method_);$idmtd++){
	  if(strlen(trim($Method_[$idmtd]))==0){
		$Method_[$idmtd] = $Method_[$idmtd-1];
	  }
  }
  $Linac_ = $_POST['Linac'];
  for($idmtd=1;$idmtd<count($Linac_);$idmtd++){
	if(strlen(trim($Linac_[$idmtd]))==0){
		$Linac_[$idmtd] = $Linac_[$idmtd-1];
	}
}

  $Site_ = $_POST['Site'];

  $Dose_ = $_POST['Dose'];
  $Fx_ = $_POST['Fx'];
	
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
	$RecordsetTelegram = mysqli_query($test, $query_Telegram )  ;
	$row_RecordsetTelegram       = mysqli_fetch_assoc($RecordsetTelegram);

	




	




	if($row_RecordsetTelegram[CurrentStatus]!=($_POST['CurrentStatus_menu'] )){
		if(($_POST['CurrentStatus_menu'] )==0){
			$curStat = "Active";			
		}
		elseif(($_POST['CurrentStatus_menu'] )==1){
			$curStat = "Finish";					
		}
		elseif(($_POST['CurrentStatus_menu'] )==2){
			$curStat = "Stop";			
		}
		elseif(($_POST['CurrentStatus_menu'] )==3){
			$curStat = "Drop";			
		}
		elseif(($_POST['CurrentStatus_menu'] )==4){
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

	$UPDATESQL = sprintf("UPDATE TreatmentInfo SET  Modality_var1='%s', Modality_var2='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_modality'] ),($_POST['txt_chemo'] ));
	$UPDATESQL21 = sprintf("UPDATE ClinicalInfo SET  TumorMarker='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryTumor'] ));
    $Result41 = mysqli_query($test, $UPDATESQL21);   
    
	$UPDATESQL22 = sprintf("UPDATE ClinicalInfo SET  chemo='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryChemo'] ));
    $Result42 = mysqli_query($test, $UPDATESQL22);    

	$UPDATESQL23 = sprintf("UPDATE ClinicalInfo SET   Radio='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryRadio'] ));
    $Result43 = mysqli_query($test, $UPDATESQL23);    
    
	$UPDATESQL24 = sprintf("UPDATE ClinicalInfo SET   Pathol='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryPathol']));	
    $Result44 = mysqli_query($test, $UPDATESQL24);
	
	$UPDATESQL25 = sprintf("UPDATE ClinicalInfo SET   Op='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryOp'] ));
    $Result45 = mysqli_query($test, $UPDATESQL25);    
	
	$UPDATESQL26 = sprintf("UPDATE ClinicalInfo SET   RadioHistory='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryRadioHistory'] ));
    $Result46 = mysqli_query($test, $UPDATESQL26);
	
	$UPDATESQL26 = sprintf("UPDATE ClinicalInfo SET   ConsultTemplate='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryConsult'] ));
    $Result46 = mysqli_query($test, $UPDATESQL26);
	
	$UPDATESQL27 = sprintf("UPDATE ClinicalInfo SET   ConsultReply='%s' WHERE Hospital_ID='$ID_'", ($_POST['txt_ClinicalHistoryReply'] ));
    $Result46 = mysqli_query($test, $UPDATESQL27);
				  


mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");

// 	echo(GetSQLValueString($_POST['txt_name'] ));
	$Manuals = $_POST['Manual'];
	if(strlen($Manuals)==0){
		$Manuals = 0;
	}
                       $curstats = $_POST['CurrentStatus_menu'];
                       if(strlen($curstats)==0){
	                       $curstats = "0";
                       }

	$pAge = $_POST['txt_age'];
	if(strlen($_POST['txt_age'])==0){
		$pAge = 0;
	}
	$UPDATESQL1 = sprintf("UPDATE PatientInfo SET   Sex='%s', Age=%s, KorName='%s', dateOfBirth='%s', CurrentStatus=%s, ManualEdit=$Manuals WHERE Hospital_ID like '$ID_'",
                       ($_POST['txt_search_sex']),
                       ($pAge),
                       ($_POST['txt_name']),
                       ($_POST['txt_birth']),
                       ($curstats),
                       ($_POST['NextStatus_menu']),
                       ($_POST['txt_pStatus'])
                                        	     
                       );                           
                       $curstats = $_POST['CurrentStatus_menu'];
                       if(strlen($curstats)==0){
	                       $curstats = "0";
                       }
    $UPDATESQL2 = sprintf("UPDATE TreatmentInfo SET   Clinic='%s', diagnosis='%s', purpose='%s', CurrentStatus='%s', px='%s', wbc='%s', ast='%s', primarysite='%s', subsite = '%s', subsiteDet = '%s', pathol='%s', grade='%s', stage='%s', tnm='%s', physician ='%s',planner ='%s', dose_sum='$All_Dose', Fx_sum = '$All_Fx' WHERE Hospital_ID like '$ID_'",
                       ($_POST['txt_clinic'] ),
                       ($_POST['txt_doctor'] ),
                       ($_POST['purpose_menu'] ),
                       ($curstats ),
                       
                       ($_POST['txt_px'] ),
                       ($_POST['txt_wbc'] ),
                       ($_POST['txt_ast'] ),
                       ($_POST['primary_menu'] ),
                       ($_POST['sub_site'] ),
                       ($_POST['sub_siteDet'] ),
                       ($_POST['pathology_menu'] ),
                       ($_POST['grade_menu'] ),
                       ($_POST['stage_menu'] ),
                       ($_POST['txt_tnmstage'] ),
					   ($_POST['txt_physician'] ),
					   ($_POST['txt_planner'] ));
					   					   

    $Result1 = mysqli_query($test, $UPDATESQL);
    $Result2 = mysqli_query($test, $UPDATESQL1);
    $Result3 = mysqli_query($test, $UPDATESQL2);

    
	$planStat = $_POST['StatusCheck'];
	
	
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
		$UPDATESQL = "UPDATE TreatmentInfo SET  $tName='$TsI', $pName='$PsI', $aName='$AsI' WHERE Hospital_ID like '$ID_'";
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
			// echo("<br>");
			// echo($val);
			// echo("<br>");
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

		$CTChecker = sprintf("Select %s from TreatmentInfo where Hospital_ID like  %s", $CTCurs, $colname_Hospital_ID);
		$PrevCT = mysqli_query($test, $CTChecker )  ;
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
 			"UPDATE TreatmentInfo SET $Q_RT_start = '$Start_[$i]', RT_start_f = '$Start_[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]',  $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$CT_[$i]', CT_Sim_f = '$CT_[$i]', $Q_Finish = '$Finish_[$i]', RT_fin_f = '$Finish_[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]',  $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");

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

	 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '$Start_Date[$i]', RT_start_f = '$Start_Date[$i]', $Q_dose = '$Dose_[$i]', $Q_Fx = '$Fx_[$i]',  $CEupdate $Q_method = '$Method_[$i]', RT_method_f = '$Method_[$i]', idx = '$idx_', $Q_CT = '$Start_CT[$i]', CT_Sim_f = '$Start_CT[$i]', $Q_Finish = '$Finish_Date[$i]', RT_fin_f = '$Finish_Date[$i]', $Q_Linac = '$Linac_[$i]', Linac_f = '$Linac_[$i]',  $Q_Site='$Site_[$i]', site_f = '$Site_[$i]'  WHERE Hospital_ID = '$ID_'");


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
		}
		if (strcmp($row_RecordsetTelegram[$Q_CT],$Start_CT[$i])!=0 or $row_RecordsetTelegram[idx]<$idx_){
			$preD = substr($row_RecordsetTelegram[$Q_CT],0,strlen($row_RecordsetTelegram[$Q_CT])-3);
			$postD = substr($Start_CT[$i],0,strlen($Start_CT[$i])-3);			
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

			
		}



		if(strlen($titleSum)>0){

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
		
 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '', $Q_dose = '', $Q_Fx = '', $Q_method = '', $Q_CT = '', $Q_Finish = '', $Q_Linac = '', $Q_Delay='', $Q_Site='', $Q_CT=''  WHERE Hospital_ID = '$ID_'");
		$UPDATE_Result3 = mysqli_query($test, $UPDATESQL3);			
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
		$insertMeeting = sprintf("INSERT INTO MeetingList (Hospital_ID, Memo, Date, idx) VALUES ('$ID_', '$Meet[$jj]', %s, $j)", ($MeetDate[$jj]  ));
		//echo $insertComment;
		$insertQuery = mysqli_query($test, $insertMeeting );
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
//         echo "$CommentDate[$idss]";
    }
  }




// 	$tVals = $idx_;
	
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
		
 		$UPDATESQL3 = sprintf("UPDATE TreatmentInfo SET $Q_RT_start = '', $Q_dose = '0', $Q_Fx = '0', $Q_method = '', $Q_CT = '', $Q_Finish = '', $Q_Linac = '', $Q_Delay='0', $Q_Site='', $Q_CT=''  WHERE Hospital_ID like '$ID_'");
		$UPDATE_Result3 = mysqli_query($test, $UPDATESQL3);			
	}














//   echo(GetSQLValueString($CommentDate[0]  ));








	$C_Plan = count($Comment);
	$C_idx = 0;
	$deleteComment = sprintf("DELETE FROM MemoTemp WHERE Hospital_ID = '$ID_'");
	$prevNumComment = sprintf("Select * FROM MemoTemp WHERE Hospital_ID = '$ID_'");
	$nRows = mysqli_num_rows(mysqli_query($test, $prevNumComment)); 
	mysqli_query($test, $deleteComment);
	for($j = 1; $j<=$C_Plan; $j++){
		$jj = $j-1;
		$percentrecap = $Comment[$jj];
		for ($counter=0;$counter<strlen($Comment[$jj]);$counter++){
			if(strcmp(substr($Comment[$jj],$counter,1),'%')==0){
				$percentrecap = substr($Comment[$jj],0,$counter).'%'.substr($Comment[$jj],$counter,500);
			}
		}
		
		
		
		
		$insertComment = sprintf("INSERT INTO MemoTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$percentrecap', '%s', $j)", ($CommentDate[$jj]  ));

		$insertQuery = mysqli_query($test, $insertComment );



		if($j>$nRows){
			$Today_Date = Date("n/j/y");    
			$uid=$_POST['username'];
			$insertComment2 = str_replace("'", "", $insertComment);
			$LogQuery = "INSERT INTO Log (date1, content, author, Hospital_ID) VALUES ('$Today_Date','$insertComment2','$uid','$ID_')";
// 			echo($LogQuery);
			mysqli_query($test, $LogQuery);
			
		}





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
	$RecordsetNumOrder = mysqli_query($test, $query_numOrder )  ;
	$numOrder       = mysqli_fetch_assoc($RecordsetNumOrder);
	
	for($j = 1; $j<=$C_Order; $j++){
		$query_numOrder = sprintf("Update TreatmentInfo Set NumOrder = '$C_Order' where Hospital_ID like '%s'", $_POST['H_ID']);
		mysqli_query($test, $query_numOrder);
		$jj = $j-1;
		$percentrecap = $Order[$jj];
		for ($counter=0;$counter<strlen($Order[$jj]);$counter++){
			if(strcmp(substr($Order[$jj],$counter,1),'%')==0){
				$percentrecap = substr($Order[$jj],0,$counter).'%'.substr($Order[$jj],$counter,500);
			}
		}
		$inserter = urlencode($Order[$jj]);
		$insertOrder = sprintf("INSERT INTO OrderTemp (Hospital_ID, Memo1, Date1, idx) VALUES ('$ID_', '$percentrecap', '%s', $j)", ($OrderDate[$jj]  ));
		$insertQuery = mysqli_query($test, $insertOrder );
		if($insertQuery == TRUE){
			$C_idxOrder = $C_idxOrder + 1;
		}
	}

	if (strcmp($numOrder[NumOrder],$C_Order)!=0){
// 		Change TCRNOTICE to 1 if MD's Order was added. To appear in Top of the RTP page (Action required)
		mysqli_query($test, "Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $ID_");
		
	}
	
	$ii=0;  	
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
$his = $_POST['H_ID'];
// echo($his);



$newcourse = 1000;	
$newcourse = $_POST['newcourse'];
$prevcourse = $_POST['prevcourse'];
// echo("NEW COURSE: ".$newcourse);

if(strcmp($newcourse,'to')==0){
// 	현재의 course id를 부여한다.


	$his = $_POST['hf_edit'];
	$olderHistory = "select * from TreatmentInfoHist where Hospital_ID like '$his'";
	$olders = mysqli_num_rows(mysqli_query($test, $olderHistory));
	if($olders !=0){
		 $maxvalquery = "select max(courseid)  AS maxhist from TreatmentInfoHist where Hospital_ID like '$his'";
		 $numhist = (mysqli_fetch_assoc(mysqli_query($test, $maxvalquery)));
// 		 print_r($numhist[maxhist]);
		 $olders = $numhist[maxhist];
	}
	
	$curcourse = $olders+1;
	$coursequery = "update TreatmentInfo set courseid=$curcourse where Hospital_ID like '$his'";
	mysqli_query($test, $coursequery);
	
	$coursequery = "update ClinicalInfo set courseid=$curcourse where Hospital_ID like '$his'";
	mysqli_query($test, $coursequery);

	$historyquery = "insert into TreatmentInfoHist select * from TreatmentInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "insert into ClinicalInfoHist select * from ClinicalInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "delete from TreatmentInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "Insert into TreatmentInfo (Hospital_ID) values ('$his')";
	mysqli_query($test, $historyquery);
	

	$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = '%s'",$colname_Hospital_ID);
	$clinicalinfo = mysqli_query($test, $query_clinicalinfo )  ;
	$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
	$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);


	
    if(strlen($row_clinicalinfo['RadioHistory'])>1){
      $rthistcourse = trim($row_clinicalinfo['RadioHistory'])."&nbsp;\r".$prevcourse;
    }
    else{
      $rthistcourse = $prevcourse;
    }
	
	$rthistoryquery = "update ClinicalInfo Set RadioHistory='$rthistcourse' where Hospital_ID like '$his'";
	mysqli_query($test, $rthistoryquery);
// 	echo($rthistoryquery);
	
	
	$historyquery = "Update TreatmentInfo Set idx='0' where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
// 	echo($row_clinicalinfo['RadioHistory']);
	}
if(strcmp($newcourse,'th')==0){

// 	현재의 course id를 부여한다.

	$his = $_POST['hf_edit'];
	$olderHistory = "select * from TreatmentInfoHist where Hospital_ID like '$his'";
	$olders = mysqli_num_rows(mysqli_query($test, $olderHistory));
	if($olders !=0){
		 $maxvalquery = "select max(courseid)  AS maxhist from TreatmentInfoHist where Hospital_ID like '$his'";
		 $numhist = (mysqli_fetch_assoc(mysqli_query($test, $maxvalquery)));
// 		 print_r($numhist[maxhist]);
		 $olders = $numhist[maxhist];
	}
	
	$curcourse = $olders+1;
	$coursequery = "update TreatmentInfo set courseid=$curcourse where Hospital_ID like '$his'";
	mysqli_query($test, $coursequery);
	$coursequery = "update ClinicalInfo set courseid=$curcourse where Hospital_ID like '$his'";
	mysqli_query($test, $coursequery);

	$historyquery = "insert into TreatmentInfoHist select * from TreatmentInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "insert into ClinicalInfoHist select * from ClinicalInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "delete from TreatmentInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "Insert into TreatmentInfo (Hospital_ID) values ('$his')";
	mysqli_query($test, $historyquery);
	$historyquery = "Update TreatmentInfo Set idx='0' whre Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);

	$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
	$clinicalinfo = mysqli_query($test, $query_clinicalinfo )  ;
	$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
	$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);




    if(strlen($row_clinicalinfo['RadioHistory'])>1){
      $rthistcourse = trim($row_clinicalinfo['RadioHistory'])."&nbsp;\r".$prevcourse;
    }
    else{
      $rthistcourse = $prevcourse;
    }
    
	
	$rthistoryquery = "update ClinicalInfo Set RadioHistory='$rthistcourse' where Hospital_ID like '$his'";



		
	$historyquery = "delete from ClinicalInfo where Hospital_ID like '$his'";
	mysqli_query($test, $historyquery);
	
	$historyquery = "Insert into ClinicalInfo (Hospital_ID) values ('$his')";
	mysqli_query($test, $historyquery);
	mysqli_query($test, $rthistoryquery);

// 	echo("<br>".$row_clinicalinfo[RadioHistory]."<br>");
	
/*
	 
	$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
	$clinicalinfo = mysqli_query($test, $query_clinicalinfo )  ;
	$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
	$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);
	
	echo($row_clinicalinfo['RadioHistory']);
*/
}


// unset($newcourse);















 
$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$clinicalinfo = mysqli_query($test, $query_clinicalinfo )  ;
$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);

 
$query_patientinfo = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$patientinfo = mysqli_query($test, $query_patientinfo )  ;
$row_patientinfo = mysqli_fetch_assoc($patientinfo);
$totalRows_patientinfo = mysqli_num_rows($patientinfo);
 
$query_treatmentinfo = sprintf("SELECT * FROM TreatmentInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$treatmentinfo = mysqli_query($test, $query_treatmentinfo )  ;
$row_treatmentinfo = mysqli_fetch_assoc($treatmentinfo);
$totalRows_treatmentinfo = mysqli_num_rows($treatmentinfo);

$query_TempMemo = sprintf("SELECT * FROM MemoTemp WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$MemoInfo = mysqli_query($test, $query_TempMemo )  ;
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

$query_TempOrder = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$OrderInfo = mysqli_query($test, $query_TempOrder )  ;
$row_Orderinfo = mysqli_fetch_assoc($OrderInfo);
$total_Orderinfo = mysqli_num_rows($OrderInfo);


// AUTO REPLY

// Reply letter

$replytemplate = $_POST['txt_ClinicalHistoryReply'];

if(strlen($row_treatmentinfo[pathol])>0){ 
	$replypathol = $row_treatmentinfo[pathol];
}
else{
	$replypathol = " [_BLANK_] ";	
}

if(strlen($row_treatmentinfo[tnm])>0){ 
	$replytnm = $row_treatmentinfo[tnm];
}
else{
	$replytnm = " [_BLANK_] ";	
}

if(strlen($row_treatmentinfo[purpose])>0){ 
	if(strcmp($row_treatmentinfo['purpose'],'Definitive')==0){
	$replypurpose = "Radical";		
	}
	else{ 
		$replypurpose = $row_treatmentinfo['purpose'];
	}
}
else{
	$replypurpose = " [_BLANK_] ";	
}
if(strlen($row_treatmentinfo[CT_Ce1])>0){ 
	$enhance = " (".$row_treatmentinfo[CT_Ce1].")";
}
else{
	$enhance = "";	
}


$CCRTs = $row_treatmentinfo['Modality_var1'];




$daily = array('일','월','화','수','목','금','토');

$starts = date("Y.m.d", strtotime( $row_treatmentinfo['CT_Sim1'] ) );
$lastCm2 = date("Ymd",strtotime($row_treatmentinfo['CT_Sim1']));
$dateyoilct = date('w',strtotime($lastCm2)); //0 ~ 6 숫자 반환


$sims = date("Y.m.d", strtotime( $row_treatmentinfo['RT_start1'] ) );
$lastCm2 = date("Ymd",strtotime($row_treatmentinfo['RT_start1']));
$dateyoilst = date('w',strtotime($lastCm2)); //0 ~ 6 숫자 반환
// $dateyoilst = date('w',strtotime($row_treatmentinfo['RT_start1'])); //0 ~ 6 숫자 반환



$replytd = $row_treatmentinfo['dose_sum'];
$replyfx = $row_treatmentinfo['Fx_sum'];
$replysite = $row_treatmentinfo['subsite'];

$replytdBRST = $row_treatmentinfo['dose1'];
$replyfxBRST = $row_treatmentinfo['Fx1'];

$replytdBRST2 = $row_treatmentinfo['dose2'];
$replyfxBRST2 = $row_treatmentinfo['Fx2'];



if(strlen($CCRTs)>1){
	$RTs = "CCRT";
}
else{
	$RTs = "RT";
}
$autofillchk = $_POST['autofiller'];

if(strcmp($autofillchk,'1')==0 and strcmp($row_treatmentinfo['physician'],'myki')==0){

if(strlen($replytemplate)==0 and strcmp($row_treatmentinfo[primarysite],'BRST')==0){
	$fxstr1 = "Gy/".$replyfxBRST."회";
	$fxstr2 = "Gy/".$replyfxBRST2."회";
	$breastDir = substr($replysite,strlen($replysite)-3,100);
	$replystr = "
의뢰 감사드립니다.
$breastDir breast cancer ($replypathol, $replytnm) 환자로 $replypurpose $RTs 계획하겠습니다.
방사선치료는 $breastDir breast $replytdBRST $fxstr1 + tumor bed boost $replytdBRST2 $fxstr2 시행하겠습니다.

면담: $starts ($daily[$dateyoilct])
CT-simulation$enhance: $starts ($daily[$dateyoilct])
RT start: $sims ($daily[$dateyoilst])

감사합니다.";
}
else{
	$fxstr = "Gy/".$replyfx."회";
	$replystr = "
의뢰 감사드립니다.
$replysite ($replypathol, $replytnm) 환자로 $replypurpose $RTs 계획하겠습니다.
방사선치료는 $replytd $fxstr 조사 예정이나 환자 상태에 따라 변경될 수 있습니다.

면담: $starts ($daily[$dateyoilct])
CT-simulation: $starts ($daily[$dateyoilct])
RT start: $sims ($daily[$dateyoilst])

감사합니다.";
	
}
$repls = $row_clinicalinfo['ConsultReply'].$replystr;
$UPDATESQL27 = sprintf("UPDATE ClinicalInfo SET   ConsultReply='$repls' WHERE Hospital_ID='$ID_'");
$Result46 = mysqli_query($test, $UPDATESQL27);

}



if(strcmp($autofillchk,'1')==0 and strcmp($row_treatmentinfo['physician'],'mhlee')==0){

		


		$ops = explode("\n", $row_clinicalinfo['Op']);
		
		$histcount = 0;
		for($idhist = 0; $idhist<count($ops); $idhist++){
			$prevhist[$histcount] = $ops[$idhist];
			$histcount++;
		}
		
		$chemos = explode("\n", $row_clinicalinfo['chemo']);
		for($idhist = 0; $idhist<count($chemos); $idhist++){
			$prevhist[$histcount] = $chemos[$idhist];
			$histcount++;
		}
		
		
		$rtss = explode("\n", $row_clinicalinfo['RadioHistory']);
		for($idhist = 0; $idhist<count($rtss); $idhist++){
			$prevhist[$histcount] = $rtss[$idhist];
			$histcount++;
		}
		
		
		

		for($idh=0;$idh<count($prevhist);$idh++){
			
			
			$opstr = $prevhist[$idh];
		  	for($idw=0;$idw<strlen($opstr);$idw++){
			  	if(strcmp(substr($opstr,$idw,2),'20')==0){
				  	for($idsw=0;$idsw<strlen($opstr);$idsw++){
					  	if(strcmp(substr($opstr,$idw+$idsw,1),'.')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'0')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'1')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'2')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'3')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'4')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'5')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'6')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'7')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'8')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'9')!=0 and strcmp(substr($opstr,$idw+$idsw,1),' ')!=0){
						  	break;
					  	}
				  	}
				  	$ondate = substr($opstr,$idw,$idsw);
				  	$hist[$ondate] = $opstr;
				  	break;
			  	}
		  	}  
		}

		ksort($hist);
		$histkeys = (array_keys($hist));
		for($idh=0;$idh<count($histkeys);$idh++){
			$replystr = $replystr."\n".$hist[$histkeys[$idh]];
		}
		
		$cGy = ((float)$replytd)*100;
		$fxdiv = $replyfx."회";
	$replystr = $replystr."
방사선치료는 총 $fxdiv $cGy cGy 조사 예정이나 환자 상태 및 치료설계로 인해 변경될 수 있습니다.
환자와 면담하여 치료과정 및 횟수,치료 부작용 관련하여 설명하겠습니다.
	
CT-simulation: $starts ($daily[$dateyoilct])
치료시작 : $sims ($daily[$dateyoilst])

방사선종양학과 이주혜 배상
";

$subs = "의뢰 감사드립니다.

# $replysite ca. $replytnm";
$replystr = $subs.$replystr;

// echo(nl2br ($replystr));
$repls = $row_clinicalinfo['ConsultReply'].$replystr;
$UPDATESQL27 = sprintf("UPDATE ClinicalInfo SET   ConsultReply='$repls' WHERE Hospital_ID='$ID_'");
$Result46 = mysqli_query($test, $UPDATESQL27);

}


$query_clinicalinfo = sprintf("SELECT * FROM ClinicalInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$clinicalinfo = mysqli_query($test, $query_clinicalinfo )  ;
$row_clinicalinfo = mysqli_fetch_assoc($clinicalinfo);
$totalRows_clinicalinfo = mysqli_num_rows($clinicalinfo);


$query_patientinfo = sprintf("SELECT * FROM PatientInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$patientinfo = mysqli_query($test, $query_patientinfo )  ;
$row_patientinfo = mysqli_fetch_assoc($patientinfo);
$totalRows_patientinfo = mysqli_num_rows($patientinfo);


$query_treatmentinfo = sprintf("SELECT * FROM TreatmentInfo WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$treatmentinfo = mysqli_query($test, $query_treatmentinfo )  ;
$row_treatmentinfo = mysqli_fetch_assoc($treatmentinfo);
$totalRows_treatmentinfo = mysqli_num_rows($treatmentinfo);

$query_TempMemo = sprintf("SELECT * FROM MemoTemp WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$MemoInfo = mysqli_query($test, $query_TempMemo )  ;
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

$query_TempOrder = sprintf("SELECT * FROM OrderTemp WHERE Hospital_ID = '%s'", $colname_Hospital_ID);
$OrderInfo = mysqli_query($test, $query_TempOrder )  ;
$row_Orderinfo = mysqli_fetch_assoc($OrderInfo);
$total_Orderinfo = mysqli_num_rows($OrderInfo);





// Compute prescription


	$IdChk = $colname_Hospital_ID;
	$query_Recordset1 = mysqli_query($test, "SELECT * FROM TreatmentInfo where Hospital_ID like $IdChk");
	$numCTs = mysqli_fetch_array($query_Recordset1);	
	for($idCTs = 0; $idCTs<$numCTs[idx]; $idCTs++){
		$Label = $idCTs+1;
		$CTdatLabel = "CT_Sim".$Label;
		$CTDat = $numCTs[$CTdatLabel];
		if(strlen($CTDat)>5){
			$query_RecordsetCTDat = "SELECT * FROM TreatmentInfo where (CT_Sim1 like '$CTDat' or CT_Sim2 like '$CTDat' or CT_Sim3 like '$CTDat' or CT_Sim4 like '$CTDat' or CT_Sim5 like '$CTDat' or CT_Sim6 like '$CTDat' or CT_Sim7 like '$CTDat')";
			$NumCTLabel = mysqli_query($test, $query_RecordsetCTDat )  ;
			$NumCTs = mysqli_num_rows($NumCTLabel);
      $chCT = date("Y-m-d",strtotime($CTDat));
			if($NumCTs>8 and strtotime($CTDat)> strtotime(date("Y-m-d", strtotime("-1 day", time())))){
				echo("<strong><font color=red> $chCT 의 시뮬레이션이 최대 8명을 초과하였습니다(현재 $NumCTs 명, <a href=http://10.14.26.18/simschedule.php target=_blank>스케쥴러</a>를 확인 하세요!)</font></strong><br>"); 
// 				echo("<br>");
			}
		}
	}
	$IdChk = $colname_Hospital_ID;
	$query_Recordset1 = mysqli_query($test, "SELECT * FROM TreatmentInfo where Hospital_ID like $IdChk");
	$numCTs = mysqli_fetch_array($query_Recordset1);	
	for($idCTs = 0; $idCTs<1; $idCTs++){
		$Label = $idCTs+1;
		$CTdatLabel = "RT_start1";
		$CTDat = $numCTs[$CTdatLabel];
		if(strlen($CTDat)>5){
			$query_RecordsetCTDat = "SELECT * FROM TreatmentInfo where (Linac1 like '%Versa%' and RT_start1 like '$CTDat')";
			$NumCTLabel = mysqli_query($test, $query_RecordsetCTDat )  ;
			$NumCTs = mysqli_num_rows($NumCTLabel);
			$numStartVersa = $NumCTs;

      $chCT = date("Y-m-d",strtotime($CTDat));
			
			if($NumCTs>4 and strtotime($CTDat)> strtotime(date("Y-m-d", strtotime("-1 day", time())))){
				echo("<strong><font color=red>&nbsp;참고, Room1) $chCT 의  신환 최대 4명을 초과하였습니다(현재 $NumCTs 명)</font></strong><br>"); 
// 				echo("<br>");
			}
		}
	}
	$IdChk = $colname_Hospital_ID;
	$query_Recordset1 = mysqli_query($test, "SELECT * FROM TreatmentInfo where Hospital_ID like $IdChk");
	$numCTs = mysqli_fetch_array($query_Recordset1);	
	for($idCTs = 0; $idCTs<1; $idCTs++){
		$Label = $idCTs+1;
		$CTdatLabel = "RT_start1";
		$CTDat = $numCTs[$CTdatLabel];
		if(strlen($CTDat)>5){
			$query_RecordsetCTDat = "SELECT * FROM TreatmentInfo where ((Linac1 like '%ix%' and RT_start1 like '$CTDat') or (Linac1 like '%iX%' and RT_start1 like '$CTDat') or (Linac1 like '%IX%' and RT_start1 like '$CTDat') or (Linac1 like '%Ix%' and RT_start1 like '$CTDat'))";

			$NumCTLabel = mysqli_query($test, $query_RecordsetCTDat )  ;
			$NumCTs = mysqli_num_rows($NumCTLabel);
			$numStartIx = $NumCTs;

      $chCT = date("Y-m-d",strtotime($CTDat));

			if($numStartIx>4 and strtotime($CTDat)> strtotime(date("Y-m-d", strtotime("-1 day", time())))){
				echo("<strong><font color=red>&nbsp;참고, Room2) $chCT 의   신환 최대 4명을 초과하였습니다(현재 $NumCTs 명)</font></strong>"); 
				echo("<br>");
			}
		}
	}

	$IdChk = $colname_Hospital_ID;
	$query_Recordset1 = mysqli_query($test, "SELECT * FROM TreatmentInfo where Hospital_ID like $IdChk");
	$numCTs = mysqli_fetch_array($query_Recordset1);	
	for($idCTs = 0; $idCTs<1; $idCTs++){
		$Label = $idCTs+1;
		$CTdatLabel = "RT_start1";
		$CTDat = $numCTs[$CTdatLabel];
		if(strlen($CTDat)>5){
			$query_RecordsetCTDat = "SELECT * FROM TreatmentInfo where ((Linac1 like '%inf%' and RT_start1 like '$CTDat') or (Linac1 like '%Inf%' and RT_start1 like '$CTDat'))";

			$NumCTLabel = mysqli_query($test, $query_RecordsetCTDat )  ;
			$NumCTs = mysqli_num_rows($NumCTLabel);
			$numStartInfinity = $NumCTs;
      $chCT = date("Y-m-d",strtotime($CTDat));
			
			if($NumCTs>4 and strtotime($CTDat)> strtotime(date("Y-m-d", strtotime("-1 day", time())))){
				echo("<strong><font color=red>&nbsp;참고) $chCT 의 Infinity 신환 최대치 4명을 초과하였습니다(현재 $NumCTs 명)</font></strong>"); 
				echo("<br>");
			}
		}
	}




?>

<!-- Attachment -->



<?php
	

	
	
	$fxDose = (float)$row_treatmentinfo['dose_sum']/(float)$row_treatmentinfo['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);            
	$prevst = $row_treatmentinfo[RT_start1];
	$preved = $row_treatmentinfo[RT_fin_f];
	$prevpp = $row_treatmentinfo['purpose'];
	$prevsite = $row_treatmentinfo['subsite'];
	$prevds = $row_treatmentinfo['dose_sum'];
	$prevfx = $fxDoseStr; //평균 dose
	$prevfd = $row_treatmentinfo['Fx_sum'];

	$sts = (date('Y.m.d',strtotime($row_treatmentinfo[RT_start1])));
	$eds = (date('Y.m.d',strtotime($row_treatmentinfo[RT_fin_f])));
	$CourseRemarker2 = $row_treatmentinfo['purpose']." RT to ".$row_treatmentinfo['subsite']." ".$row_treatmentinfo['dose_sum']." Gy/".$row_treatmentinfo['Fx_sum']." fx. @PNUYH (".$sts." - ".$eds.")";

	$cropN = 100;
	

          ?>



<?php

$olderHistory = "select * from TreatmentInfoHist where Hospital_ID like '$colname_Hospital_ID'";
// echo($olderHistory);
$olders = mysqli_num_rows(mysqli_query($test, $olderHistory));
$olders2 =$olders;

$query_Telegram = "select * from TreatmentInfo where Hospital_ID ='".$row_patientinfo['Hospital_ID']."'";
// 	echo($query_Telegram);
$RecordsetTelegram = mysqli_query($test, $query_Telegram )  ;
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


<a onclick="this.nextSibling.style.display=(this.nextSibling.style.display=='none')?'block':'none';" href="javascript:void(0)"> 
&nbsp;<strong>COURSE EDITOR (Click to open/close) <?php if($olders>0){echo("<font color=red>".$olders2. " previous courses</font>");} ?></strong>
</a><div style="DISPLAY: none">
&nbsp;<strong><font color=red>아래 버튼을 클릭하여 새로운 COURSE를 생성합니다. 이전 COURSE는 수정이 불가능해 지고 스케쥴러에서 사라집니다. 실수하신 경우 담당자가 수정할 수 있으니 너무 놀라지 마세요.</font></strong>

<table><tr>
		<td width="50px" scope="row">
			<form id="fornc" name="fornc" method="POST" action="N_edit_all.php">		  	
		      <input class = "btn btn-default" type="submit" name="btn_edit" id="btn_edit" value="New-course (Treatment only)" />
		      <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
		      <input type="hidden" name="hf_edit" id = "hf_edit" value="<?php echo $row_patientinfo['Hospital_ID']; ?>" />
		      <input type="hidden" name="prevcourse" id = "prevcourse" value="<?php echo $CourseRemarker2; ?>" />
		      <input type="hidden" name="newcourse" id = "newcourse" value="to" />
	      </form>				    	    	    
		</td>
		<td width="50px" scope="row">
			<form id="fornc" name="formd" method="POST" action="N_edit_all.php">		  	
		      <input class = "btn btn-default" type="submit" name="btn_edit" id="btn_edit" value="New-course (Treatment/History)" />
		      <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
		      <input type="hidden" name="hf_edit" id = "hf_edit" value="<?php echo $row_patientinfo['Hospital_ID']; ?>" />
		      <input type="hidden" name="prevcourse" id = "prevcourse" value="<?php echo $CourseRemarker2; ?>" />
		      
		      <input type="hidden" name="newcourse" id = "newcourse" value="th" />
		      
	      </form>				    	    	    
		</td>
		
			

<?php
$olderHistory = "select * from TreatmentInfoHist where Hospital_ID like '$colname_Hospital_ID'";
// echo($olderHistory);
$olders = mysqli_num_rows(mysqli_query($test, $olderHistory));
$curcourse = $olders;
// echo($olders);
if($olders>0){ 
echo("<td>&nbsp; Previous courses: &nbsp;</td>");
}
for($idcourse = 0; $idcourse<$curcourse;$idcourse++){
	$curcourses = $idcourse+1;
	$selquery = "select all from TreatmentInfo where Hospital_ID like '$his' and courseid like '$curcourses'";
// 	echo()
	$cids = intval($curcourses);
	$courseMarker = "C".$cids;
    echo "<td bgcolor=$bgcolorF>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_history.php>";                               
    echo "<input class = 'btn btn-default'  type=submit name=btn_hist id=btn_hist value=$courseMarker>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser >";            
    echo "<input name=hf_edit type=hidden id=hf_edit value= $colname_Hospital_ID >";      
    echo "<input name=H_ID type=hidden id=H_ID value= $colname_Hospital_ID >";      
    echo "<input name=courseid type=hidden id=courseid value= $cids ></form></td>";      

}

	
	?>
	




</tr>




</table>

</div>



<table width = "1000px">
	<tr>
		<td>

<form id="form1" name="form1" method="POST" action="N_edit_all.php">
<form id="formReply" name="formReply" method="POST" action="N_edit_all.php">

  	<table width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
    	<br>
		<td valign="middle" width="810px" scope="row" colspan="2" height="60" valign="middle"> 
			<p style="font-family: arial; font-size:24px; color: #252e6a">&nbsp;<strong>Radiation Oncology Record</strong></p> 
		</td>
			
			
			

		
		
		
		<form></form>
		<td width="50px" scope="row">
	
		</td>
  
  	</table>
  	
  	  	
  	<br>

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
 <div class="jbMenuBlank">
 </div>		
 <div class="jbMenu">		
  	<table class = "type03" width="960px" border="1" cellspacing="5" cellpadding="5" align="left">
  		<tr>
	  		<td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 0px" width="70px" cellspacing="0"  cellpadding="0" rowspan="2" align="center" >
		  		<img  src=<?php echo $photoPath; ?> width="70px">
	  		</td>
  			<td bgcolor="#153d73"><font color="white">Chart Number</font></td>
  			<td bgcolor="#153d73"><font color="white">Name</font></td>    
  			<td bgcolor="#153d73" colspan="2"><font color="white">S/A</font></td> 
  			  
  			<td bgcolor="#153d73" ><font color="white">Physician</font></td>
  			<td bgcolor="#153d73" colspan="2"><font color="white" >Clinic (hospital)</font></td>
  			<td bgcolor="#153d73"><font color="white">Refer. physician</font></td>
		</tr>

		<tr valign="middle">
			<td valign="middle">
								<strong><font size="3"><?php echo $row_patientinfo['Hospital_ID']; ?></font><strong>			

			</td>
			
			<td width="120px">
<!-- 								<?php echo substr($row_patientinfo['RO_ID'],5,7); ?>				 -->
				<strong><font size="3"><input class="form-control" name="txt_name" type="text" id="txt_name" style="width:100%;height:100%; font-size:11pt; ime-mode:active"  value="<?php echo $row_patientinfo['KorName']; ?>" /></font></strong>        

			</td>
			
			<td width="80px" >
		  		<select class="form-control" style="width:100%; font-size: 10pt" name="txt_search_sex" id="txt_search_sex" >
		  		<option value="<?php echo $row_patientinfo['Sex']; ?>" selected="selected"><?php echo $row_patientinfo['Sex']; ?></option>
		  		<option value="M">M</option>
		  		<option value="F">F</option>
	      		</select>	      

					      
      		</td>
	  		
	  		<td width="80px" >
	      		<input class="form-control" style="font-size: 10pt" name="txt_age" type="text" id="txt_age" value="<?php echo $row_patientinfo['Age']; ?>" />
		  		
	  		</td>
	  		
	  		<td width="100px" >
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
	  		
	  		<?php
		  		$autoClinic = $row_treatmentinfo['Clinic'];
		  		$curDoc = $POST_['txt_doctor'];
		  		if(strlen($curDoc)==0 and strlen($row_treatmentinfo['Clinic'])==0){
			  		$clinicRefQuery = "select Clinic from TreatmentInfo where diagnosis like '$row_treatmentinfo[diagnosis]'";
			  		$querys = mysqli_query($test, $clinicRefQuery);
			  		$querysclinic = mysqli_fetch_assoc($querys);
			  		$autoClinic = $querysclinic[Clinic];
			  	}
		  		
		  		
		  	?>
	  		
	  		
	  		
	  		<td colspan="2">
				<input class="form-control" style="font-size: 10pt; width: 200px" name="txt_clinic" type="text" id="txt_clinic" value="<?php echo $autoClinic; ?>" />
		  		
			</td>
			
<!--
			<td>
			</td>
-->
			
			<td>
				<input class="form-control" style="font-size: 10pt" name="txt_doctor" type="text" id="txt_doctor" value="<?php echo $row_treatmentinfo['diagnosis']; ?>" />
			</td>
   		</tr>
   		
   		
   		</table>
   		</div>
   		 
   		 
   		   		 
   		 
   		 <table class = "type03" width="960px" border="1" cellspacing="5" cellpadding="5" align="left">

   		
   		
   		
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
		
		<script type="text/javascript">
		$('#primary_menu').change(function(){
			if ((jQuery(this).val()=='HB') && ($('#pathology_menu').val().length==0) && ($("#txt_physician > option:selected").val()=='JJ')){
				$('#pathology_menu').val('normal cc, meanLiver  Gy, rV15  cc');
				}
		});
		</script>



	  	

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
  	<table class = "type03" width="960px" border="1" cellspacing="1" cellpadding="5" align="center">


<tr>
  <td bgcolor="#153d73" rowspan=1 width="70px"><font color="white">Attach</font></td>
    <td  colspan=1 width="250px">
			        <form enctype='multipart/form-data' action='N_edit_all.php' method='post'>
    <input type='file' name='myfile'>
    <input type="hidden" name="hf_edit" id = "hf_edit" value= <?php echo $row_patientinfo['Hospital_ID']; ?> />
    <input name=permit type=hidden id=permit  value=<?php echo $permitUser ?>/>          
    <input name=username type=hidden id=username  value=<?php echo $uid ?>/>          
    <input name=fup type=hidden id=fup value= "1" />  
			        </td>
			        <td width="100px">
			      <button>Upload</button>
</form>




      </td>
        <td colspan=5>






<!-- Tab links -->
<!--
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Phys</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Ther</button>
</div>
-->

<!-- Tab content -->


<div style="  float: left; width: 50%;">
<div style="border-bottom:1px solid gray; float: left; width: 100%;">
	Dr.
</div>

<?php   

$dir = "atch/".$row_patientinfo['Hospital_ID'];;
// Open a directory, and read its contents      
if (is_dir($dir)){                              
  if ($dh = opendir($dir)){                     
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0) { 
	    
        $dates = substr($file,0,14);
        $dates2 = substr($dates,0,4)."-".substr($dates,4,2)."-".substr($dates,6,2)." ".substr($dates,8,2).":".substr($dates,10,2).":".substr($dates,12,2);
        $fnames = substr($file,14,1000);
        $tFileName = $dir ."/". $file;
	    if(strcmp(substr($fnames,0,3),'TCR')!=0){ 
        $fchar = $fnames;
        if(strlen($fnames)>10){
	        $fchar = substr($fnames,0,9).' ... ';
        }
        
        echo "<form id=form3 name=form3 method=post action=N_edit_all.php>";                                
        echo "<input type=submit height=10 width=10 name=btn_edit id=btn_edit value=x>";
        echo "<input name=permit type=hidden id=permit  value=$permitUser>";            
        echo "<input name=username type=hidden id=username  value=$uid>";           
        echo "<input name=filenameD type=hidden id=filenameD  value=$tFileName>";           
        echo "<input name=hf_edit type=hidden id=hf_edit value= $row_treatmentinfo[Hospital_ID]>";
//         echo("(".$dates2.") ");
        echo "<a href=".$dir ."/". $file . " target=_blank>"."(".$dates2.") ".$fchar."</a></form>";        
        }
        
      }
    }                                           
    closedir($dh);                              
  }                                             
}           
?>          
</div>



<div style="  float: left; width: 50%;">
<div style="border-bottom:1px solid gray;  float: left; width: 100%;">
	Tx.
</div>

<?php   

$dir = "atch/".$row_patientinfo['Hospital_ID'];;
// Open a directory, and read its contents      
if (is_dir($dir)){                              
  if ($dh = opendir($dir)){                     
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0) { 
        $dates = substr($file,0,14);
        $dates2 = substr($dates,0,4)."-".substr($dates,4,2)."-".substr($dates,6,2)." ".substr($dates,8,2).":".substr($dates,10,2).":".substr($dates,12,2);
        $fnames = substr($file,14,1000);
        $tFileName = $dir ."/". $file;
	    if(strcmp(substr($fnames,0,3),'TCR')==0){ 
        $fchar = $fnames;
        if(strlen($fnames)>10){
	        $fchar = substr($fnames,0,9).' ... ';
        }
        echo "<form id=form3 name=form3 method=post action=N_edit_all.php>";                                
        echo "<input type=submit height=10 width=10 name=btn_edit id=btn_edit value=x>";
        echo "<input name=permit type=hidden id=permit  value=$permitUser>";            
        echo "<input name=username type=hidden id=username  value=$uid>";           
        echo "<input name=filenameD type=hidden id=filenameD  value=$tFileName>";           
        echo "<input name=hf_edit type=hidden id=hf_edit value= $row_treatmentinfo[Hospital_ID]>";
//         echo("(".$dates2.") ");
        echo "<a href=".$dir ."/". $file . " target=_blank>"."(".$dates2.") ".$fchar."</a></form>";        
        }
        
      }
    }                                           
    closedir($dh);                              
  }                                             
}           
?>          
</div>














<!--
<?php   

$dir = "atch/".$row_patientinfo['Hospital_ID'];;
// Open a directory, and read its contents      
if (is_dir($dir)){                              
  if ($dh = opendir($dir)){                     
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0) { 
	    
        $dates = substr($file,0,14);
        $dates2 = substr($dates,0,4)."-".substr($dates,4,2)."-".substr($dates,6,2)." ".substr($dates,8,2).":".substr($dates,10,2).":".substr($dates,12,2);
        $fnames = substr($file,14,1000);
        $tFileName = $dir ."/". $file;
        echo "<form id=form3 name=form3 method=post action=N_edit_all.php>";                                
        echo "<input type=submit height=10 width=10 name=btn_edit id=btn_edit value=x>";
        echo "<input name=permit type=hidden id=permit  value=$permitUser>";            
        echo "<input name=username type=hidden id=username  value=$uid>";           
        echo "<input name=filenameD type=hidden id=filenameD  value=$tFileName>";           
        echo "<input name=hf_edit type=hidden id=hf_edit value= $row_treatmentinfo[Hospital_ID]>";
        echo("(".$dates2.") ");
        echo "<a href=".$dir ."/". $file . " target=_blank>".$fnames."</a></form>";        
        
        
      }
    }                                           
    closedir($dh);                              
  }                                             
}           
?>          
-->











        </td>

    </tr> 

      
  	</table>



  	
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
					$rthist = trim($row_clinicalinfo['RadioHistory'])."&nbsp;\r".$prev;
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
  			<td bgcolor="#153d73">
  				<input  type="checkbox" name="autofiller" value="1" >	
  				<font color="white">Reply</font>
  			</form>
		  			
		  			

	  			
	  			

  			</td>      
		</tr>
  		<tr>
        <?php $ltr = $row_clinicalinfo['ConsultTemplate'];  ?>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="19" cols = "65" name="txt_ClinicalHistoryConsult" type="text" id="txt_ClinicalHistoryConsult"><?php echo "$ltr"; ?></textarea></td>
  			<td><textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="19" cols = "65" name="txt_ClinicalHistoryReply" type="text" id="txt_ClinicalHistoryReply"><?php echo $row_clinicalinfo['ConsultReply']; ?></textarea></td>      
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
		$manualVal = "0";
		
	}
?>


	<table class = "type1" width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
  	<td>
		<font style="font-family: arial; font-size:18px; color:#FF7E79">&nbsp;&nbsp;Radiotherapy Planning</font>

		
		
		
		
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
      	<td width="5%" scope="row" style="color: #FF7E79">Plan #</td>
	  		<td width="10%">
        <?php echo $row_treatmentinfo['idx']; ?></td>
		<td width="5%" style="color: #FF7E79">Update</td>
			<td width="10%">
					<input class="form-control" style="height:25px; width:80px" name="txt_birth" type="text" id="txt_birth" value="<?php echo $Today_Date; ?>" size = "5" />
    		</td>
    </tr>
-->
<!--
    <tr>
      <td width="150" nowrap="nowrap" scope="row" style="color: #FF7E79">Purpose</td>
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
      <td height="23" nowrap="nowrap" scope="row" style="color: #FF7E79">CCRT</td>
      	<td>
        	<input class="form-control" style="height:25px; width:80px" name="txt_modality" type="text" id="txt_modality" value="<?php echo $row_treatmentinfo['Modality_var1']; ?>" size = "7"/>
        </td>
        
    </tr>
</table>
-->


<table class="type04" width="960px" align="center">
	<tr>
		<td width="120px">
			Routine:
		</td>
		<td>
<!-- 		<a href = "#Routine1"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Head & Neck</a>					 -->
<!-- 		<a href = "#Routine2"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>WhBrain</a> -->
<!-- 		<a href = "#Routine3"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Cervix & PAN</a> -->
<!-- 		<a href = "#Routine4"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Lung</a> -->
<!-- 		<a href = "#RoutineProstate"  class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Prostate</a> -->
<!-- 		<button type = "button" id="addTR" class = "btn btn-default">+</button> -->
		</td>
		
	</tr>
	
</table>



<table class="type05" width="960px" align="center">
  <tr>
    <td>
    <!-- 루틴을 만들기 위한 설정 1. 버튼을 만든다. 페이지에 있는 Modal창(#Routine5)으로 이동하기 위해 # Routine5의 모달창 정의 변수명을 적절한 것으로 변경할것!-->
    <button type = "button" id="addTR" class = "btn btn-default">Add schedule</button>
    </td>
    <td>
<?php
    // echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    // echo "<a href=edit.php>";            
    // echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    // echo "<input name=permit type=hidden id=permit  value=$permitUser/>"; 
    //   echo "<input name=username type=hidden id=username  value=$uid/>";      
               
    // echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

?>






    </td>
    
  </tr>
  <tr>
	  <td>
<!-- 		  Operation date sorter -->
		  <?php
// 		  	echo($row_clinicalinfo['Op']);	
		  	$opstr = $row_clinicalinfo['Op'];
		  	$opid = 0;
// 		  	while(strlen($opstr)<2){ 	
			for($asdf=0;$asdf<15;$asdf++){			  
			 if(strlen($opstr)<5){
				 break;
			 } 
		  	for($idw=0;$idw<strlen($opstr);$idw++){
			  	if(strcmp(substr($opstr,$idw,2),'20')==0){
				  	for($idsw=0;$idsw<strlen($opstr);$idsw++){
					  	if(strcmp(substr($opstr,$idw+$idsw,1),'.')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'0')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'1')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'2')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'3')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'4')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'5')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'6')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'7')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'8')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'9')!=0 and strcmp(substr($opstr,$idw+$idsw,1),' ')!=0){
// 						  	echo($idsw);
						  	break;
					  	}
				  	}
				  	$ttss = substr($opstr,$idw,$idsw);
				  	$chmmodtemp = str_replace(".", "-", $ttss);
				  	
				  	$opdate[$opid] = date("Ymd",strtotime($chmmodtemp));
				  	

// 				  					  	print_r(substr($opstr,$idw,$idsw));

				  	$opstr = substr($opstr,$idw+$idsw,strlen($opstr)-($idw+$idsw));
				  	$opid++;
				  	break;
			  	}
		  	}  
		  	}
		  	$chmraw = max($opdate);
		  	$chmmod = str_replace(".", "-", $chmraw);
		  	$lastCm = date("y/m/d",strtotime($chmmod));
		  	$lastCm2 = date("Ymd",strtotime($chmmod));
// 		  	echo($lastCm);

		  	$chemo6w = date("y/n/j",strtotime ("+6 weeks", strtotime($lastCm2)));
		  	
		  	$query_RecordsetCTDat = "SELECT * FROM TreatmentInfo where (CT_Sim1 like '$CTDat' or CT_Sim2 like '$CTDat' or CT_Sim3 like '$CTDat' or CT_Sim4 like '$CTDat' or CT_Sim5 like '$CTDat' or CT_Sim6 like '$CTDat' or CT_Sim7 like '$CTDat')";
			$NumCTLabel = mysqli_query($test, $query_RecordsetCTDat )  ;
			$NumCTs = mysqli_num_rows($NumCTLabel);

// 		  	$daily = array('일','월','화','수','목','금','토');

// 			$starts = date("Y.m.d", strtotime( $row_treatmentinfo['CT_Sim1'] ) );
			$dateyoilchm = date('w',strtotime("+6 weeks", strtotime($lastCm2))); //0 ~ 6 숫자 반환
		  	if($opid>0){
		  	echo("<strong><font color=red>Last Operation: ".$lastCm."<font></strong>, After 6 weeks: ".$chemo6w."(". $daily[$dateyoilchm]. ")<br>");
		  	}
		  	
		  	
	  		?>
	  	
	  	
<!-- 		  Chemo date sorter -->
		  <?php
// 		  	echo($row_clinicalinfo['Op']);	
		  	$opstr = $row_clinicalinfo['chemo'];
		  	$opid = 0;
// 		  	while(strlen($opstr)<2){ 	
			for($asdf=0;$asdf<15;$asdf++){		
			 if(strlen($opstr)<5){
				 break;
			 } 
					  
		  	for($idw=0;$idw<strlen($opstr);$idw++){
			  	if(strcmp(substr($opstr,$idw,2),'20')==0){
				  	for($idsw=0;$idsw<strlen($opstr);$idsw++){
					  	if(strcmp(substr($opstr,$idw+$idsw,1),'.')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'/')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'0')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'1')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'2')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'3')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'4')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'5')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'6')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'7')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'8')!=0 and strcmp(substr($opstr,$idw+$idsw,1),'9')!=0 and strcmp(substr($opstr,$idw+$idsw,1),' ')!=0){
// 						  	echo($idsw);
						  	break;
					  	}
				  	}
				  	
				  	$ttss = substr($opstr,$idw,$idsw);
				  	$chmmodtemp = str_replace(".", "-", $ttss);
				  	
				  	$opdate[$opid] = date("Ymd",strtotime($chmmodtemp));
				  	

// 				  					  	print_r(substr($opstr,$idw,$idsw));

				  	$opstr = substr($opstr,$idw+$idsw,strlen($opstr)-($idw+$idsw));
				  	$opid++;
				  	break;
			  	}
		  	}  
		  	}
		  	
		  	
		  	
		  	$chmraw = max($opdate);
		  	$chmmod = str_replace(".", "-", $chmraw);
		  	$lastCm = date("y/m/d",strtotime($chmmod));
		  	$lastCm2 = date("Ymd",strtotime($chmmod));
//  		  	echo($lastCm);

		  	$chemo6w = date("y/n/j",strtotime("+6 weeks", strtotime($lastCm2)));
			$dateyoilchm = date('w',strtotime("+6 weeks", strtotime($lastCm2))); //0 ~ 6 숫자 반환
		  	
		  	if($opid>0){
		  	echo("<strong><font color=red>Last Chemo: ".$lastCm."<font></strong>, After 6 weeks: ".$chemo6w."(". $daily[$dateyoilchm]. ")<br>");
		  			  	print_r($$opdate);

		  	}
	  	?>	  	
	  </td>
  </tr>
</table>

<?php
	$techJava ="";
	for($idtech = 0; $idtech<count($techInt); $idtech++){
		$valtech = $techIdd[$idtech];
		$tJava = "<option value='".$valtech."'>".$valtech."</option>";
		$techJava = $techJava.$tJava;

	}
	$roomJava ="";
	for($idtech = 0; $idtech<count($rmsInt); $idtech++){
		$rmstech = $rmsInt[$idtech];
		$rJava = "<option value='".$rmstech."'>".$rmstech."</option>";
		$roomJava = $roomJava.$rJava;

	}
?>

<table class="type04" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
		<td width="80px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Room </td>
		<td width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Method </td>
		<td width="200px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Site </td>		
		<td width="120px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Gy</td>
		<td width="40px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; fx.</td>
		<td width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT  </td>
		<td width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Start  </td>
		<td width="70px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Finish   </td>

<!-- 		<td width="80px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CT sch  </td>		 -->
		<td width="50px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; CE  </td>		
		<td colspan ="3" align=left width="200px" scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp; Delay  </td>		
		<td width="20px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF"> &nbsp;&nbsp;   </td>
		<td width="40px" align=left scope="row" bgcolor="#FF7E79" style="color: #FFFFFF">Status</td>
    
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
      	<td scope="row">
		 	<select class="form-control" name="Linac[]" >
			 	
			 	
		 		<option value=" <?php echo trim($row_treatmentinfo[$Linac_f]); ?>" selected="selected"><?php echo trim($row_treatmentinfo[$Linac_f]); ?></option>
		 		<?php echo $roomJava;?>
<!--
		 		<option value="Versa">Versa</option>
		 		<option value="IX">IX</option>
		 		<option value="Infinity">Infinity</option>
-->



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
		<select class="btn btn-secondary dropdown-toggle" name="Ce[]" >
			<option class="dropdown-item" value="<?php $row_treatmentinfo[$ce_f]; ?>" selected="selected"> <?php echo $row_treatmentinfo[$ce_f]; ?></option>
			<option class="dropdown-item" value="CE">CE</option>
			<option class="dropdown-item" value="NCE">NCE</option>									
		</select></td>
        
        <td align="center" colspan=3>
<input class="form-control" name="Delay[]" type="text" value="<?php echo($row_treatmentinfo[$Delay_idx_f]); ?>" size="3" />	        
	        
	        </td>
        
		<td><center><button type = "button"  class="btn btn-default" >-</button></center>
			
		</td>
			
		</td>

      	<td scope="row">
		 	<select class="btn btn-secondary dropdown-toggle" name="StatusCheck[]" >
		 		<option class="dropdown-item" value=" <?php echo $statMarker[$i]; ?>" selected="selected"><?php echo $statMarker[$i]; ?></option>
		 		<option class="dropdown-item" value="N">N</option>
		 		<option class="dropdown-item" value="T">T</option>
		 		<option class="dropdown-item" value="P">P</option>
		 		<option class="dropdown-item" value="A">A</option>
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

<table class="type05" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
  
  <tr>
    <td colspan="2">
    <?php

          $prevst = $row_treatmentinfo[RT_start1];
          $preved = $row_treatmentinfo[RT_fin_f];
          $prevpp = $row_treatmentinfo['purpose'];
          $prevsite = $row_treatmentinfo['subsite'];
          $prevds = $row_treatmentinfo['dose_sum'];
          $prevfx = $fxDoseStr; //평균 dose
          $prevfd = $row_treatmentinfo['Fx_sum'];


          echo($CourseRemarker); 

          echo "<form id=form3 name=form3 method=post action=N_edit_all.php>";                                
          echo "<input type=submit name=btn_edit id=btn_edit value=Send-to-RT-History>";
          echo "<input name=permit type=hidden id=permit  value=$permitUser>";            
          // echo "<input name=prevrt type=hidden id=permit  value='$CourseRemarker'>";

          echo "<input name=prevst type=hidden id=permit  value='$prevst'>";            
          echo "<input name=preved type=hidden id=permit  value='$preved'>";            
          echo "<input name=prevpp type=hidden id=permit  value='$prevpp'>";            
          echo "<input name=prevsite type=hidden id=permit  value='$prevsite'>";            
          echo "<input name=prevds type=hidden id=permit  value='$prevds'>";            
          echo "<input name=prevfx type=hidden id=permit  value='$prevfx'>";            
          echo "<input name=prevfd type=hidden id=permit  value='$prevfd'>";            
          
          echo "<input name=username type=hidden id=username  value=$uid>";           
          echo "<input name=hf_edit type=hidden id=hf_edit value= $row_treatmentinfo[Hospital_ID]></form>";  


?>  
</td>
</tr>





	<tr>
	<td width="10%">Total</td>
	<td width="10%"><?php echo $row_treatmentinfo['dose_sum']?> Gy, &nbsp;&nbsp; <?php echo $row_treatmentinfo['Fx_sum']?> fx. </td>
	</tr>
	
	<tr>
		<?php
			if ($row_patientinfo['CurrentStatus'] == '0' || $row_patientinfo['CurrentStatus'] == '111'){
				$CurrentStatus = 'Active';
			
		    	}else if ($row_patientinfo['CurrentStatus'] == '1'){
					$CurrentStatus = 'Complete';
				}else if ($row_patientinfo['CurrentStatus'] == '2'){
					$CurrentStatus = 'Imcomplete';
				}else if ($row_patientinfo['CurrentStatus'] == '3'){
					$CurrentStatus = 'Canceled';
				}else if ($row_patientinfo['CurrentStatus'] == '4'){
					$CurrentStatus = 'Suspended';
				}
			
			if ($row_patientinfo['NextStatus'] == '0'){
				$NextStatus = 'Fin';
		    	}else if ($row_patientinfo['NextStatus'] == '1'){
				$NextStatus = 'CTsim';
				}else if ($row_patientinfo['NextStatus'] == '2'){
				$NextStatus = 'CD w/o Sim';
			}			
			?>
 
		<?php
			if(strcmp($CurrentStatus,"Active")==0){
				$curstatVal = 0;
			}	
			elseif(strcmp($CurrentStatus,"Finish")==0 or strcmp($CurrentStatus,"Complete")==0){
				$curstatVal = 1;
			}	
			elseif(strcmp($CurrentStatus,"Stop")==0 or strcmp($CurrentStatus,"Imcomplete")==0){
				$curstatVal = 2;
			}	
			elseif(strcmp($CurrentStatus,"Drop")==0 or strcmp($CurrentStatus,"Canceled")==0){
				$curstatVal = 3;
			}	
			elseif(strcmp($CurrentStatus,"Hold")==0 or strcmp($CurrentStatus,"Suspended")==0){
				$curstatVal = 4;
			}	
		?>
		<td width="56">Current status</td>
		<td width="10%">
		  <select name="CurrentStatus_menu" id="CurrentStatus_menu" >
          <option value="<?php echo $curstatVal ?>"  selected="selected"><?php echo $CurrentStatus ?></option>
          <option value="0">Active</option>
          <option value="1">Complete</option>
          <option value="2">Imcomplete</option>
          <option value="3">Canceled</option>
          <option value="4">Suspended</option>
          </select>
		</td>

	</tr>
</table>


<br>
<br>

  
<!--   CLINICAL HISTORY -->
<!--
<hr>

<table class="type1" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
	<td width="20%" scope="row" colspan="2" height="60" valign="middle"> <p style="font-family: arial; font-size:24px; color:#6600CC">Clinical History</p></td> 
</table>


<table width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
		<td width="10%" scope="row" bgcolor="#6600CC" style="color: #FFFFFF"> <center>Category</center></td> 
		<td width="100%"> 
		  <select name="txt_Category" id="txt_Category" >
          <option value="Select">Select</option>
          <option value="Surgery">Surgery</option>
          <option value="Chemotherapy">Chemotherapy</option>
          <option value="Previous history">Previous history</option>
          <option value="Pathology">Pathology</option>
          <option value="Tumor markers & other specific lab findings">Tumor markers & other specific lab findings</option>
          <option value="Radiologic findings">Radiologic findings</option> 
          </select>
		</select>
		</td>		
  	</tr>
	<td width="10%" scope="row" bgcolor="#6600CC" style="color: #FFFFFF"> <center>Detail</center></td> 
	<td width="90%"><textarea style="resize:none; wrap:hard;"   class="noresize"  width="90%" rows="10" cols = "100" name="txt_ClinicalHistory" type="text" id="txt_ClinicalHistory" value="<?php echo $row_patientinfo['RO_ID']; ?>"></textarea></td>
</table>  
-->
  
  
  
<!--   MEETING LIST TEMPORARY REMOVED -->
<!--
  
<table class="type1" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
	<td width="20%" scope="row" colspan="2" height="60" valign="middle"> <p style=" font-size:18px; color:#339900">Scheduled meeting</p></td>
</table> 

<table class="type1" width="960px" align="center">


	<tr>
		<td>
			<button type = "button" id="addMeet" class = "btn btn-default">+</button>
		</td>
	</tr>
</table> 

<?php
	$Meet_Memo = mysqli_query($test, "select Memo from MeetingList where Hospital_ID = '$colname_Hospital_ID'");
	$Meet_Date = mysqli_query($test, "select Date from MeetingList where Hospital_ID = '$colname_Hospital_ID'"); 
	$Meet_idx = mysqli_query($test, "select idx from MeetingList where Hospital_ID = '$colname_Hospital_ID'");
	$total_Meetinfo = mysqli_num_rows($Meet_Memo);	
?>
  
<table class="type1" id="MeetingTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<td width="1%" scope="row" bgcolor="#339900" style="color: #FFFFFF"><center> No.  </center></td>
		<td width="5%" scope="row" bgcolor="#339900" style="color: #FFFFFF"><center>Date</center></td> 
		<td width="20%" scope="row" bgcolor="#339900" style="color: #FFFFFF"> <center>Free comment</center></td> 
		<td width="1%" scope="row" bgcolor="#339900" style="color: #FFFFFF"> &nbsp;&nbsp;   </td>
  	</tr>
  	<?php for($i=0; $i<$total_Meetinfo; $i = $i+1){ 
	    $Memo = mysqli_result($Meet_Memo, $i,"Memo");
	    $Date = mysqli_result($Meet_Date, $i,"Date");
	    $i_ = $i+1;
	    $MeetPicker = "MeetPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="1%" scope="row" style="color: #71f80b"><center><?php echo $i+1 ?></center></td>
    	<td width="5%" scope="row" style="color: #71f80b"><input class = 'form-control input-sm ' id = '<?php echo $MeetPicker; ?>' type='MeetDate' name= 'MeetDate[]' value ='<?php echo $Date?>' ></td>
		<td width="20%" scope="rpw" style="color: #71f80b"><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' value='<?php echo $Memo; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>
-->





<!-- Short orders -->

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



<table class="typeCal" width="960px" border="0" cellspacing="1" cellpadding="3" align="center">
<tr>
	<td valign="top">

		
		<?php	    
		$Today_Date = Date("n/j/y");
		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$colname_Hospital_ID'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$colname_Hospital_ID'"); 
		$sql_idx = mysqli_query($test, "select idx from OrderTemp where Hospital_ID = '$colname_Hospital_ID'");  
		?>
		<table class="type1" id="OrderTable" width="470px" border="0" cellspacing="1" cellpadding="1" align="center">
		  	<tr height="30">
			  	<td width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></td>
				<td width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></td> 
				<td width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></td> 
				<td width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </td>
		  	</tr>
		  	<?php for($i=0; $i<$total_Orderinfo; $i = $i+1){ 
			    $Memo = mysqli_result($sql_Memo, $i,"Memo1");
			    $Date = mysqli_result($sql_Date, $i,"Date1");
          $uD = (date('y/n/j',strtotime($Date)));

			    $i_ = $i+1;
			    $OrderPicker = "OrderPicker"."$i_";
		   	?>
		   	<tr height="30">
		    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
		    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $OrderPicker; ?>' type='OrderDate' name= 'OrderDate[]' value ='<?php echo $uD ?>' ></td>
				<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Order' name= 'Order[]' value='<?php echo $Memo; ?>' ></td></td>
				<td><center><button type='button' class='btn btn-default'>-</button></center></td>
		  	</tr>
		  	<?php } ?>
		</table>

	</td>


	<td valign="top">




<?php	    
$Today_Date = Date("n/j/y");
$sql_Memo = mysqli_query($test, "select Memo1 from MemoTemp where Hospital_ID = '$colname_Hospital_ID'");
$sql_Date = mysqli_query($test, "select Date1 from MemoTemp where Hospital_ID = '$colname_Hospital_ID'"); 
$sql_idx = mysqli_query($test, "select idx from MemoTemp where Hospital_ID = '$colname_Hospital_ID'");  
?>
<table class="type1" id="CommentTable" width="470px" border="0" cellspacing="1" cellpadding="1" align="center">
  	<tr height="30">
	  	<td width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> No.  </center></td>
		<td width="5%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Date</center></td> 
		<td width="20%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Free comment</center></td> 
		<td width="1%" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> &nbsp;&nbsp;   </td>
  	</tr>
  	<?php for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
	    $Memo = mysqli_result($sql_Memo, $i,"Memo1");
	    $Date = mysqli_result($sql_Date, $i,"Date1");
      $uD = (date('y/n/j',strtotime($Date)));


	    $i_ = $i+1;
	    $CommentPicker = "CommentPicker"."$i_";
   	?>
   	<tr height="30">
    	<td width="1%" scope="row" style="color: #1C73B9"><center><?php echo $i+1 ?></center></td>
    	<td width="5%" scope="row" style="color: #1C73B9"><input class = 'form-control input-sm ' id = '<?php echo $CommentPicker; ?>' type='CommentDate' name= 'CommentDate[]' value ='<?php echo $uD ?>' ></td>
		<td width="20%" scope="rpw" style="color: #1C73B9"><input class = 'form-control input-sm ' type='Comment' name= 'Comment[]' value='<?php echo $Memo; ?>' ></td></td>
		<td><center><button type='button' class='btn btn-default'>-</button></center></td>
  	</tr>
  	<?php } ?>
</table>



	</td>
	
</tr>
</table>


	<center> 
<div class="float-button-marker">
<font color=#008673 >⇦ Add schedule </font>
</div>

<div class="float-button-update">
	<br>
<input class="btn button-update" style="font-size: 20px; font-weight: 200" type="submit" name="btn_update" id="btn_update" width="960px" value="✔" />
    <input type="hidden" name="H_ID" id = "H_ID" value = "<?php echo $row_treatmentinfo['Hospital_ID'];  ?>" />
    <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
    <input type="hidden" name="ct1" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim1]?>" />
    <input type="hidden" name="ct2" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim2]?>" />
    <input type="hidden" name="ct3" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim3]?>" />
    <input type="hidden" name="ct4" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim4]?>" />
    <input type="hidden" name="ct5" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim5]?>" />
    <input type="hidden" name="ct6" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim6]?>" />
    <input type="hidden" name="ct7" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim7]?>" />
    <input type="hidden" name="MM_update" value="form1" />

	<br>
	<br>
	<input class="btn button-update" type="button" id="button1" onclick="buttonNew_click();" style="font-size: 14px; font-weight: 200" value="✎" />

	<script>
	function buttonNew_click() {
		<?php
		echo "window.open('N_register_all.php?permit=$permitUser', '_blank', 'width=1100px, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>

	<br>
	<br>
	
	<input class="btn button-close" type="button" id="button1" onclick="button1_click();" style="font-size: 14px; font-weight: 200" value="📅" />
	<script>
	function button1_click() {
		<?php
		echo "window.open('simschedule.php?permit=$permitUser', '_blank', 'width=1330px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
	<br>	
<!--
	
	<form method=post target="_blank"  action="simschedule.php">
		<input class="btn button-close" style="font-size: 14px; font-weight: 200" type=submit name=btn_home id=btn_home value=📅>
		<input class="btn button-close" name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input  type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input  type = hidden name = mdname id = mdname value = <?php echo $md; ?> />		
		<input  type = hidden name = curpage id = curpage value = <?php echo "simschedule.php"; ?> />										
	</form>
-->
	<br>
    <input class="btn button-close" type='BUTTON' style="font-size: 20px; font-weight: 200" value="✘" onClick='self.close()'>

	<br>
	<br>
	    <button class="btn button-close" type = "button" id="addTRFloat" style="font-size: 20px; font-weight: 200" class = "btn btn-default">⨭</button>

	<br>
	<br>
		<button class="btn button-close" type="button" onClick="window.open('jsstudy.html', '_blank', 'width=235px, height=360px, toolbar=no, menubar=no, resizable=no, copyhistory=no' );">
	     <span class="icon">Cal</span>
	</button>
	<br>
	<br>
		<button class="btn button-close" type="button" onClick="window.open('jsbed.html', '_blank', 'width=235px, height=360px, toolbar=no, menubar=no, resizable=no, copyhistory=no' );">
	     <span class="icon">BED</span>
	</button>
	
    </div>
	
	
	
<!--
<input class="btn btn-default" type="submit" name="btn_update" id="btn_update" width="960px" value="UPDATE" />
    <input type="hidden" name="H_ID" id = "H_ID" value = "<?php echo $row_treatmentinfo['Hospital_ID'];  ?>" />
    <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
    <input type="hidden" name="ct1" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim1]?>" />
    <input type="hidden" name="ct2" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim2]?>" />
    <input type="hidden" name="ct3" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim3]?>" />
    <input type="hidden" name="ct4" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim4]?>" />
    <input type="hidden" name="ct5" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim5]?>" />
    <input type="hidden" name="ct6" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim6]?>" />
    <input type="hidden" name="ct7" id = "permit" value="<?php echo $row_treatmentinfo[CT_Sim7]?>" />
    <input type="hidden" name="MM_update" value="form1" />
-->
    </center>     
  
  
  <hr>






<!-- Patient setup photo -->
<?php

if(strlen($row_patientinfo['Hospital_ID'])>3){ 
$dirPC = "PlanCapture/".$row_patientinfo['Hospital_ID'];
// Open a directory, and read its contents      
// num folders
$numFolderPC = 0;
if (is_dir($dirPC)){                              
  if ($dh = opendir($dirPC)){                     
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0) { 
        
        if((strcmp(substr($file,strlen($file)-3,3),'png')==0) or (strcmp(substr($file,strlen($file)-3,3),'PNG')==0) or (strcmp(substr($file,strlen($file)-3,3),'jpg')==0) or (strcmp(substr($file,strlen($file)-3,3),'JPG')==0) or (strcmp(substr($file,strlen($file)-3,3),'bmp')==0) or (strcmp(substr($file,strlen($file)-3,3),'BMP')==0)){
        $fName[$numFolderPC] = $file;

        $numFolderPC++;
        }

      }
    }                                           
    closedir($dh);                              
  }                                             
}           
}


?>




<table  width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
    <td>
<!--     <font style="font-family: arial; font-size:18px; color:#000000">&nbsp;&nbsp;Plan</font>     -->
    </td>
  </tr>  
</table>
<?php

if($numFolderPC>0){ 
	$numPCs = 0;
  for($numFs=0;$numFs<$numFolderPC;$numFs++){ 
	  $dirPC = "PlanCapture/".$row_patientinfo['Hospital_ID']."/".$fName[$numFs];
// Open a directory, and read its contents      
// num folders

if(strcmp(substr($dirPC,22,3),'DVH')!=0){ 
	echo(substr($pcNames[$idP],22,3));
	$pcNames[$numPCs] = $dirPC;
	$numPCs++;
}

if (is_dir($dirPC)){                              
  if ($dh = opendir($dirPC)){       
    $numFile = 0;
              
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0 and strcmp($file,"photothumb.db")!=0) { 
        
	        $fileName[$numFile] = $file;
	
	        $numFile++;

      }
    }                                           
    closedir($dh);                              
  }                                             
}           
}
}

?>




<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
<?php $idC =0;$idP =0; for($idSet=0;$idSet<ceil(($numPCs)/3);$idSet++){   ?>
<tr>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong>
	
	<?php 
		$planName = substr($pcNames[$idP],22,100);
		$idcut = 0;
		for ($idplan=0;$idplan<strlen($pcNames[$idP]);$idplan++){
// 				echo(substr($pcNames[$idP],$idplan,1)." ");
			
			if((strcmp(substr($planName,$idplan,1),'_')==0) or (strcmp(substr($planName,$idplan,1),'.')==0)){
				$idcut = $idplan;
				break;
			}
		}		
		echo(substr($planName,0,$idcut)); 
		
		?>
	
	
	
	</strong></center></h7>
<?php $idP++; ?>

</td>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong>

	<?php 
		$planName = substr($pcNames[$idP],22,100);
		$idcut = 0;
		for ($idplan=0;$idplan<strlen($pcNames[$idP]);$idplan++){
// 				echo(substr($pcNames[$idP],$idplan,1)." ");
			
			if((strcmp(substr($planName,$idplan,1),'_')==0) or (strcmp(substr($planName,$idplan,1),'.')==0)){
				$idcut = $idplan;
				break;
			}
		}		
		echo(substr($planName,0,$idcut)); 
		
		?>

</strong></center></h7> 

<?php $idP++; ?>
</td>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong>
	<?php 
		$planName = substr($pcNames[$idP],22,100);
		$idcut = 0;
		for ($idplan=0;$idplan<strlen($pcNames[$idP]);$idplan++){
// 				echo(substr($pcNames[$idP],$idplan,1)." ");
			
			if((strcmp(substr($planName,$idplan,1),'_')==0) or (strcmp(substr($planName,$idplan,1),'.')==0)){
				$idcut = $idplan;
				break;
			}
		}		
		echo(substr($planName,0,$idcut)); 
		
		?>
	</strong></center></h7>
<?php $idP++; ?>
</td>


</tr>

<tr>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->

<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img style="width: 310px; height:auto;" src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++; ?>
</td>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->
<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img width=310px src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++; ?>
 
</td>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->
<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img width=310px src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++;?>

</td>


</tr>



<?php } 
	
	unset($fileName);
unset($pcNames);

	
?>

</table>


<table  width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
    <td>
<!--     <font style="font-family: arial; font-size:18px; color:#000000">&nbsp;&nbsp;Plan</font>     -->
    </td>
  </tr>  
</table>
<?php

if($numFolderPC>0){ 
	$numPCs = 0;
  for($numFs=0;$numFs<$numFolderPC;$numFs++){ 
$dirPC = "PlanCapture/".$row_patientinfo['Hospital_ID']."/".$fName[$numFs];
// Open a directory, and read its contents      
// num folders

if(strcmp(substr($dirPC,22,3),'DVH')==0){ 
	echo(substr($pcNames[$idP],22,3));
	$pcNames[$numPCs] = $dirPC;
	$numPCs++;
}

if (is_dir($dirPC)){                              
  if ($dh = opendir($dirPC)){       
    $numFile = 0;
              
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0 and strcmp($file,"photothumb.db")!=0) { 
        
        $fileName[$numFile] = $file;

        $numFile++;

      }
    }                                           
    closedir($dh);                              
  }                                             
}           
}
}

?>




<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
<?php $idC =0;$idP =0; for($idSet=0;$idSet<ceil(($numPCs)/3);$idSet++){   ?>
<tr>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong><?php echo(substr($pcNames[$idP],22,100)); ?></strong></center></h7>
<?php $idP++; ?>

</td>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong><?php echo(substr($pcNames[$idP],22,100)); ?></strong></center></h7> 
<?php $idP++; ?>
</td>

<td width="310px" height="30px" bgcolor="#1C73B9" style="color: #FFFFFF">
<h7><center><strong><?php echo(substr($pcNames[$idP],22,100)); ?></strong></center></h7>
<?php $idP++; ?>
</td>


</tr>

<tr>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->

<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img style="width: 310px; height:auto;" src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++; ?>
</td>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->
<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img width=310px src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++; ?>
 
</td>

<td width="310px">
<!-- <h5><strong><?php echo(substr($pcNames[$idC],22,100)); ?></strong></h5> -->
<a href=<?php if($idC<$numPCs)echo("'".$pcNames[$idC]."'"); ?> target=_blank ><img width=310px src=<?php if($idC<$numPCs)echo($pcNames[$idC]); ?> ></a>
<?php $idC++;?>

</td>


</tr>



<?php } ?>

</table>







<?php $dumDose=0; ?>
<table class="typeCal" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
  	<tr height="30">
<!-- 	  	<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> Sun  </center></td>	  	 -->
	  	<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> Mon  </center></td>
		<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center>Tue</center></td> 
		<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Wed</center></td> 
		<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Thu</center></td>
		<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"> <center>Fri</center></td>		
<!-- 	  	<td width="192px" scope="row" bgcolor="#1C73B9" style="color: #FFFFFF"><center> Sat  </center></td> -->
		
  	</tr>

  	<?php
// 	echo($row_treatmentinfo[CT_Sim1]);	  	
// 	echo($row_treatmentinfo[RT_fin_f]);	  	
 	$weekDays= date("w",strtotime($row_treatmentinfo[CT_Sim1]));  
	$Rtdate = strtotime($row_treatmentinfo[CT_Sim1]); // 20120101 같은 포맷도 잘됨
	$mondayChecker = "-".$weekDays." days";
	$stDate = date("m/d/y",strtotime($mondayChecker,strtotime($row_treatmentinfo[CT_Sim1])));

  if(strlen($row_treatmentinfo[CT_Sim1])<2){
      $stDate = date("m/d/y",strtotime($mondayChecker,strtotime($row_treatmentinfo[RT_start1])));

  }
  $diffDate = strtotime($row_treatmentinfo[CT_Sim1]);
  if(strlen($row_treatmentinfo[CT_Sim1])<2){
      $diffDate = strtotime($row_treatmentinfo[RT_start1]);

  }


	$RtdateF = strtotime($row_treatmentinfo[RT_fin_f]);
	$diff = abs(strtotime($row_treatmentinfo[RT_fin_f]) -  $diffDate);
	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff/(60*60*24)));
	

 
 
// 	echo(floor($days/7));

	$numWeeks = floor($days/7);
	
	
	$dayPlus = 0;
	$Mon = substr($stDate,0,2);
  if($numWeeks<50){
	for ($idWeeks = 0; $idWeeks<$numWeeks+3; $idWeeks++){ 
  	?>
  	
  	<tr height="30">
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

          mysqli_query($test, "set session character_set_client=utf8");
          mysqli_query($test, "set session character_set_connection=utf8");  
          mysqli_query($test, "set session character_set_results=utf8"); 


          $holdate = date("Y-m-d",strtotime($tDate));
          $holquery = "Select * from Holiday where solar_date like '$holdate'";
			  	$row_holiday = mysqli_fetch_assoc(mysqli_query($test, $holquery));
          if(strlen($row_holiday[memo])>0){
            $bCol = "#EEEEEE";

          }
          $holmarker = $row_holiday[memo];
          mysqli_query($test, "set session character_set_connection=latin1;");
          mysqli_query($test, "set session character_set_results=latin1;");
          mysqli_query($test, "set session character_set_client=latin1;");


			  	?>
			  	
			  	
			  	<?php
				  	 	if(date("w",strtotime($tDate))!=6 and date("w",strtotime($tDate))!=0){   

        $tDates = date("n/j/y",strtotime($tDate));      

        $hisID = $row_patientinfo['Hospital_ID'];
/*
        $queryStat = "Select Dose,Stat from Timer where (date1 like '$tDates' AND Hospital_ID like '$hisID')";
        $StatInfo = mysqli_query($test, $queryStat )  ;
        $row_Statinfo = mysqli_fetch_assoc($StatInfo);
        $total_Statinfo = mysqli_num_rows($StatInfo);
        $sql_Stat = mysqli_query($test, $queryStat);
          $DoseM = mysqli_result($sql_Stat, 0,"Dose");
          $Stated = mysqli_result($sql_Stat, 0,"Stat");

        if($Stated>2){
          $celCanceled = "background='Cancel.png' ";
        }
        else{
          $celCanceled = "";
        }
*/

				?>

	  	<td  <?php echo($celCanceled); ?>  height="70px" width="192px" scope="row" bgcolor=<?php echo($bCol);?> style="color: #000000">
		  		<p align="right">

<?php			  	

			  	
			  $dateMarker = "<font color=$tCol size = '3'>".substr($tDate,$strInits,$strLens)."</font>";
/*
			  	echo("<font color=$tCol>");
				echo(substr($tDate,$strInits,$strLens));  	
				echo("</font>");
*/
// 				echo($dateMarker);
				

			?>
		  	
		  	
		  	<?php
			$doseMarker = "";
			if(strcmp($row_treatmentinfo[RT_start1],$tDates)==0){
				$fxDose = $row_treatmentinfo[dose1]/$row_treatmentinfo[Fx1];
				$dateMarker = "<font color=red size = '3'>START </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site1]<br>$row_treatmentinfo[dose1] Gy: $fxDose Gy X $row_treatmentinfo[Fx1] fx.<br>";	
			}
			if(strcmp($row_treatmentinfo[RT_fin_f],$tDates)==0){
				$dateMarker = "<font color=red size = '3'>FIN </font>".$dateMarker;
			}

	  		$hisID = $row_patientinfo['Hospital_ID'];
			$queryMemo = "Select * from MeetingList where (Date like '$tDates' AND Hospital_ID like $hisID)";

			$MemoInfo = mysqli_query($test, $queryMemo )  ;
			$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
			$total_Memoinfo = mysqli_num_rows($MemoInfo);
			
			if($total_Memoinfo>0){
				$dateMarker = "<font color = #9753e1 size = '3'>EXAM </font>".$dateMarker;
			}




			for($idresim=2;$idresim<$row_treatmentinfo[idx]+1;$idresim++){
				$reorder = "RT_start".$idresim;
				$Fxorder = "Fx".$idresim;
				$Doseorder = "dose".$idresim;

				if(strcmp($row_treatmentinfo[$reorder],$tDates)==0 and strcmp($row_treatmentinfo[$Fxorder],'0') !=0){
					$fxDose = $row_treatmentinfo[$Doseorder]/$row_treatmentinfo[$Fxorder];
					$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
					$doseMarker = "$row_treatmentinfo[Site2]<br>$row_treatmentinfo[dose2] Gy: $fxDose Gy X $row_treatmentinfo[Fx2] fx.<br>";	
					
				}
				
			}


/*
			if(strcmp($row_treatmentinfo[RT_start2],$tDates)==0 and strcmp($row_treatmentinfo[Fx2],'0') !=0){
				$fxDose = $row_treatmentinfo[dose2]/$row_treatmentinfo[Fx2];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site2]<br>$row_treatmentinfo[dose2] Gy: $fxDose Gy X $row_treatmentinfo[Fx2] fx.<br>";	
				
			}
			if(strcmp($row_treatmentinfo[RT_start3],$tDates)==0 and strcmp($row_treatmentinfo[Fx3],'0') !=0){
				$fxDose = $row_treatmentinfo[dose3]/$row_treatmentinfo[Fx3];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site3]<br>$row_treatmentinfo[dose3] Gy: $fxDose Gy X $row_treatmentinfo[Fx3] fx.<br>";	
			}
			if(strcmp($row_treatmentinfo[RT_start4],$tDates)==0 and strcmp($row_treatmentinfo[Fx4],'0') !=0){
				$fxDose = $row_treatmentinfo[dose4]/$row_treatmentinfo[Fx4];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site4]<br>$row_treatmentinfo[dose4] Gy: $fxDose Gy X $row_treatmentinfo[Fx4] fx.<br>";	

			}
			if(strcmp($row_treatmentinfo[RT_start5],$tDates)==0 and strcmp($row_treatmentinfo[Fx5],'0') !=0){
				$fxDose = $row_treatmentinfo[dose5]/$row_treatmentinfo[Fx5];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site5]<br>$row_treatmentinfo[dose5] Gy: $fxDose Gy X $row_treatmentinfo[Fx5] fx.<br>";	
			}
			if(strcmp($row_treatmentinfo[RT_start6],$tDates)==0 and strcmp($row_treatmentinfo[Fx6],'0') !=0){
				$fxDose = $row_treatmentinfo[dose6]/$row_treatmentinfo[Fx6];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site6]<br>$row_treatmentinfo[dose6] Gy: $fxDose Gy X $row_treatmentinfo[Fx6] fx.<br>";	
			}
			if(strcmp($row_treatmentinfo[RT_start7],$tDates)==0 and strcmp($row_treatmentinfo[Fx7],'0') !=0){
				$fxDose = $row_treatmentinfo[dose7]/$row_treatmentinfo[Fx7];
				$dateMarker = "<font color=blue size = '3'>RF </font>".$dateMarker;
				$doseMarker = "$row_treatmentinfo[Site7]<br>$row_treatmentinfo[dose7] Gy: $fxDose Gy X $row_treatmentinfo[Fx7] fx.<br>";	
			}
*/


      if(strcmp($row_treatmentinfo[RT_start2],$tDates)==0 and strcmp($row_treatmentinfo[Fx2],'0') ==0){
        $fxDose = $row_treatmentinfo[dose2]/$row_treatmentinfo[Fx2];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  
        
      }
      if(strcmp($row_treatmentinfo[RT_start3],$tDates)==0 and strcmp($row_treatmentinfo[Fx3],'0') ==0){
        $fxDose = $row_treatmentinfo[dose3]/$row_treatmentinfo[Fx3];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  
      }
      if(strcmp($row_treatmentinfo[RT_start4],$tDates)==0 and strcmp($row_treatmentinfo[Fx4],'0') ==0){
        $fxDose = $row_treatmentinfo[dose4]/$row_treatmentinfo[Fx4];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  

      }
      if(strcmp($row_treatmentinfo[RT_start5],$tDates)==0 and strcmp($row_treatmentinfo[Fx5],'0') ==0){
        $fxDose = $row_treatmentinfo[dose5]/$row_treatmentinfo[Fx5];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  
      }
      if(strcmp($row_treatmentinfo[RT_start6],$tDates)==0 and strcmp($row_treatmentinfo[Fx6],'0') ==0){
        $fxDose = $row_treatmentinfo[dose6]/$row_treatmentinfo[Fx6];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  
      }
      if(strcmp($row_treatmentinfo[RT_start7],$tDates)==0 and strcmp($row_treatmentinfo[Fx7],'0') ==0){
        $fxDose = $row_treatmentinfo[dose7]/$row_treatmentinfo[Fx7];
        $dateMarker = "<font color=blue size = '3'>PLCH </font>".$dateMarker;
        $doseMarker = "";  
      }

      if(strcmp($bCol,"#EEEEEE")==0){
        // $fxDose = $row_treatmentinfo[dose7]/$row_treatmentinfo[Fx7];
        $dateMarker = "<font color=#666666 size = '3'>$holmarker </font>".$dateMarker;
        $doseMarker = "";  
      }

      $bCol = "#EEEEEE";
			
			
			if(strcmp($row_treatmentinfo[CT_Sim1],$tDates)==0){
				$dateMarker = "<font color=#00884b size = '3'>SIM </font>".$dateMarker;
				
			}
			
			for($idresim=2;$idresim<$row_treatmentinfo[idx]+1;$idresim++){
				$Simorder = "CT_Sim".$idresim;

				if(strcmp($row_treatmentinfo[$Simorder],$tDates)==0){
					$dateMarker = "<font color=#00884b size = '3'>RESIM </font>".$dateMarker;
					
				}
				
			}
			


        $recMarker = "";

        for($i=0; $i<$total_Statinfo; $i = $i+1){ 

          if($DoseM>0){
            $dumDose = $dumDose+(float)$DoseM;
            $curDose = sprintf("%.2f", $dumDose);
            $recMarker = $curDose;
          }

          if($Stated>0){
            $recMarker = $recMarker."/".$statVar[(int)$Stated]." ";
          }


          }


      echo "$recMarker";
      $recMarker = "";
			echo($dateMarker);
			echo("</p>");
			echo($doseMarker);
			
			
			?>



		  	<?php
		  		$hisID = $row_patientinfo['Hospital_ID'];
				$queryMemo = "Select * from OrderTemp where (Date1 like '$tDates' AND Hospital_ID like '$hisID')";

				$MemoInfo = mysqli_query($test, $queryMemo )  ;
				$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
				$total_Memoinfo = mysqli_num_rows($MemoInfo);
				$sql_Memo = mysqli_query($test, $queryMemo);
				if($total_Memoinfo>0){
					echo("Order");
				}
				
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$Memo = mysqli_result($sql_Memo, $i,"Memo1");
					 echo("<li>");echo($Memo); echo("</li><br>");
					}
			  	?>




		  	
		  	<?php
		  		$hisID = $row_patientinfo['Hospital_ID'];
				$queryMemo = "Select * from MemoTemp where (Date1 like '$tDates' AND Hospital_ID like '$hisID')";

				$MemoInfo = mysqli_query($test, $queryMemo )  ;
				$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
				$total_Memoinfo = mysqli_num_rows($MemoInfo);
				if($total_Memoinfo>0){
					echo("Notice<br>");
				}
				$sql_Memo = mysqli_query($test, $queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$Memo = mysqli_result($sql_Memo, $i,"Memo1"); 
						if(trim(strlen($Memo))>15){
							$Memo = iconv_substr($Memo,0,14,"utf-8")." ...";			
						}
					
					 echo("- ");echo($Memo); echo("<br>");
					}
			  	?>
		  	
		  	
		  	
		  	
	  	</td>
	  	<?php
		  	}
		  	}
		  	?>
	
  	</tr>

  	
  	
  	
  	
  	<?php
	  	}
    }
	  	?>


</table>

<table class="type05" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="left">

<?php
// 폴더명 지정
$dir = "PlanDoc/".$row_patientinfo[Hospital_ID]."/";

// 핸들 획득
$handle  = opendir($dir);
 
$files = array();
 
// 디렉터리에 포함된 파일을 저장한다.
// while (false !== ($filename = readdir($handle))) {
//     if($filename == "." || $filename == ".."){
//         continue;
//     }
 
//     if(is_file($dir . "/" . $filename)){
//         $files[] = $filename;
//     }
// }
 
// 핸들 해제 
// closedir($handle);
 
// 정렬, 역순으로 정렬하려면 rsort 사용
// sort($files);
 
// 파일명을 출력한다.
// foreach ($files as $f) {
//     $impath = $dir.$f;
//     echo $f;

//     echo "<tr><td>";
//     echo "<img src=$impath width=960px>";
//     echo "</td></tr>";
// } 


?>

</table>















<!-- Patient setup photo -->
<?php

if(strlen($row_patientinfo['RO_ID'])>3){ 
$dir = "PatientPhoto/Setup/".$row_patientinfo['RO_ID'];
// Open a directory, and read its contents      
// num folders
$numFolder = 0;
if (is_dir($dir)){                              
  if ($dh = opendir($dir)){                     
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0) { 
        $fName[$numFolder] = $file;

        $numFolder++;

      }
    }                                           
    closedir($dh);                              
  }                                             
}           
}

?>


<table  width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
    <td>
    <font style="font-family: arial; font-size:18px; color:#000000">&nbsp;&nbsp;Set-up (Click to enlarge)</font>    
    
    </td>
  </tr>  
</table>


<?php

if($numFolder>0){ 
  for($numFs=0;$numFs<$numFolder;$numFs++){ 
$dir = "PatientPhoto/Setup/".$row_patientinfo['RO_ID']."/".$fName[$numFs];
// Open a directory, and read its contents      
// num folders

if (is_dir($dir)){                              
  if ($dh = opendir($dir)){       
    $numFile = 0;
              
    while (($file = readdir($dh)) !== false){  
      if(strcmp($file,".") != 0 and strcmp($file,"..")!=0 and strcmp($file,"Thumbs.db")!=0 and strcmp($file,"@eaDir")!=0 and strcmp($file,"photothumb.db")!=0) { 
        
        $fileName[$numFile] = $file;

        $numFile++;

      }
    }                                           
    closedir($dh);                              
  }                                             
}           


?>

<table width="960px" border="0" cellspacing="0" cellpadding="0" align="left">
<tr>
    <td>
      <br>
    <font style="font-family: arial; font-size:15px; color:#000000"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo($fName[$numFs]); ?></strong></font>    
    </td>
  </tr>  
</table>

<table class="type05" width="960px" border="0" cellspacing="1" cellpadding="5" align="left">
<?php $idC =0; for($idSet=0;$idSet<ceil(($numFile)/3);$idSet++){   ?>
<tr>

<td>
<?php if($idC<$numFile){?><a href = <?php echo($dir."/".$fileName[$idC]);?> target=_blank><img width=310px src=<?php echo($dir."/".$fileName[$idC]); ?> ></a> <?php } ?>
<?php $idC++; ?>
</td>

<td>
<?php if($idC<$numFile){?><a href = <?php echo($dir."/".$fileName[$idC]);?> target=_blank><img width=310px src=<?php echo($dir."/".$fileName[$idC]); ?> ></a> <?php } ?>
<?php $idC++; ?>
 
</td>

<td>
<?php if($idC<$numFile){?><a href = <?php echo($dir."/".$fileName[$idC]);?> target=_blank><img width=310px src=<?php echo($dir."/".$fileName[$idC]); ?> ></a> <?php } ?>
<?php $idC++;?>

</td>


</tr>



<?php } ?>

</table>
<?php } }?>




<?php
	$planquery = "select * from PlanExport where Hospital_ID like '$row_patientinfo[Hospital_ID]' order by PlanID";

	$planext = mysqli_query($test, $planquery);	
			$planDetails = mysqli_fetch_assoc($planext);

	if(mysqli_num_rows($planext)>0){

?>
<table  width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr>
    <td>
    <font style="font-family: arial; font-size:18px; color:#000000">&nbsp;&nbsp;Plan details from Dicom RT</font>    
    
    </td>
  </tr>  
</table>

<table class="type05" id="DataTable" width="960px" border="0" cellspacing="1" cellpadding="1" align="left">
<tr he>
	<td height="20px" align="center" bgcolor="#1C73B9" style="color: #FFFFFF">Plan ID</td>
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Field ID</td>
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Description</td>
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">MU</td>		
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Beam Type</td>	
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Control Points</td>	
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Radiation Type</td>	
	<td height = "20px" align="center"  bgcolor="#1C73B9" style="color: #FFFFFF">Energy</td>
	
	<td height = "20px" align="center"   bgcolor="#1C73B9" style="color: #FFFFFF">Position</td>	
	<td height = "20px" align="center"   bgcolor="#1C73B9" style="color: #FFFFFF">Wedge</td>	
	<td height = "20px" align="center"   bgcolor="#1C73B9" style="color: #FFFFFF">Bolus</td>	
</tr>
<?php
	$planName = '';
	$bgcolPlan = 0; #b0bef3 /* ultramarine 20 (ibm design colors) */
	for($idr=0;$idr<mysqli_num_rows($planext);$idr++){
		if(strcmp($planName,$planDetails[PlanID])!=0){
			$planName = $planDetails[PlanID];
			$bgcolPlan ++;
		}
		
		if($bgcolPlan%2==0){
			$bcoP = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
			
		}
		else{
			$bcoP = "#FFFFFF";
		}
		echo("<tr>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[PlanID]);
		echo("</td>");

		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[FieldID]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[FieldDescription]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[MU]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[BeamType]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[CP]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[Energy]);
		echo("</td>");
		if(strcmp($planDetails[Energy],"ELECTRON")==0){
			$runit = " MeV";
		}
		else{
			$runit = " MV";
		}
		
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[RadiationType].$runit);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[Position]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[Wedge]);
		echo("</td>");
		echo("<td  align='center' bgcolor = $bcoP>");
		echo($planDetails[bolus]);
		echo("</td>");
		
		
		
		echo("</tr>");
				$planDetails = mysqli_fetch_assoc($planext);

	}
	
?>
</table>

<?php
	
	}?> 






</td>
</tr>
</table>



<br>


<!--
<a onclick="this.nextSibling.style.display=(this.nextSibling.style.display=='none')?'block':'none';" href="javascript:void(0)"> 
&nbsp;<strong>Plans (extracted from Dicom RT) (Click to open/close) <?php if($olders>0){echo("<font color=red>".$olders2. " previous courses</font>");} ?></strong>
</a><div style="DISPLAY: none">
-->



<!-- </div> -->

<br>
<br>





<!-- Routine select -->

<div class="modal fade" id="Routine1" role="dialog">
    	<div class="modal-dialog modal-sm">
      		<div class="modal-content">
       	 		<div class="modal-header">
	       	 		Head & Neck
       	 		</div>
	         	<div class="modal-body">
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R1" name="Method_R1">
									<option value="" selected="selected">Select</option>
                    <?php for($idN=0;$idN<$numtech;$idN++){  ?>
                    <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
                    <?php } ?>

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
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R2" name="Method_R2">
									<option value="" selected="selected">Select</option>
                    <?php for($idN=0;$idN<$numtech;$idN++){  ?>
                    <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
                    <?php } ?>

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
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R3" name="Method_R3">
									<option value="" selected="selected">Select</option>
        <?php for($idN=0;$idN<$numtech;$idN++){  ?>
        <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
        <?php } ?>
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
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R4" name="Method_R4">
									<option value="" selected="selected">Select</option>
        <?php for($idN=0;$idN<$numtech;$idN++){  ?>
        <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
        <?php } ?>
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
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_R5" name="Method_R5">
									<option value="" selected="selected">3D Conformal</option>
							        <?php for($idN=0;$idN<$numtech;$idN++){  ?>
							        <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
							        <?php } ?>
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
		         		<table class = "type1" id="Routine_Table" width="80%" border="0" cellspacing="0">
			         		<tr>
				         		<td>Method</td>
				         		<td></td>
				         		<td>Start</td>
			         		</tr>
			         		<tr>
				         		<td><select class = "form-control input-sm" id = "Method_Prostate" name="Method_Prostate">
									<option value="" selected="selected">Select</option>
        <?php for($idN=0;$idN<$numtech;$idN++){  ?>
        <option value=<?php echo($techIdd[$idN]); ?>><?php echo($techIdd[$idN]); ?></option>
        <?php } ?>
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
/*
	print_r($techInt);
	print_r($techIdd);
*/
	
// 			row += "<td><select class = 'form-control input-sm' name='Method[]'><option value='' selected='selected'>Select</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
	
	?>	
    
    
    
    

<?php
	
	
mysqli_free_result($clinicalinfo);

mysqli_free_result($patientinfo);

mysqli_free_result($treatmentinfo);
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
	              dateFormat:'y/m/d'
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
var fXBreast = [25, 5];
var fXProstate = [21, 9];

var CommentDate = new Date();
var Comment_year = CommentDate.getFullYear()%2000;
var Comment_month = CommentDate.getMonth()+1;
var Comment_date = CommentDate.getDate();
			
var Comment_Finish_ = [Comment_year,Comment_month,Comment_date];
var Comment_Finish = Comment_Finish_.join("/");

var OrderDate = new Date();
var Order_year = OrderDate.getFullYear()%2000;
var Order_month = OrderDate.getMonth()+1;
var Order_date = OrderDate.getDate();
			
var Order_Finish_ = [Order_year,Order_month,Order_date];
var Order_Finish = Order_Finish_.join("/");





var HistoryDate = new Date();
var History_year = HistoryDate.getFullYear()%2000;
var History_month = HistoryDate.getMonth()+1;
var History_date = HistoryDate.getDate();
			
var History_Finish_ = [History_month,History_date,History_year];
var History_Finish = History_Finish_.join("/");



var Delay1_ = 0, Delay2_ = 0, Delay3_ = 0, Delay4_ = 0, Delay5_ = 0, Delay6_ = 0, Delay7_ = 0;

var Start_Date = <?php echo json_encode($row_treatmentinfo['RT_start1']);?>; //진료가 시작되는  날짜
var Finish_Date = <?php echo json_encode($row_treatmentinfo[$RT_fin_f]); ?>; //진료가 끝나는 날짜	





$(function() {
	$("#addMeetingDate").click(function() {
		var Site = $('#primary_menu').val();
		var subSite = $('#sub_site').val();
		Start_Date = new Date(Start_Date);
		Finish_Date = new Date(Finish_Date);
		alert(subSite);
		
		var FD_year = Finish_Date.getFullYear()%2000;
		var FD_month = Finish_Date.getMonth()+1;
		var FD_date = Finish_Date.getDate();
				
		var Finish_Date_ = [FD_month,FD_date,FD_year];
		var Finish_Date_ = Finish_Date_.join("/");

		
		if(Site=="HN"){
			var Meet=[];
			var SD_year = Start_Date.getFullYear()%2000;
			var SD_month = Start_Date.getMonth()+1;
			var SD_date = Start_Date.getDate();
			var SD_yoil = Start_Date.getDay();
			
			var etc = 4 - SD_yoil;							// 목요일(4)
			var Start_Date_ = [SD_month,SD_date,SD_year];
			var Start_Date_ = Start_Date_.join("/");;
				
			Meet[0] = Start_Date_;
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
				Start_Date.setDate(Start_Date.getDate() + 7);
				i++;
			}
			Meet[i] = Finish_Date_;
			
			for(var j=0; j<=i; j++){
				
				var Meet_Count = j+1;
				var	row = "<tr>";
					row += "<td><center>"+Meet_Count+".</center></td>";
					row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count+"' type='MeetDate' name= 'MeetDate[]' value ='"+Meet[j]+"' ></td>"
					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' ></td>"
			
			
					row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
					row += "</tr>";
				$("#MeetingTable").append(row);
				$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		
			}
			
		}else if(subSite=="Lung"){
			
			var Meet=[];
			var SD_year = Start_Date.getFullYear()%2000;
			var SD_month = Start_Date.getMonth()+1;
			var SD_date = Start_Date.getDate();
			var SD_yoil = Start_Date.getDay();
			
			var etc = 4 - SD_yoil;							// 목요일(4)
			var Start_Date_ = [SD_month,SD_date,SD_year];
			var Start_Date_ = Start_Date_.join("/");;
				
			Meet[0] = Start_Date_;
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
				Start_Date.setDate(Start_Date.getDate() + 7);
				i++;
			}
			Meet[i] = Finish_Date_;
			
			for(var j=0; j<=i; j++){
				
				var Meet_Count = j+1;
				var	row = "<tr>";
					row += "<td><center>"+Meet_Count+".</center></td>";
					row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count+"' type='MeetDate' name= 'MeetDate[]' value ='"+Meet[j]+"' ></td>"
					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' ></td>"
			
			
					row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
					row += "</tr>";
				$("#MeetingTable").append(row);
				$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		
			}
			
			
			
		}else if(subSite=="Eshphagus"){
			
		}else if(subSite=="Brain"){
			
			var holiday = new Array("<?=implode ("\",\"", $holiday); ?>");
			
		
			var Meet=[];
			var SD_year = Start_Date.getFullYear()%2000;
			var SD_month = Start_Date.getMonth()+1;
			var SD_date = Start_Date.getDate();
			var SD_yoil = Start_Date.getDay();
			
			var Start_Date_ = [SD_month,SD_date,SD_year];
			var Start_Date_ = Start_Date_.join("/");;
				
			Meet[0] = Start_Date_;
			
			Start_Date.setDate(Start_Date.getDate() + 1);	
			
			var idx = 0;
			var idx_ = 0;
			
			while(idx_ < 16){		//16번 진료 후의 날짜를 구하기 위한 While문
				var SD_year = Start_Date.getFullYear()%2000;
				var SD_month = Start_Date.getMonth()+1;
				var SD_date = Start_Date.getDate();
				var SD_yoil = Start_Date.getDay();
				
				var Start_Date_ = [SD_month,SD_date,SD_year];
				var Start_Date_ = Start_Date_.join("/");
				
				var FindIndex = holiday.indexOf(Start_Date_);
				if(FindIndex == '-1' && SD_yoil !='6' && SD_yoil !='0'){
						idx_ = idx_ + 1;
				}	
				Start_Date.setDate(Start_Date.getDate() + 1);
				
				
				idx = idx + 1;	
			}
			
			Meet[1] = Start_Date_;
			Meet[2] = Finish_Date_;
			
			
			for(var j=0; j<=2; j++){
				
				var Meet_Count = j+1;
				var	row = "<tr>";
					row += "<td><center>"+Meet_Count+".</center></td>";
					row += "<td><input class = 'form-control input-sm ' id = 'MeetPicker"+Meet_Count+"' type='MeetDate' name= 'MeetDate[]' value ='"+Meet[j]+"' ></td>"
					row += "<td><input class = 'form-control input-sm ' type='Meet' name= 'Meet[]' ></td>"
			
			
					row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
					row += "</tr>";
				$("#MeetingTable").append(row);
				$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		
			}
			
			
			
		}else if(subSite=="WBRT"){
			
		}
		
		
	});




	
	$("#addTR").click(function () {
		count++;
		
		var row = "<tr>";
			row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><?php echo $roomJava;?></select></td>";
			
			row += "<td><select class = 'form-control input-sm' name='Method[]'><option value='' selected='selected'>Select</option> <?php echo $techJava;?></select></td>";
// 			row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Site[]' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]'></td>"
			
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]'></td>"
// 			row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"			
			
			row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
			row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
			row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";

			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.
	
		$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});
		
		
		DateStart = DateStart+3;
		DateFinish = DateFinish+3;
		DateCT = DateCT+3;

	});
	$("#addTRFloat").click(function () {
		count++;
		
		var row = "<tr>";
			row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><?php echo $roomJava;?></select></td>";
			
			row += "<td><select class = 'form-control input-sm' name='Method[]'><option value='' selected='selected'>Select</option><?php echo $techJava;?></select></td>";
// 			row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Site[]' ></td>"
			row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]'></td>"
			
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]'></td>"
			row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]'></td>"
// 			row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"			
			
			row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
			row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
			row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";

			row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
			row += "</tr>";
		$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 떄문에 다음과 같은 코드를 선언한다.
	
		$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
		$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});
		
		
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
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
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
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"' selected='selected'>"+Method+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='30' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '10' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+C_Finish+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Start+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value ='"+P_Finish+"'></td>"
// 				row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"		
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R3[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+Fx_[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
// 							row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"		
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R4[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXLung[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine4_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine4_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine4_Fi[i]+"'></td>"
// 							row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"		
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
		var subsites = new Array();
		subsites[0] = '. Breast';
		subsites[1] = 'Tumor bed';

		var mtds = new Array();
		mtds[0] = '3D Conformal';
		mtds[1] = 'EB';
		var mtds2 = new Array();
		mtds2[0] = '3D Conformal';
		mtds2[1] = 'Electron';
		var lins = new Array();
		lins[0] = 'IX';
		lins[1] = 'IX';
		Routine3_S[1] = '';
		Routine3_Fi[0] = '';
		Routine3_Fi[1] = '';
		Routine3_C[0] = '';
		Routine3_C[1] = '';
		for(var i=0; i<2; i++){
			count++;
			
			var row = "<tr>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='"+lins[i]+"' selected='selected'>"+lins[i]+"</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+mtds[i]+"'  selected='selected'>"+mtds[i]+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
				
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Site[]' value='"+subsites[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R3[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXBreast[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
// 							row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"		
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
				row += "<td><select class = 'form-control input-sm' name='Method[]'><option value ='"+Method+"'  selected='selected'>"+Method+"</option><option value='3D Conformal'>3D Conformal</option><option value='VMAT'>VMAT</option><option value='EB'>Electron</option><option value='SBRT'>SBRT</option><option value='2D Conventional'>2D Conventional</option><option value='IMRT'>IMRT</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Linac[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><select class = 'form-control input-sm' name='Site[]'><option value='' selected='selected'>Select</option><option value='Versa'>Versa</option><option value='IX'>IX</option><option value='Infinity'>Infinity</option></select></td>";
				row += "<td><input class = 'form-control input-sm ' type='text' name= 'Dose[]' value='"+Dose_R3[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' name= 'Fx[]' value = '"+fXProstate[i]+"' ></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateCT+"' name= 'CT[]' value='"+Routine3_C[i]+"'></td>"
				
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateStart+"' name= 'Start[]' value='"+Routine3_S[i]+"'></td>"
				row += "<td><input class = 'form-control input-sm' type='text' id = 'Test_Datepicker"+DateFinish+"' name= 'Finish[]' value='"+Routine3_Fi[i]+"'></td>"
// 							row += "<td><input class = 'form-control input-sm' type='text' name= 'CTOrder[]' ></td>"
			row += "<td><input class = 'form-control input-sm' type='text' name= 'Ce[]' ></td>"		
				row += "<td><input type='text' class='form-control input-sm' id = 'Delay"+count+"' name = 'Delay[]' style='width:40px' /></td>"
				row += "<td><center><input type='button' class='btn btn-basic' style='width:30px' value = '+' id = 'Plus"+count+"'></center></td>";
				row += "<td><center><input type='button'  class='btn btn-basic' style='width:30px' value ='-' id = 'Minus"+count+"' ></center></td>";
			
				row += "<td><center><button type='button' class='btn btn-default'>-</button></center></td>";
				row += "</tr>";
				$("#DataTable").append(row);
		
		//동적할당으로 생선된 Datepicker는 작동이 안되기 때문에 다음과 같은 코드를 선언한다.
	
			$(document).find("input[name='Start[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='Finish[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
			$(document).find("input[name='CT[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'}); 
		
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
		
		$(document).find("input[name='OrderDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
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
		
		$(document).find("input[name='CommentDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
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
		
		$(document).find("input[name='HistoryDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     
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
		$(document).find("input[name='MeetDate[]']").removeClass('hasDatepicker').datepicker({dateFormat:'y/m/d'});     		
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


function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script> 
