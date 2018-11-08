<!doctype html>
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

<style type="text/css">

	input[type=text] {
	    padding:1px;
	    border:1px solid #ccc;
	    -webkit-border-radius: 5px;
	    border-radius: 0px;
	}
	
	input[type=text]:focus {
	    border-color:#333;
	}
	
	input[type=submit] {
	    padding:1px 1px;
	    background:#FFFFFF;
	    border:0 none;
	    cursor:pointer;
	    -webkit-border-radius: 1px;
	    border-radius: 1px;
	}
	input[type=button] {
	    padding:1px 1px;
	    background:#FFFFFF;
	    border:0 none;
	    cursor:pointer;
	    -webkit-border-radius: 1px;
	    border-radius: 1px;
	}
	
	choice{
	    padding:5px 10px;
	    background:#f10606;
	    border:0 none;
	    cursor:pointer;
	    -webkit-border-radius: 5px;
	    border-radius: 5px;
	}
	select {
	    padding:10px;
	    border:2px solid #ccc;
	    height: 15px;
	    width: 100px;
	    -webkit-border-radius: 5px;
	    border-radius: 5px;
	}
	
	#apDiv1 {
		position: absolute;
		width: 1055px;
		height: 115px;
		z-index: 1;
		left: -1px;
		top: 111px;
		}
	
	body,td,th {
		font-family: Trebuchet-MS, Geneva, sans-serif;
		color: #000000;
		font-size: 7px;
		text-align: left;
	}
	
	th{
		height: 5px;
	}
	
	table {
		border-collapse: collapse;
		
	}
		
	tr { 
	  border: solid;
	  border-width: 0px 0;
	}
	
	aa {
		font-family: georgia, Geneva, sans-serif;
	    color: rgba(0, 0, 0, 0.76);
	    font-size: 12px;
	    text-align: left;
	    }
	
	a:link {
		color: #09C;
	}
	a:visited {
		color: #06C;
	}
	a:hover {
		color: #0075BE;
		font-weight:  100;
	}
	a:AC {
		color: #069;
		}
	body table tr td p {
		color: #000000;
	}
	
</style>

<title>Radiation Treatment Record</title>
</head>





<body>
<!-- Body starts here!!! -->


<?php

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

$seven          = 0 + $week_post;
$a_week_ago     = date('Y-m-d', strtotime($date . "+" . $seven . 'days'));
$a_week_ago_mon = $modify_day = date("Y-m-d", strtotime($a_week_ago . "+1day"));
$a_week_after   = $a_week_ago;

if(strcmp($md, "myki")==0){
	$titleMd = "KI";
}
if(strcmp($md, "mjlee")==0){
	$titleMd = "JaL";
}
if(strcmp($md, "mhlee")==0){
	$titleMd = "JuL";
}

?>

























































































<table cellpadding = "0px" width="800px" border="0" align="center" cellspacing="0"><th><font style="font-family:verdana; font-size:14px" align="left">EB list (from <?php echo $a_week_after; ?>)</font></th>
</table>
<table width="800px" border="0" align="center" cellspacing="0">
<form></form>
<form name = "form110" id = "form110" method = "post" action ="daily_report.php">
	<th width="30px">
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post - 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />				
		<input type = "submit" name = "week_" id = "week_" value="<" />
	</th>
</form>
<form name = "form111" id = "form112" method = "post" action ="daily_report.php">
	<th width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = 0 />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		
		<input type = "submit" name = "week" id = "week" value="Today" />
	</th>
</form>
<form name = "form112" id = "form112" method = "post" action ="daily_report.php">
	<th width="50px"><input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post + 1; ?> />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
		<input type = "hidden" name = "date_menu"	id ="date_menu" value = "<?php echo $catInd; ?>" />
		
		<input type = "submit" name = "week__" id = "week__" value=">" />
	</th>
</form>

<form name = "formMD" id = "formMD" method = "post" action ="daily_report.php">
	<th><select name="mdname">
		<option name="mdname" value="*" selected>TOTAL</option>
		<option name="mdname" value="myki" >KI</option>
		<option name="mdname" value="mjlee" >JaL</option>
		<option name="mdname" value="mhlee" >JuL</option>
		<input type = "hidden" name = "weekago"	id ="weekago" value = <?php echo $week_post; ?> />
		<input type='submit' value='Submit' />
		<input type = "hidden" name = "permit" id = "permit" value = <?php echo $permitUser; ?> />
	</select>
	</th>
	<th><?php echo $LiveNumVersa; ?> <?php echo $liveNumVmat; ?> </th>
</form>	


<form id=form11 name=form11 method=post action="testphpr2.php">
			<th><input type=submit name=btn_home id=btn_home value=HOME />
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></th></form>

		
</table>
		
		
<?php

echo $_POST['username'];
echo $_POST['username'];


$catchar  = 'Start';
$sortCat1 = 'RT_start1';
$sortCat2 = 'RT_start2';
$sortCat3 = 'RT_start3';
$sortCat4 = 'RT_start4';
$sortCat5 = 'RT_start5';
$sortCat6 = 'RT_start6';
$sortCat7 = 'RT_start7';


    
    $query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where 
    (STR_TO_DATE(TreatmentInfo. $sortCat2, '%m/%d/%Y') >= '$a_week_ago') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL) AND TreatmentInfo.subsite like 'Breast'";
    if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
        $order = 'DESC';
    }
//     echo($query_Recordset1);
    $query_Recordset1 .= " ORDER BY STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%Y') " . $order;
    echo($query_Recordset1);
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


$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
// echo $query_Recordset1;

$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$Today_date     = date("n/j/y"); // n : 월 1~12 로 표시, j : 일 1~31 로 표시, y : 년도를 2자리로 표시
$Today_date1    = date("Y/m/d", strtotime($Today_date));


?>


		

        <table cellpadding = "0px" width="800px" border="0" align="center" cellspacing="0">
         
        <th><font style="font-family:verdana; font-size:12px" align="left">EB List from today</font></th>
        </table>
        
        <table cellpadding = "0px" width="800px" border="0" align="center" cellspacing="0">

            <th bgcolor="#777777">Start</th>
			<th bgcolor="#777777">Ind</th>
			<th bgcolor="#777777">C</th>
			<th bgcolor="#777777">T</th>
			<th bgcolor="#777777">P</th>
			<th bgcolor="#777777">A</th>                                         	  
			<th bgcolor="#777777">ID</th>
			<th bgcolor="#777777">Name</th>
			<th bgcolor="#777777">S</th>
			<th bgcolor="#777777">A</th>
			<th bgcolor="#777777">Diag.</th>
			<th bgcolor="#777777">Pathol.</th>
			<th bgcolor="#777777">Stage</th>
			<th bgcolor="#777777">Aim</th>			
			<th bgcolor="#777777">D</th>
			<th bgcolor="#777777">F</th>
			<th bgcolor="#777777">D(Σ)</th>
			<th bgcolor="#777777">F(Σ)</th>
			<th bgcolor="#777777">Tech.</th>
			<th bgcolor="#777777">Room</th>
			<th bgcolor="#777777">Phys</th>
<?php

if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
    echo "<th bgcolor=#777777 scope=col>Detail</th>";
}
?>


<!-- </tr> -->

<?php
$idcolor   = 0;
$count     = 0;
$planIdInd = 0;

do {	
    $idcolor++;
    if ($idcolor % 2 == 0) {
        $bgcolorF = "#FFFFFF";
    } else {
        $bgcolorF = "#DDDDDD";
    }
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
        $RT_fin_curr   = "RT_fin" . "$pid[$tCount]";
        $dose_curr     = "dose" . "$pid[$tCount]";
        $fx_curr       = "Fx" . "$pid[$tCount]";
                
        echo "<tr bgcolor='#FFFFFF'> </tr>";
        
        if (strcmp($row_Recordset1[physician],'myki')==0){$phys = "KI"; $phyColor = "#99FF00";} 
        if (strcmp($row_Recordset1[physician],'mhlee')==0){$phys = 'JuL'; $phyColor = "#CCFF66";} /* #CCFF66 (web safe colors) */
        if (strcmp($row_Recordset1[physician],'mjlee')==0){$phys = 'JaL'; $phyColor = "#00FFCC";} /* #00FFCC (web safe colors) */
                        
        $lenDate = strlen($row_Recordset1[RT_start2]);
        $cropDate = substr($row_Recordset1[RT_start2],0,$lenDate-3);
        echo "<td rowspan = 1 width = '30px' bgcolor=$bgcolorF> $cropDate </td>";
               
        echo "<td bgcolor=$bgcolorF width = '15px'>$pid[$tCount]/$idx</td>";
        
        if ($row_Recordset1[Modality_var1] == NULL){
	        echo "<td width = '15px' color=white bgcolor=#999999>   </td>";
	        }
	    else{
		    $combined = substr(trim($row_Recordset1[Modality_var1]), 0, 1); 
			echo "<td width = '15px' bgcolor=#f45942> $combined </td>";
		}
        echo "<td bgcolor=#999999 width = '10px'>  </td>";	// TARGET STATUS WB Updated
        echo "<td bgcolor=#999999 width = '10px'>  </td>";	// PLAN STATUS WB Updated
        echo "<td bgcolor=#999999 width = '10px'>   </td>";	// APPROVE STATUS WB Updated

        echo "<td bgcolor=$bgcolorF width = '50px'>  $row_Recordset1[Hospital_ID]  </td>";
        echo "<td bgcolor=$bgcolorF width = '80px' align='right'>  $row_Recordset1[FirstName] $row_Recordset1[SecondName]  </td>"; 
        echo "<td bgcolor=$bgcolorF width = '20px'>    $row_Recordset1[Sex] </td>";
        echo "<td bgcolor=$bgcolorF width = '20px'>   $row_Recordset1[Age] </td>";       
        echo " <td bgcolor=$bgcolorF width = '80px'>   $row_Recordset1[subsite] </td> ";        
        echo " <td bgcolor=$bgcolorF width = '100px'>   <font font-size:'4px'>$row_Recordset1[pathol] </font></td> ";        
        echo " <td bgcolor=$bgcolorF width = '100px'>    <font font-size:'4px'>$row_Recordset1[tnm] </font></td> ";
        echo " <td bgcolor=$bgcolorF width = '40px'>   $row_Recordset1[purpose] </td> ";

		echo "<td bgcolor=$bgcolorF width='30'>   $row_Recordset1[dose2] </td>";
		echo "<td bgcolor=$bgcolorF width='30'>   $row_Recordset1[Fx2] </td>";
        echo "<td bgcolor=$bgcolorF width='30'>   $row_Recordset1[dose_sum] </td>";
        echo "<td bgcolor=$bgcolorF width='30'>   $row_Recordset1[Fx_sum] </td>";
		if (strcasecmp(trim($row_Recordset1[$Method_f]),"3D Conformal")==0){
			$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=#469BBB width = '20'>   $tempTech </td>";}
		elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"VMAT")==0){echo "<td bgcolor=#F0E768 width = '20'>   $row_Recordset1[$Method_f] </td>";}
		elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"IMRT")==0){echo "<td bgcolor=#D0A047 width = '20'>   $row_Recordset1[$Method_f] </td>";}
		elseif (strcasecmp(trim($row_Recordset1[$Method_f]),"2D Conventional")==0){
			$tempTech = substr(trim($row_Recordset1[$Method_f]), 0, 3); echo "<td bgcolor=#2B6389>   $tempTech </td>";
			}
		elseif (strcasecmp(trim($$row_Recordset1[$Method_f]),"Infinity")==0){echo "<td bgcolor=#469BBB>   $row_Recordset1[$Method_f] </td>";}
		else{echo "<td bgcolor=$bgcolorF>   $row_Recordset2[$Method_f] </td>";}

		if (strcasecmp(trim($row_Recordset1[$Linac_f]),"Versa")==0){echo "<td bgcolor=#DBA67B width = '20'>   $row_Recordset1[$Linac_f] </td>";}
		elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"IX")==0){echo "<td bgcolor=#458985 width = '20'>   $row_Recordset1[$Linac_f] </td>";}
		elseif (strcasecmp(trim($row_Recordset1[$Linac_f]),"Infinity")==0){echo "<td bgcolor=#D7D6A5 width = '20'>   $row_Recordset1[$Linac_f] </td>";}
		else{echo "<td bgcolor=$bgcolorF>   $row_Recordset1[$Linac_f] </td>";}

		echo "<td bgcolor=$phyColor width = '20'>   $phys</td>";

        
        echo "<form id=form111 name=form111></form>";
        if ($permitUser == 4 || $permitUser == 4) {
            echo "<td bgcolor=$bgcolorF><form id=form3 name=form3 method=post action=N_edit_all.php>";                        
            echo "<a href=edit.php>";            
            echo "<input type=submit name=btn_edit id=btn_edit STYLE=font-size:1px' value=E />";
            echo "<input name=permit type=hidden id=permit  value=$permitUser/>";            
            echo "<input name=hf_edit type=hidden id=hf_edit value= $row_Recordset1[Hospital_ID] /></a></form></td>";            
        }
        if ($permitUser == 1 || $permitUser == 2 || $permitUser == 3) {
            echo "<td bgcolor=$bgcolorF><form id=form4 name=form4 method=post action=N_report_all.php>";
            echo "<input type=submit name=btn_report id=btn_report  STYLE=font-size:1px' value= >";
            echo "<input name=permit type=hidden id=permit  value=$permitUser/>";
            echo "<input name=hr_field type=hidden id=hr_field value= $row_Recordset1[Hospital_ID] /></form></td>";
        }
?>


</td>
</tr>

<?php


} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));

?>
</table>

</body>
</html>

<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset2);
?>

</html>

