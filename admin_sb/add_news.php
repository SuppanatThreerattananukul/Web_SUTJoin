    
    <?php
    header('Content-Type: application/json');
    include("../include/ConnectDB.php");
    $news_status = $_POST['news_status'];
    $news_title = $_POST['news_title'];
    $news_detail = $_POST['news_detail'];
    echo $news_status ;
    echo $news_title ;
    echo $news_detail ;
    $sql_statement = "INSERT INTO news (news_status,news_title,news_detail) 
    VALUES ('$news_status','$news_title','$news_detail')";
    $result = mysqli_query($con ,$sql_statement);
    if (!$result) die('Query error: ' . mysqli_error());
    if($result) {
        echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
        header("Location: manage_news.php");
    }
    else{
        echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
    }
    ?>