<HTML>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-light" style="background-image: linear-gradient(to right, #FF6A6A , #FFC1C1);">
    <h1>SUT JOIN</h1>
</nav>
<?php require_once 'process.php';?>
<h1>Member</h1>

    <?php include("include/ConnectDB.php");
    $id = $_GET['detail'];
    $sql_statement = "SELECT * FROM news  WHERE news_id = '$id'";
    $result = mysqli_query($con,$sql_statement); 
    $row = mysqli_fetch_array($result) 
    ?>   
        <table class="table table-striped">
            <tr>
            <th>ID</th>
            <td><?php echo$row['news_id'];?></td>
            </tr>
            <tr>
            <th>Headline</th>
            <td><?php echo$row['Headline'];?></td>
            </tr>
            <tr>
            <th>Details</th>
            <td><?php echo$row['news_details'];?></td>
            </tr>
            <tr>
            <th>Message</th>
            <td><?php echo$row['news_message'];?></td>
            </tr>
        </table>
        <form action="news_process.php" method="POST" role="form" class="form-inline">
                        <a href="process.php?delete=<?php echo $row['news_id']; ?>" 
                        class="btn btn-danger" >Delete</a></td>
            <button type = "submit" class="btn btn-info" name ="cancle">Cancle</button>
    
</body>
</HTML>