<?php
session_start();
include("../include/ConnectDB.php"); 

if(!$_SESSION['username']){
    echo(
        "<script> 
                alert('You are not loged in Please login'); 
                window.location = 'login.php'
    </script>");
}else{
    $status = $_SESSION['status'];
    if($status != 0){
        echo(
            "<script> 
                    alert('You are not Admin'); 
                    history.back();
        </script>");
    }
}
?>