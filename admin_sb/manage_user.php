<?php
include('include/security.php');
include('include/header.php'); 
include('include/navbar.php');
include('../include/ConnectDB.php');
require_once 'user.php';
?>
    <!-- Select Table -->
    <?php
      $sqll = "SELECT  * from user";
      if (mysqli_query($con, $sqll)) 
      {
      } 
       else 
      {
        echo "Error: " . $sqll . "<br>" . mysqli_error($con);
      }
      $result = mysqli_query($con, $sqll);
?>
        <!-- Popup Add Users -->
        <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" name="frmUser" id="frmUser" method="POST"/>

                        <div class="modal-body">
                            <div class="form-group">
                                <label> Name </label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label> Surname </label>
                                <input type="text" name="surname" class="form-control" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <label> Age </label>
                                <input type="number" name="age" class="form-control" min=0>
                            </div>
                            <div class="form-group">
                                <label> Birth Date </label>
                                <input type="datetime-local" name="birth_day" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Email </label>
                                <input type="email" name="email" class="form-control" placeholder="xxx@mail.com">
                            </div>
                            <div class="form-group">
                                <label> Phone </label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label> Student Id </label>
                                <input type="text" name="student_id" class="form-control" placeholder="Enter  Student ID">
                            </div>
                            <div class="form-group">
                                <label> GPAX </label>
                                <input type="text" name="gpax" class="form-control" placeholder="Enter GPAX">
                            </div>
                            <div class="form-group">
                                <label> Volunteer Status </label>
                                <select name="v_status">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Volunteer </label>
                                <input type="text" name="volunteer" class="form-control" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label> Gender </label>
                                <select name="gender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select name="user_status">
                                    <option value="0">Admin</option>
                                    <option value="1">Student</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Employee</option>
                                    <option value="4">Guest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="user_name" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" name="add_user" id="add_user" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popup Edit Users -->
        <div class="modal fade" id="addadminprofile2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="user.php" name="frmUser" id="frmUser" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> Name </label>
                                <input type="hidden" name="id_user" class="form-control" value="<?php echo $id; ?>" placeholder="Enter Name">
                                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label> Surname </label>
                                <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <label> Age </label>
                                <input type="number" name="age" class="form-control" value="<?php echo $age; ?>" min=0>
                            </div>
                            <div class="form-group">
                                <label> Birth Date </label>
                                <input type="datetime-local" name="birth_day" class="form-control" value="<?php echo $birth_dat; ?>">
                            </div>
                            <div class="form-group">
                                <label> Email </label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="xxx@mail.com">
                            </div>
                            <div class="form-group">
                                <label> Phone </label>
                                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label> Student Id </label>
                                <input type="text" name="student_id" class="form-control" value="<?php echo $student_id; ?>" placeholder="Enter  Student ID">
                            </div>
                            <div class="form-group">
                                <label> GPAX </label>
                                <input type="text" name="gpax" class="form-control" value="<?php echo $gpax; ?>" placeholder="Enter GPAX">
                            </div>
                            <div class="form-group">
                                <label> Volunteer Status </label>
                                <select name="v_status">
                                    <option value="<?php echo $v_status; ?>">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Volunteer </label>
                                <input type="text" name="volunteer" class="form-control" value="<?php echo $volunteer; ?>" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label> Gender </label>
                                <select name="gender">
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select name="user_status">
                                    <option value="0">Admin</option>
                                    <option value="1">Student</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Employee</option>
                                    <option value="4">Guest</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="user_name" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
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
                    <h6 class="m-0 font-weight-bold text-primary">Admin Users Profile 
            <?php if($update == true):?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile2">update</button>
            <?php else: ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">Add</button>
              <?php endif ?>
    </h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Name </th>
                                    <th>Surname </th>
                                    <th>Email</th>
                                    <th>EDIT </th>
                                    <th>DELETE </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
      if (mysqli_num_rows($result) > 0)
       {
        while($row = mysqli_fetch_assoc($result))
        { 
          ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['student_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['surname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['email']; ?>
                                        </td>
                                        <td>
                                            <a href="manage_user.php?edit=<?php echo $row['user_id']; ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="user.php?delete=<?php echo $row['user_id']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
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
        <script type="text/javascript">
        $(document).ready(function() {
            $("#add_user").click(function() {
                $.ajax({
                    type: "POST",
                    url: "add_user.php",
                    data: $("#frmUser").serialize(),
                    success: function(result) {
                        if (result.status == 1) // Success
                        {
                            alert(result.message);
                            window.location = 'manage_user.php'
                        } else // Err
                        {
                            alert(result.message);
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