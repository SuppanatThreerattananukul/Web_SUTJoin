<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $date_start = $obj['datetimes'];
    $title = $obj['title'];
    $description = $obj['description'];
    $number_people = $obj['number_people'];
    $min_age = $obj['minage'];
    $max_age = $obj['maxage'];
    $location_name = $obj['location'];
    $type = $obj['tag'];
    $gender = $obj['gender'];
    $sql = "Insert into activity(id_host,date_start,title,description,number_people,min_age,max_age,location_name,type,gender) values (1,'".$date_start."','".$title."','".$description."','".$number_people."','".$min_age."','".$max_age."','".$location_name."','".$type."','".$gender."')";   
    if ($con->query($sql) === TRUE) {
        $result = "New record created successfully";
    } else {
        $result = "Error: " . $sql . "<br>" . $query . "<br>" .$conn->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>