<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
 
    $user_id = $obj['user_id'];
    $result = array();
    $sql = "select name,surname,url,news_status,news_title,news_detail FROM user,news WHERE user_id = $user_id and news_status != 1";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        $myObj = (object)array();
        $myObj->news_status = $row["news_status"];
        $myObj->name = $row["name"];
        $myObj->surname = $row["surname"];
        $myObj->news_title = $row["news_title"];
        $myObj->news_detail = $row["news_detail"];
        $myObj->url = $row["url"];
        if($row["news_status"] > 0){
            $myObj->text1 = 'Hello, ' . $row["name"] . ' ' . $row["surname"];
            $myObj->text2 = "Let's join some events";
        }else{
            $myObj->text = null;
            $myObj->button_id = null;
        }
        $myJSON = json_encode($myObj);
        array_push($result,$myObj);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

           
?>