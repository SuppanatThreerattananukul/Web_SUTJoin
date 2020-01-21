<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];
        // $user_id = 52;
        $id_subject = $obj['id_subject'];

        $result = array();

    $sql = "DELETE FROM learning_user WHERE id_user='".$user_id."' AND id_subject='".$id_subject."'";
    $query = mysqli_query($con,$sql);    
    
    if ($con->query($sql) === TRUE) {
        $result = "Delete Success";
    } else {
        $result = "Error: " . $sql .  "<br>" .$con->error;
    }

    // $final_score1 = int($final_score1);

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>