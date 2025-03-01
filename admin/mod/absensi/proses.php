<?php
session_start();
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
  header('location:../../login/');
  exit;
} else {
  require_once '../../../library/sw-config.php';
  require_once '../../login/login_session.php';
  include('../../../library/sw-function.php');

  switch (@$_GET['action']) {
      /* -------  LOAD DATA ABSENSI----------*/
    case 'absensi':
      $error = array();

      if (empty($_GET['id'])) {
        $error[] = 'ID tidak boleh kosong';
      } else {
        $id = mysqli_real_escape_string($connection, $_GET['id']);
      }

      if (isset($_POST['month']) or isset($_POST['year'])) {
        $bulan   = date($_POST['month']);
        $tahun   = date($_POST['year']);
      } else {
        $bulan  = date("m");
        $tahun  = date("Y");
      }

      $hari       = date("d");
      //$bulan      = date ("m");
      //$tahun      = date("Y");
      
      $jumlahhari = date("t", mktime(0, 0, 0, $bulan, $hari, $tahun));
      $s          = date("w", mktime(0, 0, 0, $bulan, 1, $tahun));
      if (empty($error)) {
        echo '
<div class="table-responsive">
<table class="table table-bordered table-hover" id="swdatatable">
        <thead>
            <tr>
                <th class="align-middle" width="20">No</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle text-center"><i class="fa fa-picture-o" aria-hidden="true"></i></th>
                <th class="align-middle text-center">Jam Masuk</th>
                <th class="align-middle text-center"><i class="fa fa-picture-o" aria-hidden="true"></i></th>
                <th class="align-middle text-center">Jam Pulang</th>
                <th class="align-middle text-center">Lokasi</th>
                <th class="align-middle">Status</th>
                <th class="align-middle text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>';
        for ($d = 1; $d <= $jumlahhari; $d++) {
          $warna      = '';
          $background = '';
          $status_hadir     = 'Tidak Hadir';
          if ((date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday")||date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Saturday") {
            $warna = '#ffffff';
            $background = '#005CAA';
            $status_hadir = 'Libur Akhir Pekan';
          }
          $date_month_year = '' . $tahun . '-' . $bulan . '-' . $d . '';

          if (isset($_POST['month']) or isset($_POST['year'])) {
            $month = $_POST['month'];
            $year  = $_POST['year'];
            $filter = "employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
          } else {
            $filter = "employees_id='$id' AND  presence_date='$date_month_year' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
          }

          $query = "SELECT employees.id,shift.shift_id,shift.time_in,shift.time_out FROM employees,shift WHERE employees.shift_id=shift.shift_id AND employees.id='$id'";
          $result = $connection->query($query);
          $row    = $result->fetch_assoc();


          $query_shift = "SELECT time_in,time_out FROM shift WHERE shift_id='$row[shift_id]'";
          $result_shift = $connection->query($query_shift);
          $row_shift = $result_shift->fetch_assoc();
          $shift_time_in = $row_shift['time_in'];
          $newtimestamp = strtotime('' . $shift_time_in . ' + 05 minute');
          $newtimestamp = date('H:i:s', $newtimestamp);

          $query_absen = "SELECT presence_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE $filter ORDER BY presence_id DESC";
          $result_absen = $connection->query($query_absen);
          $row_absen = $result_absen->fetch_assoc();

          $querya = "SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
          $resulta = $connection->query($querya);
          $rowa =  $resulta->fetch_assoc();
          // Status Kehadiran
          if ($row_absen['time_in'] == NULL) {
            if ((date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday")||date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Saturday") {
              $status_hadir = 'Libur Akhir Pekan';
            } else {
              $status_hadir = '<span class="label label-danger">Tidak Hadir</span>';
              $tottdkhadir += 1;
            }
            $time_in = $row_absen['time_in'];
          } else {
            $status_hadir = '<label class="label label-warning">' . $rowa['present_name'] . '</label>';
            $time_in = $row_absen['time_in'];
          }

          // Data Selisih Telat
          $selisihwaktu = $row_absen['selisih'];
          

          // Status Absensi Jam Masuk
          if ($row_absen['status'] == 'Telat') {
            $status_time_in = '<label class="label label-danger">' . $row_absen['status'] . '</label>';
          list($hh,$mm,$ss)= explode(':',$selisihwaktu);
          $perhitungantelat = ($hh * 60)+($mm);
          $perhitungantelat2 = ($hh)+($mm / 60);
          $totalTelat += $perhitungantelat;
          $totalTelat2 += $perhitungantelat2;
            
          } elseif ($row_absen['status'] == 'Tepat Waktu') {
            $status_time_in = '<label class="label label-info">' . $row_absen['status'] . '</label>';
          } else {
            $status_time_in = '<label class="label label-danger">' . $row_absen['status'] . '</label>';
          }

          list($latitude,  $longitude) = explode(',', $row_absen['presence_address']);


          echo '' . $geo_location . '
         <tr style="background:' . $background . ';color:' . $warna . '">
            <td class="text-center">' . $d . '</td>
            <td>' . format_hari_tanggal($date_month_year) . '</td>';
          if ((date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday")||date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Saturday") {
            if ($row_absen['time_in'] == '') {
              echo '
                <td class="text-center">Libur Akhir Pekan</td>
                <td class="text-center">Libur Akhir Pekan</td>';
            } else {
              echo '
                <td class="text-center picture">';
              if ($row_absen['picture_in'] == NULL) {
                echo '<img src="../timthumb?src=' . $site_url . '/content/avatar.jpg&h=40&w=40">';
              } else {
                echo '
                      <a class="image-link" href="' . $site_url . '/content/present/' . $row_absen['picture_in'] . '" target="_blank">
                        <img src="../timthumb?src=' . $site_url . '/content/present/' . $row_absen['picture_in'] . '&h=40&w=40"></a>';
              }
              echo '</td>
                    <td>' . $row_absen['time_in'] . '</td>';
            }
          } else {
            echo '
            <td class="text-center picture">';
            if ($row_absen['picture_in'] == NULL) {
              echo '<img src="../timthumb?src=' . $site_url . '/content/avatar.jpg&h=40&w=40">';
            } else {
              echo '
                  <a class="image-link" href="' . $site_url . '/content/present/' . $row_absen['picture_in'] . '" target="_blank">
                    <img src="../timthumb?src=' . $site_url . '/content/present/' . $row_absen['picture_in'] . '&h=40&w=40"></a>';
            }
            echo '</td>
            <td>' . $row_absen['time_in'] . '</td>';
          }

          if ((date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday")||date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Saturday") {
            if ($row_absen['time_out'] == '') {
              echo '
                <td class="text-center">Libur Akhir Pekan</td>
                <td class="text-center">Libur Akhir Pekan</td>';
            } else {
              echo '
                <td class="text-center picture">';
              if ($row_absen['picture_out'] == NULL) {
                echo '<img src="../timthumb?src=' . $site_url . '/content/avatar.jpg&h=40&w=40">';
              } else {
                echo '
                      <a class="image-link" href="' . $site_url . '/content/present/' . $row_absen['picture_in'] . '" target="_blank">
                        <img src="../timthumb?src=' . $site_url . '/content/present/' . $row_absen['picture_out'] . '&h=40&w=40"></a>';
              }
              echo '</td>
                    <td>' . $row_absen['time_out'] . '</td>';
            }
          } else {
            echo '
            <td class="text-center picture">';
            if ($row_absen['picture_out'] == NULL) {
              echo '<img src="../timthumb?src=' . $site_url . '/content/avatar.jpg&h=40&w=40">';
            } else {
              echo '
                  <a class="image-link" href="' . $site_url . '/content/present/' . $row_absen['picture_out'] . '" target="_blank">
                    <img src="../timthumb?src=' . $site_url . '/content/present/' . $row_absen['picture_out'] . '&h=40&w=40"></a>';
            }
            echo '</td>
            <td>' . $row_absen['time_out'] . '</td>';
          }
          
          $query_absen="SELECT * FROM employees WHERE id = $id";
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
             }
        }
          //jarak
          
            $jarak1 = $latitude;
            $jarak2 = $longitude;
            $kordinatsekolah = $latitudexy . ", " . $longitudexy;
            $jaraksekolah = explode(',', $kordinatsekolah);
            $jaraks1 = $jaraksekolah[0];
            $jaraks2 = $jaraksekolah[1];
            
            $theta = $jarak2 - $jaraks2;
            $dist = sin(deg2rad($jarak1)) * sin(deg2rad($jaraks1)) + cos(deg2rad($jarak1)) * cos(deg2rad($jaraks1)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            $distance = ($miles * 1.609344) . " km";

            $konversi = number_format($distance, 2, ',', '');
            $meter = str_replace(",", ".", $konversi) * 1000;
          
            if ($jarak1=='' || $jarak1 ==null)
            {
               $meter = "0";
            }else
            {
               $meter = str_replace(",", ".", $konversi) * 1000; 
            }
            
            if ((date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Sunday")||date("l", mktime(0, 0, 0, $bulan, $d, $tahun)) == "Saturday")
            {
                echo '
            <td><p class="btn-modal">Libur Akhir Pekan</p></td>
            <td>' . $status_hadir . ' ' . $status_time_in . '<br>' . $row_absen['information'] . '</td>
            <td class="text-center"><i class="fa fa-calendar-times-o "></i></td>
          </tr>';
                
            }else
            {
                 echo '
            <td><p class="btn-modal" data-latitude="' . $latitude . '" data-longitude="' . $longitude . '">Lat: ' . $latitude . '<br>Long: ' . $longitude . '</p>Jarak : '.$meter.' Meter</td>
            <td>' . $status_hadir . ' ' . $status_time_in . '<br>' . $row_absen['information'] . '</td>
            <td class="text-right"><button type="button" class="btn btn-warning btn-xs btn-modal enable-tooltip" title="Lokasi" data-latitude="' . $latitude . '" data-longitude="' . $longitude . '" data-idx="' . $id . '"><i class="fa fa-map-marker"></i> Lokasi</button></td>
          </tr>';
            }
          
         
        }
        echo '
        </tbody>
      </table>
  </div>';
        if (isset($_POST['month']) or isset($_POST['year'])) {
          $month = $_POST['month'];
          $year  = $_POST['year'];
          $filter = "employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
        } else {
          $filter = "employees_id='$id' AND MONTH(presence_date) ='$month' and employees_id='$id'";
        }

        $query_hadir = "SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
        $hadir = $connection->query($query_hadir);

        $query_sakit = "SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
        $sakit = $connection->query($query_sakit);

        $query_izin = "SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
        $izin = $connection->query($query_izin);


        $query_telat = "SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
        $telat = $connection->query($query_telat);

        echo '<hr>
      <div class="row">
        <div class="col-md-3">
          <p>Hadir : <span class="label label-success">' . $hadir->num_rows . '</span></p>
        </div>

        <div class="col-md-3">
          <p>Telat : <span class="label label-danger">' . $telat->num_rows . '</span></p>
        </div>

        <div class="col-md-3">
          <p>Sakit : <span class="label label-warning">' . $sakit->num_rows . '</span></p>
        </div>

        <div class="col-md-3">
          <p>Izin : <span class="label label-info">' . $izin->num_rows . '</span></p>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-4">
            <p>Total Telat : <span class="label label-warning">Dalam Menit : '.$totalTelat.' Menit | Dalam Jam : '.number_format($totalTelat2,2).' Jam</span></p>
        </div>';
        $hitpinalti = $totalTelat2 / 8;
        $bulatpinalti = number_format($hitpinalti,0);
        echo '<div class="col-md-4">
            <p>Total Pinalti Telat : <span class="label label-info">'.number_format($hitpinalti,0).' Hari</span></p>
        </div>
        <div class="col-md-4">
            <p>Total Ketidak Hadiran + Pinalti : <span class="label label-danger">'.($bulatpinalti + $tottdkhadir).' Hari</span></p>
        </div>
      </div>';
        echo '
<script>
  $("#swdatatable").dataTable({
      "iDisplayLength":35,
      "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]]
  });
 $(".image-link").magnificPopup({type:"image"});
</script>'; ?>
        <script type="text/javascript">
          $(function() {
            $('[data-toggle="tooltip"]').tooltip()
          })
        </script>
<?php
      } else {
        echo 'Data tidak ditemukan';
      }

      break;
  }
}
