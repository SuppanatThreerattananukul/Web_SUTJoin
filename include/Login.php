<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $username = $obj['username'];
    $password = $obj['password'];
    $email = $obj['email'];
    $phone = $obj['phone'];

    $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";

    // $sql = "Insert into user(name,surname,username,password,email,phone,user_gender,user_status,age) values ('".$name."','".$surname."','".$username."','".$password."','".$email."','".$phone."','".$gender."','".$status."','".$age."')";   
    if ($con->query($sql) === TRUE) {
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($response,$row);
    }
        $result = "Login Success Welcome " .$username. " Data => " .$response. "";
    } else {
        $result = "Error: " . $sql .  "<br>" .$con->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>