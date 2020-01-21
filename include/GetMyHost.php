<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
 
     // $id_host = $obj[''];
    //  $id_user = (explode('"',$obj['id_user']));
     $id = $obj['id_user'];
     $page = $obj['page'];
     $perpage = 10;
     $result = array();
     $start = ($page - 1) * $perpage;
    $sql = "select * FROM activity,user WHERE id_host =  $id and user_id =$id ORDER BY date_start DESC limit {$start} , {$perpage}";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>