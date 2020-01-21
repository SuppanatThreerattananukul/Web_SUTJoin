<?php
include('include/security.php');
include('include/header.php'); 
include('include/navbar.php');
include('../include/ConnectDB.php');
require_once 'edit_activity.php';
?>
    <!-- Select Table -->
    <?php
      $sqll = "SELECT  * from activity a INNER JOIN user u ON(a.id_host = u.user_id)";
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Activity Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" name="frmUser" id="frmUser" method="POST">

                        <div class="modal-body">
                            <div class="form-group">
                                <label> ID HOST </label>
                                <input type="text" name="id_host" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label> Date </label>
                                <input type="datetime-local" name="date_start" class="form-control" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="date_host" class="form-control" value="<?php echo date("Y-m-d") ."T".date("H:i:s") .".000Z"; ?>" placeholder="Enter surname">
                            </div>
                            <div class="form-group">
                                <label> Title </label>
                                <input type="text" name="title" class="form-control" >
                            </div>
                            <div class="form-group">
                            <label> Type </label>
                                <select name="type">
                                    <option value="0">Select</option>
                                    <option value="1">learning</option>
                                    <option value="2">volunteer</option>
                                    <option value="3">recreation</option>
                                    <option value="4">hangout</option>
                                    <option value="5">travel</option>
                                    <option value="6">hobby</option>
                                    <option value="7">meet</option>
                                    <option value="8">eatanddrink</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Description </label>
                                <input type="text" name="description" class="form-control" placeholder="Enter  Description">
                            </div>
                            <div class="form-group">
                                <label> Number People  </label>
                                <input type="number" name="number_people" class="form-control" placeholder=" ">
                            </div>
                            <div class="form-group">
                                <label> Min age </label>
                                <input type="number" name="min_age" class="form-control" placeholder="Enter Age">
                            </div>
                            <div class="form-group">
                                <label> Max age </label>
                                <input type="number" name="max_age" class="form-control" placeholder="Enter Age">
                            </div>
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tag</label>
                                <input type="text" name="tag" class="form-control" placeholder="Enter Tag">
                            </div>
                            <div class="form-group">
                                <label> Volunteer Hour  </label>
                                <input type="number" name="volunteer" class="form-control" placeholder=" ">
                            </div>
                            <div class="form-group">
                            <label> Gender </label>
                                <select name="gender">
                                    <option value="0">Select</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Male & Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label> Status </label>
                                <select name="status">
                                    <option value="0">Not Finnish</option>
                                    <option value="1">Finnished</option>
                                </select>
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
                    <form action="edit_activity.php" name="frmUser" id="frmUser" method="POST">

                        <div class="modal-body">
                        <div class="form-group">
                                <label> ID HOST </label>
                                <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>">
                                <input type="text" name="id_host" class="form-control" value="<?php echo $id_host; ?>" >
                            </div>
                            <div class="form-group">
                                <label> Date Start </label>
                                <input type="text" name="date_start" class="form-control" value="<?php echo $date_start; ?>">
                            </div>
                            <div class="form-group">
                                <label> Title </label>
                                <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" >
                            </div>
                            <div class="form-group">
                            <label> Type </label>
                                <select name="type">
                                    <option value="<?php echo $type; ?>"><?php if($type == 1){
                                                echo "learning";
                                            }elseif($type == 2){
                                                echo "volunteer";
                                            }elseif($type == 3){
                                                echo "recreation";
                                            }elseif($type == 4){
                                                echo "hangout";
                                            }elseif($type == 5){
                                                echo "travel";
                                            }elseif($type == 6){
                                                echo "hobby";
                                            }elseif($type == 7){
                                                echo "meet";
                                            }else{
                                                echo "eatanddrink";
                                            }
                                    ?></option>
                                    <option value="1">learning</option>
                                    <option value="2">volunteer</option>
                                    <option value="3">recreation</option>
                                    <option value="4">hangout</option>
                                    <option value="5">travel</option>
                                    <option value="6">hobby</option>
                                    <option value="7">meet</option>
                                    <option value="8">eatanddrink</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label> Description </label>
                                <input type="text" name="description"  value="<?php echo $description; ?>" class="form-control" placeholder="Enter  Description">
                            </div>
                            <div class="form-group">
                                <label> Number People  </label>
                                <input type="number" name="number_people" value="<?php echo $number_people; ?>" class="form-control" placeholder=" ">
                            </div>
                            <div class="form-group">
                                <label> Min age </label>
                                <input type="number" name="min_age" value="<?php echo $min_age; ?>" class="form-control" placeholder="Enter Age">
                            </div>
                            <div class="form-group">
                                <label> Max age </label>
                                <input type="number" name="max_age"  value="<?php echo $max_age; ?>" class="form-control" placeholder="Enter Age">
                            </div>
                            <div class="form-group">
                                <label> Location Latitude </label>
                                <input type="text" name="location_lat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tag</label>
                                <input type="text" name="tag" value="<?php echo $tag; ?>" class="form-control" placeholder="Enter Tag">
                            </div>
                            <div class="form-group">
                            <label> Gender </label>
                                <select name="gender">
                                    <option value="<?php echo $gender; ?>"><?php if($gender == 1){
                                        echo "Male";
                                    }elseif($gender == 2){
                                        echo "Female";
                                    }else{
                                        echo "Male And Female";
                                    }  ?></option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Male & Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label> Status </label>
                                <select name="status">
                                    <option value="0">General</option>
                                    <option value="1">Volunteer</option>
                                </select>
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
                    <h6 class="m-0 font-weight-bold text-primary">Add Activity 
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
                                    <th> Name </th>
                                    <th> Title  </th>
                                    <th>Type </th>
                                    <th>Number People</th>
                                    <th> Gender </th>
                                    <th>EDIT </th>
                                    <th>DELETE </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
      if (mysqli_num_rows($result) > 0)
       {
        while($row = mysqli_fetch_assoc($result))
        { $name = $row['name'] . " " . $row['surname'];
          ?>
                                    <tr>
                                        <td>
                                            <?php echo $name; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['title']; ?>
                                        </td>
                                        <td>
                                            <?php if($row['type'] == 1){
                                                echo "learning";
                                            }elseif($row['type'] == 2){
                                                echo "volunteer";
                                            }elseif($row['type'] == 3){
                                                echo "recreation";
                                            }elseif($row['type'] == 4){
                                                echo "hangout";
                                            }elseif($row['type'] == 5){
                                                echo "travel";
                                            }elseif($row['type'] == 6){
                                                echo "hobby";
                                            }elseif($row['type'] == 7){
                                                echo "meet";
                                            }else{
                                                echo "eatanddrink";
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $row['number_people']; ?>
                                        </td>
                                        <td>
                                            <?php if($row['gender'] == 1){
                                                echo "Male";
                                            }elseif($row['gender'] == 2){
                                                echo "Female";
                                            }else{
                                                echo "Male & Female";
                                            } ?>
                                        </td>
                                        <td>
                                            <a href="manage_activity.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <a href="edit_activity.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
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
                    url: "add_activity.php",
                    data: $("#frmUser").serialize(),
                    success: function(result) {
                        if (result.status == 1) // Success
                        {
                            alert(result.message);
                            window.location = 'manage_activity.php'
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