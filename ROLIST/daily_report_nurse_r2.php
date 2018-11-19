<!doctype html>
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
?>



<?php 
	include("configuration.php");
?>

<link rel="stylesheet" href="normalize.css">
<?php 	
  date_default_timezone_set("Asia/Seoul");
	
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
	mysqli_query($test, "set session character_set_connection=latin1;");
	mysqli_query($test, "set session character_set_results=latin1;");
	mysqli_query($test, "set session character_set_client=latin1;");

	 ?>

<?php

$timeIndex = ($_POST['TimeChecker']);
$timeId = ($_POST['hidTime']);
$timeOrder = ($_POST['currs']);

for($idtimes=0;$idtimes<count($timeOrder);$idtimes++){
	$timeQuery = "Update TreatmentInfo Set CT_TIme".$timeOrder[$idtimes]."=".$timeIndex[$idtimes]." where Hospital_ID like '".$timeId[$idtimes]."'";
	mysqli_query($test, $timeQuery);
}




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
<meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
<!--
# 위의 명시된 날짜 이후가 되면 페이지가 캐싱되지 않습니다.
(따라서 위와 같은 날짜로 지정할 경우 페이지는 지속적으로 캐싱되지 않습니다.)
-->
<meta http-equiv="Expires" content="-1">
<!-- # 캐시된 페이지가 만료되어 삭제되는 시간을 정의합니다. 특별한 경우가 아니면 -1로 설정합니다. -->
<meta http-equiv="Pragma" content="no-cache">
<!-- # 페이지 로드시마다 페이지를 캐싱하지 않습니다. (HTTP 1.0) -->
<meta http-equiv="Cache-Control" content="no-cache">
<!-- # 페이지 로드시마다 페이지를 캐싱하지 않습니다. (HTTP 1.1) --> 

<title>Radiation Oncology List</title>

<style>
input[type=submit].selector {
	padding: 3px 4px;
    border: none; /* Green */	

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	

	
.photo3 {
    width: 30px; height: 30px;
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
  -webkit-transform: scale(3.5);
  -moz-transform: scale(3.5);
  -ms-transform: scale(3.5);
  -o-transform: scale(3.5);
}
.img {width:325px; height:280px; overflow:hidden } 
</style>

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

	$md = $_POST['mdname'];	


	$queryMD = " ";
$titleMd = "";
$queryMD = " ";
for($nums = 0; $nums<$numphyss;$nums++){ 

	if(strcmp($md, $phyInt[$nums])==0){
		$titleMd = $phyInt[$nums];
		$md = $phyIdd[$nums];
		$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";

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
?>











































































<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="700px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">스케쥴 - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	

		 
		 
</th>
<form></form>
<form name = "form110" id = "form110" method = "post" action ="daily_report_nurse_r2.php">
	<th align=center width="50px">
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />		
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />		
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />							
		<input class="selector"  style="width: 20px; height: 20px" type = "submit"  name = "week_" id = "week_" value="<" />
	</th>
</form>

<form name = "form111" id = "form112" method = "post" action ="daily_report_nurse_r2.php">
	<th align=center width="50px"><input type = hidden name = "weekago"	id ="weekago" value = 0 />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
		<input class="selector"  style="width: 60px; height: 20px"  type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>

<form name = "form112" id = "form112" method = "post" action ="daily_report_nurse_r2.php">
	<th align=center width="50px"><input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
		<input type = hidden name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
		<input class="selector"  style="width: 20px; height: 20px" type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>

<form></form>
<!--
<form name = "formSite" id = "formSite" method = "post" action ="daily_report_nurse_r2.php">
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





<form id=form11 name=form11 method=post action="daily_report_nurse_r2.php">
	<th align=right >
		<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input class="selector"  type='submit' name="mdname" value="Total"  style="width: 60px; height: 20px"></input>		
		<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

</p>



	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){
		
		if((strlen($titleMd)!=0 and strcmp($titleMd,$phyInt[$idphys])==0) or strlen($titleMd)==0){
			$bgcols = $phyCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
	?>
	
	<form id=form11 name=form11 method=post action="daily_report_nurse_r2.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class="selector" type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />			
			<input type = hidden name = plname id = plname value = <?php echo $pl2; ?> />								
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report_nurse_r2.php" />				
			
		</th>
	</form>

	<?php }	?>








<form id=form11 name=form11 method=post target="_blank"  action="meetingschedule.php">
	<th align=right ><input class = "selector"  style="width: 60px; height: 20px" type=submit name=btn_home id=btn_home value=면담일정 />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>



<form id=form11 name=form11 method=post  target="_blank"  action="schedulerct.php">
	<th align=right ><input class="selector"  style="width: 60px; height: 20px" type=submit name=btn_home id=btn_home value=스케쥴러 />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post  target="_blank"  action="timescheduler.php">
	<th align=right ><input class="selector"   style="width: 60px; height: 20px" type=submit name=btn_home id=btn_home value=일간스케쥴 />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post  target="_blank"  action="activeschedule.php">
	<th align=right ><input class="selector"   style="width: 60px; height: 20px" type=submit name=btn_home id=btn_home value=일정조정 />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = hidden name = username id = username value = <?php echo $uid; ?> />				
	</th>
</form>

</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">



		
</table>		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

       
    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    
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
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>
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


$StatT = $_POST['StatT'];
// Status change!!!!
for($idstat = 0; $idstat<count($StatT); $idstat++){
	$hId = substr($StatT[$idstat],0,9);
	$sId = substr($StatT[$idstat],9,2);
	
	
	$sqlQuery = mysqli_fetch_assoc(mysqli_query($test, "select $sId from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryPhys = mysqli_fetch_assoc(mysqli_query($test, "select physician from TreatmentInfo where Hospital_ID = $hId"));	
	$sqlQueryName = mysqli_fetch_assoc(mysqli_query($test, "select Firstname, Secondname from PatientInfo where Hospital_ID = $hId"));	
	if($sqlQuery[$sId]==0){ 
				
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	
	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
//     echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* #CC6699 (web safe colors) */

    	$bgcolorF = "#FFFFFF";

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
	
	
	
<!-- Checkbox for status -->



	<?php
		if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
		}
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
    
    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
    echo "<input name=username type=hidden id=username  value=$uid/>";           
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      
    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  

    
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    <font color=$fontColorF>$cropTnm</font></td> ";
    echo " <td bgcolor=$bgcolorF width = '60px'>   <font color=$fontColorF>$row_Recordset1[purpose]</font> </td> ";

	
	
// 	Prescription 
	$cropN = 100;
	echo "<td bgcolor=$bgcolorF width='180' align='left'><div class='memo'><font color=$fontColorF>"; 
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
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $simVal $cropDateCT<br>$weekyoil</font>$simValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $startColor> $startVal $cropDate<br>$weekyoil</font>$startValR</td>";	

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
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









		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}

?>


<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Suspended</font>

        </th>
       
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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



$query_Recordset1 = "SELECT * FROM PatientInfo  join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite (PatientInfo.CurrentStatus LIKE '4')" ;	

if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

    if ($ss2 < $ss) {
	        $bgcolorF = "#B0C4DE"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	





    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";  
      echo "<input name=username type=hidden id=username  value=$uid/>";      
              
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    
    
    
        $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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


		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>




<?php

// Sort patients who have notice on certain date
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));


$hisID = $row_patientinfo['Hospital_ID'];
$queryMemo = "Select * from MemoTemp where STR_TO_DATE(Date1, '%m/%d/%y') like '$a_week_after'";
$MemoInfo = mysqli_query($test, $queryMemo ) or die(mysqli_error());
$row_Memoinfo = mysqli_fetch_assoc($MemoInfo);
$total_Memoinfo = mysqli_num_rows($MemoInfo);

				$sql_Memo = mysqli_query($test, $queryMemo);
				for($i=0; $i<$total_Memoinfo; $i = $i+1){ 
					$MemoTester[$i] = mysqli_result($sql_Memo, $i,"Memo1");
					$Hids[$i] = mysqli_result($sql_Memo, $i,"Hospital_ID");
					}
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
$queryMemo2 = "Select * from MemoTemp where STR_TO_DATE(Date1, '%m/%d/%y') like '$a_week_ago_todo'";
$MemoInfo2 = mysqli_query($test, $queryMemo2 ) or die(mysqli_error());
$row_Memoinfo2 = mysqli_fetch_assoc($MemoInfo2);
$total_Memoinfo2 = mysqli_num_rows($MemoInfo2);


	
if($total_Memoinfo+$total_Memoinfo>0){ 	
?>




	<tr>
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Issued Patients (오늘 노트가 기록된 환자 리스트)

	        
	        
	        </font> 

					
		   
<!-- 		<input type = hidden name = "statusP"	id ="statusP" value = <?php echo $week_post; ?> />		 -->
        </th>
</tr>
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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
        $bgcolorF = "#DDDDDD";
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
	

	$bgcolorH = "#fbeaae"; /* yellow 1 (ibm design colors) */

	echo "<td bgcolor=$bgcolorH cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    




   
    echo "<td bgcolor=$bgcolorH width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";  
      echo "<input name=username type=hidden id=username  value=$uid/>";      
              
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
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
	

$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.Hospital_ID like $Hids[$idIssue]";

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
        $bgcolorF = "#DDDDDD";
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
	
	echo "<td bgcolor=#89eda0 cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	

	$cropROID = substr($row_Recordset1[RO_ID], 5,100);
	
    echo "<td bgcolor=#89eda0 width = '60px'>  <strong><font color=$fontColorF>$row_Recordset1[Hospital_ID]</font></strong> <br><font color=$fontColorF>$cropROID</font>  </td>";         /* green 10 (ibm design colors) */
	$bgcolorF = "#FFFFFF";

    
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
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[subsite]</font></strong> </td> ";  
     echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong><font color=$fontColorF>$row_Recordset1[purpose]</font></strong> <br>";  

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




		$sql_Memo = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
  unset($row_Recordset1);
}
}
}
}
?>







<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">신환/CD (오늘 새로운 플랜으로 치료를 시작하는 환자의 리스트)</font> 

        </th>
       
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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
// echo($weekDays);
$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';


    
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on  PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD 
((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 								
(STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											
(STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 
(STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											
(STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') ) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

// 	if($pid[$tCount]<=$idx){
	if($pid[$tCount]<=9){
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

    if ($pid[$tCount]==1) {
	        $bgcolorF = "#f7aac3"; /* magenta 20 (ibm design colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	

    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=username type=hidden id=username  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>










<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">시뮬레이션 (오늘의 시뮬레이션)</font>

        </th>
       
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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
$catchar  = '';
$sortCat1 = 'CT_Sim1';
$sortCat2 = 'CT_Sim2';
$sortCat3 = 'CT_Sim3';
$sortCat4 = 'CT_Sim4';
$sortCat5 = 'CT_Sim5';
$sortCat6 = 'CT_Sim6';
$sortCat7 = 'CT_Sim7';

for($idslot=0;$idslot<count($slotIdd); $idslot++){ 

// print_r($slotIdd);
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD 
(((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time1 like $slotIdd[$idslot]) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time2 like $slotIdd[$idslot]) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time3 like $slotIdd[$idslot]) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time4 like $slotIdd[$idslot]) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time5 like $slotIdd[$idslot]) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time6 like $slotIdd[$idslot]) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after')  AND CT_Time7 like $slotIdd[$idslot])) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
(PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND 
(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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
// print_r($row_Recordset1);
if ($totalRows_Recordset1==0){
	echo "<tr class='border_bottom'>";
	echo "<td align=center bgcolor=#EEEEEE>";
	echo($slotInt[$idslot]);
	echo "</td>";	
	echo "<td  bgcolor=#EEEEEE colspan=100>";
	echo "</td>";	

	echo "</tr>";
}

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
	$times = "CT_Time" . "$pid[$tCount]";
	
            
    echo "<tr class='border_bottom'>";

    if ($totalDays % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }

// 	if($pid[$tCount]<=$idx){
	if($pid[$tCount]<=9){
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

    if ($ss2 < $ss) {
	        $bgcolorF = "#FFFFFF"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	

	$timess = $row_Recordset1[$times];
	$fTime = $slotInt[intval($timess)-1];
	$bgcolorTime = $bgcolorF;
	if($totalRows_Recordset1>1){ 
		$bgcolorTime = "red";
	}
	// echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	
	echo "<td bgcolor=$bgcolorTime cellspacing='0' align=center>$fTime</td>";	



	echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=username type=hidden id=username  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}
}

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
// echo($weekDays);
$catchar  = '';
$sortCat1 = 'CT_Sim1';
$sortCat2 = 'CT_Sim2';
$sortCat3 = 'CT_Sim3';
$sortCat4 = 'CT_Sim4';
$sortCat5 = 'CT_Sim5';
$sortCat6 = 'CT_Sim6';
$sortCat7 = 'CT_Sim7';

for($idslot=0;$idslot<1; $idslot++){ 

// print_r($slotIdd);
$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD 
(((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time1 like 0) or 
((STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time2 like 0) or 								
((STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time3 like 0) or 
((STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time4 like 0) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time5 like 0) or 
((STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') AND CT_Time6 like 0) or 											
((STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after')  AND CT_Time7 like 0)) AND 
(PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND 
(PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND 
(PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

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
    if ((($ss < $s2) or ($s2 < $nullDate)) and $rowOrders["idx"]>=1  ) {
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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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
?>
<tr>
<td colspan=100>
Unscheduled Simulation
<input type="submit" name="statchk" id="Plans" value = "Update" />
		    <input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = "username" id = "username" value = <?php echo $uid; ?> />				    
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />	 
			<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
			<input type = hidden name = "mdname2"	id ="mdname2" value = "<?php echo $md2; ?>" />	
			<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				


</td>
</tr>

<?php
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

// 	if($pid[$tCount]<=$idx){
	if($pid[$tCount]<=9){
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

    if ($ss2 < $ss) {
	        $bgcolorF = "#FFFFFF"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	
	?>
	<td >
	<select class="form-control" name="TimeChecker[]" >			
	<option value="0" selected="selected"><?php echo "N/A"; ?></option>
<?php
for($idslot=0;$idslot<count($slotInt);$idslot++){
	echo("<option value='$slotIdd[$idslot]'>$slotIdd[$idslot]</option>");			
}
?>
<!-- <option value="0">Other</option> -->
</select></td>							
<?php
    echo "<input name=hidTime[] type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] >"; 
    echo "<input name=currs[] type=hidden id=hf_edit value= $pid[$tCount] >"; 

?>
</form>
<?php

	// echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=username type=hidden id=username  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}
}
?>

























<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">종결 (오늘 종결하는 환자의 리스트)</font>

        </th>
       
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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
$catchar  = '';
$sortCat1 = 'RT_fin_f';
$sortCat2 = 'RT_fin_f';
$sortCat3 = 'RT_fin_f';
$sortCat4 = 'RT_fin_f';
$sortCat5 = 'RT_fin_f';
$sortCat6 = 'RT_fin_f';
$sortCat7 = 'RT_fin_f';



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD 
((STR_TO_DATE(TreatmentInfo. $sortCat1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat2, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 								
(STR_TO_DATE(TreatmentInfo.$sortCat3, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat4, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											(STR_TO_DATE(TreatmentInfo.$sortCat5, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or (STR_TO_DATE(TreatmentInfo.$sortCat6, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') or 											(STR_TO_DATE(TreatmentInfo.$sortCat7, '%m/%d/%y') BETWEEN '$a_week_ago' AND '$a_week_after') ) AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

// 	if($pid[$tCount]<=$idx){
	if($pid[$tCount]<=9){
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

    if ($ss2 < $ss) {
	        $bgcolorF = "#FFFFFF"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath?v1605070516'></div></td>";	
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=username type=hidden id=username  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>






























<tr>


        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">치료중 (</font> 
	        <span style="background-color:#B0C4DE"> Fin within a week </span>)</font>

        </th>
       
	        <tr class="border_bottom">
	        							<td bgcolor="#777777" ><font color="white"></font></td>

			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>

			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			 
			<td bgcolor="#777777" align="left"><font color="white">Stage</font></td>

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



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where $queryMD $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$today_date' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$today_date' AND (PatientInfo.CurrentStatus like 1  OR PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL)" ;	

// echo($query_Recordset1);


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}


$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());



$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

// print_r($row_Recordset1);
/*
print_r($query_Recordset1);
echo("<br>");
*/
// print_r(($totalRows_Recordset1));
$rsetTemp = mysqli_query($test, $query_Recordset1 ) or die(mysqli_error());

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
//  	$sqlQuery = mysqli_query($test, "update TreatmentInfo set RT_start_cur = $dateSorter[$iddd] where Hospital_ID = $rowOrders[Hospital_ID]");		

    
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

    if ($ss2 < $ss) {
	        $bgcolorF = "#B0C4DE"; /* LightSteelBlue (web colors) */
	}
	else{
			$bgcolorF = "#FFFFFF";
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
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath'></div></td>";	
    echo "<td bgcolor=$bgcolorF width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]</font></strong>  </td>";         /* #CC6699 (web safe colors) */
	$bgcolorF = "#FFFFFF";

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
    echo "<td bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        

    echo "<form id=form111 name=form111></form>";
    echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
      echo "<input name=username type=hidden id=username  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

    echo " <td bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td bgcolor=$bgcolorF width = '70px'>    $cropTnm<br>$row_Recordset1[purpose]</td> ";

	
	
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



		$sql_Memo = mysqli_query($test, "select Memo1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_Date = mysqli_query($test, "select Date1 from OrderTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_Memoinfo = mysqli_num_rows($sql_Date);
?>

  <td  align="left" bgcolor= <?php echo $bgcolorF ?>>
 <?php 
			$Memo = mysqli_result($sql_Memo, $row_Memoinfo-1,"Memo1");
			$Date = mysqli_result($sql_Date, $row_Memoinfo-1,"Date1");
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
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
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
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);

?>



</html>

