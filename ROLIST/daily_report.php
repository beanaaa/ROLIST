<!doctype html>
<link rel="stylesheet" href="normalize.css">
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

$curPage = "daily_report.php";
$permitUser = $_SESSION['MM_UserGroup'];
include("configuration.php");

include("idc.php");

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
    $week_post = $_POST['weekago'];
    

	$searchQ = $_POST['txt_search'];
	$searchQ=preg_replace("/\s+/","",$searchQ); 

// 	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '%$searchQ%' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
				$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}

	for($phsIds=0;$phsIds<$numphyss;$phsIds++){

		if(strcmp($uid,$phyInt[$phsIds])==0){
			$md2 = $phyInt[$phsIds];
		}


}


	$md2t = $_POST['mdname'];
	if(strlen($md2t)>0){
		$md2 = $md2t;
	}
	$md = $md2;		


	for($idphyss=0;$idphyss<$numphyss;$idphyss++){
		if(strcmp($md2,$phyInt[$idphyss])==0){
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
	$md = $_POST['mdname'];	
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
 
<style>
	
</style>

<style>
 @media (max-width:1000px){
 /*
 화면의 크기가 20rem보다 작을 때 보여지는 CSS코드
 */
 .float-button {position: fixed;
 background-image: gray;
width: 43px;
height: 200px;
top: 200px;
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
	height: 200px;
	top: 200px;
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
 input[type=submit].selector {
	padding: 3px 4px;
    border: none; /* Green */	

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	

</style>




<?php
	$widthSite = "80";
	
	?>

<title>Radiation Oncology List</title>

<!-- READ PHYSICIANS FROM CFG FILE -->
<?php

?>






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

$conn = mysqli_connect("localhost", "root", "dbsgksqls")  ;
mysqli_select_db("test", $conn);
// mysqli_select_db($database_test );
mysqli_query($test,"set session character_set_connection=latin1;");
mysqli_query($test,"set session character_set_results=latin1;");
mysqli_query($test,"set session character_set_client=latin1;");

//오늘 날짜 출력 ex) 2013-04-10
$today_date      = date('Y-m-d');
//오늘의 요일 출력 ex) 수요일 = 3
$day_of_the_week = date('w');
$Today_date_nextweek     = date("Y-m-d",strtotime("+1 week")); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시

//오늘의 첫째주인 날짜 출력 ex) 2013-04-07 (일요일임)

// -1 working day check
for ($dayCount=-1; $dayCount>-20; $dayCount--){
	$dcs = $dayCount . " day";
// 		echo($dcs);
	$beforeDay = date("m/d/y", strtotime($today. $dcs));
// 		echo($beforeDay);
	$daySql = "Select * from Holiday where solar_date like STR_TO_DATE('$beforeDay','%m/%d/%Y')";
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,$daySql));	
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
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,$daySql));	
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
for($nums = 0; $nums<$numphyss;$nums++){ 

	if(strcmp($md, $phyIdd[$nums])==0){
		$titleMd = $phyInt[$nums];
		$md = $phyIdd[$nums];
		$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";

	}
}



$siteInput = $_POST['sitename'];	
$clinicInput = $_POST['clinicname'];	

if(strlen($clinicInput)>0){
	$queryClinic = "((TreatmentInfo.Clinic LIKE '%$clinicInput%') or (TreatmentInfo.diagnosis LIKE '%$clinicInput%') or (TreatmentInfo.subsite LIKE '%$clinicInput%') or (TreatmentInfo.purpose LIKE '%$clinicInput%')) AND ";

}
else{
	$queryClinic = "";
}

if(strcmp($siteInput,"CNS")==0 or strcmp($siteInput,"HN")==0 or strcmp($siteInput,"BRST")==0 or strcmp($siteInput,"THX")==0 or strcmp($siteInput,"GI")==0 or strcmp($siteInput,"GU")==0 or strcmp($siteInput,"GY")==0){
	$querySite = "(TreatmentInfo.primarysite LIKE '$siteInput') AND ";
} 
else{
	$querySite = "";
} 

// Patinet counting

	for($idphyss=0;$idphyss<$numphyss;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.physician LIKE '%$phyIdd[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveMD[$idphyss] = mysqli_num_rows($Recordset1);
	}
	for($idphyss=0;$idphyss<$numtech;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.RT_method_f LIKE '%$techIdd[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveTech[$idphyss] = mysqli_num_rows($Recordset1);
	}
	
	for($idphyss=0;$idphyss<$numrooms;$idphyss++){ 
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%$rmsInt[$idphyss]%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveRoom[$idphyss] = mysqli_num_rows($Recordset1);
	}







	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%Ver%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveVersa = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%IX%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveIx = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.Linac1 LIKE '%In%'" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveInfinity = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND CHAR_LENGTH(TreatmentInfo.Modality_var1)>1" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$numCCRT = mysqli_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$numTotal = mysqli_num_rows($Recordset1);








// 	Per site


	for($idphyss=0;$idphyss<$numcatg;$idphyss++){ 
		$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $querySite $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%$catgInt[$idphyss]%'" ;	
		$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
		$liveCatg[$idphyss] = mysqli_num_rows($Recordset1);
	}





	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') < '$Today_date_nextweek' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveFin = mysqli_num_rows($Recordset1);
	
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite  STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') < '$Today_date_nextweek' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)" ;	
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$liveStart = mysqli_num_rows($Recordset1);
?>

<?php
	include("mainmenu.php");
?>







</td>
</tr>
</table>





<!--


<form id=form11 name=form11 method=post target="_blank"   action="absence.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Absence />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
-->




























































<?php
	$mdChart = 0;	

	if(strlen($queryMD)>1){
		$mdChart = 1;	
	}
?>
<!-- Header -->
<br>
<table cellpadding = "0px" width="960px" border="0" align="center" cellspacing="0">
	<tr>
		<th width="400px" align=left valign="top">
		<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 		 
	</th>





	<form name = "formSite" id = "formSite" method = "post" action ="daily_report.php">
		<th valign="middle" width="60px" align=left >
			<select name="sitename" style="width: 50px; height: 18px">
			<option name="sitename" value= <?php echo $siteInput; ?> selected> <?php echo $siteInput; ?> </option>
			<option name="sitename" value="*" >Total</option>
			<option name="sitename" value="CNS" >CNS</option>
			<option name="sitename" value="HN" >HN</option>
			<option name="sitename" value="THX" >THX</option>
			<option name="sitename" value="BRST" >BRST</option>
			<option name="sitename" value="GI" >GI</option>
			<option name="sitename" value="GU" >GU</option>
			<option name="sitename" value="GY" >GY</option>
			
			
		</select>
		</th>
		<th valign="middle" width="60px" align=left >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class = "selector" style="width: 50px; height: 20px" type='submit' value='Submit'  style="width: 50px; height: 20px">
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
		
		</th>
		<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
	</form>	

	<form name = "formClinic" id = "formClinic" method = "post" action ="daily_report.php">
		<th valign="middle" width="60px" align=left >
		<input name="clinicname" style="width: 50px; height: 20px">


		</th>
		<th valign="middle" width="60px" align=left >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit'  class = "selector" style="width: 50px; height: 20px"  value='Sort'  style="width: 50px; height: 20px">
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
		
		</th>
		<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
	</form>	
	<th valign="middle" width="20px" align=left >
		&nbsp; || 
	</th>

	<form id=form11 name=form11 method=post action="daily_report.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit'  class = "selector" style="width: 50px; height: 20px"  name="mdname" value="Total"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />		
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
					
		</th>
	</form>



	<!-- PHYSICIAN SELECTOR GENERATION -->
	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){ 	
		if((strlen($titleMd)!=0 and strcmp($titleMd,$phyInt[$idphys])==0) or strlen($titleMd)==0){
			$bgcols = $phyCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
		
		
		
		
	?>

	<form id=form11 name=form11 method=post action="daily_report.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit'  class = "selector"  name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; background-color: <?php echo $bgcols;?>;"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
			
		</th>
	</form>

	<?php }	?>






	<form id=form11 name=form11 method=post target=_blank action="trend.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit'  class = "selector" style="width: 50px; height: 20px" name="mdname" value="Trend"  style="width: 50px; height: 20px"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />		
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
					
		</th>
	</form>
	<form id=form11 name=form11 method=post target=_blank action="pending.php">
	<?php if ($permitUser ==1){	?>

		<th valign="middle" align=right >
				<form id=form11 name=form11 method=post target=_blank action="pending.php">
					<input class = "selector" style="width: 50px; height: 20px; background-color:red; color:white"  type=submit name=btn_home id=btn_home value="Auth" />
					<input class = "btn button-update" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
			</form>					
		</th>
	<?php } ?>
	</form>

	</tr>
</table>

<br>


<table width="960px" border="0" align="center" cellspacing="0">
	<tr>
		<td colspan="200">
			<font style="font-size:12px"><strong>Stat.<?php echo ""; ?>(Total: <?php echo $numTotal;?>)	</strong></font>		
		</td>
	</tr>	
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


<!-- 		<td bgcolor="#efcef3" width="48px" align="center">  
			CNS
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			HN
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			THX
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			BRST
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			GI
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			GU
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			GY
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			MS
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			SKIN
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			HMT
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			PD
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			BENIGN
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			CUPS
		</td>
		<td bgcolor="#efcef3" width="48px" align="center">  
			OTHER
		</td> -->
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
		
		
		
<?php
	
$StatT = $_POST['StatT'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test,"select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test,"select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

	}
	echo("");
 	$sqlQuery = mysqli_query($test,"update TreatmentInfo set $sId = 1 where Hospital_ID = '$hId'");		
}

	
?>		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">	    
		<?php	
		$Recordset1 = mysqli_query($test,$searchQuery )  ;
		
		$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
		$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
		if($totalRows_Recordset1>0){ 
		?>	    
        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
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
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

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

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
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

	if(1==1){
    $idcolor++;
    $totalDays++;


	if ($totalRows_Recordset1>0){
            
    $yoil = array("일","월","화","수","목","금","토");
    
    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);

	$bgcolorF = "#e3ecec";  /* cool-gray 1 (ibm design colors) */
	
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
    echo "<td bgcolor=$bgcolorF width = '60px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorInp> $row_Recordset1[InP]/$row_Recordset1[diagnosis]  </font> </td>";         /* #CC6699 (web safe colors) */

    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	$StatTarget = $sqlQuery[$tChecked];
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$StatPlan = $sqlQuery[$pChecked];	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	$StatApprove = $sqlQuery[$aChecked];	
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
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";   
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  

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
    
    
         
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";
    
    
//     Technique




    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){
		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */
	}
	echo($phyMark) ;






	
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
   
// Prescription ends]

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


	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom) and $StatTarget!=1) {
		$datecol = "#dc267f"; /* magenta 50 (ibm design colors) */
	}
	else{
		$datecol = "#000000"; /* magenta 50 (ibm design colors) */		
	}


	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$datecol><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";


    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}

?>









<!-- Unscheduled -->

<?php

$workDay = 0;
$totalDays = 0;
for($idDays = 0;$idDays<1;$idDays++){ 
	
	
	
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
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

$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite 
(PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL) AND ((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') < '1980-01-01' OR STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') is null) OR CHAR_LENGTH(TreatmentInfo.RT_start1)<5) AND CHAR_LENGTH(PatientInfo.KorName)>1";

// echo($query_Recordset1);

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}

$query_Recordset1 .= " ORDER BY TreatmentInfo.Linac_f " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


// print_r($row_Recordset1);
if($totalRows_Recordset1 !=0){ 
?>

<tr>
	<br>
        <th align=left colspan="100">
	        <br>
	        <font style="font-size:12px">Unscheduled</font>

        </th>
</tr>		
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
<!-- 			<th bgcolor="#777777">Ind</th> -->
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  

			<td bgcolor="#777777"><font color="white">Name</font></td>
			 
<!-- 			<th bgcolor="#777777">Diag.</th>						 -->
			<td bgcolor="#777777" align="left"><font color="white">Site</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>

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
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<?php if($mdChart==0){ ?>					
			<td bgcolor="#777777"><font color="white">Ph</font></td>
			<?php } ?>			
			<?php

			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
			        </tr>



<?php
	}


$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["CT_Sim1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["CT_Sim2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["CT_Sim3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["CT_Sim4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["CT_Sim5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["CT_Sim6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["CT_Sim7"]));
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
}



$StatT = $_POST['StatT'];



?>



<?php
		
$today = date("n/j/y", time(0));

$idcolor   = 0;
$count     = 0;
$planIdInd = 0;

/*
echo("<br>");
echo($totalRows_Recordset1);
echo("<br>");
*/
// print_r($row_Recordset1);

if ($totalRows_Recordset1!=0){
do {	

    $idx        = $row_Recordset1['idx']; //진료 횟수
    $RT_Start_f = "RT_start" . "$idx";
    $RT_Fin_f   = "RT_fin" . "$idx";
    $CT_Start_f = "CT_Sim" . "$idx";
    $Dose_f     = "dose" . "$idx";
    $Fx_f       = "Fx" . "$idx";
    $Field_f    = "Field" . "$idx";
    $Method_f   = "RT_method" . "$pid[$tCount]";
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

        $bgcolorF = "#FFFFFF";

	if(strlen($row_Recordset1[KorName])>0){
    $idcolor++;
    $totalDays++;
	

	
	
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
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] != NULL){
// 		$bgcolorF = "#95c4f3"; 
		$stInd = "C";			
	}
	
	

    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
        
//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	$StatTarget = $sqlQuery[$tChecked];
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$StatPlan = $sqlQuery[$pChecked];	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	$StatApprove = $sqlQuery[$aChecked];	
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
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  
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
    
    echo " <td bgcolor=$bgcolorF width = '100px'>  $patholcrop  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   $row_Recordset1[purpose] </td> ";	


//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	
// 	Prescription 
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='140' align='left'><div class='memo'>";
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
			echo "<font  face=arial>&nbsp$planIdx.$SiteX:</font><font face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
		}
		else{
			echo "<font  face=arial>&nbsp$planIdx.$SiteX:$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
			
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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";


	
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom) and $StatTarget==0) {
		$datecol = "#dc267f"; /* magenta 50 (ibm design colors) */
	}
	else{
		$datecol = "#000000"; /* magenta 50 (ibm design colors) */		
	}




// 	if($idcolor==1){
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    

    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
	
?>

    <div class="memo"><?php echo $Memo ?></div>

<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {
/*
        echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
        echo "<a href=edit.php>";            
        echo "<input type=submit name=btn_edit id=btn_edit value=R>";
        echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
        echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
*/
        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shortorder.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=username type=hidden id=username  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
/*
        echo "<td bgcolor=$bgcolorF><form id=form4 name=form4 method=post target=_blank action=N_report_all.php>";
        echo "<input type=submit name=btn_report id=btn_report  value=R>";
        echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
        echo "<input name=hr_field type=hidden id=hr_field value= $row_Recordset1[Hospital_ID] /></form></td>";
*/
        
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>





















	<tr>
        <td align=left  colspan="100">
	        <br>
	        <font style="font-size:12px"><strong>Scheduled</strong> - Waiting for Target (</font> 
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

<!-- FLOATING BUTTON -->
			<!-- <div class="float-button">
				
		        <input class="btn button-update" type="submit" name="statchk" id="Plans" style="font-size: 20px; font-weight: 200" value = "✔" />
			    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
				<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
				<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
				<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
				<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
				<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
				<br>				
				<br>

				<form id=form11 name=form11 method=post target=_blank action="N_register_all.php">
						<input class = "btn button-update" style="font-size: 20px; font-weight: 200" type=submit name=btn_home id=btn_home value="✎" />
						<input class = "btn button-update" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
				</form>			

				<br>			
				<input class="btn button-update" type="button" id="button1" onclick="button1_click();" style="font-size: 14px; font-weight: 200" value="📅" />

				<br>
				<script>

				function button1_click() {
					<?php
					echo "window.open('simschedule.php?permit=$permitUser', '_blank', 'width=1230px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
				}
				</script>
			</div> -->




<!--
	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
-->


					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </td>
</tr>
        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
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
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $queryClinic $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '0')) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '0')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '0')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '0'))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

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

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
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



	if (((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)) and strtotime($row_Recordset1[$CT_sim_curr]) <= strtotime($today)){

	
                
    $yoil = array("일","월","화","수","목","금","토");

    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
		$bgcolorH = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
		$bgcolorH = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
		$bgcolorH = "#95c4f3"; 
		$stInd = "C";			
	}
	$TargetCheck = "T".$pid[$tCount];
	
	
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
	
		if(strcmp($row_Recordset1[$TargetCheck],"1")==0){
				$bgcolorH = "#FFFFFF"; 

	}

	
    $E_curr = "E" . "$pid[$tCount]";
    $N_curr = "N" . "$pid[$tCount]";    

	if (strcmp($row_Recordset1[$E_curr],"1")!=0) {
		$fontColorF = "#000000"; /* cool-gray 50 (ibm design colors) */
	}
	
    $startColor = "#424747"; /* cool-gray 70 (ibm design colors) */
    $startVal = "";
    $startValR = "";	        	        
	$urgentCol = $bgcolorF;
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingyest)) {
		$startColor = "#3c6df0"; /* ultramarine 50 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom)) {
		$startColor = "#00884b"; /* green 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";	        
		$urgentCol = "#f7aac3";	         /* magenta 20 (ibm design colors) */
		

	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today)) {
		$startColor = "#e62325"; /* red 70 (ibm design colors) */
		$startVal = "<strong>";
		$startValR = "</strong>";
		$urgentCol = "#f87eac";	         /* magenta 30 (ibm design colors) */
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
    echo "<td bgcolor=$bgcolorH width = '60px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorInp>$row_Recordset1[InP]/$row_Recordset1[diagnosis]</font>  </td>";         /* #CC6699 (web safe colors) */
    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        
    } else {
        $bgcolorF = "#DDDDDD";
        $bgcolorH = "#DDDDDD";
    }
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;

    
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
	
$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	$StatTarget = $sqlQuery[$tChecked];
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$StatPlan = $sqlQuery[$pChecked];	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	$StatApprove = $sqlQuery[$aChecked];	
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom) and 	$StatTarget==0) {
		$datecol = "#f7aac3"; /* magenta 20 (ibm design colors) */
	}
	else{
		$datecol = "#FFFFFF"; /* magenta 50 (ibm design colors) */		
	}	
	
	
	
		?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$datecol width = '5px'>";  	// TARGET STATUS WB Updated ?>

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
		
		
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  

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

       
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";

//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;




	
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
    
    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 

	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");

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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>




	<tr class="border_bottom">
        <td align=left  colspan="100">
	        <br>
	        <font style="font-size:12px"><strong>Scheduled</strong> - Waiting for Simulation</font>       	        	        

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				


					
		   
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
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryClinic $queryMD $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '0')) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '0')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '0')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '0')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '0'))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

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

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
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



// 	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){
	if (((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)) and strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)){

	
                
    $yoil = array("일","월","화","수","목","금","토");

    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
		$bgcolorH = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
		$bgcolorH = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
		$bgcolorH = "#95c4f3"; 
		$stInd = "C";			
	}
	$TargetCheck = "T".$pid[$tCount];
	
	
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
	
		if(strcmp($row_Recordset1[$TargetCheck],"1")==0){
				$bgcolorH = "#FFFFFF"; 

	}

	
    $E_curr = "E" . "$pid[$tCount]";
    $N_curr = "N" . "$pid[$tCount]";    

	if (strcmp($row_Recordset1[$E_curr],"1")!=0) {
		$fontColorF = "#000000"; /* cool-gray 50 (ibm design colors) */
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
    echo "<td bgcolor=$bgcolorH width = '50px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[diagnosis]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        
    } else {
        $bgcolorF = "#DDDDDD";
        $bgcolorH = "#DDDDDD";
    }
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;

    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  

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
      
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";

//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


	
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
    

    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 

	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");

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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>




















	<tr  class="border_bottom">
        <td align=left  colspan="100">
	        <br>
	        <font style="font-size:12px"><strong>Scheduled</strong> - Target Completed</font> 
      	        	        

	        <input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				


					
		   
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
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryClinic $queryMD $querySite 
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo')) and (TreatmentInfo.T2 LIKE '1')) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T3 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T4 LIKE '1')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T5 LIKE '1')) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T6 LIKE '1')) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T7 LIKE '1'))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);



$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

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

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
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



	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
    $yoil = array("일","월","화","수","목","금","토");

    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	if($pid[$tCount]==$idx){
		$bgcolorH = "#f7aac3"; 
		$stInd = "F";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
		$bgcolorH = "#f7e4fb"; 
		$stInd = "P";			
	}
	
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
		$bgcolorH = "#95c4f3"; 
		$stInd = "C";			
	}
	$TargetCheck = "T".$pid[$tCount];
	
	
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
	
		if(strcmp($row_Recordset1[$TargetCheck],"1")==0){
				$bgcolorH = "#FFFFFF"; 

	}

	
    $E_curr = "E" . "$pid[$tCount]";
    $N_curr = "N" . "$pid[$tCount]";    

	if (strcmp($row_Recordset1[$E_curr],"1")!=0) {
		$fontColorF = "#000000"; /* cool-gray 50 (ibm design colors) */
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
    echo "<td bgcolor=$bgcolorH width = '50px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]/$row_Recordset1[diagnosis]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        
    } else {
        $bgcolorF = "#DDDDDD";
        $bgcolorH = "#DDDDDD";
    }
        $bgcolorF = "#FFFFFF";
		$bgcolorH = "#FFFFFF";        

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;

    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	$StatTarget = $sqlQuery[$tChecked];
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$StatPlan = $sqlQuery[$pChecked];	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	$StatApprove = $sqlQuery[$aChecked];		
	
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($workingtom) and 	$StatTarget==0) {
		$datecolT = "#f7aac3"; /* magenta 20 (ibm design colors) */
	}
	else{
		$datecolT = "#FFFFFF"; /* magenta 50 (ibm design colors) */		
	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today) and 	$StatApprove==0) {
		$datecolA = "#f7aac3"; /* magenta 50 (ibm design colors) */
	}
	else{
		$datecolA = "#FFFFFF"; /* magenta 50 (ibm design colors) */		
	}
	if (strtotime($row_Recordset1[$RT_start_curr]) == strtotime($today) and 	$StatPlan==0) {
		$datecolP = "#f7aac3"; /* magenta 50 (ibm design colors) */
	}
	else{
		$datecolP = "#FFFFFF"; /* magenta 50 (ibm design colors) */		
	}
	
	
	
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$datecolT width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatT[]" value=<?php echo($statValT);  echo($chkCurT);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$datecolP width = '5px'>";  ?>
		<input type='checkbox' name='StatT[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$datecolA width = '5px'>"; ?>
	
		<input type='checkbox' name='StatT[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
		

		
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  

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
    
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";


//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	
	
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
    

    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 

	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");

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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>






<!-- Waiting for start -->

<?php
$fTnum = 0;
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
	((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1' and TreatmentInfo.P1 LIKE '1' and TreatmentInfo.A1 LIKE '1')))) AND 
	(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

	if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
	    $order = 'DESC';
	}
	$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
	$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
	$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
	if($totalRows_Recordset1 !=0){ 
		$fTnum = $fTnum+1;
	}


}

	if($fTnum >0){
?>

		<tr>
	        <th align=left  colspan="100">
		        <br>
		        <font style="font-size:12px">Waiting for start</font> 

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
				<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
				<td bgcolor="#777777"><font color="white">C</font></td>
				<td bgcolor="#777777"><font color="white">T</font></td>
				<td bgcolor="#777777"><font color="white">P</font></td>
				<td bgcolor="#777777"><font color="white">A</font></td>                                         	  
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
				<?php
				if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
					echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
				}
				?>
			</tr>

<?php



	}

?>

	










































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
((((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.T1 LIKE '1' and TreatmentInfo.P1 LIKE '1' and TreatmentInfo.A1 LIKE '1')))) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
if($totalRows_Recordset1 !=0){ 

?>



<?php

$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

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

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;
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


// 	if ((strlen($row_Recordset1[$CT_sim_curr]) >5) or ($pid[$tCount]==1)){

	
                
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

	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '60px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]/$row_Recordset1[diagnosis]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF="#FFFFFF";

    
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  

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
    
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";

//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


	
	
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

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    

    // LINAC from cfg files
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

		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}
?>























  




<div class="float-button">
	<br>
	<input class="btn button-update" type="submit" name="statchk" id="Plans" style="font-size: 20px; font-weight: 200" value = "✔" />
			    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
				<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
				<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
				<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
				<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
				<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
	<br>
	<br>
	<!-- <form id=form11 name=form11 method=post target=_blank action="N_register_all.php">
			<input class = "btn button-update" style="font-size: 20px; font-weight: 200" type=submit name=btn_home id=btn_home value="✎" />
			<input class = "btn button-update" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>

	</form> -->
	<input class="btn button-update" type="button" id="button1" onclick="buttonNew_click();" style="font-size: 14px; font-weight: 200" value="✎" />

	<script>
	function buttonNew_click() {
		<?php
		echo "window.open('N_register_all.php?permit=$permitUser', '_blank', 'width=1100px, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
	
	<br>
	<br>
	
	<input class="btn button-update" type="button" id="button1" onclick="button1_click();" style="font-size: 14px; font-weight: 200" value="📅" />
	<script>
	function button1_click() {
		<?php
		echo "window.open('simschedule.php?permit=$permitUser', '_blank', 'width=1300px, height=750, toolbar=no, menubar=no, resizable=no, copyhistory=no' );"; ?>
	}
	</script>
	<br>	


	    <br>
	<?php if ($permitUser ==1){	?>
	<!-- <form id=form11 name=form11 method=post target=_blank action="pending.php">
			<input class = "btn button-update" style="font-weight: 200" type=submit name=btn_home id=btn_home value="Auth" />
			<input class = "btn button-update" name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
	</form> -->

	<?php }	?>
	<br>
	
	
    </div>






<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Active (</font> 
	        <span style="background-color:#B0C4DE"> Complete within 5 working days </span> )</font>

        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  

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
			<?php

			if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
				echo "<td colspan=3 bgcolor=#777777 scope=col><font color=white>Detail/Remark</font></td>";
			}
			?>
			        </tr>

<?php

$findays = 0;
for($idffd=0;$idffd<20;$idffd++){ 
	$workingDaychecker     = date('Y-m-d', strtotime(date("n/j/y") . '+' . $idffd . ' days'));
	
	$daySql = "Select * from Holiday where solar_date like '$workingDaychecker'";
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,$daySql));	
	$yoils = date('w', strtotime($workingDaychecker));

	$workingyest = $sqlQuery[solar_date];
	if($yoils !=0 and $yoils !=6 and strlen($sqlQuery[memo])==0){
		$findays = $findays+1;
		$coloredday = $workingDaychecker;
	}
	if($findays==6){
		break;
	}
}



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



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryClinic $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus like 1  OR PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL)" ;	

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY binary(PatientInfo.KorName) ASC";

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;

// echo($query_Recordset1);


$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
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
//  	$sqlQuery = mysqli_query($test,"update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

if ($totalRows_Recordset1!=0){
do {	

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
        $bgcolorF = "#FFFFFF";
        $bgcolorH = "#FFFFFF";

	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;
	
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
    
    
    $yoil = array("일","월","화","수","목","금","토");

    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);
    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
    
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	
    $ss2        = date('Y-m-d', strtotime($row_Recordset1["RT_fin_f"] . '-' . '0' . ' days'));

    if ($ss2 < $coloredday) {
	        $bgcolorH = "#B0C4DE"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorH = "#FFFFFF";
	}

	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorH width = '50px' style='letter-spacing:-0.2px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]/$row_Recordset1[diagnosis]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$aChecked]==1){ $chkCurA = "	checked='checked'";}
	else{ $chkCurA = "";}	
	?>
	
	
	
<!-- Checkbox for status -->
	<input  type="checkbox" name="StatT_[]" value=<?php echo($statValT);  echo($chkCurT);?> ></span>
		
	</td>			
		<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatT_[]' value=<?php echo($statValP);   echo($chkCurP);?> >	
	</td>
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>"; ?>
	
	<input type='checkbox' name='StatT_[]' value=<?php echo($statValA); echo($chkCurA);?> >
	
	</td>



	<?php
	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  
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
     
    echo " <td bgcolor=$bgcolorF width = '100px'>  $patholcrop  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    echo " <td bgcolor=$bgcolorF width = '55px'>   $row_Recordset1[purpose] </td> ";

//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	
	
// 	Prescription 
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='140' align='left'><div class='memo'>";
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
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:</font><font color=blue face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

// 	if($idcolor==1){
		$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

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
    

    // LINAC from cfg files
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

		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>






<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Suspended</font>

        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  

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



$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite (PatientInfo.CurrentStatus LIKE '4')" ;	

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test,$query_Recordset1 )  ;



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test,$query_Recordset1 )  ;

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["RT_start1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["RT_start2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["RT_start3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["RT_start4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["RT_start5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["RT_start6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["RT_start7"]));
    $ss        = date('Y-m-d', strtotime($today_date . '+' . '0' . ' days'));
    $nullDate = "1980-01-01";
    
    if (($ss >= $s1 && $ss < $s2) or ($ss >= $s1 && $s2 < $nullDate) ) {
        $pid[$iddd]        = "1";
        $dateSorter[$iddd] = $s1;
    }
    elseif (($ss >= $s2 && $ss < $s3) or ($ss >= $s2 && $s3 < $nullDate)) {
        $pid[$iddd]        = "2";
        $dateSorter[$iddd] = $s2;
    }
    elseif (($ss >= $s3 && $ss < $s4) or ($ss >= $s3 && $s4 < $nullDate)) {
        $pid[$iddd]        = "3";
        $dateSorter[$iddd] = $s3;
    }
    elseif (($ss >= $s4 && $ss < $s5) or ($ss >= $s4 && $s5 < $nullDate)) {
        $pid[$iddd]        = "4";
        $dateSorter[$iddd] = $s4;
    }
    elseif (($ss >= $s5 && $ss < $s6) or ($ss >= $s5 && $s6 < $nullDate)) {
        $pid[$iddd]        = "5";
        $dateSorter[$iddd] = $s5;
    }
    elseif (($ss >= $s6 && $ss < $s7) or ($ss >= $s6 && $s7 < $nullDate)) {
        $pid[$iddd]        = "6";
        $dateSorter[$iddd] = $s6;
    }
    elseif (($ss >= $s7) && $s7>$nullDate) {
        $pid[$iddd]        = "7";
        $dateSorter[$iddd] = $s7;
    }
//  	$sqlQuery = mysqli_query($test,"update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

if ($totalRows_Recordset1!=0){
do {	

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


	$bgcolorF = "#FFFFFF";

	if(1==1){
    $idcolor++;
    $totalDays++;
	
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
    
    $yoil = array("일","월","화","수","목","금","토");

    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);
    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
    
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);
	
	
    $ss2        = date('Y-m-d', strtotime($row_Recordset1["RT_fin_f"] . '-' . '7' . ' days'));


    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurT = "	checked='checked'";}
	else{ $chkCurT = "";}
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $pChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurP = "	checked='checked'";}
	else{ $chkCurP = "";}
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $aChecked from TreatmentInfo where Hospital_ID = '$statVal'"));	
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
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
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
    echo " <td bgcolor=$bgcolorF  width = $widthSite px>   <strong>$patholcrop</strong> </td> ";  

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
    
    echo " <td bgcolor=$bgcolorF width = '100px'>  $patholcrop  </td> ";       
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
    echo " <td bgcolor=$bgcolorF width = '70px'>    $patholcrop</td> ";
    
    echo " <td bgcolor=$bgcolorF width = '55px'>   $row_Recordset1[purpose] </td> ";
//     Technique
    $RT_method_curr = "RT_method" . "$pid[$tCount]";
	$tcn = substr(trim($row_Recordset1[$RT_method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$RT_method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;

	
	
// 	Prescription 
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='140' align='left'><div class='memo'>";
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
			echo "<font color=gray face=arial>&nbsp$planIdx.$SiteX:</font><font color=blue face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])</font>";
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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

// 	if($idcolor==1){
		$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

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
    

    // LINAC from cfg files
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	if($row_Memoinfo>0){ 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>


</table>












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

