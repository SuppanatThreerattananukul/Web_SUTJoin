<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $text = $obj['text'];
    $page = $obj['page'];
    $status = $obj['status'];
    $perpage = 20;
    $result = array();
    $start = ($page - 1) * $perpage;
    if($status==1){
        $sql = "select * from user WHERE  (name like '%$text%' or surname like '%$text%' or username like '%$text%')  limit {$start} , {$perpage}";
    }else if($status==2){
        $sql = "select * from user WHERE  user_id = $text";
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