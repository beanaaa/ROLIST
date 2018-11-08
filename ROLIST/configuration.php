<?php

	include("mysql_compact.php");


   $filename = "param.cfg";
   $fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
   $tId=0;
   while(!feof($fp)){
   		$buffer = fgets($fp);
   		if(strlen($buffer)>3 and strcmp($buffer[0],"!")!=0){
   			$txts[$tId] = $buffer;
   			$tId++;
   		}

   }

   fclose($fp);


   for($ids=0;$ids<count($txts);$ids++){
   		$trimtxt = trim($txts[$ids]);
   		if(strcmp(substr($trimtxt,0,4),"Phys")==0){
   			$physId = $ids;
			$resm = substr($trimtxt,4,100);
			$lench = 0;
			for($tlen = 0; $tlen<strlen($resm);$tlen++){
				if(strcmp($resm[$tlen],":")!=0 and strcmp($resm[$tlen],";")!=0 and strcmp($resm[$tlen]," ")!=0){
					$numPhyss[$lench] = $resm[$tlen];
					$lench++;
				}
			}
			$numphyss = (int)(implode($numPhyss));			
   		}
   }


   for($ids=0;$ids<$numphyss;$ids++){
   		$phyItTemp = trim($txts[$physId+1+$ids*4]);
         $phyIdTemp = trim($txts[$physId+1+$ids*4+1]);
         $phyLogTemp = trim($txts[$physId+1+$ids*4+2]);
   		$phyColTemp = trim($txts[$physId+1+$ids*4+3]);

   		$phyInt[$ids] = substr($phyItTemp,0,strlen($phyItTemp)-1);
         $phyIdd[$ids] = substr($phyIdTemp,0,strlen($phyIdTemp)-1);
         $phyLog[$ids] = substr($phyLogTemp,0,strlen($phyLogTemp)-1);
   		$phyCol[$ids] = substr($phyColTemp,0,strlen($phyColTemp)-1);
   }
?>

<?php
   $filename = "param.cfg";
   $fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
   $tId=0;
   while(!feof($fp)){
         $buffer = fgets($fp);
         if(strlen($buffer)>3 and strcmp($buffer[0],"!")!=0){
            $txts[$tId] = $buffer;
            $tId++;
         }

   }

   fclose($fp);


   for($ids=0;$ids<count($txts);$ids++){
         $trimtxt = trim($txts[$ids]);
         if(strcmp(substr($trimtxt,0,4),"Plns")==0){
            $physId = $ids;
         $resm = substr($trimtxt,4,100);
         $lench = 0;
         for($tlen = 0; $tlen<strlen($resm);$tlen++){
            if(strcmp($resm[$tlen],":")!=0 and strcmp($resm[$tlen],";")!=0 and strcmp($resm[$tlen]," ")!=0){
               $numPhyss[$lench] = $resm[$tlen];
               $lench++;
            }
         }
         $numplnss = (int)(implode($numPhyss));       
         }
   }


   for($ids=0;$ids<$numplnss;$ids++){

         $phyItTemp = trim($txts[$physId+1+$ids*2]);
         $phyColTemp = trim($txts[$physId+1+$ids*2+1]);

         $plnInt[$ids] = substr($phyItTemp,0,strlen($phyItTemp)-1);
         $plnCol[$ids] = substr($phyColTemp,0,strlen($phyColTemp)-1);
   }
?>

<!-- READ Rooms FROM CFG FILE -->
<?php
   $filename = "param.cfg";
   $fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
   $tId=0;
   while(!feof($fp)){
   		$buffer = fgets($fp);
   		if(strlen($buffer)>3 and strcmp($buffer[0],"!")!=0){
   			$txts[$tId] = $buffer;
   			$tId++;
   		}

   }
   fclose($fp);


   for($ids=0;$ids<count($txts);$ids++){
   		$trimtxt = trim($txts[$ids]);
   		if(strcmp(substr($trimtxt,0,4),"Room")==0){
   			$RmsId = $ids;
			$resm = substr($trimtxt,4,100);
			$lench = 0;
			for($tlen = 0; $tlen<strlen($resm);$tlen++){
				if(strcmp($resm[$tlen],":")!=0 and strcmp($resm[$tlen],";")!=0 and strcmp($resm[$tlen]," ")!=0){
					$numPhyss[$lench] = $resm[$tlen];
					$lench++;
				}
			}
			$numrooms = (int)(implode($numPhyss));			
   		}
   }


   for($ids=0;$ids<$numrooms;$ids++){
   		$RmsItTemp = trim($txts[$RmsId+1+$ids*3]);
   		$RmsIdTemp = trim($txts[$RmsId+1+$ids*3+1]);
   		$RmsColTemp = trim($txts[$RmsId+1+$ids*3+2]);

   		$rmsInt[$ids] = substr($RmsItTemp,0,strlen($RmsItTemp)-1);
   		$rmsIdd[$ids] = substr($RmsIdTemp,0,strlen($RmsIdTemp)-1);
   		$rmsCol[$ids] = substr($RmsColTemp,0,strlen($RmsColTemp)-1);
   }
?>




<!-- READ Techniques FROM CFG FILE -->
<?php
   $filename = "param.cfg";
   $fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
   $tId=0;
   while(!feof($fp)){
   		$buffer = fgets($fp);
   		if(strlen($buffer)>3 and strcmp($buffer[0],"!")!=0){
   			$txts[$tId] = $buffer;
   			$tId++;
   		}

   }
   fclose($fp);


   for($ids=0;$ids<count($txts);$ids++){
   		$trimtxt = trim($txts[$ids]);
   		if(strcmp(substr($trimtxt,0,4),"Tech")==0){
   			$RmsId = $ids;
			$resm = substr($trimtxt,4,100);
			$lench = 0;
			for($tlen = 0; $tlen<strlen($resm);$tlen++){
				if(strcmp($resm[$tlen],":")!=0 and strcmp($resm[$tlen],";")!=0 and strcmp($resm[$tlen]," ")!=0){
					$numPhyss[$lench] = $resm[$tlen];
					$lench++;
				}
			}
			$numtech = (int)(implode($numPhyss));			
   		}
   }


   for($ids=0;$ids<$numtech;$ids++){
   		$RmsItTemp = trim($txts[$RmsId+1+$ids*3]);
   		$RmsIdTemp = trim($txts[$RmsId+1+$ids*3+1]);
   		$RmsColTemp = trim($txts[$RmsId+1+$ids*3+2]);

   		$techInt[$ids] = substr($RmsItTemp,0,strlen($RmsItTemp)-1);
   		$techIdd[$ids] = substr($RmsIdTemp,0,strlen($RmsIdTemp)-1);
   		$techCol[$ids] = substr($RmsColTemp,0,strlen($RmsColTemp)-1);
   }
?>

<!-- READ Category FROM CFG FILE -->
<?php
   $filename = "param.cfg";
   $fp = fopen($filename, "r") or die("파일열기에 실패하였습니다");
   $tId=0;
   while(!feof($fp)){
   		$buffer = fgets($fp);
   		if(strlen($buffer)>3 and strcmp($buffer[0],"!")!=0){
   			$txts[$tId] = $buffer;
   			$tId++;
   		}

   }
   fclose($fp);


   for($ids=0;$ids<count($txts);$ids++){
   		$trimtxt = trim($txts[$ids]);
   		if(strcmp(substr($trimtxt,0,4),"Catg")==0){
   			$RmsId = $ids;
			$resm = substr($trimtxt,4,100);
			$lench = 0;
			for($tlen = 0; $tlen<strlen($resm);$tlen++){
				if(strcmp($resm[$tlen],":")!=0 and strcmp($resm[$tlen],";")!=0 and strcmp($resm[$tlen]," ")!=0){
					$numPhyss[$lench] = $resm[$tlen];
					$lench++;
				}
			}
			$numcatg = (int)(implode($numPhyss));			
   		}
   }


   for($ids=0;$ids<$numcatg;$ids++){
   		$RmsItTemp = trim($txts[$RmsId+1+$ids]);

   		$catgInt[$ids] = substr($RmsItTemp,0,strlen($RmsItTemp)-1);
   }
?>