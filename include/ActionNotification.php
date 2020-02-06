<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);
    $user_id = $obj['user_id'];
    $status = $obj['status'];
    $result = array();
    // $id_host = $obj[''];
    if($status == 1){
    $sql = "select notification.id_notification FROM notification,activity,user WHERE (( activity.id = id_activity) and  (notification.id_user = user.user_id ) and ( (select id_host from activity where id = id_activity) = $user_id) and notification.status != 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY) or ( activity.id = id_activity) and  (notification.id_user = user.user_id ) and (notification.id_user in(SELECT DISTINCT id_following FROM follow, notification WHERE id_follower = $user_id ) ) and notification.status = 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY))  ";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                array_push($result,$row['id_notification']);
            }
            $id_in = implode(",",$result);
            $sql2 = "update notification set readed = 1 where id_notification in($id_in)and readed = 0";
            $query = mysqli_query($con,$sql2); 
            $result = true; 
    }else if($status == 2){ 
    $sql1 = "select notification.id_notification FROM notification,activity,user WHERE (( activity.id = id_activity) and  (notification.id_user = user.user_id ) and ( (select id_host from activity where id = id_activity) = $user_id) and notification.status != 3 and DATE(notification.dateTime) < (NOW() - INTERVAL 7 DAY)  or ( activity.id = id_activity) and  (notification.id_user = user.user_id ) and (notification.id_user in(SELECT DISTINCT id_following FROM follow, notification WHERE id_follower = $user_id ) ) and notification.status = 3  and DATE(notification.dateTime) < (NOW() - INTERVAL 7 DAY))";
    $query = mysqli_query($con,$sql1);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row['id_notification']);
        
    }
    $id_in = implode(",",$result);
    $sql2 = "delete from notification where id_notification in($id_in)";
        $query = mysqli_query($con,$sql2);  
        $result = true;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($sql2, JSON_UNESCAPED_UNICODE);
?>