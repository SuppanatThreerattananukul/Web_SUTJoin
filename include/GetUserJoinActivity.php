<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
 
     // $id_host = $obj[''];
     $id = $obj['id'];
    $result = array();
    $sql = "select name,surname,user_id,profile FROM user WHERE user_id IN (SELECT id_user from join_activity WHERE id_activity = $id)";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>