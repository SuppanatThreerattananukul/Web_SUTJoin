<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];
        $user_id = 52;
        $all = 0;
        $usercount = 0;

    $result = array();
    $result2 = array();
    $scorejoin = array();

    $score_1 = 0;
    $score_2 = 0;
    $score_3 = 0;
    $score_4 = 0;
    $score_5 = 0;
    $score_6 = 0;
    $score_7 = 0;
    $score_8 = 0;


    // $sql = "SELECT join_activity.id_user,join_activity.id_activity,activity.id,activity.type
    // FROM join_activity 
    // LEFT JOIN activity ON join_activity.id_activity = activity.id
    // WHERE join_activity.id_user = '".$user_id."' ";

    $sql = "SELECT join_activity.id_user,join_activity.id_activity,activity.id,activity.type
    FROM join_activity 
    LEFT JOIN activity ON join_activity.id_activity = activity.id";

    $query = mysqli_query($con,$sql);   

    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);
        $all++;

        if($row["id_user"] == $user_id) {

            $usercount++;

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

    $allCreate = 0;
    $usercountCreate = 0;

    $create_1 = 0;
    $create_2 = 0;
    $create_3 = 0;
    $create_4 = 0;
    $create_5 = 0;
    $create_6 = 0;
    $create_7 = 0;
    $create_8 = 0;

    $sqlcreate = "SELECT * FROM activity";

    $querycreate = mysqli_query($con,$sqlcreate);   

    while($data = mysqli_fetch_array($querycreate,MYSQLI_ASSOC))
    {
        array_push($result2,$data);

        $allCreate++;

        if($data["id_host"] == $user_id) {

            $usercountCreate++;

            if($data["type"] == 1){
                $create_1++;
            }else if($data["type"] == 2){
                $create_2++;
            }else if($data["type"] == 3){
                $create_3++;
            }else if($data["type"] == 4){
                $create_4++;
            }else if($data["type"] == 5){
                $create_5++;
            }else if($data["type"] == 6){
                $create_6++;
            }else if($data["type"] == 7){
                $create_7++;
            }else if($data["type"] == 8){
                $create_8++;
            }
        }

    }

    if($allCreate == 0){
        $final_create1 = 0;
        $final_create2 = 0;
        $final_create3 = 0;
        $final_create4 = 0;
        $final_create5 = 0;
        $final_create6 = 0;
        $final_create7 = 0;
        $final_create8 = 0;
    }else{
        $final_create1 =number_format(($create_1/$allCreate)*100);
        $final_create2 =number_format(($create_2/$allCreate)*100);
        $final_create3 =number_format(($create_3/$allCreate)*100);
        $final_create4 =number_format(($create_4/$allCreate)*100);
        $final_create5 =number_format(($create_5/$allCreate)*100);
        $final_create6 =number_format(($create_6/$allCreate)*100);
        $final_create7 =number_format(($create_7/$allCreate)*100);
        $final_create8 =number_format(($create_8/$allCreate)*100);
    }

    array_push($scorejoin,$allCreate);
    array_push($scorejoin,$final_create1);
    array_push($scorejoin,$final_create2);
    array_push($scorejoin,$final_create3);
    array_push($scorejoin,$final_create4);
    array_push($scorejoin,$final_create5);
    array_push($scorejoin,$final_create6);
    array_push($scorejoin,$final_create7);
    array_push($scorejoin,$final_create8);

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");
    echo json_encode($scorejoin, JSON_UNESCAPED_UNICODE);
?>