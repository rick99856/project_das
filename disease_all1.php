<?php
$dsn = 'mysql:dbname =project_das;host = 192.168.137.178 ';
$user = 's13113241';
$passwd = 'hs9m322x';

try{
	$link = new PDO($dsn,$user,$passwd);
}catch(PDOException $e){
	printf("DatabaseError: %s",$e->getMessage());
}


// echo phpversion();
list($sid) =$link ->query("select * from dis")->fetch();

$link = null;




?>