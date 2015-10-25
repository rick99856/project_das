<?php
$mysql_db_hostname = "localhost";
$mysql_db_user = "s13113241";
$mysql_db_password = "hs9m322x";
$mysql_db_database = "project_das";


$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password);
// !empty()
if (!$con) {
 die('Could not connect: ' . mysql0erropr());
}
mysql_query("set names 'utf8'");


mysql_select_db($mysql_db_database);
   	$sql = "SELECT * FROM food join cag on food.cagID = cag.cagID";
    $result = mysql_query($sql) or die('MySQL query error');
    $i = 0;

     $json = array();
    while($row = mysql_fetch_array($result)){
        $json[$i]['name'] = $row['name'];
		$json[$i]['benefit'] = $row['benefit'];
		$json[$i]['defect'] = $row['defect'];
		$json[$i]['unfit'] = $row['unfit'];
		$json[$i]['ps'] = $row['ps'];
		$json[$i]['cagID'] = $row['cagID'];
		$json[$i]['cagname'] = $row['cagname'];

		$i++;
    }
	echo json_encode($json);



?>
