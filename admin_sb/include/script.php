  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script type="text/javascript">
        window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
	    theme: "light2",
	    animationEnabled: true,
	    title: {
		text: "Average Composition of Gender"
	    },
	    data: [{
		    type: "doughnut",
		    indexLabel: "{symbol} - {y}",
		    yValueFormatString: "#,##0.0\"%\"",
		    showInLegend: true,
		    legendText: "{label} : {y}",
		    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	    }]
    });
    var chart2 = new CanvasJS.Chart("chartContainer2", {
     animationEnabled: true,
     theme: "light2",
     title:{
         text: "Joined Activity By Type"
     },
     axisY: {
         title: "Joined Count "
     },
     data: [{
         type: "column",
         yValueFormatString: "#,##0.## tonnes",
         dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
     }]
    });
    chart.render();
    chart2.render();
    }
</script>
