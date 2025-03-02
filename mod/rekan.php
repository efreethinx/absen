<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
if(!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])){
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        session_destroy();
        header("location:./");
}else{
    
    $query_absen="SELECT * FROM shift WHERE shift_name = 'FULL TIME'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $shift_time_in = $row_absen['time_in'];
             }
        }
    
    $checkhari = hari();
   
    
    //$filter ="MONTH(presence_date) ='$month'";
    $namauser = $row_user['employees_name'];
    $idtsx = $row_user['id'];
    $infoxts= null;
    $stats = null;
    $dtx = null;
    
$hri = $_POST['hari'] ;
$bln = $_POST['bulan'] ;
$thnn = $_POST['tahun'] ;

  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);

$tgglx = $thnn . '-' . $bln . '-' . $hri ;
// echo 'Nih :'.$hri;

if ($tgglx == '' || $tgglx == null || $tgglx == '--')
{
   $tgglx =  $date;
}
    
$blnx = null;
            
$rbtgl = explode("-", $tgglx);

$nxtgl = $rbtgl[2];    
    
                $monthx = null;
                if ($month == 1){
                    $monthx = 'Januari';
                }else if ($month == 2){
                    $monthx = 'Februari';
                }else if ($month == 3){
                    $monthx = 'Maret';
                }else if ($month == 4){
                    $monthx = 'April';
                }else if ($month == 5){
                    $monthx = 'Mei';
                }else if ($month == 6){
                    $monthx = 'Juni';
                }else if ($month == 7){
                    $monthx = 'Juli';
                }else if ($month == 8){
                    $monthx = 'Agustus';
                }else if ($month == 9){
                    $monthx = 'September';
                }else if ($month == 10){
                    $monthx = 'Oktober';
                }else if ($month == 11){
                    $monthx = 'November';
                }else if ($month == 12){
                    $monthx = 'Desember';
                }else
                {
                    $monthx == '-';
                }
    
    $checkhari = hari();
    if ($checkhari =='Sabtu' || $checkhari =='Minggu'){
        $infoHRekan = 'Tidak Ada Presensi Hari Ini,<br> Dikarenakan Sekarang Adalah Hari <b><i><u>'.$checkhari.'</u></i></b> Yaitu Libur Akhir Pekan. <br> Selamat Berlibur <b><i><u>'.$namauser.'</u></i></b>';
    }else{
     $infoHRekan = 'Info Rekan Kerja Yang Sudah Presensi Hari Ini <br>'.format_hari_tanggal($date);   
    }
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
           <div class="section mt-2">
            <div class="section-title">Info Presensi Rekan Kerja</div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="8" style="text-align:center;">'.$infoHRekan.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Presensi Masuk</th>
              <th style="text-align:center;">Presensi Pulang</th>
              <th style="text-align:center;">Lama Telat</th>
              <th style="text-align:center;">Keterangan</th>
              <th style="text-align:center;">Info</th>
            </tr>
            </thead>
            <tbody>';
            
            $query="SELECT employees.*,position.position_name,presence.employees_id,presence.time_in,presence.time_out,presence.picture_in,presence.present_id,presence.presence_address,presence.information,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'$shift_time_in') AS selisih,if (presence.time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.position_id=position.position_id AND presence.employees_id=employees.id AND 
presence.presence_date='$tgglx' ORDER BY presence.presence_id ASC";
            $result = $connection->query($query);
             $xstatus= null;
                $dnl = 0;
                $cizin=0;
                $spulang=0;
                $ppulang=0;
                $hdr=0;
                $tlt=0;
                $no=0;
                $INITall = 0;
                $initML = 0;
                $initLT = 0;
                $initLG = 0;
                $XinitLT = 0;
                $XinitLG = 0;
                $infoInit = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               
               $idbld = $row['building_id'];
                
                //jarak
                $queryJ = "SELECT * FROM building where building_id = $idbld";
                 $resultJ = $connection->query($queryJ);
                  if($resultJ->num_rows > 0){
                      
                      while ($rowJ= $resultJ->fetch_assoc()) {
                      $JarakJJ1 =  $rowJ['latitude'];
                      $JarakJJ2 =  $rowJ['longitude'];
                      $MaxRadius  = $rowJ['radius'];
                      }
                  }
                  
                  //hitung jarak
                  
    //               var meter = 0;
    //   var miles = 0;
    //   var distance = 0;
    //   var koversi = 0;
    //   var jarak1 = position.coords.latitude;
    //   var jarak2 = position.coords.longitude;
                
              $MyJarak = (explode(",",$row['presence_address']));
              $MyJarakLT = $MyJarak[0];
              $MyJarakLG = $MyJarak[1];
                
                $meterJ = 0;
                $distanceJ = 0;
                $konversiJ = 0;
                $JarakJ1 = $MyJarakLT;
                $JarakJ2 = $MyJarakLG;
                
                $theta = $JarakJJ2 - $JarakJ2;
                $miles = (sin(deg2rad($JarakJJ1)) * sin(deg2rad($JarakJ1))) + (cos(deg2rad($JarakJJ1)) * cos(deg2rad($JarakJ1)) * cos(deg2rad($theta)));
                $miles = acos($miles);
                $miles = rad2deg($miles);
                $miles = $miles * 60 * 1.1515;
                $feet  = $miles * 5280;
                $yards = $feet / 3;
                $kilometers = $miles * 1.609344;
                $meters = $kilometers * 1000;
                $meters = number_format($meters, 2, '.', '');
                $kilometers = number_format($kilometers, 2, '.', '');
               
               
               $no++;
               $statTelat = 'black';
               $perhitungantelat = "Tepat Waktu";
              $idxs = $row['id'];
              $selisihwaktu = $row['selisih'];
            //   $dnlinfo = '';
              //$INITall = $row['presence_address'];
              $INITall = (explode(",",$row['presence_address']));
              $initLT = $INITall[0];
              $initLG = $INITall[1];
              $XinitLT = strlen($initLT);
              $XinitLG = strlen($initLG);
              if ($XinitLG > 12 || $XinitLT > 12)
              {
                  $initML = 1;
                  $infoInit = "Manipulasi Absen";
                  
              }else
              {
                  $initML = 0;
                  $infoInit = "";
              }
             //$keterangan = $row['keterangan'];
             echo "<tr>";
             
              if ($row['status'] == 'Telat' && $row['present_id'] == 1 && $row['information'] != 'DNL') {
                  $tlt++;
                  $xstatus= null;
                  
                  if ($initML == 1){
                   echo '<td class="text-center" style="background-color:Black;color:white;">'.$no.'</td>';
                  
              }else
              {
                  echo '<td class="text-center" style="background-color:Tomato;color:black;font-weight: bold;">'.$no.'</td>';
                  
                  list($hh,$mm,$ss)= explode(':',$selisihwaktu);
                  $perhitungantelat = (($hh * 60)+($mm)) . " Menit";
                  $statTelat = 'Red';
              }
                  
           
          }elseif ($row['status'] == 'Tepat Waktu' && $row['present_id'] == 1 && $row['information'] != 'DNL') {
              $hdr++;
              $xstatus= null;
              
              if ($initML == 1){
                   echo '<td class="text-center" style="background-color:Black;color:white;">'.$no.'</td>';
                  
              }else
              {
                  echo '<td class="text-center" style="background-color:MediumSeaGreen;color:black;font-weight: bold;">'.$no.'</td>'; 
              }
              
            
          }elseif($row['present_id'] == 1 && $row['information'] == 'DNL')
          {
              $dnl++;
              
              $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '$idxs' and tanggal = '$date'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $keteranganx = $row_absen['keterangan'];
                 $akses = $row_absen['akses'];
             }
             if ($akses == '1')
             {
                 echo '<td class="text-center" style="background-color:DodgerBlue;color:black;">'.$no.'</td>'; 
              $xstatus= " <font style='font-weight: bold;'>(Dinas Luar : $keteranganx )</font>";
             }
             
        }
              
              
          }else {
              $cizin++;
              if ($row['present_id'] == 2)
              {
                  $xstatus= " <font style='font-weight: bold;'>(Sakit)</font>";
              }else if ($row['present_id'] == 3)
              {
                  $xstatus= " <font style='font-weight: bold;'>(Izin)</font>";
              }
              
             echo '<td class="text-center" style="background-color:Orange;">'.$no.'</td>';
          }
          
          if ($initML == 1){
                    echo '<td style="color:red;font-weight:bold;">'.$row['employees_name'].' (Terdeteksi Manipulasi Presensi)</td>';
                    
                }else
                {
                    echo '<td style="color:black;font-weight:bold;">'.$row['employees_name'].''.$xstatus.'</td>';
                }
                
                echo'
                
                <td class="text-center picture"><a class="image-link" href="./content/present/'.$row['picture_in'].'" target="_blank">'.$row['time_in'].'</td>';
                if ($row['time_out'] == "00:00:00" && $row['present_id'] == 1)
                {
                    $ppulang++;
                    //echo '<td>'.$row['time_out'].'</td>';
                    echo '<td class="text-center">-</td>';
                }else if ($row['time_out'] == "00:00:00" && $row['present_id'] != 1)
                {
                    // echo '<td>'.$row['time_out'].'</td>';
                    echo '<td class="text-center">'.$row['time_out'].'</td>';
                }else
                {
                    $spulang++;
                 echo'<td class="text-center picture"><a class="image-link" href="./content/present/'.$row['picture_out'].'" target="_blank">'.$row['time_out'].'</td>';
                }
                
                echo '<td class="text-center" style="color:'.$statTelat.';font-weight: bold;">'.$perhitungantelat.'</td>';
                
                if ($row['information'] == "WFH"){
                    echo '<td class="text-center" style="color:blue;font-weight: bold;">WORK FROM HOME ('.$row['information'].')</td>';
                }else if($row['information'] == "" || $row['information'] == null){
                    
                    if ($meters >= 1000){
                    echo '<td class="text-center" style="color:black;font-weight: bold;"> WORK FROM OFFICE (Jarak : '.$kilometers.' KM | Dari :  '.$MaxRadius.' Meter Max Radius ) </td>';
                }else
                {
                 echo '<td class="text-center" style="color:black;font-weight: bold;"> WORK FROM OFFICE (Jarak : '.$meters.' Meter | Dari :  '.$MaxRadius.' Meter Max Radius ) </td>';   
                }
                     
                }else{
                    echo '<td class="text-center" style="color:black;font-weight: bold;">'.$row['information'].'</td>';
                }
                
                echo '<td class="text-center" style="color:'.$statTelat.';font-weight: bold;">
                <form action="info" method="POST">
                
                <input type="hidden" name="idPegawai" value="'.$row['id'].'">
                
                <button type="submit" class="btn btn-primary mt-1 btn-sortir"><ion-icon name="person-outline"></ion-icon>Lihat</button>
                
                </form>
                </td>';
                
                
                
                
             
             echo "</tr>";
                  
             
           }
            }
            
            echo '</tbody>
            </table>
                    
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
                    <thead>
            <tr>
                <th colspan="8" style="text-align:center;">Rekan Kerja Belum Presensi Hari Ini <br>'.format_hari_tanggal($date).'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Shift</th>
              <th style="text-align:center;">Lokasi</th>
              <th style="text-align:center;">Info</th>
            </tr>
            </thead>
            <tbody>';
            
            $query="SELECT employees.*, position.position_name, shift.shift_name, building.name FROM employees,position,shift,building WHERE
employees.position_id=position.position_id AND employees.shift_id = shift.shift_id AND employees.building_id = building.building_id ORDER BY employees.employees_name ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               
               $idchk = $row['id'];
               $namachk = $row['employees_name'];
               $jabatanchk = $row['position_name'];
               $shiftchk = $row['shift_name'];
               $lokasitchk = $row['name'];
               
               
               $queryx1="SELECT * FROM presence where employees_id = $idchk and presence_date = '$tgglx'";
               
               $resultx1 = $connection->query($queryx1);
               if($resultx1->num_rows > 0){
                //   echo '<tr>';
                //   echo '<td>'.$nox.'</td>';
                //   echo '<td>'.$namachk.'</td>';
                //   echo '<td>'.$jabatanchk.'</td>';
                //   echo '<td>'.$shiftchk.'</td>';
                //   echo '<td>'.$lokasitchk.'</td>';
                //   echo '</tr>';
               }else
               {$nox++;
                  echo '<tr>';
                  echo '<td class="text-center" style="background-color:#283747;color:#F8F9F9;font-weight: bold;">'.$nox.'</td>';
                  echo '<td style="color:red;font-weight:bold;">'.$namachk.'</td>';
                  echo '<td style="text-align:center;">'.$jabatanchk.'</td>';
                  echo '<td style="text-align:center;">'.$shiftchk.'</td>';
                  echo '<td style="text-align:center;">'.$lokasitchk.'</td>';
                  echo '<td class="text-center" style="color:'.$statTelat.';font-weight: bold;">
                <form action="info" method="POST">
                
                <input type="hidden" name="idPegawai" value="'.$idchk.'">
                
                <button type="submit" class="btn btn-primary mt-1 btn-sortir"><ion-icon name="person-outline"></ion-icon>Lihat</button>
                
                </form>
                </td>';
                  echo '</tr>';
                   
               }
               
           }
           
            }
                    
                    echo '</tbody></table>
               </div>
                </div>
            </div>
            
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Berikut Adalah Informasi Presensi Rekan Kerja, Harap Untuk Saling Mengingatkan Dalam Presensi Dan Prestasi Kerja.</a>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>