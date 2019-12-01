<?php
    include("ConnectDB.php");
    $result = array();
    mysqli_set_charset($con,"utf8");
    $sql = "select * from activity,user WHERE  activity.id_host = user.id";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>