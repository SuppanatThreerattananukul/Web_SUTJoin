<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $inviter = $obj['inviter'] +1;
    $id = $obj['id'];
    $id_user = $obj['id_user'];
    $sql = "Insert into join_activity(id_user,id_activity,status_signin) values ('".$id_user."','".$id."',0)";
    $sql1 = "Update activity Set inviter = '".$inviter."' where id = ".$id ;  
    if (($con->query($sql) === TRUE) && ($con->query($sql1) === TRUE)) {
        $result = "New record created successfully";
    } else {
        $result = "Error: "  .$con->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>