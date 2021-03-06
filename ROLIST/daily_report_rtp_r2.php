<!doctype html>
<meta charset="utf-8">

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
// 	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
				$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}
// 	echo($uid);
	$md2 = $_POST['mdname'];
	$pl2 = $_POST['plname'];
// 		echo($md2);
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
	$siteInput = $_POST['site'];	
	if(strlen($uid)<1){ 
	$uid=$_POST['username'];
	}
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
mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");

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

<script lang='javascript'>
	window.setTimeout("window.location.reload()", 6000000);
</script>

<style>
.photo3 {
    width: 25px; height: 25px;
    object-fit: cover;
    border-radius: 50%;
}	
</style>


</head>





<body>
	
	
	
	
<!-- Body starts here!!! -->


<?php
// echo "한국 표준시 (KST):" . "<br />\n";
  date_default_timezone_set("Asia/Seoul");
//   echo date("Y-m-d H:i:s") . "<br /><br />\n\n"; // (24시간제)


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

// -1 working day check
for ($dayCount=-1; $dayCount>-20; $dayCount--){
	$dcs = $dayCount . " day";
// 		echo($dcs);
	$beforeDay = date("m/d/y", strtotime($today. $dcs));
// 		echo($beforeDay);
	$daySql = "Select * from Holiday where solar_date like STR_TO_DATE('$beforeDay','%m/%d/%Y')";
	$sqlQuery = mysql_fetch_assoc(mysql_query($daySql));	
	$yoils = date('w', strtotime($beforeDay));
// 	echo($sqlQuery[solar_date]); echo("&nbsp");echo($yoils); echo("&nbsp");echo($today_date);
	$workingyest = $sqlQuery[solar_date];
	if($yoils !=0 and $yoils !=6 and strlen($sqlQuery[memo])==0){
		break;
	}
}
// +1 working day check
for ($dayCount=1; $dayCount<20; $dayCount++){
	$dcs = $dayCount . " day";
// 		echo($dcs);
	$beforeDay = date("m/d/y", strtotime($today. $dcs));
// 		echo($beforeDay);
	$daySql = "Select * from Holiday where solar_date like STR_TO_DATE('$beforeDay','%m/%d/%Y')";
	$sqlQuery = mysql_fetch_assoc(mysql_query($daySql));	
	$yoils = date('w', strtotime($beforeDay));
// 	echo($sqlQuery[solar_date]); echo("&nbsp");echo($yoils); echo("&nbsp");echo($today_date);
	$workingtom = $sqlQuery[solar_date];
	if($yoils !=0 and $yoils !=6 and strlen($sqlQuery[memo])==0){
		break;
	}
}





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


if(strcmp($pl2,"HY")==0){
	$queryPL = "(TreatmentInfo.planner LIKE '$pl2' OR CHAR_LENGTH(TreatmentInfo.planner) < 1) AND ";
} 
elseif(strcmp($pl2,"TJ")==0){
	$queryPL = "(TreatmentInfo.planner LIKE '$pl2' OR CHAR_LENGTH(TreatmentInfo.planner) < 1) AND ";
} 
elseif(strcmp($pl2,"HaJ")==0){
	$queryPL = "(TreatmentInfo.planner LIKE '$pl2' OR CHAR_LENGTH(TreatmentInfo.planner) < 1) AND ";
} 
elseif(strcmp($pl2,"HoJ")==0){
	$queryPL = "(TreatmentInfo.planner LIKE '$pl2' OR CHAR_LENGTH(TreatmentInfo.planner) < 1) AND ";
} 

else{
	$queryPL = " ";
} 
if(strcmp($pl2,"Total")==0){
	$queryPL = " ";		
}	







if(strcmp($siteInput,"CNS")==0 or strcmp($siteInput,"HN")==0 or strcmp($siteInput,"BRST")==0 or strcmp($siteInput,"THX")==0 or strcmp($siteInput,"GI")==0 or strcmp($siteInput,"GU")==0 or strcmp($siteInput,"GY")==0){
	$querySite = "(TreatmentInfo.primarysite LIKE '$siteInput') AND ";
} 
else{
	$querySite = "";
} 

// Patinet counting
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%3D Conformal%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$live3D = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%vmat%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveVmat = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%Versa%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveIx = mysql_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%IX%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveVersa = mysql_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Modality_var1 is not NULL" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$numCCRT = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$numTotal = mysql_num_rows($Recordset1);

// 	Per site
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CNS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCNS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%THX%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveTHX = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BRST%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBRST = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GI%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGI = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GU%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGU = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GY%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGY = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%MS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveMS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%SKIN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveSKIN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HMT%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHMT = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%PD%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$livePD = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BENIGN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBENIGN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CUPS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCUPS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%OTHER%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveOTHER = mysql_num_rows($Recordset1);


?>










<?php
	include("mainmenu.php");
	
	
	
$StatT = $_POST['StatT'];
$Actss = $_POST['Act'];

// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $sId from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryPhys = mysql_fetch_assoc(mysql_query("select physician from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryName = mysql_fetch_assoc(mysql_query("select Firstname, Secondname from PatientInfo where Hospital_ID = $hId"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
	echo("");
 	$sqlQuery = mysql_query("update TreatmentInfo set $sId = 1 where Hospital_ID = $hId");		
}	
// Status change!!!!
for($idstat = 0; $idstat<count($Actss); $idstat++){
	$hId = substr($Actss[$idstat],0,9);

	
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $sId from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryPhys = mysql_fetch_assoc(mysql_query("select physician from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryName = mysql_fetch_assoc(mysql_query("select Firstname, Secondname from PatientInfo where Hospital_ID = $hId"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
	echo("");
 	$sqlQuery = mysql_query("update TreatmentInfo set TrcNotice = 0 where Hospital_ID = $hId");		
//  	"Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $h_id"
}	
?>








































































<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="700px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">Plan List for RTP - <?php echo $titleMd; ?> <?php echo $pl2; ?> (<?php echo $a_week_after; ?>) </font> 	

	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
<!--
	(업데이트 노트-21 Feb 2018): 입월/외래정보가 EMR에서 추출되어 표시 됩니다. <br>
	(업데이트 노트-21 Feb 2018): 개인 아이디를 발급해 드립니다. 아이디와 비번을 저에게 알려주세요!(개인 회원가입 페이지는....죄송합니다) &nbsp;<a href="hist.php" target="_blank">more...</a>
-->
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
<th valign="top" align="right">
	<font color=gray>Logged by <?php echo $uid;?></font>
</th>


</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">
<!--
<form></form>
<form name = "form110" id = "form110" method = "post" action ="daily_report_rtp.php">
	<th align=left width="30px">
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />		
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />		
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
				
		<input type = "submit" name = "week_" id = "week_" value="<" />
	</th>
</form>
<form name = "form111" id = "form112" method = "post" action ="daily_report_rtp.php">
	<th align=left width="50px"><input type = hidden name = "weekago"	id ="weekago" value = 0 />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="daily_report_rtp.php">
	<th align=left width="50px"><input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
		
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>
<form></form>
<form name = "formSite" id = "formSite" method = "post" action ="daily_report_rtp.php">
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
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' value='Submit' />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		
	</select>
	</th>
	<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
</form>	
-->



<th>
	Physician: 
</th>

<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="KI" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="JaL" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="JuL" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

<th>
	Planner: 
</th>

<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="Total" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="HY" style=" height: 20; border:0px; background-color:#b0bef3 "></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="TJ" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="HaJ" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="HoJ" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>


		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    
<?php	
$Recordset1 = mysql_query($searchQuery, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
if($totalRows_Recordset1>0){ 
?>	
	    
	    
	    
	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">SEARCH </font>

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>

			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
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

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = $searchQuery;

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));



?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


	if ($totalRows_Recordset1>0){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
	
// 	$dayCount = 1;
// 	for($dayCount = 1:$dayCount <20; $dayCount++){
/*
*/
// 	}
	
	
// 	

    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}
	
	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "     <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}






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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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
}

?>




	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Action Required</font> 

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777" colspan=3><font color="white">Slved</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>

			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
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

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.TrcNotice like 1";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


	if ((strlen($row_Recordset1[$CT_sim_curr]) <=5) and ($pid[$tCount]!=1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}




	
	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal;	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td colspan=3 bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="Act[]" value=<?php echo($statValT); ?> >	
	</td>			
	



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>"; 
      echo "<input name=username type=hidden id=username  value=$uid/>";      
               
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "   <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}


		$sql_Memo = mysql_query("select Memo1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysql_query("select Date1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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



	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Plans (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>
	        <font style="font-size:12px"><font color='#3c6df0' style="font-size:12px">-1 영업일</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">오늘</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#00884b' style="font-size:12px">+1 영업일</span>  <font style="font-size:12px"> </font>	        	        	        

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<15;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryPL $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1' and (TreatmentInfo.P1 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '1' and (TreatmentInfo.P2 LIKE '0'))) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '1' and (TreatmentInfo.P3 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '1' and (TreatmentInfo.P4 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '1' and (TreatmentInfo.P5 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '1' and (TreatmentInfo.P6 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '1' and (TreatmentInfo.P7 LIKE '0')))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));



?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
// 		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
// 		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
		if (strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)) {
		$$bgcolorH = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
		$fontColorF = "#535a5a"; /* cool-gray 60 (ibm design colors) */
	}


	
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}


	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "     <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	
//     echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}

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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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

	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Waiting for target (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>
	        <font style="font-size:12px"><font color='#3c6df0' style="font-size:12px">-1 영업일</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">오늘</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#00884b' style="font-size:12px">+1 영업일</span>  <font style="font-size:12px"> </font>	        	        	        

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<15;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryPL $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '0' and (TreatmentInfo.P1 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '0' and (TreatmentInfo.P2 LIKE '0'))) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '0' and (TreatmentInfo.P3 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '0' and (TreatmentInfo.P4 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '0' and (TreatmentInfo.P5 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '0' and (TreatmentInfo.P6 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '0' and (TreatmentInfo.P7 LIKE '0')))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));



?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx and strtotime($row_Recordset1[$CT_sim_curr]) <= strtotime($today)) {

    $idcolor++;
    $totalDays++;


	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
// 		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
// 		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
		if (strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)) {
		$bgcolorH = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
		$fontColorF = "#535a5a"; /* cool-gray 60 (ibm design colors) */
	}


	
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}


	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "    <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	
//     echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}

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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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


	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Plan changes w/o Resim (within a week)</font> 

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>

			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<7;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryPL $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ((TreatmentInfo.P1 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and ((TreatmentInfo.P2 LIKE '0'))) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ((TreatmentInfo.P3 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ((TreatmentInfo.P4 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ((TreatmentInfo.P5 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ((TreatmentInfo.P6 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and ( (TreatmentInfo.P7 LIKE '0')))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


	if ((strlen($row_Recordset1[$CT_sim_curr]) <=5) and ($pid[$tCount]!=1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}


	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>"; 
      echo "<input name=username type=hidden id=username  value=$uid/>";      
               
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "   <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}


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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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


	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Waiting for approve (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>
	        <font style="font-size:12px"><font color='#3c6df0' style="font-size:12px">-1 영업일</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">오늘</span>  <font style="font-size:12px"> </font>
	        <font style="font-size:12px"><font color='#000000' style="font-size:12px">/</span>  <font style="font-size:12px"> </font>	        
	        <font style="font-size:12px"><font color='#00884b' style="font-size:12px">+1 영업일</span>  <font style="font-size:12px"> </font>	        	        	        

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<15;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryPL $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1' and (TreatmentInfo.P1 LIKE '1' and TreatmentInfo.A1 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '1' and (TreatmentInfo.P2 LIKE '1' and TreatmentInfo.A2 LIKE '0'))) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '1' and (TreatmentInfo.P3 LIKE '1' and TreatmentInfo.A3 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '1' and (TreatmentInfo.P4 LIKE '1' and TreatmentInfo.A4 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '1' and (TreatmentInfo.P5 LIKE '1' and TreatmentInfo.A5 LIKE '0'))) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '1' and (TreatmentInfo.P6 LIKE '1' and TreatmentInfo.A6 LIKE '0'))) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '1' and (TreatmentInfo.P7 LIKE '1' and TreatmentInfo.A7 LIKE '0')))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


	if (1==1){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
// 		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
// 		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = $bgcolorF; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
		if (strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)) {
		$bgcolorH = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
		$fontColorF = "#535a5a"; /* cool-gray 60 (ibm design colors) */
	}


	
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}


	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "     <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	
//     echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}

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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

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







	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Waiting for start (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 1;$idDays<15;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';



// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1' and TreatmentInfo.P1 LIKE '1' and TreatmentInfo.A1 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '1' and TreatmentInfo.P2 LIKE '1' and TreatmentInfo.A2 LIKE '1')) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '1' and TreatmentInfo.P3 LIKE '1' and TreatmentInfo.A3 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '1' and TreatmentInfo.P4 LIKE '1' and TreatmentInfo.A4 LIKE '1')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '1' and TreatmentInfo.P5 LIKE '1' and TreatmentInfo.A5 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '1' and TreatmentInfo.P6 LIKE '1' and TreatmentInfo.A6 LIKE '1')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '1' and TreatmentInfo.P7 LIKE '1' and TreatmentInfo.A7 LIKE '1'))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
    
    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


// 	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
// 		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
// 		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = $bgcolorF; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}

	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValT = $statVal. "T";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "T". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";        
      echo "<input name=username type=hidden id=username  value=$uid/>";      
        
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "    <font color=$fontColorF>$cropTnm</font></td> ";
     

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>Ha</td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>Ho</td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}

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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

?>


</td>
</tr>


<?php

}
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>










	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Breast EB (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
						<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>

			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>
			<td bgcolor="#777777"><font color="white">B</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<?php
			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
		</tr>

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 1;$idDays<2;$idDays++){ 	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
// echo($a_week_ago_todo);
$weekDays= strftime("%w", strtotime($a_week_ago_todo));
if($weekDays!=6 and $weekDays!=0){
	$workDay = $workDay+1;
	
}

$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';


    
$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
    ((STR_TO_DATE(TreatmentInfo. $sortCat2, '%m/%d/%Y') >= '$a_week_after') or (STR_TO_DATE(TreatmentInfo. $sortCat3, '%m/%d/%Y') >= '$a_week_after') or (STR_TO_DATE(TreatmentInfo. $sortCat7, '%m/%d/%Y') >= '$a_week_after') or (STR_TO_DATE(TreatmentInfo. $sortCat4, '%m/%d/%Y') >= '$a_week_after') or (STR_TO_DATE(TreatmentInfo. $sortCat5, '%m/%d/%Y') >= '$a_week_after') or (STR_TO_DATE(TreatmentInfo. $sortCat6, '%m/%d/%Y') >= '$a_week_after') )AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite like 'BRST'";

    if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
        $order = 'DESC';
    }
//     echo($query_Recordset1);
    $query_Recordset1 .= " ORDER BY STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%Y') " . $order;
    $Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
    $row_Recordset1       = mysql_fetch_assoc($Recordset1);
    $totalRows_Recordset1 = mysql_num_rows($Recordset1);



$rsetTemp = mysql_query($query_Recordset1, $test) or die(mysql_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysql_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    if ($s1 >= $ss && $s1 <= $se) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    if ($s2 >= $ss && $s2 <= $se) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    if ($s3 >= $ss && $s3 <= $se) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    if ($s4 >= $ss && $s4 <= $se) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    if ($s5 >= $ss && $s5 <= $se) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    if ($s6 >= $ss && $s6 <= $se) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    if ($s7 >= $ss && $s7 <= $se) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
            $pid[$iddd]        = "2";

    $RT_start_curr = "RT_start" . "$pid[$iddd]";
    $CT_sim_curr = "CT_Sim" . "$pid[$iddd]";
    $RT_fin_curr   = "RT_fin" . "$pid[$iddd]";
    $dose_curr     = "dose" . "$pid[$iddd]";
    $fx_curr       = "Fx" . "$pid[$iddd]";
    $nextInd 	 = $pid[$iddd]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";

    if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$iddd]==1)){
	    $resimInd[$tCount] = 1;
    }
    else{
	    	    $resimInd[$tCount] = 0;

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
if ($totalRows_Recordset1!=0){
do {	
	$fontColorF = "#000000";

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
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;


// 	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
// 		$bgcolorF = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
// 		$bgcolorF = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorH = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorH = $bgcolorF; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
// 		$bgcolorH = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	
	
	

	$thisFriday =  (date("Y-m-d", strtotime("next Friday"))); 	
	$nextFriday = date("Y-m-d",strtotime("+7 days", strtotime($thisFriday)));
	$nextNextFriday = date("Y-m-d",strtotime("+7 days", strtotime($nextFriday)));	
	$nextNextNextFriday = date("Y-m-d",strtotime("+7 days", strtotime($nextNextFriday)));	
	
/*
 	echo $nextFriday." 다음주 금요일<br>"; 
 	echo $nextNextFriday." 다음주 금요일<br>"; 
 	echo $nextNextNextFriday." 다음주 금요일<br>"; 
// 	echo($thisFriday);
*/
//     $cropDateSt = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);
	
	if(strtotime($row_Recordset1[$RT_start_curr])<=strtotime($nextNextNextFriday)){
		$bgcolorH = "#e2d2f4";  /* violet 10 (ibm design colors) */
// 		$stInd = "C";			
	}
	if(strtotime($row_Recordset1[$RT_start_curr])<=strtotime($nextNextFriday)){
		$bgcolorH = "#d2b5f0";  /* violet 20 (ibm design colors) */
// 		$stInd = "C";			
	}
	if(strtotime($row_Recordset1[$RT_start_curr])<=strtotime($nextFriday)){
		$bgcolorH = "#bf93eb";  /* violet 30 (ibm design colors) */
// 		$stInd = "C";			
	}
	if(strtotime($row_Recordset1[$RT_start_curr])<=strtotime($thisFriday)){
		$bgcolorH = "#ffffff";  /* violet 30 (ibm design colors) */
// 		$stInd = "C";			
	}
	if(strcmp(substr(trim($row_Recordset1["RT_method2"]),0,1),"E")!=0){
		$bgcolorH = $bgcolorF;  /* violet 30 (ibm design colors) */
// 		$stInd = "C";			
	}
	if(strcmp($row_Recordset1["A2"],"1")==0){
		$bgcolorH = $bgcolorF;  /* violet 30 (ibm design colors) */
// 		$stInd = "C";			
	}

	
	
	
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        

	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
	}
	
	
/*
	echo(strtotime($workingyest));
	echo("<br>");
	echo(strtotime($row_Recordset1[$RT_start_curr]));
	echo("<br><br>");
*/

	
	
    $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $simVal = "";
    $simValR = "";	        	        

	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingyest)) {
		$simColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($workingtom)) {
		$simColor = "#00884b"; /* green 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
		$simColor = "#e62325"; /* red 50 (ibm design colors) */
		$simVal = "<strong>";
		$simValR = "</strong>";	        
	}

	
	if(file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")==1){
		$photoPath = "PatientPhoto/". $row_Recordset1['RO_ID'].".jpg";
	}
	elseif(strcmp($row_Recordset1['Sex'],"M")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/m.jpg";

	}
	elseif(strcmp($row_Recordset1['Sex'],"F")==0 and file_exists("PatientPhoto/". $row_Recordset1['RO_ID'].".jpg")!=1){
						$photoPath = "/PatientPhoto/f.jpg";

	}
	else{
		$photoPath = "/PatientPhoto/icon.png";

	}
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];

	$statValB = $statVal. "B";
	$statValB = $statValB. $pid[$tCount];
	$bChecked = "B". $pid[$tCount];

	$statValP = $statVal. "P";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "P". $pid[$tCount];

	$statValA = $statVal. "A";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "A". $pid[$tCount];
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $bChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$bChecked]==1){ $chkCurB = "	checked='checked'";}
	else{ $chkCurB = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValP);  echo($chkCurP);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA);   echo($chkCurA);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValB); echo($chkCurB);?> >
	
	</td>



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";        
    echo "<input name=username type=hidden id=username  value=$uid/>";      
        
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo "     <font color=$fontColorF>$cropTnm</font></td> ";
     

	
// 	60 Gy (2.00 Gy X 30 fx.) 
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='200' align='left'><div class='memo'><font color=$fontColorF>"; 
		
	$fxDose = (float)$row_Recordset1['dose_sum']/(float)$row_Recordset1['Fx_sum'];
	$fxDoseStr = sprintf("%.2f", $fxDose);		  			
	echo "<font  face=arial></font><font color=blue face=arial><strong>$row_Recordset1[dose_sum] Gy ($fxDoseStr Gy X $row_Recordset1[Fx_sum] fx.)</strong><br></font>";
	
    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;</font><font color=red face=arial>$row_Recordset1[$doseX](&nbsp($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:&nbsp;$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
 
    }
    echo "</font></div></td>";

    

// Prescription ends


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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

    $cropDateSt = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDateSt<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>EB </td>";}
	else{echo "<td bgcolor=$bgcolorF align='center'>$row_Recordset1[$Method_f]</td>";}

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}

	if (strcasecmp(trim($row_Recordset1[planner]),"HY")==0){echo "<td bgcolor=#b0bef3 width = '15' align='center'>   HY </td>";} 	 /* ultramarine 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"TJ")==0){echo "<td bgcolor=#71cddd width = '15' align='center'>   TJ </td>";} /* aqua 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HaJ")==0){echo "<td bgcolor=#fed500 width = '15' align='center'>   Ha </td>";} /* yellow 10 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"DK")==0){echo "<td bgcolor=#d2b5f0 width = '15' align='center'>   DK </td>";} /* violet 20 (ibm design colors) */
	elseif (strcasecmp(trim($row_Recordset1[planner]),"HoJ")==0){echo "<td bgcolor=#f7aac3 width = '15' align='center'>   Ho </td>";} /* magenta 20 (ibm design colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";}

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
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

?>


</td>
</tr>


<?php

}
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>









<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->

		

<!-- Submit button for status  -->
		
		
<!-- Submit button for status  -->

  


















</table>












<!-- Apply status changes -->






<?php
	
?>


</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);

?>



</html>

