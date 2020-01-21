<?php
error_reporting(0);
include('include/security2.php');
ini_set('display_errors', 0);
include('include/header.php'); 
include('include/navbar.php'); 
include('../include/ConnectDB.php');
?>
    <div class="container-fluid">
        <!-- DataTales Example -->
        <?php
        $subject_id = $_GET['myc_id'] . "_" . date("d/m/Y"); 
        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
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
          $chech_lat = abs($lat - $row['check_lat']);
          $chech_lng = abs($lng - $row['check_lng']);
          if($chech_lat > 0.0002 ||  $chech_lng > 0.0002){
          ?>
                                    <tr class="bg-danger text-white">
          <?php 
          }else{?>
                                    <tr>
          <?php } ?>
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
    ?>
                </div>
            </div>
    </div>
    </div>
<?php 
include('include/script.php');
include('include/footer.php');
?>