<?php
    include("../include/ConnectDB.php");
    $news_id = '';
    $news_status = '';
    $url = '';
    $news_title ='';
    $news_detail ='';
    $update = false ;

    if(isset($_GET['delete']))
    {
        $news_id = $_GET['delete'];
        $sql_statement = "DELETE FROM news WHERE news_id=$news_id";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_news.php'
        </script>
        <?php
    }

    if(isset($_POST['cancle'])){
        header("location: manage_news.php");
    }

    if(isset($_GET['edit'])){
        $news_id = $_GET['edit'];
        $sql_statement = "SELECT * FROM news WHERE news_id=$news_id";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $news_status = $row['news_status'];
        $url = $row['url'];
        $news_title = $row['news_title'];
        $news_detail = $row['news_detail'];
        $update = true;
    }
    if(isset($_POST['update'])){
        $news_id = $_POST['news_id'];
        $news_status = $_POST['news_status'];
        $url = $_POST['url'];
        $news_title = $_POST['news_title'];
        $news_detail = $_POST['news_detail'];
        $sql_statement = "UPDATE  news SET news_id='$news_id' ,news_status='$news_status'
        ,url='$url',news_title='$news_title',news_detail='$news_detail' WHERE news_id = '$news_id'";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysqli_error());
        ?>
        <script>
            alert('Record Success');
            window.location='manage_news.php'
        </script>
        <?php
    }
?>