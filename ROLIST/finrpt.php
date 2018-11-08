<!doctype html>
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
include("configuration.php");

$permitUser = $_SESSION['MM_UserGroup'];

include("idc.php");

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
    $week_post = $_POST['weekago'];

	$searchQ = $_POST['txt_search'];
// 	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
				$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}
// 	echo($uid);
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
	.photo3 {
    width: 25px; height: 25px;
    object-fit: cover;
    border-radius: 50%;
}	
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
</style>





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

$conn = mysql_connect("localhost", "root", "dbsgksqls") or die(mysql_error());
mysql_select_db("test", $conn);
// mysql_select_db($database_test, $test);
mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");
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

$StatF = $_POST['StatF'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatF); $idstat++){
	$hId = substr($StatF[$idstat],0,9);
	$sId = substr($StatF[$idstat],9,2);
	
	
 	$sqlQuery = mysql_query("update TreatmentInfo set $sId = '1' where Hospital_ID like '$hId'");		
}
$StatF2 = $_POST['StatF2'];
print_r($StatF2);
// Status change!!!!
for($idstat = 0; $idstat<count($StatF2); $idstat++){
	$hId = substr($StatF2[$idstat],0,9);
	$sId = substr($StatF2[$idstat],9,2);
	$fmQuery = "update TreatmentInfo set $sId = '1' where Hospital_ID like '$hId'";
 	$sqlQuery = mysql_query($fmQuery);		
 	
}




$seven          = 0 + $week_post;
$a_week_ago     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_ago_mon = $modify_day = date("Y-m-d", strtotime($a_week_ago . "+1day"));
// $a_week_after   = $a_week_ago;
$a_week_after     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));


$md = $_POST['mdname'];	

for($nums = 0; $nums<$numphyss;$nums++){ 

	if(strcmp($md, $phyIdd[$nums])==0){
		$titleMd = $phyInt[$nums];
		$md = $phyIdd[$nums];
		$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";
	}
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




?>

<?php
	include("mainmenu.php");
?>







</td>
</tr>
</table>









<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0"><th align=left>          <br>
	<br> 
	<font style="font-family:arial; font-size:18px" align="left">종결지 작성 리스트 - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font>
	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
	RTP실에서 종결지의 템플릿을 작성후 R체크박스 선택, 완료후 M체크박스까지 선택되면 리스트에서 사라집니다. 
</font>
<br>

		 
		 
		 
		 
</th>
</table>
<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<form></form>





<form id=form11 name=form11 method=post action="finrpt.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

<!--
<form id=form11 name=form11 method=post action="daily_report.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="KI" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="JaL" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="daily_report.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="JuL" ></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
-->



	<!-- PHYSICIAN SELECTOR GENERATION -->
	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){ 	?>

	<form id=form11 name=form11 method=post action="finrpt.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit'  value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; background-color: <?php echo $phyCol[$idphys];?>;"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "mdname" id = "permit" value = <?php echo  $phyIdd[$idphys]; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "finrpt.php" />				
			
		</th>
	</form>

	<?php }	?>





</p>

		
</table>
		
		
		
		
		
		
		
		
		
<?php
	
	
	
?>		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
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
<div class="float-button">

	        <input class="btn button-update" type="submit" name="statchk" id="Plans" style="font-size: 20px; font-weight: 200" value = "✔" />
		    <input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname" id = "permit" value = <?php echo $md; ?> />
</div>					
		   
<!-- 		<input type = "hidden" name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
        <tr class="border_bottom">
			<td bgcolor="#777777" width="40px" ><font color="white"></font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">R</font></td>
			<td bgcolor="#777777"><font color="white">M</font></td>                                         	  
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777" width="45px"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Pathology</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			
			<td width="200px" bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
            <td bgcolor="#777777" width="50px"><font color="white">Fin</font></td>			
            <td bgcolor="#777777" width="50px"><font color="white">Start</font></td>			
			<td bgcolor="#777777"><font color="white">Tc.</font></td>
			<td bgcolor="#777777"><font color="white">LA</font></td>
			<td bgcolor="#777777"><font color="white">Ph</font></td>
		</tr>

<?php
$a_week_ago_todo     = date('Y-m-d', strtotime('1/1/18' . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($today_date . "+" . $seven . 'days'));


// Main query!!
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD 
((((STR_TO_DATE(TreatmentInfo. RT_fin_f, '%m/%d/%Y') BETWEEN '$a_week_ago_todo' AND '$a_week_after_todo') and (TreatmentInfo.FP LIKE '0' or TreatmentInfo.FP is null or TreatmentInfo.FM LIKE '0' or TreatmentInfo.FM is null)))) AND 
 ((PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) or (PatientInfo.CurrentStatus like '0')) ";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
//  echo($query_Recordset1);
// echo($query_Recordset1);
// echo($query_Recordset1);

$query_Recordset1 .= " ORDER BY STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') DESC";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);


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
    
    if(strcmp($row_Recordset1[FP],'1')!=0 or strcmp($row_Recordset1[FM],'1')!=0){ 
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

// 	if($pid[$tCount]<=$idx){
    $idcolor++;
    $totalDays++;



	
                
    $yoil = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
    

    $lenDate = strlen($row_Recordset1[$RT_start_curr]);
    $cropDate = substr($row_Recordset1[$RT_start_curr],0,$lenDate-3);    
    $lenDate = strlen($row_Recordset1[$CT_sim_curr]);   
    $cropDateCT = substr($row_Recordset1[$CT_sim_curr],0,$lenDate-3);
	$lenDate = strlen($row_Recordset1[$RT_start_curr]);

    $lenDate = strlen($row_Recordset1[RT_fin_f]);
	
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);   
    $lenDate = strlen($row_Recordset1[RT_start1]);
     
    $cropDateS1 = substr($row_Recordset1[RT_start1],0,$lenDate-3);    

	if($pid[$tCount]==$idx){
		$bgcolorF = "#f7aac3"; 
		$stInd = "FP";
	}
	if($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_next] == NULL){
		$bgcolorF = "#f7e4fb"; 
		$stInd = "FM";			
	}
	
	
	
	if(strlen($row_Recordset1[$CT_sim_curr]) >5){
		$bgcolorF = "#ffffff"; /* aqua 10 (ibm design colors) */
	}
	
    elseif($pid[$tCount]==1){
		$bgcolorF = "#ffffff"; /* magenta 10 (ibm design colors) */
	}
	else{
		$bgcolorF = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}
    if($pid[$tCount]==1){
		$bgcolorF = "#ffffff"; /* magenta 10 (ibm design colors) */
	}
	
	if (strtotime($row_Recordset1[$CT_sim_curr]) == strtotime($today)) {
	        $simColor = "#e62325"; /* red 50 (ibm design colors) */
	        $strVal = "<strong>";
	        $strValR = "</strong>";	        
	}
    if (strtotime($row_Recordset1[$CT_sim_curr]) > strtotime($today)) {
	        $simColor = "#1f57a4"; /* blue 60 (ibm design colors) */
	        $strVal = "<strong>";
	        $strValR = "</strong>";	     
	        $fontColorF = "#999999";	
	        $bgcolorF = "#EEEEEE";        
	}
    if (strtotime($row_Recordset1[$CT_sim_curr]) < strtotime($today)) {
	        $simColor = "#424747"; /* cool-gray 70 (ibm design colors) */
	        $strVal = "";
	        $strValR = "";	        	        
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
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$row_Recordset1[$CT_sim_curr]</font>  </td>";         /* #CC6699 (web safe colors) */

    
//  CCRT or not
    if ($row_Recordset1[Modality_var1] == NULL){
        echo "<td width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td width = '15px' bgcolor=#f45942 align='center'> <font color=$fontColorF>C</font> </td>";
	}

//  Check box status 
	$statVal = $row_Recordset1[Hospital_ID];
	$statValFP = $statVal. "FP";
	$statValFP = $statValFP. $pid[$tCount];
	$tChecked = "FP";

	$statValFM = $statVal. "FM";
	$statValFM = $statValFM. $pid[$tCount];		
	$pChecked = "FM";

	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $tChecked from TreatmentInfo where Hospital_ID like '$statVal'"));	
	if($sqlQuery[$tChecked]==1){ $chkCurFP = "	checked='checked'";}
	else{ $chkCurFP = "";}
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $pChecked from TreatmentInfo where Hospital_ID like '$statVal'"));	
	if($sqlQuery[$pChecked]==1){ $chkCurFM = "	checked='checked'";}
	else{ $chkCurFM = "";}
	?>
	
	
	
<!-- Checkbox for status -->
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  	// TARGET STATUS WB Updated ?>

		<input  type="checkbox" name="StatF[]" value=<?php echo($statValFP);  echo($chkCurFP);?> >	
	</td>			
	
	<?php echo "<td bgcolor=$bgcolorF width = '5px'>";  ?>
		<input type='checkbox' name='StatF2[]' value=<?php echo($statValFM);   echo($chkCurFM);?> >	
	</td>
	



	<?php
    echo "<td bgcolor=$bgcolorF width = '40px' align='center'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font></strong></td>"; 
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
    echo " <td bgcolor=$bgcolorF width = '100px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  

    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '100px'>  <font color=$fontColorF>$patholcrop</font>  </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    <font color=$fontColorF>$cropTnm</font></td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='180' align='left'><div class='memo'><font color=$fontColorF>"; 

    for($planIdx=1;$planIdx<$idx+1;$planIdx++){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=(substr($row_Recordset1[$SiteX],0,$cropN));
		if(strlen($SiteX)==0){
			$SiteX = "N/A";
		}
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
				
		if($planIdx==$pid[$tCount]){
			echo "<font  face=arial>$planIdx.$SiteX:</font><font color=red face=arial>$row_Recordset1[$doseX]($row_Recordset1[$fxX])&nbsp;</font>";
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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = #252e6a> <strong>$strVal $cropDateFin</strong></font>$strValR</td>"; /* ultramarine 80 (ibm design colors) */

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateS1</td>";
    
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


		$sql_Memo = mysql_query("select Memo1 from OrderTemp where Hospital_ID like '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysql_query("select Date1 from OrderTemp where Hospital_ID like '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysql_num_rows($sql_Date);
?>

</tr>


<?php

}
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}

?>







<!-- Apply status changes -->






<?php
	
$stat = $_REQUEST['statF'];	
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
/*
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
*/

?>



</html>

