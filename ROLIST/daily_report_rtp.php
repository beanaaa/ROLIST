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


<meta charset="utf-8">

<script language='javascript'>
	window.setTimeout('window.location.reload()',600000);
</script>


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
	$pl2 = $_POST['plname'];



	$md = $md2;		


	for($idphyss=0;$idphyss<$numphyss;$idphyss++){
		if(strcmp($md2,$phyIdd[$idphyss])==0){
			$md = $phyIdd[$idphyss];	
		}
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
mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");

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


	
input[type=submit].tag {
	background-color: #4CAF50;	
	padding: 3px 4px;
    border: 2px solid #4CAF50; /* Green */	

	color: white;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=submit].tag:hover {
   	background-color: white;
	padding: 3px 4px;
   	
    color: black;
    border: 2px solid #4CAF50; /* Green */	
}
input[type=submit].comment {
	background-color: #047cc0;	 /* ultramarine 60 (ibm design colors) */
	padding: 3px 4px;
    border: 2px solid #047cc0; /* Green */	

	color: white;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=submit].comment:hover {
   	background-color: white;
	padding: 3px 4px;
   	
    color: black;
    border: 2px solid #047cc0; /* Green */	
}

input[type=submit].selector {
	padding: 3px 4px;
    border: none; /* Green */	

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=submit].PN {
	background-color: #dc267f;	 /* magenta 50 (ibm design colors) */
	padding: 3px 4px;
    border: 2px solid #dc267f; /* Green */	

	color: white;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=submit].PN:hover {
   	background-color: white;
	padding: 3px 4px;
   	
    color: black;
    border: 2px solid #dc267f; /* Green */	
}
input[type=button].PN2 {
	background-color: #dc267f;	 /* magenta 50 (ibm design colors) */
	padding: 3px 4px;
    border: 2px solid #dc267f; /* Green */	

	color: white;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=button].PN2:hover {
   	background-color: white;
	padding: 3px 4px;
   	
    color: black;
    border: 2px solid #dc267f; /* Green */	
}
input[type=button].PN3 {
	background-color: #6f7878;	 /* magenta 50 (ibm design colors) */
	padding: 3px 4px;
    border: 2px solid #6f7878; /* Green */	

	color: white;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	
    
input[type=button].PN3:hover {
   	background-color: white;
	padding: 3px 4px;
   	
    color: black;
    border: 2px solid #6f7878; /* Green */	
}



table.out { box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }
tr.out { box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }
	
</style>

<style>
 @media (max-width:1000px){
 /*
 화면의 크기가 20rem보다 작을 때 보여지는 CSS코드
 */
 .float-button {position: fixed;
 background-image: gray;
width: 43px;
height: 84px;
top: 84px;
right: 50%;
margin-right: -472px;}

.button-update {
    width: 40px;
    height: 40px;
	background-color:#61BB46;
	color:#FFF;
	border-radius:50px;
	border: 0;

	text-align:center;

	box-shadow: 2px 2px 3px #999;}
.button-update:hover {
    width: 40px;
    height: 40px;
	border: 0;
	background-color:#378EDA;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;}

 }
 @media (min-width:1000px){
 /*
 화면의 크기가 50rem보다 작을 때 보여지는 CSS코드
 */
 .float-button {position: fixed;
	width: 43px;
	height: 84px;
	top: 84px;
	right: 50%;
	margin-right: 495px;}

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

mysqli_select_db("test", $conn);
mysqli_select_db($database_test );

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



$queryMD = " ";
for($nums = 0; $nums<$numphyss;$nums++){ 

	if(strcmp($md, $phyInt[$nums])==0){
		$titleMd = $phyInt[$nums];
		$md = $phyIdd[$nums];
		$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";

	}
}

$queryPL = " ";
for($nums = 0; $nums<$numplnss;$nums++){ 

	if(strcmp($pl2, $plnInt[$nums])==0){
		$queryPL = "(TreatmentInfo.planner LIKE '$pl2' OR CHAR_LENGTH(TreatmentInfo.planner) < 1) AND ";

	}
}









if(strcmp($siteInput,"CNS")==0 or strcmp($siteInput,"HN")==0 or strcmp($siteInput,"BRST")==0 or strcmp($siteInput,"THX")==0 or strcmp($siteInput,"GI")==0 or strcmp($siteInput,"GU")==0 or strcmp($siteInput,"GY")==0){
	$querySite = "(TreatmentInfo.primarysite LIKE '$siteInput') AND ";
} 
else{
	$querySite = "";
} 


?>










<?php
	include("mainmenu.php");
	
	
	
$StatT = $_POST['StatT'];
$Actss = $_POST['ActReq'];

// print_r($Actss);
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
 	$sqlQuery = mysqli_query($test, "update TreatmentInfo set $sId = 1 where Hospital_ID = '$hId'");		
}	
// Status change!!!!
for($idstat = 0; $idstat<count($Actss); $idstat++){
	$hId = substr($Actss[$idstat],0,9);

	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
	echo($hId."<br>");
 	$sqlQuery = mysqli_query($test, "update TreatmentInfo set TrcNotice = 0 where Hospital_ID = '$hId'");		
 	
//  	"Update TreatmentInfo Set TrcNotice='1' where Hospital_ID like $h_id"
}	
?>




















<?php
	
// Patinet counting
$today_date      = date('Y-m-d');
//오늘의 요일 출력 ex) 수요일 = 3
$day_of_the_week = date('w');
$Today_date_nextweek     = date("Y-m-d",strtotime("+1 week")); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시

	for($idphyss=0;$idphyss<$numphyss;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.physician LIKE '%$phyIdd[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveMD[$idphyss] = mysqli_num_rows($Recordset1);
	}
	for($idphyss=0;$idphyss<$numtech;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%$techIdd[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveTech[$idphyss] = mysqli_num_rows($Recordset1);
	}
	
	for($idphyss=0;$idphyss<$numrooms;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%$rmsInt[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveRoom[$idphyss] = mysqli_num_rows($Recordset1);
	}







	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%Ver%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveVersa = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%IX%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveIx = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%In%'" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveInfinity = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND CHAR_LENGTH(TreatmentInfo.Modality_var1)>1" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$numCCRT = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$numTotal = mysqli_num_rows($Recordset1);








// 	Per site


	for($idphyss=0;$idphyss<$numcatg;$idphyss++){ 
		$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%$catgInt[$idphyss]%'" ;	
		$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
		$liveCatg[$idphyss] = mysqli_num_rows($Recordset1);
	}




	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where   STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') < '$Today_date_nextweek' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveFin = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where    STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') < '$Today_date_nextweek' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
// 	echo($query_Recordset1);
	$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
	$liveStart = mysqli_num_rows($Recordset1);
	
	
	
?>



















































<!-- Header -->
<table cellpadding = "0px" width="960px" border="0" align="center" cellspacing="0">
	<tr>
	<th height="10px" ="400px" align=left valign="top">
	</th>		
</tr>
<tr>
	<th width="400px" align=left valign="top">
		<?php 
		$dash = "";
			if((strlen($titleMd)+strlen($pl2))>0){
				$dash = " - ";
			}
		?>

<!-- 	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List for RTP<?php echo $dash; ?> <?php echo $titleMd.$pl2; ?>  </font> 	 -->
	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List for RTP  </font> 	











		 
</th>
		 
		 



<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th valign="middle" align=right>
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input class="selector" type='submit' name="mdname" value="Total"   style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />	
		<input type = hidden name = plname id = plname value = <?php echo $pl2; ?> />				
					
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report_eb.php">
	<th valign="middle" align=right>
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input class="selector" type='submit' name="mdname" value="EB"   style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>



	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){
		
		if((strlen($titleMd)!=0 and strcmp($titleMd,$phyInt[$idphys])==0) or strlen($titleMd)==0){
			$bgcols = $phyCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
	?>
	
	<form id=form11 name=form11 method=post action="daily_report_rtp.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class="selector" type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />			
			<input type = hidden name = plname id = plname value = <?php echo $pl2; ?> />								
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
			
		</th>
	</form>

	<?php }	?>






<th width="25px">
	&nbsp; || &nbsp; 
</th>
<th valign="middle" align=right>
	<form method=post target=_blank  action="planneralloc.php">
		<input  class="selector" type=submit name=btn_home id=btn_home value=Asgnr   style="width: 60px; height: 20px">
		<input  name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input  type = hidden name = username id = username value = <?php echo $uid; ?> />				
			
	</form>
</th>
<th valign="middle" align=right>
	<form method=post target=_blank  action="simschedulertp.php">
		<input  class="selector" type=submit name=btn_home id=btn_home value=Sch   style="width: 40px; height: 20px">
		<input  name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input  type = hidden name = username id = username value = <?php echo $uid; ?> />				
			
	</form>
</th>




<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th valign="middle" align=right>
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input class="selector" type='submit' name="plname" value="Total"   style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />	
			<input type = hidden name = mdname id = mdname value = <?php echo $md2; ?> />				
		
					
	</th>
</form>








	<?php for($idphys = 0; $idphys<$numplnss; $idphys++){ 	
// 		echo($pl2."<br>");
		if((strlen($pl2)!=0 and strcmp($pl2,$plnInt[$idphys])==0) or strcmp($pl2,"Total")==0   or strcmp($pl2,"/")==0  or strlen($pl2)==0){
			$bgcols = $plnCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
		
		
		
	?>

	<form id=form11 name=form11 method=post action="daily_report_rtp.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='hidden' name="mdname" value=<?php echo $md2; ?>  style="width: 50px; height: 20px"></input>
					
			
			
			
			<input class ='selector' type='submit' name="plname" value=<?php echo $plnInt[$idphys]; ?>  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		

			
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = mdname id = mdname value = <?php echo $md2; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report_rtp.php" />				
			
		</th>
	</form>

	<?php }	?>



</tr>

</table>


<br>

<table width="960px" border="0" align="center" cellspacing="0">
	<tr>
		<td colspan="200">
			<font style="font-size:12px"><strong>Stat.<?php echo ""; ?>(Total: <?php echo $numTotal;?>)	</strong></font>		
		</td>
	</tr>	
</table>
<table class = "out"  width="960px" border="0" align="center" cellspacing="0">
	
	<tr class='border_bottom'>

		<?php for($idphyss=0; $idphyss<$numphyss; $idphyss++){  ?>
		<td height="20px" bgcolor="#fbeaae" width="48px" align="center">  
			<?php echo($phyInt[$idphyss]); ?>
		</td>

		<?php } ?>

		<?php for($idphyss=0; $idphyss<$numtech; $idphyss++){  ?>
		<td height="20px" bgcolor="#c0f5e8" width="48px" align="center">  
			<?php echo($techInt[$idphyss]); ?>
		</td>

		<?php } ?>

		<?php for($idphyss=0; $idphyss<$numrooms; $idphyss++){  ?>
		<td height="20px" bgcolor="#c2dbf4" width="48px" align="center">  
			<?php echo($rmsInt[$idphyss]); ?>
		</td>

		<?php } ?>

	
<!--
		<td bgcolor="#c2dbf4" width="48px" align="center"> 
			Versa
		</td>
		<td bgcolor="#c2dbf4" width="48px" align="center"> 
			IX
		</td>
		<td bgcolor="#c2dbf4" width="48px" align="center"> 
			Infinity
		</td>
-->


		<?php for($idphyss=0; $idphyss<$numcatg; $idphyss++){  ?>
		<td height="20px" bgcolor="#efcef3" width="48px" align="center">  
			<?php echo($catgInt[$idphyss]); ?>
		</td>

		<?php } ?>

		<td bgcolor="#dcd4f7" width="48px" align="center">  
			CCRT
		</td>
		<td bgcolor="#f8d0c3" width="48px" align="center">   
			Fin/Wk
		</td>
		<td bgcolor="#f8d0c3" width="48px" align="center">   
			New/Wk
		</td>

	</tr>
	<tr class='border_bottom'>
			
		<?php for($idphyss=0; $idphyss<$numphyss; $idphyss++){  ?>
		<td align="center">
			<?php echo $liveMD[$idphyss];?>			
		</td>
		<?php } ?>

		<?php for($idphyss=0; $idphyss<$numtech; $idphyss++){  ?>
		<td align="center">
			<?php echo $liveTech[$idphyss];?>			
		</td>
		<?php } ?>
		<?php for($idphyss=0; $idphyss<$numrooms; $idphyss++){  ?>
		<td align="center">
			<?php echo $liveRoom[$idphyss];?>			
		</td>
		<?php } ?>

<!--

		<td align="center">
			<?php echo $liveVersa;?>
		</td>
		<td align="center">
			<?php echo $liveIx;?>
		</td>
-->
<!--
		<td align="center">
			<?php echo $liveInfinity;?>
		</td>
-->

		<?php for($idphyss=0; $idphyss<$numcatg; $idphyss++){  ?>
		<td align="center">
			<?php echo $liveCatg[$idphyss];?>			
		</td>
		<?php } ?>

<!--  -->
		<td align="center">
			<?php echo $numCCRT;?>
		</td>
		<td align="center">
			<?php echo $liveFin;?>
		</td>
		<td align="center">
			<?php echo $liveStart;?>
		</td>
	</tr>
</table>



<br>
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >
	<table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">  
        <th align=left >


<div class="float-button">
<!--
	<a href=#top><img src=./images/top.png></a><br>
<a href=#down><img src=./images/down.png></a>
-->
	        <input class="btn button-update" type="submit" name="statchk" id="Plans"  style="font-size: 20px; font-weight: 200" value = "✔" /></strong>
		    <input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				

</div>


	        <font style="font-size:12px">Today </font>

		   
<!-- 		<input type = "hidden" name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
        <th>
	        		
		
					

        </th>		
    </table>
       
       
	        <table class = "out" cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	        <tr class="border_bottom">
			<td bgcolor="#777777" align="center"><font color="white">Time</font></td>
			<td bgcolor="#777777" align="center"><font color="white">Chart ID</font></td>
<!-- 			<th bgcolor="#777777">Ind</th> -->
			<td bgcolor="#777777" align="center"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
<!-- 			<td bgcolor="#777777"><font color="white">Px</font></td> -->
<!-- 			<th bgcolor="#777777">Diag.</th>						 -->
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
<!-- 			<td bgcolor="#777777"><font color="white">Aim</font></td>			 -->

			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>

<!-- 			<th bgcolor="#777777">D/F</th> -->
<!-- 			<th bgcolor="#777777">F</th> -->
<!--
			<th bgcolor="#777777">D(Σ)</th>
			<th bgcolor="#777777">F(Σ)</th>
-->
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			
		
			<?php

			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777  align=center><font color=white>Note</font></td>";
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








    
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where
((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 								
(STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											
(STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											
(STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') ) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL )";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.Hospital_ID " . $order;
$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$start_time = array_sum(explode(' ', microtime()));
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
}



$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
// echo $query_Recordset1;

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];
// print_r($StatT);
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 완료.";
		$post_url = "";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
		
	}
	echo("");
 	$sqlQuery = mysqli_query($test, "update TreatmentInfo set $sId = 1 where Hospital_ID = '$hId'");		
}

?>



<?php
		
$today = date("n/j/y", time(0));

$idcolor   = 0;
$count     = 0;
$planIdInd = 0;
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
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] != NULL){
		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorF = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorF = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorF = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorF = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}

	$tc = strlen($row_Recordset1[$CT_sim_curr]);
	
	
	$querytime = "select * from Timer where Hospital_ID like '$row_Recordset1[Hospital_ID]' and date1 like '$row_Recordset1[$RT_start_curr]'";
	$time = mysqli_fetch_assoc(mysqli_query($test, $querytime)); 

	if(strtotime($time[time1])<strtotime("13:00")){
		$timeCol = "#e62325";
		$empMak = "<strong>";
		$empMakEd = "</strong>";		
	}
	else{
		$timeCol = "#473793";		 /* indigo 70 (ibm design colors) */
		$empMak = "";
		$empMakEd = "";		
		
	}
    echo "<td bgcolor=$bgcolorF width = '30px'>  $empMak<font color=$timeCol>$time[time1]</font>$empMakEd  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

    
/*
    if($pid[$tCount]==1){
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color='#CC6699'>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         
	}
	elseif($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
	    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color='#66FF66'>$row_Recordset1[Hospital_ID]</font></strong>  </td>";     
	}
	else{
	    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color='#3399FF'>$row_Recordset1[Hospital_ID]</font></strong>  </td>";     
	}
*/
	
               
//     echo "<td bgcolor=$statusColor width = '20px'>$pid[$tCount]/$idx$stInd </td>";
    
//  CCRT or not
    if ($row_Recordset1[Modality_var1] == NULL){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> C </td>";
	}
	echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>


	<?php
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> ></span>
		
	</td>			
		<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
	<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
		
		
		
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    $curI = $pid[$tCount];
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                                  
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";            
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";  
        

    $patholcrop = substr($row_Recordset1[pathol],0,100);      

    echo " <td bgcolor=$bgcolorF width = '100px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
//     echo " <td bgcolor=$bgcolorF width = '80px'>    $row_Recordset1[tnm]</td> ";
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm</td> ";
//     echo " <td bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

	
	
// 	Prescription 
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='180' align='left'><div class='memo'>";

    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:</font><font color=red face=arial>$row_Recordset1[$doseX]/$row_Recordset1[$fxX]</font>";
		}
		else{
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:$row_Recordset1[$doseX]/$row_Recordset1[$fxX]</font>";
			
		}
		if($planIdx%2==0){
			echo("<br>");
		}

    }
    echo "</div></td>";
    

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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $strVal $cropDateCT<br>$weekyoil</font>$strValR</td>";

		$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    
    
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


// Physician
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;
    
    $NoteQuery = "Select * from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo = $curI";
    $queryNote = mysqli_num_rows(mysqli_query($test, $NoteQuery));
    
    
    
    echo "<form id=form111 name=form111></form>";
    if($queryNote==1){
	    echo "<td bgcolor=#4CAF50>";
	                                     
	    echo "<form id=form3 name=form3 method=post target=_blank action=rpt.php>";  
	    echo "<input class=tag type=submit name=btn_edit id=btn_edit value=T>";
	    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
	    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
	    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";                    
	    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form>";
    }
    else{
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
	<?php	    
	    
	    
	    
    }
    
    
    echo "</td>";      

	

		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>
	
	<?php 
		if(strlen($Memo)>30){
			$Memo = iconv_substr($Memo,0,30,"utf-8")." ...";			
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=#4CAF50><form id=form3 name=form3 method=post target=_blank action=devtag.php>";                                  
     echo "<input class=tag type=submit name=btn_edit id=btn_edit value=D>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";    
                
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";
              
    if ($permitUser == 2 ) {
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=rpt.php>";                                  
    echo "<input class=tag type=submit name=btn_edit id=btn_edit value=T>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";    
                
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
        
    }

?>


</td>
</tr>


<?php
}
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
?>

<!-- </table> -->
</form>




















		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->

       
<!--     <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0"> -->
	    
<?php	
$Recordset1 = mysqli_query($test, $searchQuery ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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

			 			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
            <td bgcolor="#777777"><font color="white">Fin</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<td bgcolor="#777777"><font color="white">Pl</font></td>
			<td bgcolor="#777777"><font color="white">PN</font></td>
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
        $bgcolorF = "#FFFFFF";
    }

	if(1==1){
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    
     
//     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> <br> <font color=$fontColorF>$row_Recordset1[purpose]</font></td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=PlanNote.php>";                                 
    echo "<input type=submit name=btn_edit id=btn_edit value=PN>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    $planIDs = $pid[$tCount];
    echo "<input name=planID type=hidden id=planID value= $planIDs>";      
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      






		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}

?>



<?php

// Sort patients who have notice on certain date
$seven          = $idDays;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . "0" . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));


$hisID = $row_patientinfo['Hospital_ID'];
$queryMemo = "Select * from MemoTemp where STR_TO_DATE(Date1, '%m/%d/%y') like '$a_week_ago_todo'";
// echo($queryMemo);

$MemoInfo = mysqli_query($test, $queryMemo ) or die(mysqli_error());
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);


// <!-- NEXT WORKING DAY -->
// Sort patients who have notice on certain date

for($idHol = 1; $idHol<15; $idHol++){
	$a_week_ago_todoNxt     = date('Y-m-d', strtotime($date . "+" . $idHol . 'days'));	

	$daySqlNxt = "Select * from Holiday where solar_date like STR_TO_DATE('$a_week_ago_todoNxt','%m/%d/%Y')";
	$sqlQueryNxt = mysqli_fetch_assoc(mysqli_query($test, $daySqlNxt));	
	$yoils = date('w', strtotime($a_week_ago_todoNxt));
	
	if($yoils !=0 and $yoils !=6 and strlen($sqlQueryNxt[memo])==0){
		break;
	}
}





$hisID = $row_patientinfo['Hospital_ID'];
$queryMemoNxt = "Select * from MemoTemp where STR_TO_DATE(Date1, '%m/%d/%y') like '$a_week_ago_todoNxt'";
$MemoInfoNxt = mysqli_query($test, $queryMemoNxt ) or die(mysqli_error());
$row_MemoinfoNxt = mysqli_fetch_assoc($MemoInfoNxt);
$total_MemoinfoNxt = mysqli_num_rows($MemoInfoNxt);














				$sql_Memo = mysqli_query($test, $queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$MemoTester[$i] = mysqli_result($sql_Memo, $i,"Memo1");
					$Hids[$i] = mysqli_result($sql_Memo, $i,"Hospital_ID");
					}
	
	if($total_Memoinfo>0 or  $total_MemoinfoNxt>0){ 	
?>



	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Issued Patients</strong></font> 

<!--
	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
-->
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </td>
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
for($idIssue = 0;$idIssue<$total_Memoinfo;$idIssue++){ 
	

$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.Hospital_ID like '$Hids[$idIssue]'";
// echo($query_Recordset1);
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
        $bgcolorF = "#FFFFFF";
    }

	if(1==1){
    $idcolor++;
    $totalDays++;


	if (1==1){

	
                
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
	
	echo "<td bgcolor=#fbeaae cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    echo "<td bgcolor=#fbeaae width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* yellow 1 (ibm design colors) */

    
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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


    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    
    
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

    echo "<form id=form111 name=form111></form>";
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
		<?php


		$sql_Memo = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
?>
	<?php 
		$Memo = $MemoTester[$idIssue];
		if(strlen($Memo)>30){
// 			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
			$Memo = iconv_substr($Memo,0,30,"utf-8")." ...";
			
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>

<!--     <div class="memo"><?php echo $MemoTester[$idIssue] ?></div> -->

<?php

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}
}
?>




<!-- NEXT WORKING DAY -->
<?php
// Sort patients who have notice on certain date

for($idHol = 1; $idHol<15; $idHol++){
	$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $idHol . 'days'));	

	$daySql = "Select * from Holiday where solar_date like STR_TO_DATE('$a_week_ago_todo','%m/%d/%Y')";
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, $daySql));	
	$yoils = date('w', strtotime($a_week_ago_todo));
	
	if($yoils !=0 and $yoils !=6 and strlen($sqlQuery[memo])==0){
		break;
	}
}





$hisID = $row_patientinfo['Hospital_ID'];
$queryMemo = "Select * from MemoTemp where STR_TO_DATE(Date1, '%m/%d/%y') like '$a_week_ago_todo'";
$MemoInfo = mysqli_query($test, $queryMemo ) or die(mysqli_error());
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

				$sql_Memo = mysqli_query($test, $queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$MemoTester[$i] = mysqli_result($sql_Memo, $i,"Memo1");
					$Hids[$i] = mysqli_result($sql_Memo, $i,"Hospital_ID");
					}
	
if($total_Memoinfo>0){ 	
?>






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
for($idIssue = 0;$idIssue<$total_Memoinfo;$idIssue++){ 
	

$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.Hospital_ID like '$Hids[$idIssue]'";

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
        $bgcolorF = "#FFFFFF";
    }

	if(1==1){
    $idcolor++;
    $totalDays++;


	if (1==1){

	
                
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
	
	echo "<td bgcolor=#89eda0 cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    echo "<td bgcolor=#89eda0 width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* green 10 (ibm design colors) */

    
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

    echo "<form id=form111 name=form111></form>";
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
		<?php




		$sql_Memo = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
?>

    <div class="memo"><?php echo $MemoTester[$idIssue] ?></div>

<?php

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}
}
?>
















<?php
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.TrcNotice like 1";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
if ($totalRows_Recordset1!=0){

?>







	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Action Required</strong></font> 

<!--
	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
-->
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </td>
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
        $bgcolorF = "#FFFFFF";
    }

	if(1==1){
    $idcolor++;
    $totalDays++;


	if (1==1){

	
                
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

	$bgcolorH = "FFFFFF"; /* violet 30 (ibm design colors) */


	
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
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
	$statValT = $statVal;	
	
// 	echo($statValT);
	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td colspan=3 bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>
		<?php if($totalRows_Recordset1==1){ ?>
		<input  type="checkbox" name="ActReq" value='<?php echo($statValT); ?>' >	
		<?php }
			else{
				?>
		<input  type="checkbox" name="ActReq[]" value='<?php echo($statValT); ?>' >	
				
				<?php
			}
		?>

	</td>			
	



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
	   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

    echo "<form id=form111 name=form111></form>";
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
		<?php



		$sql_Memo = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >"; /* cerulean 50 (ibm design colors) */
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}
?>
































	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Plans</strong></font> 

<!--
	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
-->
					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </td>
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
        $bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;
	
	
    echo "<form id=form111 name=form111></form>";

    $planIDs = $pid[$tCount];
	$buttonId = $row_Recordset1[Hospital_ID].$planIDs;
	
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
	
	
	<?php
	
	
	
	
		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>

	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Waiting for Target</strong></font> 
        </td>
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
        $bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
//     $patholcrop = substr($row_Recordset1[pathol],0,100);      
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       

    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

    echo "<form id=form111 name=form111></form>";
    $planIDs = $pid[$tCount];
	$buttonId = $row_Recordset1[Hospital_ID].$planIDs;
	
	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
	
	
	<?php





		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>


	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec">  
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Plan Changes w/o Resim (within a week)</strong></font> 
        </td>
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
        $bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
	<?php

		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>


	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Waiting for Approve</strong></font> 
        </td>
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
        $bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
	   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;
	
	

	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
		<?php
	

		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>






	<tr class="border_bottom">
		<td>
		</td>
	</tr>
	<tr class="border_bottom" style="background-color: #e3ecec"> 
        <td align=left  colspan="100">
	        <font style="font-size:12px">&nbsp;<strong>Waiting for Start</strong></font> 
        </td>
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
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryPL $querySite 
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
        $bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><img class='photo3' src='$photoPath?v1605070516'</td>";

	
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#047cc0"; /* ultramarine 60 (ibm design colors) */
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
    $patholcrop = substr($row_Recordset1[subsite],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$patholcrop</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,500);   

    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
    $patholcrop = substr($row_Recordset1[tnm],0,100); 
    $idpathols = 0; 
//     echo(length($patholcrop));
    for($idph=0;$idph<strlen($patholcrop)-1;$idph++){
	    $curchar = substr($patholcrop,$idpathols,1);
	    $nstchar = substr($patholcrop,$idpathols+1,1);

	    
	    if((strcmp($curchar,',')==0 and strcmp($nstchar,'$nbsp')!=0) or (strcmp($curchar,'.')==0 and strcmp($nstchar,'$nbsp')!=0)){
		     
		  $patholcrop = substr($patholcrop,0,$idpathols+1).' '.substr($patholcrop,$idpathols+1,500);
		  $idpathols++;
	    }
		$idpathols++;

    }    
    echo "    <font color=$fontColorF>$patholcrop</font></td> ";
     
     

	
	
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
    
	   // METHOD from cfg files
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;



    // LINAC from cfg files
    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_f] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_f]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";


    // PHYSICIAN from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[physician] </td>";
	for($idphyss=0;$idphyss<$numphyss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[physician]),$phyIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$phyCol[$idphyss] width = '15' align='center'>   $phyInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	// PLANNER from cfg files
	$phyMark = "<td bgcolor=$bgcolorF  align='center'>   $row_Recordset1[planner] </td>";
	for($idphyss=0;$idphyss<$numplnss;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[planner]),trim($plnInt[$idphyss]))==0){
			$phyMark = "<td bgcolor=$plnCol[$idphyss] width = '15' align='center'>   $plnInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


	$qur = mysqli_fetch_assoc(mysqli_query($test, "select PlanID from PlannerNote where Hospital_ID like '$row_Recordset1[Hospital_ID]' and PlanNo like '$pid[$tCount]'"));
	if(strlen($qur[PlanID])>0){
		$pnClass = "PN2";
		$pnBg = "#dc267f"; 
	}
	else{
		$pnClass = "PN3";		
		$pnBg = "#6f7878"; 
	}
    echo "<td bgcolor=$pnBg>";                                
	
	?>
	
	<input class="<?php echo $pnClass?>" type="button" name="btn_edit" id="btn_edit" onclick="<?php echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>" value = "P" />
	
	<script>
	function <?php echo $buttonId?>() {
		<?php
		echo "window.open('PlanNote.php?hf_edit=$row_Recordset1[Hospital_ID]&planID=$pid[$tCount]', '_blank', 'width=650px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
</td>
	
	
	<?php 



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	if($row_Memoinfo>0){ 
?>

    	<?php 
		if(strlen($Memo)>30){
			$Memo = mb_substr($Memo,0,30,"EUC-KR")." ...";
		}
	?>
    <div class="memo"><?php echo $Memo ?></div>


<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {        
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
	  echo  "<td bgcolor=#047cc0><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input class = comment type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }

?>


</td>
</tr>


<?php

}
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
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




</form>







<!-- Apply status changes -->






<?php
	
?>


</body>
</html>
<?php
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);

?>



</html>

