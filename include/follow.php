<?php
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     ini_set( 'allow_url_fopen', true );
     $json = file_get_contents('php://input');
    
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);

    $status = $obj['status'];
    $id = $obj['id_user']; //user
    $result = array();
    $w = array();
    if($status == 1){
    $follow_id = $obj['follow_id']; //following
    $sql1 = "select * from follow where id_following = $follow_id and id_follower = $id";
    $query1 = mysqli_query($con,$sql1); 
    $num_rows1 = mysqli_num_rows($query1);

    $sql_following = "select id_following from follow where id_follower = $follow_id ";
    $query2 = mysqli_query($con,$sql_following); 
    $num_rows_following = mysqli_num_rows($query2);

    $sql_follower = "select id_follower from follow where id_following = $follow_id ";
    $query3 = mysqli_query($con,$sql_follower); 
    $num_rows_follower = mysqli_num_rows($query3);
        
    array_push($result,$num_rows1,$num_rows_following,$num_rows_follower);
    }
    else if($status == 2){
    $follow = $obj['follow'];
    $follow_id = $obj['follow_id']; //following
    if(!$follow){
        $sql = "insert into follow(id_following,id_follower) values('".$follow_id."','".$id."')";
    }else{
        $sql = "delete from follow where id_following = $follow_id and id_follower = $id";
    }
    if ($con->query($sql) === TRUE) {
        $result = "1";
    } else {
        $result = "0";
    }
    }
    else if($status == 3){
        $user_id = $obj['user_id'];
        $page = $obj['page'];
        $perpage = 20;
        $start = ($page - 1) * $perpage;
        $i = 1;
        $sql = "select user_id,name,surname,profile from user where user_id in(select id_follower from follow where id_following = $id) limit {$start} , {$perpage}"; // select follower
        $query = mysqli_query($con,$sql);    
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {     
            $myObj = (object)array();
            $follow_id = $row["user_id"];
            $sql1 = "select id_table_follow from follow where id_following = $follow_id and id_follower = $user_id";
            $query1 = mysqli_query($con,$sql1); 
            $num_rows1 = mysqli_num_rows($query1);
            $myObj->user_id = $row["user_id"];
            $myObj->name = $row["name"];
            $myObj->surname = $row["surname"];
            $myObj->profile = $row["profile"];
            $myObj->row = $num_rows1;
            if($num_rows1 > 0){
                $myObj->backgroundColor = true;
                $myObj->text = 'Followed';
                $myObj->button_id = $i;
            }else{
                $myObj->backgroundColor = false;
                $myObj->text = 'Follow';
                $myObj->button_id = $i;
            }
            $myJSON = json_encode($myObj);
            array_push($result,$myObj);
            $i += 1;
        }
        
    }
    else if($status == 4){
        $user_id = $obj['user_id'];
        $page = $obj['page'];
        $perpage = 20;
        $start = ($page - 1) * $perpage;
        $i = 1;
        $sql = "select user_id,name,surname,profile from user where user_id in(select id_following from follow where id_follower = $id) limit {$start} , {$perpage}"; // select following
        $query = mysqli_query($con,$sql);    
        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
        {
            $myObj = (object)array();
            $follow_id = $row["user_id"];
            $sql1 = "select id_table_follow from follow where id_following = $follow_id and id_follower = $user_id";
            $query1 = mysqli_query($con,$sql1); 
            $num_rows1 = mysqli_num_rows($query1);
            $myObj->user_id = $row["user_id"];
            $myObj->name = $row["name"];
            $myObj->surname = $row["surname"];
            $myObj->profile = $row["profile"];
            $myObj->row = $num_rows1;
            if($num_rows1 > 0){
                $myObj->backgroundColor = true;
                $myObj->text = 'Followed';
                $myObj->button_id = $i;
            }else{
                $myObj->backgroundColor = false;
                $myObj->text = 'Follow';
                $myObj->button_id = $i;
            }
            $myJSON = json_encode($myObj);
            array_push($result,$myObj);
            $i += 1;
        }
    }else if($status == 5){
        $sql_following = "select id_following from follow where id_follower = $id ";
        $query2 = mysqli_query($con,$sql_following); 
        $num_rows_following = mysqli_num_rows($query2);
    
        $sql_follower = "select id_follower from follow where id_following = $id ";
        $query3 = mysqli_query($con,$sql_follower); 
        $num_rows_follower = mysqli_num_rows($query3);
            
        array_push($result,$num_rows_following,$num_rows_follower);
    }
    header('Content-type: application/json');
    header("content-type:text/javascript;charset=utf-8");	
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>