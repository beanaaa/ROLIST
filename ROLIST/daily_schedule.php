<!doctype html>
<link rel="stylesheet" href="normalize.css">
<?php 	
if (!isset($_SESSION)) {
session_cache_expire(10);  
session_start();
  
  function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 

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

include("idc.php");

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
    $week_post = $_POST['weekago'];
    $md = "myki";



	$searchQ = $_POST['txt_search'];
	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}
	
	$linacname = $_POST['linacname'];
	if(strlen($_POST['linacname'])<1){
		$linacname = "versa";
	}
	$md2 = $_POST['mdname'];
		echo($md2);
	if(strcmp($md2,"KI")==0){
		$md = "myki";		
	}
	elseif(strcmp($md2,"JuL")==0){
		$md = "mhlee";		
	}
	elseif(strcmp($md2,"JaL")==0){
		$md = "mjlee";		
	}
	elseif(strcmp($uid,"KI")==0){
		$md = "myki";		
	}
	elseif(strcmp($uid,"JaL")==0){
		$md = "mjlee";		
	}
	elseif(strcmp($uid,"JuL")==0){
		$md = "mhlee";		
	}
	elseif(strcmp($md2,"Total")==0){
		$md = "";		
	}	
	else{
		$md = $md2;		
	}
	$screenRatio = 1.2;
	$siteInput = $_POST['sitename'];	
// 	$uid=$_POST['user'];

}

?>

<?php 
    
	if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
	require_once('Connections/test.php'); 
	}
	else{
 		$MM_restrictGoTo = "index.php";
 		header("Location: ". $MM_restrictGoTo); 
	require_once('Connections/test.php'); 

	}
	 ?>

<?php

if (!isset($_SESSION)) {
	session_start();
	function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup){
        // For security, start by assuming the visitor is NOT authorized.
		$isValid = False;
        
        // When a visitor has logged into this site, the Session variable MM_Username set equal to their username.
        // Therefore, we know that a user is NOT logged in if that Session variable is blank.
		if (!empty($UserName)) {
            // Besides being logged in, you may restrict access to only certain users based on an ID established when they login.
            // Parse the strings into arrays.
			$arrUsers  = explode(",", $strUsers);
			$arrGroups = explode(",", $strGroups);
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
    if ($_POST['permit'] != NULL) {
        $permitUser = $_POST['permit'];
    }
    if ($_GET['permit'] != NULL) {
        $permitUser = $_GET['permit'];
    }
    $week_post = $_POST['weekago'];
    $md = "myki";
	$md = $_POST['mdname'];	
	$siteInput = $_POST['sitename'];	
}

if ($permitUser == 1 | $permitUser == 2 | $permitUser == 3) {
	require_once('Connections/test.php');
} else {
	$MM_restrictGoTo = "index.php";
	header("Location: " . $MM_restrictGoTo);
	require_once('Connections/test.php');
}
?>
<html lang="ko">


<head>
<link rel="stylesheet" href="mainStyle.css">
 

<title>Radiation Oncology List</title>
</head>





<body>
	
	
	
	
<!-- Body starts here!!! -->


<?php
function get_time() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

if ($permitUser == 1 | $permitUser == 2 | $permitUser == 3) {
    require_once('Connections/test.php');
} else {
    $MM_restrictGoTo = "index.php";
    header("Location: " . $MM_restrictGoTo);
}

$conn = mysql_connect("localhost", "root", "dbsgksqls") or die(mysql_error());
mysql_select_db("test", $conn);
mysql_select_db($database_test, $test);

//오늘 날짜 출력 ex) 2013-04-10
$today_date      = date('Y-m-d');
//오늘의 요일 출력 ex) 수요일 = 3
$day_of_the_week = date('w');
//오늘의 첫째주인 날짜 출력 ex) 2013-04-07 (일요일임)

$seven          = 0 + $week_post;
$a_week_ago     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_ago_mon = $modify_day = date("Y-m-d", strtotime($a_week_ago . "+1day"));
// $a_week_after   = $a_week_ago;
$a_week_after     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));

if(strcmp($md, "myki")==0){
	$titleMd = "KI";
}
if(strcmp($md, "mjlee")==0){
	$titleMd = "JaL";
}
if(strcmp($md, "mhlee")==0){
	$titleMd = "JuL";
}


if(strcmp($titleMd,"KI")==0){
	$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";
} 
elseif(strcmp($titleMd,"JaL")==0){
	$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";
} 
elseif(strcmp($titleMd,"JuL")==0){
	$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";
} 

else{
	$queryMD = " ";
} 
if(strcmp($md2,"Total")==0){
	$queryMD = " ";		
}	

if(strcmp($siteInput,"CNS")==0 or strcmp($siteInput,"HN")==0 or strcmp($siteInput,"BRST")==0 or strcmp($siteInput,"THX")==0 or strcmp($siteInput,"GI")==0 or strcmp($siteInput,"GU")==0 or strcmp($siteInput,"GY")==0){
	$querySite = "(TreatmentInfo.primarysite LIKE '$siteInput') AND ";
} 
else{
	$querySite = "";
} 

// Patinet counting
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%3D Conformal%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$live3D = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%vmat%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveVmat = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%Versa%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveIx = mysql_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%IX%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveVersa = mysql_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND ClinicalInfo.Modality_var1 is not NULL" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$numCCRT = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$numTotal = mysql_num_rows($Recordset1);

// 	Per site
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CNS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCNS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%THX%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveTHX = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BRST%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBRST = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GI%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGI = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GU%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGU = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GY%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGY = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%MS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveMS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%SKIN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveSKIN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HMT%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHMT = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%PD%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$livePD = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BENIGN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBENIGN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CUPS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCUPS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%OTHER%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveOTHER = mysql_num_rows($Recordset1);


?>








<?php
	
$timeTd = $_POST['TimeTd'];	
$timeTm = $_POST['TimeTm'];	
$durTd = $_POST['DurTd'];	
$durTm = $_POST['DurTm'];	
$datesID = $_POST['TimeId'];	

for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTd='$timeTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}

?>



































































<?php
if(strcmp($linacname,"versa")==0){
	$lin = "VERSA";
}
if(strcmp($linacname,"infinity")==0){
	$lin = "INFINITY";
}
if(strcmp($linacname,"ix")==0){
	$lin = "IX";
}

?>

<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="500px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">치료시간표(<?php echo($lin) ?>) - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	Logged by <?php echo $uid;?>

	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
	(업데이트 노트-21 Feb 2018): 입월/외래정보가 EMR에서 추출되어 표시 됩니다. <br>
	(업데이트 노트-21 Feb 2018): 개인 아이디를 발급해 드립니다. 아이디와 비번을 저에게 알려주세요!(개인 회원가입 페이지는....죄송합니다) &nbsp;<a href="hist.php" target="_blank">more...</a>
</font>


<br>
<font style="font-family:arial; color: gray; font-size:10px" align="left">
<?php echo ""; ?>Total: <?php echo $numTotal;?>	
&nbsp;||&nbsp;	
<?php echo ""; ?> VMAT: <?php echo $liveVmat;?>			
<?php echo ""; ?> 3D: <?php echo $live3D;?>
<?php echo ""; ?> 3D: <?php echo $live2D;?>
&nbsp;||&nbsp;
<?php echo ""; ?> Versa: <?php echo $liveVersa;?>
<?php echo ""; ?> IX: <?php echo $liveIx;?>
<?php echo ""; ?> CCRT: <?php echo $numCCRT;?>
&nbsp;||&nbsp;

<?php
	
	if($liveCNS!=0){ echo " CNS: $liveCNS";}	
	if($liveHN!=0){ echo " HN: $liveHN";}	
	if($liveTHX!=0){ echo " THX: $liveTHX";}	
	if($liveBRST!=0){ echo " BRST: $liveBRST";}	
	if($liveGI!=0){ echo " GI: $liveGI";}	
	if($liveGU!=0){ echo " GU: $liveGU";}	
	if($liveGY!=0){ echo " GY: $liveGY";}	
	if($liveMS!=0){ echo " MS: $liveMS";}	
	if($liveSKIN!=0){ echo " SKIN: $liveSKIN";}	
	if($liveHMT!=0){ echo " HMT: $liveHMT";}	
	if($livePD!=0){ echo " PD: $livePD";}	
	if($liveBENIGN!=0){ echo " BENIGN: $liveBENIGN";}	
	if($liveCUPS!=0){ echo " CUPS: $liveCUPS";}	
	if($liveOTHER!=0){ echo " OTHER: $liveOTHER";}	
?>
</font>
		 
		 
		 
		 
</th>

<th  width="460px" valign="top" align="right">
	<form action="daily_schedule.php" method=post style="width:100px;height:30px;float:right;font:15px">
	<input class="form-control"  name="txt_search" type="text" id="txt_search" style="height:20px; width:200px; font-size:12px; font-family:arial;"  value="Name, Korean Name, Chart ID" />        
    <input type="hidden" name="permit" id = "permit" value="<?php echo $permitUser?>" />
	<input style="height:20px; width:70px; font-size:12px; font-family:arial;"  type="submit" value="SEARCH!">
</form>

</th>

</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<form name = "form110" id = "form110" method = "post" action ="daily_schedule.php">
	<th align=left width="30px">
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />		
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />		
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
				
		<input type = "submit" name = "week_" id = "week_" value="<" />
	</th>
</form>
<form name = "form111" id = "form112" method = "post" action ="daily_schedule.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = 0 />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="daily_schedule.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
		
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>
<form></form>
<form name = "formSite" id = "formSite" method = "post" action ="daily_schedule.php">
	<th align=left ><select name="sitename">
		<option name="sitename" value= <?php echo $siteInput; ?> selected><?php echo $siteInput; ?> </option>
		<option name="sitename" value="*" >Total</option>
		<option name="sitename" value="CNS" >CNS</option>
		<option name="sitename" value="HN" >HN</option>
		<option name="sitename" value="THX" >THX</option>
		<option name="sitename" value="BRST" >BRST</option>
		<option name="sitename" value="GI" >GI</option>
		<option name="sitename" value="GU" >GU</option>
		<option name="sitename" value="GY" >GY</option>
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' value='Submit' />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
		
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		
	</select>
	</th>
	<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
</form>	





<form id=form11 name=form11 method=post action="daily_schedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post action="daily_schedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="ix" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_schedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="versa" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_schedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="infinity" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

</p>

<form id=form11 name=form11 method=post target=_blank action="finrpt.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Finished />
		<input name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<!--
<form id=form11 name=form11 method=post target=_blank  action="daily_schedule_physician.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Todo-Physician />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
	</th>
</form>
-->


<form id=form11 name=form11 method=post target=_blank  action="live.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Active />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="monthlycount.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Count />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="testphpr2.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=ROOT-DB />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="daily_schedule_backup.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=DAILY />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post target=_blank  action="calendar.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Calendar />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="simschedule.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=SCHEDULER />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank action="N_register_all.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=NEW-PATIENT />
		<input name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>



		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

<form>
      <input type=submit name=btn_comment id=btn_comment value=C />

    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    











  
















<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Active patient list (</font> 
	        <span style="background-color:#B0C4DE"> Fin within a week </span> &  
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>

        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">치료</font></td>
			<td bgcolor="#777777" ><font color="white">어제</font></td>
			<td bgcolor="#777777" ><font color="white">오늘</font></td>
			<td bgcolor="#777777" ><font color="white">소요</font></td>
			<td bgcolor="#777777" ><font color="white">내일</font></td>
			<td bgcolor="#777777" ><font color="white">소요</font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
<!--
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
-->

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
<!-- 			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td> -->
<!-- 			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td> -->
			<td bgcolor="#777777"><font color="white">Aim</font></td>			

			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<?php

			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
			        </tr>

<?php


$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<1;$idDays++){ 
	
	
	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}
// echo($weekDays);
$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus like 1  OR PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL)" ;	

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'asc';
}


$query_Recordset1 .= " ORDER BY PatientInfo.TimeTd " . $order;

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());

$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
//     $idss = 
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($today_date . '+' . '0' . ' days'));
    $nullDate = "1980-01-01";
    
// 	echo($rowOrders["idx"]);
    if ((($ss >= $s1 && $ss < $s2) or ($ss >= $s1 && $s2 < $nullDate)) and $rowOrders["idx"]>=1  ) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    elseif ((($ss >= $s2 && $ss < $s3) or ($ss >= $s2 && $s3 < $nullDate)) and $rowOrders["idx"]>=2) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    elseif ((($ss >= $s3 && $ss < $s4) or ($ss >= $s3 && $s4 < $nullDate)) and $rowOrders["idx"]>=3) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    elseif ((($ss >= $s4 && $ss < $s5) or ($ss >= $s4 && $s5 < $nullDate)) and $rowOrders["idx"]>=4) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    elseif ((($ss >= $s5 && $ss < $s6) or ($ss >= $s5 && $s6 < $nullDate)) and $rowOrders["idx"]>=5) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    elseif ((($ss >= $s6 && $ss < $s7) or ($ss >= $s6 && $s7 < $nullDate)) and $rowOrders["idx"]>=6) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    elseif ((($ss >= $s7) && $s7>$nullDate) and $rowOrders["idx"]>=7) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
//     echo($pid[$iddd]);
//  	$sqlQuery = mysql_query("update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
}

$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];


?>



<?php
		
$today = date("n/j/y", time(0));

$idcolor   = 0;
$count     = 0;
$planIdInd = 0;

// $todayTime = 
$todayTime = date("H:i", mktime(0, +0, 10, 1, 32, 1997));

$StartTime = "08:30";
$morningStamp =0;
echo($prev_date);
$TimeCount = 0;
if ($totalRows_Recordset1!=0){
do {	
    $idx        = $row_Recordset1['idx']; //진료 횟수
    $RT_Start_f = "RT_start" . "$idx";
    $RT_Fin_f   = "RT_fin" . "$idx";
    $CT_Start_f = "CT_Sim" . "$idx";
    $Dose_f     = "dose" . "$idx";
    $Fx_f       = "Fx" . "$idx";
    $Field_f    = "Field" . "$idx";
    $Method_f   = "RT_method" . "$idx";
    $Site_f     = "Site" . "$idx";
    $Linac_f    = "Linac" . "$idx";
    $planIdInd++;
    
    $RT_Start_date = $row_Recordset1[$RT_Start_f];
    date_default_timezone_set("GMT+9");
    $Today_date = date("Y-m-d");
    
    // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
    $Today_date1 = date("Y-m-d", strtotime($RT_Start_date));
    
    //strotime 함수
    $todayIndicator = date("n/j/y", strtotime(date("y-n-j") . " -30 days"));    
    $RT_Start_sub = (strtotime($Today_date) - strtotime($Today_date1)) / 86400;
    
    $today = date("Y-m-d");
    $today = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
    $today = date("n/j/y", time(0));
    $totalDose = $row_Recordset1['dose1'] + $row_Recordset1['dose2'] + $row_Recordset1['dose3'] + $row_Recordset1['dose4'] + $row_Recordset1['dose5'];
    $totalFx   = $row_Recordset1['Fx1'] + $row_Recordset1['Fx2'] + $row_Recordset1['Fx3'] + $row_Recordset1['Fx4'] + $row_Recordset1['Fx5'];
    $count         = $count + 1;
    $tCount        = $count - 1;
    $RT_start_curr = "RT_start" . "$pid[$tCount]";
    $Linac_curr = "Linac" . "$pid[$tCount]";
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";   
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
if (strcasecmp(trim($row_Recordset1[$Linac_curr]),$linacname)==0){
            

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;
	
    if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
	        $simColor = "#e62325"; /* red 50 (ibm design colors) */
	        $strVal = "<strong>";
	        $strValR = "</strong>";	        
	}
    if (strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)) {
	        $simColor = "#1f57a4"; /* blue 60 (ibm design colors) */
	        $strVal = "<strong>";
	        $strValR = "</strong>";	        
	        
	}
    if (strtotime($row_Recordset1[$CT_sim_curr]) < strtotime($today)) {
	        $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
	        $strVal = "";
	        $strValR = "";	        
	        
	}
    
    
    $yoil = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);
    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
    
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	
    $ss2        = date('Y-m-d', strtotime($row_Recordset1["RT_fin_f"] . '-' . '7' . ' days'));
	
	$lunchS = "12:00";
	$lunchE = "13:30";
		
	$dayStart = "08:50";

	$dinnerS = "18:00";
	$dinnerE = "19:00";

    if ($ss2 < $ss) {
	        $bgcolorF = "#B0C4DE"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
	}


	if($TimeCount==0){		
		$time = strtotime($dayStart);
		$todayTable = date("H:i",strtotime('+0 minutes',$time));
		$sumTime = $todayTable;
		$durs = $row_Recordset1[DurTd];
	}
	else{
		$dura = "+". $durs. " minutes";
		$todayTable = date("H:i",strtotime($dura,strtotime($sumTime)));		
		if(strtotime($todayTable)>strtotime($lunchS) and strtotime($todayTable)<strtotime($lunchE)){
			$todayTable = $lunchE;
			echo "<tr  height=100px class='border_bottom'>";
			echo "<td colspan=1000 align=center bgcolor = #9fa7a7>LUNCH</td>";			 /* cool-gray 30 (ibm design colors) */
			echo "</tr>";			
		}
		if(strtotime($todayTable)>strtotime($dinnerS) and strtotime($todayTable)<strtotime($dinnerE)){
			$todayTable = $dinnerE;
			echo "<tr  height=100px class='border_bottom'>";
			echo "<td colspan=1000 align=center bgcolor = #9fa7a7>DINNER</td>";			 /* cool-gray 30 (ibm design colors) */
			echo "</tr>";			
		}		
		$sumTime = $todayTable;
		$durs = $row_Recordset1[DurTd];		
	}
	$TimeCount++;

	$tdHeight = round($row_Recordset1[DurTd]*30/12) ;
	echo($tdHeight);


    echo "<tr  height='$tdHeight px' class='border_bottom'>";


	?>
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>
		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>				
	<?php




    echo "<td bgcolor=$bgcolorF width = '30px'>  <strong><font>$StartTime</font></strong>  </td>";         /* #CC6699 (web safe colors) */

    echo "<td bgcolor=$bgcolorF width = '40px'>  
    <input class=form-control name=TimeTd[] type=text id=txt_name style=width:30px;height:10px;  value='$todayTable'  />
    <input type=hidden name=TimeId[] id = TimeId value=$row_Recordset1[Hospital_ID] />        
    </td>";        
    
    echo "<td bgcolor=$bgcolorF width = '20px'>  
    <input class=form-control name=DurTd[] type=text id=txt_name style=width:15px;height:10px;  value='$row_Recordset1[DurTd]'  />
    </td>";        
    
    echo "<td bgcolor=$bgcolorF width = '40px'>  
    <input class=form-control name=TimeTm[] type=text id=txt_name style=width:30px;height:10px;  value='$row_Recordset1[TimeTm]'  />
    </td>";         
    
    echo "<td bgcolor=$bgcolorF width = '20px'>  
    <input class=form-control name=DurTm[] type=text id=txt_name style=width:15px;height:10px;  value='$row_Recordset1[DurTm]'  />
    </td>";        
    
    
	if($StartTime>date("H:i", strtotime("12:00" . "+0 minutes")) and $morningStamp==0){
		$StartTime = date("H:i", strtotime("13:30" . "+0 minutes"));
		$morningStamp = 1;
	}
	

    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

//  CCRT or not
    if ($row_Recordset1[Modality_var1] == NULL){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> C </td>";
	}






	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=tester.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=user type=hidden id=user  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,100);      
//     echo " <td bgcolor=$bgcolorF width = '100px'>  $patholcrop  </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
//     echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm</td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

	
	
// 	Prescription 
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='180' align='left'><div class='memo'>";
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum]($row_Recordset1[Fx_sum])</strong>&nbsp;</font>";
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:</font><font color=red face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
		}
		else{
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
			
		}
		if($planIdx%2==0){
			echo("<br>");
		}

    }
    echo "</div></td>";
    



	if($workDay==1){
		$BColor = "#FFFF33"; /* #FFFF33 (web safe colors) */
	}
	elseif($workDay==2){
		$BColor = "#FFFF66"; /* #FFFF66 (web safe colors) */
	}
	elseif($workDay==3){
		$BColor = "#FFFF99"; /* #FFFF99 (web safe colors) */
	}
	elseif($workDay==4){
		$BColor = "#FFFFCC"; /* #FFFFCC (web safe colors) */
	}
	elseif($workDay==5){
		$BColor = "#FFFFEE"; /* White (web safe colors) */
	}
	else{
		$BColor = $bgcolorF;
	}
	
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$CT_sim_curr]))];
	if(strlen($row_Recordset1[$CT_sim_curr])<5){
		$weekyoil = " ";
	}
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $strVal $cropDateCT<br>$weekyoil</font>$strValR</td>";

// 	if($idcolor==1){
		$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
/*
    }
    else{
	        echo "<td rowspan = 1 width = '20px' align='center' rowspan = $totalRows_Recordset1 bgcolor=$BColor>  </td>";

    }
*/
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF>    </td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center  width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center  width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center  width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF>   $row_Recordset1[physician] </td>";}


		$sql_Memo = mysql_query("select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysql_query("select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysql_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysql_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysql_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    <div class="memo"><?php echo $Memo ?></div>

<?php
	}

//  Report edit button generation
/*
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {
        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=user type=hidden id=user  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=user type=hidden id=user  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }
*/
?>


</td>
</tr>


<?php
}
}
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>

</form>

<?php
	
$timeTd = $_POST['TimeTd'];	
$timeTm = $_POST['TimeTm'];	
$durTd = $_POST['DurTd'];	
$durTm = $_POST['DurTm'];	
$datesID = $_POST['TimeId'];	

for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTd='$timeTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}

?>











<!-- Apply status changes -->






<?php
	
$stat = $_REQUEST['statT'];	
$post_title = "php-curl 환자 입력 테스트 입니다.";
$post_url = "http://54.160.213.4/calpup.php?H_ID=106286605";
$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';

// 보낼 텍스트를 구성. 줄바꿈은 "\n"으로.
// http_build_query()를 이용하면 url 인코딩을 알아서 처리해 줌.
$telegram_text = "※ $stat\n{$post_title}\n{$post_url}";
$query_array = array(
    'chat_id' => '@pnuyhro',
    'text' => $telegram_text,
);
$request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?" . http_build_query($query_array);

// curl로 접속
$curl_opt = array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $request_url,
);
// $curl = curl_init($request_url);
// $res = curl_exec($curl);
?>


</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);

?>



</html>

