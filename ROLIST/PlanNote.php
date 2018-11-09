


<style type="text/css">
body{
	font-family:Arial, Helvetica, sans-serif;
	margin:0 auto;
}
a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
a:visited {
	color: #666;
	font-weight:bold;
	text-decoration:none;
}
a:active,
a:hover {
	color: #bd5a35;
	text-decoration:underline;
}


table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:3px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child{
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child{
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child{
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr{
	text-align: center;
	padding-left:20px;
}
table tr td:first-child{
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table tr td {
	padding:12px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;
	
	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td{
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td{
	border-bottom:0;
}
table tr:last-child td:first-child{
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child{
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td{
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}

</style>


<?php
$fUpCh = $_POST['fup'];
if(strcmp($fUpCh,"1")==0){
	
  $h_id = $_POST['hf_edit'];
  $planID = $_GET['planID'];
  $planName = $_POST['planName'];
// 	planID
  $path = "PlanCapture"; // 오픈하고자 하는 폴더 
  $entrys = array(); // 폴더내 Entry를 저장하기 위한 배열 
  $dirs = dir($path); // 오픈하기 
  while(false !== ($entry = $dirs->read())){ // 읽기 
     $entrys[] = $entry; 
  } 
  $dirs->close(); // 닫기 

  // var_export($entrys); 

  $fCh = 0;

  for($idcount=0; $idcount<count($entrys);$idcount++){
    if(strcmp($entrys[$idcount],$h_id)==0){
      $fCh = 1;
      $folderName = $path."/".$h_id;

      break;
    }
  }

  if($fCh==0){
    $folderName = $path."/".$h_id;
    mkdir($path."/".$h_id);
  }


  $uploads_dir = $folderName;


// 설정
// $uploads_dir = './uploads';
$allowed_ext = array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
 
// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
$ext = array_pop(explode('.', $name));
$name = $planName."_".$name;
echo("<br>".$name."<br>");

// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}
 
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}
 
// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");

// 파일 정보 출력
echo "<h2>파일 정보</h2>
<ul>
	<li>파일명: $name</li>
	<li>확장자: $ext</li>
	<li>파일형식: {$_FILES['myfile']['type']}</li>
	<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
</ul>";



}	
	
?>







<?php
	require_once('Connections/test.php'); 
	
  	$planID = $_GET['planID'];
  	$hID = $_GET['hf_edit'];

  	if(strlen($hID)==0){
  	$hID = $_POST['hf_edit'];
	  	
  	}
  	if(strlen($planID)==0){
  	$planID = $_POST['planID'];
	  	
  	}


  	$upPlanId = $_POST['planid'];
  	$upCx = $_POST['cx'];
  	$upCy = $_POST['cy'];
  	$upCz = $_POST['cz'];
  	$upBolus = $_POST['bolus'];
  	$upper = $_POST['updater'];
  	$upPlannerNote = $_POST['plannernote'];
	mysql_query("set session character_set_connection=latin1;");
	mysql_query("set session character_set_results=latin1;");
	mysql_query("set session character_set_client=latin1;");

  	
/*
  	echo($upPlanId."<br>");
  	echo($upCx."<br>");
  	echo($upCy."<br>");
  	echo($upCz."<br>");
  	echo($upBolus."<br>");
  	echo($upPlannerNote."<br>");
*/


  	if(strcmp($upper,'1')==0){ 
	$queryUpdate = "Update PlannerNote Set PlanID = '$upPlanId' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);
	$queryUpdate = "Update PlannerNote Set cx = '$upCx' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);	
	$queryUpdate = "Update PlannerNote Set cy = '$upCy' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);	
	$queryUpdate = "Update PlannerNote Set cz = '$upCz' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);
	$queryUpdate = "Update PlannerNote Set Bolus = '$upBolus' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);
	$queryUpdate = "Update PlannerNote Set PlanNote = '$upPlannerNote' where Hospital_ID like '$hID' and PlanNo = $planID";
	mysql_query($queryUpdate);
	}
  	
  	
  	
  	
	
	$query = "Select * from PlannerNote where Hospital_ID like '$hID' and PlanNo like '$planID'";  
	$qr = mysql_query($query);
	$entchk = mysql_num_rows($qr);
// 	echo($entchk);
	
	$querytotal = "Select * from PlannerNote where Hospital_ID like '$hID' order by PlanNo";   	
	$qrtotal = mysql_query($querytotal);
	$entchktotal = mysql_num_rows($qrtotal);
	
	if($entchk ==0){
		$insertQuery = "Insert into PlannerNote (Hospital_ID, PlanNo) values ('$hID', $planID)";
		mysql_query($insertQuery);
		echo("New List Inserted!");
	}
	
  	
?>
<!--

<table>
	<tr>
		<td rowspan=2>
			Index
		</td>
		<td rowspan=2 width=150px>
			Id
		</td>
		<td colspan=3 width=120px>
			Coordnates
		</td>
		<td rowspan=2 width=80px>
			Bolus
		</td>
	</tr>
	<tr>
		<td>
			CX
		</td>
		<td>
			CY
		</td>
		<td>
			CZ
		</td>
	</tr>
	
	<?php
	
	for($ids = 0; $ids<$entchk;$ids++){
		$dset = mysql_fetch_assoc($qrtotal);
		echo("<tr>");
			echo("<td>");
				echo($dset[PlanNo]);
			echo("</td>");				
			echo("<td>");
				echo($dset[PlanID]);
			echo("</td>");				
			echo("<td width=40px>");
				echo($dset[cx]);
			echo("</td>");				
			echo("<td width=40px>");
				echo($dset[cy]);
			echo("</td>");				
			echo("<td>");
				echo($dset[cz]);
			echo("</td width=40px>");				
			echo("<td>");
				echo($dset[Bolus]);
			echo("</td>");	
			echo("</tr>");							
			echo("<tr>");				
			echo("<td>");
				echo("Planner's Note");
			echo("</td>");				
			echo("<td>");
				echo(nl2br($dset[PlanNote]));
			echo("</td>");				
		echo("</tr>");
	}
	
	
	?>
	
</table>
-->
<?php
	$dsets = mysql_fetch_assoc($qr);
	
	$trData = mysql_fetch_assoc(mysql_query("select * from TreatmentInfo where Hospital_ID like '$hID'"));
	$ptData = mysql_fetch_assoc(mysql_query("select * from PatientInfo where Hospital_ID like '$hID'"));
//   	print_r("select * from PatientInfo where Hospital_ID like '$hID");
			if(file_exists("PatientPhoto/". $ptData['RO_ID'].".jpg")==1){
				$photoPath = "PatientPhoto/". $ptData['RO_ID'].".jpg";
			}
			elseif(strcmp($ptData['Sex'],"M")==0 and file_exists("PatientPhoto/". $ptData['RO_ID'].".jpg")!=1){
								$photoPath = "/PatientPhoto/m.jpg";

			}
			elseif(strcmp($ptData['Sex'],"F")==0 and file_exists("PatientPhoto/". $ptData['RO_ID'].".jpg")!=1){
								$photoPath = "/PatientPhoto/f.jpg";

			}
			else{
			         $photoPath = "/PatientPhoto/icon.png";
	
			}
			


	

?>
<form id=form5 name=form5 method=post action=PlanNote.php >
<table width="600px">
		<tr>
	  		<td style="padding-left: 0px; padding-right: 0px; padding-bottom: 0px; padding-top: 0px" width="70px" cellspacing="0"  cellpadding="0" rowspan="3" align="center" >
		  		<img  src=<?php echo $photoPath; ?> width="100px">
	  		</td>
		<td style="padding-left: 2px; padding-right: 2px; padding-bottom: 2px; padding-top: 2px" rowspan=1>
			<strong><?php echo $ptData[Hospital_ID]; ?> (<?php echo $ptData[KorName]; ?>, Plan No. <?php echo $planID; ?>)</strong>
		</td>
		<td colspan=3 style="padding-left: 12px; padding-right: 12px; padding-bottom: 12px; padding-top: 12px">
			Center Moving
		</td>
		<td rowspan=2>
			Bolus
		</td>
	</tr>
	<tr>
		<td rowspan=1>
			<p align=center>Plan ID</p>
		</td>
		
		<td colspan=1 align="center" style="padding-left: 12px; padding-right: 12px; padding-bottom: 12px; padding-top: 12px">
			<p align=center>CX</p>
		</td>
		<td colspan=1 style="padding-left: 12px; padding-right: 12px; padding-bottom: 8px; padding-top: 12px">
			CY
		</td>
		<td colspan=1 style="padding-left: 12px; padding-right: 12px; padding-bottom: 12px; padding-top: 12px">
			CZ
		</td>
	</tr>
	
	<tr>
<!--
		<td colspan=1 style="padding-left: 2px; padding-right: 2px; padding-bottom: 2px; padding-top: 2px">
		<?php
			echo $hID; 
			?>
	</td>
-->
	<td>
	  	<input class="form-control" style="height:25px; width:150px" name="planid" type="text" id="planid" value="<?php echo $dsets['PlanID']; ?>" >		
	</td>
	
	<td>
	  	<input class="form-control" style="height:25px; width:40px" name="cx" type="text" id="cx" value="<?php echo $dsets['cx']; ?>" >					
	</td>
	<td>
	  	<input class="form-control" style="height:25px; width:40px" name="cy" type="text" id="cy" value="<?php echo $dsets['cy']; ?>" >					
	</td>
	<td>
	  	<input class="form-control" style="height:25px; width:40px" name="cz" type="text" id="cz" value="<?php echo $dsets['cz']; ?>" >					
	</td>
	<td>
	  	<input class="form-control" style="height:25px; width:80px" name="bolus" type="text" id="bolus" value="<?php echo $dsets['Bolus']; ?>" >							
	</td>
	</tr>
	<tr>
		<td>
		Note	
		</td>
	<td colspan=5>
  		<textarea style="width:100%; resize:none;"   class="noresize"  width="480px" rows="19" cols = "65" name="plannernote" type="text" id="plannernote"><?php echo $dsets['PlanNote']; ?></textarea>    
		
	</td>

	</tr>
</table>

	<input type="hidden" name="planID" id = "planID" value = "<?php echo $planID;  ?>" />
    <input type="hidden" name="hf_edit" id = "hf_edit" value="<?php echo $hID?>" />
    <input type="hidden" name="updater" id = "updater" value="1" />
	<input type=submit name=btn_edit id=btn_edit value=Insert-Planner-Note>
	
</form>

<table width="600px">
		<tr>
	  <td bgcolor="#153d73" rowspan=1><font color="black">Plan Doc</font></td>
	    <td  colspan=3>
		    
			<form enctype='multipart/form-data' action='PlanNote.php' method='post'>
				<input type='file' name='myfile'>
			    <input type="hidden" name="hf_edit" id = "hf_edit" value= <?php echo $row_patientinfo['Hospital_ID']; ?> />
			    <input name=permit type=hidden id=permit  value=<?php echo $permitUser ?>/>          
			    <input name=username type=hidden id=username  value=<?php echo $uid ?>/>          
			    <input name=fup type=hidden id=fup value= "1" />  
				<input type="hidden" name="planID" id = "planID" value = "<?php echo $planID;  ?>" />				
				<input type="hidden" name="planName" id = "planName" value = "<?php echo $dsets['PlanID'];  ?>" />
			    <input type="hidden" name="hf_edit" id = "hf_edit" value="<?php echo $hID?>" />
<!-- 			    <input type="hidden" name="updater" id = "updater" value="1" /> -->
				
				<button>보내기</button>
			</form>		    
		    
	
	
	    </td>
		
		
	</tr>

</table>