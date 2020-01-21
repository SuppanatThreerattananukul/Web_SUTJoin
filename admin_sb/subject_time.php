<?php
error_reporting(0);
include('include/security2.php');
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
<h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
<div id="map"></div>
        <!-- DataTales Example -->
        <form action="subject_time.php" method="POST">
            <h6 class="m-0 font-weight-bold text-primary">Enter Course Id</h6>
            <input type="text" name="subject_id" placeholder="210100">
            <button  onclick="getLocation()" type="button" class="btn btn-primary" name="gen">Confirm</button>
            <a href="subject_time.php" class="btn btn-primary">Cancle</a>
        </form>

        <?php
    if(isset($_POST['gen'])){
        $subject_id = $_POST['subject_id'] . "_" . date("d/m/Y"); 
        $pieces = explode("_", $subject_id);
        $date = $pieces[1]; // piece2
  ?>
            <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $subject_id; ?>" title="<?php echo $subject_id;?>" />
            <div class="card-body">
                <div class="table-responsive">
                    <?php
    $sub_id = $pieces[0];
      $sql = "SELECT  * FROM user u INNER JOIN check_name cn ON (u.user_id = cn.id_student) WHERE subject_id = $sub_id";
      $result = mysqli_query($con, $sql);    
    ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> Student ID </th>
                                    <th> Name </th>
                                    <th>Surname </th>
                                    <th> Phone</th>
                                    <th>
                                        <?php echo $date;?>
                                    </th>
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
                                            <?php echo $row['phone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['date_checked']; ?>
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
                        <?php 
    }else
    {
    ?>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> Subject ID </th>
                                        <th>Subject Name </th>
                                        <th> Teacher Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  $use_id =  $_SESSION['user_id'];
            $sql2 = "SELECT  * FROM subject s INNER JOIN user u ON(s.id_teacher = u.user_id) WHERE s.id_teacher = '$use_id'";
            $result2 = mysqli_query($con, $sql2);   
        if (mysqli_num_rows($result2) > 0)
        {

        while($row = mysqli_fetch_assoc($result2))
        {$name = $row['name'] . " " . $row['surname'];
          ?>
                                        <tr>
                                            <td>
                                                <input type="button" class="btn btn-success" onclick="getLocation(<?php echo $row['id_subject']; ?>)" value="<?php echo $row['id_subject']; ?>" ></button>
                                            </td>
                                            <td>
                                                <?php echo $row['name_subject']; ?>
                                            </td>
                                            <td>
                                                <?php echo $name; ?>
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
                            <?php
    }
    ?>
                </div>
            </div>
    </div>
    <?php $lat = '<p id="lat"></p>' ; 
    $long = '<p id="long"></p>';
    echo $lat;
    echo $long;?>
    
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var x = document.getElementById("lat");
      var y = document.getElementById("long");
      var c_id = "";
      function getLocation(val) {
        set_id(val);
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
};
      

function showPosition(position) {
  x = position.coords.latitude;
  y = position.coords.longitude;
  var mylat = getmylat(x);
  var mylng = getmylng(y);
  var myc_id = get_id();
  window.location.href = "subject.php?lat=" + mylat +"& lng="+mylng+"& myc_id="+myc_id;
}
function getmylat(x){;
  return x ;
}
function getmylng(y){;
  return y ;
}
function set_id(val){;
  c_id = val;
}
function get_id(){;
  return c_id;
}

      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 17
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_ferFmDFnStm9gqKB1GivwXD6kgZvog4&callback=initMap">
    </script>
    <?php
include('include/script.php');
include('include/footer.php');
?>