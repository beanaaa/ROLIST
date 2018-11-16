<?php
function mysqli_result($res,$row=0,$col=0)
{ 
	$nums=mysqli_num_rows($res);
	if($nums && $row<=($nums-1) && $row>=0)
	{
		mysqli_data_seek($res,$row);
		$resrow=(is_numeric($col))?mysqli_fetch_row($res):mysqli_fetch_assoc($res);
		if(isset($resrow[$col]))
		{
			return $resrow[$col];
		}
	}
	return false;
}
	
	// error_reporting(1);	
?>


<?php

backup_tables('localhost','root','dbsgksqls','test');

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  require_once("Connections/test.php");  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysqli_query($test, 'SHOW TABLES');
    while($row = mysqli_fetch_row($result))
    {
      $tables[] = $row[0];
    }
} else {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  
  foreach($tables as $table)
  {
    $result = mysqli_query($test, 'SELECT * FROM '.$table);
    $num_fields = mysqli_num_fields($result);
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($test, 'SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    for ($i = 0; $i < $num_fields; $i++)
    {
      while($row = mysqli_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++)
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = preg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
}
        $return.= ");\n";
      }
}
    $return.="\n\n\n";
  }
  $handle = fopen('backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  fwrite($handle,$return);
  fclose($handle);
} ?>