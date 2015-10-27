<?php
$mysql_db_hostname = "192.168.137.178";
$mysql_db_user = "s13113241";
$mysql_db_password = "hs9m322x";
$mysql_db_database = "project_das";


$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password);
if (!empty($_POST['name']) && !empty($_POST['danger'])&& !empty($_POST['infection'])
	&& !empty($_POST['info'])&& !empty($_POST['population'])&& !empty($_POST['symptom'])
	&& !empty($_POST['prevention'])&& !empty($_POST['treatment'])) {
	

	if (!$con) {
 		die('Could not connect: ' . mysql_error());
	}
	
	mysql_query("set names 'utf8'");


	mysql_select_db($mysql_db_database);
	$sql = "INSERT INTO `project_das`.`dis` (`no`, `name`, `danger`, `infection`, `info`, `population`, `symptom`, `prevention`, `treatment`) 
	   		VALUES ( NULL,$_POST['name'],$_POST['danger'],$_POST['infection'],$_POST['info'],$_POST['population'],$_POST['symptom'],$_POST['prevention'],$_POST['treatment']) ";

	    $result = mysql_query($sql) or die(mysql_error());
	    
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
