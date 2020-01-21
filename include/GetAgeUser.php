<?php 
    include("ConnectDB.php");
     // Getting the received JSON into $json variable.
     $json = file_get_contents('php://input');
   
     // decoding the received JSON and store into $obj variable.
     $obj = json_decode($json,true);
     $user_id = $obj['user_id'];
     $result = array();
     $sql = "select birthday,user_gender from user where user_id =".$user_id;
     $query = mysqli_query($con,$sql);   
     while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    {
        $birthDate = $row['birthday'];
        $user_gender = $row['user_gender'];
    }
   //date in mm/dd/yyyy format; or it can be in other formats as well
   //explode the date to get month, day and year
   $birthDate = explode("-", $birthDate);
   //get age from date or birthdate
   $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
     ? ((date("Y") - $birthDate[2]) - 1)
     : (date("Y") - $birthDate[2]));

     array_push($result,$age,$user_gender);
     header('Content-type: application/json');
     header("content-type:text/javascript;charset=utf-8");	
     echo json_encode($result, JSON_UNESCAPED_UNICODE);
 
?>