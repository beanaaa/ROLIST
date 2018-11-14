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




<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>

<script>
    $(function() {
        $("#datepickerfrom, #datepickerto").datepicker({
            dateFormat: 'm/d/y'
        });
    });

</script>



<link rel="stylesheet" href="normalize.css">
<?php 	
if (!isset($_SESSION)) {
session_cache_expire(10000000);  
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
include("configuration.php");

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


mysqli_select_db("test", $conn);
// mysqli_select_db($database_test );
mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");
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
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, $daySql));	
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
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, $daySql));	
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

if(strcmp($siteInput,"CNS")==0 or strcmp($siteInput,"HN")==0 or strcmp($siteInput,"BRST")==0 or strcmp($siteInput,"THX")==0 or strcmp($siteInput,"GI")==0 or strcmp($siteInput,"GU")==0 or strcmp($siteInput,"GY")==0){
	$querySite = "(TreatmentInfo.primarysite LIKE '$siteInput') AND ";
} 
else{
	$querySite = "";
} 

// Patinet counting
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%3D Conformal%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$live3D = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%vmat%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveVmat = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%Versa%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveIx = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%IX%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveVersa = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Modality_var1 is not NULL" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$numCCRT = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$numTotal = mysqli_num_rows($Recordset1);

// 	Per site
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CNS%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveCNS = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HN%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveHN = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%THX%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveTHX = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BRST%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveBRST = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GI%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveGI = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GU%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveGU = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GY%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveGY = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%MS%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveMS = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%SKIN%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveSKIN = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HMT%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveHMT = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%PD%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$livePD = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BENIGN%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveBENIGN = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CUPS%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveCUPS = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%OTHER%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveOTHER = mysqli_num_rows($Recordset1);


?>

<?php
	include("mainmenu.php");
?>







</td>
</tr>
</table>


































































<?php
$sex = $_POST['txt_sex'];
$ageO = $_POST['txt_ageO'];
$ageY = $_POST['txt_ageY'];
$category = $_POST['txt_category'];
$site = $_POST['txt_site'];
$pathology = $_POST['txt_pathology'];
$stage = $_POST['txt_stage'];
$aim = $_POST['txt_aim'];
$physician = $_POST['txt_physician'];
$from = $_POST['datepickerfrom'];
$to = $_POST['datepickerto'];


if(strlen($sex)==0 and strlen($ageO)==0 and strlen($ageY)==0 and strlen($category)==0 and strlen($site)==0 and strlen($pathology)==0 and strlen($stage)==0 and strlen($aim)==0 and strlen($physician)==0 and strlen($from)==0 and strlen($to)==0){
	$querySex = "PatientInfo.Sex like 'XXXX' AND ";
}

if(strlen($sex)>0){
	$querySex = "PatientInfo.Sex like '$sex' AND ";
}
if(strlen($ageO)>0){
	$queryAgeO = "PatientInfo.Age > $ageO AND ";
	
}
if(strlen($ageY)>0){
	$queryAgeY = "PatientInfo.Age < $ageY AND ";
	
}
if(strlen($category)>0){
	$queryCat = "TreatmentInfo.primarysite like '%$category%' AND ";
	
}
else{
	$queryCat = "";
}
if(strlen($site)>0){
	$querysubsite = "TreatmentInfo.subsite like '%$site%' AND ";
}
else{
	$querysubsite = "";
}

if(strlen($pathology)>0){
	$queryPathol = "TreatmentInfo.pathol like '%$pathology%' AND ";
}
else{
	$queryPathol = "";
}

if(strlen($stage)>0){
	$queryStage = "TreatmentInfo.tnm like '%$stage%' AND ";
}
else{
	$queryStage = "";
}

if(strlen($aim)>0){
	$queryAim = "TreatmentInfo.purpose like '%$aim%' AND ";
}
else{
	$queryAim = "";
}

if(strlen($physician)>0){
	$queryPhysician = "TreatmentInfo.physician like '%$physician%' AND ";
}
else{
	$queryPhysician = "";
}

if(strlen($from)>0){
	$queryFrom = "STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') > STR_TO_DATE('$from', '%m/%d/%Y') AND ";
}
else{
	$queryFrom = "";
}

if(strlen($to)>0){
	$queryTo = "STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') < STR_TO_DATE('$to', '%m/%d/%Y') AND ";
}
else{
	$queryTo = "";
}





/*
if(strlen($from)>0){
	$queryPhysician = "TreatmentInfo.RT_start1 like $from AND ";
	echo($$queryPhysician);
}

echo($pathology);

echo($aim);
echo($physician);
echo($from);
echo($to);
*/
?>





<?php
	$mdChart = 0;	

	if(strlen($queryMD)>1){
		$mdChart = 1;	
	}
?>
<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="960px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	

	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
(2018-10-11) 검색이 완료되면 CSV 파일 다운로드 링크가 리스트 상단에 나타납니다.<br>
(2018-10-11) Advanced Search에서 검색된 환자 리스트를 담은 CSV 파일을 이용해 MIM Patient List로 변환하는 코드가 준비되어 있습니다. 연구에 활용하실 분들은 말씀해 주세요.
</font>


		 

		 
		 
</th>
<!--
<th valign="top" align="right">
	<font color=gray>Logged by <?php echo $uid;?></font>
</th>
-->


</tr>

</table>



		
		
		
		
<br>
<form action="advancedsearch.php" method=post>
<table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
        <tr class="border_bottom">
			
		<td bgcolor="#1f57a4" ><font color="white">Sex</font></td>				
		<td bgcolor="#1f57a4" ><font color="white">Age <br>(Older) </font></td>						
		<td bgcolor="#1f57a4" ><font color="white">Age <br>(Younger) </font></td>								
		<td bgcolor="#1f57a4" ><font color="white">Category</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">Site</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">Pathology</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">Stage</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">Aim</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">Physician</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">From</font></td>		
		<td bgcolor="#1f57a4" ><font color="white">To</font></td>				
		<td bgcolor="#1f57a4" ><font color="white">Action</font></td>				
	</tr>	
		

    <tr class="border_bottom">
	<td   valign="middle" align="left">
		<select name="txt_sex">
				<option name="txt_sex" value="" ></option>
				<option name="txt_sex" value="M" >M</option>
				<option name="txt_sex" value="F" >F</option>
		</select>		    
		
	</td>
	
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_ageO" type="text" id="txt_ageO" style="width:60px;"  value="" />        
		
	</td>
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_ageY" type="text" id="txt_ageY" style="width:60px;"  value="" />        
		
	</td>

	<td   valign="middle" align="left">
		<select name="txt_category">

				<option name="txt_category" value="" ></option>
<?php
				for($idphys=0;$idphys<$numcatg;$idphys++){
					echo("<option name='txt_category' value='$catgInt[$idphys]' >$catgInt[$idphys]</option>");
				}
?>
		</select>		    
		
	</td>
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_site" type="text" id="txt_site" style="width:60px;"  value="" />        
		
	</td>
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_pathology" type="text" id="txt_pathology" style="width:60px;"  value="" />        
		
	</td>
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_stage" type="text" id="txt_stage" style="width:60px;"  value="" />        
		
	</td>
	<td   valign="middle" align="left">
		<input class="form-control"  name="txt_aim" type="text" id="txt_aim" style="width:60px;"  value="" />        
		
	</td>

	<td   valign="middle" align="left">
		<select name="txt_physician">
		<option name="txt_physician" value="" ></option>
<?php
				for($idphys=0;$idphys<$numphyss;$idphys++){
					echo("<option name='txt_physician' value='$phyIdd[$idphys]' >$phyInt[$idphys]</option>");
				}
?>
				
		</select>		    
		
	</td>
	
	
	
	<td   valign="middle" align="left">
    <input class="form-control"  type="text" id="datepickerfrom" name="datepickerfrom" value=""> 
		
	</td>
	<td   valign="middle" align="left">
    <input class="form-control"  type="text" id="datepickerto" name="datepickerto" value="">		
		
	</td>
	<td   valign="middle" align="left">
		<input type="submit" value="검색">
		<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />	
	    <input type=hidden name="permit" id = "permit" value="<?php echo $permitUser?>" />
						
		
	</td>




	</tr>		
		
		
</table>		
</form>
		
<?php
// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySex $queryAgeO $querysubsite $queryStage $queryAgeY $queryAim $queryCat $queryPhysician $queryFrom $queryTo (PatientInfo.CurrentStatus !=  3  or PatientInfo.CurrentStatus is null)";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);	
?>		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    


	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Result:  <?php echo($totalRows_Recordset1);?> Entries</font> 
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
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Site</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>	
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
					
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<?php if($mdChart==0){ ?>					
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<?php } ?>			
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

// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySex $queryAgeO $querysubsite $queryStage $queryAgeY $queryAim $queryCat $queryPhysician $queryFrom $queryTo (PatientInfo.CurrentStatus !=  3  or PatientInfo.CurrentStatus is null)";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    $pid[$iddd]        = "1";    
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

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
// echo $query_Recordset1;

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = $hId"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
		if(strcmp($sqlQueryPhys[physician],'myki')==0){$curlPhy ="KI"; $chatId = "@rodbki";}
		if(strcmp($sqlQueryPhys[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhro";}
		if(strcmp($sqlQueryPhys[physician],'mjlee')==0){$curlPhy ="JaL";$chatId = "@rodbjal";}
		if(strcmp($sqlQueryPhys[physician],'mhlee')==0){$curlPhy ="JuL";$chatId = "@pnuyhrojul";}
		if(strcmp($sqlQueryPhys[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhrojul";}
// 		print_r($sqlQueryPhys);
		// 보낼 텍스트를 구성. 줄바꿈은 "\n"으로.
		// http_build_query()를 이용하면 url 인코딩을 알아서 처리해 줌.
		$telegram_text = "※ $hId / $sqlQueryName[Firstname] $sqlQueryName[Secondname] \n{$post_title}\n{$post_url}";
		$query_array = array(
		    'chat_id' => $chatId,
		    'text' => $telegram_text,
		);
		$request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?" . http_build_query($query_array);
		
		// curl로 접속
		$curl_opt = array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $request_url,
		);
		$curl = curl_init($request_url);
		echo("<font color=#FFFFFF size='1px'> ");

		$resCurl = curl_exec($curl);
		echo("</font>");				
	}
	echo("");
 	$sqlQuery = mysqli_query($test, "update TreatmentInfo set $sId = 1 where Hospital_ID = $hId");		
}
?>



<?php
		
$today = date("n/j/y", time(0));
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;

$csv_dump .= "ID,Name,Sex,Age,Site,Pathology,Stage,Aim,Technique,Dose,Fx.,Start,"; 
$csv_dump .= "\r\n"; 


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
    $Method_f   = "RT_method" . "$pid[$tCount]";
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
	$TargetCheck = "T".$pid[$tCount];
	
	

	
    $E_curr = "E" . "$pid[$tCount]";
    $N_curr = "N" . "$pid[$tCount]";    

	if (strcmp($row_Recordset1[$E_curr],"1")!=0) {
// 		$bgcolorF = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
		$fontColorF = "#000000"; /* cool-gray 50 (ibm design colors) */
	}
/*
	if (strcmp($row_Recordset1[$N_curr],"1")!=0) {
		$fontColorF = "#8c9696"; /* cool-gray 40 (ibm design colors) 
	}
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


	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

	$csv_dump.=$row_Recordset1[Hospital_ID].",";
    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td align='center' bgcolor=$bgcolorF width = '60px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]<br></font>"; 


	$dump_temp = iconv("utf8", "euckr", $row_Recordset1[KorName]);

   	$dump_temp = str_replace(",", "_", $dump_temp);
   	$csv_dump.=$dump_temp.",";
//     echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";    
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>"; 
    
    
   	$csv_dump.=$row_Recordset1[Sex].",";
   	$csv_dump.=$row_Recordset1[Age].",";
    
    
    
    
    
    
      
    echo " <td bgcolor=$bgcolorF  width = '60px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  
   	
   	$dump_temp = $row_Recordset1[subsite];
   	$dump_temp = str_replace(",", "_", $dump_temp);
   	$csv_dump.=$dump_temp.",";


    $patholcrop = substr($row_Recordset1[pathol],0,20); 
    
   	$dump_temp = trim($row_Recordset1[pathol]);
   	$dump_temp = str_replace(",", "_", $dump_temp);
   	$csv_dump.=$dump_temp.",";

         
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
   	
   	   	$dump_temp = $row_Recordset1[tnm];
   	$dump_temp = str_replace(",", "_", $dump_temp);
   	$csv_dump.=$dump_temp.",";
   	
   	
    
    echo " <td bgcolor=$bgcolorF width = '70px'>    <font color=$fontColorF>$cropTnm</font></td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";
   	$csv_dump.=trim($row_Recordset1[purpose]).",";

//     Technique
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>E </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>E </td>";}
	else{$tcn = substr($row_Recordset1[$Method_f],0,2); echo "<td bgcolor=$bgcolorF align='center'>$tcn</td>";}
   	$csv_dump.=trim($row_Recordset1[$Method_f]).",";

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='140' align='left'><div class='memo'><font color=$fontColorF>"; 
	echo "<font  face=arial></font><font color=red face=arial><strong>$row_Recordset1[dose_sum]($row_Recordset1[Fx_sum])</strong>&nbsp;</font>";

    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:</font><font color=blue face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
		if($planIdx%2==0){
			echo("<br>");
		}

    }
    echo "</font></div></td>";
    
    $csv_dump.=$row_Recordset1[dose_sum].",";
    $csv_dump.=$row_Recordset1[Fx_sum].",";


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
    $dateStart = date("Y-m-d", strtotime( $row_Recordset1[$RT_start_curr] ) );

    $csv_dump.=$dateStart.",";



    $csv_dump .= "\r\n"; 

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    

    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";

	if($mdChart==0){					

		$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
		for($idphyss=0;$idphyss<$numphyss;$idphyss++){
	
			if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
				$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
			} 	 /* #33FF00 (web safe colors) */
	
		}
		echo($phyMark) ;
		}


		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>


</tr>


<?php
}
}
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
if($totalRows_Recordset1>0){ 


$sex = $_POST['txt_sex'];
$ageO = $_POST['txt_ageO'];
$ageY = $_POST['txt_ageY'];
$category = $_POST['txt_category'];
$site = $_POST['txt_site'];
$pathology = $_POST['txt_pathology'];
$stage = $_POST['txt_stage'];
$aim = $_POST['txt_aim'];
$physician = $_POST['txt_physician'];
$from = $_POST['datepickerfrom'];
$to = $_POST['datepickerto'];
$filename = '';

$fileNametemp = ($sex);
if(strlen($fileNametemp)>0){
	$filename.="Sex_".$fileNametemp."-";
}
$fileNametemp = ($ageO);
if(strlen($fileNametemp)>0){
	$filename.="AgeO_".$fileNametemp."-";
}
$fileNametemp = ($ageY);
if(strlen($fileNametemp)>0){
	$filename.="AgeY_".$fileNametemp."-";
}
$fileNametemp = ($category);
if(strlen($fileNametemp)>0){
	$filename.="Cat_".$fileNametemp."-";
}
$fileNametemp = ($pathology);
if(strlen($fileNametemp)>0){
	$filename.="Pathol_".$fileNametemp."-";
}
$fileNametemp = ($stage);
if(strlen($fileNametemp)>0){
	$filename.="Stage_".$fileNametemp."-";
}
$fileNametemp = ($aim);
if(strlen($fileNametemp)>0){
	$filename.="Aim_".$fileNametemp."-";
}

$fileNametemp = ($physician);
if(strcmp($physician,'myki')==0){
	$fileNametemp = 'KI';
}
if(strlen($fileNametemp)>0){
	$filename.="Phys_".$fileNametemp."-";
}
$fileNametemp = str_replace($from,'/','-');
if(strlen($fileNametemp)>0){
	$filename.="DateFr_".$fileNametemp."-";
}
$fileNametemp = str_replace($to,'/','-');
if(strlen($fileNametemp)>0){
	$filename.="DateTo_".$fileNametemp."-";
}




$date = date("YmdHi"); 
$filename = $filename."csvoutput_".$date.".csv"; 

$myfile = fopen($filename,"w") or die("Unagble to open file!");
fwrite($myfile,$csv_dump);
fclose($myfile);

echo "<p align=center><a href='http://rolist.myds.me/".$filename."'>Download result as CSV</a></p>" ; 
}








?>
<?php
$sex = $_POST['txt_sex'];
$ageO = $_POST['txt_ageO'];
$ageY = $_POST['txt_ageY'];
$category = $_POST['txt_category'];
$site = $_POST['txt_site'];
$pathology = $_POST['txt_pathology'];
$stage = $_POST['txt_stage'];
$aim = $_POST['txt_aim'];
$physician = $_POST['txt_physician'];
$from = $_POST['datepickerfrom'];
$to = $_POST['datepickerto'];


if(strlen($sex)==0 and strlen($ageO)==0 and strlen($ageY)==0 and strlen($category)==0 and strlen($site)==0 and strlen($pathology)==0 and strlen($stage)==0 and strlen($aim)==0 and strlen($physician)==0 and strlen($from)==0 and strlen($to)==0){
	$querySex = "PatientInfo.Sex like 'XXXX' AND ";
}

if(strlen($sex)>0){
	$querySex = "PatientInfo.Sex like '$sex' AND ";
}
if(strlen($ageO)>0){
	$queryAgeO = "PatientInfo.Age > $ageO AND ";
	
}
if(strlen($ageY)>0){
	$queryAgeY = "PatientInfo.Age < $ageY AND ";
	
}
if(strlen($category)>0){
	$queryCat = "TreatmentInfoHistory.primarysite like '%$category%' AND ";
	
}
else{
	$queryCat = "";
}
if(strlen($site)>0){
	$querysubsite = "TreatmentInfoHistory.subsite like '%$site%' AND ";
}
else{
	$querysubsite = "";
}

if(strlen($pathology)>0){
	$queryPathol = "TreatmentInfoHistory.pathol like '%$pathology%' AND ";
}
else{
	$queryPathol = "";
}

if(strlen($stage)>0){
	$queryStage = "TreatmentInfoHistory.tnm like '%$stage%' AND ";
}
else{
	$queryStage = "";
}

if(strlen($aim)>0){
	$queryAim = "TreatmentInfoHistory.purpose like '%$aim%' AND ";
}
else{
	$queryAim = "";
}

if(strlen($physician)>0){
	$queryPhysician = "TreatmentInfoHistory.physician like '%$physician%' AND ";
}
else{
	$queryPhysician = "";
}

if(strlen($from)>0){
	$queryFrom = "STR_TO_DATE(TreatmentInfoHistory.RT_start1, '%m/%d/%Y') > STR_TO_DATE('$from', '%m/%d/%Y') AND ";
}
else{
	$queryFrom = "";
}

if(strlen($to)>0){
	$queryTo = "STR_TO_DATE(TreatmentInfoHistory.RT_start1, '%m/%d/%Y') < STR_TO_DATE('$to', '%m/%d/%Y') AND ";
}
else{
	$queryTo = "";
}


	
	
	
	?>




	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Result:  <?php echo($totalRows_Recordset1);?> Entries</font> 
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
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Site</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>	
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
					
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<?php if($mdChart==0){ ?>					
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<?php } ?>			
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

// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfoHistory on PatientInfo.Hospital_ID = TreatmentInfoHistory.Hospital_ID where $querySex $queryAgeO $querysubsite $queryStage $queryAgeY $queryAim $queryCat $queryPhysician $queryFrom $queryTo (PatientInfo.CurrentStatus !=  3  or PatientInfo.CurrentStatus is null)";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfoHistory.RT_start1 " . $order;
$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago_todo . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after_todo . '+' . '0' . ' days'));
    
    $pid[$iddd]        = "1";    
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

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
// echo $query_Recordset1;

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfoHistory where Hospital_ID = $hId"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfoHistory where Hospital_ID = $hId"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = $hId"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
		if(strcmp($sqlQueryPhys[physician],'myki')==0){$curlPhy ="KI"; $chatId = "@rodbki";}
		if(strcmp($sqlQueryPhys[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhro";}
		if(strcmp($sqlQueryPhys[physician],'mjlee')==0){$curlPhy ="JaL";$chatId = "@rodbjal";}
		if(strcmp($sqlQueryPhys[physician],'mhlee')==0){$curlPhy ="JuL";$chatId = "@pnuyhrojul";}
		if(strcmp($sqlQueryPhys[physician],'mjnam')==0){$curlPhy ="JN";$chatId = "@pnuyhrojul";}
// 		print_r($sqlQueryPhys);
		// 보낼 텍스트를 구성. 줄바꿈은 "\n"으로.
		// http_build_query()를 이용하면 url 인코딩을 알아서 처리해 줌.
		$telegram_text = "※ $hId / $sqlQueryName[Firstname] $sqlQueryName[Secondname] \n{$post_title}\n{$post_url}";
		$query_array = array(
		    'chat_id' => $chatId,
		    'text' => $telegram_text,
		);
		$request_url = "https://api.telegram.org/bot{$api_code}/sendMessage?" . http_build_query($query_array);
		
		// curl로 접속
		$curl_opt = array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $request_url,
		);
		$curl = curl_init($request_url);
		echo("<font color=#FFFFFF size='1px'> ");

		$resCurl = curl_exec($curl);
		echo("</font>");				
	}
	echo("");
 	$sqlQuery = mysqli_query($test, "update TreatmentInfoHistory set $sId = 1 where Hospital_ID = $hId");		
}
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
    $Method_f   = "RT_method" . "$pid[$tCount]";
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
	$TargetCheck = "T".$pid[$tCount];
	
	

	
    $E_curr = "E" . "$pid[$tCount]";
    $N_curr = "N" . "$pid[$tCount]";    

	if (strcmp($row_Recordset1[$E_curr],"1")!=0) {
// 		$bgcolorF = "#e3ecec"; /* cool-gray 1 (ibm design colors) */
		$fontColorF = "#000000"; /* cool-gray 50 (ibm design colors) */
	}
/*
	if (strcmp($row_Recordset1[$N_curr],"1")!=0) {
		$fontColorF = "#8c9696"; /* cool-gray 40 (ibm design colors) 
	}
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


	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfoHistory where Hospital_ID = $statVal"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfoHistory where Hospital_ID = $statVal"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfoHistory where Hospital_ID = $statVal"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td align='center' bgcolor=$bgcolorF width = '60px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font>"; 
   
//     echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";    
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>"; 
    
    
    
    
    
    
    
      
    echo " <td bgcolor=$bgcolorF  width = '60px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,20);      
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    <font color=$fontColorF>$cropTnm</font></td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";
//     Technique
	if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF width = '15' align='center'>3D </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '15' align='center'>VM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=$bgcolorF width = '15' align='center'>IM </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
		$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=$bgcolorF align='center'>2D</td>";
		}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"EB")==0){echo "<td bgcolor=#469BBB>E </td>";}
	elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"electron")==0){echo "<td bgcolor=#469BBB>E </td>";}
	else{$tcn = substr($row_Recordset1[$Method_f],0,2); echo "<td bgcolor=$bgcolorF align='center'>$tcn</td>";}

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='140' align='left'><div class='memo'><font color=$fontColorF>"; 
	echo "<font  face=arial></font><font color=red face=arial><strong>$row_Recordset1[dose_sum]($row_Recordset1[Fx_sum])</strong>&nbsp;</font>";

    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:</font><font color=blue face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])&nbsp;</font>";
		}
		else{
			echo "<font  face=arial>$planIdx.$SiteX:$row_Recordset1[$doseX]($row_Recordset1[$fxX]) &nbsp;</font>";
			
		}
		if($planIdx%2==0){
			echo("<br>");
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
    

	if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B align=center width = '15'>   1 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 align=center width = '15'>   2 </td>";}
	elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 align=center width = '15'>   3 </td>";}
	else{echo "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";}

	if($mdChart==0){					

	if (strcasecmp(trim($row_Recordset1[physician]),"myki")==0){echo "<td bgcolor=#33FF00 width = '15' align='center'>   KI </td>";} 	 /* #33FF00 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjlee")==0){echo "<td bgcolor=#CC6699 width = '15' align='center'>   Ja </td>";} /* #CC6699 (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mhlee")==0){echo "<td bgcolor=#00CCFF width = '15' align='center'>   Ju </td>";} /* #00CCFF (web safe colors) */
	elseif (strcasecmp(trim($row_Recordset1[physician]),"mjnam")==0){echo "<td bgcolor=#CCFFFF width = '15' align='center'>   JN </td>";} /* #CCFFFF (web safe colors) */
	else{echo "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";}
	}


		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>


</tr>


<?php
}
}
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>










</table>


</body>
</html>

</html>

