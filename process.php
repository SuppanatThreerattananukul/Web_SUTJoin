<?php
    session_start();
    include("include/ConnectDB.php");

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
    $update = false;

    if(isset($_POST['Create'])){
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'];
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

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");

    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $sql_statement = "SELECT * FROM user WHERE user_id=$id";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $name = $row['name'];
        $surname = $row['surname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $status = $row['user_status'];
        $student_id = $row['student_id'];
        $gender = $row['user_gender'];
        $gpax = $row['gpax'];
        $volunteer = $row['volunteer'];
        $user_name = $row['username'];
        $password = $row['password'];
        $update = true;
        /*$sql_statement = "UPDATE INTO user (id,name, surname,email,phone,status,student_id,gender,gpax,volunteer,username,password) VALUES (null,'$name','$surname','$email'
        ,'$phone','$status','$student_id'
        ,'$gender','$gpax'
        ,'$volunteer','$user_name','$password')";
        $result = mysqli_query($con ,$sql_statement);
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: index.php");*/

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

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['user_status'];
        $student_id = $_POST['student_id'];
        $gender = $_POST['user_gender'];
        $gpax = $_POST['gpax'];
        $volunteer = $_POST['volunteer'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $sql_statement = "UPDATE  user SET name='$name',surname='$surname'
        ,email='$email',phone='$phone',status='$status'
        ,student_id='$student_id',gender='$gender',gpax='$gpax'
        ,volunteer='$volunteer',username='$user_name',password='$password' WHERE user_id = $id";
        $result = mysqli_query($con ,$sql_statement);
        $_SESSION['message'] = "Record has been update!";
        $_SESSION['msg_type'] = "warning";

        header("location: index.php");
    }
    if(isset($_POST['cancle'])){
        header("location: index.php");
    }
?>