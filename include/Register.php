<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $username = $obj['username'];
    $name = $obj['name'];;
    $surname = $obj['surname'];;
    $password = $obj['password'];
    $email = $obj['email'];
    $phone = $obj['phone'];
    $gender = $obj['gender'];
    $status = $obj['status'];
    $age = $obj['age'];
    $profile = $obj['profile'];

    $sql = "Insert into user(name,surname,username,password,email,phone,user_gender,user_status,age,profile) values ('".$name."','".$surname."','".$username."','".$password."','".$email."','".$phone."','".$gender."','".$status."','".$age."','".$profile."')";   
    if ($con->query($sql) === TRUE) {
        $result = "Register Success Let's Join";
    } else {
        $result = "Error: " . $sql .  "<br>" .$con->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>