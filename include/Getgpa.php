<?php
    include("ConnectDB.php");

        // Getting the received JSON into $json variable.
        $json = file_get_contents('php://input');
    
        // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);
    
        // $id_host = $obj[''];
        $user_id = $obj['user_id'];
        $user_id = 52;

    $result = array();
    $resultgpa = array();

    $gpax = 0.0;

    $gpa_1_1 = 0.0;
    $gpa_1_2 = 0.0;
    $gpa_1_3 = 0.0;

    $gpa_2_1 = 0.0;
    $gpa_2_2 = 0.0;
    $gpa_2_3 = 0.0;

    $gpa_3_1 = 0.0;
    $gpa_3_2 = 0.0;
    $gpa_3_3 = 0.0;

    $gpa_4_1 = 0.0;
    $gpa_4_2 = 0.0;
    $gpa_4_3 = 0.0;

    $gpa_5_1 = 0.0;
    $gpa_5_2 = 0.0;
    $gpa_5_3 = 0.0;

    $gpa_6_1 = 0.0;
    $gpa_6_2 = 0.0;
    $gpa_6_3 = 0.0;

    $gpa_7_1 = 0.0;
    $gpa_7_2 = 0.0;
    $gpa_7_3 = 0.0;

    $gpa_8_1 = 0.0;
    $gpa_8_2 = 0.0;
    $gpa_8_3 = 0.0;

    $sql = "SELECT * FROM learning WHERE id_user = '".$user_id."' ";
    $query = mysqli_query($con,$sql);    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        array_push($result,$row);

        $gpa_1_1 = $row['gpa_1_1'];
        $gpa_1_2 = $row['gpa_1_2'];
        $gpa_1_3 = $row['gpa_1_3'];
    
        $gpa_2_1 = $row['gpa_2_1'];
        $gpa_2_2 = $row['gpa_2_2'];
        $gpa_2_3 = $row['gpa_2_3'];
    
        $gpa_3_1 = $row['gpa_3_1'];
        $gpa_3_2 = $row['gpa_3_2'];
        $gpa_3_3 = $row['gpa_3_3'];
    
        $gpa_4_1 = $row['gpa_4_1'];
        $gpa_4_2 = $row['gpa_4_2'];
        $gpa_4_3 = $row['gpa_4_3'];

        $gpa_5_1 = $row['gpa_5_1'];
        $gpa_5_2 = $row['gpa_5_2'];
        $gpa_5_3 = $row['gpa_5_3'];
    
        $gpa_6_1 = $row['gpa_6_1'];
        $gpa_6_2 = $row['gpa_6_2'];
        $gpa_6_3 = $row['gpa_6_3'];
    
        $gpa_7_1 = $row['gpa_7_1'];
        $gpa_7_2 = $row['gpa_7_2'];
        $gpa_7_3 = $row['gpa_7_3'];
    
        $gpa_8_1 = $row['gpa_8_1'];
        $gpa_8_2 = $row['gpa_8_2'];
        $gpa_8_3 = $row['gpa_8_3'];

        $gpax = $row['gpax'];

    }

    array_push($resultgpa,$gpa_1_1);
    array_push($resultgpa,$gpa_1_2);
    array_push($resultgpa,$gpa_1_3);

    array_push($resultgpa,$gpa_2_1);
    array_push($resultgpa,$gpa_2_2);
    array_push($resultgpa,$gpa_2_3);

    array_push($resultgpa,$gpa_3_1);
    array_push($resultgpa,$gpa_3_2);
    array_push($resultgpa,$gpa_3_3);

    array_push($resultgpa,$gpa_4_1);
    array_push($resultgpa,$gpa_4_2);
    array_push($resultgpa,$gpa_4_3);

    array_push($resultgpa,$gpa_5_1);
    array_push($resultgpa,$gpa_5_2);
    array_push($resultgpa,$gpa_5_3);

    array_push($resultgpa,$gpa_6_1);
    array_push($resultgpa,$gpa_6_2);
    array_push($resultgpa,$gpa_6_3);

    array_push($resultgpa,$gpa_7_1);
    array_push($resultgpa,$gpa_7_2);
    array_push($resultgpa,$gpa_7_3);

    array_push($resultgpa,$gpa_8_1);
    array_push($resultgpa,$gpa_8_2);
    array_push($resultgpa,$gpa_8_3);

    array_push($resultgpa,$gpax);
    

    // $final_score1 = int($final_score1);

    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");
    echo json_encode($resultgpa, JSON_UNESCAPED_UNICODE);
?>