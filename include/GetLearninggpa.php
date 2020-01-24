<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];
        // $user_id = 52;

        // $user_id = (explode('"',$obj['user_id']));
        //  $id = $user_id[1];

        // $result = array();
        $resultgpa = array();

        $gpax = 0;
        $score = 0;

        $gpa1 = 0;
        $gpa2 = 0;
        $gpa3 = 0;
        $gpa4 = 0;

        $allscore = 0;
        $allscore1 = 0;
        $allscore2 = 0;
        $allscore3 = 0;
        $allscore4 = 0;

        $credit = 0;
        $credit1 = 0;
        $credit2 = 0;
        $credit3 = 0;
        $credit4 = 0;

    $sql = "SELECT * FROM learning_user WHERE id_user = '".$user_id."' ORDER BY term ASC";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        // array_push($result,$row);
        $score =  $row['grade']*$row['credit'];

        $allscore = $allscore + $score;
        $credit = $credit + $row['credit'];

        if($row['term'] == 1 || $row['term'] == 2 || $row['term'] == 3){
            $allscore1 = $allscore1 + $score;
            $credit1 = $credit1 + $row['credit'];
        }else if($row['term'] == 4 || $row['term'] == 5 || $row['term'] == 6){
            $allscore2 = $allscore2 + $score;
            $credit2 = $credit2 + $row['credit'];
        }else if($row['term'] == 7 || $row['term'] == 8 || $row['term'] == 9){
            $allscore3 = $allscore3 + $score;
            $credit3 = $credit3 + $row['credit'];
        }else if($row['term'] == 10 || $row['term'] == 11 || $row['term'] == 12){
            $allscore4 = $allscore4 + $score;
            $credit4 = $credit4 + $row['credit'];
        }

    }
    if($credit == 0){
        $gpax = 0;
    }else{
        $gpax = $allscore/$credit;
    }

    if($credit1 == 0){
        $gpa1 = 0;
    }else{
        $gpa1 = $allscore1/$credit1;
    }

    if($credit2 == 0){
        $gpa2 = 0;
    }else{
        $gpa2 = $allscore2/$credit2;
    }

    if($credit3 == 0){
        $gpa3 = 0;
    }else{
        $gpa3 = $allscore3/$credit3;
    }

    if($credit4 == 0){
        $gpa4 = 0;
    }else{
        $gpa4 = $allscore4/$credit4;
    }

    $gpax = number_format((float)$gpax, 2, '.', '');
    $gpa1 = number_format((float)$gpa1, 2, '.', '');
    $gpa2 = number_format((float)$gpa2, 2, '.', '');
    $gpa3 = number_format((float)$gpa3, 2, '.', '');
    $gpa4 = number_format((float)$gpa4, 2, '.', '');

    array_push($resultgpa,$gpax);
    array_push($resultgpa,$credit);

    array_push($resultgpa,$gpa1);
    array_push($resultgpa,$gpa2);
    array_push($resultgpa,$gpa3);
    array_push($resultgpa,$gpa4);

    // $final_score1 = int($final_score1);

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");
    echo json_encode($resultgpa, JSON_UNESCAPED_UNICODE);
?>