<?php

$uploads_dir = '../image';
$name = $_FILES['image']['name'];
if($_FILES['image']['size']>2048000)
    {
        echo json_encode('File is too large ('.round(($_FILES['image']["size"]/1000)).'kb), please choose a file under 2,048kb');
    }else{
        if(move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$name")){
        echo json_encode("Success");
    }else{
        echo json_encode("Fail");
    }}
    
?>