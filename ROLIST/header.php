<html>
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

if($_POST['permit']!=''){
	$permitUser = $_POST['permit'];
}
}

if ($permitUser ==1 | $permitUser ==2 | $permitUser ==3){
	require_once('Connections/test.php'); 
}
else{
		$MM_restrictGoTo = "index.php";
		header("Location: ". $MM_restrictGoTo); 
		require_once('Connections/test.php'); 
}
?>

<html lang="ko">
<head>
<meta http-equiv="refresh" content="600;url=index.php"> 
<script type="text/javascript" src="http://www.amcharts.com/lib/3/amcharts.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/pie.js"></script>
<script type="text/javascript" src="http://www.amcharts.com/lib/3/themes/none.js"></script>


  <style type="text/css">
	  
/*
input[type=text] {
    padding:5px; 
    border:2px solid #ccc; 
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
*/

/*
input[type=text]:focus {
    border-color:#333;
}
*/
.HeaderButton {
    padding:5px 10px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 2px;
    border-radius: 2px; 
    font-size: 12px;
}	  
/*
input[type=button] {
    padding:5px 10px; 
    background:#ccc; 
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px; 
}	  
*/
/*
select {
    padding:5px; 
    border:2px solid #ccc; 
    height: 20px;
    width: 70px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}	  
*/
/*
#chartdiv {
	width		: 100%;
	height		: 300px;
	font-size	: 11px;
}	
#chartdiv2 {
	width		: 100%;
	height		: 300px;
	font-size	: 11px;
}	
	  
  #apDiv1 {
    position: absolute;
    width: 1055px;
    height: 115px;
    z-index: 1;
    left: -1px;
    top: 111px;
  }
*/
  
/*
  body,td,th {
    font-family: Trebuchet-MS, Geneva, sans-serif;
    color: #000000;
    font-size: 12px;
    text-align: center;
  }
*/
  

/*
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
  a:active {
    color: #069;
  }
*/
  </style>
  <link type="text/css" rel="stylesheet" href="modalLayer.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript" src="jquery.modalLayer.js"></script>
  <script type="text/javascript">
	  
  jQuery(document).ready(function($) {
    $('.open_modal').modalLayer();
  });
  </script>

  <meta charset="utf-8">
  <title>Fixed Header</title>
  <style>
  #mask {  
    position:absolute;  
    z-index:9000;  
    background-color:#000;  
    display:none;  
    left:0;
    top:0;
  } 
  #MainTable {
    width: 100%;
    background-color: #D8F0DA;
    border: 0px;
    min-width: 100%;
    /*position: relative;*/
    opacity: 0.5;
    background: transparent;
  }
  .window{
    display: none;
    position:relative;  

    width: 100%;
    height: 100%;
/*     left:30%; */
/*     top:30%; */
    z-index:10000;
  }
  body {
    /*background-color: #AAAAAA;*/
    margin: 0px ; 
    padding: 0px;
  }
  .header {
    text-align: left;
  }
  .jq_menu {
    text-align: left;
    background: rgba(0,85,160,0.8);
    padding: 10px 0px;
    width: 100%;
    height:35px;
    z-index:99;
    position:relative;
    -webkit-box-shadow: 0 2px 4px 0 #777;
    box-shadow: 0 2px 4px 0 #777;
  }
  .wrapper {
    min-height: 500px;
  }
  .jq_fixed {
    position: fixed;
    top: 0px;

  }
  #layer_fixed
  {
    height:40px;
    width:100%;
    color: #555;
    font-size:12px;
    position:fixed;
    z-index:999;
    bottom:0px;
    left:0px;
    -webkit-box-shadow: 0 1px 2px 0 #777;
    box-shadow: 0 1px 2px 0 #777;
    background: rgba(47,137,50,0.8);

  }

  </style>
  
<link type="text/css" rel="stylesheet" href="modalLayer.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="jquery.modalLayer.js"></script>
<script type="text/javascript">
	  
jQuery(document).ready(function($) {
	$('.open_modal').modalLayer();
});
</script>

<meta charset="utf-8">
<title>Fixed Header</title>
  
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
  
  
<table align="right">
	<tr>
	<p style="font-size: 8px; font-weight: bold; color: #999999;" valign = "top" align = "right"> 
	<a href=index.php style=color: #999999>LOGOUT </a> | SITEMAP | <a href="N_register_all.php?permitUser=<?php echo $permitUser ?>" style="color: #999999" >NEW PATIENT</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#person_request" class="open_modal" style="color: #999999">NEW PATIENTs</a> &nbsp;&nbsp;
	</p>	
	</tr>
</table>

<!--
<div class="header" style="padding:30px;">
  <p style="font-size: 20px; font-weight: bold; color: #999999;" valign = "center"> <a href="testphpr2.php">     
    <img src="logo.gif" alt="" width="221" height="40" /></a>  </p>
  </h1></th>

  <p> </p>
  <p> </p>

</div>
-->


<div class="jq_menu">
<table>
<tr>
	
<th>
<form  id=form11 name=form11 method=post action="testphpr2.php">
<input class="HeaderButton" type=submit name=btn_home id=btn_home value=HOME />
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></form></th>

<th>
<form id=form16 name=form16 method=post action="daily_report.php">
<input class="HeaderButton" type=submit name=btn_cdl id=btn_cdl value=DAILY-SCHEDULE />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<th>
<form id=form12 name=form12 method=post action="live.php">
<input class="HeaderButton" type=submit name=btn_today id=btn_today value=ACTIVE-PATIENTS/>
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></form></th>

<th>
<form id=form13 name=form13 method=post action="test_2.php">
<input class="HeaderButton" type=submit name=btn_today id=btn_today value=YK />
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></form></th>

<th>
<form id=form14 name=form14 method=post action="test_3.php">
<input class="HeaderButton" type=submit name=btn_today id=btn_today value=JaL />
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></form></th>

<th>
<form id=form15 name=form15 method=post action="test_4.php">
<input class="HeaderButton" type=submit name=btn_force id=btn_force value=JuL />
<input name=permit type=hidden id=permit value= <?php echo $permitUser ?>/></form></th>


<th>
<form id=form13 name=form13 method=post action="testphpr2_test.php">
<input class="HeaderButton" type=submit name=btn_stat id=btn_stat value=STATISTICS />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<th>
<form id=form16 name=form16 method=post action="calendar.php">
<input class="HeaderButton" type=submit name=btn_cdl id=btn_cdl value=CALENDAR />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>


<th>
<form id=form116 name=form116 method=post action="W_Complete.php">
<input class="HeaderButton" type=submit name=btn_w_complete id=btn_w_complete value=INCOMPLETION />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<th>
<form id=form116 name=form116 method=post action="simschedule.php">
<input class="HeaderButton" type=submit name=btn_w_complete id=btn_w_complete value=SIM-SCHEDULER />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<th>
<form id=form116 name=form116 method=post action="breasteblist.php">
<input class="HeaderButton" type=submit name=btn_w_complete id=btn_w_complete value=BREAST-EB-LIST />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<th>
<form id=form116 name=form116 method=post action="daily_report_fin.php">
<input class="HeaderButton" type=submit name=btn_w_complete id=btn_w_complete value=QUERY-SEARCH />
<input name=permit type=hidden id=permit value = <?php echo $permitUser ?> /></form></th>

<!--
<th>
	<p style="font-size: 12px; font-weight: bold; color: #FFFFFF;">
	<a href="#person_request2" class="open_modal" style="color:#FFFFFF">SEARCH</a>
</th>
-->

</tr>
</table>     
</div>
</head>


<body>
<!-- Body starts here!!! -->
<script type="text/javascript">
	var detail = 0;
	
	function add_item(){
		// pre_set 에 있는 내용을 읽어와서 처리..
		var div = document.createElement('div');
		div.innerHTML = document.getElementById('pre_set').innerHTML;
		document.getElementById('field').appendChild(div);
		detail = detail + 1;
	}
	
	function remove_item(obj){
		document.getElementById('field').removeChild(obj.parentNode);
	}
	var detail = 0;
</script>

</html>
