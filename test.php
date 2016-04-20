<?php
$hostname = 'localhost'; 
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
    switch ($_POST['getdata']) {
        case 'disease':
        #顯示所有疾病資料
            $tableName = $_POST['getdata'];
            // $disName = $_POST['disName'];
            $sql = "Select * from $tableName ";
            $result=$db->query($sql);
            // print_r($result);    
            // $row=$result->fetch(PDO::FETCH_OBJ);
            // print_r($row);
            while($row=$result->fetch(PDO::FETCH_OBJ)){    
                //PDO::FETCH_OBJ 指定取出資料的型態

                $json[$i]['disName'] = $row->disName;
                $json[$i]['info'] = $row->info;
                $json[$i]['symptomId'] = $row->symptomId; 
                // $json[$i]['info'] = "‧‧‧‧‧‧";

                
                $i++;
            }
            echo json_encode($json);
            break;
        
        case 'function':
        #查看某疾病的治療方式

        //add lan wei
            $tableName = $_POST['getdata'];
            $disName = $_POST['disName'];
            $sql = "Select * from $tableName where disName = '$disName'";
            $result=$db->query($sql);
            // print_r($result);    
            // $row=$result->fetch(PDO::FETCH_OBJ);
            // print_r($row);
            while($row=$result->fetch(PDO::FETCH_OBJ)){    
                //PDO::FETCH_OBJ 指定取出資料的型態

                $json[$i]['disName'] = $row->disName;
                $json[$i]['function'] = $row->function;
                switch ($row->functionType) {
                    case 'TC':
                        $json[$i]['functionType'] = "中醫";
                        break;
                    
                    case 'WM':
                        $json[$i]['functionType'] = "西醫";
                        break;
                    
                    case 'PE':
                        $json[$i]['functionType'] = "相關建議";
                        break;
                }
                $json[$i]['srcID'] = $row->srcID;

                
                
                $i++;
            }
            echo json_encode($json);
            break;

        case 'src':
        #查看此資料來源
            $tableName = $_POST['getdata'];
            $srcID = $_POST['srcID'];

            $sql = "Select * from $tableName where srcID = '$srcID'";
            $result=$db->query($sql);
            // print_r($result);    
            // $row=$result->fetch(PDO::FETCH_OBJ);
            // print_r($row);

            while($row=$result->fetch(PDO::FETCH_OBJ)){    
                //PDO::FETCH_OBJ 指定取出資料的型態
                // $json[$i]['srcID'] = $row->srcID;   
                // print_r($row);
                $json[$i]['srcName'] = $row->srcName;
                $json[$i]['info'] = $row->info;
                $json[$i]['index'] = $row->index;
                
                
                $i++;
            }
            echo json_encode($json);
            break;

        case 'addfun':
        #新增偏方
        #回傳值為 success or fail
            $tableName = 'function';
            $disName = $_POST['disName'];
            $function = $_POST['func'];
            $sql = "INSERT INTO `function`(`disName`, `function`, `functionType`) VALUES ('$disName','$function','PE')";
            $result=$db->query($sql);
            // print_r($result);
            
            if($result){
                echo "success";
            }
            else{
                echo "fail";
            }

            break;

        case 'pred':
            $tableName = 'disease_symId';
            $getvalue = $_POST['getvalue'];
            $sql = "SELECT disName,COUNT(disName) as c FROM $tableName 
                    WHERE symptomId in $getvalue GROUP BY disName HAVING c>=2";
            $result=$db->query($sql);

            while($row=$result->fetch(PDO::FETCH_OBJ)){    
                // PDO::FETCH_OBJ 指定取出資料的型態

                $json[$i]['disNam'] = $row->disName;

                $json[$i]['count'] = $row->c;


                
                $i++;
            }
            echo json_encode($json);
            break;
        case 'symptom':
        #顯示所有病徵
            $tableName = $_POST['getdata'];
            // $disName = $_POST['disName'];
            $sql = "Select * from $tableName  ORDER BY `symptom`.`symptomId` ASC";
            $result=$db->query($sql);
            // print_r($result);    
            // $row=$result->fetch(PDO::FETCH_OBJ);
            // print_r($row);
            while($row=$result->fetch(PDO::FETCH_OBJ)){    
                //PDO::FETCH_OBJ 指定取出資料的型態

                $json[$i]['symptomId'] = $row->symptomId;
                $json[$i]['symptomName'] = $row->symptomName;
                // $json[$i]['symptomId'] = $row->symptomId; 
                // $json[$i]['info'] = "‧‧‧‧‧‧";

                
                $i++;
            }
            echo json_encode($json);
            break;

        case 'addrecord':
            $tableName = "record";
            $BP = $_POST['BP'];
            $BG = $_POST['BG'];
            $datetime = $_POST['datetime']."";
            $sql = "INSERT INTO `record`(`no`, `BG`, `BP`, `datetime`) VALUES ('','$BG','$BP','$datetime')";
            $result=$db->query($sql);
            // print_r($result);
            
            if($result){
                echo "success";
            }
            else{
                echo "fail";
            }
            break; 
        case 'advice':
            // echo "123";
            $tableName = "function";
            $disName = $_POST['disName'];
            $function = $_POST['function'];
            $sql = "INSERT INTO `function`(`disName`, `function`, `functionType`) VALUES ('$disName','$function','PE')";
            $result = $db->query($sql);
            // print_r($result);
            if($result){
                echo "success";
            }
            else{
                echo "fail";
            }
            break;
// SELECT disName,COUNT(disName) as c FROM `disease_symId` WHERE symptomId in (1,2,3,4,6,8,9) GROUP BY disName HAVING c>=2
        
    }
    
    $db=null; //結束與資料庫連線
} 
catch(PDOException $e){
    //error message
    // echo $e->getMessage(); 
}
?>