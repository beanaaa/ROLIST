<!doctype html>
<?php
include("configuration.php");
	
?>
	
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

/*
$ids = $_POST('uid');
echo($ids);
*/

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
    $week_post = $_POST['weekago'];
    $md = "myki";
	$md2 = $_POST['mdname'];	
	if(strcmp($md2,"KI")==0){
		$md = "myki";		
	}
	elseif(strcmp($md2,"JuL")==0){
		$md = "mhlee";		
	}
	elseif(strcmp($md2,"JaL")==0){
		$md = "mjlee";		
	}
	else{
		$md = $md2;		
	}

//echo $permitUser;
//echo $permitUser;
// MUST BE DELETED!!!!
	$screenRatio = 1.2;
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

<style type="text/css">
* {
-webkit-text-size-adjust: none;

-moz-text-size-adjust: none;

-webkit-text-size-adjust: none;

-ms-text-size-adjust: none;

font-size-adjust: none;
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


	table td strong{
	  font-weight: bold;
	}​

	input[type=text] {
	    padding:0px;
	    border:1px solid #ccc;
	    border-radius: 0px;
	}
div.memo {
    font-size: 10px;
    line-height: 95%;
/*     letter-spacing: 0.8px; */
}

	
/*
	input[type=text]:focus {
	    border-color:#333;
	}
	
	input[type=submit] {
	    padding:0px 0px;
	    background:#FFFFFF;
	    border:0 none;
	    cursor:pointer;
	    -webkit-border-radius: 0px;
	    font-size: 10px;
	    border-radius: 1px;
	}
	input[type=button] {
	    padding:1px 1px;
	    background:#FFFFFF;
	    border:0 none;
	    cursor:pointer;
	    -webkit-border-radius: 1px;
	    border-radius: 1px;
	}
*/
	
	choice{
	    padding:5px 10px;
	    background:#f10606;
	    border:0 none;
	    cursor:pointer;
	    border-radius: 5px;
	}
	select {
	    padding:10px;
	    border:2px solid #ccc;
	    height: 15px;
	    width: 100px;
	    border-radius: 5px;
	}
	
	#apDiv1 {
		position: absolute;
		width: 1055px;
		height: 115px;
		z-index: 1;
		left: -1px;
		top: 111px;
		}
	
	body,td,th {
    font-family: arial;
		color: #000000;
		font-size: 10px;
/* 		text-align: right; */
	}
	
	th{
		height: 5px;
	}
	
	table {
		border-collapse: collapse;
		
	}		
	tr { 
	  border: solid;
	  border-width: 0px 0;
	}
	
	aa {
    font-family: arial;
	    color: rgba(0, 0, 0, 0.76);
	    font-size: 10px;
	}	
	a:link {
		color: #09C;
	}
	a:visited {
		color: #06C;
	}
	a:hover {
		color: #0075BE;
		font-weight:  100;
	}
	a:AC {
		color: #069;
		}
	

input,select,button {
/*  font-family: Arial,Helvetica,arial; */
 font-size: 7px;
 
}	
</style>

<title>Radiation Treatment Record</title>




</head>





<body>
<!-- Body starts here!!! -->


<?php

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


$years = $_POST['yearselect'];
$months = $_POST['monthselect'];

$today_date = $years. "-". $months. "-01";
$today_date2 = $years. "-". $months. "-31";
// echo($today_date2);
// $today_date2 = "2018-01-31";

?>




<form name = "Year" id = "Year" method = "post" action ="monthlycount.php">
	<th align=left >
		<select name="yearselect">
		<option name="yearselect" value= <?php echo $years; ?> selected><?php echo $years; ?> </option>
		<option name="yearselect" value="2016" >2016</option>
		<option name="yearselect" value="2017" >2017</option>
		<option name="yearselect" value="2018" >2018</option>
		<option name="yearselect" value="2019" >2019</option>
		<option name="yearselect" value="2020" >2020</option>
		<option name="yearselect" value="2021" >2021</option>
		<option name="yearselect" value="2022" >2022</option>
		<option name="yearselect" value="2023" >2023</option>

		
	</select>
			<select name="monthselect">
		<option name="monthselect" value= <?php echo $months; ?> selected><?php echo $months; ?> </option>
		<option name="monthselect" value="01" >1</option>
		<option name="monthselect" value="02" >2</option>
		<option name="monthselect" value="03" >3</option>
		<option name="monthselect" value="04" >4</option>
		<option name="monthselect" value="05" >5</option>
		<option name="monthselect" value="06" >6</option>
		<option name="monthselect" value="07" >7</option>
		<option name="monthselect" value="08" >8</option>
		<option name="monthselect" value="09" >9</option>
		<option name="monthselect" value="10" >10</option>
		<option name="monthselect" value="11" >11</option>
		<option name="monthselect" value="12" >12</option>

		
	</select>

	<input type='submit' value='Submit' />

	</th>
	<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
</form>	


<!-- Patient counting -->
<br>
<br>
<font size="4">월간 환자 현황(<?php echo($years. "-". $months);?>)</font>
<br>
<br>


<?php
	

	for($idphys=0;$idphys<count($catgInt);$idphys++){ 
		$site[$idphys] = $catgInt[$idphys];
	}
	
	
	
	for($idphys=0;$idphys<count($phyIdd);$idphys++){ 
		$mdP[$idphys] = $phyIdd[$idphys];
		$mds[$idphys] = $phyInt[$idphys];
	}
/*
	$mdP[0] = "myki";
	$mdP[1] = "mjlee";
	$mdP[2] = "mhlee";		
*/
	
	
	
	
/*
	$mds[0] = "KI";
	$mds[1] = "JaL";
	$mds[2] = "JuL";		
*/
	
	for($idMd = 0; $idMd<count($phyIdd); $idMd++){ 
		for($idSite = 0; $idSite<count($catgInt);$idSite++){ 	
/*
			$today_date = "2018-01-01";
			$today_date2 = "2018-01-31";
*/
			$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
			(TreatmentInfo.physician LIKE '$mdP[$idMd]') AND 
			((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') >= '$today_date' and STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date2' ) )AND 
			(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
			(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND 
			TreatmentInfo.primarysite LIKE '%$site[$idSite]%'" ;	
			$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
			$live = mysql_num_rows($Recordset1);
			$tVal[$idMd][$idSite] = $live;
			$live = 0;
			$Recordset1 = 0;
// 			echo($query_Recordset1);
		}
	}
	
?>
	<font size="3">치료시작(치료부위별)</font>
<?php

	echo "<table class = type03 cellpadding = 0px width=960px border=0 align=center cellspacing=0>";
	echo "<tr><td>phys</td>";
	
	for($idphys=0;$idphys<count($catgInt);$idphys++){ 
		$site[$idphys] = $catgInt[$idphys];
		echo("<td>$catgInt[$idphys]</td>");
	}

	
	echo"</tr>";
	for($idMd = 0; $idMd<count($phyIdd); $idMd++){ 
		echo "<tr>";
		$pps = $mds[$idMd];
		echo "<td>$pps</td>";
		for($idSite = 0; $idSite<count($catgInt);$idSite++){ 	
			$fVal = $tVal[$idMd][$idSite];
			echo "<td>$fVal</td>";
		}
		echo "</tr>";
	}
	echo "</table>";



/*
	$linacs[0] = "Versa";	
	$linacs[1] = "IX";	
	$linacs[2] = "Infinity";	
*/
	
	for($idphys=0;$idphys<count($rmsInt);$idphys++){ 
		$linacs[$idphys] = $rmsInt[$idphys];
	}

	
	for($idphys=0;$idphys<count($phyIdd);$idphys++){ 
		$mdP[$idphys] = $phyIdd[$idphys];
		$mds[$idphys] = $phyInt[$idphys];
	}
	
	for($idMd = 0; $idMd<count($phyIdd); $idMd++){ 
		for($idSite = 0; $idSite<count($linacs);$idSite++){ 	
/*
			$today_date = "2018-01-01";
			$today_date2 = "2018-01-31";
*/
			$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
			(TreatmentInfo.physician LIKE '$mdP[$idMd]') AND 
			(STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') >= '$today_date' and STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date2')AND 
			(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
			(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND 
			TreatmentInfo.Linac1 LIKE '%$linacs[$idSite]%'" ;	
			$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
			$live = mysql_num_rows($Recordset1);
			$tVal2[$idMd][$idSite] = $live;
			$live = 0;
			$Recordset1 = 0;
		}
	}
	
?>
	<font size="3">치료시작(치료실별)</font>
<?php
	
	echo "<table class = type03 cellpadding = 0px width=960px border=0 align=center cellspacing=0>";
	
	echo "<tr><td>담당의</td>";
	for($idrooms=0;$idrooms<count($linacs);$idrooms++){ 
	echo "<td>$linacs[$idrooms]</td>";
	}
	echo "</tr>";
	
	
	for($idMd = 0; $idMd<count($phyIdd); $idMd++){ 
		echo "<tr>";
		$pps = $mds[$idMd];
		echo "<td>$pps</td>";
		for($idSite = 0; $idSite<count($linacs);$idSite++){ 	
			$fVal = $tVal2[$idMd][$idSite];
			echo "<td>$fVal</td>";
		}
		echo "</tr>";
	}
	echo "</table>";




	for($idphys=0;$idphys<count($techInt);$idphys++){ 
		$linacs[$idphys] = $techInt[$idphys];
	}
	
	
/*
	$linacs[0] = "VM";	
	$linacs[1] = "IM";	
	$linacs[2] = "SB";	
	$linacs[3] = "3D";	
	$linacs[4] = "2D";	
	$linacs[5] = "EB";	
*/

	for($idphys=0;$idphys<count($phyIdd);$idphys++){ 
		$mdP[$idphys] = $phyIdd[$idphys];
		$mds[$idphys] = $phyInt[$idphys];
	}
	
	for($idMd = 0; $idMd<count($mdP); $idMd++){ 
		for($idSite = 0; $idSite<count($techInt);$idSite++){ 	
/*
			$today_date = "2018-01-01";
			$today_date2 = "2018-01-31";
*/
			$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
			(TreatmentInfo.physician LIKE '$mdP[$idMd]') AND 
			(STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') >= '$today_date' and STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date2')AND 
 
			TreatmentInfo.RT_method1 LIKE '%$linacs[$idSite]%'" ;	
			$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
			$live = mysql_num_rows($Recordset1);
			$tVal2[$idMd][$idSite] = $live;
			$live = 0;
			$Recordset1 = 0;
		}
	}
	
?>
	<font size="3">치료시작(테크닉별)</font>
<?php
	
	echo "<table class = type03 cellpadding = 0px width=960px border=0 align=center cellspacing=0>";
	echo "<tr><td>담당의</td><td>VMAT</td><td>IMRT</td><td>SBRT</td><td>3D</td><td>2D</td><td>EB</td></tr>";
	for($idMd = 0; $idMd<count($phyIdd); $idMd++){ 
		echo "<tr>";
		$pps = $mds[$idMd];
		echo "<td>$pps</td>";
		for($idSite = 0; $idSite<count($techInt);$idSite++){ 	
			$fVal = $tVal2[$idMd][$idSite];
			echo "<td>$fVal</td>";
		}
		echo "</tr>";
	}
	echo "</table>";































	$site[0] = "CNS";	
	$site[1] = "HN";	
	$site[2] = "THX";	
	$site[3] = "BRST";	
	$site[4] = "GI";	
	$site[5] = "GU";	
	$site[6] = "GY";	
	$site[7] = "MS";	
	$site[8] = "SKIN";	
	$site[9] = "HMT";
	$site[10] = "PD";	
	$site[11] = "BENIGN";	
	$site[12] = "CUPS";	
	$site[13] = "OTHER";
	for($idphys=0;$idphys<count($phyIdd);$idphys++){ 
		$mdP[$idphys] = $phyIdd[$idphys];
		$mds[$idphys] = $phyInt[$idphys];
	}
	
	for($idMd = 0; $idMd<3; $idMd++){ 
		for($idSite = 0; $idSite<14;$idSite++){ 	
/*
			$today_date = "2018-01-01";
			$today_date2 = "2018-01-31";
*/
			$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
			(TreatmentInfo.physician LIKE '$mdP[$idMd]') AND 
			((STR_TO_DATE(TreatmentInfo.CT_Sim1, '%m/%d/%Y') >= '$today_date' and STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date2')or (STR_TO_DATE(TreatmentInfo.CT_Sim2, '%m/%d/%Y') >= '$today_date') )AND 
			(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
			(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND 
			TreatmentInfo.primarysite LIKE '%$site[$idSite]%'" ;	
			$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
			$live = mysql_num_rows($Recordset1);
			$tVal[$idMd][$idSite] = $live;
			$live = 0;
			$Recordset1 = 0;
		}
	}
	
	
?>
























	<font size="3">시뮬레이션(치료부위별)</font>
<?php
	
	echo "<table class = type03 cellpadding = 0px width=960px border=0 align=center cellspacing=0>";
	echo "<tr><td>담당의</td><td>CNS</td><td>HN</td><td>THX</td><td>BRST</td><td>GI</td><td>GU</td><td>GY</td><td>MS</td><td>SKIN</td><td>HMT</td><td>PD</td><td>BENIGN</td><td>CUPS</td><td>OTHER</td></tr>";
	for($idMd = 0; $idMd<3; $idMd++){ 
		echo "<tr>";
		$pps = $mds[$idMd];
		echo "<td>$pps</td>";
		for($idSite = 0; $idSite<14;$idSite++){ 	
			$fVal = $tVal[$idMd][$idSite];
			echo "<td>$fVal</td>";
		}
		echo "</tr>";
	}
	echo "</table>";



	$linacs[0] = "Versa";	
	$linacs[1] = "IX";	
	$linacs[2] = "Infinity";	

	for($idphys=0;$idphys<count($phyIdd);$idphys++){ 
		$mdP[$idphys] = $phyIdd[$idphys];
		$mds[$idphys] = $phyInt[$idphys];
	}
	
	for($idMd = 0; $idMd<3; $idMd++){ 
		for($idSite = 0; $idSite<3;$idSite++){ 	
/*
			$today_date = "2018-01-01";
			$today_date2 = "2018-01-31";
*/
			$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
			(TreatmentInfo.physician LIKE '$mdP[$idMd]') AND 
			(STR_TO_DATE(TreatmentInfo.CT_Sim1, '%m/%d/%Y') >= '$today_date' and STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date2') AND 
			(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
			(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND 
			TreatmentInfo.Linac1 LIKE '%$linacs[$idSite]%'" ;	
			$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
			$live = mysql_num_rows($Recordset1);
			$tVal2[$idMd][$idSite] = $live;
			$live = 0;
			$Recordset1 = 0;
		}
	}
	
?>
	<font size="3">시뮬레이션(치료실별)</font>
<?php
	
	echo "<table class = type03 cellpadding = 0px width=960px border=0 align=center cellspacing=0>";
	echo "<tr><td>담당의</td><td>Versa</td><td>IX</td><td>Infinity</td></tr>";
	for($idMd = 0; $idMd<3; $idMd++){ 
		echo "<tr>";
		$pps = $mds[$idMd];
		echo "<td>$pps</td>";
		for($idSite = 0; $idSite<3;$idSite++){ 	
			$fVal = $tVal2[$idMd][$idSite];
			echo "<td>$fVal</td>";
		}
		echo "</tr>";
	}
	echo "</table>";






/*
// 	Per site
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CNS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCNS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%THX%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveTHX = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BRST%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBRST = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GI%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGI = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GU%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGU = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%GY%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveGY = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%MS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveMS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%SKIN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveSKIN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%HMT%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveHMT = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%PD%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$livePD = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%BENIGN%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveBENIGN = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%CUPS%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveCUPS = mysql_num_rows($Recordset1);

	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.primarysite LIKE '%OTHER%'" ;	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$liveOTHER = mysql_num_rows($Recordset1);
*/



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

