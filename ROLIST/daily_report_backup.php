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



<?php 
	include("configuration.php");
?>
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
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
 	require_once('Connections/test.php'); 
		

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

?>
<html lang="ko">


<head>
<link rel="stylesheet" href="mainStyle.css">
 










<title>Radiation Oncology List</title>
</head>

<?php 
	include("configuration.php");

?>




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

// mysql_select_db($database_test, $test);
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

$siteInput = $_POST['sitename'];	

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























































































<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="700px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List (Daily) - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	

	<br>
<font style="font-family:arial; color: red; font-size:10px" align="left">
<!--
	(업데이트 노트-21 Feb 2018): 입월/외래정보가 EMR에서 추출되어 표시 됩니다. <br>
	(업데이트 노트-21 Feb 2018): 개인 아이디를 발급해 드립니다. 아이디와 비번을 저에게 알려주세요!(개인 회원가입 페이지는....죄송합니다) &nbsp;<a href="hist.php" target="_blank">more...</a>
-->
</font>


<br>
		 
		 
		 
		 
</th>
<th valign="top" align="right">
	<font color=gray>Logged by <?php echo $uid;?></font>
</th>


</tr>

</table>




<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<form name = "form110" id = "form110" method = "post" action ="daily_report_backup.php">
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
<form name = "form111" id = "form112" method = "post" action ="daily_report_backup.php">
	<th align=left width="50px"><input type = hidden name = "weekago"	id ="weekago" value = 0 />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="daily_report_backup.php">
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


		
</table>
		


		
<br>
<!-- Submit button for status  -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >
	<table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">  
        <th align=left >
	        <font style="font-size:12px">Plans (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>

	        <input type="submit" name="statchk" id="Plans" value = "Change-status" />
		    <input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
					
		   
<!-- 		<input type = "hidden" name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
        <th>
	        		
		
					

        </th>		
    </table>
       
       
<div id="printablediv">
	        <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Time</font></td>
			<td bgcolor="#777777" ><font color="white">Chart ID</font></td>
<!-- 			<th bgcolor="#777777">Ind</th> -->
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>
			<td bgcolor="#777777"><font color="white">P</font></td>
			<td bgcolor="#777777"><font color="white">A</font></td>                                         	  

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
<!-- 			<td bgcolor="#777777"><font color="white">Px</font></td> -->
<!-- 			<th bgcolor="#777777">Diag.</th>						 -->
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			

			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>

<!-- 			<th bgcolor="#777777">D/F</th> -->
<!-- 			<th bgcolor="#777777">F</th> -->
<!--
			<th bgcolor="#777777">D(Σ)</th>
			<th bgcolor="#777777">F(Σ)</th>
-->
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
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

$SavingId = 0;

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
$Recordset1 = mysqli_query($test,$query_Recordset1);
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


$rsetTemp = mysqli_query($test,$query_Recordset1);
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



$Recordset1 = mysqli_query($test,$query_Recordset1);
// echo $query_Recordset1;

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];

for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test,"select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test,"select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 완료.";
		$post_url = "";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
		
	}
	echo("");
 	$sqlQuery = mysqli_query($test,"update TreatmentInfo set $sId = 1 where Hospital_ID = '$hId'");		
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
	$time = mysqli_fetch_assoc(mysqli_query($test,$querytime)); 

    echo "<td bgcolor=$bgcolorF width = '30px'>  <strong><font>$time[time1]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

   
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
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $tChecked from TreatmentInfo where Hospital_ID ='$statVal'"));	
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
  
  
	$curPlan[$SavingId] =  $pid[$tCount];
	$curID[$SavingId] =  $row_Recordset1[Hospital_ID];	
  
        
/*
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=rpt.php>";                                  
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";    
                
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
*/
    $patholcrop = substr($row_Recordset1[pathol],0,100);      

    echo " <td bgcolor=$bgcolorF width = '100px'>   <strong>$row_Recordset1[subsite]</strong> <br>$patholcrop</td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
//     echo " <td bgcolor=$bgcolorF width = '80px'>    $row_Recordset1[tnm]</td> ";
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm</td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

	
	
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

	

		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$temp = mysqli_fetch_assoc($sql_Memo);
	 		$memo = $temp[Memo1];
	 		$temp = mysqli_fetch_assoc($sql_Memo);
	 		$Date = $temp[Memo1];
	 		

	if($row_Memoinfo>0){ 
?>

    <div class="memo"><?php echo $Memo ?></div>

<?php
	}

//  Report edit button generation
    echo "<form id=form111 name=form111></form>";
    if ($permitUser == 1 || $permitUser == 1) {
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=rpt.php>";                                  
    echo "<input type=submit name=btn_edit id=btn_edit value=Tag>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";    
                
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=devtag.php>";                                  
    echo "<input type=submit name=btn_edit id=btn_edit value=DevTag>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=nowa type=hidden id=nowa  value=$curI>";
    echo "<input name=toda type=hidden id=toda  value=$a_week_after>";    
                
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";
              
    }
    if ($permitUser == 2) {
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=rpt.php>";                                  
    echo "<input type=submit name=btn_edit id=btn_edit value=Tag>";
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

</table>
</div>
</form>


	<table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">  
<tr>
	<td align=right>
    <input type="button"  style="height:30px;width:100px" value="Send to PRINT" onclick="javascript:printDiv('printablediv')" />
	</td>
</tr>
	</table>





<?php
	
// 	print_r($curID);
// 	print_r($curPlan);		
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


<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->
<!-- TODAY SIMULATION -->

		
<br>
<!-- Submit button for status  -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >
	<table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">  
        <th align=left >
	        <font style="font-size:12px">Simulations (</font> 
	        <span style="background-color:#f5cedb"> New </span> & 
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>

	        <input type="submit" name="statchk" id="Plans" value = "Change-status" />
		    <input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
					
		   
<!-- 		<input type = "hidden" name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
        <th>
	        		
		
					

        </th>		
    </table>
       
        <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white">Chart ID</font></td>
<!-- 			<th bgcolor="#777777">Ind</th> -->
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">S</font></td>
			<td bgcolor="#777777"><font color="white">N</font></td>
			<td bgcolor="#777777"><font color="white">T</font></td>                                         	  

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
<!-- 			<th bgcolor="#777777">Diag.</th>						 -->
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			

			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription</font></td>

<!-- 			<th bgcolor="#777777">D/F</th> -->
<!-- 			<th bgcolor="#777777">F</th> -->
<!--
			<th bgcolor="#777777">D(Σ)</th>
			<th bgcolor="#777777">F(Σ)</th>
-->
            <td bgcolor="#777777"><font color="white">Sim</font></td>			
            <td bgcolor="#777777"><font color="white">Start</font></td>			
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

/*
echo $_POST['username'];
echo $_POST['username'];
*/

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
$sortCat1 = 'CT_sim1';
$sortCat2 = 'CT_sim2';
$sortCat3 = 'CT_sim3';
$sortCat4 = 'CT_sim4';
$sortCat5 = 'CT_sim5';
$sortCat6 = 'CT_sim6';
$sortCat7 = 'CT_sim7';
    
$query_Recordset1 = "SELECT * FROM PatientInfo  join TreatmentInfo on  PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD ((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 								(STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											(STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											(STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') ) AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
$Recordset1 = mysqli_query($test,$query_Recordset1);
$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);


// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));


$rsetTemp = mysqli_query($test,$query_Recordset1);

for ($iddd = 0; $iddd <= $totalRows_Recordset1 - 1; $iddd = $iddd + 1) {
    $rowOrders = mysqli_fetch_assoc($rsetTemp);
    $s1        = date("Y-m-d", strtotime($rowOrders["CT_Sim1"]));
    $s2        = date("Y-m-d", strtotime($rowOrders["CT_Sim2"]));
    $s3        = date("Y-m-d", strtotime($rowOrders["CT_Sim3"]));
    $s4        = date("Y-m-d", strtotime($rowOrders["CT_Sim4"]));
    $s5        = date("Y-m-d", strtotime($rowOrders["CT_Sim5"]));
    $s6        = date("Y-m-d", strtotime($rowOrders["CT_Sim6"]));
    $s7        = date("Y-m-d", strtotime($rowOrders["CT_Sim7"]));
    $ss        = date('Y-m-d', strtotime($a_week_ago . '+' . '0' . ' days'));
    $se        = date('Y-m-d', strtotime($a_week_after . '+' . '0' . ' days'));
    
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


$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

$Recordset1 = mysqli_query($test,$query_Recordset1);
// echo $query_Recordset1;

$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


$StatT = $_POST['StatT'];

for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test,"select $sId from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test,"select physician from TreatmentInfo where Hospital_ID = '$hId'"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test,"select Firstname, Secondname from PatientInfo where Hospital_ID = '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 완료.";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
// 		print_r($sqlQueryPhys);
		// 보낼 텍스트를 구성. 줄바꿈은 "\n"으로.
		// http_build_query()를 이용하면 url 인코딩을 알아서 처리해 줌.
	}
	echo("");
 	$sqlQuery = mysqli_query($test,"update TreatmentInfo set $sId = 1 where Hospital_ID = '$hId'");		
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

/*
	 echo($row_Recordset1[Hospital_ID]);
	 echo("&nbsp");
	 echo($idx);
	 echo("&nbsp");
	 echo($pid[$tCount]);
	 
    echo("<br>");
*/

	if($pid[$tCount]<=$idx or $pid[$tCount]>=$idx){
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
	
	
    if($pid[$tCount]==1){
		$bgcolorF = "#f5cedb"; /* magenta 10 (ibm design colors) */
	}
	elseif($pid[$tCount]!=$idx and $row_Recordset1[$CT_sim_curr] != NULL){
		$bgcolorF = "#a0e3f0"; /* aqua 10 (ibm design colors) */
	}
	else{
		$bgcolorF = "#ffffff"; /* cerulean 20 (ibm design colors) */
	}


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
	$statValT = $statVal. "E";
	$statValT = $statValT. $pid[$tCount];
	$tChecked = "E". $pid[$tCount];

	$statValP = $statVal. "N";
	$statValP = $statValP. $pid[$tCount];		
	$pChecked = "N". $pid[$tCount];

	$statValA = $statVal. "T";
	$statValA = $statValA. $pid[$tCount];
	$aChecked = "T". $pid[$tCount];
	
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
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    


/*
	echo "<td bgcolor=$bgcolorF width = '40px' align='center'><form id=form4 name=form4 method=post target=_blank action=N_report_all.php>";
    echo "<input type=submit name=btn_report id=btn_report  value=$row_Recordset1[KorName]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
    echo "<input name=hr_field type=hidden id=hr_field value= $row_Recordset1[Hospital_ID] /></form></td>";
*/
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    
    
    
    
    
    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    
//     echo "<td bgcolor=$bgcolorF width = '40px' align='left'>    $row_Recordset1[Sex] /  $row_Recordset1[Age] </td>";
    echo " <td bgcolor=$bgcolorF width = '100px'>   <strong>$row_Recordset1[subsite]</strong><br>$patholcrop </td> ";  
    echo " <td bgcolor=$bgcolorF width = '100px'>    </td> ";       
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
//     echo " <td bgcolor=$bgcolorF width = '80px'>    $row_Recordset1[tnm]</td> ";
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm</td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

	
	
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
    




/*
	$cropN = 8;
	echo "<td bgcolor=$bgcolorF width='70' align='right'><div class='memo'>";

    for($planIdx=1;$planIdx<$idx+1;$planIdx+=2){
		    
		$SiteX       = "Site" . "$planIdx";
		$SiteX=substr($row_Recordset1[$SiteX]. "      ",0,$cropN);
		if($planIdx==$pid[$tCount]){
			echo "<font color=red face=arial>$SiteX:&nbsp</font>";
		}
		else{
			echo "<font color=gray face=arial>$SiteX:&nbsp</font>";
			
		}
		echo "<br>";
    }
    echo "</div></td>";
    
	echo "<td bgcolor=$bgcolorF width='25' align='left'><div class='memo'>";
    
    for($planIdx=1;$planIdx<$idx+1;$planIdx+=2){
		    
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
		if($planIdx==$pid[$tCount]){
		echo "<font color=red face=arial>$row_Recordset1[$doseX]/$row_Recordset1[$fxX]</font>";
		}
		else{
		echo "<font color=gray face=arial>$row_Recordset1[$doseX]/$row_Recordset1[$fxX]</font>";
			
		}
		echo "<br>";
    }
    echo "</div></td>";
    
	echo "<td bgcolor=$bgcolorF width='70' align='right'><div class='memo'>";

    for($planIdx=2;$planIdx<$idx+1;$planIdx+=2){
		$SiteX       = "Site" . "$planIdx";
		$SiteX=substr($row_Recordset1[$SiteX]. "      ",0,$cropN);
		
		if($planIdx==$pid[$tCount]){
		echo "<font color=red face=arial>$SiteX:&nbsp</font>";
		}
		else{
		echo "<font color=gray face=arial>$SiteX:&nbsp</font>";
			
		}
		echo "<br>";
    }
    if($idx%2==1){
	    echo "<font color=$bgcolorF> 1</font>";
		echo "<br>";
	    
    }
    
    echo "</div></td>";
    
	echo "<td bgcolor=$bgcolorF width='25' align='left'><div class='memo'>";
    
    for($planIdx=2;$planIdx<$idx+1;$planIdx+=2){
		    
		$doseX     = "dose" . "$planIdx";
		$fxX       = "Fx" . "$planIdx";
		if($planIdx==$pid[$tCount]){
			echo "<font color=red face=arial>  $row_Recordset1[$doseX]/$row_Recordset1[$fxX]   </font>";
		}
		else{
			echo "<font color=gray face=arial>  $row_Recordset1[$doseX]/$row_Recordset1[$fxX]   </font>";
			
		}
		echo "<br>";	    
    }
    
    if($idx%2==1){
	    echo "<font color=$bgcolorF> 1</font>";
		echo "<br>";
	    
    }
    echo "</div></td>";
*/

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

// 	if($idcolor==1){
		$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";
/*
    }
    else{
	        echo "<td rowspan = 1 width = '20px' align='center' rowspan = $totalRows_Recordset1 bgcolor=$BColor>  </td>";

    }
*/
    
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


		$sql_Memo = mysqli_query($test,"select Memo1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$sql_Date = mysqli_query($test,"select Date1 from OrderTemp where Hospital_ID = '$row_Recordset1[Hospital_ID]'");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
	 		$temp = mysqli_fetch_assoc($sql_Memo);
	 		$memo = $temp[Memo1];
			$temp = mysqli_fetch_assoc($sql_Memo);
	 		$Date = $temp[Memo1];
	if($row_Memoinfo>0){ 
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
    echo "<input name=username type=hidden id=username  value=$uid/>";            
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
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
     echo "<input name=username type=hidden id=username  value=$uid/>";            
     echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
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
</form>




















		
<br>







<link rel="stylesheet" href="bootsample.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<link rel="stylesheet" href="js/jquery-ui.css"/>


<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery-ui.min.js"></script>




<script type="text/javascript"> <!--
var initBody;
function beforePrint() {
boxes = document.body.innerHTML; document.body.innerHTML = box.innerHTML;
}
function afterPrint() {
document.body.innerHTML = boxes; }
function printArea() { window.print();
}
window.onbeforeprint = beforePrint; window.onafterprint = afterPrint; -->
</script>





</body>
</html>
<?php
?>



</html>
