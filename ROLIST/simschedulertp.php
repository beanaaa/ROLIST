<!-- 2016. 11. 4. Reject retired patient from ical hanbeanyoun -->

<!doctype html>
<meta charset="utf-8">

<style type="text/css">	  
body{
	    font-family: Arial;
}
p{
	    font-family: Arial;
}
td {
    padding: 0px;
	vertical-align: top;
}
th{
    border-bottom: 1px solid #ddd;
    font-family: Arial;
}
p{
	margin: 0;
	padding: 0;
}
</style>


<!-- <link rel="stylesheet" href="mainStyle.css"> -->

<style>
	 @media (min-width:1270px){

 .float-button {position: fixed;
 background-image: gray;
width: 43px;
height: 192px;
top: 0px;
left: 1120px;

-ms-transform: rotate(90deg);
-webkit-transform: rotate(90deg);
transform: rotate(90deg);

}

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
}
 @media (max-width:1270px){
 .float-button {position: fixed;
 background-image: gray;
width: 43px;
height: 192px;
bottom: 0px;
left: 180px;


}

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




}
</style>



<?php
	include("mainmenu.php");
?>










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

	$searchQ = $_POST['txt_search'];
// 	echo($searchQ);
	if(strlen($searchQ)>0){
		$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '$searchQ' or  PatientInfo.KorName like '$searchQ' or PatientInfo.FirstName like '$searchQ' or PatientInfo.SecondName like '$searchQ'";
	}
	else{
				$searchQuery = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where PatientInfo.Hospital_ID like '10101010101010101010'";

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
<?php
// 	include("mainmenu.php");
?>


<html lang="ko">
<head>
	<link rel="stylesheet" type="text/css" href="Calendar2.css">	
<!-- 	<meta http-equiv="refresh" content="600;url=index.php">  -->
	
	<title>RO Scheduler</title>




<?php 
include("configuration.php");

?>









</head>


<body>
<!-- Body starts here!!! -->


<script type="text/javascript">
var detail = 0;

function add_item(){
          // pre_set ? ?? ??? ???? ??..
          var div = document.createElement('div');
          div.innerHTML = document.getElementById('pre_set').innerHTML;
          document.getElementById('field').appendChild(div);
          detail = detail + 1;
        }

        function remove_item(obj){
            // obj.parentNode ? ???? ?? 
            document.getElementById('field').removeChild(obj.parentNode);

  // $(obj).parent().remove(); 
}
var detail = 0;


</script>
<?php 
	
	$todayMarker = date("d");
	$todayMonth = date('m');
	//echo $todayMarker;	
	
	$year = date('Y');
	$month = date('m');
	$month = $month + $week_post;
	
	if($month>12){
		$year = $year + 1;
		$month = $month % 12;
		
	}
	if($month<1){
		$year = $year - 1;
		$month = 12 - $month;
	}
    //echo $year;
	//echo $month;
	
	$time = strtotime($year.'-'.$month.'-01');
	list($tday,$sweek) = explode('-',date('t-w',$time));
	
	//echo $tday; // All day 
	//echo $sweek; // Start day 0~6
	$tweek = ceil(($tday + $sweek) /7); // # of Week
	$lweek = date('w',strtotime($year.'-'.$month.'-'.$tday)); //Final day
	
	
	?>
	
	
<!-- 	<font color=gray>Logged by <?php echo $uid;?></font> -->
	
<table width="960px" border="0" align="center" cellspacing="0">
		
</table>



<div class=float-button>

<table  width="960px" align="center" cellpadding="0" cellspacing="0">

<tr>
	<form name = "form110" id = "form110" method = "post" action ="simschedule.php">
			<th width="30px">
				<input  type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input class="btn button-update" style="font-size: 20px; font-weight: 400" type = "submit" name = "week_" id = "week_" value="<" />
			</th>
		</form>


	
	<th width="192px">
		
<p style="font-size: 35px; font-weight: bold; color: #888888;" valign = "top" align = "left"> 

	
	<?php 
		if ($month=="1"){
			echo "&nbsp JAN";
			} 
		if ($month=="2"){
			echo "&nbsp FEB";
			} 
		if ($month=="3"){
			echo "&nbsp MAR";
			} 
		if ($month=="4"){
			echo "&nbsp APR";
			} 
		if ($month=="5"){
			echo "&nbsp MAY";
			} 
		if ($month=="6"){
			echo "&nbsp JUN";
			} 
		if ($month=="7"){
			echo "&nbsp JUL";
			} 
		if ($month=="8"){
			echo "&nbsp AUG";
			} 
		if ($month=="9"){
			echo "&nbsp SEP";
			} 
		if ($month=="10"){
			echo "&nbsp OCT";
			} 
		if ($month=="11"){
			echo "&nbsp NOV";
			} 
		if ($month=="12"){
			echo "&nbsp DEC";
			} 
		
	?> 
	<?php echo $year; ?> 
	
	</p>
	
	</th>
	
	
<form name = "form111" id = "form111" method = "post" action ="simschedule.php">
			<th width="30px" align="left">			
				<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input class="btn button-update" style="font-size: 20px; font-weight: 400" type = "submit" name = "week_" id = "week_" value=">" />
			</th>
		</form>

	<th>
	</th>
</tr>
</table>
</div>

<table  width="960px" align="center" cellpadding="0" cellspacing="0">

	<p style="font-size: 12px; font-weight: bold; color: #000000;" valign = "top" align = "left"> 
	<tr>
		<th width="1px" align="right" style="font-size: 16px" ></th>
		<th class="calMain" width="192px" style="font-size: 16px" align="right">MON</th>
		<th class="calMain" width="192px" style="font-size: 16px" align="right">TUE</th>
		<th class="calMain" width="192px" style="font-size: 16px" align="right">WED</th>
		<th class="calMain" width="192px" style="font-size: 16px" align="right">THU</th>
		<th class="calMain" width="192px" style="font-size: 16px" align="right">FRI</th>
		<th width="1px" style="font-size: 16px" align="right"></th>
	</tr>
	</p>

	<?php 
		$today_date = date("$month/j/$year");
		$year_ = date('y');
		$day = date('d');
		$aa = $day - 1;
		$today_date = date("$month/j/$year", strtotime($today_date."-$aa days"));
		//echo $today_date;
		$k = 0;
		if($sweek==6){
			$k=$k+1;
			$tweek = $tweek-1;
			$sweek=0;	
		}
		//$k = 0;
		for($n=1;$n<=$tweek;$n++) { ?>
	<tr height = "120" weight = "150">
	<?php 
		if($i==0 || $i==6){$bgcolor='#FFFFFF';}
			
		for($i=0;$i<7;$i++){ ?>		
		<?php if($i>0 && $i<6 ){?>		
		
		<td class="calMain" align = "left" valign = "top" height = "120" weight ="150" bgcolor="<?php echo $bgcolor; ?>">
		<?php } else {?>			
		<td  align = "left" valign = "top" height = "120" weight ="150" bgcolor="<?php echo $bgcolor; ?>">
		<?php } ?>		























		
		<?php
// 			FIRST WEEK
			if($i==6 || $i==5){$bgcolor='#FFFFFF';}
			if($n%2==0 && ($i!=5 && $i!=6)){$bgcolor = '#FFFFFF';}
			if($n%2==1 && ($i!=5 && $i!=6)){$bgcolor = '#EEEEEE';}
			if($n==1 && $i>=$sweek && ($i==0 || $i==6)){$k=$k+1;}
			if($n==1 && $i>=$sweek && ($i!=0 && $i!=6)){
				$today_date1 =date("n/j/y", strtotime($today_date."+$k days"));
				

				
				
				$k = $k+1;
				
            if ($todayMarker == $k && $todayMonth == $month) {
	            echo("<div id='divToday'></div>");
	            
                echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            } else {
                echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            }
				
				$CT_query2 = sprintf("SELECT Hospital_ID, physician, Modality_var1 FROM TreatmentInfo where CT_Sim1 = '$today_date1' or CT_Sim2 = '$today_date1' or CT_Sim3 = '$today_date1'
				or CT_Sim4 = '$today_date1' or CT_Sim5 = '$today_date1' or CT_Sim6 = '$today_date1' or CT_Sim7 = '$today_date1'  ");								
				$query2_CT = mysql_query($CT_query2);	

				$j2 = mysql_num_rows($query2_CT);

				$CT_querySim1 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time1, TreatmentInfo.subsite, TreatmentInfo.CT_Ce1, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim1 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim2 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time2, TreatmentInfo.subsite, TreatmentInfo.CT_Ce2, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim2 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim3 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time3, TreatmentInfo.subsite, TreatmentInfo.CT_Ce3, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim3 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim4 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time4, TreatmentInfo.subsite, TreatmentInfo.CT_Ce4, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim4 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim5 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time5, TreatmentInfo.subsite, TreatmentInfo.CT_Ce5, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim5 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim6 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time6, TreatmentInfo.subsite, TreatmentInfo.CT_Ce6, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim6 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim7 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time7, TreatmentInfo.subsite, TreatmentInfo.CT_Ce7, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim7 = '$today_date1'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$n1 = mysql_num_rows($CT_querySim1);
				$n2 = mysql_num_rows($CT_querySim2);
				$n3 = mysql_num_rows($CT_querySim3);
				$n4 = mysql_num_rows($CT_querySim4);
				$n5 = mysql_num_rows($CT_querySim5);
				$n6 = mysql_num_rows($CT_querySim6);
				$n7 = mysql_num_rows($CT_querySim7);
				
// 				Array Initialization
				for($tId=0;$tId<12;$tId++){$timeTableTime[$tId]=0;}
				for($tId=0;$tId<12;$tId++){$timeTableCe[$tId]="NULL";}
				for($tId=0;$tId<12;$tId++){$timeTableID[$tId]="000000000";}
				for($tId=0;$tId<12;$tId++){$timeTablePhysician[$tId]="NULL";}

// 				Merge into single array
				$tableIdx = 0;
				for($tId = 0;$tId<$n1;$tId++){
					$orderIndex = mysql_result($CT_querySim1,$tId,"CT_Time1");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Time1"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Ce1"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"Hospital_ID");
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"physician"); 
						$timeTableCCRT[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"Modality_var1"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"subsite"); 
						$CTe[$tableIdx] = 1;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n2;$tId++){
					$orderIndex = mysql_result($CT_querySim2,$tId,"CT_Time2");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Time2"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Ce2"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"physician"); 
						$timeTableCCRT[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"Modality_var1"); 						
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"subsite"); 
						$CTe[$tableIdx] = 2;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n3;$tId++){
					$orderIndex = mysql_result($CT_querySim3,$tId,"CT_Time3");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Time3"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Ce3"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"physician"); 
						$timeTableCCRT[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"Modality_var1"); 						
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"subsite"); 
						$CTe[$tableIdx] = 3;						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n4;$tId++){
					$orderIndex = mysql_result($CT_querySim4,$tId,"CT_Time4");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Time4"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Ce4"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"physician"); 
						$timeTableCCRT[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"Modality_var1"); 						
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"subsite"); 
						$CTe[$tableIdx] = 4;

						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n5;$tId++){
					$orderIndex = mysql_result($CT_querySim5,$tId,"CT_Time5");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Time5"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Ce5"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"physician"); 
						$timeTableCCRT[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"Modality_var1"); 						
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"subsite"); 
						$CTe[$tableIdx] = 5;
						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n6;$tId++){
					$orderIndex = mysql_result($CT_querySim6,$tId,"CT_Time6");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Time6"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Ce6"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"subsite"); 
						$CTe[$tableIdx] = 6;
						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n7;$tId++){
					$orderIndex = mysql_result($CT_querySim7,$tId,"CT_Time7");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Time7"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Ce7"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"subsite"); 
						$CTe[$tableIdx] = 7;
						
						$tableIdx++;
						}
				}
				
// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$scheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$scheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$scheduledPhysician[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledSite[$tId]="NULL";}

				$j2 = mysql_num_rows($query2_CT);

// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$unscheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$unscheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$unscheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$unscheduledSite[$tId]="NULL";}
				
//				 				
				for($tId=0;$tId<9;$tId++){
					if($timeTableTime[$tId]!=0){
						$scheduledId[$timeTableTime[$tId]] = $timeTableID[$tId];
						$scheduledCe[$timeTableTime[$tId]] = $timeTableCe[$tId];
						$scheduledPhysician[$timeTableTime[$tId]] = $timeTablePhysician[$tId];
						$scheduledCCRT[$timeTableTime[$tId]] = $timeTableCCRT[$tId];
						$scheduledTime[$timeTableTime[$tId]] = $timeTableTime[$tId];					
						$scheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];					
						$scheduledNew[$timeTableTime[$tId]] = $CTe[$tId];					
					}
				}

				$blankInd = 0;
				for($tId=0;$tId<$j2;$tId++){
					if($timeTableTime[$tId]==0){
						$unscheduledId[$blankInd] = $timeTableID[$tId];
						$unscheduledCe[$blankInd] = $timeTableCe[$tId];
						$unscheduledPhysician[$blankInd] = $timeTablePhysician[$tId];
						$unscheduledTime[$blankInd] = $timeTableTime[$tId];	
						$unscheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];					
						$blankInd++;					
					}
				}
												
				$timeTable[1] = "08:40";$timeTable[2] = "09:30";$timeTable[3] = "10:20";$timeTable[4] = "11:10";
				$timeTable[5] = "13:30";$timeTable[6] = "14:20";$timeTable[7] = "15:10";$timeTable[8] = "16:00"; 				
				
				if($j2!=0){
// 				echo "<br />\n";				
				}
				echo("<br>");


				$totRows = 0;
				for($idn = 0; $idn<count($phyInt);$idn++){
					$AbsenceQuery = "Select * from MdAbsence where physician like '$phyInt[$idn]' and date1 like '$today_date1'";
					$abss = mysql_query($AbsenceQuery);		
					$Abs[$idn] = mysql_num_rows($abss);
					$totRows = $totRows+mysql_num_rows($abss);			
				}
				

				if($totRows !=0){ 
					echo "<table cellpadding='2' cellspacing='0'>";				
					echo("<tr>");
					
					for($idAbs=0;$idAbs<count($phyInt);$idAbs++){
						if($Abs[$idAbs] !=0){ 
						 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $phyCol[$idAbs]><p align=center>$phyInt[$idAbs]</p></th>";														 
						 echo("</th>");
						
						}
				
					}
				 
				 echo("</tr>");
				 echo "</table>";				

				 }



				echo "<p align=left><font size=2 color=gray><strong>SIMULATION</strong></font></p>";
			
				echo("<hr>");
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 for($jj=1;$jj<9;$jj++){	 	
					 if($scheduledTime[$jj]!=0){
						$query1_CT_ID = $scheduledId[$jj];
						
						$query1_CT_phy = $scheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Inp, Secondname FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);

						$CT_simEmr = sprintf("SELECT SimOrderEmr FROM ClinicalInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_simEmr = mysql_query($CT_simEmr);

						$CT_simCCRT = sprintf("SELECT Modality_var1 FROM TreatmentInfo WHERE Hospital_ID like '$query1_CT_ID'");
						$query1_simCCRT = mysql_query($CT_simCCRT);
						$query1_fSimCCRT = mysql_result($query1_simCCRT,0,"Modality_var1");
						if(strlen(trim($query1_fSimCCRT))>0){
							$CCRT = "CCRT";
						}
						else{
							$CCRT = "";							
						}
							
						$query1_fSimEmr = mysql_result($query1_simEmr,0,"SimOrderEmr");

						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_Inp = mysql_result($query1_Name,0,"Inp");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");
						$ce = $scheduledCe[$jj];
						if(strcmp($ce,"CE")==0){
							$ce = "<font color=red><strong>".$ce."</strong></font>";
						}
						$site = $scheduledSite[$jj];
// 						echo($query1_fSimCCRT);
						
						if(strcmp($scheduledNew[$jj],"1")==0){
							$newSum = " N";
						}
						else{
							$newSum = "";
						}

						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$physician = $physician.$newSum;
								$cellclr = $phyCol[$phyidss];

							}	
						}
						

						if(strcmp($query1_Inp, "외래")==0){
								$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
								}
						else{
							$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
							}
    
    									
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$timeTable[$jj]<br> $physician</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>$query1_CT_ID<br><font color=$fontColorInp>$query1_Inp</font> &nbsp <font color=red><strong>$CCRT</strong></font></p></th>";				
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$physician</th>";
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$nbsp</th>";


					$siteName = $site;
					if(strlen($site)>8){
						$siteName = substr($site,0,8)."...";
					}


						echo "<th width = 90px><p align=left>$query1_fName $ce <br>$siteName </p></th>";
						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date1 />";						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form>
						
						</th>";
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray></font></p></th>";										
				        
				        echo "</tr>";
			        }
			        else{
															

						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=left rowspan='1'><p align=left>$timeTable[$jj]<br> &nbsp;</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>&nbsp;<br><font color=$fontColorInp>&nbsp;</font> &nbsp <font color=red><strong>&nbsp;</strong></font></p></th>";				
						echo "<th width = 90px><p align=left>&nbsp; <br>&nbsp; </p></th>";
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray>&nbsp;</font></p></th>";										
				        
				        echo "</tr>";
			        }
				}
				echo "</table>";


				echo "<br>";	
							
				$numUn = 0;				
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
					 					$numUn++;				

			        }
				}				


				if($numUn!=0){ 	
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
						$query1_CT_ID = $unscheduledId[$jj];
						
						$query1_CT_phy = $unscheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Secondname, KorName FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);
	
						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");
						


						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


						
															
						echo "<tr>";									
						echo "<th align='left'>$jj</th>";							
						echo "<th align='left'>$query1_CT_ID</th>";				
						echo "<th align=left bgcolor = $cellclr>$physician</th>";
						echo "<th align=left>$query1_fName </th>";
						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date1 />";						
						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form></th>";
	
				        echo "</tr>";
			        }
				}
				echo "</table>";			
				
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>START</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') ) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$mds<br> $rowOrders[Linac1]</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";	
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";
					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";					
				
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>PLAN CHANGE</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				( 
 				 STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') or 								
 				 STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start7, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}

// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";					
				

				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>FINISH</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
						
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";			
			
			}												


			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
// 			FROM SECOND BEFORE LAST WEEK
			if(1<$n && $n<$tweek && ($i==0 || $i==6)){$k=$k+1;}
			if(1<$n && $n<$tweek && ($i!=0 && $i!=6)){
				$today_date2 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k + 1;
// 				To mark today to red 
            if ($todayMarker == $k && $todayMonth == $month) {
	            echo("<div id='divToday'></div>");
	            
                echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            } else {
                echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            }
				
// 									This is for CT simulation
				$CT_query2 = sprintf("SELECT Hospital_ID, physician FROM TreatmentInfo where CT_Sim1 = '$today_date2' or CT_Sim2 = '$today_date2' or CT_Sim3 = '$today_date2'
				or CT_Sim4 = '$today_date2' or CT_Sim5 = '$today_date2' or CT_Sim6 = '$today_date2' or CT_Sim7 = '$today_date2'  ");								
				$query2_CT = mysql_query($CT_query2);	

				$j2 = mysql_num_rows($query2_CT);
				$CT_querySim1 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time1, TreatmentInfo.subsite, TreatmentInfo.CT_Ce1, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim1 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim2 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time2, TreatmentInfo.subsite, TreatmentInfo.CT_Ce2, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim2 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim3 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time3, TreatmentInfo.subsite, TreatmentInfo.CT_Ce3, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim3 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim4 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time4, TreatmentInfo.subsite, TreatmentInfo.CT_Ce4, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim4 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim5 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time5, TreatmentInfo.subsite, TreatmentInfo.CT_Ce5, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim5 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim6 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time6, TreatmentInfo.subsite, TreatmentInfo.CT_Ce6, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim6 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim7 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time7, TreatmentInfo.subsite, TreatmentInfo.CT_Ce7, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim7 = '$today_date2'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$n1 = mysql_num_rows($CT_querySim1);
				$n2 = mysql_num_rows($CT_querySim2);
				$n3 = mysql_num_rows($CT_querySim3);
				$n4 = mysql_num_rows($CT_querySim4);
				$n5 = mysql_num_rows($CT_querySim5);
				$n6 = mysql_num_rows($CT_querySim6);
				$n7 = mysql_num_rows($CT_querySim7);
				
// 				Array Initialization
				for($tId=0;$tId<12;$tId++){$timeTableTime[$tId]=0;}
				for($tId=0;$tId<12;$tId++){$timeTableCe[$tId]="NULL";}
				for($tId=0;$tId<12;$tId++){$timeTableID[$tId]="000000000";}
				for($tId=0;$tId<12;$tId++){$timeTablePhysician[$tId]="NULL";}

// 				Merge into single array
				$tableIdx = 0;
				for($tId = 0;$tId<$n1;$tId++){
					$orderIndex = mysql_result($CT_querySim1,$tId,"CT_Time1");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Time1"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Ce1"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"Hospital_ID");
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"subsite"); 
						$CTe[$tableIdx] = 1;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n2;$tId++){
					$orderIndex = mysql_result($CT_querySim2,$tId,"CT_Time2");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Time2"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Ce2"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"subsite"); 
						$CTe[$tableIdx] = 2;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n3;$tId++){
					$orderIndex = mysql_result($CT_querySim3,$tId,"CT_Time3");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Time3"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Ce3"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"subsite"); 
						$CTe[$tableIdx] = 3;						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n4;$tId++){
					$orderIndex = mysql_result($CT_querySim4,$tId,"CT_Time4");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Time4"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Ce4"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"subsite"); 
						$CTe[$tableIdx] = 4;

						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n5;$tId++){
					$orderIndex = mysql_result($CT_querySim5,$tId,"CT_Time5");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Time5"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Ce5"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"subsite"); 
						$CTe[$tableIdx] = 5;
						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n6;$tId++){
					$orderIndex = mysql_result($CT_querySim6,$tId,"CT_Time6");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Time6"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Ce6"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"physician"); $tableIdx++;
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"subsite"); 
						
						}
				}
				for($tId = 0;$tId<$n7;$tId++){
					$orderIndex = mysql_result($CT_querySim7,$tId,"CT_Time7");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Time7"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Ce7"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"physician"); $tableIdx++;
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"subsite"); 
						
						}
				}
				
// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$scheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$scheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$scheduledPhysician[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledSite[$tId]="NULL";}

				$j2 = mysql_num_rows($query2_CT);

// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$unscheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$unscheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$unscheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$unscheduledSite[$tId]="NULL";}
				
//				 				
				for($tId=0;$tId<9;$tId++){
					if($timeTableTime[$tId]!=0){
						$scheduledId[$timeTableTime[$tId]] = $timeTableID[$tId];
						$scheduledCe[$timeTableTime[$tId]] = $timeTableCe[$tId];
						$scheduledPhysician[$timeTableTime[$tId]] = $timeTablePhysician[$tId];
						$scheduledTime[$timeTableTime[$tId]] = $timeTableTime[$tId];					
						$scheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];
						$scheduledNew[$timeTableTime[$tId]] = $CTe[$tId];
// 						$scheduledNew											
					}
				}

				$blankInd = 0;
				for($tId=0;$tId<$j2;$tId++){
					if($timeTableTime[$tId]==0){
						$unscheduledId[$blankInd] = $timeTableID[$tId];
						$unscheduledCe[$blankInd] = $timeTableCe[$tId];
						$unscheduledPhysician[$blankInd] = $timeTablePhysician[$tId];
						$unscheduledTime[$blankInd] = $timeTableTime[$tId];	
						$unscheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];					
						$blankInd++;					
					}
				}
												
				$timeTable[1] = "08:40";$timeTable[2] = "09:30";$timeTable[3] = "10:20";$timeTable[4] = "11:10";
				$timeTable[5] = "13:30";$timeTable[6] = "14:20";$timeTable[7] = "15:10";$timeTable[8] = "16:00"; 				
				
				if($j2!=0){
// 				echo "<br />\n";				
				}
				echo("<br>");
				
				$totRows = 0;
				for($idn = 0; $idn<count($phyInt);$idn++){
					$AbsenceQuery = "Select * from MdAbsence where physician like '$phyInt[$idn]' and date1 like '$today_date2'";
					$abss = mysql_query($AbsenceQuery);		
					$Abs[$idn] = mysql_num_rows($abss);
					$totRows = $totRows+mysql_num_rows($abss);			
				}
				

				if($totRows !=0){ 
					echo "<table cellpadding='2' cellspacing='0'>";				
					echo("<tr>");
					
					for($idAbs=0;$idAbs<count($phyInt);$idAbs++){
						if($Abs[$idAbs] !=0){ 
						 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $phyCol[$idAbs]><p align=center>$phyInt[$idAbs]</p></th>";														 
						 echo("</th>");
						
						}
				
					}
				 
				 echo("</tr>");
				 echo "</table>";				

				 }



				
				
				echo "<p align=left><font size=2 color=gray><strong>SIMULATION</strong></font></p>";
			
				echo("<hr>");
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 for($jj=1;$jj<9;$jj++){	 	
					 if($scheduledTime[$jj]!=0){
						$query1_CT_ID = $scheduledId[$jj];
						
						$query1_CT_phy = $scheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Inp, Secondname FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);

						$CT_simEmr = sprintf("SELECT SimOrderEmr FROM ClinicalInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_simEmr = mysql_query($CT_simEmr);
							$CT_simCCRT = sprintf("SELECT Modality_var1 FROM TreatmentInfo WHERE Hospital_ID like '$query1_CT_ID'");
						$query1_simCCRT = mysql_query($CT_simCCRT);
						$query1_fSimCCRT = mysql_result($query1_simCCRT,0,"Modality_var1");
						if(strlen(trim($query1_fSimCCRT))>0){
							$CCRT = "CCRT";
						}
						else{
							$CCRT = "";							
						}

	
	
	
						$query1_fSimEmr = mysql_result($query1_simEmr,0,"SimOrderEmr");
						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_Inp = mysql_result($query1_Name,0,"Inp");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");
						$ce = $scheduledCe[$jj];
						if(strcmp($ce,"CE")==0){
							$ce = "<font color=red><strong>".$ce."</strong></font>";
						}
						$site = $scheduledSite[$jj];
						
						if(strcmp($scheduledNew[$jj],"1")==0){
							$newSum = " N";
						}
						else{
							$newSum = "";
						}

						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$physician = $physician.$newSum;
								$cellclr = $phyCol[$phyidss];

							}	
						}
						
						if(strcmp($query1_Inp, "외래")==0){
								$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
								}
						else{
							$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
							}
    
    									
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$timeTable[$jj]<br> $physician</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>$query1_CT_ID<br><font color=$fontColorInp>$query1_Inp</font> &nbsp <font color=red><strong>$CCRT</strong></font></p></th>";				
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$physician</th>";
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$nbsp</th>";
											$siteName = $site;
					if(strlen($site)>8){
						$siteName = substr($site,0,8)."...";
					}


						echo "<th width = 90px><p align=left>$query1_fName $ce <br>$siteName </p></th>";

						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date2 />";						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form>
						
						</th>";
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray></font>&nbsp;</p></th>";										
				        
				        echo "</tr>";
			        }
			        else{
															

						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=left rowspan='1'><p align=left>$timeTable[$jj]<br> &nbsp;</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>&nbsp;<br><font color=$fontColorInp>&nbsp;</font> &nbsp <font color=red><strong>&nbsp;</strong></font></p></th>";				
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$physician</th>";
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$nbsp</th>";
						echo "<th width = 90px><p align=left>&nbsp; <br>&nbsp; </p></th>";
						
	// 					Generate Edit button 
/*
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date1 />";						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form>
						
						</th>";
*/
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray>&nbsp;</font></p></th>";										
				        
				        echo "</tr>";
			        }
				}
				echo "</table>";


				echo "<br>";	
							
				$numUn = 0;				
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
					 					$numUn++;				

			        }
				}				


				if($numUn!=0){ 	
				echo("<br>");					
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
						$query1_CT_ID = $unscheduledId[$jj];
						
						$query1_CT_phy = $unscheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Secondname, KorName FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);
	
						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");

						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}
						

															
						echo "<tr>";									
						echo "<th align='left'>$jj</th>";							
						echo "<th align='left'>$query1_CT_ID</th>";				
						echo "<th align=left bgcolor = $cellclr>$physician</th>";
						echo "<th align=left>$query1_fName </th>";
						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date2 />";						
						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form></th>";
	
				        echo "</tr>";
			        }
				}
				echo "</table>";			
				
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>START</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') ) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);





						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}





// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$mds<br> $rowOrders[Linac1]</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";						echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>PLAN CHANGE</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				( 
 				 STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') or 								
 				 STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start7, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}




// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";					
				

				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>FINISH</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}




// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";			
				
				
				
				
				
				
				
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
// 			For last week
			if($n==$tweek && $i<=$lweek && ($i==0 || $i==6)){$k=$k+1;}
			if($n==$tweek && $i<=$lweek && ($i!=0 && $i!=6)){
				$today_date3 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k + 1;
				
            if ($todayMarker == $k && $todayMonth == $month) {
	            echo("<div id='divToday'></div>");
	            
                echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            } else {
                echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
                echo "<br />\n";
            }
				
// 									This is for CT simulation
				$CT_query2 = sprintf("SELECT Hospital_ID, physician FROM TreatmentInfo where CT_Sim1 = '$today_date3' or CT_Sim2 = '$today_date3' or CT_Sim3 = '$today_date3'
				or CT_Sim4 = '$today_date3' or CT_Sim5 = '$today_date3' or CT_Sim6 = '$today_date3' or CT_Sim7 = '$today_date3'  ");								
				$query2_CT = mysql_query($CT_query2);	
				
				$j2 = mysql_num_rows($query2_CT);
				$CT_querySim1 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time1, TreatmentInfo.subsite, TreatmentInfo.CT_Ce1, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim1 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim2 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time2, TreatmentInfo.subsite, TreatmentInfo.CT_Ce2, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim2 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim3 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time3, TreatmentInfo.subsite, TreatmentInfo.CT_Ce3, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim3 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim4 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time4, TreatmentInfo.subsite, TreatmentInfo.CT_Ce4, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim4 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim5 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time5, TreatmentInfo.subsite, TreatmentInfo.CT_Ce5, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim5 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim6 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time6, TreatmentInfo.subsite, TreatmentInfo.CT_Ce6, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim6 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$CT_querySim7 = mysql_query(sprintf("SELECT TreatmentInfo.Hospital_ID, TreatmentInfo.physician, TreatmentInfo.CT_Time7, TreatmentInfo.subsite, TreatmentInfo.CT_Ce7, PatientInfo.CurrentStatus from PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where (CT_Sim7 = '$today_date3'  AND (PatientInfo.CurrentStatus like 0 OR PatientInfo.CurrentStatus is NULL))"));
				$n1 = mysql_num_rows($CT_querySim1);
				$n2 = mysql_num_rows($CT_querySim2);
				$n3 = mysql_num_rows($CT_querySim3);
				$n4 = mysql_num_rows($CT_querySim4);
				$n5 = mysql_num_rows($CT_querySim5);
				$n6 = mysql_num_rows($CT_querySim6);
				$n7 = mysql_num_rows($CT_querySim7);
				
// 				Array Initialization
				for($tId=0;$tId<12;$tId++){$timeTableTime[$tId]=0;}
				for($tId=0;$tId<12;$tId++){$timeTableCe[$tId]="NULL";}
				for($tId=0;$tId<12;$tId++){$timeTableID[$tId]="000000000";}
				for($tId=0;$tId<12;$tId++){$timeTablePhysician[$tId]="NULL";}

// 				Merge into single array
				$tableIdx = 0;
				for($tId = 0;$tId<$n1;$tId++){
					$orderIndex = mysql_result($CT_querySim1,$tId,"CT_Time1");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Time1"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"CT_Ce1"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"Hospital_ID");
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim1,$tId,"physician"); 
						$timeTableSite[$tableIdx] 		= mysql_result($CT_querySim1,$tId,"subsite"); 
						$CTe[$tableIdx] = 1;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n2;$tId++){
					$orderIndex = mysql_result($CT_querySim2,$tId,"CT_Time2");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Time2"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"CT_Ce2"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim2,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim2,$tId,"subsite"); 
						$CTe[$tableIdx] = 2;
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n3;$tId++){
					$orderIndex = mysql_result($CT_querySim3,$tId,"CT_Time3");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Time3"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"CT_Ce3"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim3,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim3,$tId,"subsite"); 
						$CTe[$tableIdx] = 3;						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n4;$tId++){
					$orderIndex = mysql_result($CT_querySim4,$tId,"CT_Time4");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Time4"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"CT_Ce4"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim4,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim4,$tId,"subsite"); 
						$CTe[$tableIdx] = 4;

						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n5;$tId++){
					$orderIndex = mysql_result($CT_querySim5,$tId,"CT_Time5");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Time5"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"CT_Ce5"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim5,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"physician"); 
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim5,$tId,"subsite"); 
						$CTe[$tableIdx] = 5;
						
						$tableIdx++;
						}
				}
				for($tId = 0;$tId<$n6;$tId++){
					$orderIndex = mysql_result($CT_querySim6,$tId,"CT_Time6");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Time6"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"CT_Ce6"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim6,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"physician"); $tableIdx++;
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim6,$tId,"subsite"); 
						
						}
				}
				for($tId = 0;$tId<$n7;$tId++){
					$orderIndex = mysql_result($CT_querySim7,$tId,"CT_Time7");			
					if($orderIndex != "NULL"){ 							
						$timeTableTime[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Time7"); 
						$timeTableCe[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"CT_Ce7"); 
						$timeTableID[$tableIdx] 		= mysql_result($CT_querySim7,$tId,"Hospital_ID"); 
						$timeTablePhysician[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"physician"); $tableIdx++;
						$timeTableSite[$tableIdx] 	= mysql_result($CT_querySim7,$tId,"subsite"); 
						
						}
				}
				
// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$scheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$scheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$scheduledPhysician[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$scheduledSite[$tId]="NULL";}

				$j2 = mysql_num_rows($query2_CT);

// 				Initialization: Resorting scheduled simulations										
				for($tId=0;$tId<20;$tId++){$unscheduledTime[$tId]=0;}
				for($tId=0;$tId<20;$tId++){$unscheduledCe[$tId]="NULL";}
				for($tId=0;$tId<20;$tId++){$unscheduledId[$tId]="000000000";}
				for($tId=0;$tId<20;$tId++){$unscheduledSite[$tId]="NULL";}
				
//				 				
				for($tId=0;$tId<9;$tId++){
					if($timeTableTime[$tId]!=0){
						$scheduledId[$timeTableTime[$tId]] = $timeTableID[$tId];
						$scheduledCe[$timeTableTime[$tId]] = $timeTableCe[$tId];
						$scheduledPhysician[$timeTableTime[$tId]] = $timeTablePhysician[$tId];
						$scheduledTime[$timeTableTime[$tId]] = $timeTableTime[$tId];					
						$scheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];					
						$scheduledNew[$timeTableTime[$tId]] = $CTe[$tId];					
					}
				}

				$blankInd = 0;
				for($tId=0;$tId<$j2;$tId++){
					if($timeTableTime[$tId]==0){
						$unscheduledId[$blankInd] = $timeTableID[$tId];
						$unscheduledCe[$blankInd] = $timeTableCe[$tId];
						$unscheduledNew[$blankInd] = $CTe[$tId];
						$unscheduledPhysician[$blankInd] = $timeTablePhysician[$tId];
						$unscheduledTime[$blankInd] = $timeTableTime[$tId];	
						$unscheduledSite[$timeTableTime[$tId]] = $timeTableSite[$tId];					
						$blankInd++;					
					}
				}
												
				$timeTable[1] = "08:40";$timeTable[2] = "09:30";$timeTable[3] = "10:20";$timeTable[4] = "11:10";
				$timeTable[5] = "13:30";$timeTable[6] = "14:20";$timeTable[7] = "15:10";$timeTable[8] = "16:00"; 				
				
				if($j2!=0){
// 				echo "<br />\n";				
				}
				echo("<br>");
				$totRows = 0;
				for($idn = 0; $idn<count($phyInt);$idn++){
					$AbsenceQuery = "Select * from MdAbsence where physician like '$phyInt[$idn]' and date1 like '$today_date3'";
					$abss = mysql_query($AbsenceQuery);		
					$Abs[$idn] = mysql_num_rows($abss);
					$totRows = $totRows+mysql_num_rows($abss);			
				}
				

				if($totRows !=0){ 
					echo "<table cellpadding='2' cellspacing='0'>";				
					echo("<tr>");
					
					for($idAbs=0;$idAbs<count($phyInt);$idAbs++){
						if($Abs[$idAbs] !=0){ 
						 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $phyCol[$idAbs]><p align=center>$phyInt[$idAbs]</p></th>";														 
						 echo("</th>");
						
						}
				
					}
				 
				 echo("</tr>");
				 echo "</table>";				

				 }




				
				echo "<p align=left><font size=2 color=gray><strong>SIMULATION</strong></font></p>";
			
				echo("<hr>");
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 for($jj=1;$jj<9;$jj++){	 	
					 if($scheduledTime[$jj]!=0){
						$query1_CT_ID = $scheduledId[$jj];
						
						

						$query1_CT_phy = $scheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Inp, Secondname FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);

						$CT_simEmr = sprintf("SELECT SimOrderEmr FROM ClinicalInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_simEmr = mysql_query($CT_simEmr);
	
						$query1_fSimEmr = mysql_result($query1_simEmr,0,"SimOrderEmr");
						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_Inp = mysql_result($query1_Name,0,"Inp");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");
						$ce = $scheduledCe[$jj];
						if(strcmp($ce,"CE")==0){
							$ce = "<font color=red><strong>".$ce."</strong></font>";
						}
						$site = $scheduledSite[$jj];
						$CT_simCCRT = sprintf("SELECT Modality_var1 FROM TreatmentInfo WHERE Hospital_ID like '$query1_CT_ID'");
						$query1_simCCRT = mysql_query($CT_simCCRT);
						$query1_fSimCCRT = mysql_result($query1_simCCRT,0,"Modality_var1");
						if(strlen(trim($query1_fSimCCRT))>0){
							$CCRT = "CCRT";
						}
						else{
							$CCRT = "";							
						}


						if(strcmp($scheduledNew[$jj],"1")==0){
							$newSum = " N";
						}
						else{
							$newSum = "";
						}

						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$physician = $physician.$newSum;
								$cellclr = $phyCol[$phyidss];

							}	
						}

						if(strcmp($query1_Inp, "외래")==0){
								$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
								}
						else{
							$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
							}
    
    									
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$timeTable[$jj]<br> $physician</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>$query1_CT_ID<br><font color=$fontColorInp>$query1_Inp</font> &nbsp <font color=red><strong>$CCRT</strong></font></p></th>";				
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$physician</th>";
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$nbsp</th>";
											$siteName = $site;
					if(strlen($site)>8){
						$siteName = substr($site,0,8)."...";
					}


						echo "<th width = 90px><p align=left>$query1_fName $ce <br>$site </p></th>";

						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form>
						
						</th>";
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray> </font></p></th>";										
				        
				        echo "</tr>";
			        }
			        else{
															

						echo "<tr>";
						echo "<th  rowspan=2 width = 30px align=left rowspan='1'><p align=left>$timeTable[$jj]<br> &nbsp;</p></th>";										
						echo "<th width = 40px rowspan='1'><p align=left>&nbsp;<br><font color=$fontColorInp>&nbsp;</font> &nbsp <font color=red><strong>&nbsp;</strong></font></p></th>";				
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$physician</th>";
// 						echo "<th rowspan='1'align=left bgcolor = $cellclr>$nbsp</th>";
						echo "<th width = 90px><p align=left>&nbsp; <br>&nbsp; </p></th>";
						
	// 					Generate Edit button 
/*
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date1 />";						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form>
						
						</th>";
*/
				        echo "</tr>";
				        echo "<tr>";
						echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray>&nbsp;</font></p></th>";										
				        
				        echo "</tr>";
			        }
				}
				echo "</table>";


				echo "<br>";	
							
				$numUn = 0;				
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
					 					$numUn++;				

			        }
				}				


				if($numUn!=0){ 	
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				for($jj=0;$jj<20;$jj++){	 	
					 if(strcmp($unscheduledId[$jj],"000000000")!=0 AND strcmp($unscheduledId[$jj],"")!=0){
						$query1_CT_ID = $unscheduledId[$jj];
						
						$query1_CT_phy = $unscheduledPhysician[$jj];
						$CT_queryName = sprintf("SELECT KorName, Secondname, KorName FROM PatientInfo WHERE Hospital_ID = '$query1_CT_ID'");
						$query1_Name = mysql_query($CT_queryName);
	
						$query1_fName = mysql_result($query1_Name,0,"KorName");
						$query1_sName = mysql_result($query1_Name,0,"Secondname");
						
						
						$physician = $query1_CT_phy;
						$cellclr = "#FFFFFF";

						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_CT_phy),$phyIdd[$phyidss])==0){
								$physician = $phyInt[$phyidss];
								$physician = $physician.$newSum;
								$cellclr = $phyCol[$phyidss];

							}	
						}														
						echo "<tr>";									
						echo "<th align='left'>$jj</th>";							
						echo "<th align='left'>$query1_CT_ID</th>";				
						echo "<th align=left bgcolor = $cellclr>$physician</th>";
						echo "<th align=left>$query1_fName </th>";
						
	// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
						echo "<input type=submit name=btn_edit id=btn_edit value=E />";
						echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
						echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
						
						echo "<input name=hf_edit type=hidden id=hf_edit value= $query1_CT_ID /> </form></th>";
	
				        echo "</tr>";
			        }
				}
				echo "</table>";			
				
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>START</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$mds<br> $rowOrders[Linac1]</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}
				echo "</table>";					
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>PLAN CHANGE</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				( 
 				 STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y') or 								
 				 STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y') or 
				 STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y') or 											
				 STR_TO_DATE(TreatmentInfo.RT_start7, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
							$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}
				echo "</table>";				
				
				
				echo("<br>");
				echo "<p align=left><font size=2 color=gray><strong>FINISH</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM PatientInfo join TreatmentInfo on PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where  
				(STR_TO_DATE(TreatmentInfo.RT_fin_f, '%m/%d/%Y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y')) AND 
				 (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=4 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL)";
				
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);
					
						$mds = $rowOrders[physician];
						$cellclr = "#FFFFFF";
						
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($rowOrders[physician]),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


// 					print_r($rowOrders);

					if(strcmp($rowOrders[InP], "외래")==0){
							$fontColorInp = "#3151b7"; /* ultramarine 60 (ibm design colors) */
							}
					else{
						$fontColorInp = "#aa231f"; /* red 60 (ibm design colors) */
						}


					if(strlen(trim($rowOrders[Modality_var1]))>0){
						$CCRT = "CCRT";
					}
					else{
						$CCRT = "";							
					}
					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID]<br><font color=$fontColorInp>$rowOrders[InP]</font> </p></th>";				
					$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
										$siteName = $rowOrders[subsite];
					if(strlen($rowOrders[subsite])>8){
						$siteName = substr($rowOrders[subsite],0,8)."...";
					}
					echo "<th width = 90px><p align=left>$rowOrders[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br>$siteName </p></th>";

					
// 					Generate Edit button 
						if(strcmp($uid,"NURSE")==0){ 
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
						}
						else{
						echo "<th width = 10px align=left>
						<form id=form3 name=form3 method=post target=_blank action= N_edit_all.php>";
							
						}
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[NurseNote]</font></p></th>";										
			        
			        echo "</tr>";																		
				}
				echo "</table>";							
				
		

			}
			 ?>
		</td>			

	<?php } ?>
	</tr>
	<?php } ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
</table>


</br>
<hr>
</br>
	<script type='text/javascript' src='js/jquery.min.js'></script><script>window.onload=function(){var offset = $('#divToday').offset();$('html,body').animate({scrollTop : offset.top}, 400);}</script>

<body>
	
</html>