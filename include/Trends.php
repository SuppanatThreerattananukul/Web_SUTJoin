<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);
    $status = $obj['status'];
    $result = array();
    if($status == 1){
        $sql = "SELECT * FROM tag ORDER BY amount desc LIMIT 5";
    } else if($status == 2) {
        $sql = "SELECT * FROM tag ORDER BY amount desc";
    }else{
        $page = $obj['page'];
        $perpage = 20;
        $start = ($page - 1) * $perpage;
        $sql = "SELECT * FROM tag ORDER BY amount desc limit {$start} , {$perpage}";
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