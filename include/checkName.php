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
        $sql = "Insert into check_name(id_student,subject_id,check_lat,check_lng,ip_device,date_checked) values ('".$user_id."','".$subject."','".$lat."','".$lng."','".$macAddress."','".$date."')"; 
        if ($con->query($sql) === TRUE) {
            $result = "Success";
        } else {
            $result = "Error: " . $sql .  "<br>" .$con->error;
        }
    }
    else if($status == 2){
        $id_activity = $obj['id_activity'];
        $sql = "update join_activity set status_signin = 1, check_lat = '".$lat."', check_lng = '".$lng."', ip_device = '".$macAddress."', date_checked = '".$date."' where id_user = '". $user_id ."' and id_activity	='". $id_activity ."'"; 
         $sql2 = "SELECT user.volunteer,activity.volunteer_hour FROM activity,user WHERE activity.id = $id_activity and user.user_id = $user_id";
        $query = mysqli_query($con,$sql2);    
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $user_hour = $row['volunteer'];
            $activity_hour = $row['volunteer_hour'];
        }
        $sum_hour = $user_hour+ $activity_hour ;
        $sql3 = "update user set volunteer = $sum_hour where user_id = $user_id";
        if ($con->query($sql) === TRUE && $con->query($sql3) === TRUE) {
            $result = "Success";
        } else {
            $result = "Error: " . $sql .  "<br>" .$con->error;
        }
    }
    
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>