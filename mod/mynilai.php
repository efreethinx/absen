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
    
    $query_absen="SELECT * FROM system";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $NPK = $row_absen['npk'];
             }
        }
    
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
    

$thnn = $_POST['tahun'] ;

if ($thnn == "" || $thnn == null){
    $thnn = $year;
}


    
    $checkhari = hari();
    // if ($checkhari =='Sabtu' || $checkhari =='Minggu'){
    //     $infoHRekan = 'Tidak Ada Presensi Hari Ini,<br> Dikarenakan Sekarang Adalah Hari <b><i><u>'.$checkhari.'</u></i></b> Yaitu Libur Akhir Pekan. <br> Selamat Berlibur <b><i><u>'.$namauser.'</u></i></b>';
    // }else{
     $infoHRekan = 'Info Penilaian Kinerja Anda Tahun '.$year;   
    // }
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
           <div class="section mt-2">
            <div class="section-title">Info Penilaian Kinerja Anda.</div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="6" style="text-align:center;">'.$infoHRekan.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Bulan</th>
              <th style="text-align:center;">Penilai Ke-1</th>
              <th style="text-align:center;">Penilai Ke-2</th>
              <th style="text-align:center;">Penilai Ke-3</th>
              <th style="text-align:center;">Keterangan</th>
            </tr>
            </thead>
            <tbody>';
            
            // $query="SELECT * FROM rekap_penilaian WHERE employees_id = $idtsx AND date LIKE '%-$thnn' ORDER BY id_reknilai ASC";
            
            $query="SELECT * FROM rekap_penilaian WHERE (user1 = '$idtsx' OR user2 = '$idtsx' OR user3 = '$idtsx') AND date LIKE '%-$year' ORDER BY id_reknilai ASC";
            $result = $connection->query($query);
             $NilaiX1 = 0;
             $NilaiX2 = 0;
             $NilaiX3 = 0;
             $no = 1;
             $CHKBln = 0;
             $CHLoop = 1;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               
               $idx[] = $row['employees_id'];
               array_push($idx);
               $userx = $row['user1'];
               $usery = $row['user2'];
               $userz = $row['user3'];
               
               
               if ($userx == $idtsx){
                   $txN[] = $row['nilai1'];
                   array_push($txN);
                   $TNilai1 = (explode("-",$row['nilai1']));
                     $dtNilai[] = $TNilai1[0] + $TNilai1[1] + $TNilai1[2] + $TNilai1[3] + $TNilai1[4];
                     array_push($dtNilai);
                     //echo '<script>alert('.$TNilai1[0].');</script>';
                     //print_r($dtNilai);
               }
               
               if ($usery == $idtsx){
                   $txN[] = $row['nilai2'];
                   array_push($txN);
                   $TNilai2 = (explode("-",$row['nilai2']));
                     $dtNilai[] = $TNilai2[0] + $TNilai2[1] + $TNilai2[2] + $TNilai2[3] + $TNilai2[4];
                     array_push($dtNilai);
               }
               
               if ($userz == $idtsx){
                   $txN[] = $row['nilai3'];
                   array_push($txN);
                   $TNilai3 = (explode("-",$row['nilai3']));
                     $dtNilai[] = $TNilai3[0] + $TNilai3[1] + $TNilai3[2] + $TNilai3[3] + $TNilai3[4];
                     array_push($dtNilai);
               }
               
               
               
               
               $blnNX = explode("-",$row['date']);
               
                   if ($CHLoop == 1){
                       
                       if ($dtNilai[0] <= 0){
                           $queryx="SELECT * FROM employees where id= $idx[0]";

$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
           while ($rowx= $resultx->fetch_assoc()) {
               $nmakosong1 = " (".$rowx['employees_name'].") ";
           }
            }
                           
                       }
                       
                       if ($dtNilai[0] >= 18){
                    $HPredikat1 = "Sangat Baik" ;
                    $Ntype1 = "badge-success";
               }else if ($dtNilai[0] >= 15){
                   $HPredikat1 = "Baik" ;
                   $Ntype1 = "badge-info";
               }else if ($dtNilai[0] >= 10 ){
                   $HPredikat1 = "Kurang" ;
                   $Ntype1 = "badge-warning";
               }else{
                    $dtNilai[0] = "Sangat Kurang" ;
                    $Ntype1 = "badge-danger";
               }
                       
                       $X1 = ( $dtNilai[0] /20)*100;
                       echo '<tr>';
               
               echo '<td class="text-center" style="background-color:MediumSeaGreen;color:black;font-weight: bold;">'.$no.'</td>';
               
                        echo '<td class="text-center" style="color:black;font-weight:bold;">'.ambilbulan($blnNX[0]).'</td>';
                       
                       echo '<td class="text-center" style="color:black;font-weight:bold;">'.$txN[0].'<br> <span class="badge '.$Ntype1.'">'.$dtNilai[0].'/20 ('.number_format($X1,0).'%)</span><br>'; if ($NPK == 'ON'){ echo $nmakosong1 ;} echo '</td>';
                   }else if($CHLoop == 2){
                       
                       if ($dtNilai[1] <= 0){
                           $queryx="SELECT * FROM employees where id= $idx[1]";

$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
           while ($rowx= $resultx->fetch_assoc()) {
               $nmakosong2 = " (".$rowx['employees_name'].") ";
           }
            }
                           
                       }
                       
                       if ($dtNilai[1] >= 18){
                    $HPredikat2 = "Sangat Baik" ;
                    $Ntype2 = "badge-success";
               }else if ($dtNilai[1] >= 15){
                   $HPredikat2 = "Baik" ;
                   $Ntype2 = "badge-info";
               }else if ($dtNilai[1] >= 10 ){
                   $HPredikat2 = "Kurang" ;
                   $Ntype2 = "badge-warning";
               }else{
                    $HPredikat2 = "Sangat Kurang" ;
                    $Ntype2 = "badge-danger";
               }
                       
                       $X2 = ( $dtNilai[1] /20)*100;
                       echo '<td class="text-center" style="color:black;font-weight:bold;">'.$txN[1].'<br> <span class="badge '.$Ntype2.'">'.$dtNilai[1].'/20 ('.number_format($X2,0).'%)</span><br>'; if ($NPK == 'ON'){ echo $nmakosong2 ;} echo '</td>';
                   }else if($CHLoop == 3){
                       
                       if ($dtNilai[2] <= 0){
                           $queryx="SELECT * FROM employees where id= $idx[2]";

$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
           while ($rowx= $resultx->fetch_assoc()) {
               $nmakosong3 = " (".$rowx['employees_name'].") ";
           }
            }
                           
                       }
                       
                       if ($dtNilai[2] >= 18){
                    $HPredikat3 = "Sangat Baik" ;
                    $Ntype3 = "badge-success";
               }else if ($dtNilai[2] >= 15){
                   $HPredikat3 = "Baik" ;
                   $Ntype3 = "badge-info";
               }else if ($dtNilai[2] >= 10 ){
                   $HPredikat3 = "Kurang" ;
                   $Ntype3 = "badge-warning";
               }else{
                    $HPredikat3 = "Sangat Kurang" ;
                    $Ntype3 = "badge-danger";
               }
               
               
                       
                       $X3 = ( $dtNilai[2] /20)*100;
                       echo '<td class="text-center" style="color:black;font-weight:bold;">'.$txN[2].'<br> <span class="badge '.$Ntype3.'">'.$dtNilai[2].'/20 ('.number_format($X3,0).'%)</span><br>'; if ($NPK == 'ON'){ echo $nmakosong3 ;} echo '</td>';
                      
                      
                      if ($dtNilai[1] <= 10 || $dtNilai[1] <= 10 || $dtNilai[2] <= 10){
                   echo '<td class="text-center"><span class="badge badge-danger"><ion-icon name="alert-circle-outline"></ion-icon> Kinerja Kurang Baik</span></td>';
               }else if($dtNilai[1] < 15 || $dtNilai[1] < 15 || $dtNilai[2] < 15){
                    echo '<td class="text-center"><span class="badge badge-warning"><ion-icon name="alert-circle-outline"></ion-icon> Kinerja Kurang Baik</span></td>';
               }else if($dtNilai[1] < 18 || $dtNilai[1] < 18 || $dtNilai[2] < 18){
                   echo '<td class="text-center"><span class="badge badge-info"><ion-icon name="checkmark-circle-outline"></ion-icon> Kinerja Baik</span></td>';
               }else{
                   echo '<td class="text-center"><span class="badge badge-success"><ion-icon name="checkmark-circle-outline"></ion-icon> Kinerja Sangat Baik</span></td>';
               }
                      
                      
                       echo '</tr>';
               $no++;
               $CHLoop = 0;
               unset($idx);
               unset($nilaix);
               unset($TNilai);
               unset($dtNilai);
               unset($txN);
                   }
               
               $CHLoop++;
               
           }
            }
            
            echo '</tbody>
            </table>
                    
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    ';
            
           
                    
                    echo '
               </div>
                </div>
            </div>
            
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Berikut Adalah Informasi Penilaian Rekan Kerja Terhadap Kinerja Anda Setiap Bulan.<br><br>
                
                <i><b>Keterangan Nilai</b></i> <br>
                Nilai Ke-1 : Tingkat Kerajinan <br>
                Nilai Ke-2 : Tingkat Tanggung Jawab <br>
                Nilai Ke-3 : Tingkat Kompeten <br>
                Nilai Ke-4 : Tingkat Team Work <br>
                Nilai Ke-5 : Tingkat Kecakapan Managerial <br>
                
                <br>
                <i>NB : Jika Tidak Melakukan Penilaian Kepada Pegawai Lain Maka Nama Anda Akan Tampil Di Pegawai Dinilai.</i>
                <br>
                <br>
                
                <center><strong><a href="#">Klik Disini Untuk SKP Tahun '.$year.' (Cooming SooN)</a></strong></center>
                
            </div>
            <br>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>