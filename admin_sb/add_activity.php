    
    <?php
 header('Content-Type: application/json');
    include("../include/ConnectDB.php");
    $id_host = $_POST['id_host'];
    $date_start = $_POST['date_start'] . ":00.000Z";
    $date_host = $_POST['date_host'];
    $title =  $_POST['title']; 
    $type = $_POST['type']; 
    $description = $_POST['description']; 
    $number_people = $_POST['number_people'];  
    $min_age = $_POST['min_age']; 
    $max_age = $_POST['max_age'];  
    $tag =  $_POST['tag'];
    $gender = $_POST['gender']; 
    $status = $_POST['status']; 
    $volunteer = $_POST['volunteer']; 

        $sql_statement = "INSERT INTO activity (id_host,date_start,title,type,description,number_people,min_age,max_age,tag,gender,status,date_host,volunteer_hour) 
        VALUES ('$id_host','$date_start','$title'
    ,'$type','$description','$number_people','$min_age'
    ,'$max_age','$tag','$gender','$status','$date_host','$volunteer')";
    $result = mysqli_query($con ,$sql_statement);
    if (!$result) die('Query error: ' . mysqli_error());
    if($result) {
        echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
    }
    else{
        echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
    }
    ?>