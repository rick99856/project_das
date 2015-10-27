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
   	$sql = "UPDATE `project_das`.`dis` SET `danger` = $_POST['danger'], `infection` = $_POST['infection'],
   				`info` = $_POST['info'], `population` = $_POST['population'],`symptom` = $_POST['symptom'],
				`prevention` = $_POST['prevention'],`treatment` = $_POST['treatment'] WHERE `dis`.`name` = $_POST['name'];";

    $result = mysql_query($sql) or die('MySQL query error');
    echo $result;
?>
