<?php
$hostname = '192.168.137.178'; 
$username = 's13113241'; 
$password = 'hs9m322x';
$db_name = "new_project_utra";

try{
    $db=new PDO("mysql:host=".$hostname.";dbname=".$db_name, $username, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                //PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
                
    //echo '連線成功';
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //錯誤訊息提醒
    $i = 0;
    $json = array();
    //Query SQL
    // $sql="Select * from du where num=3";
    $sql = "Select * from function";
    $result=$db->query($sql);
    // print_r($result);    
    $row=$result->fetch(PDO::FETCH_OBJ);
    // print_r($row);
    while($row=$result->fetch(PDO::FETCH_OBJ)){    
        //PDO::FETCH_OBJ 指定取出資料的型態

        // $json[$i]['disNamee'] = $row->disName;
        // $json[$i]['info'] = $row->info;
        // $json[$i]['symptomId'] = $row->symptomId; 
        $i++;
    }
    // echo json_encode($json);
    echo $i;
    
    //Insert
    // $count=$db->exec("insert into act(cn_title,eng_title) values('新聞', 'troy')");
    // echo $count;        
    
    
    //Update
    // $count=$db->exec("update act set cn_title='中文' where num=3");
    
    $db=null; //結束與資料庫連線
} 
catch(PDOException $e){
    //error message
    // echo $e->getMessage(); 
}
?>