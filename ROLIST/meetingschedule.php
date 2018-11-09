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
input[type=submit].selector {
	padding: 3px 4px;
    border: none; /* Green */	

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;}	

</style>

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
	elseif(strcmp($md2,"JJ")==0){
		$md = "JJ";		
	}
	elseif(strcmp($uid,"KI")==0){
		$md = "myki";		
	}
	elseif(strcmp($uid,"JJ")==0){
		$md = "JJ";		
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
	<link rel="stylesheet" type="text/css" href="Calendar2.css">	
<!-- 	<meta http-equiv="refresh" content="600;url=index.php">  -->
	
	<title>Exam scheduler</title>

	<link type="text/css" rel="stylesheet" href="modalLayer.css" />
	<script type="text/javascript" src="js/jquery-latest.min.js"></script>
	<script type="text/javascript" src="jquery.modalLayer.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
    $('.open_modal').modalLayer();
  	});
  	</script>

  	<meta charset="utf-8">
  	<script src="js/jquery-1.11.0.min.js"></script>
  	<script>
  	$( document ).ready( function() {
    var jbOffset = $( '.jq_menu' ).offset();
    $( window ).scroll( function() {
      if ( $( document ).scrollTop() > jbOffset.top ) {
        $( '.jq_menu' ).addClass( 'jq_fixed' );
      }
      else {
        $( '.jq_menu' ).removeClass( 'jq_fixed' );
      }
    });
  } );
  </script>



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
	
	
	
<table width="1200px" border="0" align="center" cellspacing="0">
<form></form>
	<form name = "form110" id = "form110" method = "post" action ="meetingschedule.php">
				<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input class="selector" type = "submit" name = "week_" style="width: 50px; height: 20px; border-color:#c0bfc0;  background-color: #c0bfc0" id = "week_" value="<" />
		</form>
&nbsp;
<form></form>

	<form id=form11 name=form11 method=post action="meetingschedule.php">
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class="selector" type='submit' name="mdname" value="Total"  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />			
			<input type = hidden name = plname id = plname value = <?php echo $pl2; ?> />								
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
	</form>

	<?php
	$md = $_POST['mdname'];	
	$queryMD = "";
	for($nums = 0; $nums<$numphyss;$nums++){ 
	
		if(strcmp($md, $phyInt[$nums])==0){
			$titleMd = $phyInt[$nums];
			$md = $phyIdd[$nums];
			$queryMD = "(TreatmentInfo.physician LIKE '$md') AND ";
	
		}
	}

	
	
	?>


	<?php for($idphys = 0; $idphys<$numphyss; $idphys++){
		
		if((strlen($titleMd)!=0 and strcmp($titleMd,$phyInt[$idphys])==0) or strlen($titleMd)==0){
			$bgcols = $phyCol[$idphys];
		}		
		else{
			$bgcols = "#c0bfc0"; /* gray 20 (ibm design colors) */
		}
		
	?>
	
	<form id=form11 name=form11 method=post action="meetingschedule.php">
			<input type = hidden name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
			<input class="selector" type='submit' name="mdname" value=<?php echo $phyInt[$idphys]; ?>  style="width: 50px; height: 20px; border-color:<?php echo $bgcols;?>;  background-color: <?php echo $bgcols;?>"></input>		
			<input type = hidden name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
			<input type = hidden name = username id = username value = <?php echo $uid; ?> />			
			<input type = hidden name = plname id = plname value = <?php echo $pl2; ?> />								
			<input type = hidden name = sitename id = sitename value = <?php echo $siteInput; ?> />				
			<input type = hidden name = curpage id = curpage value = "daily_report.php" />				
	</form>

	<?php }	?>


&nbsp;

<form name = "form111" id = "form111" method = "post" action ="meetingschedule.php">
				<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input class="selector" type = "submit" name = "week_" style="width: 50px; height: 20px; border-color:#c0bfc0;  background-color: #c0bfc0"  id = "week_" value=">" />
		</form>
		
</table>




	
<table  width="1200px" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td>
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
	
	</td>
</tr>
</table>


<table  width="1200px" align="center" cellpadding="0" cellspacing="0">

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
				$today_date2 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k+1;
				
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>"; echo "<br />\n";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>"; echo "<br />\n";					
				}
				
				
				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (CHAR_LENGTH(Time1)>=3) order by Time1 ASC");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);


				$AbsenceQuery = "Select * from MdAbsence where physician like 'KI' and date1 like '$today_date2'";
 				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsKi = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JJ' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJJ = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JuL' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJuL = mysqli_num_rows($abss);

				if($AbsKi+$AbsJJ+$AbsJuL !=0){ 

				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				}
				else{
				$KiCol = "#ffffff";					
				}
				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				}
				else{
				$JJCol = "#ffffff";					
				}
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 echo("<tr>");
				 
				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $KiCol><p align=center>KI</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$KiCol = "#ffffff";					
				}

				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JJCol><p align=center>JJ</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JJCol = "#ffffff";					
				}
				 
				if($AbsJuL !=0){ 
				$JuLCol = "#89ABE3";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JuLCol><p align=center>JuL</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JuLCol = "#ffffff";					
				}
				 
				 
				 echo("</tr>");
				 echo "</table>";				

				 }







// 				SCHEDULED!!!!!!!
				if($numUn!=0){ 	
				echo("<br>");					
				echo "<p align=left><font size=2 color=gray><strong>SCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 
					

							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
															
															
										
										
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}
						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
																				


						
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$j2[Time1] <br> $mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");
								
							}										
						echo "</td>";					
					echo "</tr>";		
					}			
					
					
				}







				echo "</table>";			
				
				echo("<br>");






// UNSCHEDULED!!!!!!
				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (Time1 is null or CHAR_LENGTH(Time1)<3)");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);


				if($numUn!=0){ 	
				echo("<br>");					
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 


							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
																				
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}

						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
						
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						
						
						
						
						
						
// 							echo($query1_fName);
						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");

							}										
						echo "</td>";					
					echo "</tr>";	
					}				
					
					
				}







				echo "</table>";			
				
				echo("<br>");
		
				
				
				
				
				
				
				
				
			}										


			
			
// 			FROM SECOND BEFORE LAST WEEK
			if(1<$n && $n<$tweek && ($i==0 || $i==6)){$k=$k+1;}
			if(1<$n && $n<$tweek && ($i!=0 && $i!=6)){
				$today_date2 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k + 1;
// 				To mark today to red 
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				}

				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (CHAR_LENGTH(Time1)>=3) order by Time1 ASC");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);

// 				SCHEDULED!!!!!!!
				if($numUn!=0){ 	
				echo("<br>");					


				$AbsenceQuery = "Select * from MdAbsence where physician like 'KI' and date1 like '$today_date2'";
 				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsKi = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JJ' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJJ = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JuL' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJuL = mysqli_num_rows($abss);

				if($AbsKi+$AbsJJ+$AbsJuL !=0){ 

				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				}
				else{
				$KiCol = "#ffffff";					
				}
				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				}
				else{
				$JJCol = "#ffffff";					
				}
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 echo("<tr>");
				 
				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $KiCol><p align=center>KI</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$KiCol = "#ffffff";					
				}

				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JJCol><p align=center>JJ</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JJCol = "#ffffff";					
				}
				 
				if($AbsJuL !=0){ 
				$JuLCol = "#89ABE3";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JuLCol><p align=center>JuL</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JuLCol = "#ffffff";					
				}
				 
				 
				 echo("</tr>");
				 echo "</table>";				

				 }








				echo "<p align=left><font size=2 color=gray><strong>SCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 


							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
																				
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$j2[Time1] <br> $mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						
						
						
						
						
						
// 							echo($query1_fName);
						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");

							}										
						echo "</td>";					
					echo "</tr>";					
					}
					
				}







				echo "</table>";			
				
				echo("<br>");






// UNSCHEDULED!!!!!!
				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (Time1 is null or CHAR_LENGTH(Time1)<3)");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);


				if($numUn!=0){ 	
				echo("<br>");					
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		





				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 


							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
																				
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}

						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						
						
						
						
						
						
// 							echo($query1_fName);
						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");

							}										
						echo "</td>";					
					echo "</tr>";	
					}				
					
					
				}







				echo "</table>";			
				
				echo("<br>");
		
				
				
				
				
				
				
				
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
// 			For last week
			if($n==$tweek && $i<=$lweek && ($i==0 || $i==6)){$k=$k+1;}
			if($n==$tweek && $i<=$lweek && ($i!=0 && $i!=6)){
				$today_date2 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k + 1;
				
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				}
				



				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (CHAR_LENGTH(Time1)>=3) order by Time1 ASC");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);

// 				SCHEDULED!!!!!!!
				if($numUn!=0){ 	
				echo("<br>");		
				
				$AbsenceQuery = "Select * from MdAbsence where physician like 'KI' and date1 like '$today_date2'";
 				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsKi = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JJ' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJJ = mysqli_num_rows($abss);
				$AbsenceQuery = "Select * from MdAbsence where physician like 'JuL' and date1 like '$today_date2'";
				$abss = mysqli_query($test, $AbsenceQuery);
				$AbsJuL = mysqli_num_rows($abss);

				if($AbsKi+$AbsJJ+$AbsJuL !=0){ 

				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				}
				else{
				$KiCol = "#ffffff";					
				}
				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				}
				else{
				$JJCol = "#ffffff";					
				}
				
				 echo "<table cellpadding='2' cellspacing='0'>";				
				 echo("<tr>");
				 
				if($AbsKi !=0){ 
				$KiCol = "#00968F";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $KiCol><p align=center>KI</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$KiCol = "#ffffff";					
				}

				if($AbsJJ !=0){ 
				$JJCol = "#FF808B";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JJCol><p align=center>JJ</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JJCol = "#ffffff";					
				}
				 
				if($AbsJuL !=0){ 
				$JuLCol = "#89ABE3";
				 echo "<th rowspan=2 width = 33.33% align=center rowspan='1' bgcolor = $JuLCol><p align=center>JuL</p></th>";														 
				 echo("</th>");
				
				}
				else{
				$JuLCol = "#ffffff";					
				}
				 
				 
				 echo("</tr>");
				 echo "</table>";				

				 }
				
				
				
				
				
							
				echo "<p align=left><font size=2 color=gray><strong>SCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 
					echo "<tr>";


							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
																				
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}

						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$j2[Time1] <br> $mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						
						
						
						
						
						
// 							echo($query1_fName);
						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");

							}										
						echo "</td>";					
					echo "</tr>";		
					}			
					
					
				}







				echo "</table>";			
				
				echo("<br>");






// UNSCHEDULED!!!!!!
				$Meeting_query2 = sprintf("SELECT Hospital_ID, Time1, Memo FROM MeetingList where Date = '$today_date2' and (Time1 is null or CHAR_LENGTH(Time1)<3)");	
				$query2_Meeting = mysqli_query($test, $Meeting_query2);	
				$numUn = mysqli_num_rows($query2_Meeting);


				if($numUn!=0){ 	
				echo("<br>");					
				echo "<p align=left><font size=2 color=gray><strong>UNSCHEDULED</strong></font></p>";
				echo("<hr>");
				}
				
				echo "<table  width='100%' cellpadding='0' cellspacing='0'>";		
				 		
				
				while($j2 = mysqli_fetch_array($query2_Meeting)){ 


							$Informs = sprintf("SELECT Inp, KorName FROM PatientInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							$query1_Name = mysqli_query($test, $Informs);
							$query1_fName = mysqli_result($query1_Name,0,"KorName");							
							$query1_Inp = mysqli_result($query1_Name,0,"Inp");	
													
							$InformsTreat = sprintf("SELECT physician, primarysite, subsite FROM TreatmentInfo WHERE Hospital_ID = '$j2[Hospital_ID]'");
							
							$query1_Treat = mysqli_query($test, $InformsTreat);
							$query1_phys = mysqli_result($query1_Treat,0,"physician");							
							$query1_subs = mysqli_result($query1_Treat,0,"subsite");							
							$query1_prims = mysqli_result($query1_Treat,0,"primarysite");							
																				
						for($phyidss=0;$phyidss<$numphyss;$phyidss++){
							if(strcmp(trim($query1_phys),$phyIdd[$phyidss])==0){
								$mds = $phyInt[$phyidss];
								$cellclr = $phyCol[$phyidss];

							}	
						}


						if(strcmp($mds,$titleMd)==0 or strlen($titleMd)==0){ 
						echo "<tr>";
						
						echo "<th rowspan=2 width = 30px align=center rowspan='1' bgcolor = $cellclr><p align=center><font color = black>$mds</font></p></th>";										

						echo "<th align=left><p align=left>";
						echo($j2["Hospital_ID"]);
						echo("<br>");
						echo($query1_Inp);							
						echo "</th>";

					    echo "<td align='center' width = '40px' align='left'> "; 
					   
// 					    echo "<form id=form111 name=form111></form>";
					    echo "<form  method=post target=_blank action=N_edit_sim.php>";                        
					    echo "<a href=edit.php>";            
					    echo "<input type=submit name=btn_edit id=btn_edit value=$query1_fName>";
					    echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
					    echo "<input name=username type=hidden id=username  value=$uid/>";           
					    echo "<input name=hf_edit type=hidden id=hf_edit value= $j2[Hospital_ID] /></a></form>";   

						
						
						
						
						
						
// 							echo($query1_fName);
						echo "</td>";
						

						echo "<td>";
							echo("<p align=left>".substr($query1_subs,0,10)."</p>");						
						echo "</td>";
 						
						
					echo "</tr>";
					echo "<tr>";
						echo "<td align=left colspan=100>";
							if(strlen($j2["Memo"])>0){
								echo("<p align=left>");
								print_r($j2["Memo"]);
								echo("</p>");
							}
							else{
								echo("<p align=left>");
								echo(".");
								echo("</p>");

							}					
							
						echo "</td>";					
					echo "</tr>";		
					}			
					
					
				}







				echo "</table>";			
				
				echo("<br>");
		
				
				
				
				
				
				
				
				
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

<body>
	
</html>