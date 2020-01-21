<?php
    include("../include/ConnectDB.php");

    $id_subject ='';
    $name_subject = '';
    $id_teacher = '';
    $credit = '';
    $update = false ;

    if(isset($_GET['delete']))
    {
        $id_subject = $_GET['delete'];
        $sql_statement = "DELETE FROM subject WHERE id_subject=$id_subject";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_subject.php'
        </script>
        <?php
    }
    
    if(isset($_POST['cancle'])){
        header("location: manage_subject.php");
    }

    if(isset($_GET['edit'])){
        $id_subject = $_GET['edit'];
        $sql_statement = "SELECT * FROM subject WHERE id_subject=$id_subject";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $name_subject = $row['name_subject'];
        $id_teacher = $row['id_teacher'];
        $credit = $row['credit'];
        $update = true;
    }
    if(isset($_POST['update'])){
        $id_subject = $_POST['id_subject'];
        $name_subject = $_POST['name_subject'];
        $id_teacher = $_POST['id_teacher'];
        $credit = $_POST['credit'];
        $sql_statement = "UPDATE  subject SET id_subject='$id_subject' ,name_subject='$name_subject'
        ,id_teacher='$id_teacher',credit='$credit' WHERE id_subject = '$id_subject'";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_subject.php'
        </script>
        <?php
    }
?>