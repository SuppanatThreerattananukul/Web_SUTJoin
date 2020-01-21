<?php
    include("../include/ConnectDB.php");

    $id = 0;
    $id_host = "";
    $date_start = ""; 
    $title =  "";
    $type = "";
    $description = "";
    $number_people =""; 
    $min_age = "";
    $max_age = "";
    $tag =  "";
    $gender = "";
    $status = "";
    $volunteer =""; 
    $date_host = "";
    $update = false ;

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sql_statement = "DELETE FROM activity WHERE id=$id";
        $result = mysqli_query($con ,$sql_statement);
        ?>
        <script>
            alert('Record Success');
            window.location='manage_activity.php'
        </script>
        <?php
    }

    if(isset($_POST['cancle'])){
        header("location: manage_activity.php");
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $sql_statement = "SELECT * FROM activity WHERE id=$id";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $id_host = $row['id_host'];
        $date_start = $row['date_start']; 
        $title =  $row['title']; 
        $type = $row['type']; 
        $description = $row['description']; 
        $number_people = $row['number_people'];  
        $min_age = $row['min_age']; 
        $max_age = $row['max_age']; 
        $location_lat = $row['location_lat'] ;
        $location_long = $row['location_long']; 
        $location_name = $row['location_name']; 
        $location_address = $row['location_address']; 
        $photo = $row['photo'];  
        $tag =  $row['tag']; 
        $gender = $row['gender']; 
        $status = $row['status']; 
        $volunteer = $row['volunteer'];  
        $awesome = $row['awesome']; 
        $share = $row['share']; 
        $inviter = $row['inviter']; 
        $date_host = $row['date_host']; 
        $date_update = $row['date_update']; 
        $update = true;
    }
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $id_host = $_POST['id_host'];
        $date_start = $_POST['date_start']; 
        $title =  $_POST['title']; 
        $type = $_POST['type']; 
        $description = $_POST['description']; 
        $number_people= $_POST['number_people'];  
        $min_age = $_POST['min_age']; 
        $max_age = $_POST['max_age']; 
        $location_lat= $_POST['location_lat'] ;
        $location_long = $_POST['location_long']; 
        $location_name = $_POST['location_name']; 
        $location_address = $_POST['location_address']; 
        $photo = $_POST['photo'];  
        $tag =  $_POST['tag']; 
        $gender = $_POST['gender']; 
        $status = $_POST['status']; 
        $volunteer = $_POST['volunteer'];  
        $awesome = $_POST['awesome']; 
        $share = $_POST['share']; 
        $inviter = $_POST['inviter']; 
        $date_host = $_POST['date_host']; 
        $date_update = $_POST['date_update']; 
        $sql_statement = "UPDATE  activity SET id_host='$id_host' ,date_start='$date_start'
        ,title='$title',type='$type',description='$description' ,number_people='$number_people',min_age='$min_age'
        ,max_age='$max_age' 
        ,tag='$tag',gender='$gender',status='$status'
        ,volunteer='$volunteer',awesome='$awesome',share='$share'
        ,inviter='$inviter'
        WHERE id = '$id'";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_activity.php'
        </script>
        <?php
    }
    if(isset($_POST['cancle'])){
        header("location: manage_activity.php");
    }
?>