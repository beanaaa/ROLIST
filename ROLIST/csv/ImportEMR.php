

<?php
// 	require_once('/var/www/html/Connections/test.php'); 
 	require_once('test.php'); 
	
	$row = 1;
	$fp = fopen("emr.csv","r");
	
// 	Change character set for Korean Patient Name
	mysql_query("set session character_set_connection=latin1;");
	mysql_query("set session character_set_results=latin1;");
	mysql_query("set session character_set_client=latin1;");

	setlocale(LC_CTYPE, 'ko_KR.utf8'); 
	while($line = fgetcsv($fp,10000,',')){ 
		if($row!=1){ 
			$num = count($line); 
			$content = iconv("euc-kr","utf-8",$line[0]); 	
			$Hospital_ID = $content;   
			
			$content = iconv("euc-kr","utf-8",$line[4]); 	
			$KorName = $content;   

			$content = iconv("euc-kr","utf-8",$line[5]); 	
			$rtNumber = $content;   
			
			$content = iconv("euc-kr","utf-8",$line[11]); 	
			$In = $content;   
			
			$content = iconv("euc-kr","utf-8",$line[8]); 	
			$category = $content;   

			$content = iconv("euc-kr","utf-8",$line[18]); 	
			$nurseNote = $content;   
			
			$content = iconv("euc-kr","utf-8",$line[4]); 	
			$kName = $content;   

			$content = iconv("euc-kr","utf-8",$line[12]); 	
			$phys= $content;   
			
			$content = iconv("euc-kr","utf-8",$line[6]); 	
			$Sx = substr($content,0,1);
			$Ag  = substr($content,2,strlen($content)-2);
			$rtYear = substr($rtNumber,2,3);
			$rtId = substr($rtNumber,5,4);
			$rtNumRefined = "RTY-".$rtYear."-".$rtId;
			
			$cats = substr($category,0,6);
			if(strcasecmp($cats,"breast")==0){
				mysql_query("UPDATE TreatmentInfo SET primarysite = 'BRST' WHERE Hospital_ID = '$Hospital_ID'");			
			}			
			
			if(strcmp(substr($kName,0,4),"미)")==0){
				$kName = substr($kName,4, strlen($kName)-4 );
			}
			
			echo("<br>");
			mysql_query("use test");
			mysql_query("UPDATE PatientInfo SET Inp = '$In', NurseNote = '$nurseNote', KorName = '$kName', Sex = '$Sx', Age = '$Ag', RO_ID = '$rtNumRefined' WHERE Hospital_ID = '$Hospital_ID'");
			echo("UPDATE PatientInfo SET Inp = '$In', NurseNote = '$nurseNote', KorName = '$kName', Sex = '$Sx', Age = '$Ag', RO_ID = '$rtNumRefined' WHERE Hospital_ID = '$Hospital_ID'");
			echo("<br>");

			$content = iconv("euc-kr","utf-8",$line[7]); 	
			$Cat = $content;   

			if((strcmp($Cat,"CT")==0)){ 
				$content = iconv("euc-kr","utf-8",$line[10]); 	
				$nurseSim = $content;   
				mysql_query("UPDATE ClinicalInfo SET SimOrderEmr = '$nurseSim' WHERE Hospital_ID = '$Hospital_ID'");				
			}
		}	
		$row++; 	
	}
		
?>