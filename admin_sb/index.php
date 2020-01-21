<?php
    include('include/security.php');
    include('include/header.php');
    include('include/navbar.php');
    include("../include/ConnectDB.php");
$sqll = "SELECT  * from activity";
$sql1 = "SELECT * FROM user";
$sql2 = "SELECT DISTINCT id FROM activity a INNER JOIN join_activity ja ON (a.id = ja.id_activity) ";
$sql3 = "SELECT * FROM news";
$sql4 = "SELECT * FROM activity a INNER JOIN join_activity ja ON (a.id = ja.id_activity) ";
if (mysqli_query($con, $sqll)) 
{
} 
 else 
{
  echo "Error: " . $sqll . "<br>" . mysqli_error($con);
}
$result = mysqli_query($con, $sqll);
$result1 = mysqli_query($con, $sql1);
$result2 = mysqli_query($con, $sql2);
$result3 = mysqli_query($con, $sql3);
$result4 = mysqli_query($con, $sql4);
if (mysqli_num_rows($result4) > 0)
 {
  $learning = 0;
  $volunteer = 0;
  $recreation = 0;
  $hangout = 0;
  $travel = 0;
  $hobby = 0;
  $meet = 0;
  $eatanddrink = 0;
  while($row1 = mysqli_fetch_assoc($result4))
  { 
    if($row1['type'] == 1){
      $learning += 1 ;
      
    }else if($row1['type'] == 2){
      $volunteer += 1;
    }else if($row1['type'] == 3){
      $recreation += 1;
    }else if($row1['type'] == 4){
      $hangout += 1;
    }else if($row1['type'] == 5){
      $travel += 1;
    }else if($row1['type'] == 6){
      $hobby += 1;
    }else if($row1['type'] == 7){
      $meet += 1;
    }else{
      $eatanddrink += 1;
    }
    
  }
  $dataPoints2 = array( 
    array("y" => $learning, "label" => "Learning" ),
    array("y" => $volunteer, "label" => "Volunteer" ),
    array("y" => $recreation, "label" => "Recreation" ),
    array("y" => $hangout, "label" => "Hangout" ),
    array("y" => $travel, "label" => "Travel" ),
    array("y" => $hobby, "label" => "Hobby" ),
    array("y" => $meet, "label" => "Meet" ),
    array("y" => $eatanddrink, "label" => "Eat & Drink" )
  );
}


if (mysqli_num_rows($result) > 0)
 {
  $sum_row = 0 ;
  $c_row1 = 0;
  $c_row2 = 0;
  $c_row3 = 0;
  while($row = mysqli_fetch_assoc($result))
  { 
    $sum_row += $row['number_people'];
    if($row['gender'] == 1){
      $c_row1 += 1;
    }else if($row['gender'] == 2){
      $c_row2 += 1;
    }else{
      $c_row3 += 1;
    }
  }
  $all_row = $c_row1 + $c_row2 + $c_row3 ;
  $avg_row1 = ($c_row1/$all_row)*100;
  $avg_row2 = ($c_row2/$all_row)*100;
  $avg_row3 = ($c_row3/$all_row)*100;
  $dataPoints = array( 
	  array("label"=>"Male", "symbol" => "M", "y" => $avg_row1),
	  array("label"=>"Female", "symbol" => "F", "y" => $avg_row2),
	  array("label"=>"Male&Female", "symbol" => "M & F", "y" => $avg_row3),
);
   $c_row = mysqli_num_rows($result);
   $c_user = mysqli_num_rows($result1);
   $c_joinactivity = mysqli_num_rows($result2);
   $c_news = mysqli_num_rows($result3);

   $avg_join = 100*$c_joinactivity/$c_row;
   // output data of each row
}
?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Count Activities</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $c_row ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Count User</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $c_user ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Average Join Activity</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format( $avg_join ) ; ?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $avg_join ; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Count News</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $c_news; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
  <div class="row">
    <div class="col-sm-4"><div id="chartContainer" style="height: 370px; width: 100%;"></div></div>
    <div class="col-sm-8"><div id="chartContainer2" style="height: 370px; width: 100%;"></div></div>
  </div>
</div>
            
            
          <!-- Content Row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
<?php
    include('include/footer.php');
    include('include/script.php');
?>






