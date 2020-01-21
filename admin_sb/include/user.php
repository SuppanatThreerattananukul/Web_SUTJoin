<?php
    header('Content-Type: application/json');
    session_start();
    include("../include/ConnectDB.php");

    $id = 0;
    $name = "";
    $surname = ""; 
    $email =  "";
    $phone = "";
    $status = "";
    $student_id =""; 
    $gender = "";
    $gpax = "";
    $volunteer ="" ;
    $user_name = "";
    $password = "";

    if(isset($_POST['add_user'])){
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
        $sql_statement = "INSERT INTO user (user_id,name, surname,email,phone,user_status,student_id,user_gender,gpax,volunteer,username,password) VALUES (null,'$name','$surname','$email'
        ,'$phone','$status','$student_id'
        ,'$gender','$gpax'
        ,'$volunteer','$user_name','$password')";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        if($result) {
            echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
        }
        else{
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }

    }

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sql_statement = "DELETE FROM user WHERE user_id=$id";
        $result = mysqli_query($con ,$sql_statement);
        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
    }
    if(isset($_POST['cancle'])){
        header("location: manage_user.php");
    }
?>