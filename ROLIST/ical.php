<!-- 2016. 11. 4. Reject retired patient from ical hanbeanyoun -->


<!doctype html>

<?php
		require_once('Connections/test.php'); 

    //오늘 날짜 출력 ex) 2013-04-10

$today_date      = date('Y-m-d');
//오늘의 요일 출력 ex) 수요일 = 3
$day_of_the_week = date('w');
//오늘의 첫째주인 날짜 출력 ex) 2013-04-07 (일요일임)

$a_week_after   = date('Y-m-d', strtotime($a_week_ago . '+' . '100' . ' days')); //45일 후
$a_week_ago   = date('Y-m-d', strtotime($a_week_ago . '-' . '100' . ' days')); //45일 후

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after'))";
if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $order = 'DESC';
}
//$query_Recordset1 .= " ORDER BY TreatmentInfo.RT_start1 " . $order;
//echo($query_Recordset1);

$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
    
	
	
	
// 	Save as ical schedules
$uidInd = 0;	
$log_txt = "BEGIN:VCALENDAR";    
$log_dir = "";   
$log_file = fopen("testCal.ics", "w");  
fwrite($log_file, "BEGIN:VCALENDAR\n");
fwrite($log_file, "VERSION:2.0\n");
fwrite($log_file, "PRODID:-//Apple Inc.//Mac OS X 10.12.5//EN\n");
fwrite($log_file, "CALSCALE:GREGORIAN\n");

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose1");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx1");    

    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");

    $query3_date = mysql_result($Recordset1,$jj,"RT_start2");	

    
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose2");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx2");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
    $query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
   	
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose3");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx3");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose4");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx4");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose5");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx5");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose6");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx6");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


/*


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mhlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mhlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}
*/

fwrite($log_file, "END:VCALENDAR\n");
fclose($log_file); 











// RODB for mjlee !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    
	
	
	
// 	Save as ical schedules
$uidInd = 0;	
$log_txt = "BEGIN:VCALENDAR";    
$log_dir = "";   
$log_file = fopen("testCal_mjlee.ics", "w");  
fwrite($log_file, "BEGIN:VCALENDAR\n");
fwrite($log_file, "VERSION:2.0\n");
fwrite($log_file, "PRODID:-//Apple Inc.//Mac OS X 10.12.5//EN\n");
fwrite($log_file, "CALSCALE:GREGORIAN\n");

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose1");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx1");    

    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");

    $query3_date = mysql_result($Recordset1,$jj,"RT_start2");	

    
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose2");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx2");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
    $query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
   	
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose3");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx3");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose4");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx4");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose5");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx5");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose6");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx6");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.CT_sim7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


/*


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'mjlee' AND ((STR_TO_DATE(TreatmentInfo.RT_fin7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:mjlee@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}
*/

fwrite($log_file, "END:VCALENDAR\n");
fclose($log_file); 










// RODB for myki !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    
	
	
	
// 	Save as ical schedules
$uidInd = 0;	
$log_txt = "BEGIN:VCALENDAR";    
$log_dir = "";   
$log_file = fopen("testCal_myki.ics", "w");  
fwrite($log_file, "BEGIN:VCALENDAR\n");
fwrite($log_file, "VERSION:2.0\n");
fwrite($log_file, "PRODID:-//Apple Inc.//Mac OS X 10.12.5//EN\n");
fwrite($log_file, "CALSCALE:GREGORIAN\n");

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose1");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx1");    

    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");

    $query3_date = mysql_result($Recordset1,$jj,"RT_start2");	

    
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");

	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose2");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx2");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
    $query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
   	
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose3");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx3");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose4");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx4");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose5");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx5");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_start6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_start6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:S6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	
	// Dose information to memo
    $query3_dose_ID = mysql_result($Recordset1,$jj,"dose6");
    $query3_fx_ID = mysql_result($Recordset1,$jj,"Fx6");    
    $query3_total_ID = $query3_dose_ID/$query3_fx_ID;
    $td = ($query3_dose_ID);
    $tt = ($query3_fx_ID);
    $ts = ($query3_total_ID);
    $query3_dsum_ID = mysql_result($Recordset1,$jj,"dose_sum");    
	fwrite($log_file, "DESCRIPTION: $ts Gy X $tt Fx = $td Gy ($query3_dsum_ID Gy)\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	$query3_H_ID = mysql_result($Recordset1,$jj,"Hospital_ID");
 	fwrite($log_file, "URL;VALUE=URI:http://54.160.213.4/calpup.php?H_ID=$query3_H_ID\n"); 					// ADD RT FRACTION AND SCHEDULE!!
	
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.CT_sim7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"CT_sim7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:C7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

/*



$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin1, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin1");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F1:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
	//echo($rtDate);
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin2, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
//echo($query_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin2");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F2:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
//	echo($rtDate);	
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin3, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin3");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F3:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin4, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin4");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F4:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}


$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin5, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin5");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F5:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin6, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin6");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F6:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}

$query_Recordset1 = "SELECT * FROM PatientInfo join ClinicalInfo join TreatmentInfo on PatientInfo.Hospital_ID = ClinicalInfo.Hospital_ID AND PatientInfo.Hospital_ID = TreatmentInfo.Hospital_ID where TreatmentInfo.physician LIKE 						'myki' AND ((STR_TO_DATE(TreatmentInfo.RT_fin7, '%m/%d/%Y') BETWEEN '$a_week_ago' AND '$a_week_after') AND (PatientInfo.CurrentStatus !=2 OR PatientInfo.CurrentStatus is NULL) AND (PatientInfo.CurrentStatus !=3 OR PatientInfo.CurrentStatus is NULL))";
$Recordset1 = mysql_query($query_Recordset1, $test) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
for($jj=0;$jj<$totalRows_Recordset1;$jj++){
	$uidInd = $uidInd+1;
	$uifF = sprintf("%04d",$uidInd);	
	
    $query3_RS_ID = mysql_result($Recordset1,$jj,"KorName");
    $query3_date = mysql_result($Recordset1,$jj,"RT_fin7");	
	$rtDate = date('Ymd', strtotime($query3_date));	
	fwrite($log_file, "\n");
	fwrite($log_file, "BEGIN:VEVENT\n");
	fwrite($log_file, "CREATED:20161027T033727Z\n");	
	fwrite($log_file, "UID:D8E28BE1-2D72-4840-AA3F-40D5AA00$uifF\n");	
	fwrite($log_file, "DTEND;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "TRANSP:TRANSPARENT\n");
	fwrite($log_file, "X-APPLE-TRAVEL-ADVISORY-BEHAVIOR:AUTOMATIC\n");	
	fwrite($log_file, "SUMMARY:F7:$query3_RS_ID\n");	
	fwrite($log_file, "DTSTART;VALUE=DATE:$rtDate\n");
	fwrite($log_file, "DTSTAMP:20161027T033740Z\n");
	fwrite($log_file, "ORGANIZER:myki@pnuyhro\n");	
	fwrite($log_file, "SEQUENCE:0\n");
	fwrite($log_file, "END:VEVENT\n");
	fwrite($log_file, "\n");
}
*/

fwrite($log_file, "END:VCALENDAR\n");
fclose($log_file); 
?>




  <table bgcolor="#59A15B" width = "100%">
    <tr>
	          <td width = "35%" align="left">
<p algign="left">                      </p>
	<?php
echo ($UserName);
echo $UserName;
?>
	          </td>

      <td width = "30%" align="center">
           <p algign="center"><img src="logoCircle.png" alt="" width="100" height="100" /></a>  </p>
           
      
      </td>
      	          <td width = "35%" align="center"> </td>
    </tr>
    <tr>
    </tr>
  </table>
  
    <table bgcolor="#59A15B" width = "100%">
    <tr>
	         
	          </td>

      <td width = "100%" align="center">
           <p style="font-size: 12px; color: #FFFFFF;">Copyright ⓒ 2016  |  Department of Radiation Oncology  |  Pusan National University Yangsan Hospital | Number of the total entries: <?php
echo $count;
?></p>     
           
      
      </td>
      	  
    </tr>
    <tr>
    </tr>
  </table>
<body>
	
	
	
	
    </html>