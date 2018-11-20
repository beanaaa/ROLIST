<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$database = 'test';
$user = 'root';
$pass = 'dbsgksqls';
$host = 'localhost';
$dir = dirname("") . 'backup/dump.sql';
echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
exec("/Applications/MAMP/Library/bin/mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
var_dump($output);

?>