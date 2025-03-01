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
                <!-- Wallet Footer --><div class="text-center"><!--<h3>'.tgl_ind($date).' - <span class="clock"></span> WIB --><span class="jarak" id="jarak">Jarak </span> <i class="fa fa-check-circle" style="" id="infoxa" aria-hidden="true"></i><i class="fa fa-times-circle" style="" id="infoxb" aria-hidden="true"></i><br>';
                
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
                echo '</h3></div>
                <div class="wallet-footer text-center">
                    <div class="webcam-capture-body text-center">
                        <span class="latitude d-none" id="latitude"></span>
                        <div class="webcam-capture"></div>
                        <div class="form-group basic">';
                        $query ="SELECT employees_id,time_in FROM presence WHERE employees_id='$row_user[id]' AND presence_date='$date'";
                        $result = $connection->query($query);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                        echo'
                        <button class="btn btn-success btn-lg btn-block" onClick="captureimage(0)"><ion-icon name="camera-outline"></ion-icon>Absen Pulang</button>';}
                        else{
                        echo'
                        <button class="btn btn-success btn-lg btn-block" onClick="captureimage(0)"><ion-icon name="camera-outline"></ion-icon>Absen Masuk</button>';
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

  }
  include_once 'mod/sw-footer.php';
} ?>