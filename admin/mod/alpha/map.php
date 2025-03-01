<?php
session_start();
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../library/sw-function.php');


$error = array();
if (empty($_GET['latitude'])) {
	$error[] = 'ID tidak boleh kosong';
} else {
	$latitude = $_GET['latitude'];
}

if (empty($_GET['longitude'])) {
	$error[] = 'ID tidak boleh kosong';
} else {
	$longitude = $_GET['longitude'];
}

if (empty($_GET['name'])) {
	$error[] = 'ID tidak boleh kosong';
} else {
	$name = $_GET['name'];
}

 $query_absen="SELECT * FROM employees WHERE employees_name = '$name'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $DTShift = $row_absen['shift_id'];
                 $DTBuild = $row_absen['building_id'];
             }
        }
        
         $query_absen="SELECT * FROM building WHERE building_id = $DTBuild";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                //  $Tilok1 = $row_absen['time_in'];
                //  $Tilok2 = $row_absen['time_out'];
                  $latitudexy = $row_absen['latitude'];
                  $longitudexy = $row_absen['longitude'];
                  $building = $row_absen['name'];
             }
        }



if (empty($error)) {
	echo '
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Map</title>
		<link rel="stylesheet" href="../../assets/plugins/leatfet/leaflet.css">
    <script src="../../assets/plugins/leatfet/leaflet.js"></script>
	</head>
	<body>
		<div id="peta" style="height:500px; width: 100%"></div>'; ?>
	<script type="text/javascript">
		var mymap = L.map('peta').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 17);
		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg', {
			maxZoom: 20,
			center: [<?php echo $latitude; ?>, <?php echo $longitude; ?>],
			attribution: '',
			id: 'mapbox/satellite-v9',
			tileSize: 512,
			zoomOffset: -1,
			//accessToken: 'pk.eyJ1IjoiYWRpZ3VuYXdhbnhkIiwiYSI6ImNrcWp2Yjg2cDA0ZjAydnJ1YjN0aDNnbm4ifQ.htvHCgSgN0UuV8hhZBfBfQ'
			accessToken: 'pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg'
		}).addTo(mymap);
		L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(mymap).bindPopup("<?php echo $name; ?>").openPopup();
		L.circle([<?php echo $latitudexy; ?>, <?php echo $longitudexy; ?>], 100, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.2
		}).addTo(mymap).bindPopup("<?php echo $building; ?>").openPopup();
		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("" + e.latlng.toString())
				.openOn(mymap);
		}
		mymap.on('click', onMapClick);
	</script>

	</body>

	</html>
<?PHP } else {
	echo 'Data tidak ditemukan';
} 
}
?>