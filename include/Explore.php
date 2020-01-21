<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
 
    $text = $obj['text'];
    $page = $obj['page'];
    $filter = $obj['filter'];
    $perpage = 20;
    $result = array();
    $start = ($page - 1) * $perpage;
    //  array_push($result,'"search":"1"');
    if($filter == 2){
        if($text == 0){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and DATE_FORMAT(date_start, '%Y-%m-%d %H:%i:%s') < DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') ORDER BY date_start DESC limit {$start} , {$perpage}";
        }
        else {
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.type like '%$text%') and DATE_FORMAT(date_start, '%Y-%m-%d %H:%i:%s') < DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') ORDER BY date_start DESC limit {$start} , {$perpage}";
        }
    }
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?> 