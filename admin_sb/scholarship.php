<?php
// include('include/security.php');
include('include/header.php'); 
include('include/navbar.php');
include('../include/ConnectDB.php');

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
// $id = $_GET['id']; //button id
$id = 2;
$total_records_per_page = 10;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM join_activity INNER JOIN user ON join_activity.id_user = user.user_id WHERE join_activity.id_activity = $id");
$total_records = mysqli_fetch_assoc($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;

$sqll = "SELECT * FROM join_activity INNER JOIN user ON join_activity.id_user = user.user_id WHERE join_activity.id_activity = $id ORDER BY user.student_id LIMIT $offset, $total_records_per_page";
if (mysqli_query($con, $sqll)){
    $result = mysqli_query($con, $sqll);
}else{
    echo "Error: " . $sqll . "<br>" . mysqli_error($con);
}
?>
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

<div class="container-fluid">
<br>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
</div>
<div class="card-body">
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Surname</th>
                <th onclick="sortTable(3)">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (mysqli_num_rows($result) > 0){
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
                        </tr>
            <?php
                    }
                }else{
                    echo "no table row";
                }
            ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example" style='text-center'>
        <ul class="pagination">
        <?php
            if($page_no == 1){
                echo "<li class='page-item'><a class='page-link'>First</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>First</a></li>";
            }
            if($page_no <= 4 ) {			
                for ($counter = 1; $counter < ($total_no_of_pages > 10 ? 6 : $total_no_of_pages - 1); $counter++){		 
                    if ($counter == $page_no) {
                        echo "<li class='page-item'><a class='page-link'>$counter</a></li>";	
                    }else{
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                    }
                }
                if($total_no_of_pages > 5){
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                }
                if($total_no_of_pages != 1){
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
            }elseif($page_no > 4 && $page_no <= $total_no_of_pages) { 
                echo "<li class='page-item'><a class='page-link' href='?page_no=1'>1</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page_no=2'>2</a></li>";
                echo "<li class='page-item'><a class='page-link'>...</a></li>";
                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) { 
                    if($page_no < $total_no_of_pages-1){
                        if ($counter == $page_no) {
                            echo "<li class='page-item'><a class='page-link'>$counter</a></li>"; 
                        }else{
                            if($counter < $total_no_of_pages-1){
                                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }                  
                    }
                }
                if($page_no < $total_no_of_pages-1){
                    echo "<li class='page-item'><a class='page-link'>...</a></li>";
                }
                if($page_no < $total_no_of_pages){
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                }else{
                    echo "<li class='page-item'><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' >$total_no_of_pages</a></li>";
                }
            }
            if($page_no == $total_no_of_pages){
                echo "<li class='page-item'><a class='page-link'>Last</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='?page_no=$total_no_of_pages'>Last</a></li>";
            }
        ?>
        </ui>
    </nav>
    <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>
</div>
</div>
</div>
<?php
include('include/script.php');
?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("dataTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>