<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $user_id = $obj['user_id'];
    $username = $obj['username'];
    $name = $obj['name'];;
    $surname = $obj['surname'];;
    $password = $obj['password'];
    $email = $obj['email'];
    $phone = $obj['phone'];
    $gender = $obj['gender'];
    $status = $obj['status'];
    $birthday = $obj['birthday'];
    $profile = $obj['profile'];
    $student_id = $obj['student_id'];

    $sql = "UPDATE USER SET 
    name = '".$name."',
    surname = '".$surname."',
    username = '".$username."',
    password = '".$password."',
    email = '".$email."',
    phone = '".$phone."',
    user_gender = '".$gender."',
    user_status = '".$status."',
    birthday = '".$birthday."',
    profile = '".$profile."',
    student_id = '".$student_id."'
    WHERE user_id = '".$user_id."'";   

    if ($con->query($sql) === TRUE) {
        $result = "Success Let's Join";
    } else {
        $result = "Error: " . $sql .  "<br>" .$con->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>
