<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
    if(!isset($_COOKIE['COOKIES_MEMBER'])){
        header('location:index');
    }
    else {
        
        $dtFinfo = $year . "-" . $month . "-";
  $query_info="SELECT * FROM pengumuman WHERE pinned=1 AND tanggal LIKE '%$dtFinfo%'";
      $infoNew = $connection->query($query_info);

$InfoNewx = $infoNew->num_rows;

if ($InfoNewx > 0){
    $file_name = "pristine-6091.mp3";
echo '<audio autoplay="true" style="display:none;">
       <source src="'.$file_name.'">
      </audio>';
}
        // $VersiAPP = $_GET['app'];
        
        // if ($VersiAPP == '2.7')
        // {
           
        // }else
        // {
        //   echo '<script>alert("Applikasi Presensi Skensala Anda Adalah Versi Lama, Silahkan Update Ke Versi Terbaru Yaitu Versi 2.7")
        //   window.location.href = "https://link.skensala.my.id/PRESENSI";
        //   </script>'; 
           
           
        // }
        
        $custanggal = DATE('d') . "-" . DATE('m');
        $MeLahir = explode("-", $row_user['tglhr']);
        $custanggalX = $MeLahir[0] . "-" . $MeLahir[1];
        $chksMlogin = $row_user['mlogin'];
        
        $iduserx = $row_user['id'];
        
        $notifikasiSA = null;
        $dataabsenmasuk = null;
        $dataabsenpulang = null;
        $query_absen="SELECT * FROM system where id=1";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $notifikasiSA = $row_absen['notif'];
                                            }
                                        }
        
        
        //check jika profil kosong
        $Nohpx = $row_user['nohp'];
        $Alamatx = $row_user['alamat'];
        $Tglhrx = $row_user['tglhr'];
        $Bidangx = $row_user['bidang'];
        
        if ($Nohpx == "" || $Alamatx == "-" || $Alamatx == "" || $Tglhrx == "" || $Bidangx == "-" || $Bidangx == ""){
            
             echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Anda Belum Melengkapi Informasi Profile Pribadi Anda, Harap Segera Melengkapi Data!!!', icon: 'warning', timer: 10000,});
        </script>
        ";
        
         echo "<script>
                                                    setTimeout(function(){ 
                                                
                                                      window.location.href = './profile';
                                                
                                                }, 4000);
                                                </script>";
            
        }
        
        
        // if ($deviceType == "computer"){
        //                     echo "
        // <script>
        //     swal({title: 'Peringatan Sistem', text:'Anda Terdeteksi Login Menggunakan Device Computer, Anda Akan Automatis Logout Dan Data Akan Dihapus!', icon: 'warning', timer: 10000,});
            
        //     setTimeout(function(){ 
                                                
        //                                               window.location.href = './logout';
                                                
        //                                         }, 4000);
            
        // </script>
        // ";
        //                 }
        
        
        // if ($chksMlogin == 0 || $chksMlogin == '0'){
        //                     echo "
        // <script>
        //     swal({title: 'Peringatan Sistem', text:'Data Login Atau Sesi Anda Sekarang Direset Oleh Admin / Pimpinan, Silahkan Login Kembali Atau Hubungi Admin IT!', icon: 'warning', timer: 10000,});
            
        //     setTimeout(function(){ 
                                                
        //                                               window.location.href = './logout';
                                                
        //                                         }, 4000);
            
        // </script>
        // ";
        //                 }
        
        
        //$initCode = $row_user['employees_code'];
        $namanya = $row_user['employees_name'];
       
        $initCode = explode("-", $row_user['employees_code']);
        
        if ($initCode[0] == 'XY')
        {
            echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Berdasarkan Sistem Machine Learning Presensi, Akhir-Akhir Ini Anda Terindikasi Melakukan Manipulasi Presensi. Jika Tervalidasi Maka Akan Ada Pemberitahuan Ke Pihak Berwenang Instansi Anda', icon: 'warning', timer: 10000,});
        </script>
        ";
            $statakun = 'color:orange;';
            $initsys = '<i class="fa fa-eye" style="color:black;" aria-hidden="true"></i>';
        }else if($initCode[0] == 'XX')
        {
         echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Sistem Telah Memvalidasi Manipulasi Presensi Anda, Dan Menyatakan Bahwa Terbukti Melakukan Manipulasi Presensi. Jadi, Anda Dikenai Sangsi Pengurangan Point Dan Penghapusan Presensi Yang Di Manipulasi. Harap Jangan Di Ulangi Lagi $namanya !', icon: 'error', timer: 10000,});
        </script>
        ";
        $statakun = 'color:red;';
        $initsys = '<i class="fa fa-exclamation-triangle" style="color:red" aria-hidden="true"></i>';
        }
        else
        {
             echo "
             <style>
             swal-text {
  text-align: center;
}
             </style>
        <script>".$notifikasiSA."</script>
        ";
        }
        
        //data absen hari ini
        $query_absen="SELECT presence_date,time_in,time_out FROM presence WHERE presence_date ='$date' AND employees_id='$row_user[id]'";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $dataabsenmasuk = $row_absen['time_in'];
                                                $dataabsenpulang = $row_absen['time_out'];
                                                $dataabsenmasukI = $row_absen['time_in'];
                                                $dataabsenpulangI = $row_absen['time_out'];
                                            }
                                        }
        
        if (($dataabsenmasuk == '' || $dataabsenmasuk == null)){
            $dataabsenmasuk = '<span class="badge border border-danger text-danger" style="background-color: #ffffff;height: 30px;width: 120px;border-width:2px !important;">
            <a class="text-danger" href="./present">
            <strong>Belum Presensi</strong>
                </a></span>';
           
            
        }else{
            $dataabsenmasuk = '<span class="badge border border-success text-success" style="background-color: #ffffff;height: 30px;width: 80px;border-width:2px !important;"><strong>
            '.$dataabsenmasukI.'</strong></span>';
        }
        
        $waktuplg = explode(":",$time);
        $hwaktuplg = $waktuplg[0] . $waktuplg[1];
        
        
        if (($dataabsenpulang == '' || $dataabsenpulang == null) || ($dataabsenpulang == '00:00:00'))
        {
            $dtsx = 0;
            if ($row_user['position_id'] == 1){
                $dtsx = 1530;
            }else{
                $dtsx = 1530;   
            }
            
            if ($hwaktuplg < $dtsx)
            {
                $dataabsenpulang = '<span class="badge border border-danger text-danger" style="background-color: #ffffff;height: 30px;width: 120px;border-width:2px !important;">
            <strong>Belum Waktunya</strong>
               </span>';
            }else
            {
                 $dataabsenpulang = '<span class="badge border border-danger text-danger" style="background-color: #ffffff;height: 30px;width: 120px;border-width:2px !important;">
            <a class="text-danger" href="./present">
           <strong>Belum Presensi</strong>
                </a></span>';
            }
            
        }else{
            $dataabsenpulang = '<span class="badge border border-success text-success" style="background-color: #ffffff;height: 30px;width: 80px;border-width:2px !important;"><strong>
            '.$dataabsenpulangI.'</strong></span>';
        }
        
        $query_shift ="SELECT time_in,time_out FROM shift WHERE shift_id='$row_user[shift_id]'";
    $result_shift = $connection->query($query_shift);
    $row_shift = $result_shift->fetch_assoc();
    $shift_time_in = $row_shift['time_in'];
    $SFI =$row_shift['time_in'] ;
    $SFO = $row_shift['time_out'];
        
        // $filter ="MONTH(presence_date) ='$month'";
            $filter ="presence_date LIKE '$year-$month-%' ";
        
         $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$iduserx]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);
        
        
        echo'
            <!-- App Capsule -->
            <div id="appCapsule">
                <!-- Wallet Card -->
                <div class="section wallet-card-section pt-1">
                    <div class="wallet-card">
                        <!-- Balance -->
                        <div class="balance">
                            <div class="left">
                                <span class="title"> Selamat '.$salam.'</span>
                                <h1 class="total text-left" style="'.$statakun.'">'.ucfirst($row_user['employees_name']).' '.$initsys.'</h1>
                            </div>
                        </div>
                        <!-- * Balance -->
                        <!-- Wallet Footer -->
                        <div class="wallet-footer">
                            <div class="item">
                                <a href="./agenda">
                                    <div class="icon-wrapper bg-danger">
                                       <ion-icon name="reader-outline"></ion-icon>
                                    </div>
                                    <strong>Agenda</strong>
                                </a>
                            </div>';
                            
                                echo'<div class="item">
                                <a href="./calender">
                                    <div class="icon-wrapper bg-success">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                    </div>
                                    <strong>Kalender</strong>
                                </a>
                            </div>';
                                
                            
                            echo'<div class="item">
                                <a href="./id-card">
                                    <div class="icon-wrapper bg-warning">
                                       <ion-icon name="id-card-outline"></ion-icon>
                                    </div>
                                    <strong>ID Card</strong>
                                </a>
                            </div>
                            <div class="item">
                                <a href="./rekan">
                                    <div class="icon-wrapper bg-blue">
                                       <ion-icon name="business-outline"></ion-icon>
                                    </div>
                                    <strong>Rekan</strong>
                                </a>
                            </div>
                            <div class="item">
                                <a href="./mynilai">
                                    <div class="icon-wrapper bg-primary">
                                       <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <strong>Penilaian</strong>
                                </a>
                            </div>
                        </div>
                        <!-- * Wallet Footer -->
                    </div>
                </div>';
                // <!-- Info Hari -->
                // <div class="section">
                //     <div class="row mt-2">
                //         <div class="col-12">
                //             <div class="stat-box bg-info">
                //                 <div class="title text-white text-center">
                //                     <h3 class="text-white text-center">'.format_hari_tanggal($date).'<br> <!--<span class="clock"></span>--></h3> 
                //                 </div>
                //             </div>
                //         </div>
                //     </div>
                // </div>';
                
               
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
                
                //if ($iduserx == 74 || $iduserx == 24){
                
                if(date('d') >= 1 && date('d') <= 15){
                    
                    
                    
                    
                    $query_absen="SELECT * FROM link_nilai WHERE employees_id = $iduserx";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $chkNRekan = $row_absen['nilai1'];
                                            }
                                        }
                                        
                if ($chkNRekan == ''  || $chkNRekan == null){
                    
                    echo "
        <script>
            swal({title: 'Info Sistem', text:'$namanya Silahkan Melakukan Penilaian Rekan Kerja Anda Untuk Bulan $monthx , Penilaian Dapat Dilakukan Sampai Dengan Tanggal 10 Bulan $monthx . Jika Ada Kendala Atau Eror Silahkan Hubungi ADMIN IT, Terima Kasih', icon: 'info', timer: 10000,});
        </script>";
                    
                    echo "<script>
                                                    setTimeout(function(){ 
                                                
                                                      window.location.href = './penilaian';
                                                
                                                }, 9000);
                                                </script>";
                }                                        
                    
                
            //   echo ' <div class="section mt-1"><div class="transactions"><div class="row"><div class="load-home" style="display:contents">
            //           <!-- item -->
            //           <div class="col-12 mb-1">
            //               <a href="./penilaian" class="item">
            //                   <div class="detail">
            //                       <div class="icon-block text-primary">
            //                           <ion-icon name="newspaper-outline" role="img" class="md hydrated" aria-label="log in"></ion-icon>
            //                       </div>
            //                       <div class="text-center">
            //                           <strong class="text-center">Penilaian Rekan Kerja Bulan '.$monthx.'</strong>
                                      
            //                       </div>
            //                   </div>
            //               </a>
            //           </div>
  
            //     <!-- * item -->   </div></div></div></div>';
                
                $dtShwPenilaian = ' <div class="section"><div class="transactions"><div class="row"><div class="load-home" style="display:contents">
                      <!-- item -->
                      <div class="col-12">
                          <a href="./penilaian" class="item">
                              <div class="detail">
                                  <div class="icon-block text-primary">
                                      <ion-icon name="newspaper-outline" role="img" class="md hydrated" aria-label="log in"></ion-icon>
                                  </div>
                                  <div class="text-center">
                                      <strong class="text-center">Penilaian Rekan Kerja Bulan '.$monthx.'</strong>
                                      
                                  </div>
                              </div>
                          </a>
                      </div>
  
                <!-- * item -->   </div></div></div></div>';
                
                $dtShwPenilaianX = '<tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center text-white">'.$dtShwPenilaian.'</td>
        </tr>';
                
                }else{
                    $dtShwPenilaianX = "";
                }
             
                
                 
                
                
                //Penilaian Guru Terbaik
                if($row_user['position_id'] == 1){
                    
                    $query_absen="SELECT * FROM guru_terbaik where employees_id=$iduserx";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            
                                        }else{
                                            if($month == 11){
                                                echo "<script>
                                                    setTimeout(function(){ 
                                                
                                                      window.location.href = './terbaik';
                                                
                                                }, 3500);
                                                </script>";
                                            }
                                            
                                        }
                    
                    if($month == 11){
                        
                        if (date('d') >= 10 && date('d') <= 21){
                             echo ' <div class="section mt-1"><div class="transactions"><div class="row"><div class="load-home" style="display:contents">
                              <!-- item -->
                              <div class="col-12 col-md-12 mb-1">
                                  <a href="./terbaik" class="item">
                                      <div class="detail">
                                          <div class="icon-block text-primary">
                                              <ion-icon name="ribbon-outline" role="img" class="md hydrated" aria-label="log in"></ion-icon>
                                          </div>
                                          <div class="text-center">
                                              <strong class="text-center">Penilaian Pegawai Terbaik Periode '.$year.'</strong>
                                              
                                          </div>
                                      </div>
                                  </a>
                              </div>
                              
                            
                              
                              <!-- * item --></div></div></div></div>';
                        }
                        
                    }
                    
                }
                $hitungpulangx = null;
                $monthd = $month - 1;
                //$datext = "2020-01-11";
                $datext = date('Y-m-d');
                $newdatext = date("m", strtotime ( '-1 month' , strtotime ( $datext ) )) ;
                
                $monthdx = $year ."-" . $newdatext . "-%";
                //$filter ="MONTH(presence_date) ='$month'";
                
                $filter = "presence_date LIKE '$monthdx'";
                $shift_time_in = $row_shift['time_in'];
                $coutex = 0;
                $query_absen ="SELECT presence_id,presence_date,picture_in,time_in,picture_out,time_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Terlambat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id DESC";
                $result_absen = $connection->query($query_absen);
                
                 if($result_absen->num_rows > 0){
                    while ($row_absen = $result_absen->fetch_assoc()) {
                    $coutex++;
                    

          $query_status ="SELECT present_name FROM  present_status WHERE present_id='$row_absen[present_id]'";
          $result_status = $connection->query($query_status);
          $row_aa= $result_status->fetch_assoc();
            $no++;
            if($row_absen['information']==''){
              
            }else{
              
            }

        $selisihwaktu = $row_absen['selisih'];

      if($row_absen['status']=='Terlambat'){
          $hitungmasuk++;
          list($hh,$mm,$ss)= explode(':',$selisihwaktu);
          $perhitungantelat = ($hh * 60)+($mm);
          $totalTelat += $perhitungantelat;
          
        }
        elseif ($row_absen['status']='Tepat Waktu') {
            $hitungmasuk++;
         
        }
        else{
          
        }
        
        if ($row_absen['time_out'] == '00:00:00'){
            $hitungpulangx++;
            
        }else
        {
            $hitungpulang++;
            
        }
        
                    }
                 }
                 
                 $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);
      
      $query_tap ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_out='00:00:00'";
      $tap = $connection->query($query_tap);
      
          $hadirLDX = $hadir;
          $sakitLDX = $sakit;
          $izinLDX = $izin;
          $telatLDX = $telat;
          $tapLDX = $tap;
      
      
      
      $hitungtelat = $telat->num_rows;
  $stsx = null;
  $stsy = null;
  $stsz = null;
 
  $persentasex = ($hari  * 0.6);
  $hhds = $hadir->num_rows;
  $persentasez = ($hhds  * 0.3);
  $persentasey = (($hhds / $WeekDay) * 100);
  
  $dtsx = ($hitungpulangx / $hhds)*100;
  
   if($hitungpulangx >= 5){
      $jadistatusx = '('.number_format($dtsx,0).'% ) Kurang Disiplin';
      $stsx = 'badge-danger';
  }else{
      $jadistatusx = '('.number_format($persentasey,0).'% ) Disiplin';
      $stsx = 'badge-success';
  }
  
  $perkiraan = 100 -  ($dtsx + $persentasez);
  
  if(($persentasex <= $hhds) && ($persentasez >= $hitungtelat) && ($hitungpulangx <=1)){
      $stsy = '( '.number_format($perkiraan,0).'% ) Pegawai Sangat Rajin';
      $stsz = 'badge-success';
  }else if(($persentasex <= $hhds) && ($hitungpulangx <=3)){
       $stsy = '( '.number_format($perkiraan,0).'% ) Pegawai Rajin';
      $stsz = 'badge-info';
      }else{
      $stsy = '( '.number_format($perkiraan,0).'% ) Pegawai Kurang Rajin';
      //(Tidak Presensi Pulang : '.number_format($dtsx,0).'% )
      $stsz = 'badge-danger';
  }
                 
      $awalx = $newdatext . "-" . $year;
      $akhirx = $newdatext . "-" . $year;
      
       $awalz = $month . "-" . $year;
      $akhirz = $month . "-" . $year;
      
      $kbulan = $newdatext;
      $kbulanx = $month;
      $ktahun = $year;
      $jbulan = $newdatext;
      $jbulanx = $month;
      $jtahun = $year;
      
      $FILTERLBR1 = '%' . $awalx;
      $FILTERLBR2 = '%' . $akhirx;
      
      $FILTERLBR3 = '%' . $awalz;
      $FILTERLBR4 = '%' . $akhirz;
      
      $ttlLBR = 0;
      $ttlLBR1 = 0;
      $query1 = "SELECT * FROM libur_kerja WHERE tanggal_libur LIKE '$FILTERLBR1' OR tanggal_libur LIKE '$FILTERLBR2'";
$result1 = $connection->query($query1);
  if($result1->num_rows > 0){
      while ($row1= $result1->fetch_assoc()) {
          $ttlLBR += $row1['lama_libur'];
          //echo $ttlLBR;
      }
  }
  
  $query1 = "SELECT * FROM libur_kerja WHERE tanggal_libur LIKE '$FILTERLBR3' OR tanggal_libur LIKE '$FILTERLBR4'";
$result1 = $connection->query($query1);
  if($result1->num_rows > 0){
      while ($row1= $result1->fetch_assoc()) {
          $ttlLBR1 += $row1['lama_libur'];
          $tglOLBRN1 = $row1['tanggal_libur'];
          $tglOLBRN2 = explode("-",$tglOLBRN1);
          $tglOLBRN3 = $tglOLBRN2[2] . "-" . $tglOLBRN2[1] . "-" .  $tglOLBRN2[0];
          $tglLBRN[] = $tglOLBRN3;
          array_push($tglLBRN);
          //echo $ttlLBR;
      }
  }
  
  if ($kbulanx == $jbulanx){
      $WeekDayx = (countWork($ktahun,$kbulanx,array(0,6)) - $ttlLBR1);
      $bblnz = ambilbulan($kbulanx);
  }else{
      
      $bnykUlangx = $jbulanx - $kbulanx;
      
      for($i=0;$i <= $bnykUlangx;$i++){
          $blnGtsx = $kbulanx + $i;
          $WeekDayx += (countWork($jtahun,$blnGtsx,array(0,6)) - $ttlLBR1);
      }
      
      //$WeekDay = (countWork($ktahun,$kbulan,array(0,6)) - $ttlLBR);
      //$WeekDay += (countWork($jtahun,$jbulan,array(0,6)) - $ttlLBR);
      $bblnz = ambilbulan($kbulanx) . " s/d " . ambilbulan($jbulanx);
  }
  
  if ($kbulan == $jbulan){
      $WeekDay = (countWork($ktahun,$kbulan,array(0,6)) - $ttlLBR);
      $bblnx = ambilbulan($kbulan);
  }else{
      
      $bnykUlang = $jbulan - $kbulan;
      
      for($i=0;$i <= $bnykUlang;$i++){
          $blnGts = $kbulan + $i;
          $WeekDay += (countWork($jtahun,$blnGts,array(0,6)) - $ttlLBR);
      }
      
      //$WeekDay = (countWork($ktahun,$kbulan,array(0,6)) - $ttlLBR);
      //$WeekDay += (countWork($jtahun,$jbulan,array(0,6)) - $ttlLBR);
      $bblnx = ambilbulan($kbulan) . " s/d " . ambilbulan($jbulan);
  }
  
  $WeekDayLDX = $WeekDay;
  $initTelat = ($totalTelat * 60);
  $keJam = floor($initTelat / 3600);
  $keMenit = floor(($initTelat / 60) % 60);
  $keDetik = $initTelat % 60;
  $konversiTelatx = $keJam . " Jam " . $keMenit . " Menit ";
  
  $initTelatLDX = $initTelat;
  $totalTelatLDX = $totalTelat;
  $konversiTelatxLDX = $konversiTelatx;
  $keJamLDX = $keJam;
  
  $tidakhadir = $WeekDay - $hadir->num_rows;
  $TelatDalamHari = ($totalTelat / 60) / 8;
  $EWS1 = ($tidakhadir * 8) * 60;
  $EWS2 = $EWS1 + $totalTelat;
  $EWSJam = floor($EWS2 / 60);
  $EWSMenit = floor($EWS2 % 60);
  $EWS3 = $EWSJam . " Jam " . $EWSMenit . " Menit ";
                if($EWS2 >= 900){
                    if(date('d') >= 20 && date('d') <= 31){
                echo ' <div class="section mt-1"><div class="transactions"><div class="row"><div class="load-home" style="display:contents">
                      <!-- item -->
                      <div class="col-12 col-md-12 mb-1">
                          <a href="./history" class="item bg-warning">
                              <div class="detail">
                                  <div class="icon-block text-danger">
                                      <ion-icon name="bonfire-outline" role="img" class="md hydrated" aria-label="log in"></ion-icon>
                                  </div>
                                  <div class="text-center">
                                      <span class="text-white text-center"><blink><h3><strong><i>EWS (Early Warning System)</i></strong></h3></blink> Jumlah Akumulasi Telat Dan Tidak Hadir Bulan <strong>'.ambilbulan($monthd).'</strong> Adalah '.$EWS3.' <br> <strong> Atau </strong>'.(floor(number_format($TelatDalamHari,1)) + $tidakhadir ).' Hari / '.$WeekDay.' Hari Kerja <br><br> <strong class="text-danger">Harap Perbaiki Kehadiran Dan Kinerja Anda Di Bulan Sekarang.</strong> 
                                      <i><strong class="text-white">(EWS Akan Muncul Jika Akumulasi Lebih Dari 900 Menit)</strong></i>
                                      </span>
                                      
                                  </div>
                              </div>
                          </a>
                      </div>
  
                <!-- * item -->   </div></div></div></div>';
                    }
                }
                
                $checkhari = hari();
                $notifWork = null;
                
                if ($checkhari =='Sabtu' || $checkhari =='Minggu'){
                    $dataabsenmasuk = '<span class="badge border border-primary text-primary" style="background-color: #ffffff;height: 30px;width: 120px;border-width:3px !important;">
            Libur Akhir Pekan
                </span>';
                    $dataabsenpulang = '<span class="badge border border-primary text-primary" style="background-color: #ffffff;height: 30px;width: 120px;border-width:3px !important;">
            Libur Akhir Pekan
                </span>';
                    
                    echo "
        <script>
            swal({title: 'Info Sistem', text:'Sekarang Adalah Hari $checkhari , Yaitu Libur Akhir Pekan. Selamat Berlibur $namanya.', icon: 'info', timer: 10000,});
        </script>
        ";
                    
                }
                
                // echo'
                // <!-- Info Absen -->
                // <div class="section">
                // <div class="row mt-2">
                // '.$dataabsenmasuk.'
                // '.$dataabsenpulang.'
                // </div></div>';
                
                // <!-- Info Presensi -->
                
                
                
                
                // $filter ="MONTH(presence_date) ='$month'";
                 $filter ="presence_date LIKE '$year-$month-%' ";
        
         $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$iduserx]' AND $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$iduserx' AND $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);
      
      $query_tap ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND time_out='00:00:00'";
      $tap = $connection->query($query_tap);
      
      $query_dnl="SELECT id FROM pengajuan_dnl WHERE employess_id='$iduserx' AND tanggal LIKE '$year-$month-%' AND akses =1";
      $dnl = $connection->query($query_dnl);
      
      $perhadirx = (($hadir->num_rows) / $WeekDayx) * 100;
      
                $perhadiry = floor(number_format($perhadirx,1));
                
               
                
                
                $pertelatx = (($telat->num_rows) / $WeekDayx) * 100;
                $pertelaty = floor(number_format($pertelatx,1));
                
                $perpulangx = ($tap->num_rows / $WeekDayx) * 100;
                $perpulangy = floor(number_format($perpulangx,1));
                
                
                
//hitung hkerja

// $tglLBRN[] = "2022-08-01";
//           array_push($tglLBRN);

$startx = date("Y-m") . "-01";
$endx = date("Y-m-d");


// $start = new DateTime("2022-07-01");
// $end = new DateTime("2022-07-09");

$start = new DateTime($startx);
$end = new DateTime($endx);
// otherwise the  end date is excluded (bug?)
$end->modify('+1 day');

$interval = $end->diff($start);

// total days
$days = $interval->days;

// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
$holidays = $tglLBRN;

foreach($period as $dt) {
    $curr = $dt->format('D');

    // substract if Saturday or Sunday
    if ($curr == 'Sat' || $curr == 'Sun') {
        $days--;
    }

    // (optional) for the updated question
    elseif (in_array($dt->format('Y-m-d'), $holidays)) {
        $days--;
    }
}

 $perhadirxy = (($days -$hadir->num_rows) / $WeekDayx) * 100;
                $perhadirxyz = floor(number_format($perhadirxy,1));

//echo $days;

$filter = "presence_date LIKE '$year-$month-%'";
 $query_absen ="SELECT presence_id,presence_date,picture_in,time_in,picture_out,time_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Terlambat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id DESC";
                $result_absen = $connection->query($query_absen);
                
                 if($result_absen->num_rows > 0){
                    while ($row_absen = $result_absen->fetch_assoc()) {
                        $selisihwaktux = $row_absen['selisih'];

                      if($row_absen['status']=='Terlambat'){
                          $hitungmasukx++;
                          list($hh,$mm,$ss)= explode(':',$selisihwaktux);
                          $perhitungantelatx = ($hh * 60)+($mm);
                          $totalTelatx += $perhitungantelatx;
                          
                        }
                    }
                 }
                
   $initTelatx = ($totalTelatx * 60);
  $keJamx = floor($initTelatx / 3600);
  $keMenitx = floor(($initTelatx / 60) % 60);
  $keDetikx = $initTelatx % 60;
  
  $konversiTelatxx = $keJamx . " Jam " . $keMenitx . " Menit ";
  
  $dtLonceng ='
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
            
            <td colspan="3" class="text-center" style="text-align: center;">
            <a href="./present" class="text-danger">
                     <span class="text-danger badge small" style="border-radius: 50%;height: 200px;width: 200px;text-align: center;background-color: #FFFFFF;">
                     <i class="fa fa-bell-o fa-8x animation-element" style="animation: tilt-shaking 1.5s linear infinite;" aria-hidden="true"></i>
                     </span>
            </a>         
                     </td>
            
        </tr>';
  
  
  echo'<div class="container mb-3 mt-2">
  <div class="card" style="background-color: #36802d;">
  <br>
    <span class="rounded text-dark badge ml-3 mr-3 small" style="background-color: #FFFFFF;">Selfi Foto Divalidasi Dengan Face Recognition</span>
    <div class="card" style="background-color: #36802d;">
       <table id="progres" class="table-borderless mt-1">
        <tr>
            <td colspan="3" class="text-white text-center col-4"><strong>'.format_hari_tanggal($date).' <span class="clock"></span></strong></td>
        </tr>';
        echo $dtShwPenilaianX;
        $dtXlonceng = null;
        
        if ($checkhari =='Sabtu' || $checkhari =='Minggu'){
        }else{
        if ($dataabsenmasukI == "" || $dataabsenmasukI == null){
            echo $dtLonceng;
        }else if ($dataabsenmasukI != "" || $dataabsenmasukI != null){
            
            if ($dataabsenpulangI == '00:00:00'){
                $waktuplgx = explode(":",$SFO);
            $hwaktuplgx = $waktuplgx[0] . $waktuplgx[1];
            if ($hwaktuplg < $hwaktuplgx){
                
            }else{
                echo $dtLonceng;
            }
            }
             
        }
        }
        
        echo' <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="">
            <td class="text-white text-center col-4 ml-4 mt-2 small"><strong>'.$SFI.'</strong></td>
            <td class="text-warning text-center col-4 mt-2 small"><strong>&nbsp;</strong></td>
            <td class="text-white text-center col-4 mt-2 mr-4 small"><strong>'.$SFO.'</strong></td>
        </tr>
        <tr>
            <td class="text-white text-center col-4 small">Masuk Kantor</td>
            <td class="text-warning text-center col-4 small">&nbsp;</td>
            <td class="text-white text-center col-4 small">Pulang Kantor</td>
        </tr>
        <tr>
            <td class="text-dark text-center col-4">'.$dataabsenmasuk.'</td>
            <td class="text-danger text-center col-4 small">&nbsp;</td>
            <td class="text-dark text-center col-4">'.$dataabsenpulang.'</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        </table>
    </div>
  </div>
</div>';
                
                
                
                echo ' <div class="section mt-3"><div class="section-title mb-1">Presensi Bulan <span class="text-primary"> '.$monthx.' '.$year.'</span></div><div class="transactions"><div class="row"><div class="load-home" style="display:contents">
                
                
<!-- update view like kmob -->
<div class="container col-12 mb-3">
<div class="card text-white bg-blue">
  <span class="text-dark text-center"><strong>PROGRES BULAN INI</strong></span>
  <br>
        <table id="progres" class="table-borderless">
        <tr>
            <td class="text-dark text-center col-4 small">Kehadiran</td>
            <td class="text-dark text-center col-4 small">Alpa</td>
            <td class="text-dark text-center col-4 small">TAP</td>
        </tr>
        <tr>
            <td class="text-dark text-center small">'.$hadir->num_rows.' / '.$WeekDayx.'</td>
            <td class="text-dark text-center small">'.($days-($hadir->num_rows)).' / '.$WeekDayx.'</td>
            <td class="text-dark text-center small">'.(($tap->num_rows)).' / '.$WeekDayx.'</td>
        </tr>
        <tr>
            <td>
                <div class="progress ml-2 mr-2">
                <div class="progress-bar bg-success"style="width:'.$perhadiry.'%" aria-valuenow="'.$perhadiry.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td>
                <div class="progress ml-2 mr-2">
                <div class="progress-bar bg-danger" style="width:'.$perhadirxyz.'%" aria-valuenow="'.$perhadirxyz.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td>
                <div class="progress ml-2 mr-2">
                <div class="progress-bar bg-warning" style="width:'.$perpulangy.'%" aria-valuenow="'.$perpulangy.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-dark text-center small">'.$perhadiry.'%</td>
            <td class="text-dark text-center small">'.$perhadirxyz.'%</td>
            <td class="text-dark text-center small">'.$perpulangy.'%</td>
        </tr>
        </table>
</div>
</div>

<div class="container col-12 mx-auto mb-3">
  <div class="card">
    <div class="card-header text-white text-center small" style="background-color: #FFA500;">REKAPITULASI KEHADIRAN BULAN <font color="black">'.$monthx.'</font> Berjalan</div>
    <div class="card">
       <table id="progres" class="table-borderless">
        <tr>
            <td class="text-info text-center col-4 small">Dinas Luar</td>
            <td class="text-warning text-center col-4 small">Izin</td>
            <td class="text-secondary text-center col-4 small">Sakit</td>
        </tr>
        <tr>
            <td class="text-info text-center col-4 small"><strong>'.$dnl->num_rows.'</strong></td>
            <td class="text-warning text-center col-4 small"><strong>'.$izin->num_rows.'</strong></td>
            <td class="text-secondary text-center col-4 small"><strong>'.$sakit->num_rows.'</strong></td>
        </tr>
        <tr>
            <td class="text-info text-center col-4 small">Hari</td>
            <td class="text-warning text-center col-4 small">Hari</td>
            <td class="text-secondary text-center col-4 small">Hari</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="text-dark text-center col-4 small">Terlambat</td>
            <td class="text-danger text-center col-4 small">Terlambat</td>
            <td class="text-dark text-center col-4 small">Pinalti</td>
        </tr>
        <tr>
            <td class="text-dark text-center col-4 small"><strong>'.$telat->num_rows.'</strong></td>
            <td class="text-danger text-center col-4 small"><strong>'.$totalTelatx.'</strong></td>
            <td class="text-dark text-center col-4 small"><strong>'.floor(number_format(($keJamx / 8),1)).'</strong></td>
        </tr>
        <tr>
            <td class="text-dark text-center col-4 small">Hari</td>
            <td class="text-danger text-center col-4 small">Menit</td>
            <td class="text-dark text-center col-4 small">Hari</td>
        </tr>
        </table>
    </div>
  </div>
</div>



<div class="container col-12 mx-auto mb-2">
  <div class="card">
    <div class="card-header text-white text-center small" style="background-color: #FF0E0E;">REKAPITULASI KEHADIRAN BULAN SEBELUMNYA</div>
    <div class="card">
       <table id="progres" class="table-borderless">
        <tr>
            <td class="text-info text-center col-3 small">Masuk</td>
            <td class="text-warning text-center col-3 small">Alpa</td>
            <td class="text-secondary text-center col-3 small">TAP</td>
            <td class="text-dark text-center col-3 small">Terlambat</td>
        </tr>
        <tr>
            <td class="text-info text-center col-3 small"><strong>'.$hadirLDX->num_rows.'</strong></td>
            <td class="text-warning text-center col-3 small"><strong>'.($WeekDayLDX-($izin->num_rows)).'</strong></td>
            <td class="text-secondary text-center col-3 small"><strong>'.$tapLDX->num_rows.'</strong></td>
            <td class="text-dark text-center col-3 small"><strong>'.$telatLDX->num_rows.'</strong></td>
        </tr>
        <tr>
            <td class="text-info text-center col-3 small">Hari</td>
            <td class="text-warning text-center col-3 small">Hari</td>
            <td class="text-secondary text-center col-3 small">Hari</td>
            <td class="text-dark text-center col-3 small">Hari</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="text-danger text-center col-3 small">Terlambat</td>
            <td class="text-warning text-center col-3 small">Izin</td>
            <td class="text-secondary text-center col-3 small">Sakit</td>
            <td class="text-dark text-center col-3 small">Pinalti</td>
        </tr>
        <tr>
            <td class="text-danger text-center col-3 small"><strong>'.$totalTelatLDX.'</strong></td>
            <td class="text-warning text-center col-3 small"><strong>'.$izinLDX->num_rows.'</strong></td>
            <td class="text-secondary text-center col-3 small"><strong>'.$sakitLDX->num_rows.'</strong></td>
            <td class="text-dark text-center col-3 small"><strong>'.floor(number_format(($keJamLDX / 8),1)).'</strong></td>
        </tr>
        <tr>
            <td class="text-danger text-center col-4 small">Menit</td>
            <td class="text-warning text-center col-4 small">Hari</td>
            <td class="text-secondary text-center col-4 small">Hari</td>
            <td class="text-dark text-center col-4 small">Hari</td>
        </tr>
        </table>
    </div>
  </div>
</div>


  <!-- item -->
  
  
  
  
  
  
  
  </div></div></div></div>
                
                <!-- Wallet Card -->
                <div class="section mt-2 mb-2">
                    <div class="section-title text-center">Presensi 1 Minggu Terakhir</div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-dark rounded bg-danger">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Tanggal</th>
                                            <th scope="col" class="text-center">Jam Masuk</th>
                                            <th scope="col" class="text-center">Jam Pulang</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                        $query_absen="SELECT presence_date,time_in,time_out FROM presence WHERE MONTH(presence_date) ='$month' AND employees_id='$row_user[id]' ORDER BY presence_id DESC LIMIT 6";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                            echo'
                                            <tr>
                                                <th scope="row" class="text-center">'.tgl_ind($row_absen['presence_date']).'</th>
                                                <td class="text-center">'.$row_absen['time_in'].'</td>';
                                                if ($row_absen['time_out'] == '00:00:00')
                                                {
                                                   echo '<td class="text-center"> - </td>'; 
                                                }else
                                                {
                                                    echo '<td class="text-center">'.$row_absen['time_out'].'</td>';
                                                }
                                                
                                            echo '</tr>';
                                        }}
                                        echo'
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- App Capsule -->
        ';
        
        if ($custanggalX == $custanggal){
            $thnLhr = explode("-", $row_user['tglhr']);
            $hitUmur = $year - $thnLhr[2];
            
             echo "
        <script>
            swal({title: 'Selamat Ulang tahun', text:'Selamat Ulang Tahun Yang Ke-$hitUmur $namanya ', icon: 'info', timer: 10000,});
        </script>
        ";
            
        }
        
        $cUltah = 0;
        $query_absen="SELECT employees_name,photo,jk,tglhr,nohp FROM employees WHERE tglhr LIKE '$custanggal%'";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                
                                                $NamaUltah[] = $row_absen['employees_name'];
                                                 array_push($NamaUltah);
                                                
                                                
                                                $PhotoUltah[] = $row_absen['photo'];
                                                array_push($PhotoUltah);
                                                
                                                $JkUltah[] = $row_absen['jk'];
                                                array_push($JkUltah);
                                                
                                                $TglUltah[] = $row_absen['tglhr'];
                                                array_push($TglUltah);
                                                
                                                $NoUltah[] = $row_absen['nohp'];
                                                array_push($NoUltah);
                                                
                                                $cUltah++;
                                            }
                                        }
        $BnykUltah = count($NamaUltah);
        // $UltahHeader = "Yang Ber-Ulang Tahun Hari Ini Ada $cUltah Orang Yaitu : ";
        $UltahHeader = "Kepada";
        $UltahFooter = "Silahkan Ucapkan Selamat Ulang Tahun Pada Orang Yang Bersangkutan.";
        
        // $UltahFooter = $NamaUltah[0];
        
        if ($cUltah > 0){
            
            for($i=0;$i < $cUltah;$i++){
                
                $noUltah = $i;
                
                if ($JkUltah[$i] == 1){
                    $JKPgl = "Bapak";
                }else if($JkUltah[$i] == 2){
                    $JKPgl = "Ibu";
                }
                
                $NMUltah = $NamaUltah[$i];
                
                $thnLhrX = explode("-", $TglUltah[$i]);
            $hitUmurX = $year - $thnLhrX[2];
            
                    $getXno = substr($NoUltah[$i],1);
                        $getXno = "+62" . $getXno;
                
                $NotifUltah = $NotifUltah . ($i+1) . ". " . $JKPgl . " <u><b><font color='black'>" . $NamaUltah[$i] . "</font></b></u> Ultah Ke -" . $hitUmurX . " Tahun. <br><a href='whatsapp://send?phone=".$getXno."&text=Selamat Ulang Tahun 🎂 _Ke-".$hitUmurX."_, ".$JKPgl." *" . $NamaUltah[$i] . "* %0A %0ASemoga Sehat Selalu Dan Menjadi Lebih Baik Lagi 🙏🙏🙏.' class='text-center'>Klik Disini Untuk Kirim Ucapan Ke " . $NamaUltah[$i] . "</a><br>";
                
            }
            
        //         echo "
        // <script>
        //     swal({title: 'Ucapkan Selamat Ulang Tahun', text:'$UltahHeader $cUltah Orang Yaitu : $NotifUltah $UltahFooter', icon: 'info', timer: 10000,});
        // </script>
        // ";
            
        }
        
        $CallNamex = explode(" ",$namanya);
        
    ?>
    
   <button type="button" style="display:none;" class="btn btn-primary" id="cobas" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b><u><?= $CallNamex[0]; ?></u></b> Ucapkan Selamat Ulang Tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        
        echo "<font color='black'> $UltahHeader $cUltah Orang Yaitu : <br> <br> $NotifUltah  <br> <center> $UltahFooter </center> </font>";
        
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


    <?php
        
    }
    include_once 'mod/sw-footer.php';
}
?>