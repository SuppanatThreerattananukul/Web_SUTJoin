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

    <?php $con = mysqli_connect("localhost","root",""); 
    mysqli_select_db($con,"sut_join");
    $id = $_GET['detail'];
    $sql_statement = "SELECT * FROM user  WHERE id = '$id'";
    $result = mysqli_query($con,$sql_statement); 
    $row = mysqli_fetch_array($result) 
    ?>   
        <table class="table table-striped">
            <tr>
            <th>ID</th>
            <td><?php echo$row['id'];?></td>
            </tr>
            <tr>
            <th>Name</th>
            <td><?php echo$row['name'];?></td>
            </tr>
            <tr>
            <th>Surname</th>
            <td><?php echo$row['surname'];?></td>
            </tr>
            <tr>
            <th>Email</th>
            <td><?php echo$row['email'];?></td>
            </tr>
            <tr>
            <th>Phone Number</th>
            <td><?php echo$row['phone'];?></td>
            </tr>
            <tr>
            <th>Status</th>
            <td><?php 
            if($row['status']==0)
            {
                echo "Admin";
            }else
            {
                echo "User";
            }?></td>
            </tr>
            <tr>
            <th>Gender</th>
            <td><?php 
            if($row['gender']==0)
            {
                echo "Male";
            }else
            {
                echo "Female";
            }?></td>
            </tr>
            <tr>
            <th>GPAX</th>
            <td><?php echo$row['gpax'];?></td>
            </tr>
            <tr>
            <th>Volunteer</th>
            <td><?php echo$row['volunteer'];?></td>
            </tr>
            <tr>
            <th>Username</th>
            <td><?php echo$row['username'];?></td>
            </tr>
            <tr>
            <th>Password</th>
            <td><?php echo$row['password'];?></td>
            </tr>
        </table>
        <form action="process.php" method="POST" role="form" class="form-inline">
                        <a href="process.php?delete=<?php echo $row['id']; ?>" 
                        class="btn btn-danger" >Delete</a></td>
            <button type = "submit" class="btn btn-info" name ="cancle">Cancle</button>
    
</body>
</HTML>