<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $id = $obj['id'];
    $id_user = $obj['id_user'];
    $result = array();
    $sql = "select * from join_activity WHERE  id_user = $id_user and id_activity = $id";
    $query = mysqli_query($con,$sql);    
    $result = mysqli_num_rows($query);
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>