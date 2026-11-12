<?php

session_start();
if (!isset($_SESSION['admin_user']) || $_SESSION['admin_user'] !== 'nongvear12') {
    header("Location: index_admin.php");
    exit();
}
include("config.php");


$sql = "SELECT name, point FROM user ORDER BY point DESC";
$res = $conn->query($sql);

$dataPoints = array();
while ($row = $res->fetch()) {
   
    $dataPoints[] = array(
        "label" => $row['name'],
        "y" => (int)$row['point']
    );
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>กราฟสรุปข้อมูลสมาชิก</title>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", 
	title:{
		
		text: "กราฟแสดงคะแนนสะสมของสมาชิก"
	},
	data: [{
		type: "column", 
		indexLabel: "{y}", 
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		
	
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
</head>
<body>

<!-- กล่องแสดงกราฟ -->
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 20px auto;"></div>

<!-- [จุดที่ 4] เช็ก Path ของไฟล์ canvasjs.min.js ให้ตรงกับโฟลเดอร์โปรเจกต์ของคุณ -->
<script src="library/canvasjs-chart-3.17.9/canvasjs.min.js"></script>

</body>
</html>
