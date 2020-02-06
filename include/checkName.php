<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
   
    $user_id = $obj['user_id'];
    $status = $obj['status'];
    $lat = $obj['lat'];
    $lng = $obj['lng'];
    $macAddress = $obj['macAddress'];
    $date = $obj['date'];
    if($status == 1){
        $subject = $obj['subject'];
        $room_lat = $obj['room_lat'];
        $room_lng = $obj['room_lng'];
        $time = $obj['time'];
        $sql = "Insert into check_name(id_student,subject_id,check_lat,check_lng,room_lat,room_lng,ip_device,date_checked,time) values ('".$user_id."','".$subject."','".$lat."','".$lng."','".$room_lat."','".$room_lng."','".$macAddress."','".$date."','".$time."')"; 
        if ($con->query($sql) === TRUE) {
            $result = "Success";
        } else {
            $result = "Error: " . $sql .  "<br>" .$con->error;
        }
    }
    else if($status == 2){
        $id_activity = $obj['id_activity'];
        $sql = "update join_activity set status_signin = 1, check_lat = '".$lat."', check_lng = '".$lng."', ip_device = '".$macAddress."', date_checked = '".$date."' where id_user = '". $user_id ."' and id_activity	='". $id_activity ."'"; 
         $sql2 = "SELECT user.volunteer,activity.volunteer_hour,activity.location_lat,activity.location_long FROM activity,user WHERE activity.id = $id_activity and user.user_id = $user_id";
        $query = mysqli_query($con,$sql2);    
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $user_hour = $row['volunteer'];
            $activity_hour = $row['volunteer_hour'];
            $location_lat = $row['location_lat'];
            $location_long = $row['location_long'];
        }
        $distance = getDistanceBetweenPoints($lat,$lng,$location_lat,$location_long);
        if($distance <= 100){
        $sum_hour = $user_hour+ $activity_hour ;
        $sql3 = "update user set volunteer = $sum_hour where user_id = $user_id";
        if ($con->query($sql) === TRUE && $con->query($sql3) === TRUE) {
            $result = "Success";
        } else {
            $result = "Error: " . $sql .  "<br>" .$con->error;
        }
        }else{
            if ($con->query($sql) === TRUE) {
                $result = "Success";
            } else {
                $result = "Error: " . $sql .  "<br>" .$con->error;
            }
    }
    }
    function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return (int)$meters; 
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>