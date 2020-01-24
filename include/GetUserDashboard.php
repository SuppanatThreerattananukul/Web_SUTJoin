<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];
        $all = 0;

    $result = array();
    $scorejoin = array();

    $score_1 = 0;
    $score_2 = 0;
    $score_3 = 0;
    $score_4 = 0;
    $score_5 = 0;
    $score_6 = 0;
    $score_7 = 0;
    $score_8 = 0;

    $sql = "SELECT join_activity.id_user,join_activity.id_activity,activity.id,activity.type
    FROM join_activity 
    LEFT JOIN activity ON join_activity.id_activity = activity.id
    WHERE join_activity.id_user = '".$user_id."' ";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
        $all++;

        if($row["type"] == 1){
            $score_1++;
        }else if($row["type"] == 2){
            $score_2++;
        }else if($row["type"] == 3){
            $score_3++;
        }else if($row["type"] == 4){
            $score_4++;
        }else if($row["type"] == 5){
            $score_5++;
        }else if($row["type"] == 6){
            $score_6++;
        }else if($row["type"] == 7){
            $score_7++;
        }else if($row["type"] == 8){
            $score_8++;
        }

    }

    if($all == 0){
        $final_score1 = 0;
        $final_score2 = 0;
        $final_score3 = 0;
        $final_score4 = 0;
        $final_score5 = 0;
        $final_score6 = 0;
        $final_score7 = 0;
        $final_score8 = 0;
    }else{
        $final_score1 =number_format(($score_1/$all)*100);
        $final_score2 =number_format(($score_2/$all)*100);
        $final_score3 =number_format(($score_3/$all)*100);
        $final_score4 =number_format(($score_4/$all)*100);
        $final_score5 =number_format(($score_5/$all)*100);
        $final_score6 =number_format(($score_6/$all)*100);
        $final_score7 =number_format(($score_7/$all)*100);
        $final_score8 =number_format(($score_8/$all)*100);
    }
    // $final_score1 = int($final_score1);

    array_push($scorejoin,$all);
    array_push($scorejoin,$final_score1);
    array_push($scorejoin,$final_score2);
    array_push($scorejoin,$final_score3);
    array_push($scorejoin,$final_score4);
    array_push($scorejoin,$final_score5);
    array_push($scorejoin,$final_score6);
    array_push($scorejoin,$final_score7);
    array_push($scorejoin,$final_score8);
    // $SendJSON = json_encode($scorejoin);

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");
    echo json_encode($scorejoin, JSON_UNESCAPED_UNICODE);
?>