<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
    //  $json = file_get_contents('php://input');
    
    //  // decoding the received JSON and store into $obj variable.
    //  $obj = json_decode($json,true);
 
    //  // $id_host = $obj[''];
    //  $id_user = (explode('"',$obj['id_user']));
    //  $id = $id_user[1];
    //  $status = $obj['status'];
     $result = array();
    //  array_push($result,'"search":"1"');
    $sql = "Select * from my_interests where id_user_interest = 52";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?> 