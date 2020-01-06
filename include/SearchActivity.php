<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $text = $obj['text'];
    $page = $obj['page'];
    $filter = $obj['filter'];
    $searchfil = '';
    $perpage = 20;
    $result = array();
    $start = ($page - 1) * $perpage;
    if($filter == 1){
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.title like '%$text%') limit {$start} , {$perpage}";
    }
    else if($filter == 2){
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.type like '%$text%') limit {$start} , {$perpage}";
    }
    else if($filter == 3){
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.tag like '%$text%') limit {$start} , {$perpage}";
    }
    else if($filter == 4){
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.gender like '%$text%') limit {$start} , {$perpage}";
    }
    else if($filter == 5){
        $hourStart = 0;
        $hourEnd = 0;
        if($text == 2){
            $hourStart = 1;
            $hourEnd = 10;
        }
        else if($text == 3){
            $hourStart = 11;
            $hourEnd = 20;
        }
        else if($text == 4){
            $hourStart = 21;
            $hourEnd = 30;
        }
        else if($text == 5){
            $hourStart = 31;
            $hourEnd = 40;
        }
        else if($text == 6){
            $hourStart = 41;
            $hourEnd = 50;
        }
        else if($text == 7){
            $hourStart = 51;
            $hourEnd = 9999;
        }       
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.volunteer >= '$hourStart' and activity.volunteer <= '$hourEnd') limit {$start} , {$perpage}";
    }
    else if($filter == 6){
        $ageEnd = 0;
        if($text == 1){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 10) limit {$start} , {$perpage}";
        }
        else if($text == 2){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 20) limit {$start} , {$perpage}";
        }
        else if($text == 3){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 30) limit {$start} , {$perpage}";
        }
        else if($text == 4){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 40) limit {$start} , {$perpage}";
        }
        else if($text == 5){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 50) limit {$start} , {$perpage}";
        }
        else if($text == 6){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.max_age <= 60) limit {$start} , {$perpage}";
        }
        else if($text == 7){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.min_age >= 60) limit {$start} , {$perpage}";
        }       
    
    }
    else if($filter == 7){
        if($text == 1){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.date_start = CURRENT_DATE()) limit {$start} , {$perpage}";
        }
        else if($text == 2){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (YEARWEEK(activity.date_start, 1) = YEARWEEK(CURDATE(), 1)) limit {$start} , {$perpage}";
        }
        else if($text == 3){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (MONTH(activity.date_start) = MONTH(CURRENT_DATE()) AND YEAR(activity.date_start) = YEAR(CURRENT_DATE())) limit {$start} , {$perpage}";
        }
        else if($text == 4){
            $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (YEAR(activity.date_start) = YEAR(CURRENT_DATE())) limit {$start} , {$perpage}";
        }
   
    }
    else if($filter == 8){
        $peopleStart = 0;
        $peopleEnd = 0;
        if($text == 1){
            $peopleStart = 1;
            $peopleEnd = 10;
        }
        else if($text == 2){
            $peopleStart = 11;
            $peopleEnd = 20;
        }
        else if($text == 3){
            $peopleStart = 21;
            $peopleEnd = 30;
        }
        else if($text == 4){
            $peopleStart = 31;
            $peopleEnd = 40;
        }
        else if($text == 5){
            $peopleStart = 41;
            $peopleEnd = 50;
        }
        else if($text == 6){
            $peopleStart = 51;
            $peopleEnd = 60;
        }
        else if($text == 7){
            $peopleStart = 60;
            $peopleEnd = 999999;
        }
    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.number_people >= '$peopleStart' and activity.number_people <= '$peopleEnd') limit {$start} , {$perpage}";
    }
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>