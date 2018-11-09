<?php
$permitID = $_SESSION['MM_Username'];


	$uid = $permitID;

for($phsIds=0;$phsIds<$numphyss;$phsIds++){
if(strcmp($permitID,$phyLog[$phsIds])==0){
	$uid = $phyInt[$phsIds];
}


}


?>