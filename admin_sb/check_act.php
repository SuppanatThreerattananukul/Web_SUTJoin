<?php
error_reporting(0);
include('include/security4.php');
ini_set('display_errors', 0);
include('include/header.php'); 
include('include/navbar.php'); 
include('../include/ConnectDB.php');
?>
 
    <div class="container-fluid">
    <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
      <form class="form-inline mr-auto w-100 navbar-search">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>


  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']?></span>
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>
<!-- End of Topbar -->

  <?php 
    if(isset($_GET['id'])){
       $id = $_GET['id'];
      $ac_id = sprintf("%02d", $id);
        ?> <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo "IdActivity_" . $ac_id."_" . date("d/m/Y") ; ?>" title="<?php echo "IdActivity_" . $ac_id."_" . date("d/m/Y");?>" />
    <?php 
     }
  ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> activity ID </th>
                                        <th>activity Name </th>
                                        <th> Date Start</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  $use_id =  $_SESSION['user_id'];
            $sql2 = "SELECT  * FROM activity a INNER JOIN user u ON(a.id_host = u.user_id) WHERE a.id_host = '$use_id' && a.status = 0";
            $result2 = mysqli_query($con, $sql2);   
        if (mysqli_num_rows($result2) > 0)
        {
        while($row = mysqli_fetch_assoc($result2))
        {$name = $row['name'] . " " . $row['surname'];
          ?>
                                        <tr>
                                            <td>
                                                <a href="check_act.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                    <?php echo $row['id']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $row['title']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date_start']; ?>
                                            </td>
                                            <!--  -->
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
    <?php
include('include/script.php');
include('include/footer.php');
?>