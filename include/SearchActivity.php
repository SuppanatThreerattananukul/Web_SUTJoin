<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $text = $obj['text'];
    $page = $obj['page'];
    $valueType = $obj['valueType'];
    $valueGender = $obj['valueGender'];
    $valueVolunteer = $obj['valueVolunteer'];
    $valueAge = $obj['valueAge'];
    $valueDate = $obj['valueDate'];
    $valuePeople = $obj['valuePeople'];
    $perpage = 20;
    $result = array();
    $start = ($page - 1) * $perpage;

    $sql = "select * from activity,user WHERE  (activity.id_host = user.user_id and activity.status != 1) and (activity.title like '%$text%' or activity.tag like '%$text%')";

    if($valueType != 0){
        $sql .= "and (activity.type like '%$valueType%')";
    }
    if($valueGender != 0){
        $sql .= "and (activity.gender like '%$valueGender%')";
    }
    if($valueVolunteer != 0){
        $hourStart = 0;
        $hourEnd = 0;
        if($valueVolunteer == 2){
            $hourStart = 1;
            $hourEnd = 10;
        }
        else if($valueVolunteer == 3){
            $hourStart = 11;
            $hourEnd = 20;
        }
        else if($valueVolunteer == 4){
            $hourStart = 21;
            $hourEnd = 30;
        }
        else if($valueVolunteer == 5){
            $hourStart = 31;
            $hourEnd = 40;
        }
        else if($valueVolunteer == 6){
            $hourStart = 41;
            $hourEnd = 50;
        }
        else if($valueVolunteer == 7){
            $hourStart = 51;
            $hourEnd = 9999;
        }       
    $sql .= "and (activity.volunteer_hour >= '$hourStart' and activity.volunteer_hour <= '$hourEnd') ";
    }
    if($valueAge != 0){
        if($valueAge == 1){
            $sql .= "and (activity.max_age <= 10)";
        }
        else if($valueAge == 2){
            $sql .= "and (activity.max_age <= 20)";
        }
        else if($valueAge == 3){
            $sql .= "and (activity.max_age <= 30)";
        }
        else if($valueAge == 4){
            $sql .= "and (activity.max_age <= 40)";
        }
        else if($valueAge == 5){
            $sql .= "and (activity.max_age <= 50)";
        }
        else if($valueAge == 6){
            $sql .= "and (activity.max_age <= 60)";
        }
        else if($valueAge == 7){
            $sql .= "and (activity.min_age >= 60)";
        }       
    }
    if($valueDate != 0){
        if($valueDate == 1){
            $sql .= "and (activity.date_start = CURRENT_DATE()) ";
        }
        else if($valueDate == 2){
            $sql .= "and (YEARWEEK(activity.date_start, 1) = YEARWEEK(CURDATE(), 1)) ";
        }
        else if($valueDate == 3){
            $sql .= "and (MONTH(activity.date_start) = MONTH(CURRENT_DATE()) AND YEAR(activity.date_start) = YEAR(CURRENT_DATE()))";
        }
        else if($valueDate == 4){
            $sql .= "and (YEAR(activity.date_start) = YEAR(CURRENT_DATE()))";
        }
        else if($valueDate == 5){
            $sql .= "and DATE_FORMAT(date_start, '%Y-%m-%d %H:%i:%s') < DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s')";
        }
    }
    if($valuePeople != 0){
        $peopleStart = 0;
        $peopleEnd = 0;
        if($valuePeople == 1){
            $peopleStart = 1;
            $peopleEnd = 10;
        }
        else if($valuePeople == 2){
            $peopleStart = 11;
            $peopleEnd = 20;
        }
        else if($valuePeople == 3){
            $peopleStart = 21;
            $peopleEnd = 30;
        }
        else if($valuePeople == 4){
            $peopleStart = 31;
            $peopleEnd = 40;
        }
        else if($valuePeople == 5){
            $peopleStart = 41;
            $peopleEnd = 50;
        }
        else if($valuePeople == 6){
            $peopleStart = 51;
            $peopleEnd = 60;
        }
        else if($valuePeople == 7){
            $peopleStart = 60;
            $peopleEnd = 999999;
        }
    $sql .= "and (activity.number_people >= '$peopleStart' and activity.number_people <= '$peopleEnd')";
    }
   
    $sql .= " ORDER BY date_start DESC limit {$start} , {$perpage}";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>