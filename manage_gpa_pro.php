<?php
    include("ConnectDB.php");
    // Getting the received JSON into $json variable.
    $json = file_get_contents('php://input');
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);

    $gpax = $obj['gpax'];
    $gpa_1_1 = $obj['gpa_1_1'];
    $gpa_1_2 = $obj['gpa_1_2'];
    $gpa_1_3 = $obj['gpa_1_3'];

    $gpa_2_1 = $obj['gpa_2_1'];
    $gpa_2_2 = $obj['gpa_2_2'];
    $gpa_2_3 = $obj['gpa_2_3'];

    $gpa_3_1 = $obj['gpa_3_1'];
    $gpa_3_2 = $obj['gpa_3_2'];
    $gpa_3_3 = $obj['gpa_3_3'];

    $gpa_4_1 = $obj['gpa_4_1'];
    $gpa_4_2 = $obj['gpa_4_2'];
    $gpa_4_3 = $obj['gpa_4_3'];

    $gpa_5_1 = $obj['gpa_1_1'];
    $gpa_5_2 = $obj['gpa_1_2'];
    $gpa_5_3 = $obj['gpa_1_3'];

    $gpa_6_1 = $obj['gpa_2_1'];
    $gpa_6_2 = $obj['gpa_2_2'];
    $gpa_6_3 = $obj['gpa_2_3'];

    $gpa_7_1 = $obj['gpa_3_1'];
    $gpa_7_2 = $obj['gpa_3_2'];
    $gpa_7_3 = $obj['gpa_3_3'];

    $gpa_8_1 = $obj['gpa_4_1'];
    $gpa_8_2 = $obj['gpa_4_2'];
    $gpa_8_3 = $obj['gpa_4_3'];

    if ($gpa_1_1 == null){$gpa_1_1 = 0;}
    if ($gpa_1_2 == null){$gpa_1_2 = 0;}
    if ($gpa_1_3 == null){$gpa_1_3 = 0;}
    if ($gpa_2_1 == null){$gpa_2_1 = 0;}
    if ($gpa_2_2 == null){$gpa_2_2 = 0;}
    if ($gpa_2_3 == null){$gpa_2_3 = 0;}
    if ($gpa_3_1 == null){$gpa_3_1 = 0;}
    if ($gpa_3_2 == null){$gpa_3_2 = 0;}
    if ($gpa_3_3 == null){$gpa_3_3 = 0;}
    if ($gpa_4_1 == null){$gpa_4_1 = 0;}
    if ($gpa_4_2 == null){$gpa_4_2 = 0;}
    if ($gpa_4_3 == null){$gpa_4_3 = 0;}

    if ($gpa_5_1 == null){$gpa_5_1 = 0;}
    if ($gpa_5_2 == null){$gpa_5_2 = 0;}
    if ($gpa_5_3 == null){$gpa_5_3 = 0;}
    if ($gpa_6_1 == null){$gpa_6_1 = 0;}
    if ($gpa_6_2 == null){$gpa_6_2 = 0;}
    if ($gpa_6_3 == null){$gpa_6_3 = 0;}
    if ($gpa_7_1 == null){$gpa_7_1 = 0;}
    if ($gpa_7_2 == null){$gpa_7_2 = 0;}
    if ($gpa_7_3 == null){$gpa_7_3 = 0;}
    if ($gpa_8_1 == null){$gpa_8_1 = 0;}
    if ($gpa_8_2 == null){$gpa_8_2 = 0;}
    if ($gpa_8_3 == null){$gpa_8_3 = 0;}


    $user_id = (explode('"',$obj['user_id']));
    $id = $user_id[1];
    // $id = 52;

    $select_sql = "SELECT * FROM learning WHERE id_user = ".$id."";
    $result_select = mysqli_query($con,$select_sql);
    // $row = mysqli_fetch_array($result_select);

    if (mysqli_num_rows($result_select) > 0) {
        
        $sql_update = "UPDATE learning Set 
        gpax = '".$gpax."' ,
        gpa_1_1 = '".$gpa_1_1."' ,
        gpa_1_2 = '".$gpa_1_2."' ,
        gpa_1_3 = '".$gpa_1_3."' ,
        gpa_2_1 = '".$gpa_2_1."' ,
        gpa_2_2 = '".$gpa_2_2."' ,
        gpa_2_3 = '".$gpa_2_3."' ,
        gpa_3_1 = '".$gpa_3_1."' ,
        gpa_3_2 = '".$gpa_3_2."' ,
        gpa_3_3 = '".$gpa_3_3."' ,
        gpa_4_1 = '".$gpa_4_1."' ,
        gpa_4_2 = '".$gpa_4_2."' ,
        gpa_4_3 = '".$gpa_4_3."' ,
        gpa_1_1 = '".$gpa_5_1."' ,
        gpa_1_2 = '".$gpa_5_2."' ,
        gpa_1_3 = '".$gpa_5_3."' ,
        gpa_2_1 = '".$gpa_6_1."' ,
        gpa_2_2 = '".$gpa_6_2."' ,
        gpa_2_3 = '".$gpa_6_3."' ,
        gpa_3_1 = '".$gpa_7_1."' ,
        gpa_3_2 = '".$gpa_7_2."' ,
        gpa_3_3 = '".$gpa_7_3."' ,
        gpa_4_1 = '".$gpa_8_1."' ,
        gpa_4_2 = '".$gpa_8_2."' ,
        gpa_4_3 = '".$gpa_8_3."'
        WHERE id_user = '".$id."'";  

        if ($con->query($sql_update) === TRUE) {
            $result = "Success";
        } else {
            $result = "Error: " . $sql_update .  "<br>" .$con->error;
        }

    }else{
        $sql_insert = "INSERT INTO learning (
            id_user,
            gpax,
            gpa_1_1,
            gpa_1_2,
            gpa_1_3,
            gpa_2_1,
            gpa_2_2,
            gpa_2_3,
            gpa_3_1,
            gpa_3_2,
            gpa_3_3,
            gpa_4_1,
            gpa_4_2,
            gpa_4_3,
            gpa_5_1,
            gpa_5_2,
            gpa_5_3,
            gpa_6_1,
            gpa_6_2,
            gpa_6_3,
            gpa_7_1,
            gpa_7_2,
            gpa_7_3,
            gpa_8_1,
            gpa_8_2,
            gpa_8_3
            )VALUES(
            '".$id."',
            '".$gpax."',
            '".$gpa_1_1."',
            '".$gpa_1_2."',
            '".$gpa_1_3."',
            '".$gpa_2_1."',
            '".$gpa_2_2."',
            '".$gpa_2_3."',
            '".$gpa_3_1."',
            '".$gpa_3_2."',
            '".$gpa_3_3."',
            '".$gpa_4_1."',
            '".$gpa_4_2."',
            '".$gpa_4_3."',
            '".$gpa_5_1."',
            '".$gpa_5_2."',
            '".$gpa_5_3."',
            '".$gpa_6_1."',
            '".$gpa_6_2."',
            '".$gpa_6_3."',
            '".$gpa_7_1."',
            '".$gpa_7_2."',
            '".$gpa_7_3."',
            '".$gpa_8_1."',
            '".$gpa_8_2."',
            '".$gpa_8_3."'
            )";

            if ($con->query($sql_insert) === TRUE) {
                $result = "Register Success Let's Join";
            } else {
                $result = "Error: " . $sql_insert .  "<br>" .$con->error;
            }
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>