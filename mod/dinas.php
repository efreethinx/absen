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
        <div class="row text-center">
        
        <form action="" method="POST">
<div class="col-sm-4  col-md-4">
            <div class="form-group basic">
                <div class="input-wrapper">
                <div class="section-title">Pengajuan Dinas Luar <br>'.format_hari_tanggal($date).'</div>
                    <div class="input-group">
                        <input type="text" name="keterangan" class="form-control " value="" placeholder="Alasan Dinas Luar">
                        <input type="text" style="display:none;" name="iduser" class="form-control " value="'.$row_user['id'].'">
                        <input type="text" style="display:none;" name="tanggal" class="form-control " value="'.$date.'">
                        <input type="text" style="display:none;" name="pengajuan" class="form-control " value="4">
                    </div>
                    <div class="col-sm-4 col-md-4 justify-content-between">
           <button type="submit" class="btn btn-primary mt-1"><ion-icon name="checkmark-outline"></ion-icon>Ajukan Dinas Luar</button>
           </form><br>
           <span style="color:'.$stats.';">'.$infoxts.' <i class="'.$dtx.'" aria-hidden="true"></i></span>
           
           </div>

                </div>
            </div> 
        </div>
        </div>       
    </div>
    </div>
    </div>
    
    

        <div class="section mt-2">
            <div class="section-title">Pengajuan Dinas Luar</div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="8" style="text-align:center;">Pengajuan Dinas Luar Bulan '.$monthx.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Keterangan</th>
              <th style="text-align:center;">Status</th>
            </tr>
            </thead>
            <tbody>';
            
            $query="SELECT employees.*,pengajuan_dnl.*,position.* FROM employees, pengajuan_dnl,position WHERE employees.id = pengajuan_dnl.employess_id AND employees.position_id = position.position_id AND employees.id='$idtsx' AND pengajuan_dnl.tanggal LIKE '$year-$month%' ORDER By pengajuan_dnl.id DESC";
            $result = $connection->query($query);
            $countx = 0;
            $validasixy = 0;
            $validasix = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               $countx++;
             $idx = $row['id'];
             $nama = $row['employees_name'];
             $jabatan = $row['position_name'];
             $tanggal = $row['tanggal'];
             $pengajuan = $row['pengajuan'];
             $akses = $row['akses'];
             $keterangan = $row['keterangan'];
             
             $ktsx = null;
             if ($pengajuan =='4')
                  {
                      $ktsx='Dinas Luar';
                  }
                  else
                  {
                      $ktsx='Dirumahkan';
                  }
             $ktsy = null;
             if ($akses =='0')
                  {
                      $ktsy='Sudah Valid';
                  }
                  else
                  {
                      $ktsy='Belum Di Validasi';
                  }
            echo '<tr>';
            
             if ($akses == '0')
             {
                echo '<td class="text-center">'.$countx.'</td>'; 
             }else
             {
                 echo '<td class="text-center">'.$countx.'</td>'; 
             }
             
                  $ttgl = explode("-", $tanggal);
                  $tanggal = $ttgl[2] . '-' . $ttgl[1] . '-' . $ttgl[0];
                  
                  echo '<td style="text-align:center;">'.$tanggal.'</td>';
                  echo '<td style="text-align:center;">'.$jabatan.'</td>';
                  echo '<td style="text-align:center;">'.$keterangan.'</td>';
                  
                  if($akses== '0')
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
                <ion-icon name="alert-circle-outline"></ion-icon> Info Pengajuan Dinas Luar, Harap Hubungi Pihak Berwenang / Operator Untuk Validasi Pengajuan Dinas Luar</a>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>