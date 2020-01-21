<?php
include('include/security.php');
include('include/header.php'); 
include('include/navbar.php'); 
include('../include/ConnectDB.php');
require_once 'edit_subject.php';
?>
    <div class="container-fluid">

        <!-- Popup Add Users -->
        <div class="modal fade" id="addsubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Subject Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" name="frm_add_subject" id="frm_add_subject" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> Subject ID </label>
                                <input type="text" name="id_subject" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label> Subject Name </label>
                                <input type="text" name="name_subject" class="form-control" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <label> Teacher ID </label>
                                <input type="number" name="id_teacher" class="form-control" min=0>
                            </div>
                            <div class="form-group">
                                <label> Credit </label>
                                <input type="number" name="credit" class="form-control" min=0>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" name="add_subject" id="add_subject" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup Edit Users -->
        <div class="modal fade" id="updatsubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Subject Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="edit_subject.php" name="frm_edit_subject" id="frm_edit_subject" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> Subject ID </label>
                                <input type="text" name="id_subject" class="form-control" value="<?php echo $id_subject; ?>" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label> Subject Name </label>
                                <input type="text" name="name_subject" class="form-control" value="<?php echo $name_subject; ?>" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <label> Teacher ID </label>
                                <input type="number" name="id_teacher" class="form-control" value="<?php echo $id_teacher; ?>" min=0>
                            </div>
                            <div class="form-group">
                                <label> Credit </label>
                                <input type="number" name="credit" class="form-control" value="<?php echo $credit; ?>" min=0>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info" name="cancle">Cancle</button>
                            <button type="submit" name="update" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile2">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Admin Subject
            <?php if($update == true):?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updatsubject">update</button>
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
                                    <th> Subject ID </th>
                                    <th> Subject Name </th>
                                    <th> Instructors </th>
                                    <th> Credit </th>
                                    <th>EDIT </th>
                                    <th>DELETE </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $sql = "SELECT  * FROM subject s INNER JOIN user u ON(s.id_teacher = u.user_id)";
            $result = mysqli_query($con, $sql);   
        if (mysqli_num_rows($result) > 0)
        {

        while($row = mysqli_fetch_assoc($result))
        {
            $name = $row['name'] . " " . $row['surname'];
          ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id_subject']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name_subject']; ?>
                                        </td>
                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['credit']; ?>
                                        </td>
                                        <td><a href="manage_subject.php?edit=<?php echo $row['id_subject']; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="edit_subject.php?delete=<?php echo $row['id_subject']; ?>" class="btn btn-danger">Delete</a></td>
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
    <script type="text/javascript">
    $(document).ready(function() {
        $("#add_subject").click(function() {
            $.ajax({
                type: "POST",
                url: "add_subject.php",
                data: $("#frm_add_subject").serialize(),
                success: function(result) {
                    if (result.status == 1) // Success
                    {
                        alert(result.message);
                        window.location = 'manage_subject.php'
                    } else // Err
                    {
                        alert(result.message);
                        window.location = 'manage_subject.php'
                    }
                }
            });
        });
    });
    </script>
    <?php
include('include/script.php');
include('include/footer.php');
?>