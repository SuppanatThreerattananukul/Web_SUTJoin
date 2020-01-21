<?php
    include("../include/ConnectDB.php");

    $id = 0;
    $name = "";
    $surname = ""; 
    $email =  "";
    $birth_day = "";
    $phone = "";
    $status = "";
    $v_status = "";
    $student_id =""; 
    $gender = "";
    $gpax = "";
    $volunteer ="" ;
    $user_name = "";
    $password = "";
    $update = false ;

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sql_statement = "DELETE FROM user WHERE user_id=$id";
        $result = mysqli_query($con ,$sql_statement);
        ?>
        <script>
            alert('Record Success');
            window.location='manage_user.php'
        </script>
        <?php
    }

    if(isset($_POST['cancle'])){
        header("location: manage_user.php");
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
    }
    if(isset($_POST['update'])){
        $id = $_POST['id_user'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['user_status'];
        $birth_day = $_POST['birth_day'];
        $v_status = $_POST['v_status'];
        $student_id = $_POST['student_id'];
        $gender = $_POST['gender'];
        $gpax = $_POST['gpax'];
        $volunteer = $_POST['volunteer'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $sql_statement = "UPDATE  user SET name='$name' ,surname='$surname'
        ,email='$email',phone='$phone',user_status='$status',v_status='$v_status',birth_day='$birth_day' ,email='$email',phone='$phone'
        ,student_id='$student_id',user_gender='$gender',gpax='$gpax'
        ,volunteer='$volunteer',username='$user_name',password='$password' WHERE user_id = '$id'";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_user.php'
        </script>
        <?php
    }
    if(isset($_POST['cancle'])){
        header("location: manage_user.php");
    }
?>