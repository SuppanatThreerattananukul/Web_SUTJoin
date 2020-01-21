<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
   
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

   $page = $obj['page'];
   $user_id = $obj['user_id'];
   $perpage = 10;
   $result = array();
   $start = ($page - 1) * $perpage;
    $sql = "select * from activity,user WHERE activity.id_host = user.user_id and activity.status != 1 and (id_host in(select id_following from follow where id_follower = $user_id) or type in(select learning from my_interests where id_user_interest =$user_id) or type in(select volunteer from my_interests where id_user_interest =$user_id) or type in(select recreation from my_interests where id_user_interest =$user_id) or type in(select hangout from my_interests where id_user_interest =$user_id) or type in(select travel from my_interests where id_user_interest =$user_id) or type in(select hobby from my_interests where id_user_interest =$user_id) or type in(select meet from my_interests where id_user_interest =$user_id)or type in(select eatanddrink from my_interests where id_user_interest =$user_id or description REGEXP (select group_concat(id_subject separator '|') from learning_user where id_user =$user_id)) or description REGEXP (select group_concat(name_subject separator '|') from learning_user where id_user =$user_id) or title REGEXP (select group_concat(id_subject separator '|') from learning_user where id_user =$user_id) or title REGEXP (select group_concat(name_subject separator '|') from learning_user where id_user =$user_id) or tag REGEXP (select group_concat(id_subject separator '|') from learning_user where id_user =$user_id) or tag REGEXP (select group_concat(name_subject separator '|') from learning_user where id_user =$user_id)) and DATE_FORMAT(date_start, '%Y-%m-%d %H:%i:%s') < DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') ORDER BY date_start DESC limit {$start} , {$perpage}";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>