<?php
$mysql_db_hostname = "192.168.137.178";
$mysql_db_user = "s13113241";
$mysql_db_password = "hs9m322x";
$mysql_db_database = "project_das";


$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password);
if(!empty($_POST['name']) && !empty($_POST['benefit']) && !empty($_POST['defect']
	&& !empty($_POST['unfit']) && !empty($_POST['ps']) && !empty($_POST['cagID'])){

	if (!$con) {
	 	die('Could not connect: ' . mysql_erropr());
	}
	mysql_query("set names 'utf8'");


	mysql_select_db($mysql_db_database);
	$sql = "INSERT INTO `project_das`.`food` (`no`, `name`, `benefit`, `defect`, `unfit`, `ps`, `cagID`) 
	   		VALUES ( NULL,$_POST['name'],$_POST['benefit'],$_POST['defect'],$_POST['info'],$_POST['population'],$_POST['symptom'],$_POST['prevention'],$_POST['treatment']) ";
	    $result = mysql_query($sql) or die('MySQL query error');
	    $i = 0;

	    if($result ==1){
	    	echo "success";
	    }
	    else{
	    	echo "error";
	    }

}
else{
	echo false;
}



?>
