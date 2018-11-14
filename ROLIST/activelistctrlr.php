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



	$searchQ = $_POST['txt_search'];
	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}
	
	$linacname = $_POST['linacname'];

	$siteInput = $_POST['sitename'];	
// 	$uid=$_POST['user'];

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
 <style>
.photo3 {
    width: 30px; height: 30px;
    object-fit: cover;
    border-radius: 50%;
	overflow:hidden     
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
input[type=submit].selector {
	padding: 3px 4px;
    border: none; /* Green */	

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	

.img {width:325px; height:280px; overflow:hidden } 
</style>

<title>Radiation Oncology List</title>
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

$conn = mysqli_connect("localhost", "root", "dbsgksqls")  ;
mysqli_select_db("test", $conn);
mysqli_select_db($database_test );
mysqli_query($test, "set session character_set_connection=latin1;");
mysqli_query($test, "set session character_set_results=latin1;");
mysqli_query($test, "set session character_set_client=latin1;");
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

$md = $_POST['mdname'];	

$queryMD = " ";
for($nums = 0; $nums<$numphyss;$nums++){ 

	if(strcmp($md, $phyInt[$nums])==0){
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
	
$timeTd = $_POST['TimeTd'];	
$timeTm = $_POST['TimeTm'];	
$durTd = $_POST['DurTd'];	
$durTm = $_POST['DurTm'];	
$datesID = $_POST['TimeId'];	
	$treatId = $_POST['hNum'];
	if(strlen($treatId)>7){ 
	$query_TreatRecord = "Update TreatmentInfo set LastTreat = '$a_week_after' where Hospital_ID like $treatId";
	echo($query_TreatRecord);

	mysqli_query($test, $query_TreatRecord )  ;



}

for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTd='$timeTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
}

?>





































































<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="500px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">Daily Time Planner(<?php echo($linacname) ?>) - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	Logged by <?php echo $uid;?>

	<br>



<br>

		 
		 
		 
		 
</th>



</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<form name = "form110" id = "form110" method = "post" action ="timescheduler.php">
	<th align=left width="30px">
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />		
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />		
				
		<input type = "submit" name = "week_" id = "week_" value="<" />
	</th>
</form>
<form name = "form111" id = "form112" method = "post" action ="timescheduler.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = 0 />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="timescheduler.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>
<form></form>








<?php	for($idx=0; $idx<count($rmsInt);$idx++){ 
		if((strlen($linacname)!=0 and strcmp($linacname,$rmsInt[$idx])==0) or strlen($linacname)==0){
			$bgcols = $rmsCol[$idx];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
	
	
	
	
	
	
?>
			<form id=form11 name=form11 method=post action="timescheduler.php">
				<th align=right >
					<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
					<input class="selector" type='submit' name="linacname" value=<?php echo($rmsInt[$idx]); ?> style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
					<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
					<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
				</th>
			</form>
		
		
		
<?php	} ?>
	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){
		
		if((strlen($titleMd)!=0 and strcmp($titleMd,$phyInt[$idphys])==0) or strlen($titleMd)==0){
			$bgcols = $phyCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
	?>
	
	<form id=form11 name=form11 method=post action="timescheduler.php">
		<th valign="middle" align=right >
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class="selector" type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />											
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />		
			<input type = hidden name = linacname id = linacname value = <?php echo $linacname; ?> />			
<!-- 			<input type='hidden' name="linacname" value=<?php echo($linacname); ?> ></input>		 -->
					
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
			
		</th>
	</form>

	<?php }	?>
	




		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->

<?php
$IniTime = "08:30";
$LchTime = "12:30";

$AftTime = "13:30";

$DinTIme = "17:30";
$NigTIme = "18:30";


$durTime = $_POST[durtime];	
$spcTime = $_POST[spctime];	
$hID = $_POST[hidTime];	
$forced = $_POST[forced];	
$idss = 0;
for($idF = 0; $idF<=count($durTime); $idF++){
		// $sorter[] = array(strtotime($spcTime[$idF])=>$idF);
		if(strlen($spcTime[$idF])>3 and ($forced[$idF])==0 and strcmp($spcTime[$idF],"Call")!=0){ 
			$sorter[$hID[$idF]] = strtotime($spcTime[$idF]);
			$idsorter[$hID[$idF]] = ($durTime[$idF]);
			$hidsorter[$hID[$idF]] = ($hID[$idF]);
			$timesorter[$hID[$idF]] = ($spcTime[$idF]);
			$forcedsorter[$hID[$idF]] = ($forced[$idF]);
	}
}

for($idF = 0; $idF<=count($durTime); $idF++){
		if(strlen($spcTime[$idF])>3 and ($forced[$idF])!=0 and strcmp($spcTime[$idF],"Call")!=0){ 
			$sorterF[$hID[$idF]] = strtotime($spcTime[$idF]);
			$idsorterF[$hID[$idF]] = ($durTime[$idF]);
			$hidsorterF[$hID[$idF]] = ($hID[$idF]);
			$timesorterF[$hID[$idF]] = ($spcTime[$idF]);
			$forcedsorterF[$hID[$idF]] = ($forced[$idF]);
	}
}
asort($sorter);
asort($sorterF);

// for($idF = 0; $idF<count($durTime); $idF++){

// 		echo($sorter[$hID[$idF]]);
// 		echo "<br>";

// }
$tid = 0;
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));

$dM   = date("n/j/y", strtotime($a_week_ago_todo));

$prevTime = $IniTime;
foreach($sorter as $x => $x_value) {

	$nxtTime =  date("H:i", mktime(date(substr($prevTime,0,2)),date(substr($prevTime,3,2))+$idsorter[$x],date("s"),date("m"),date("d"),date("y")));	


	if(strtotime($nxtTime)>strtotime($LchTime) and strtotime($nxtTime)<strtotime($AftTime)){
		$nxtTime = $AftTime;
	}
	
	if(strtotime($nxtTime)>strtotime($DinTIme) and strtotime($nxtTime)<strtotime($NigTIme)){
		$nxtTime = $NigTIme;
	}


	foreach($sorterF as $xF => $xF_value) {
		$fxFr = $timesorterF[$xF];
		$fxTo = date("H:i", mktime(date(substr($fxFr,0,2)),date(substr($fxFr,3,2))+$idsorterF[$xF],date("s"),date("m"),date("d"),date("y")));	
		
		if(strtotime($fxFr)>=strtotime($prevTime) and strtotime($fxFr)<=strtotime($nxtTime)){
// 		if(strtotime($nxtTime)<=strtotime($fxTo)){
			
			$queries = "update Timer set time1='$prevTime', Duration='$idsorterF[$xF]', Forced='$forcedsorterF[$xF]' where  (Hospital_ID like '$xF' and date1 like '$dM')"; 
			mysqli_query($test, $queries);    
			
			$prevTime =  date("H:i", mktime(date(substr($prevTime,0,2)),date(substr($prevTime,3,2))+$idsorterF[$xF],date("s"),date("m"),date("d"),date("y")));	
			$nxtTime =  date("H:i", mktime(date(substr($prevTime,0,2)),date(substr($prevTime,3,2))+$idsorter[$x],date("s"),date("m"),date("d"),date("y")));	
			echo($prevTime); echo($nxtTime);
// 			$prevTime = $fxTo;


		}
	}





	$queries = "update Timer set time1='$prevTime', Duration='$idsorter[$x]', Forced='$forcedsorter[$x]' where  (Hospital_ID like '$x' and date1 like '$dM')"; 
    // echo "$queries";
    // echo "<br>";
	mysqli_query($test, $queries);    

    $tid = $tid+1;
    $prevTime = $nxtTime;


}


	
?>


<form id=form13 name=form13 method=post action=timescheduler.php> 


    <table cellpadding = "1px" width="960px" border="0" align="center" cellspacing="0">
	    











  
















<tr>

	
        <th align=left  colspan="100">
	        <br>
	        <font style="font-size:12px">Active patient list (</font> 
	        <span style="background-color:#B0C4DE"> Fin within a week </span> &  
	        <span style="background-color:#a0e3f0">  Resim </span> &
	        <<span style="background-color:#FFFFFF"> Plan change </span>
	        <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#e62325' style="font-size:12px">Sim-today</font>  <font style="font-size:12px">& </font>
	        <font style="font-size:12px"><font color='#1f57a4' style="font-size:12px">Sim-waiting</span>  <font style="font-size:12px">) </font>
<?php
    echo "<input type=submit name=btn_edit id=btn_edit value=CALCULATE>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser>";   
    echo "<input name=user type=hidden id=user  value=$uid>";      
    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
          


?>
	        
        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" width="20px"><font color="white">Rsv</font></td>
			<td bgcolor="#777777" width="10px"><font color="white">Dur</font></td>
			<td bgcolor="#777777" width="10px"><font color="white">Forced</font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			
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



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo join Timer on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID and PatientInfo.Hospital_ID = Timer.Hospital_ID where  $querySite $queryMD STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$a_week_ago_todo' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$a_week_ago_todo' AND (PatientInfo.CurrentStatus like 1  OR PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL) AND (STR_TO_DATE(Timer.date1, '%m/%d/%Y') = '$a_week_ago_todo')" ;	


if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'asc';
}


$query_Recordset1 .= " ORDER BY Timer.time1 " . $order;

$Recordset1 = mysqli_query($test, $query_Recordset1 )  ;

$row_Recordset1       = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
$rsetTemp = mysqli_query($test, $query_Recordset1 )  ;

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

// $todayTime = 
$todayTime = date("H:i", mktime(0, +0, 10, 1, 32, 1997));

$StartTime = "08:30";
$morningStamp =0;
echo($prev_date);
$TimeCount = 0;
$preT = "01";
$bgid = 0;
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
    $Linac_curr = "Linac" . "$pid[$tCount]";
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $Method_curr = "RT_method" . "$pid[$tCount]";
    
    
    
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";   
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
    
if (strcasecmp(trim($row_Recordset1[$Linac_curr]),$linacname)==0){
    if ($totalDays % 2 == 0) {
    $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#FFFFFF";
    }

    if(strcmp($row_Recordset1[LastTreat],$a_week_after)==0){
        $bgcolorF = "#888888";

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
	
	
    $ss2        = date('Y-m-d', strtotime($row_Recordset1["RT_fin_f"] . '-' . '7' . ' days'));
	
	$lunchS = "12:00";
	$lunchE = "13:30";
		
	$dayStart = "08:50";

	$dinnerS = "18:00";
	$dinnerE = "19:00";



	if($TimeCount==0){		
		$time = strtotime($dayStart);
		$todayTable = date("H:i",strtotime('+0 minutes',$time));
		$sumTime = $todayTable;
		$durs = $row_Recordset1[DurTd];
	}
	else{
		$dura = "+". $durs. " minutes";
		$todayTable = date("H:i",strtotime($dura,strtotime($sumTime)));		
		if(strtotime($todayTable)>strtotime($lunchS) and strtotime($todayTable)<strtotime($lunchE)){
			$todayTable = $lunchE;
			echo "<tr  height=100px class='border_bottom'>";
			echo "<td colspan=1000 align=center bgcolor = #9fa7a7>LUNCH</td>";			 /* cool-gray 30 (ibm design colors) */
			echo "</tr>";			
		}
		if(strtotime($todayTable)>strtotime($dinnerS) and strtotime($todayTable)<strtotime($dinnerE)){
			$todayTable = $dinnerE;
			echo "<tr  height=100px class='border_bottom'>";
			echo "<td colspan=1000 align=center bgcolor = #9fa7a7>DINNER</td>";			 /* cool-gray 30 (ibm design colors) */
			echo "</tr>";			
		}		
		$sumTime = $todayTable;
		$durs = $row_Recordset1[DurTd];		
	}
	$TimeCount++;

	$tdHeight = 30;






	if(strcmp(substr($row_Recordset1[time1],0,2),$preT)!=0){
		$bgid = $bgid+1;
	}


    if ($bgid % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#FFFFFF";
    }

	if(strcmp(substr($row_Recordset1[time1],0,2),$preT)!=0){
		$preT = substr($row_Recordset1[time1],0,2);
		if(strcmp($preT,"Ca")==0){ 
			echo "<tr height='20px' class='border_bottom'><td align=left bgcolor= #FFFFFF colspan = 200><font size=2><strong> &nbsp$nbsp  CALL</strong></font></td></tr>";
		}
		elseif(strlen($row_Recordset1[time1])==0){ 
			echo "<tr height='20px' class='border_bottom'><td align=left bgcolor= #FFFFFF colspan = 200><font size=2><strong> &nbsp$nbsp  UNSCHEDULED</strong></font></td></tr>";
		}
		else{
			echo "<tr height='20px' class='border_bottom'><td align=left bgcolor= #FFFFFF colspan = 200><font size=2><strong> &nbsp$nbsp  $preT 시</strong></font></td></tr>";			
		}
	}




    echo "<tr  height='$tdHeight px' class='border_bottom'>";








	?>
	<?php




    
	if($StartTime>date("H:i", strtotime("12:00" . "+0 minutes")) and $morningStamp==0){
		$StartTime = date("H:i", strtotime("13:30" . "+0 minutes"));
		$morningStamp = 1;
	}
	
		$sql_MemoTcr = mysqli_query($test, "select Memo1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_DateTcr = mysqli_query($test, "select Date1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_MemoinfoTcr = mysqli_num_rows($sql_DateTcr);
		$spanNum = strval(intval($row_MemoinfoTcr)+1);

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
	

	// $sqlQ = "insert into Timer (Hospital_ID, date1) values ('$row_Recordset1[Hospital_ID]', 'xxxxxx')";
	// echo($sqlQ);
	// echo("<br>");
	// mysqli_query($test, "insert into Timer (Hospital_ID, date1) values ('$row_Recordset1[Hospital_ID]', 'xxxxxx')"); 
	


	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath'></div></td>";	
    
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '25px'>  <input class='form-control' style='width:30px' type='text' name='spctime[]' value=$row_Recordset1[time1] > </td>"; 
    echo "<input name=hidTime[] type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] >"; 


    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '20px'>  <input class='form-control' style='width:15px' type='text' name='durtime[]' value=$row_Recordset1[Duration] > </td>"; 

// 	강제 고정 여부 결정
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '20px'>";
//     echo "<input class='form-control' style='width:8px' type='text' name='durtime[]' value=$row_Recordset1[Duration] >";


	
    echo "<select class='form-control' style='width:30px' type='text' name='forced[]' selected=$row_Recordset1[Forced] >";

    echo "<option value=0>0</option>";
    echo "<option value=1>1</option>";    
	echo "</select>";
    echo "</td>"; 
    
    // echo "<input name=hidTime[] type=hidden value= $row_Recordset1[Hospital_ID] >"; 
	$remarker = "";
    $bgcolorH = $bgcolorF;
    if(strcmp($row_Recordset1[Forced],"1")==0){
	    $bgcolorH = "#047cc0"; /* cerulean 50 (ibm design colors) */
// 	    $remarker = "<br>신환";

    }
    if(strcmp($row_Recordset1[RT_start1],date("n/j/y", strtotime($a_week_ago_todo)))==0){

	    $bgcolorH = "#f7aac3"; /* magenta 20 (ibm design colors) */
	    $remarker = "<br>신환";
	    
    }
    if((strcmp($row_Recordset1[RT_start2],date("n/j/y", strtotime($a_week_ago_todo)))==0) or (strcmp($row_Recordset1[RT_start3],date("n/j/y", strtotime($a_week_ago_todo)))==0) or (strcmp($row_Recordset1[RT_start4],date("n/j/y", strtotime($a_week_ago_todo)))==0) or (strcmp($row_Recordset1[RT_start5],date("n/j/y", strtotime($a_week_ago_todo)))==0) or (strcmp($row_Recordset1[RT_start6],date("n/j/y", strtotime($a_week_ago_todo)))==0) or (strcmp($row_Recordset1[RT_start7],date("n/j/y", strtotime($a_week_ago_todo)))==0)){

	    $bgcolorH = "#d2b5f0"; /* violet 20 (ibm design colors) */
	    $remarker = "<br>CD";
	    
    }

    if(strcmp($row_Recordset1[RT_fin_f],date("n/j/y", strtotime($a_week_ago_todo)))==0){

	    $bgcolorH = "#b0bef3"; /* ultramarine 20 (ibm design colors) */
	    $remarker = "<br>종결";
	    
    }

    
    echo "<td rowspan = $spanNum bgcolor=$bgcolorH width = '60px'>  <strong><font>$row_Recordset1[Hospital_ID]$remarker</font></strong>  </td>"; 
	





//  CCRT or not
    if ($row_Recordset1[Modality_var1] == NULL){
        echo "<td rowspan = $spanNum width = '15px' color=white bgcolor=$bgcolorF align='center'>  </td>";
        }
    else{
	    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
		echo "<td rowspan = $spanNum width = '15px' bgcolor=#f45942 align='center'> C </td>";
	}

	




	if(strcmp($row_Recordset1[InP], "외래")==0){
			$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
		}
		else{
			$fontColorInp = "#aa231f"; /* red 80 (ibm design colors) */
		}
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '40px' align='left'>  <strong><font color=$fontColorF>$row_Recordset1[KorName]</font><br><font color=$fontColorInp>$row_Recordset1[InP]</font></strong></td>"; 
        
// Detail page
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";   

// Treat button
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=timescheduler.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=Treat>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
             
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      


    echo " <td rowspan = $spanNum bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> </td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    echo " <td rowspan = $spanNum bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

// 	Prescription 
	$cropN = 8;
	echo "<td rowspan = $spanNum bgcolor=$bgcolorF width='250' align='left'><div class='memo'>";
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
// 	echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF><font color = $simColor> $strVal $cropDateCT<br>$weekyoil</font>$strValR</td>";

	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[$RT_start_curr]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDate<br>$weekyoil</td>";

    $lenDate = strlen($row_Recordset1[RT_fin_f]);   
    $cropDateFin = substr($row_Recordset1[RT_fin_f],0,$lenDate-3);
	$weekyoil = $yoil[date('w', strtotime($row_Recordset1[RT_fin_f]))];
    echo "<td rowspan = 1 width = '20px' align='left' bgcolor=$bgcolorF>$cropDateFin<br>$weekyoil</td>";
    

	$tcn = substr(trim($row_Recordset1[$Method_curr]),0,2);
	$phyMark = "<td bgcolor=$bgcolorF align='center'>$tcn</td>";

	for($idphyss=0;$idphyss<$numtech;$idphyss++){

		if (strcasecmp(trim($row_Recordset1[$Method_curr]),$techIdd[$idphyss])==0){
			$phyMark = "<td bgcolor=$techCol[$idphyss] width = '15' align='center'>$techInt[$idphyss] </td>";
		} 	 /* #33FF00 (web safe colors) */

	}
	echo($phyMark) ;


    $txtLinac = "<td bgcolor=$bgcolorF align=center>   $row_Recordset1[$Linac_curr] </td>";
    for($idlinac=0; $idlinac<$numrooms;$idlinac++){
		if (strcasecmp(substr(trim($row_Recordset1[$Linac_curr]),0,2),substr(trim($rmsInt[$idlinac]),0,2))==0){     	
			$txtLinac = "<td bgcolor=$rmsCol[$idlinac] align=center width = '15'>   $rmsIdd[$idlinac] </td>";
		}
    }
   	echo "$txtLinac";

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
        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=user type=hidden id=user  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
              
    }
    if ($permitUser == 2) {
        
	  echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post target=_blank  action=shorttcr.php >";
      echo "<input type=submit name=btn_comment id=btn_comment value=C />";
      echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
      echo "<input name=user type=hidden id=user  value=$uid/>";      
      
	  echo "<input name=hc_field type=hidden id=hc_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        
    }
?>


</td>
</tr>
	
<?php
		
		if($row_MemoinfoTcr !=0){ 
		}

?>


	<?php
	for($idmem=0; $idmem<$row_MemoinfoTcr; $idmem++){ 
		$Memo = mysqli_result($sql_MemoTcr, $idmem,"Memo1");
		$Date = mysqli_result($sql_DateTcr, $idmem,"Date1");	
		$intVals = strval($row_MemoinfoTcr);
		echo "<tr  class=border_bottom>";
		if($idmem==0) { 
		echo "<td rowspan = $intVals bgcolor=$bgcolorF rowspan = $row_Memoinfo>";
		echo "치료 노트";
		echo "</td>";
		}
		echo "<td bgcolor=$bgcolorF  class=border_bottom colspan=2>";
		echo "<font color = blue> $Date </font>";
		echo "</td>";
		echo "<td bgcolor=$bgcolorF  class=border_bottom colspan=100>";
		echo "<font color = blue> $Memo </font>";
		echo "</td>";
		echo "</tr>";
	}
	?>

<?php
}
}
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));


  unset($row_Recordset1);
}
}

?>

</form>

<?php
	
$timeTd = $_POST['TimeTd'];	
$timeTm = $_POST['TimeTm'];	
$durTd = $_POST['DurTd'];	
$durTm = $_POST['DurTm'];	
$datesID = $_POST['TimeId'];	

for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTd='$timeTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysqli_query($test, $queryTime )  ;
}

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
mysqli_free_result($Recordset1);
mysqli_free_result($Recordset2);

?>



</html>

