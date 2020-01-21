<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sut_join";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sqll = "SELECT  * from activity";
$sqll1 = "SELECT  * from activity WHERE gender='0'";
$sqll2 = "SELECT  * from activity WHERE gender='1'";
$sqll3 = "SELECT  * from activity WHERE gender='2'";
$sqll4 = "SELECT  * from activity WHERE gender='3'";
$result1 = mysqli_query($conn, $sqll1);
$result2 = mysqli_query($conn, $sqll2);
$result3 = mysqli_query($conn, $sqll3);
$result4 = mysqli_query($conn, $sqll4);
$c_row1 = mysqli_num_rows($result1);
$c_row2 = mysqli_num_rows($result2);
$c_row3 = mysqli_num_rows($result3);
$c_row4 = mysqli_num_rows($result4);
$data = array( 
	array("label"=>"All", "Value" => $c_row1),
	array("label"=>"Male", "Value" => $c_row2),
	array("label"=>"Female", "Value" => $c_row3),
	array("label"=>"Other", "Value" => $c_row4),
);
$data = json_encode($data);
?>


<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Live Donut Chart by using Morris.js with Ajax PHP</title>  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />  
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">Live Donut Chart by using Morris.js with Ajax PHP</h2>
   <form method="post" id="like_form">
    <div class="form-group">
     <label>Like Any one PHP Framework</label>
     <div class="radio">
      <label><input type="radio" name="framework" value="Codeigniter" /> Codeigniter</label>
     </div>
     <div class="radio">
      <label><input type="radio" name="framework" value="Laravel" /> Laravel</label>
     </div>
     <div class="radio">
      <label><input type="radio" name="framework" value="Symfony" /> Symfony</label>
     </div>
     <div class="radio">
      <label><input type="radio" name="framework" value="Yii" /> Yii</label>
     </div>
     <div class="radio">
      <label><input type="radio" name="framework" value="CakePHP" /> CakePHP</label>
     </div>
    </div>
    <div class="form-group">
     <input type="submit" name="like" class="btn btn-info" value="Like" />
    </div>
   </form>
   <div id="chart"></div>
  </div>
 </body>
</html>

<script>

$(document).ready(function(){
 
 var donut_chart = Morris.Donut({
     element: 'chart',
     data: <?php echo $data; ?>
     data:form_data,
    dataType:"json",
     donut_chart.setData(data);
    });
});

</script>
