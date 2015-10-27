<?php
$mysql_db_hostname = "192.168.137.178";
$mysql_db_user = "s13113241";
$mysql_db_password = "hs9m322x";
$mysql_db_database = "project_das";


$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password);

if (!$con) {
 die('Could not connect: ' . mysql_error());
}
mysql_query("set names 'utf8'");


mysql_select_db($mysql_db1_database);
   	$sql = "UPDATE `project_das`.`food` SET `benefit` = $_POST['benefit'], `defect` = $_POST['defect'],
   				`unfit` = $_POST['unfit'], `ps` = $_POST['ps'] WHERE `dis`.`name` = $_POST['name'];";

    $result = mysql_query($sql) or die('MySQL query error');
    echo $result;
?>
