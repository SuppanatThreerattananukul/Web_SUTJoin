<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $status = $obj['status'];
    $id = $obj['id'];
    $id_user = (explode('"',$obj['id_user']));
    
    if($status == "add"){
        $inviter = $obj['inviter'] + 1;
        $sql = "Insert into join_activity(id_user,id_activity,status_signin) values ('".$id_user[1]."','".$id."',0)";
        $sql1 = "Update activity Set inviter = '".$inviter."' where id = ".$id ;  
        if (($con->query($sql) === TRUE) && ($con->query($sql1) === TRUE)) {
            $result = "Add record successfully";
        } else {
            $result = "Error: "  .$con->error;
        }
    }
    else if ($status == "cancel"){
        $inviter = $obj['inviter'] - 1;
        $sql = "delete from join_activity WHERE id_user = $id_user[1] and id_activity =  $id ";
        $sql1 = "Update activity Set inviter = '".$inviter."' where id = ".$id ;  
        if (($con->query($sql) === TRUE) && ($con->query($sql1) === TRUE)) {
            $result = "Delete record successfully";
        } else {
            $result = "Error: "  .$con->error;
        }
    }

    if($status == "update"){
        $sql1 = "Update activity Set status = 1 Where id =".$id ;  
        if  ($con->query($sql1) === TRUE) {
            $result = "Update record successfully";
        } else {
            $result = "Error: "  .$con->error;
        }
    }

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>