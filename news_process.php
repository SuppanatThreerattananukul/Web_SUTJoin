<?php
    session_start();
    include("include/ConnectDB.php");

    $news_id = 0;
    $headline = "";
    $news_details = ""; 
    $news_message = "";
    $update = false;

    if(isset($_POST['Create'])){
        $headline = $_POST['headline'];
        $news_details = $_POST['news_details'];
        $news_message = $_POST['news_message'];
        $sql_statement = "INSERT INTO news (news_id , Headline, news_details,news_message) VALUES (null,'$headline','$news_details','$news_message')";
        $result = mysqli_query($con ,$sql_statement);
        if (!$result) die('Query error: ' . mysql_error());

        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";

        header("location: news.php");

    }

    if(isset($_GET['edit'])){
        $news_id = $_GET['edit'];
        $sql_statement = "SELECT * FROM news WHERE news_id=$news_id";
        $result = mysqli_query($con ,$sql_statement);
        $row = mysqli_fetch_array($result);
        $headline = $row['Headline'];
        $news_details = $row['news_details'];
        $news_message = $row['news_message'];
        $update = true;
    }

    if(isset($_GET['delete']))
    {
        $id = $_GET['delete'];
        $sql_statement = "DELETE FROM news WHERE news_id=$news_id";
        $result = mysqli_query($con ,$sql_statement);

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: news.php");
    }

    if(isset($_POST['update'])){
        $headline = $_POST['headline'];
        $news_details = $_POST['news_details'];
        $news_message = $_POST['news_message'];
        $sql_statement = "UPDATE  news SET Headline='$headline',news_details='$news_details'
        ,news_message =' $news_message' WHERE news_id = $news_id";
        $result = mysqli_query($con ,$sql_statement);
        $_SESSION['message'] = "Record has been update!";
        $_SESSION['msg_type'] = "warning";

        header("location: news.php");
    }
    if(isset($_POST['cancle'])){
        header("location: news.php");
    }
?>