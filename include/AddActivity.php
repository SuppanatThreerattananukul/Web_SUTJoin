<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);
    $id_host =  (explode('"',$obj['id_host']));
    $date_start = $obj['datetimes'];
    $title = $obj['title'];
    $description = $obj['description'];
    $number_people = $obj['number_people'];
    $min_age = $obj['minage'];
    $max_age = $obj['maxage'];
    $location_name = $obj['location'];
    $type = $obj['type'];
    $tag = $obj['tag'];
    $image = $obj['image'];
    $gender = $obj['gender'];
    $latitude = $obj['latitude'];
    $longitude = $obj['longitude'];
    $address = $obj['address'];
    $volunteer = $obj['volunteer'];
    $random = rand(1000,9999);
    $sql = "Insert into activity(id_host,date_start,title,description,number_people,min_age,max_age,location_name,type,gender,photo,location_lat,location_long,location_address,tag,date_host,date_update,ramdom_code,volunteer_hour) values ('".$id_host[1]."','".$date_start."','".$title."','".$description."','".$number_people."','".$min_age."','".$max_age."','".$location_name."','".$type."','".$gender."','".$image."','".$latitude."','".$longitude."','".$address."','".$tag."',now(),now(),'".$random."','".$volunteer."')";   
    if ($con->query($sql) === TRUE) {
        $result = "Your activity create successfully";
        $lastId = $con->insert_id;
        $sql = "insert into notification(id_user,id_activity,status,readed,dateTime) values('".$id_host[1]."','".$lastId."',3,0,now())";
        $con->query($sql);
    } else {
        $result = "Error";
    }
    $query = mysqli_query($con,"SELECT * FROM tag where activity_tag ='".$tag."'");
    $num_rows = mysqli_num_rows($query);
    if($num_rows > 0){
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        $amount = $row['amount'] + 1;
    }
        $sql1 = "update tag set amount = '".$amount."' where activity_tag ='".$tag."'";
    }else{
        $sql1 = "insert into tag(activity_tag,amount) values ('".$tag."',1)";
    }
    if ($con->query($sql1) === TRUE) {
        $result = "Your activity create successfully";
    } else {
        $result = "Error";
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>