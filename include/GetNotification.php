<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $user_id = $obj['user_id'];
    $status = $obj['status'];
    $result = array();
    if($status == 1){
        $page = $obj['page'];
        $perpage = 20;
        $start = ($page - 1) * $perpage;
        $sql = "select notification.id_notification,notification.status,user.name, user.profile,activity.id,activity.title,TIMESTAMPDIFF(
            MINUTE , notification.dateTime, NOW( ) ) AS 'Difference' FROM notification,activity,user WHERE (( activity.id = id_activity) and  (notification.id_user = user.user_id ) and ( (select id_host from activity where id = id_activity) = $user_id) and notification.status != 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY) or ( activity.id = id_activity) and  (notification.id_user = user.user_id ) and (notification.id_user in(SELECT DISTINCT id_following FROM follow, notification WHERE id_follower = $user_id ) ) and notification.status = 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY)) order by notification.dateTime desc limit {$start} , {$perpage}";
            $query = mysqli_query($con,$sql);    
            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
            {
                array_push($result,$row);
            }
    }else if($status == 2){
        $sql = "select notification.id_notification,notification.status,user.name, user.profile,activity.id,activity.title,TIMESTAMPDIFF(
            MINUTE , notification.dateTime, NOW( ) ) AS 'Difference' FROM notification,activity,user WHERE (( activity.id = id_activity) and  (notification.id_user = user.user_id ) and ( (select id_host from activity where id = id_activity) = $user_id) and notification.status != 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY) or ( activity.id = id_activity) and  (notification.id_user = user.user_id ) and (notification.id_user in(SELECT DISTINCT id_following FROM follow, notification WHERE id_follower = $user_id ) ) and notification.status = 3 and DATE(notification.dateTime) > (NOW() - INTERVAL 7 DAY)) and notification.readed = 0";
            $query = mysqli_query($con,$sql);    
            $result = mysqli_num_rows($query);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>