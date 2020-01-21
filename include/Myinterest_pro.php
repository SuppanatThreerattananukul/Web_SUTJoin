<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    // $id_host = $obj[''];
    $Learning = $obj['Learning'];
    $Volunteer = $obj['Volunteer'];;
    $Recreation = $obj['Recreation'];;
    $Hangout = $obj['Hangout'];
    $Travel = $obj['Travel'];
    $Hobby = $obj['Hobby'];
    $Meet = $obj['Meet'];
    $Eatanddrink = $obj['Eatanddrink'];

    $user_id = (explode('"',$obj['user_id']));
    $id = $user_id[1];

    $select_sql = "SELECT * FROM my_interests WHERE id_user_interest = ".$id."";
    $result_select = mysqli_query($con,$select_sql);
    // $row = mysqli_fetch_array($result_select);

    if (mysqli_num_rows($result_select) > 0) {

            $sql = "Update my_interests Set learning = '".$Learning."' ,volunteer = '".$Volunteer."' ,recreation = '".$Recreation."' ,hangout = '".$Hangout."' ,travel = '".$Travel."' ,hobby = '".$Hobby."' ,meet = '".$Meet."' ,eatanddrink = '".$Eatanddrink."'
            WHERE id_user_interest = '".$id."'";
    
    }else{

            $sql = "INSERT INTO my_interests (id_user_interest,learning,volunteer,recreation,hangout,travel,hobby,meet,eatanddrink)
            VALUE (
                '".$id."',
                '".$Learning."' ,
                '".$Volunteer."' ,
                '".$Recreation."' ,
                '".$Hangout."',
                '".$Travel."' ,
                '".$Hobby."' ,
                '".$Meet."' ,
                '".$Eatanddrink."'
            )";
    }

    if ($con->query($sql) === TRUE) {
        $result = "Interest is success Let's join";
    } else {
        $result = "Error: " . $sql .  "<br>" .$con->error;
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>