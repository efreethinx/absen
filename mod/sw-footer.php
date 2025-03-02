<?php if (empty($connection)) {
  header('location:./404');
} else {

  if (isset($_COOKIE['COOKIES_MEMBER'])) {
    echo '
<div class="appBottomMenu">
        <a href="./&app=2.7" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="./dinas" class="item">
            <div class="col">
                <ion-icon name="car-outline"></ion-icon>
                <strong>Dinas</strong>
            </div>
        </a>';

    echo '<a href="./present" class="item">
            <div class="col">
                <ion-icon name="camera-outline"></ion-icon>
                <strong>Presensi</strong>
            </div>
        </a>';


    echo '<a href="./profile" class="item">
            <div class="col">
                <ion-icon name="person-outline"></ion-icon>
                <strong>Profil</strong>
            </div>
        </a>
        <!--<a href="./id-card" class="item">
            <div class="col">
               <ion-icon name="id-card-outline"></ion-icon>
                <strong>ID Card</strong>
            </div>
        </a>-->
        <a href="./history" class="item">
            <div class="col">
                 <ion-icon name="document-text-outline"></ion-icon>
                <strong>Riwayat</strong>
            </div>
        </a>
    </div>
<!-- * App Bottom Menu -->';
  }

  if ($mod != 'terbaik' && $mod != 'profile' && $mod != 'calender') {
    echo '<script src="' . $base_url . 'mod/assets/js/lib/jquery-3.4.1.min.js"></script>';
  }

  if ($mod == 'profile') {
  }
  if ($mod == 'calender') {

    $idPegawaiXX = $row_user['id'];

    $query_absen = "SELECT * FROM shift WHERE shift_name = 'FULL TIME'";
    $result_absen = $connection->query($query_absen);
    if ($result_absen->num_rows > 0) {
      while ($row_absen = $result_absen->fetch_assoc()) {
        $shift_time_in = $row_absen['time_in'];
      }
    }

    // $query_absen="SELECT * FROM presence where employees_id = '$idPegawaiXX'  and presence_date LIKE '$year%'";


    $query_absen = "SELECT employees.*,presence.presence_date,position.position_name,presence.employees_id,presence.time_in,presence.time_out,presence.picture_in,presence.present_id,presence.presence_address,presence.information,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'$shift_time_in') AS selisih,if (presence.time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.position_id=position.position_id AND presence.employees_id=employees.id AND 
presence.presence_date LIKE '$year%' AND presence.employees_id = '$idPegawaiXX'";



    echo '<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
    echo "<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>";
    echo "<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales/id.js'></script>";
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
    echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                height: 'auto',
                googleCalendarApiKey: 'AIzaSyDse1PT99LUf6YcTrXaXZTsUp3HW2wFpO8',
                    initialView: 'dayGridMonth',
                    navLinks: true,
                    headerToolbar: {
        left: 'title',
        top: 'title',
        right: 'today,dayGridMonth,prev,next'
      },
                    events: [
                    {
      daysOfWeek: [0,6],//Sundays and saturdays
      rendering:'background',
      color: '#FF396F',
      overLap: 'false',
      allDay: 'true',
      title: 'Libur'
    },
                   
                    ";
    $result_absen = $connection->query($query_absen);
    if ($result_absen->num_rows > 0) {
      while ($row_absen = $result_absen->fetch_assoc()) {

        if ($row_absen['time_in'] == "00:00:00" || $row_absen['time_out'] == "00:00:00") {
          $clrx = "#FF396F";
        }

        if ($row_absen['status'] == 'Telat' && $row_absen['present_id'] == 1 && $row_absen['information'] != 'DNL') {

          $clrx = "#FF396F";
        } elseif ($row_absen['status'] == 'Tepat Waktu' && $row_absen['present_id'] == 1 && $row_absen['information'] != 'DNL') {
          $clrx = "#28a745";
        } elseif ($row_absen['present_id'] == 1 && $row_absen['information'] == 'DNL') {
          $clrx = "#ffc107";
        } else {

          if ($row_absen['present_id'] == 2) {
            $clrx = "#ffc107";
          } else if ($row_absen['present_id'] == 3) {
            $clrx = "#ffc107";
          }

          $clrx = "#ffc107";
        }




        echo "{
                                                        title: 'Masuk " . $row_absen['time_in'] . "' ,
                                                        start:'" . $row_absen['presence_date'] . "',
                                                        color: '" . $clrx . "',
                                                        url: '" . $base_url . "content/present/" . $row_absen['picture_in'] . "'
                                                    },
                                                   ";

        if ($row_absen['time_in'] == "00:00:00" || $row_absen['time_out'] == "00:00:00") {
          $clrx = "#FF396F";
        }
        echo "{
                                                        title: 'Pulang " . $row_absen['time_out'] . "' ,
                                                        start:'" . $row_absen['presence_date'] . "',
                                                        color: '" . $clrx . "',
                                                        url: '" . $base_url . "content/present/" . $row_absen['picture_out'] . "'
                                                    },
                                                   ";
      }
    }

    $query_absen = "SELECT * FROM libur_kerja where tanggal_libur LIKE '%$year'";
    $result_absen = $connection->query($query_absen);
    if ($result_absen->num_rows > 0) {
      while ($row_absen = $result_absen->fetch_assoc()) {

        $tgglxLibur = $row_absen['tanggal_libur'];

        $tglylibur = explode("-", $tgglxLibur);

        $tglzlibur = $tglylibur[2] . "-" . $tglylibur[1] . "-" . $tglylibur[0];

        echo "{
                                                        
                                                        title: '" . $row_absen['ket_libur'] . " ( " . $row_absen['lama_libur'] . " Hari )' ,
                                                        description: '" . $row_absen['ket_libur'] . "',
                                                        start:'" . $tglzlibur . "T01:00:00',
                                                        end:'" . $tglzlibur . "T23:00:00',
                                                        color: '#007bff',
                                                        borderColor: '#007bff'
                                                    },
                                                   ";
      }
    }

    $query_absen = "SELECT employees.employees_name , employees.tglhr FROM employees";
    $result_absen = $connection->query($query_absen);
    if ($result_absen->num_rows > 0) {
      while ($row_absen = $result_absen->fetch_assoc()) {
        $tglultah = $row_absen['tglhr'];

        $nmultah = $row_absen['employees_name'];

        $tglultahx = explode("-", $tglultah);

        $tglultahy = $year . "-" . $tglultahx[1] . "-" . $tglultahx[0];
        $umurX = $year - $tglultahx[2];

        echo "{
                                                        
                                                        title: '" . $nmultah . " Berulang Tahun Ke-" . $umurX . "' ,
                                                        description: 'Ulang Tahun " . $nmultah . "',
                                                        start:'" . $tglultahy . "',
                                                        end:'" . $tglultahy . "',
                                                        color: '#6610f2',
                                                        borderColor: '#6610f2',
                                                        icon : 'birthday-cake'
                                                    },
                                                   ";
      }
    }


    echo "
                    
                    
                    
                    ],googleCalendarApiKey: 'AIzaSyDse1PT99LUf6YcTrXaXZTsUp3HW2wFpO8',
      eventSources: [
        {
          googleCalendarId: 'en.indonesian#holiday@group.v.calendar.google.com'
        },
        {
          googleCalendarId: 'en.islamic#holiday@group.v.calendar.google.com',
          className: 'islamic-event'
        }
      ],
                    locale: 'id',
                    weekends: true,
                    eventTimeFormat: { date: 'yyyy' },
                    selectOverlap: function (event) {
                        return event.rendering === 'background';
                    },eventRender: function(event, element) {
     if(event.icon){          
        ";
    echo 'element.find(".fc-title").prepend("<i class=';
    echo "'fa fa-";
    echo '"+event.icon+"';
    echo "'></i>";
    echo '"';
    echo ");
     }
  }
                });
                
                
                
                calendar.render();
            });
            
           
            
        </script>";
  }

  echo '
<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<!---->
<!-- Bootstrap-->
<script src="' . $base_url . 'mod/assets/js/lib/popper.min.js"></script>
<script src="' . $base_url . 'mod/assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="' . $base_url . 'mod/assets/js/base.js"></script>
<script src="' . $base_url . 'mod/assets/js/sweetalert.min.js"></script>
<script src="' . $base_url . 'mod/assets/js/webcamjs/webcam.min.js"></script>';

  $custanggal = DATE('d') . "-" . DATE('m');
  $cUltahx = 0;

  $query_absen = "SELECT employees_name,photo,jk,tglhr FROM employees WHERE tglhr LIKE '$custanggal%'";
  $result_absen = $connection->query($query_absen);
  if ($result_absen->num_rows > 0) {
    while ($row_absen = $result_absen->fetch_assoc()) {

      $cUltahx++;
    }
  }

  if ($cUltahx > 0) {

    if ($mod == 'home') {
      echo '<script>document.getElementById("cobas").click();</script>';
    }
  }

  //echo "Banyak Ultah : ". $cUltahx ;

  if ($mod == 'id-card') {
    echo '
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>'; ?>
    <script type="text/javascript">
      /* ---------- Save Id Card ----------*/
      var element = $("#divToPrint"); // global variable
      var getCanvas; // global variable
      html2canvas(element, {
        onrendered: function(canvas) {
          $("#previewImage").append(canvas);
          getCanvas = canvas;
        }
      });

      $(".btn-Convert-Html2Image").on('click', function() {
        var imgageData = getCanvas.toDataURL("image/png");
        // Now browser starts downloading it instead of just showing it
        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
        $(".btn-Convert-Html2Image").attr("download", "ID-CARD.jpg").attr("href", newData);
      });
    </script>
  <?PHP }

  if ($mod == 'history' || $mod == 'profile' || $mod == 'rekan') {
    echo '
<script src="' . $base_url . 'mod/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="' . $base_url . 'mod/assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="' . $base_url . 'mod/assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="' . $base_url . 'mod/assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script>
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        "autoclose": true
    }); 
    
</script>';
  }

  if ($mod == 'profile') {
    echo '<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#selMapel").select2();

            // Read selected option
           
        });
        </script>';
  }

  if ($mod == 'agenda') {
    echo "<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'charmap image preview',
      menubar: 'file insert view',
      skin: 'outside',
      toolbar_mode: 'floating',
      images_upload_url: 'postAcceptor.php',
      automatic_uploads: false,
      images_file_types: 'jpg,png',
      images_upload_base_path: '/agenda/',
    });
  </script>";
  }


  echo '
<script src="' . $base_url . '/mod/assets/js/sw-script.js"></script>';
  if ($mod == 'present') { ?>
    <script type="text/javascript">
      var result;
      //setInterval(getLocation, 3000);
      $(document).ready(function getLocation() {
        result = document.getElementById("latitude");
        //alert(result.innerHTML);


        //$("#jarak").html($('.latitude').html());
        // 
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
          swal({
            title: 'Oops!',
            text: 'Maaf, browser Anda tidak mendukung geolokasi HTML5.',
            icon: 'error',
            timer: 3000,
          });
        }
      });

      // Define callback function for successful attempt
      function successCallback(position) {
        result.innerHTML = "" + position.coords.latitude + "," + position.coords.longitude + "";
        //alert(result.innerHTML);

        var meter = 0;
        var miles = 0;
        var distance = 0;
        var koversi = 0;
        var jarak1 = position.coords.latitude;
        var jarak2 = position.coords.longitude;

        //   var jaraks1 = "-6.828957028076009";
        //   var jaraks2 = "108.62091820819346";


        <?php

        $query_absen = "SELECT * FROM system";
        $result_absen = $connection->query($query_absen);
        if ($result_absen->num_rows > 0) {
          while ($row_absen = $result_absen->fetch_assoc()) {
            $latitudexy = $row_absen['latitude'];
            $longitudexy = $row_absen['longitude'];
          }
        }

        $iduserxTy = $row_user['id'];

        $query_absen = "SELECT * FROM employees WHERE id = $iduserxTy";
        $result_absen = $connection->query($query_absen);
        if ($result_absen->num_rows > 0) {
          while ($row_absen = $result_absen->fetch_assoc()) {
            $DTShift = $row_absen['shift_id'];
            $DTBuild = $row_absen['building_id'];
          }
        }

        $query_absen = "SELECT * FROM building WHERE building_id = $DTBuild";
        $result_absen = $connection->query($query_absen);
        if ($result_absen->num_rows > 0) {
          while ($row_absen = $result_absen->fetch_assoc()) {
            //  $Tilok1 = $row_absen['time_in'];
            //  $Tilok2 = $row_absen['time_out'];
            $latitudexy = $row_absen['latitude'];
            $longitudexy = $row_absen['longitude'];
          }
        }

        ?>


        var jaraks1 = <?php echo $latitudexy; ?>;
        var jaraks2 = <?php echo $longitudexy; ?>;

        var theta = 0;
        var dist = 0;
        var dist2 = 0;
        var dist3 = 0;
        var rad2deg1 = 0;
        var deg2rad1 = 0;
        var deg2rads1 = 0;
        var deg2rads3 = 0;

        theta = jarak2 - jaraks2;

        deg2rad1 = (jarak1 * Math.PI) / 180.0;
        deg2rads1 = (jaraks1 * Math.PI) / 180.0;
        deg2rads3 = (theta * Math.PI) / 180.0;




        dist = (Math.sin(deg2rad1) * Math.sin(deg2rads1)) + (Math.cos(deg2rad1) * Math.cos(deg2rads1) * Math.cos(deg2rads3));

        dist = Math.acos(dist);

        dist = dist * 180 / Math.PI;

        //dist3 = rad2deg1;

        miles = dist * 60 * 1.1515;

        distance = (miles * 1.609344) * 1000;

        konversi = Math.ceil(distance);

        //alert(konversi+ " Meter");

        if (konversi >= 1000) {
          $('#jarak').text("Jarak " + (konversi / 1000) + " KM");
        } else {
          $('#jarak').text("Jarak " + konversi + " Meter");
        }




        var infox = null;



        <?php

        $query_absen = "SELECT * FROM system";
        $result_absen = $connection->query($query_absen);
        if ($result_absen->num_rows > 0) {
          while ($row_absen = $result_absen->fetch_assoc()) {
            $chkWFH = $row_absen['WFH'];
          }
        }

        if ($chkWFH == 1) {
          if ($row_user['position_id'] == 1 || $row_user['position_id'] == 2) {
        ?>
            if (konversi <= 50000) {
              document.getElementById("infoxb").style.display = "none";
            } else {
              document.getElementById("infoxa").style.display = "none";
            }
            document.getElementById("ntfxy").innerHTML = " (WFH)";
          <?php
          } else {
          ?>
            if (konversi <= 100) {
              document.getElementById("infoxb").style.display = "none";
            } else {
              document.getElementById("infoxa").style.display = "none";
            }
          <?php
          }
        } else {
          ?>
          if (konversi <= 100) {
            document.getElementById("infoxb").style.display = "none";
          } else {
            document.getElementById("infoxa").style.display = "none";
          }
        <?php

        }


        ?>



      }
      setInterval(successCallback, 3000);

      // Define callback function for failed attempt
      function errorCallback(error) {
        if (error.code == 1) {
          swal({
            title: 'Oops!',
            text: 'Anda telah memutuskan untuk tidak membagikan posisi Anda, tetapi tidak apa-apa. Kami tidak akan meminta Anda lagi.',
            icon: 'error',
            timer: 3000,
          });
        } else if (error.code == 2) {
          swal({
            title: 'Oops!',
            text: 'Jaringan tidak aktif atau layanan penentuan posisi tidak dapat dijangkau.',
            icon: 'error',
            timer: 3000,
          });
        } else if (error.code == 3) {
          swal({
            title: 'Oops!',
            text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.',
            icon: 'error',
            timer: 3000,
          });
        } else {
          swal({
            title: 'Oops!',
            text: 'Waktu percobaan habis sebelum bisa mendapatkan data lokasi.',
            icon: 'error',
            timer: 3000,
          });
        }
      }

      var xter = 1;

      <?php
      $cmrs = $_GET['flip'];



      ?>







      // start webcame
      Webcam.set({
        width: 480,
        height: 360,
        image_format: 'jpeg',
        jpeg_quality: 80,
        flip_horiz: true
      });

      var cameras = new Array(); //create empty array to later insert available devices
      navigator.mediaDevices.enumerateDevices() // get the available devices found in the machine
        .then(function(devices) {
          devices.forEach(function(device) {
            var i = 0;
            if (device.kind === "videoinput") { //filter video devices only
              cameras[i] = device.deviceId; // save the camera id's in the camera array
              i++;
            }
          });
        })

      <?php
      if ($cmrs == "0" || $cmrs == 0) {
      ?>

        Webcam.set('constraints', {
          width: 320,
          height: 270,
          image_format: 'jpeg',
          jpeg_quality: 70,
          sourceId: cameras[0]
        });


      <?php
      } else {
      ?>

        Webcam.set('constraints', {
          width: 320,
          height: 270,
          image_format: 'jpeg',
          jpeg_quality: 70,
          sourceId: cameras[0],
          facingMode: "environment"
        });

      <?php
      }
      ?>



      Webcam.attach('.webcam-capture');
      // preload shutter audio clip
      var shutter = new Audio();
      //shutter.autoplay = true;
      shutter.src = navigator.userAgent.match(/Firefox/) ? './mod/assets/js/webcamjs/shutter.ogg' : './mod/assets/js/webcamjs/shutter.mp3';


      <?php

      if ($chkWFH == 1) {

        if ($row_user['position_id'] == 1 || $row_user['position_id'] == 2) {



      ?>

          function captureimage() {
            var latitude = $('.latitude').html();
            // play sound effect
            shutter.play();
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
              // display results in page
              Webcam.upload(data_uri, './sw-prosesx?action=present&latitude=' + latitude + '', function(code, text) {
                $data = '' + text + '';
                var results = $data.split("/");
                $results = results[0];
                $results2 = results[1];
                if ($results == 'success') {
                  swal({
                    title: 'Berhasil!',
                    text: $results2,
                    icon: 'success',
                    timer: 3500,
                  });
                  //setTimeout("location.href = './login&app=2.7';",3600);
                  setTimeout("location.href = './home';", 3600);
                } else {
                  swal({
                    title: 'Oops!',
                    text: text,
                    icon: 'error',
                    timer: 3500,
                  });
                }
              });
            });
          }
        <?php
        } else {
        ?>

          function captureimage() {
            var latitude = $('.latitude').html();
            // play sound effect
            shutter.play();
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
              // display results in page
              Webcam.upload(data_uri, './sw-proses?action=present&latitude=' + latitude + '', function(code, text) {
                $data = '' + text + '';
                var results = $data.split("/");
                $results = results[0];
                $results2 = results[1];
                if ($results == 'success') {
                  swal({
                    title: 'Berhasil!',
                    text: $results2,
                    icon: 'success',
                    timer: 3500,
                  });
                  //setTimeout("location.href = './login&app=2.7';",3600);
                  setTimeout("location.href = './home';", 3600);
                } else {
                  swal({
                    title: 'Oops!',
                    text: text,
                    icon: 'error',
                    timer: 3500,
                  });
                }
              });
            });
          }
        <?php
        }
      } else {
        ?>

        function captureimage() {
          var latitude = $('.latitude').html();
          // play sound effect
          shutter.play();
          // take snapshot and get image data
          Webcam.snap(function(data_uri) {
            // display results in page
            Webcam.upload(data_uri, './sw-proses?action=present&latitude=' + latitude + '', function(code, text) {
              $data = '' + text + '';
              var results = $data.split("/");
              $results = results[0];
              $results2 = results[1];
              if ($results == 'success') {
                swal({
                  title: 'Berhasil!',
                  text: $results2,
                  icon: 'success',
                  timer: 3500,
                });
                //setTimeout("location.href = './login&app=2.7';",3600);
                setTimeout("location.href = './home';", 3600);
              } else {
                swal({
                  title: 'Oops!',
                  text: text,
                  icon: 'error',
                  timer: 3500,
                });
              }
            });
          });
        }
      <?php
      }



      ?>



      //alert(document.getElementById("latitude").innerHTML);
    </script>
  <?php } ?>

  <?php
  if ($mod == 'present') {

    $query_absen = "SELECT * FROM system WHERE id = 1";
    $result_absen = $connection->query($query_absen);
    if ($result_absen->num_rows > 0) {
      while ($row_absen = $result_absen->fetch_assoc()) {
        $faceMatcher = $row_absen['face'];
      }
    }

    if ($faceMatcher == "OFF") {
    } else {

  ?>
      <script>
        //cari button photo
        document.getElementById("btnabsen").style.display = "none";
        var waitingDialog = waitingDialog || (function($) {
          var $dialog = $(
            '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
            '<div class="modal-dialog modal-m">' +
            '<div class="modal-content">' +
            '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
            '<div class="modal-body">' +
            '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
            '</div>' +
            '</div></div></div>');

          return {
            show: function(message, options) {
              if (typeof options === 'undefined') {
                options = {};
              }
              if (typeof message === 'undefined') {
                message = 'Loading';
              }
              var settings = $.extend({
                dialogSize: 'm',
                progressType: '',
                onHide: null
              }, options);
              $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
              $dialog.find('.progress-bar').attr('class', 'progress-bar');
              if (settings.progressType) {
                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
              }
              $dialog.find('h3').text(message);
              if (typeof settings.onHide === 'function') {
                $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function(e) {
                  settings.onHide.call($dialog);
                });
              }
              $dialog.modal();
            },
            hide: function() {
              $dialog.modal('hide');
            }
          };

        })(jQuery);
      </script>
      <script>
        //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
        var faceMatcher = undefined
        //----------------------------------------------------------------------------------------------

        waitingDialog.show('Initializing Data Face Recognition....', {
          dialogSize: 'sm',
          progressType: 'success'
        })
        $("#parent1").hide();
        $("#parent2").hide();
        Promise.all([
          faceapi.nets.faceRecognitionNet.loadFromUri('https://leuwimunding.my.id/models/'),
          faceapi.nets.faceLandmark68Net.loadFromUri('https://leuwimunding.my.id/models/'),
          faceapi.nets.ssdMobilenetv1.loadFromUri('https://leuwimunding.my.id/models/'),
          faceapi.nets.tinyFaceDetector.loadFromUri('https://leuwimunding.my.id/models/')
        ]).then(start)

        async function start() {
          $.ajax({
            datatype: 'json',
            url: "localhost/fetch", //url: "https://absensi.leuwimunding.my.id/fetch",
            data: "",
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          }).done(async function(data) {
            if (data.length > 2) {
              var json_str = "{\"parent\":" + data + "}"
              content = JSON.parse(json_str)
              for (var x = 0; x < Object.keys(content.parent).length; x++) {
                for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
                  var results = Object.values(content.parent[x]._descriptors[y])
                  content.parent[x]._descriptors[y] = new Float32Array(results)
                }
              }
              faceMatcher = await createFaceMatcher(content);
            }
            waitingDialog.hide()
            $('#parent1').show()
            $('#parent2').show()
            run();
          });
        }

        // Create Face Matcher
        async function createFaceMatcher(data) {
          const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
            const descriptors = [];
            for (var i = 0; i < className._descriptors.length; i++) {
              descriptors.push(className._descriptors[i]);
            }
            return new faceapi.LabeledFaceDescriptors(className._label, descriptors);
          }))
          return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
        }


        async function onPlay() {
          const videoEl = $('#vidDisplay').get(0)
          if (videoEl.paused || videoEl.ended)
            //return setTimeout(() => onPlay())

            $("#overlay").show()
          const canvas = $('#overlay').get(0)

          if ($("#register").hasClass('active')) {
            const options = getFaceDetectorOptions()
            const result = await faceapi.detectSingleFace(videoEl, options)
            if (result) {
              const dims = faceapi.matchDimensions(canvas, videoEl, true)
              dims.height = 960
              dims.width = 1200
              canvas.height = 960
              canvas.width = 1200
              const resizedResult = faceapi.resizeResults(result, dims)
              faceapi.draw.drawDetections(canvas, resizedResult)
            } else {
              $("#overlay").hide()
            }
          }

          // if($("#login").hasClass('active'))
          // {

          const options = getFaceDetectorOptions()
          const resultx = await faceapi.detectSingleFace(videoEl, options)
          if (resultx != "" || resultx != null) {

            //   if(faceMatcher != undefined){
            //   if(faceMatcher != undefined){
            //--------------------------FACE RECOGNIZE------------------
            const input = document.getElementById('vidDisplay')
            const canvas = $('#overlay').get(0)

            const displaySize = {
              width: 590,
              height: 460
            }
            // faceapi.matchDimensions(canvas, displaySize)
            const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
            const resizedDetections = faceapi.resizeResults(detections, displaySize)
            const results = await resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            results.forEach((result, i) => {
              const box = resizedDetections[i].detection.box
              const drawBox = new faceapi.draw.DrawBox(box, {
                label: result.toString()
              })
              // drawBox.draw(canvas)
              var str = result.toString()
              rating = parseFloat(str.substring(str.indexOf('(') + 1, str.indexOf(')')))
              str = str.substring(0, str.indexOf('('))
              // console.log(str);
              str = str.substring(0, str.length - 1)
              var ExPegawai = str.split(",");
              var NamaPegawai = ExPegawai[1] + " " + ExPegawai[0];
              //console.log(NamaPegawai);
              var jkrsx = document.getElementById('recogx').textContent;
              //console.log(jkrsx);
              //console.log(resultx);
              // document.getElementById("recogx").textContent = "Terdeteksi : " + NamaPegawai;
              // jkrsx ="";
              // NamaPegawai = "";
              // ExPegawai = "";
              if (str != "undefined unknown" || str != "") {
                if (rating < 1) {
                  document.getElementById("recogx").textContent = "Wajah Terdeteksi";
                  //match = true;
                  //   document.getElementById("recogx").textContent = "Terdeteksi : " + NamaPegawai;
                  document.getElementById("btnabsen").click();
                  return setTimeout();

                  // if(str == $("#log_name").text()){
                  //     console.log("Match TRUE!")
                  //     match = true;
                  //     $("#logname").html(str)
                  //     $("#prof_img").attr('src',"./data/" + str + "/image0.png")
                  // }
                } else {
                  // document.getElementById("recogx").textContent = "Wajah Pegawai Tidak Diketahui";
                  document.getElementById("recogx").textContent = "Wajah Terdeteksi";
                  document.getElementById("btnabsen").click();
                  return setTimeout();
                }
              } else {
                //match = false;
                document.getElementById("recogx").textContent = "Wajah Pegawai Tidak Diketahui";
              }
            })
            //---------------------------------------------------------------------  
          } else {
            document.getElementById("recogx").textContent = "Wajah Tidak Terdeteksi";
          }
          // }

          setTimeout(() => onPlay())
        }

        async function run() {
          const stream = await navigator.mediaDevices.getUserMedia({
            video: {}
          })
          const videoEl = $('#vidDisplay').get(0)
          videoEl.srcObject = stream
        }

        // tiny_face_detector options
        let inputSize = 160
        let scoreThreshold = 0.4

        function getFaceDetectorOptions() {
          return new faceapi.TinyFaceDetectorOptions({
            inputSize,
            scoreThreshold
          });
        }

        async function load_neural() {
          waitingDialog.show('Initializing neural data....', {
            dialogSize: 'sm',
            progressType: 'success'
          })
          $.ajax({
            datatype: 'json',
            url: "localhost/fetch", //url: "https://absensi.leuwimunding.my.id/fetch",
            data: "",
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          }).done(async function(data) {
            if (data.length > 2) {
              var json_str = "{\"parent\":" + data + "}"
              content = JSON.parse(json_str)
              console.log(content)
              for (var x = 0; x < Object.keys(content.parent).length; x++) {
                for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
                  var results = Object.values(content.parent[x]._descriptors[y]);
                  content.parent[x]._descriptors[y] = new Float32Array(results);
                }
              }
              faceMatcher = await createFaceMatcher(content);
            }
            waitingDialog.hide()
          });
        }
      </script>

      <script>
        $(document).ready(async function() {

          var counter = 5;
          const descriptions = [];

          // -------------Initialize---------------
          $("#login").css('background-color', 'yellow');
          $("#login").addClass('active');
          $("#register").css('background-color', 'white');
          $("#register").removeClass('active');

          if ($("#login").hasClass('active')) {
            $("#reg_disp").hide();
            $("#log_disp").show();
          } else if ($("#register").hasClass('active')) {
            $("#reg_disp").show();
            $("#log_disp").hide();
          }
          //---------------------------------------


          // $("#login").click(function(){
          $.ajax({
            datatype: 'json',
            url: "localhost/fetch", //url: "https://absensi.leuwimunding.my.id/fetch",
            data: "",
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          }).done(function(data) {
            labeled = JSON.parse(data)
          });
          $(this).css('background-color', 'yellow')
          $("#register").css('background-color', 'white')
          $(this).addClass('active')
          $("#register").removeClass('active')
          $("#reg_disp").hide()
          $("#log_disp").show()
          $("#prof_img").removeAttr('src')
          $("#fname").val('')
          $("#lname").val('')
          $("#logname").html('')
          $("#fname").prop("readonly", false)
          $("#lname").prop("readonly", false)
          counter = 5
          description = []
          $("#tries").html("Trials left : " + counter)
          // });

          $("#register").click(function() {
            $(this).css('background-color', 'yellow')
            $("#login").css('background-color', 'white')
            $(this).addClass('active')
            $("#login").removeClass('active')
            $("#reg_disp").show()
            $("#log_disp").hide()
            $("#prof_img").removeAttr('src')
            $("#fname").val('')
            $("#lname").val('')
            $("#logname").html('')
            $("#fname").prop("readonly", false)
            $("#lname").prop("readonly", false)
            counter = 5
            description = []
            $("#tries").html("Trials left : " + counter)
          });

          $("#tries").html("Trials left : " + counter)

          $("#capture").click(async function() {
            var data = $("#lname").val() + "," + $("#fname").val();
            const label = data;

            if ($("#fname").hasClass('active') && $("#lname").hasClass('active') && $("#fname").val() && $("#lname").val()) {
              if ($("#register").hasClass('active')) {
                $("#fname").prop("readonly", true)
                $("#lname").prop("readonly", true)
                if (counter <= 5 && counter >= 0) {
                  var canvas = document.createElement('canvas');
                  var context = canvas.getContext('2d');
                  var video = document.getElementById('vidDisplay');
                  context.drawImage(video, 0, 0, 600, 350);
                  var capURL = canvas.toDataURL('image/png');
                  var canvas2 = document.createElement('canvas');
                  canvas2.width = 1200;
                  canvas2.height = 960;
                  var ctx = canvas2.getContext('2d');
                  ctx.drawImage(video, 0, 0, 1200, 960);
                  var new_image_url = canvas2.toDataURL();
                  var img = document.createElement('img');
                  img.src = new_image_url;
                  document.getElementById("prof_img").src = img.src;

                  const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
                  if (detections != null) {
                    descriptions.push(detections.descriptor);
                    var descrip = descriptions;
                    counter--;
                    $("#tries").html("Trials left : " + counter)
                    if (counter == 0) {
                      // Save Image
                      $.ajax({
                        type: "POST",
                        url: "localhost/ajax", //url: "https://absensi.leuwimunding.my.id/ajax",
                        data: {
                          image: img.src,
                          path: data
                        }
                      }).done(function(o) {
                        console.log('Image Saved');
                      });


                      waitingDialog.show('Processing data.............', {
                        dialogSize: 'sm',
                        progressType: 'success'
                      })
                      var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
                      $.ajax({
                          url: 'localhost/ajax', //url: 'https://absensi.leuwimunding.my.id/ajax',
                          type: 'POST',
                          data: {
                            myData: JSON.stringify(postData)
                          },
                          datatype: 'json'
                        })
                        .done(async function(data) {
                          load_neural()
                          alert("Done!")
                          console.log("Success!")
                          waitingDialog.hide()
                          counter = 5
                          $("#tries").html("Trials left : " + counter)
                          $("#fname").val('')
                          $("#lname").val('')
                          $("#prof_img").removeAttr('src')
                          $("#fname").prop("readonly", false)
                          $("#lname").prop("readonly", false)
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                          alert("Error due to internet connection! Please try again!");
                        });
                      const descriptions = [];
                    }
                  } else {
                    alert("No FACE detected!");
                  }
                } else {
                  alert("Done Learning!");
                  counter = 5;
                  const descriptions = [];
                }
              }
            } else {
              if (!$("#fname").val() || !$("#fname").hasClass('active')) {
                $("#fname").css('border', '1px solid red');
                $("#fname").removeClass('active')
              }
              if (!$("#lname").val() || !$("#lname").hasClass('active')) {
                $("#lname").css('border', '1px solid red');
                $("#lname").removeClass('active')
              }
            }
          });

          var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

          $("#fname").keyup(function() {
            var str = $(this).val().toUpperCase();
            $(this).val(str);
            if (format.test(str) && str == "") {
              $(this).css('border', '1px solid red');
              $(this).removeClass('active')
            } else {
              $(this).css('border', '3px solid black');
              $(this).addClass('active')
            }
          });

          $("#lname").keyup(function() {
            var str = $(this).val().toUpperCase();
            $(this).val(str);
            if (format.test(str) || str == "") {
              $(this).css('border', '1px solid red');
              $(this).removeClass('active')
            } else {
              $(this).css('border', '3px solid black')
              $(this).addClass('active')
            }
          });
        });
      </script>
  <?php
    }
  }
  ?>


  <!-- </body></html> -->

  </body>

  </html><?php } ?>