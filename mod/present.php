<?php
//require_once'../library/sw-config.php';
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
    $ainfo = null;
    $SActive = null;
    $idx = $row_user['id'];
    $query_absen="SELECT * FROM system where id=1";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $ainfo = $row_absen['info_active'];
                                                $SActive = $row_absen['active'];
                                                $facematcher = $row_absen['face'];
                                                $AKHP = $row_absen['modeakh'];
                                                $CAKHP = $row_absen['countakh'];
                                                
                                            }
                                        }
                                        
                                        
    $query="SELECT * FROM agenda_kegiatan WHERE employees = '$idx' AND 	tanggal = '$date' ORDER BY id DESC";
            $result = $connection->query($query);
            $countx = 0;
            if($result->num_rows > 0){
           while ($row= $result->fetch_assoc()) {
               
               
           }
            }
            
            $countLAKH = $result->num_rows;
            
            
            $MAKHP = '';
            $NAKHP = '';
            if($AKHP == 'ON'){
             if($countLAKH < $CAKHP){
                 $MAKHP = 'style="display: none;"';
                 $NAKHP = '<a href="/agenda"><button id="nakhp" class="btn btn-danger btn-lg btn-block"><ion-icon name=""alert-circle-outline"></ion-icon>Belum Mengisi AKHP (Minimal '.$CAKHP.')</button></a>';
                }
            }
    
    echo '
    <!--<script defer src="face-api.min.js"></script>
  <script defer src="script.js"></script>-->
    ';
    $iduserx = $row_user['id'];
    $namanya = $row_user['employees_name'];
    
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

$CGTGLNOW = DATE('d') . "-" . DATE('m') . "-" . $year;

 $query_absen="SELECT * FROM libur_kerja WHERE tanggal_libur = '$CGTGLNOW'";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $KETLIBUR = $row_absen['ket_libur'];
                                                $LMLIBUR = $row_absen['lama_libur'];
                                            }
                                        }
                                        
if ($LMLIBUR == '' || $LMLIBUR == null || $LMLIBUR == 0){
    
}else{
    $SActive = 0 ;
    $ainfo = "Tidak Bisa Absen Dikarenakan Sekarang Tanggal " . $CGTGLNOW . " Yaitu Hari " . $KETLIBUR . ", Merupakan Hari Libur Nasional, Terima Kasih";
}                                       


    
    
    //echo '<script>alert('.$row_user["id"].');</script>';
          
  echo'<!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title"> Selamat '.$salam.'</span>
                        <h4>'.ucfirst($row_user['employees_name']).'</h4>
                    </div>
                    <div class="right">
                        <span class="title">'.tgl_ind($date).' </span>
                        <h4><span class="clock"></span> WIB</h4>
                    </div>

                </div>
                <!-- * Balance -->
                <!-- Wallet Footer --><div class="text-center"><!--<h3>'.tgl_ind($date).' - <span class="clock"></span> WIB --><span class="jarak" id="jarak">Jarak </span> <span id="ntfxy"></span> <i class="fa fa-check-circle" style="" id="infoxa" aria-hidden="true"></i><i class="fa fa-times-circle" style="" id="infoxb" aria-hidden="true"></i><br>';
                
                $iddx = $row_user['id'];
    $infox = null;
      
    $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '$iddx' and tanggal = '$date'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
            $pengajuan = $row_absen['pengajuan'];
            $akses = $row_absen['akses'];
                    
                    if ($pengajuan = '4' && $akses == '1')
                    {
                         echo '<span class="infodinas" id="infodinas">Sedang Dinas Luar</span> <i class="fa fa-car" aria-hidden="true"></i>';
                    }else
                    {
                        
                    }
             }
                    // echo '<span class="infodinas" id="infodinas">Din</span> <i class="fa fa-car" aria-hidden="true"></i>';
        }
                //<span class="infodinas" id="infodinas">Dinas '.$infox.' </span>
                
                //<div class="webcam-capture"><video id="video" width="100%" height="100%" autoplay muted></video></div>
                //<video class="webcam-capture" id="video" width="720" height="560" autoplay muted></video>
                
                
                
                
                echo '</h3></div>
                <div class="wallet-footer text-center">
                    <div class="webcam-capture-body text-center">
                        <span class="latitude d-none" id="latitude"></span>
                        <!--<div class="webcam-capture"></div>-->';
                        if ($facematcher == 'OFF'){
                    echo '<div class="webcam-capture"></div>';
                    
                }else{
                    echo '<video id="vidDisplay" class="webcam-capture" width="960" height="1280" style="width: 960px;height: 1280px;" onloadedmetadata="onPlay(this)" autoplay="true"></video>';
                }
                        echo '<div class="form-group basic">';
                        $query ="SELECT employees_id,time_in FROM presence WHERE employees_id='$row_user[id]' AND presence_date='$date'";
                        $result = $connection->query($query);
                        $row = $result->fetch_assoc();
                        
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
            swal({title: 'Info Sistem', text:'$namanya Untuk Dapat Melakukan Presensi Harap Melakukan Penilaian Rekan Kerja Untuk Bulan $monthx . Batas Pengisian Rekan Kerja Sampai Dengan Tanggal 10 Bulan $monthx . Jika Ada Kendala Atau Eror Silahkan Hubungi ADMIN IT, Terima Kasih', icon: 'info', timer: 10000,});
        </script>";
                    
                    echo "<script>
                                                    setTimeout(function(){ 
                                                
                                                      window.location.href = './penilaian';
                                                
                                                }, 9000);
                                                </script>";
                                            
                                            
                                        }else
                                        {
                                            echo '<span class="text-center" id="recogx">Wajah Tidak Terdeteksi</span>';
                                            
                                            if($result->num_rows > 0){
                                            echo'
                                            <button id="btnabsen" class="btn btn-success btn-lg btn-block" onClick="captureimage(0)"  '.$MAKHP.'><ion-icon name="camera-outline"></ion-icon>Absen Pulang</button>';
                                                echo $NAKHP;
                                            }
                                            else{
                                            echo'
                                            <button id="btnabsen" class="btn btn-success btn-lg btn-block" onClick="captureimage(0)"><ion-icon name="camera-outline"></ion-icon>Absen Masuk</button>';
                                            
                                            }
                                        }
                        }else{
                            
                            echo '<span class="text-center" id="recogx">Wajah Tidak Terdeteksi</span>';
                            
                            if($result->num_rows > 0){
                                            echo'
                                            <button id="btnabsen" class="btn btn-success btn-lg btn-block" onClick="captureimage(0)" '.$MAKHP.'><ion-icon name="camera-outline"></ion-icon>Absen Pulang</button>';
                                        echo $NAKHP;
                            }
                                            else{
                                            echo'
                                            <button id="btnabsen" class="btn btn-success btn-lg btn-block" onClick="captureimage(0)"><ion-icon name="camera-outline"></ion-icon>Absen Masuk</button>';
                                            }
                            
                        }
                        
                        
                        
                        echo'
                        </div>
                    </div>
                </div>
                <!-- * Wallet Footer -->
                
            </div>
        </div>
        <!-- Card -->
    </div>
    <!-- * App Capsule -->
';

if ($SActive == 1){
        
    }else{
        echo '<script>
        
        swal({title: "Info Sistem", text:"'.$ainfo.'", icon: "warning", timer: 10000,});
        
        </script>
        <script>
        //document.getElementById("btnabsen").style.display = "none";
        //document.getElementById("btnabsen").disabled = true;
        </script>
        <script>';?>setTimeout("location.href = './login&app=2.7';",10000);<?php echo'</script>";
        ';
        
    }


  }
  include_once 'mod/sw-footer.php';
} ?>