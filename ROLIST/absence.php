<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
<script>
$(function() {
  $( "#datepicker1" ).datepicker({
    dateFormat: 'm/d/y'
  });
});
</script>
    
<?php
include("configuration.php");
$conn = mysql_connect("localhost", "root", "dbsgksqls") or die(mysql_error());
mysql_select_db("test", $conn);

	
$uid = $_POST['username'];
$dates = $_POST['txt_date'];
$content = $_POST['txt_content'];
$mds = $_POST['physcianName'];
$deleteId = $_POST['ids'];
$DeleteQuery = sprintf("Delete from MdAbsence where id = '%s'", $deleteId);
$abss = mysql_query($DeleteQuery);






if(strlen($dates)>3){ 
	$InsertQuery = sprintf("Insert into MdAbsence (physician, date1, content) values ('%s', '%s', '%s')", $mds, $dates, $content);
	echo($InsertQuery);
	$abss = mysql_query($InsertQuery);
}

mysql_query("set session character_set_connection=latin1;");
mysql_query("set session character_set_results=latin1;");
mysql_query("set session character_set_client=latin1;");


?>

<table>
	<tr>
		<td>
			Index
		</td>
		<td>
			Physician
		</td>
		<td>
			Date
		</td>
		<td>
			Purpose
		</td>
	</tr>



<form action="absence.php" method=post>
<td>
<th   valign="top" align="right">
	
	
	<select name="physcianName">
		<option name="sitename" value=  selected> </option>
		
		<?php
		print_r($phyInt);
		for($idphys=0;$idphys<count($phyInt);$idphys++){
			echo("<option name=sitename value=$phyInt[$idphys] >$phyInt[$idphys]</option>");	
		}		

			
		?>
		
	</select>
	</th>

	<td>
	<input class="form-control"  name="txt_date" type="text" id="datepicker1" style="width:60px;"  value="" /> 
	</td>
	 <td>      
	<input class="form-control"  name="txt_content" type="text" id="test" style="width:60px;"  value="" />        
	 </td>
    <input type=hidden name="permit" id = "permit" value="<?php echo $permitUser?>" />
	<td>
	<input type="submit" value="Insert">
	</td>
	<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
	<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
	<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />				
	
</form>


<?php
$AbsenceQuery = "Select * from MdAbsence order by date1";
$abss = mysql_query($AbsenceQuery);
$numbers = mysql_num_rows($abss);

// echo($numbers);


for($idx = 0;$idx<$numbers;$idx++){
	$data = mysql_fetch_assoc($abss);
	
	$cellClr = "#FFFFFF";
	for($phyidss=0;$phyidss<$numphyss;$phyidss++){
		if(strcmp($data[physician],$phyInt[$phyidss])==0){
			$cellClr = $phyCol[$phyidss];

		}	
	}
	
	
	echo("<tr>");
	echo("<td>");	
	echo($data[id]);
	echo("</td>");	
	echo("<th bgcolor=$cellClr>");	
	echo($data[physician]);
	echo("</th>");	
	echo("<td>");	
	echo($data[date1]);
	echo("</td>");
	echo("<td>");	
	echo($data[content]);
	echo("</td>");
	
	echo  "<td bgcolor=$bgcolorF><form id=form5 name=form5 method=post  action=absence.php >";
	echo "<input type=submit name=btn_comment id=btn_comment value=Delete />";
	echo "<input name=ids type=hidden id=ids  value=$data[id]></form></td>";
	
	
	echo("</tr>");	
}
	
?>
</table>
