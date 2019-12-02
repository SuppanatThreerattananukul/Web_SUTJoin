<?php

$uploads_dir = '../image';
$name = $_FILES['image']['name'];
    if(move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$name")){
        echo json_encode("The file been uploaded");
    }else{
        echo json_encode("Fail");
    }
?>