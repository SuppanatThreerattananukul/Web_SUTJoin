<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    $grade = $obj['grade'];
    $term = $obj['term'];
    $subject_id = $obj['subject_id'];

    $subject_name = '';
    $credit = 0;

    $user_id = (explode('"',$obj['user_id']));
    $id = $user_id[1];
    // $id = 52;

    $sql = "SELECT * FROM subject WHERE id_subject = '".$subject_id."'";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    if($row > 0)
    {
        $subject_name = $row['name_subject'];
        $credit = $row['credit'];

    }else{

        $result = "Can't Add Course";
    }
    }

        $sql_insert = "INSERT INTO learning_user (
            id_user,
            id_subject,
            name_subject,
            grade,
            term,
            credit
            )VALUES(
            '".$id."',
            '".$subject_id."',
            '".$subject_name."',
            '".$grade."',
            '".$term."',
            '".$credit."'
            )";

            if ($con->query($sql_insert) === TRUE) {
                $result = "Add Course Success";
            } else {
                $result = "Error: " . $sql_insert .  "<br>" .$con->error;
            }
    
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>