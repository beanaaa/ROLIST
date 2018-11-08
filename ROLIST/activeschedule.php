<!doctype html>
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
    $md = "myki";



	$searchQ = $_POST['txt_search'];
	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

	}
	
	$linacname = $_POST['linacname'];
	if(strlen($_POST['linacname'])<1){
		$linacname = "versa";
	}
	$md2 = $_POST['mdname'];
		echo($md2);
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

$conn = mysql_connect("localhost", "root", "dbsgksqls") or die(mysql_error());
mysql_select_db("test", $conn);
mysql_select_db($database_test, $test);
mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");
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

<?
	$treatId = $_POST['hNum'];
	$hids = $_POST['curPlan'];
	$reason = $_POST['pStat'];
	
	if(strcmp($reason,'3')==0){

		// 장비고장으로 치료하지 못하였음을 오늘 날짜로 메모에 입력함
		$memoDate = date('n/j/y');	
		$memoSql = "select * from MemoTemp where Hospital_ID like '$treatId'";
		$numSql = mysql_num_rows(mysql_query($memoSql));		
		$memoSql = "insert into MemoTemp (Hospital_ID,Memo1,Date1,idx) values('$treatId','Cancel (장비고장)','$memoDate',$numSql)";
		mysql_query($memoSql);
		$queryString = "select * from TreatmentInfo where Hospital_ID like '$treatId'";
		$queryDelay = mysql_query($queryString);
		$Delays = mysql_fetch_assoc($queryDelay);

		
		for($idDelay = $hids; $idDelay<$Delays[idx]+1;$idDelay++){
			$curFin = "RT_fin".$idDelay;			
			$curStart = "RT_start".$idDelay;			
			$curDelay = "Delay_idx".$idDelay;			

			
			$totalDelay = $Delays[$curDelay];
			if($idDelay==$hids){
				$totalDelay = $Delays[$curDelay]+1;
			}
			if($idDelay==$hids and strlen($Delays[$curDelay])==0){
				$totalDelay = 1;
				
			}


			$plusDate = 0;
			for($idplus=0;$idplus<10;$idplus++){							
				$plusDate++;
		    	$upStart = date('n/j/y',strtotime($Delays[$curStart]."+".$plusDate." days"));	
		    	$upStartW = date('w',strtotime($Delays[$curStart]."+".$plusDate." days"));	

		        $holdate = date("Y-m-d",strtotime($upStart));
		        $holquery = "Select * from Holiday where solar_date like '$holdate'";
				$row_holiday = mysql_fetch_assoc(mysql_query($holquery));
		    	if($upStartW !=0 and $upStartW !=6 and strlen($row_holiday[memo])==0){
			    	break;
		    	}

			}

			//현재 치료중인 스케쥴은 delay만 업데이트 하고 이후 치료스케쥴은 하루씩 미루어짐
			if($idDelay==$hids){
				$upquery = "Update TreatmentInfo set $curDelay='$totalDelay' where Hospital_ID like '$treatId'";				
			}
			else{
				$upquery = "Update TreatmentInfo set $curStart='$upStart' where Hospital_ID like '$treatId'";
			}
			mysql_query($upquery);					
			
		}


		for($idDelay = $hids; $idDelay<$Delays[idx]+1;$idDelay++){
			$curFin = "RT_fin".$idDelay;			
			$curStart = "RT_start".$idDelay;			
			$curDelay = "Delay_idx".$idDelay;			
			
			$totalDelay = $Delays[$curDelay];
			if($idDelay==$hids){
				$totalDelay = $Delays[$curDelay]+1;
			}
			if($idDelay==$hids and strlen($Delays[$curDelay])==0){
				$totalDelay = 1;
				
			}


			$plusDate = 0;
			for($idplus=0;$idplus<10;$idplus++){							
				$plusDate++;
		    	$upStart = date('n/j/y',strtotime($Delays[$curFin]."+".$plusDate." days"));	
		    	$upStartW = date('w',strtotime($Delays[$curFin]."+".$plusDate." days"));	

		        $holdate = date("Y-m-d",strtotime($upStart));
		        $holquery = "Select * from Holiday where solar_date like '$holdate'";
				$row_holiday = mysql_fetch_assoc(mysql_query($holquery));
		    	if($upStartW !=0 and $upStartW !=6 and strlen($row_holiday[memo])==0){
			    	break;
		    	}

			}

			//현재 치료중인 스케쥴은 delay만 업데이트 하고 이후 치료스케쥴은 하루씩 미루어짐
			$upquery = "Update TreatmentInfo set $curFin='$upStart' where Hospital_ID like '$treatId'";
			mysql_query($upquery);					
			$upquery = "Update TreatmentInfo set RT_fin_f='$upStart' where Hospital_ID like '$treatId'";
			mysql_query($upquery);					
			
		}

		
		
		
		
	}


// 환자 개인사정으로 치료못하는 경우

	if(strcmp($reason,'4')==0){
		// 장비고장으로 치료하지 못하였음을 오늘 날짜로 메모에 입력함
		$memoDate = date('n/j/y');	
		$memoSql = "select * from MemoTemp where Hospital_ID like '$treatId'";
		$numSql = mysql_num_rows(mysql_query($memoSql));		
		$memoSql = "insert into MemoTemp (Hospital_ID,Memo1,Date1,idx) values('$treatId','Cancel (개인사유)','$memoDate',$numSql)";
		mysql_query($memoSql);
		$queryString = "select * from TreatmentInfo where Hospital_ID like '$treatId'";
		$queryDelay = mysql_query($queryString);
		$Delays = mysql_fetch_assoc($queryDelay);

		
		for($idDelay = $hids; $idDelay<$Delays[idx]+1;$idDelay++){
			$curFin = "RT_fin".$idDelay;			
			$curStart = "RT_start".$idDelay;			
			$curDelay = "Delay_idx".$idDelay;			
			
			$totalDelay = $Delays[$curDelay];
			if($idDelay==$hids){
				$totalDelay = $Delays[$curDelay]+1;
			}
			if($idDelay==$hids and strlen($Delays[$curDelay])==0){
				$totalDelay = 1;
				
			}


			$plusDate = 0;
			for($idplus=0;$idplus<10;$idplus++){							
				$plusDate++;
		    	$upStart = date('n/j/y',strtotime($Delays[$curStart]."+".$plusDate." days"));	
		    	$upStartW = date('w',strtotime($Delays[$curStart]."+".$plusDate." days"));	

		        $holdate = date("Y-m-d",strtotime($upStart));
		        $holquery = "Select * from Holiday where solar_date like '$holdate'";
				$row_holiday = mysql_fetch_assoc(mysql_query($holquery));
		    	if($upStartW !=0 and $upStartW !=6 and strlen($row_holiday[memo])==0){
			    	break;
		    	}

			}

			//현재 치료중인 스케쥴은 delay만 업데이트 하고 이후 치료스케쥴은 하루씩 미루어짐
			if($idDelay==$hids){
				$upquery = "Update TreatmentInfo set $curDelay='$totalDelay' where Hospital_ID like '$treatId'";				
			}
			else{
				$upquery = "Update TreatmentInfo set $curStart='$upStart' where Hospital_ID like '$treatId'";
			}
			mysql_query($upquery);					
			
		}


		for($idDelay = $hids; $idDelay<$Delays[idx]+1;$idDelay++){
			$curFin = "RT_fin".$idDelay;			
			$curStart = "RT_start".$idDelay;			
			$curDelay = "Delay_idx".$idDelay;			
			
			$totalDelay = $Delays[$curDelay];
			if($idDelay==$hids){
				$totalDelay = $Delays[$curDelay]+1;
			}
			if($idDelay==$hids and strlen($Delays[$curDelay])==0){
				$totalDelay = 1;
				
			}


			$plusDate = 0;
			for($idplus=0;$idplus<10;$idplus++){							
				$plusDate++;
		    	$upStart = date('n/j/y',strtotime($Delays[$curFin]."+".$plusDate." days"));	
		    	$upStartW = date('w',strtotime($Delays[$curFin]."+".$plusDate." days"));	

		        $holdate = date("Y-m-d",strtotime($upStart));
		        $holquery = "Select * from Holiday where solar_date like '$holdate'";
				$row_holiday = mysql_fetch_assoc(mysql_query($holquery));
		    	if($upStartW !=0 and $upStartW !=6 and strlen($row_holiday[memo])==0){
			    	break;
		    	}

			}

			//현재 치료중인 스케쥴은 delay만 업데이트 하고 이후 치료스케쥴은 하루씩 미루어짐
			$upquery = "Update TreatmentInfo set $curFin='$upStart' where Hospital_ID like '$treatId'";
			mysql_query($upquery);					
			$upquery = "Update TreatmentInfo set RT_fin_f='$upStart' where Hospital_ID like '$treatId'";
			mysql_query($upquery);					
			
		}

		
		
		
		
	}

	
	
?>






<?php
$seven          = $idDays + $week_post;
$a_week_ago_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_after_todo     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));

	
$timeTd = $_POST['TimeTd'];	
$timeTm = $_POST['TimeTm'];	
$durTd = $_POST['DurTd'];	
$durTm = $_POST['DurTm'];	

$doseTreat = $_POST['doseTreat'];	
$pStat = $_POST['pStat'];	
// echo("pSat: ".$pStat);
$lens = strlen($pStat);

$datesID = $_POST['TimeId'];	
	$treatId = $_POST['hNum'];
	if(strlen($treatId)>7){ 
	$query_TreatRecord = "Update TreatmentInfo set LastTreat = '$a_week_after' where Hospital_ID like $treatId";
		// (STR_TO_DATE(Timer.date1, '%m/%d/%Y') = '$a_week_ago_todo'
	if(strlen($doseTreat)>0){ 
	$query_dose = "Update Timer set Dose=$doseTreat where Hospital_ID like '$treatId' and (STR_TO_DATE(Timer.date1, '%m/%d/%Y') = '$a_week_ago_todo')";
	}
	if(((int)$pStat)>=0){ 
	$query_stat = "Update Timer set Stat=$pStat where Hospital_ID like '$treatId' and (STR_TO_DATE(Timer.date1, '%m/%d/%Y') = '$a_week_ago_todo')";
	
// 	echo "$query_stat";
	mysql_query($query_stat, $test) or die(mysql_error());

	}

	mysql_query($query_TreatRecord, $test) or die(mysql_error());
	mysql_query($query_dose, $test) or die(mysql_error());




}

for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTd='$timeTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}

?>



































































<?php
if(strcmp($linacname,"versa")==0){
	$lin = "VERSA";
}
if(strcmp($linacname,"infinity")==0){
	$lin = "INFINITY";
}
if(strcmp($linacname,"ix")==0){
	$lin = "IX";
}

?>

<!-- Header -->
<table cellpadding = "5px" width="960px" border="0" align="center" cellspacing="0">
<tr>
	<th width="500px" align=left valign="top">
	<font style="font-family:arial; font-size:18px" align="left">치료시간표(<?php echo($lin) ?>) - <?php echo $titleMd; ?> (<?php echo $a_week_after; ?>) </font> 	Logged by <?php echo $uid;?>

	<br>
	<font color="red"><strong>BrH나 BrP 버튼을 클릭하면 환자치료스케쥴이 하루씩 미루어 집니다. 주의해서 사용해 주세요(BrH: 장비고장, BrP: 환자개인사유), 신환이나 CD환자는 구현되어 있지 않으니 수동으로 처리해 주세요.<br>
	만약 환자이름이 보이지 않으면 Nurse 페이지에서 환자를 열어 일간 스케쥴을 추가해 주세요.</strong></font>
<br>

		 
		 
		 
</th>

</th>

</tr>

</table>



<table width="960px" border="0" align="center" cellspacing="0">
<form></form>
<form name = "form110" id = "form110" method = "post" action ="activeschedule.php">
	<th align=left width="30px">
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />		
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />		
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
				
		<input type = "submit" name = "week_" id = "week_" value="<" />
	</th>
</form>
<form name = "form111" id = "form112" method = "post" action ="activeschedule.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = 0 />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
					
		
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="activeschedule.php">
	<th align=left width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
		
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>
<form></form>
<form name = "formSite" id = "formSite" method = "post" action ="activeschedule.php">
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
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' value='Submit' />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $siteInput; ?>" />				
		
		<input type = "hidden" name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />				
		
	</select>
	</th>
	<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
</form>	





<form id=form11 name=form11 method=post action="activeschedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="mdname" value="Total" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post action="activeschedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="ix" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="activeschedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="versa" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post action="activeschedule.php">
	<th align=right >
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' name="linacname" value="infinity" ></input>		
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

</p>

<form id=form11 name=form11 method=post target=_blank action="finrpt.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Finished />
		<input name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<!--
<form id=form11 name=form11 method=post target=_blank  action="activeschedule_physician.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Todo-Physician />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
	</th>
</form>
-->


<form id=form11 name=form11 method=post target=_blank  action="live.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Active />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="monthlycount.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Count />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="testphpr2.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=ROOT-DB />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="activeschedule_backup.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=DAILY />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>
<form id=form11 name=form11 method=post target=_blank  action="calendar.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=Calendar />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank  action="simschedule.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=SCHEDULER />
		<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>

<form id=form11 name=form11 method=post target=_blank action="N_register_all.php">
	<th align=right ><input type=submit name=btn_home id=btn_home value=NEW-PATIENT />
		<input name=permit type=hidden id=permit  value= <?php echo $permitUser ?>/>
		<input type = "hidden" name = "user" id = "user" value = <?php echo $uid; ?> />				
	</th>
</form>



		
</table>
		
		
		
		
		
		
		
		
		
		
		
		
		
<!-- Main body -->
		
		
<!-- Submit button for status  -->
<form name = "Plan" method = "POST" action ="" >

<form>

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
        </th>
       
	        <tr class="border_bottom">
			<td bgcolor="#777777" ><font color="white"></font></td>
			<td bgcolor="#777777" width="20px"><font color="white">Rsv</font></td>
			<td bgcolor="#777777" width="10px"><font color="white">Dur</font></td>
			<td bgcolor="#777777" ><font color="white">Chart No.</font></td>
			<td bgcolor="#777777"><font color="white">C</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">Name</font></td>
			<td bgcolor="#777777"><font color="white">S/A</font></td>
			<td bgcolor="#777777" align="left"><font color="white">Diagnosis</font></td>
			<td bgcolor="#777777"><font color="white">Aim</font></td>			
			<td bgcolor="#777777" colspan="1" align="left"><font color="white">Prescription - No.Site:Gy(fx)</font></td>
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



$query_Recordset1 = "SELECT * FROM PatientInfo join TreatmentInfo join Timer on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID and PatientInfo.Hospital_ID = Timer.Hospital_ID where  $querySite STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') >= '$a_week_ago_todo' AND STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') <= '$a_week_ago_todo' AND (PatientInfo.CurrentStatus like 1  OR PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL) AND (STR_TO_DATE(Timer.date1, '%m/%d/%Y') = '$a_week_ago_todo')" ;	





if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'asc';
}


$query_Recordset1 .= " ORDER BY Timer.time1 ASC, binary(PatientInfo.KorName) ASC";

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
	$preT = "01";
		
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
    $Method_curr = "RT_method" . "$pid[$tCount]";
    $Linac_curr = "Linac" . "$pid[$tCount]";
    $CT_sim_curr = "CT_Sim" . "$pid[$tCount]";
    $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
    $dose_curr     = "dose" . "$pid[$tCount]";   
    $fx_curr       = "Fx" . "$pid[$tCount]";
    $nextInd 	 = $pid[$tCount]+1;
    $CT_sim_next   = "CT_Sim" . "$nextInd";
    $timeFontF = "#9320a2"; /* purple 60 (ibm design colors) */
if (strcasecmp(trim($row_Recordset1[$Linac_curr]),$linacname)==0){
    if ($totalDays % 2 == 0) {
        $bgcolorF = "#DDDDDD";
    } else {
        $bgcolorF = "#DDDDDD";
    }

    if(strcmp($row_Recordset1[LastTreat],$a_week_after)==0){
        $bgcolorF = "#FFFFFF";
        $timeFontF = "#999999";
    }
    if(strcmp($row_Recordset1[Stat],'3')==0){
        $bgcolorF = "#b4e876"; /* lime 10 (ibm design colors) */
        $timeFontF = "#999999";
    }
    if(strcmp($row_Recordset1[Stat],'4')==0){
        $bgcolorF = "#ffb000"; /* gold 20 (ibm design colors) */
        $timeFontF = "#999999";
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
	
		$sql_MemoTcr = mysql_query("select Memo1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$sql_DateTcr = mysql_query("select Date1 from TcrTemp where Hospital_ID = $row_Recordset1[Hospital_ID]");
		$row_MemoinfoTcr = mysql_num_rows($sql_DateTcr);
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
	// mysql_query("insert into Timer (Hospital_ID, date1) values ('$row_Recordset1[Hospital_ID]', 'xxxxxx')");
	
	$treatTimeF = (int)(substr($row_Recordset1[time1],0,2));

    if($treatTimeF<12){
		$timeFontF = "#3151b7"; 
	
	}
    elseif($treatTimeF>=12 and $treatTimeF<18){
		$timeFontF = "#006456";  /* teal 60 (ibm design colors) */
	
	}
    elseif($treatTimeF>=18){
		$timeFontF = "#83231e";  /* red 70 (ibm design colors) */
	
	}
    if(strcmp($row_Recordset1[LastTreat],$a_week_after)==0){
        $timeFontF = "#999999";
    }
	
	echo "<td bgcolor=$bgcolorF cellspacing='0' align=center><div class='scale'> <img class='photo3' src='$photoPath'></div></td>";	
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '25px'>  <strong><font size=2 color=$timeFontF>$row_Recordset1[time1]</font></strong>  </td>"; 
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF width = '14px'>  <font>$row_Recordset1[Duration]</font>  </td>"; 


    $bgcolorH = $bgcolorF;
	$remarker = "";
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
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post target=_blank action=N_edit_sim.php>";                        
    echo "<a href=edit.php>";            
    echo "<input type=submit name=btn_edit id=btn_edit value=$row_Recordset1[Sex]/$row_Recordset1[Age]>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
             
    echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";   

// Treat button
    // CurFxDose
    $dCur = (float)$row_Recordset1[$dose_curr];
    $fCur = (float)$row_Recordset1[$fx_curr];
    $curFxDose = sprintf("%.2f", $dCur/$fCur);

// 치료함
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=activeschedule.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=Treat>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
    echo "<input name=doseTreat type=hidden id=doseTreat  value=$curFxDose>";      
    echo "<input name=pStat type=hidden id=pStat  value=0>";      

    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
             
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      


// 치료함 with CBCT
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=activeschedule.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=CT>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
    echo "<input name=doseTreat type=hidden id=doseTreat  value=$curFxDose>";      
    echo "<input name=pStat type=hidden id=pStat  value=1>";      
             
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      



// 치료함 with PV
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=activeschedule.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=PV>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
    echo "<input name=doseTreat type=hidden id=doseTreat  value=$curFxDose>";      
    echo "<input name=pStat type=hidden id=pStat  value=2>";      
             
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

// 치료못함 우리때문에 
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=activeschedule.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=BrH>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
    echo "<input name=doseTreat type=hidden id=doseTreat  value=0>";      
    echo "<input name=pStat type=hidden id=pStat  value=3>";   
    echo "<input name=curPlan type=hidden id=curPlan  value=$pid[$tCount]>";                   
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      

// 치료못함 환자떄문에
    echo "<form id=form111 name=form111></form>";
    echo "<td rowspan = $spanNum bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=activeschedule.php>";                                   
    echo "<input type=submit name=btn_edit id=btn_edit value=BrP>";
    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";   
    echo "<input name=user type=hidden id=user  value=$uid/>";      
    echo "<input name=linacname type=hidden id=linacname  value=$linacname>";            
    echo "<input name=doseTreat type=hidden id=doseTreat  value=0>";      
    echo "<input name=pStat type=hidden id=pStat  value=4>";      
    echo "<input name=curPlan type=hidden id=curPlan  value=$pid[$tCount]>";      
             
    echo "<input name=hNum type=hidden id=hNum value= $row_Recordset1[Hospital_ID] /></a></form></td>";      







    echo " <td rowspan = $spanNum bgcolor=$bgcolorF  width = '80px'>   <strong>$row_Recordset1[subsite]</strong> <br>$row_Recordset1[purpose]</td> ";  
    $patholcrop = substr($row_Recordset1[pathol],0,100);      
    $cropTnm = substr($row_Recordset1[tnm],0,100); 
    // echo " <td rowspan = $spanNum bgcolor=$bgcolorF width = '60px'>   $row_Recordset1[purpose] </td> ";

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
			$tcnCol = "$techCol[$idphyss]";
			if(strcmp($techCol[$idphyss],"#FFFFFF")==0){
				$tcnCol = "";
			}
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
		$Memo = mysql_result($sql_MemoTcr, $idmem,"Memo1");
		$Date = mysql_result($sql_DateTcr, $idmem,"Date1");	
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
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));


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
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTd='$durTd[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
}
for($Idtx = 0; $Idtx<count($datesID); $Idtx++){
	$queryTime = "Update PatientInfo set TimeTm='$timeTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
	$queryTime = "Update PatientInfo set DurTm='$durTm[$Idtx]' where Hospital_ID like '$datesID[$Idtx]'";
	$Recordset1 = mysql_query($queryTime, $test) or die(mysql_error());
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
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);

?>



</html>

