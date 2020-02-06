<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
 

    //  $id_user = (explode('"',$obj['id_user']));
    //  $id = $id_user[1];
    $user_id = $obj['user_id'];
    $status = $obj['status'];


     $result = array();
     if($status == 1){
        $sql = "SELECT id_subject,name_subject FROM subject WHERE id_subject in (SELECT DISTINCT subject_id FROM check_name WHERE id_student = $user_id)";
     }
     else if($status == 2){
        $id_student = $obj['id_student'];
        $sql = "SELECT * FROM check_name WHERE id_student = $user_id and subject_id = '$id_student'";
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