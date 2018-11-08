<!doctype html>

<!-- READ PHYSICIANS FROM CFG FILE -->
<?php 
	include("configuration.php");
?>





<meta charset="utf-8">

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

			$md = $md2;		

	for($idphyss=0;$idphyss<$numphyss;$idphyss++){
		if(strcmp($md2,$phyInt[$idphyss])==0){
			$md=$phyIdd[$idphyss];
		}
	}

	if(strcmp($md2,"Total")==0){
		$md = "";		
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

<style>
.photo3 {
    width: 25px; height: 25px;
    object-fit: cover;
    border-radius: 50%;
}	
.scale {
  transform: scale(1);
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transition: all 0.3s ease-in-out;   /* 부드러운 모션을 위해 추가*/
}
.scale:hover {
  transform: scale(3.5);
  transform:translate(35px,0);

  -webkit-transform: scale(3.5);
  -moz-transform: scale(3.5);
  -ms-transform: scale(3.5);
  -o-transform: scale(3.5);

}
.img {width:325px; height:280px; overflow:hidden } 	
</style>



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






	$queryMD = " ";

for($phyidss=0;$phyidss<$numphyss;$phyidss++){
	if(strcmp($md,$phyIdd[$phyidss])==0){
		$md = $phyIdd[$phyidss];
		$titleMd = $phyInt[$phyidss];
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
mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");



?>
<?php
	include("mainmenu.php");
?>











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


<?php
	for ($dts = 0; $dts < 30; $dts++){ 

	$seven          = $idDays + $week_post;
	$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
	$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
	// echo($a_week_ago_todo);
	$weekDays= strftime("%w", strtotime($a_week_ago_todo));
	if($weekDays!=6 and $weekDays!=0){
		$workDay = $workDay+1;
		
	}


	$tdate     = date('Y-m-d', strtotime($date . "+" . $datesa . 'days'));
	$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo join MeetingList on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID and PatientInfo.Hospital_ID = MeetingList.Hospital_ID where $queryMD $querySite STR_TO_DATE(MeetingList.Date, '%m/%d/%Y') like '$a_week_after_todo'" ;	
	
	
	if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
	    $order = 'DESC';
	}
	
	
	$query_Recordset1 .= " ORDER BY MeetingList.Time1 ASC";
	
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	
	// echo($query_Recordset1);
	
	
	$row_Recordset1       = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	if($totalRows_Recordset1<1){ 
		
		
		$week_post = $week_post+1;
		}
		else{break;}
	}	
	
?>
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="700px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List (Exam)- <?php echo $titleMd; ?> (<?php echo $a_week_after_todo; ?>) </font> 	

	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
<!--
	(업데이트 노트-21 Feb 2018): 입월/외래정보가 EMR에서 추출되어 표시 됩니다. <br>
	(업데이트 노트-21 Feb 2018): 개인 아이디를 발급해 드립니다. 아이디와 비번을 저에게 알려주세요!(개인 회원가입 페이지는....죄송합니다) &nbsp;<a href="hist.php" target="_blank">more...</a>
-->
</font>


<br>
<font style="font-family:arial; color: gray; font-size:10px" align="left">
</font>
		 
		 
		 
		 
</th>
<th valign="top" align="right">
	<font color=gray>Logged by <?php echo $uid;?></font>
</th>


</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<!--
<form name = "form110" id = "form110" method = "post" action ="meetingmd.php">
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
-->
<form name = "form111" id = "form112" method = "post" action ="meetingmd.php">
	<th align=left width="50px"><input type = hidden name = "weekago"	id ="weekago" value = 0 />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="meetingmd.php">
	<th align=left width="50px"><input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
		
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>





<form id=form11 name=form11 method=post action="meetingmd.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total"  style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>



<?php for($idphys = 0; $idphys<$numphyss; $idphys++){ 	?>

<form id=form11 name=form11 method=post action="meetingmd.php">
	<th valign="middle" align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
		
	</th>
</form>

<?php }	?>










</p>


		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    
	    


<?php 
	for ($datesa = 0; $datesa < 1; $datesa++){ 
/*
	$tdate = date("Y-m-d", strtotime("+.$dates day", strtotime($today_date))); 
// $a_week_after   = $a_week_ago;
*/

?>
<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px"><?php echo($a_week_after_todo)?> (Total: <?php echo($totalRows_Recordset1); ?></font> 
	        <font style="font-size:12px"><span style="background-color:#d2b5f0"> Initial </span><span style="background-color:#d7f4bd"> Follow up </span><font style="font-size:12px">) </font> 

        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Time</font></td>
			<td bgcolor="#777777" ><font color="white"></font></td>
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

$us = 0;
$mor = 0;
$aft = 0;
$call = 0;

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
    
    
    // 오전 오후 등 카테고리를 위해 sorting
//     if(substr(strcmp($row_Recordset1[Time1]))
	$tms = substr($row_Recordset1[Time1],0,2);
	if((int)$tms<12 and (int)$tms>0 and $mor==0){
		
    echo "<tr class='border_bottom' ><td bgcolor=#e3ecec colspan=100><font color=#3c6df0><strong>Morning</strong></font></td></tr>"; /* cool-gray 1 (ibm design colors) */
		$mor = 1;

	}
	$tms = substr($row_Recordset1[Time1],0,2);
	if((int)$tms>=12 and  $aft==0){
    echo "<tr class='border_bottom' ><td bgcolor=#e3ecec  colspan=100><font color=#3c6df0><strong>Afternoon</strong></font></td></tr>"; /* ultramarine 50 (ibm design colors) */
		$aft = 1;

	}
	$tms = substr($row_Recordset1[Time1],0,2);
	if((int)$tms==0 and  (strcmp($row_Recordset1[Time1],"call")==0 or strcmp($row_Recordset1[Time1],"Call")==0) and  $call==0){
    echo "<tr class='border_bottom' ><td bgcolor=#e3ecec  colspan=100><font color=#3c6df0><strong>Call</strong></font></td></tr>"; /* ultramarine 50 (ibm design colors) */
		$call = 1;

	}
    
	$tms = substr($row_Recordset1[Time1],0,2);
	if((int)$tms==0 and  strcmp($row_Recordset1[Time1],"call")!=0 and strcmp($row_Recordset1[Time1],"Call")!=0 and  $us==0){
    echo "<tr class='border_bottom' ><td bgcolor=#e3ecec  colspan=100><font color=#3c6df0><strong>Unscheduled</strong></font></td></tr>"; /* ultramarine 50 (ibm design colors) */
		$us = 1;
	}
    
    
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#FFFFFF";
    }

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
			$bgcolorH = "#FFFFFF";

    if (strtotime($row_Recordset1[RT_fin_f])<strtotime($today_date)) {
	        $bgcolorH = "#d7f4bd"; /* lime 1 (ibm design colors) */
	}
	if (strcmp(mb_substr($row_Recordset1[Memo],0,2, 'utf-8'),"초진")==0) {
	        $bgcolorH = "#d2b5f0"; /* violet 20 (ibm design colors) */
	}


	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
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
	
	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><div  class='scale'> <img class='photo3' src='$photoPath'></div></td>";	
    echo "<td bgcolor=$bgcolorH width = '30px'>  <strong>$row_Recordset1[Time1]</strong>  </td>";         /* #CC6699 (web safe colors) */



		
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><strong><font color=$fontColorInp>$row_Recordset1[InP]</font></strong>  </td>";         /* #CC6699 (web safe colors) */

//  CCRT or not
    if (strlen(trim($row_Recordset1[Modality_var1])) == 0){
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
    echo "<td align='center' bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br>"; 
   
    echo "<form id=form111 name=form111></form>";
    echo "<form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";   

    echo " <td bgcolor=$bgcolorF  width = '60px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    echo " <td bgcolor=$bgcolorF width = '100px'>  $patholcrop  </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm</td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";
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
}


?>






</table>












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

