<?php
include('include/security.php');
include('include/header.php'); 
include('include/navbar.php'); 
include('../include/ConnectDB.php');
require_once 'edit_news.php';
?>
    <div class="container-fluid">

        <!-- Popup Add Users -->
        <div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add News Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="add_news.php" name="frm_add_subject" id="frm_add_subject" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> News status </label>
                                <select name="news_status">
                                    <option>Select</option>
                                    <option value="1">Show</option>
                                    <option value="2">Dont show</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> URL </label>
                                <input type="file" name="url" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label> News Title </label>
                                <input type="text" name="news_title" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label> News Detail </label>
                                <input type="text" name="news_detail" class="form-control" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add_subject" id="add_subject" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup Add Users -->
        <div class="modal fade" id="updatesubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add News Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="edit_news.php"  method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> News status </label>
                                <select name="news_status">
                                    <option value="<?php echo $news_status?>"><?php if($news_status==1){echo "show";}else{echo "dont show";}?></option>
                                    <option value="1">Show</option>
                                    <option value="2">Dont show</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> URL </label>
                                <input type="file" name="url" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label> News Title </label>
                                <input type="text" name="news_title" class="form-control" value="<?php echo $news_title?>">
                            </div>
                            <div class="form-group">
                                <label> News Detail </label>
                                <input type="text" name="news_detail" class="form-control" value="<?php echo $news_detail?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="add_subject" id="add_subject" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add News
            <?php if($update == true):?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updatesubject">update</button>
            <?php else: ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsubject">Add</button>
              <?php endif ?>
                </h6>
                </div>
                
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> News ID </th>
                                    <th> News Status </th>
                                    <th> Picture </th>
                                    <th> News title </th>
                                    <th> News detail </th>
                                    <th>EDIT </th>
                                    <th>DELETE </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $sql = "SELECT  * FROM news ";
            $result = mysqli_query($con, $sql);   
        if (mysqli_num_rows($result) > 0)
        {

        while($row = mysqli_fetch_assoc($result))
        {
          ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['news_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['news_status']; ?>
                                        </td>
                                        <td>
                                            <?php echo  $row['url']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['news_title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['news_detail']; ?>
                                        </td>
                                        <td><a href="manage_news.php?edit=<?php echo $row['news_id']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="edit_news.php?delete=<?php echo $row['news_id']; ?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                    <?php  
        }
      }else{
        echo "no table row";
      }
      ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    </div>
    <?php
include('include/script.php');
include('include/footer.php');
?>