<?php
include('include/security4.php');
$errors = array(); 
if(isset($_POST['login_user'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        array_push($errors, "Username is required");
      }
      if (empty($password)) {
        array_push($errors, "Password is required");
      }
    $sql_statement = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con ,$sql_statement);
    $row = mysqli_fetch_array($result);
    if($row){
        if($row['user_status'] == 0){
            $_SESSION['username'] =  $username;
            $_SESSION['status'] =  $row['user_status'];
            echo(
                "<script> 
                        alert('Login Succesfull'); 
                        window.location = 'index.php'
            </script>");
        }elseif($row['user_status'] == 2){
            $_SESSION['username'] =  $row['name'] ." ".$row['surname'];
            $_SESSION['status'] =  $row['user_status'];
            $_SESSION['user_id'] =  $row['user_id'];
            echo(
                "<script> 
                        alert('Login Succesfull'); 
                        window.location = 'subject_time.php'
            </script>");
        }else{
            $_SESSION['username'] =  $row['name'] ." ".$row['surname'];
            $_SESSION['status'] =  $row['user_status'];
            $_SESSION['user_id'] =  $row['user_id'];
            echo(
                "<script> 
                        alert('Login Succesfull'); 
                        window.location = 'check_act.php'
            </script>");
        }
        session_write_close();
    }else{
        echo(
			"<script> 
                    alert('Please check your User and Password : โปรดตรวจสอบ ชื่อผู้ใช้งานและรหัสผ่าน '); 
                    window.location = 'login.php'
		</script>");
    }
}

?>