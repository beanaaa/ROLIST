<!-- 2016. 11. 4. Reject retired patient from ical hanbeanyoun -->

<!doctype html>

<style type="text/css">	  
body{
	    font-family: Arial;

}
p{
	    font-family: Arial;

}
td {
    padding: 0px;
/*     text-align: right; */
/*     border-bottom: 1px solid #ddd; */
	vertical-align: top;
}
th{
/*
    padding: 0px;
    text-align: left;
*/
    border-bottom: 1px solid #ddd;
    font-family: Arial;
/*
	font-weight: 100;
	font-size: 14px;
*/
}
p
{
margin: 0;
padding: 0;
}

</style>

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
$week_post = $_POST['weekago'];
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

<script lang='javascript'>
	window.setTimeout("window.location.reload()", 60000);
</script>


<?php 
	mysql_select_db($database_test, $test);

	$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID";

	if(isset($_GET['sort']) && $_GET['sort'] == 'desc'){
		$order = 'DESC';
	}

	$query_Recordset1 .= " ORDER BY PatientInfo.Hospital_ID " . $order;
	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);

	$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	// echo $query_Recordset1;
	$row_Recordset2 = mysql_fetch_assoc($Recordset1);	
?>

<html lang="ko">
<head>
	<link rel="stylesheet" type="text/css" href="Calendar.css">	
	<meta http-equiv="refresh" content="600;url=index.php"> 
	
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
	<script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>
	<title>Simulation scheduler</title>

	<link type="text/css" rel="stylesheet" href="modalLayer.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="jquery.modalLayer.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
    $('.open_modal').modalLayer();
  	});
  	</script>

  	<meta charset="utf-8">
  	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
<table>
	<form name = "form110" id = "form110" method = "post" action ="dueschedule.php">
			<th>&nbsp;&nbsp;
				<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input type = "submit" name = "week_" id = "week_" value="<" />
			</th>
		</form>

<form name = "form111" id = "form111" method = "post" action ="dueschedule.php">
			<th>&nbsp;&nbsp;
				<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
				<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />				
				<input type = "submit" name = "week_" id = "week_" value=">" />
			</th>
		</form>
		
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
	
	<?php 
				?>
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
				$today_date1 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k+1;
				
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>"; echo "<br />\n";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>"; echo "<br />\n";					
				}
				
	


		
				
				echo "<p align=left><font size=2 color=gray><strong>DEPARTMENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}


				

				echo "</table>";					
				
				echo("<br>");

				echo "<p align=left><font size=2 color=gray><strong>PATIENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date1', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
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
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				}
				
// 									This is for CT simulation
		
				
				echo "<p align=left><font size=2 color=gray><strong>DEPARTMENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}


				

				echo "</table>";					
				
				echo("<br>");

				echo "<p align=left><font size=2 color=gray><strong>PATIENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date2', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}




				echo "</table>";						
				
				
				
				
				
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
// 			For last week
			if($n==$tweek && $i<=$lweek && ($i==0 || $i==6)){$k=$k+1;}
			if($n==$tweek && $i<=$lweek && ($i!=0 && $i!=6)){
				$today_date3 =date("n/j/y", strtotime($today_date."+$k days"));
				$k = $k + 1;
				
				if ($todayMarker==$k && $todayMonth==$month){
					echo "<p class=today style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				} else{
					echo "<p style=font-weight: bold; color: #999999; valign = top align = right>  <font size=5> $k &nbsp&nbsp </font> </p>";
				}
				
// 									This is for CT simulation
		
				
				echo "<p align=left><font size=2 color=gray><strong>DEPARTMENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
			        echo "</tr>";
					
					
								
				}


				

				echo "</table>";					
				
				echo("<br>");

				echo "<p align=left><font size=2 color=gray><strong>PATIENT RECORD</strong></font></p>";
				
				echo("<hr>");
				
				echo "<table  width='100%' cellpadding='2' cellspacing='0'>";		
				

				$query_starts = "SELECT * FROM DueTemp where STR_TO_DATE(Date1, '%m/%d/%y') like  STR_TO_DATE('$today_date3', '%m/%d/%Y')";
// 				echo($query_starts);
				$Recordset1 = mysql_query($query_starts, $test) or die(mysql_error());
// 				$row_Recordset1       = mysql_fetch_assoc($Recordset1);
				$totalRows_Recordset1 = mysql_num_rows($Recordset1);
				
// 				echo($totalRows_Recordset1);
				
				for($idCal = 0; $idCal<$totalRows_Recordset1; $idCal++){
					$rowOrders = mysql_fetch_assoc($Recordset1);

					$querypatient = mysql_query("SELECT * FROM PatientInfo where Hospital_ID like $rowOrders[Hospital_ID]");		
					$querytreatment = mysql_query("SELECT physician FROM TreatmentInfo where Hospital_ID like $rowOrders[Hospital_ID]");	
					$Patients = mysql_fetch_assoc($querypatient);
					$Phys = mysql_fetch_assoc($querytreatment);					

					
					if(strcmp($Phys[physician],"myki")==0){
						$mds = "KI";
							$cellclr = "#00968F";
					}
					elseif(strcmp($Phys[physician],"mjlee")==0){
						$mds = "JaL";
											$cellclr = "#FF808B";
						
					}
					elseif(strcmp($Phys[physician],"mhlee")==0){
						$mds = "JuL";
							$cellclr = "#89ABE3";
						
					}
					elseif(strcmp($Phys[physician],"mjnam")==0){
						$mds = "JN";

							$cellclr = "#FFFFFF";

					}
					else{
												$mds = $Phys[physician];
							$cellclr = "#FFFFFF";

					}


// 					print_r($rowOrders);

					echo "<tr>";
					echo "<th rowspan=2 width = 30px align=left rowspan='1' bgcolor = $cellclr><p align=left>$idCal<br> $mds</p></th>";										
					echo "<th width = 40px rowspan='1'><p align=left>$rowOrders[Hospital_ID] </p></th>";				
					echo "<th width = 90px><p align=left>$Patients[KorName] &nbsp <font color=red><strong>$CCRT</strong></font> <br></p></th>";
					
// 					Generate Edit button 
					echo "<th width = 10px align=left><form id=form3 name=form3 method=post target=_blank action= N_edit_sim.php>";
					echo "<input type=submit name=btn_edit id=btn_edit value=E />";
					echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
					echo "<input name=datePick type=hidden id=datePick  value=$today_date3 />";						
					echo "<input name=hf_edit type=hidden id=hf_edit value= $rowOrders[Hospital_ID] /> </form></th>";
			        echo "</tr>";
			        
			        echo "<tr>";
					echo "<th colspan=4 align=left rowspan='1'><p align=left><font color=gray size=1>$rowOrders[Memo1] </font></p></th>";										
			        
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

<body>
	
</html>