<?php
session_start();
include('include/security4.php');
if(isset($_POST['logout'])){
    session_destroy();
    echo(
        "<script> 
                alert('Logout Complete'); 
                window.location = 'login.php'
    </script>");
    unset($_SESSION['username']);
}

?>