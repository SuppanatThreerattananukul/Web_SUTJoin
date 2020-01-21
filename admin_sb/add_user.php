    
    <?php
 header('Content-Type: application/json');
    include("../include/ConnectDB.php");
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['user_status'];
    $student_id = $_POST['student_id'];
    $gender = $_POST['gender'];
    $gpax = $_POST['gpax'];
    $volunteer = $_POST['volunteer'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $birth_day = $_POST['birth_day'];
    $v_status = $_POST['v_status'];
    $sql_statement = "INSERT INTO user (user_id,name, surname,email,phone,user_status,student_id,user_gender,gpax,volunteer,username,password,age,birthday,volunteer_status) VALUES (null,'$name','$surname','$email'
    ,'$phone','$status','$student_id'
    ,'$gender','$gpax'
    ,'$volunteer','$user_name','$password',
    '$age','$birth_day','$v_status')";
    $result = mysqli_query($con ,$sql_statement);
    if (!$result) die('Query error: ' . mysqli_error());
    if($result) {
        echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
    }
    else{
        echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
    }
    ?>