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
    require_once 'news_process.php';
    if(isset($_SESSION['message'])):?>
        <div class="alert alert-<?=$_SESSION['msg_type'];?>">
            <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']); 
    ?>
        </div>
        <?php endif ?>
            <h1>Member</h1>
            
            <?php include("include/ConnectDB.php"); ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th colspan="2"><p id="back-top"><a href="#create" class="btn btn-success">Create</a></p></th>
                        </tr>
                    </thead>
                    <?php
            $sql_statement = "SELECT * FROM news ";
            $result = mysqli_query($con,$sql_statement); 
        while($row = mysqli_fetch_array($result)) {        ?>
                        <tr>
                            <td>
                                <?php echo$row['Headline'];?>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td><a href="news.php?edit=<?php echo $row['news_id']; ?>" class="btn btn-success">Edit</a>
                                <a href="news_details.php?detail=<?php echo $row['news_id']; ?>" class="btn btn-primary">Detail</a>
                                <a href="news_process.php?delete=<?php echo $row['news_id']; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <?php }?>
                </table>

                <h1 id="create">Create User</h1>
                 <form action="news_process.php" method="POST" role="form" class="form-inline">
                        <input type="hidden" name="id" value="<?php echo$news_id ?>">
                         <label>Headline</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-group">
                                    <input type="text" name="headline" value="<?php echo $headline; ?>" placeholder=""> </div><br /><br />
                                    <label>Detail</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <textarea name="news_details" cols="40" rows="5" ><?php echo $news_details; ?></textarea></div>
                                    <br />
                                    <br />
                                    <div class="form-group">
                                    <label>Message</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <textarea name="news_message" cols="40" rows="5" ><?php echo $news_message; ?></textarea>
                                    </div>
                                    <br />
                <?php if($update == true):?>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-success" name="Create">Create</button>
                        <?php endif ?>
                            <button type="submit" class="btn btn-info" name="cancle">Cancle</button>
                            </form>

</body>

</HTML>