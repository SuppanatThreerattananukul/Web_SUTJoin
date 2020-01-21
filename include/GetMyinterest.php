<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];

    $result = array();
    $sql = "select * from my_interests WHERE id_user_interest = '".$user_id."' ";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>