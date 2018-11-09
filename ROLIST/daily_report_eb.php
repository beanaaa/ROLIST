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
// print_r($StatT);
$Actss = $_POST['Act'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $sId from TreatmentInfo where Hospital_ID like '$hId'"));	
	$sqlQueryPhys = mysql_fetch_assoc(mysql_query("select physician from TreatmentInfo where Hospital_ID like '$hId'"));	
	$sqlQueryName = mysql_fetch_assoc(mysql_query("select Firstname, Secondname from PatientInfo where Hospital_ID like '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
 	$sqlQuery = mysql_query("update TreatmentInfo set $sId = 1 where Hospital_ID like '$hId'");		
}	
// Status change!!!!
for($idstat = 0; $idstat<count($Actss); $idstat++){
	$hId = substr($Actss[$idstat],0,9);

	
	
	$sqlQuery = mysql_fetch_assoc(mysql_query("select $sId from TreatmentInfo where Hospital_ID like '$hId'"));	
	$sqlQueryPhys = mysql_fetch_assoc(mysql_query("select physician from TreatmentInfo where Hospital_ID like '$hId'"));	
	$sqlQueryName = mysql_fetch_assoc(mysql_query("select Firstname, Secondname from PatientInfo where Hospital_ID like '$hId'"));	
	if($sqlQuery[$sId]==0){ 

		$post_title = "$sId 의 상태가 완료됨으로 체크 되었습니다(by $uid)";
		$post_url = "http://54.160.213.4/messageIndex.php";

// 		$post_url = "";

		$api_code = '460837379:AAEMQO7cETGDbz7sF9ACdDwWjJMhgAyEwpk';
	}
 	$sqlQuery = mysql_query("update TreatmentInfo set TrcNotice = 0 where Hospital_ID like '$hId'");		
}	
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

	<font style="font-family:arial; font-size:18px" align="left">Radiation Oncology List for RTP<?php echo $dash; ?> <?php echo $titleMd.$pl2; ?>  </font> 	











		 
</th>
		 
		 



<form id=form11 name=form11 method=post action="daily_report_rtp.php">
	<th valign="middle" align=right>
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total"   style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>



	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){ 	?>

	<form id=form11 name=form11 method=post action="daily_report_eb.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
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
		<input  type=submit name=btn_home id=btn_home value=Asgnr   style="width: 100px; height: 20px">
		<input  name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input  type = hidden name = username id = username value = <?php echo $uid; ?> />				
			
	</form>
</th>




<form id=form11 name=form11 method=post action="daily_report_eb.php">
	<th valign="middle" align=right>
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="plname" value="Total"   style="width: 50px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

	<?php for($idphys = 0; $idphys<$numplnss; $idphys++){ 	?>

	<form id=form11 name=form11 method=post action="daily_report_eb.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input type='hidden' name="mdname" value=<?php echo $md2; ?>  style="width: 50px; height: 20px"></input>		
			<input type='submit' name="plname" value=<?php echo $plnInt[$idphys]; ?>  style="width: 50px; height: 20px"></input>		

			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
			
		</th>
	</form>

	<?php }	?>



</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">


		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="daily_report_eb.php" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    
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


    
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
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
	if((strcmp(substr(trim($row_Recordset1["RT_method2"]),0,1),"E")!=0) and (strcmp(substr(trim($row_Recordset1["RT_method2"]),0,1),"3")!=0)){
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
    echo " <td bgcolor=$bgcolorF width = '150px'>  <font color=$fontColorF>$patholcrop</font>  <br> ";       
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




</form>







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

