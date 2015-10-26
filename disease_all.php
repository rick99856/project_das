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


mysql_select_db($mysql_db_database);
   	$sql = "SELECT * FROM dis";
    $result = mysql_query($sql) or die('MySQL query error');
    $i = 0;

     $json = array();
    while($row = mysql_fetch_array($result)){
        $json[$i]['name'] = $row['name'];
		$json[$i]['danger'] = $row['danger'];
		$json[$i]['infection'] = $row['infection'];
		$json[$i]['info'] = $row['info'];
		$json[$i]['population'] = $row['population'];
		$json[$i]['symptom'] = $row['symptom'];
		$json[$i]['prevention'] = $row['prevention'];
		$json[$i]['treatment'] = $row['treatment'];

		$i++;
    }
	echo json_encode($json);



?>
