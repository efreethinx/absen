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
    
    if ($keterangan == "" || $keterangan == 'NULL')
    {
        
    }else
    {
        $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '$idx' and tanggal = '$tanggal'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             echo "<script>
            swal({title: 'Info Sistem', text:'Anda Sudah Melakukan Pengajuan Dinas Luar Hari Ini, Tunggu Pihak Berwenang Instansi Anda Untuk Memvalidasi Pengajuan.', icon: 'error', timer: 5000,});
        </script>";
        
        
        }else
        {
            if ($checkhari == "Sabtu" || $checkhari == 'Minggu')
            {
                echo "<script>
            swal({title: 'Info Sistem', text:'Anda Tidak Bisa Mengajukan Dinas Luar, Dikarenakan Sekarang Hari $checkhari Yaitu Libur Akhir Pekan!, Terima Kasih.', icon: 'error', timer: 7000,});
        </script>";
            }else
            {
                
            
            
        $add ="INSERT INTO pengajuan_dnl (employess_id,
              tanggal,
              pengajuan,
              akses,
              keterangan) values('$idx',
              '$tanggal',
              '$pengajuan',
              '0',
              '$keterangan')";
    if($connection->query($add) === false) {
        die($connection->error.__LINE__); 
        //echo'Data tidak berhasil disimpan!';
    } else{
        //echo'success';
        echo "<script>
            swal({title: 'Info Sistem', text:'Pengajuan Untuk Dinas Luar Sukses Diajukan, Tunggu Pihak Berwenang Menyetujui Ajuan Anda.', icon: 'success', timer: 5000,});
        </script>";
    }
            }
    
        }  
    }
    
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
    <div class="card">
    <div class="card-body">
        
        
        
<div class="">
            <div class="form-group basic">
                <div class="input-wrapper">
                <div class="center">
                    <span class="title">Kalender Presensi SKENSALA</span>
                    <h1 class="total text-center">Hari Ini '.format_hari_tanggal($date).'</h1>
                    <div class="mx-auto col-lg-12 text-center">
                    <div id="calendar"></div>
                </div>
                </div>
                </div>
            </div> 
       
        </div>       
    </div>
    </div>
    </div>
    
    

        <div class="section mt-2">
            <div class="section-title">Libur Nasional Bulan Ini</div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="5" style="text-align:center;">Info Libur Nasional Bulan '.$monthx.' Tahun '.$year.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Tanggal Libur</th>
              <th style="text-align:center;">Lama Libur</th>
              <th style="text-align:center;">Keterangan</th>
              <th style="text-align:center;">Libur</th>
            </tr>
            </thead>
            <tbody>';
            
            $QwkTgl = $month . "-" . $year;
            
            $query="SELECT * FROM libur_kerja where tanggal_libur LIKE '%$QwkTgl'";
            $result = $connection->query($query);
            $countx = 0;
            $validasixy = 0;
            $validasix = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               $countx++;
             
             $tglLibur = $row['tanggal_libur'];
             $ketLibur = $row['ket_libur'];
             $lamaLibur = $row['lama_libur'];
             
            echo '<tr>';
            
             
                echo '<td class="text-center">'.$countx.'</td>'; 
             
                  echo '<td style="text-align:center;">'.$tglLibur.'</td>';
                  echo '<td style="text-align:center;">'.$lamaLibur.' Hari</td>';
                  echo '<td style="text-align:center;">'.$ketLibur.'</td>';
                  
                  if($lamaLibur < 1 )
                  {
                      echo '<td style="text-align:center;"><i class="fa fa-times-circle" style="color:red;" aria-hidden="true"></i></td>';
                  }else
                  {
                      echo '<td style="text-align:center;"><i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i></td>';
                  }
                  echo '</tr>';
                  
             
           }
            }
            
            echo '</tbody>
            </table>
                    
                    </div>
                </div>
            </div>
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Info Kalender Untuk Melihat Rekap Presensi Selama Tahun Ini ('.$year.') Serta Libur Nasional Yang Di Approve, Terima Kasih.</a>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>