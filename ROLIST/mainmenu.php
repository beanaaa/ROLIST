
<link href="js/font-awesome.min.css" rel="stylesheet">
<meta charset="utf-8">

<style type="text/css">
.menubutton{
border:0px solid #cacaca; -webkit-border-radius: 0px; -moz-border-radius: 0px;border-radius: 0px;font-size:11px;font-family:arial, helvetica, sans-serif; padding: 5px 5px 5px 5px; text-decoration:none; display:inline-block; color: #FFFFFF;
 background-color: #378EDA; background-image: -webkit-gradient(linear, left top, left bottom, from(#378EDA), to(#378EDA));
 background-image: -webkit-linear-gradient(top, #378EDA, #378EDA);
 background-image: -moz-linear-gradient(top, #378EDA, #378EDA);
 background-image: -ms-linear-gradient(top, #378EDA, #378EDA);
 background-image: -o-linear-gradient(top, #378EDA, #378EDA);
 background-image: linear-gradient(to bottom, #378EDA, #378EDA);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#378EDA, endColorstr=#378EDA);
    margin:0 auto;
    display:block;
}

.menubutton:hover{
 border:0px solid #b3b3b3;
 background-color: #61BB46; background-image: -webkit-gradient(linear, left top, left bottom, from(#61BB46), to(#61bb46));
 background-image: -webkit-linear-gradient(top, #61BB46, #61bb46);
 background-image: -moz-linear-gradient(top, #61BB46, #61bb46);
 background-image: -ms-linear-gradient(top, #61BB46, #61bb46);
 background-image: -o-linear-gradient(top, #61BB46, #61bb46);
 background-image: linear-gradient(to bottom, #61BB46, #61bb46);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#61BB46, endColorstr=#61bb46);
    margin:0 auto;
    display:block;
}

#menubutton form input {
    vertical-align: middle;
}
/* #378EDA: 파랑 */
/* #61BB46: 초록 */
.menubuttonSel{
border:0px solid #cacaca; -webkit-border-radius: 0px; -moz-border-radius: 0px;border-radius: 0px;font-size:11px;font-family:arial, helvetica, sans-serif; padding: 5px 5px 5px 5px; text-decoration:none; display:inline-block; color: #FFFFFF;
 background-color: #61BB46; background-image: -webkit-gradient(linear, left top, left bottom, from(#378EDA), to(#378EDA));
 background-image: -webkit-linear-gradient(top, #61BB46, #61BB46);
 background-image: -moz-linear-gradient(top, #61BB46, #61BB46);
 background-image: -ms-linear-gradient(top, #61BB46, #61BB46);
 background-image: -o-linear-gradient(top, #61BB46, #61BB46);
 background-image: linear-gradient(to bottom, #61BB46, #61BB46);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#61BB46, endColorstr=#61BB46);
    margin:0 auto;
    display:block;
}

.menubuttonSel:hover{
 border:0px solid #b3b3b3;
 background-color: #378EDA; background-image: -webkit-gradient(linear, left top, left bottom, from(#378EDA), to(#378EDA));
 background-image: -webkit-linear-gradient(top, #378EDA, #378EDA);
 background-image: -moz-linear-gradient(top, #378EDA, #378EDA);
 background-image: -ms-linear-gradient(top, #378EDA, #378EDA);
 background-image: -o-linear-gradient(top, #378EDA, #378EDA);
 background-image: linear-gradient(to bottom, #378EDA, #378EDA);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#378EDA, endColorstr=#378EDA);
    margin:0 auto;
    display:block;
}

menubuttonSel form input {
    vertical-align: middle;
}

ul{width:650px;height:30px;background:green;list-style:none}

ul li{float:left}

.container-1{
  width: 100px;
  vertical-align: middle;
  white-space: nowrap;
  position: relative;
}
.container-1 input#txt_search{
  width: 80px;
  height: 30px;
  background: #047cc0; /* cerulean 50 (ibm design colors) */
  border: none;
  font-size: 10pt;
  float: left;
  color: #262626;
  padding-left: 15px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
 
   
}.container-1 input#search::-webkit-input-placeholder {
   color: #65737e;
}
 
.container-1 input#search:-moz-placeholder { /* Firefox 18- */
   color: #65737e;  
}
 
.container-1 input#search::-moz-placeholder {  /* Firefox 19+ */
   color: #65737e;  
}
 
.container-1 input#search:-ms-input-placeholder {  
   color: #65737e;  
}
.container-1 .icon{
  position: absolute;
  top: 10%;
  margin-left: -63px;
  margin-top: 3px;
  z-index: 1;
  color: #4f5b66;
}
.container-1 input#search:hover, .container-1 input#search:focus, .container-1 input#search:active{
    outline:none;
    background: #ffffff;
  }
</style>

<?php
	$curPage = $_POST['curpage'];		

	if(strlen($curPage)<2){
		$curPage = "daily_report.php";
	}
?>

<table cellpadding = "0px" width="100%" border="0" align="center" cellspacing="0">
	<tr>
		<th bgcolor="#378EDA" height="40px">
			<table cellpadding = "0px" width="960px" border="0" align="center" cellspacing="0">
			<tr>
			<th>
			
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"daily_report.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="daily_report.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Physician>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "daily_report.php"; ?> />				
				</form>
			</div>
	
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"simschedule.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post target="_blank"  action="simschedule.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Scheduler>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />		
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "simschedule.php"; ?> />										
				</form>
			</div>
	
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"meetingmd.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="meetingmd.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Exam>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />			
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "meetingmd.php"; ?> />										
						
				</form>
			</div>
			
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"finrpt.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="finrpt.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Completed>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />		
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "finrpt.php"; ?> />										
							
				</form>
			</div>
			
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"advancedsearch.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="advancedsearch.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Adv-Search>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />		
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "advancedsearch.php"; ?> />										
							
				</form>
			</div>
	
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"daily_report_backup.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="daily_report_backup.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Daily>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />			
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "daily_report_backup.php"; ?> />										
						
				</form>
			</div>
			
			
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"daily_report_rtp.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="daily_report_rtp.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=RTP>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />			
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "daily_report_rtp.php"; ?> />				
						
				</form>
			</div>
			
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"daily_report_nurse_r2.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post   action="daily_report_nurse_r2.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Nurse>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />			
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "daily_report_nurse_r2.php"; ?> />				
						
				</form>
			</div>
			<?php
			$butSel = "menubutton";			
			if(strcmp($curPage,"stats.php")==0){
				$butSel = "menubuttonSel";
			}	
			?>
			
			<div style="float: left; ">
				<form method=post  target="_blank" action="monthlycount.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit name=btn_home id=btn_home value=Stat>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />			
					<input class=<?php echo($butSel);?> type = hidden name = curpage id = curpage value = <?php echo "monthlycount.php"; ?> />				
						
				</form>
			</div>
			
			
			
			
			<?php
			$butSel = "menubutton";			
			?>
			
			
			<div style="float: left; ">
				<form method=post target="_blank"  action="N_register_all.php">
					<input class=<?php echo($butSel);?> style="width: 76px;height: 40px;" type=submit  name=btn_home id=btn_home value=New-Patient>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />				
				</form>
			</div>
			<div style="float: left; ">
				<form method=post target="_blank"  action="absence.php">
					<input class=<?php echo($butSel);?> style="width: 56px;height: 40px;" type=submit name=btn_home id=btn_home value=Day-off>
					<input class=<?php echo($butSel);?> name=permit type=hidden id=permit value= <?php echo $permitUser ?>/>
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = mdname id = mdname value = <?php echo $md; ?> />				
					<input class=<?php echo($butSel);?> type = hidden name = username id = username value = <?php echo $uid; ?> />				
				</form>
			</div>
			
			</th>
	
			
			<th>
			
	
			<div  class="container-1" style="float: right; ">
			<form action=<?php echo $curPage; ?> method=post>		      
			      <input type="search" id="txt_search" style="width: 70px;height: 40px;" name="txt_search" placeholder="Search" />
				  <input  class=<?php echo($butSel);?> type="submit" style="width: 20px;height: 40px;"  value="🔍">
		
				    <input type=hidden name="permit" id = "permit" value="<?php echo $permitUser?>" />			
					<input type = hidden name = username	id =username value = "<?php echo $uid; ?>" />		
					<input type = hidden name = "mdname"	id ="mdname" value = "<?php echo $md; ?>" />	
					<input type = hidden name = "sitename"	id ="sitename" value = "<?php echo $siteInput; ?>" />							      
					<input type = hidden name = "curpage"	id ="curpage" value = "<?php echo $curPage; ?>" />	
					<input type = hidden name = curpage id = curpage value = <?php echo $curPage; ?> />				
											      
			</form>
			</div>				
			</th>
			</tr>
			</table>
		</th>
	</tr>
</table>
