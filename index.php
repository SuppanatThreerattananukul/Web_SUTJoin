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

<?php 
    require_once 'process.php';
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type'];?>">
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    ?>
    </div>
    <?php endif ?>
<h1>Member</h1><p id="back-top">
                        <a href="#create" 
                        class="btn btn-success" >Create</a>
</p>


    <?php $con = mysqli_connect("localhost","root",""); 
    mysqli_select_db($con,"sut_join");
    ?>   
        <table class="table table-striped">
        <thead>
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Student ID</th>
            <th colspan="2">Action</th>
            </tr>
            </thead>
        <?php
            $sql_statement = "SELECT * FROM user ";
            $result = mysqli_query($con,$sql_statement); 
        while($row = mysqli_fetch_array($result)) {        ?>
                 <tr>
                 <td><?php echo$row['id'];?></td>
                    <td><?php echo$row['name'];?></td>
                    <td><?php echo$row['email'];?></td>
                    <td><?php echo$row['phone'];?></td>
                    <td><?php echo$row['student_id'];?></td>
                    <td><a href="index.php?edit=<?php echo $row['id']; ?>" 
                        class="btn btn-success" >Edit</a>
                        <a href="detail.php?detail=<?php echo $row['id']; ?>" 
                        class="btn btn-primary" >Detail</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" 
                        class="btn btn-danger" >Delete</a></td>
                 </tr>
        <?php }?>
        </table>
        
        
        <h1 id="create">Create User</h1>
            <div class="form-group">
                <form action="process.php" method="POST" role="form" class="form-inline">
                <input type="hidden" name="id" value="<?php echo$id ?>">
                <label>Name</label><input type = "text" name="name" value="<?php echo $name; ?>" placeholder="">
                <label>Surname</label><input type = "text" name="surname" value="<?php echo $surname; ?>" placeholder="">
                <label>Email</label><input type = "email" name="email" value="<?php echo $email; ?>" placeholder="">
            </div>
            <div class="form-group">
            <label>Phone Number</label><input type = "text" name="phone" value="<?php echo $phone; ?>" pattern="\d{3}[\-]\d{3}[\-]\d{4}" placeholder="099-999-9999">
            <label>Status</label><select  name="status">
                    <option value="0">Admin</option>
                    <option value="1">User</option>
                </select>
                <label>Student ID</label><input type = "text"  name="student_id" value="<?php echo $student_id; ?>" placeholder="">
            </div>
            <div class="form-group">
            <label>Status</label><select  name="status">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            <label>Gpax</label><input type = "text" name="gpax" value="<?php echo $gpax; ?>" placeholder="Enter your GPAX">
            </div>
            <div class="form-group">
            <label>Volunteer</label><input type = "number" name="volunteer" value="<?php echo $volunteer ?>" placeholder="Enter your air time">
            <label>User Name</label><input type = "text" name="user_name" value="<?php echo $user_name ?>" placeholder="Enter User Name">
            <label>Password</label><input type = "text" name="password" value="<?php echo $password ?>" placeholder="must have at least 8 characters" min="8" max="50">  
            </div>
            <?php if($update == true):?>
                <button type = "submit" class="btn btn-success" name ="update">update</button>
            <?php else: ?>
            <button type = "submit" class="btn btn-success" name ="Create">Create</button>
            <?php endif ?>
            <button type = "submit" class="btn btn-info" name ="cancle">Cancle</button>
            </form>
    
</body>
</HTML>