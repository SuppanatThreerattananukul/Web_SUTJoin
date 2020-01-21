    
    <?php
    header('Content-Type: application/json');
    include("../include/ConnectDB.php");
    $id_subject = $_POST['id_subject'];
    $name_subject = $_POST['name_subject'];
    $id_teacher = $_POST['id_teacher'];
    $credit = $_POST['credit'];
    $sql_statement = "INSERT INTO subject (id_subject,name_subject, id_teacher,credit) VALUES ('$id_subject','$name_subject','$id_teacher','$credit')";
    $result = mysqli_query($con ,$sql_statement);
    if (!$result) die('Query error: ' . mysqli_error());
    if($result) {
        echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
    }
    else{
        echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
    }
    ?>