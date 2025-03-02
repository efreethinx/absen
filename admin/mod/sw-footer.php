<?php if (empty($connection)) {
  header('location:./404');
} else {

  $mod = "home";
  $mod = htmlentities(@$_GET['mod']);
  // Get number
  function get_numbers()
  {
    for ($i = 1; $i <= 500; $i++) {
      yield $i;
    }
  }
  $result = get_numbers();
  function convert($size)
  {
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
  }
  echo '
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    Developed by <a href="https://skensala.my.id" rel="dofollow" target="_blank">FyOs</a> - <a href="https://skensala.my.id" rel="dofollow" target="_blank">SKENSALA</a>
    </div>
    
      <a class="credits" href="https://skensala.my.id" rel="nofollow" target="_blank">FyOs</a>
    
     &copy;' . DATE('Y') . ' ' . $site_name . '
  </footer>
</div>
<!-- wrapper -->';

if ($mod== 'libur'){
    echo '
    
    <script>
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        "autoclose": true
    }); 
    
</script>';
    
}

if ($mod== 'export' || $mod== 'izin' || $mod== 'alpha' || $mod== 'anomali' ||$mod== 'dnl' || $mod =='penilaian' || $mod =='penilaian2' || $mod == 'terbaik' || $mod== 'jadwal' || $mod== 'mapel' || $mod== 'perangkat' || $mod== 'akhp')
{
    
    
}else
{
    echo '<script src="./assets/js/jquery-2.2.3.min.js"></script>';
}
echo '<script src="./assets/js/jquery-ui.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery.slimscroll.min.js"></script>
<script src="./assets/js/adminlte.js"></script>
<script src="./assets/js/app.js"></script>
<script src="./assets/js/demo.js"></script>
<script src="./assets/js/sweetalert.min.js"></script>
<script src="./plugins/chart.js/Chart.min.js"></script>
<script src="./assets/js/simple-lightbox.min.js"></script>
<script src="./assets/js/validasi/jquery.validate.js"></script>
<script src="./assets/js/validasi/messages_id.js"></script>';
  if ($mod == 'shift') {
    echo '
<script src="./assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="./assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>';
  }

  if ($mod == 'karyawan' or $mod == 'jabatan' or $mod == 'shift' or $mod == 'lokasi' or $mod == 'user' or $mod == 'absensi' or $mod == 'libur' or $mod == 'pengumuman') {
    echo '
<link rel="stylesheet" href="./assets/plugins/datatables/dataTables.bootstrap.css">
<script src="./assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/plugins/datatables/dataTables.bootstrap.min.js"></script>';
  }
  if ($mod == 'lokasi') {
      ?>
       <script type="text/javascript">
       function myFunctionX() {
  navigator.geolocation.getCurrentPosition(function(location) {
  var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

  $("#Latitude").val(location.coords.latitude);
  $("#Longitude").val(location.coords.longitude).keyup();

  var curLocation = [0, 0];
  if (curLocation[0] == 0 && curLocation[1] == 0) {
    curLocation = latlng;
  }
  
  var xg =document.getElementById('Latitude').value ;
            var xh =document.getElementById('Longitude').value ;

var cgbs = "https://api.mapbox.com/geocoding/v5/mapbox.places/"+xh+","+xg+".json?types=place&access_token=pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg";

//alert(cgbs);

$.getJSON('https://api.mapbox.com/geocoding/v5/mapbox.places/108.620918,-6.828957.json?types=place&access_token=pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg', function(data){
    $("#City").val(data.features[0]["text"]);
    //alert(data.features[0]["text"]);
  });


  
  var map = L.map('MapLocation').setView(curLocation, 17);
  L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '',id: 'mapbox/satellite-v9',
    id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1,
			accessToken: 'pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg'
  }).addTo(map);
  map.attributionControl.setPrefix(false);
  var marker = new L.marker(curLocation, {
    draggable: 'true'
  }).addTo(map).bindPopup("Posisi Sekarang").openPopup();

    lc = L.control.locate({
      strings: {
          title: "Tunjukkan di mana saya berada!"
      }
    }).addTo(map);
    
     var circle = L.circle(curLocation, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 80
	}).addTo(map).bindPopup("Radius");

  marker.on('dragend', function(event) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng).keyup();
  });

  $("#Latitude, #Longitude").change(function() {
    var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    map.panTo(position);
  });
  map.addLayer(marker);
});






}
</script>

<script type="text/javascript">
       function myFunctiony() {
           navigator.geolocation.getCurrentPosition(function(location) {
            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
            
            var xg =document.getElementById('latitude').value ;
            var xh =document.getElementById('longitude').value ;
            var xi =document.getElementById('txtname').value ;
            // alert(document.getElementById('latitude').value);
            // alert(document.getElementById('longitude').value);
            
              
                var curLocation = [xg,xh];              if (curLocation[0] == 0 && curLocation[1] == 0) {
                curLocation = latlng;
              }
              var map = L.map('Mapx').setView(curLocation, 18);
              L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);
              map.attributionControl.setPrefix(false);
              var marker = new L.marker(curLocation, {
                draggable: 'true'
              });

              lc = L.control.locate({
                strings: {
                    title: "Tunjukkan di mana saya berada!"
                }
              }).addTo(map);
              
              var dtRds = document.getElementById('radius').value;
              
              if (dtRds == ''){
                  dtRds =80;
              }
              
              var circle = L.circle([xg, xh], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: dtRds
	}).addTo(map).bindPopup(xi).openPopup();

              marker.on('dragend', function(event) {
              var position = marker.getLatLng();
              $("#latitude").val(location.coords.latitude);
              $("#longitude").val(location.coords.longitude).keyup();

              marker.setLatLng(position, {
                  draggable: 'true'
              }).bindPopup(position).update();
                $("#latitude").val(position.lat);
                $("#longitude").val(position.lng).keyup();
              });

              $("#latitude, #longitude").change(function() {
                var position = [parseInt($("#latitude").val()), parseInt($("#longitude").val())];
                marker.setLatLng(position, {
                  draggable: 'true',
                  showCompass: true,
                showPopup: false,
                }).bindPopup(position).update();
                map.panTo(position);
              });
              map.addLayer(marker);
            });
           
       }
       </script>


       
       <?php
      echo '<script src="./assets/mapes/leaflet.js"></script>
      <script src="./assets/mapes/L.Control.Locate.js" ></script>';
  }
  if ($mod == 'absensi') {
    echo '
<script src="../mod/assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>';
  }

  if (file_exists('mod/' . $mod . '/scripts.js')) {
    echo '
  <script src="mod/' . $mod . '/scripts.js"></script>';
  }
  echo '
  <script type="text/javascript">
  	$(document).ready(function() {
  		$(".validate").validate();
  	});
    
    $(document).ready(function() {
      $(".validate2").validate();
    });
    $(document).on("click", ".access-failed", function(){ 
      swal({title:"Error!", text: "Anda tidak memiliki hak akses!", icon:"error",timer:2000,});  
    });
    
    function cheks()
            {
                 swal({title:"Refresh", text: "Mohon Tunggu, Data Akan Segera Di Refresh", icon:"success",timer:3000,}).then((result) => {
                 window.location = "https://presensi.skensala.tech/admin/izin";
           });
            }
            // var convertBtn = document.getElementById("inputdtxs");
            // convertBtn.addEventListener("click", cheks);
    
    
  </script>'; ?>
  </body>

  </html>
<?PHP } ?>