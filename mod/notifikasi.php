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
    
    
    $checkhari = hari();
    $keterangan = $_POST['keterangan'];
    $idx = $row_user['id'];
    $tanggal = $_POST['tanggal'];
    $pengajuan = $_POST['pengajuan'];
    
   
    
    //$filter ="MONTH(presence_date) ='$month'";
    $namauser = $row_user['employees_name'];
    $idtsx = $row_user['id'];
    $infoxts= null;
    $stats = null;
    $dtx = null;
    
    
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
    
    
    
   $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '$idtsx' and tanggal = '$date'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
            
            if ($row_absen['akses'] == '1'){
                $stats = "green";
                $infoxts = 'Ajuan Dinas Luar Anda Untuk Hari Ini Di Setujui';
                $dtx = 'fa fa-check';
            }else
            {
                $stats = "tomato";
                $infoxts = 'Ajuan Dinas Luar Anda Untuk Hari Ini Belum Di Setujui';
                $dtx = 'fa fa-times';
            }
            
            
        }
            
        }
    
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
        
    
    

        <div class="section mt-2">
            <div class="section-title">Info Notifikasi</div>';
            $no=1;
            $query_absen="SELECT * FROM pengumuman WHERE pinned = 1 ORDER BY idNotif DESC LIMIT 7";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 
                 echo '<div class="card mt-2"><div class="transactions"><div class="loaddatacuty">
      <div class="item">
          <div class="detail">
              <div><strong><font color="red">'.$no.'</font>
                  <br><center>'.$row_absen['title'].' <span class="btn btn-success btn-sm btn-update-cuty" data-id="12" data-start="15-06-2022" data-end="24-06-2022" data-work="27-06-2022" data-total="1" data-description="Capek"><i class="fa fa-bell" aria-hidden="true" style="animation: tilt-shaking 0.99s linear infinite;"></i></span></strong></center>
                  
                  <p><ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon> '.$row_absen['tanggal'].'<br><ion-icon name="mail-unread-outline" role="img" class="md hydrated" aria-label="mail-unread-outline"></ion-icon> Perihal : '.$row_absen['perihal'].'<br><strong><hr>
                    <ion-icon name="chatbubble-outline" role="img" class="md hydrated" aria-label="chatbubble outline"></ion-icon> '.$row_absen['pengumuman'].'</p>
              </div>
          </div>
      </div></div></div></div>';
                 $no++;
             }
        }
            
            
    //         echo '<div class="card"><div class="transactions"><div class="loaddatacuty">
    //   <div class="item">
    //       <div class="detail">
    //           <div>
    //               <center><strong>INFO UPDATE APLIKASI <span class="btn btn-success btn-sm btn-update-cuty" data-id="12" data-start="15-06-2022" data-end="24-06-2022" data-work="27-06-2022" data-total="1" data-description="Capek"><i class="fa fa-bell" aria-hidden="true"></i></span></strong></center>
                  
    //               <p><ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon> 15 JUNI 2022<br><ion-icon name="mail-unread-outline" role="img" class="md hydrated" aria-label="mail-unread-outline"></ion-icon> Perihal : Update PRESENSI APK<br><strong><hr>
    //                 <ion-icon name="chatbubble-outline" role="img" class="md hydrated" aria-label="chatbubble outline"></ion-icon> Info Update Sistem Terbaru Dan APK Terbaru, Untuk Memperbarui APK Versi Terbaru Harap Download Dari Link Berikut <br><br>
    //                 <center><a href="https://link.skensala.my.id/PRESENSI">https://link.skensala.my.id/PRESENSI</a></center><br> Terima Kasih 🙏🙏🙏</strong></p>
    //           </div>
    //       </div>
    //   </div></div></div></div>';
      
      
      
             echo '<div class="alert alert-info mt-2 mb-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Harap Selalu Melihat Info Notifikasi / Info Pengumuman Untuk Pemberitahuan Kedinasan Atau Perihal Lain, Terima Kasih</a>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>