<?php
include("../include/ConnectDB.php"); 

if(!$_SESSION['username']){
    echo(
        "<script> 
                alert('You are not loged in Please login'); 
                window.location = 'login.php'
    </script>");
}
?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
      </a>
<?php
if($_SESSION['status'] == 0){
?>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Manage Database</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Database:</h6>
            <a class="collapse-item" href="manage_user.php">User</a>
            <a class="collapse-item" href="manage_subject.php">Subject</a>
            <a class="collapse-item" href="manage_news.php">News</a>
            <a class="collapse-item" href="manage_activity.php">Activities</a>
          </div>
        </div>
      </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
                  <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="subject_time.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Check in Class Room</span></a>
      </li>
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="check_act.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Check in Activity</span></a>
      </li>
      <?php
}elseif($_SESSION['status'] == 2){
?>


      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="subject_time.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Check in Class Room</span></a>
      </li>
<?php
}else{
?>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="check_act.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Check in Class Room</span></a>
      </li>
<?php
}
?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

      <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form method="post" action="logout.php">
              <button type="submit"  name="logout" class="btn btn-danger">Logout</a>
          </form>
        </div>
      </div>
    </div>
  </div>