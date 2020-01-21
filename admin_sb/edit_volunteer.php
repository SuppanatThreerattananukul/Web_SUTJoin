<?php
    include("../include/ConnectDB.php");
    $update = false;
    if(isset($_GET['edit'])){
        $user_id = $_GET['edit'];
        $sql_statement = "SELECT * FROM user WHERE user_id=$user_id";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $volunteer = $row['volunteer'];
        $update = true;
    }
    if(isset($_POST['update'])){

        $sql = "SELECT  * from user";
        if (mysqli_query($con, $sql)) 
        {
        } 
         else 
        {
          echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0)
        {
        while($row = mysqli_fetch_assoc($result))
        {
            $id = $row['user_id'];
            $volunteer = 0;
            $volunteer = $_POST['volunteer'] + $row['volunteer'] ;
            $sql_statement = "UPDATE  user SET volunteer = $volunteer WHERE user_id=$id";
            $result2 = mysqli_query($con ,$sql_statement);
            $sql_statement = "UPDATE  user SET volunteer = $volunteer WHERE user_id=$id";
            $result2 = mysqli_query($con ,$sql_statement);
        } 
        $_SESSION['message'] = "Record has been update!";
        $_SESSION['msg_type'] = "warning";
        }else{
            echo "fail";
        }
        header("location: volunteer.php");
    }
    if(isset($_POST['update2'])){
            $user_id = $_POST['user_id'];
            $volunteer = 0;
            $volunteer = $_POST['volunteer'];
            $sql_statement = "UPDATE  user SET volunteer = $volunteer WHERE user_id=$user_id";
            $result2 = mysqli_query($con ,$sql_statement); 

        header("location: volunteer.php");
    }
    if(isset($_POST['cancle'])){
        header("location: volunteer.php");
    }
?>