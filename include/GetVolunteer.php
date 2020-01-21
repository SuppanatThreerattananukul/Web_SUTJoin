<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];


    $result = array();
    $sql = "SELECT * FROM join_activity JOIN activity ON join_activity.id_activity = activity.id
    WHERE join_activity.id_user = '".$user_id."' AND join_activity.status_signin = '1' AND activity.type = '2';";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);