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
    
    
    
$dtBulan = ambilbulan(date('m'));
    $idx = $row_user['id'];
    
   $nilaix1 = $_POST['nilaix1'];
   $nilaiy1 = $_POST['nilaiy1'];
   $nilaiz1 = $_POST['nilaiz1'];
   $nilaixy1 = $_POST['nilaixy1'];
   $nilaixz1 = $_POST['nilaixz1'];
   
   $nilaix2 = $_POST['nilaix2'];
   $nilaiy2 = $_POST['nilaiy2'];
   $nilaiz2 = $_POST['nilaiz2'];
   $nilaixy2 = $_POST['nilaixy2'];
   $nilaixz2 = $_POST['nilaixz2'];
 
   $nilaix3 = $_POST['nilaix3'];
   $nilaiy3 = $_POST['nilaiy3'];
   $nilaiz3 = $_POST['nilaiz3'];
   $nilaixy3 = $_POST['nilaixy3'];
   $nilaixz3 = $_POST['nilaixz3'];
   
   
   $nilai1 = $nilaix1 . '-' . $nilaiy1 . '-' . $nilaiz1 . '-' . $nilaixy1 . '-' . $nilaixz1;
   
   $nilai2 = $nilaix2 . '-' . $nilaiy2 . '-' . $nilaiz2 . '-' . $nilaixy2 . '-' . $nilaixz2;
   
   $nilai3 = $nilaix3 . '-' . $nilaiy3 . '-' . $nilaiz3 . '-' . $nilaixy3 . '-' . $nilaixz3;
   
   
   $dtP = null;
//   $dtP2 = 0;
//   $dtP3 = 0;
   
   $dtN = null;
//   $dtN2 = 0;
//   $dtN3 = 0;

if(($nilaix1 == '0' || $nilaiy1 == '0' || $nilaiz1 =='0' || $nilaixy1 =='0' || $nilaixz1 == '0') || ($nilaix2 == '0' || $nilaiy2 == '0' || $nilaiz2 =='0' || $nilaixy2 =='0' || $nilaixz2 == '0') ||  ($nilaix3 == '0' || $nilaiy3 == '0' || $nilaiz3 =='0' || $nilaixy3 =='0' || $nilaixz3 == '0'))
{
    echo "<script>
            swal({title: 'Info Sistem', text:'Penilaian Rekan Kerja Masih Ada Yang Belum Terisi, Harap Check Kembali Sebelum Mengirim Penilaian.', icon: 'warning', timer: 5000,});
        </script>";
}
   
   if(($nilaix1 == '0' || $nilaiy1 == '0' || $nilaiz1 =='0' || $nilaixy1 =='0' || $nilaixz1 == '0') || ($nilaix1 == null || $nilaiy1 == null || $nilaiz1 == null || $nilaixy1 == null || $nilaixz1 ==  null) || ($nilaix2 == '0' || $nilaiy2 == '0' || $nilaiz2 =='0' || $nilaixy2 =='0' || $nilaixz2 == '0') || ($nilaix2 == null || $nilaiy2 == null || $nilaiz2 == null || $nilaixy2 == null || $nilaixz2 ==  null) || ($nilaix3 == '0' || $nilaiy3 == '0' || $nilaiz3 =='0' || $nilaixy3 =='0' || $nilaixz3 == '0') || ($nilaix3 == null || $nilaiy3 == null || $nilaiz3 == null || $nilaixy3 == null || $nilaixz3 ==  null) ){
       
   }else{
       $query_absen="SELECT * FROM link_nilai WHERE employees_id = '$idx' AND nilai1 !='' AND nilai2 != '' AND nilai3 != ''";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
            echo "<script>
            swal({title: 'Info Sistem', text:'Anda Sudah Melakukan Penilaian Kinerja Pada Rekan Pegawai Anda Untuk Bulan Ini.', icon: 'error', timer: 5000,});
        </script>";
        }else{
            
            $update ="UPDATE link_nilai SET nilai1='$nilai1', nilai2='$nilai2', nilai3='$nilai3' WHERE employees_id='$idx'";
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        //echo'Penyetelan password baru gagal, silahkan nanti coba kembali!';
        
        echo "<script>
            swal({title: 'Info Sistem', text:'Maaf Gagal Untuk Menilai Rekan Kerja Pegawai.', icon: 'error', timer: 5000,});
        </script>";
        
    } else{
         echo "<script>
            swal({title: 'Info Sistem', text:'Berhasil Untuk Menilai Rekan Kerja Pegawai.', icon: 'success', timer: 5000,});
        </script>";
    }
            
        }
   }
   
   $query_absen="SELECT * FROM link_nilai WHERE employees_id = '$idx'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                $dtP[] = $row_absen['user1'];
                array_push($dtP);
                $dtP[] = $row_absen['user2'];
                array_push($dtP);
                $dtP[] = $row_absen['user3'];
                array_push($dtP);
               
                $dtN[] = $row_absen['nilai1'];
                array_push($dtN);
                $dtN[] = $row_absen['nilai2'];
                array_push($dtN);
                $dtN[] = $row_absen['nilai3'];
                array_push($dtN);
                
             }
        }
        
        // $HNilai1 = (explode("-",$dtN[0]));
        // $HNilai2 = (explode("-",$dtN[1]));
        // $HNilai3 = (explode("-",$dtN[2]));
        
        $HNilai[0] = (explode("-",$dtN[0]));
        $HNilai[1] = (explode("-",$dtN[1]));
        $HNilai[2] = (explode("-",$dtN[2]));
        
        //echo '<script>alert('.$HNilai[0][0].');</script>';
        //print_r($dtN);
        
    
    //$dtf[] = null;
    if ($dtN[0] != ''){
        $dtf[] = 'disabled';
        array_push($dtf);
    }else{
        $dtf[] = '';
        array_push($dtf);
    }
    if ($dtN[1] != ''){
        $dtf[] = 'disabled';
        array_push($dtf);
    }else{
        $dtf[] = '';
        array_push($dtf);
    }
    if ($dtN[2] != ''){
        $dtf[] = 'disabled';
        array_push($dtf);
    }else{
        $dtf[] = '';
        array_push($dtf);
    }
    
    if ($dtf[2] == 'disabled')
    {
        $btnx = 'style="display: none;" disabled';
        $btnN = 'Anda Sudah Melakukan Penilaian';
        $drts = 1;
    }else
    {
        $btnN = 'Kirim Penilaian Rekan Pegawai';
        $drts = 0;
    }
    
     //echo '<script>alert("'.$dtf[0].'");</script>';
     //echo '<script>alert('.$dtN[0].');</script>';
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
    <div class="section mt-2">
    <div class="card">
    <div class="card-body">
        <div class="row text-center">
        <span align="center" class="alert badge-danger text-center"><ion-icon name="pencil-outline"></ion-icon> Penilaian Rekan Pegawai '.ambilbulan(date('m')).' '.date('Y').'</span>
        <hr>
        ';
                    
                    $tarray = count($dtP);
                        for($i=0;$i <$tarray ;$i++){
                        $query_absen="SELECT * FROM employees WHERE id = '$dtP[$i]'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 echo '
                 
                 <div class="col-12 mt-3">
                 <div class="stat-box bg-info">
                 <div class="title text-white text-center">
                    Penilaian Rekan Ke - '.($i + 1).'
                 </div>
                 </div>
                 </div>
                 
                 
                 <div class="col-sm-12 col-md-12">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <div class="input-group">
                    <form action="" method="POST">
                 <input type="text" class="form-control text-center" name="namaPegawai" value="'.$row_absen['employees_name'].'" placeholder="Nama Pegawai" readonly>
                 <div class="input-group-addon">
                            <ion-icon name="man-outline"></ion-icon>
                        </div>
    
                    </div><br>
                    <div class="avatar-section">
                    <img src="timthumb?src=https://absensi.leuwimunding.my.id/content/karyawan/'.$row_absen['photo'].'&amp;h=100&amp;w=105" alt="avatar" class="imaged w170">
                    </div>
                    <p class="text-center">';
                    if ($row_absen['position_id'] == '1'){
                        $jabatan = 'GURU';
                        echo $jabatan;
                    }else
                    {
                        $jabatan = 'TU';
                        echo $jabatan;
                    }
                    echo '<hr style="border-radius: 5px;">';
                    echo'</p>';
                    
                    echo'<p class="text-left" style="color:#000000">1. Menurut Anda Bagaimanakah Tingkat Kerajinan Dari <b><u>'.$row_absen['employees_name'].'</b></u> Ini ?</p>';
                    
                    echo'<select class="form-control" name="nilaix'.($i + 1).'"  '.$dtf[$i].'>
                        <option '; if ($HNilai[$i][0] == '' || $HNilai[$i][0]){ echo 'selected';} echo' value="0">--Pilih Jawaban--</option>
                        <option '; if ($HNilai[$i][0] == '4'){ echo 'selected';} echo' value="4">Sangat Rajin</option>
                        <option '; if ($HNilai[$i][0] == '3'){ echo 'selected';} echo' value="3">Rajin</option>
                        <option '; if ($HNilai[$i][0] == '2'){ echo 'selected';} echo' value="2">Kurang Rajin</option>
                        <option '; if ($HNilai[$i][0] == '1'){ echo 'selected';} echo' value="1">Sangat Tidak Rajin</option>
                    </select>
                    <hr>';
                    
                    echo'<p class="text-left" style="color:#000000">2. Menurut Anda Bagaimanakah Tingkat Tanggung Jawab Dari <b><u>'.$row_absen['employees_name'].'</b></u> Ini ?</p>';
                    echo'<select class="form-control" name="nilaiy'.($i + 1).'" '.$dtf[$i].'>
                        <option '; if ($HNilai[$i][1] == '' || $HNilai[$i][1]){ echo 'selected';} echo' value="0">--Pilih Jawaban--</option>
                        <option '; if ($HNilai[$i][1] == '4'){ echo 'selected';} echo' value="4">Sangat Bertanggung Jawab</option>
                        <option '; if ($HNilai[$i][1] == '3'){ echo 'selected';} echo' value="3">Bertanggung Jawab</option>
                        <option '; if ($HNilai[$i][1] == '2'){ echo 'selected';} echo' value="2">Kurang Bertanggung Jawab</option>
                        <option '; if ($HNilai[$i][1] == '1'){ echo 'selected';} echo' value="1">Sangat Tidak Bertanggung Jawab</option>
                    </select>
                    <hr>';
                   
                    echo'<p class="text-left" style="color:#000000">3. Menurut Anda Apakah <b><u>'.$row_absen['employees_name'].'</b></u> Ini Kompeten ?</p>';
                    echo'<select class="form-control" name="nilaiz'.($i + 1).'" '.$dtf[$i].'>
                        <option '; if ($HNilai[$i][2] == '' || $HNilai[$i][2]){ echo 'selected';} echo' value="0">--Pilih Jawaban--</option>
                        <option '; if ($HNilai[$i][2] == '4'){ echo 'selected';} echo' value="4">Sangat Kompeten</option>
                        <option '; if ($HNilai[$i][2] == '3'){ echo 'selected';} echo' value="3">Kompeten</option>
                        <option '; if ($HNilai[$i][2] == '2'){ echo 'selected';} echo' value="2">Kurang Kompeten</option>
                        <option '; if ($HNilai[$i][2] == '1'){ echo 'selected';} echo' value="1">Sangat Tidak Kompeten</option>
                    </select>
                    <hr>';
                    
                    echo'<p class="text-left" style="color:#000000">4. Menurut Anda Apakah <b><u>'.$row_absen['employees_name'].'</b></u> Ini Mempunyai Team Work Yang Bagus ?</p>';
                    echo'<select class="form-control" name="nilaixy'.($i + 1).'" '.$dtf[$i].'>
                        <option '; if ($HNilai[$i][3] == '' || $HNilai[$i][3]){ echo 'selected';} echo' value="0">--Pilih Jawaban--</option>
                        <option '; if ($HNilai[$i][3] == '4'){ echo 'selected';} echo' value="4">Sangat Bagus</option>
                        <option '; if ($HNilai[$i][3] == '3'){ echo 'selected';} echo' value="3">Bagus</option>
                        <option '; if ($HNilai[$i][3] == '2'){ echo 'selected';} echo' value="2">Kurang Bagus</option>
                        <option '; if ($HNilai[$i][3] == '1'){ echo 'selected';} echo' value="1">Sangat Tidak Bagus</option>
                    </select>
                    <hr>';
                    
                    echo'<p class="text-left" style="color:#000000">5. Menurut Anda Apakah <b><u>'.$row_absen['employees_name'].'</b></u> Ini Mempunyai Kecakapan Dalam Hal Managerial ?</p>';
                    echo'<select class="form-control" name="nilaixz'.($i + 1).'" '.$dtf[$i].'>
                        <option '; if ($HNilai[$i][4] == '' || $HNilai[$i][4]){ echo 'selected';} echo' value="0">--Pilih Jawaban--</option>
                        <option '; if ($HNilai[$i][4] == '4'){ echo 'selected';} echo' value="4">Sangat Cakap</option>
                        <option '; if ($HNilai[$i][4] == '3'){ echo 'selected';} echo' value="3">Cukup</option>
                        <option '; if ($HNilai[$i][4] == '2'){ echo 'selected';} echo' value="2">Kurang Cakap</option>
                        <option '; if ($HNilai[$i][4] == '1'){ echo 'selected';} echo' value="1">Sangat Tidak Cakap</option>
                    </select>
                   
                </div>
            </div>
        </div>';
                 
                 
             }
        }
                            
                            
                        }
                    
                    
                        
                        echo '

        
        <div class="col-sm-12 col-md-12 justify-content-between">
           <button type="submit" class="btn btn-primary mt-1 btn-sortir" '.$btnx.'><ion-icon name="checkmark-outline"></ion-icon>'.$btnN.'</button>
           </form>';
           
           if ($drts == 1)
           {
              echo '<button type="button" class="btn btn-primary mt-1 btn-sortir" disabled><ion-icon name="checkmark-outline"></ion-icon>Anda Sudah Melakukan Penilaian</button>' ;
           }
           
        echo '</div>
        

                
            
        
        </div>       
    </div>
    </div>
    </div>';
    $TNilai1 = 0;
    $TNilai2 = 0;
    $TNilai3 = 0;
    $query_absen="SELECT * FROM link_nilai WHERE user1 = '$idx' OR user2 = '$idx' OR user3 = '$idx' ";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $dtUser1 = $row_absen['user1'];
                 $dtUser2 = $row_absen['user2'];
                 $dtUser3 = $row_absen['user3'];
                 
                 
                 if ( $dtUser1 == $idx){
                     //$dtNilai1 = $row_absen['nilai1'];
                     $TNilai1 = (explode("-",$row_absen['nilai1']));
                     $dtNilai[] = $TNilai1[0] + $TNilai1[1] + $TNilai1[2] + $TNilai1[3] + $TNilai1[4];
                     array_push($dtNilai);
                 }
                 
                 if ( $dtUser2 == $idx){
                     //$dtNilai1 = $row_absen['nilai1'];
                     $TNilai2 = (explode("-",$row_absen['nilai2']));
                     $dtNilai[] = $TNilai2[0] + $TNilai2[1] + $TNilai2[2] + $TNilai2[3] + $TNilai2[4];
                     array_push($dtNilai);
                 }
                 
                 if ( $dtUser3 == $idx){
                     //$dtNilai1 = $row_absen['nilai1'];
                     $TNilai3 = (explode("-",$row_absen['nilai3']));
                     $dtNilai[] = $TNilai3[0] + $TNilai3[1] + $TNilai3[2] + $TNilai3[3] + $TNilai3[4];
                     array_push($dtNilai);
                 }
                 
                 
                 
             }
        }
        
     if ($dtNilai[0] >= 18){
         $HPredikat1 = "Sangat Baik" ;
         $Ntype1 = "badge-success";
     }else if($dtNilai[0] >= 15)
     {
         $HPredikat1 = "Baik" ;
         $Ntype1 = "badge-info";
     }else if($dtNilai[0] >= 10)
     {
         $HPredikat1 = "Kurang" ;
         $Ntype1 = "badge-warning";
     }else
     {
         $HPredikat1 = "Sangat Kurang" ;
         $Ntype1 = "badge-danger";
     }
     
     if ($dtNilai[1] >= 18){
         $HPredikat2 = "Sangat Baik" ;
         $Ntype2 = "badge-success";
     }else if($dtNilai[1] >= 15)
     {
         $HPredikat2 = "Baik" ;
         $Ntype2 = "badge-info";
     }else if($dtNilai[1] >= 10)
     {
         $HPredikat2 = "Kurang" ;
         $Ntype2 = "badge-warning";
     }else
     {
         $HPredikat2 = "Sangat Kurang" ;
         $Ntype2 = "badge-danger";
     }
     
     if ($dtNilai[2] >= 18){
         $HPredikat3 = "Sangat Baik" ;
         $Ntype3 = "badge-success";
     }else if($dtNilai[2] >= 15)
     {
         $HPredikat3 = "Baik" ;
         $Ntype3 = "badge-info";
     }else if($dtNilai[2] >= 10)
     {
         $HPredikat3 = "Kurang" ;
         $Ntype3 = "badge-warning";
     }else
     {
         $HPredikat3 = "Sangat Kurang" ;
         $Ntype3 = "badge-danger";
     }
     
     $NNNotif = null;
     $TTyps = null;
     if ($HPredikat1 == 'Sangat Baik' || $HPredikat2 == 'Sangat Baik' || $HPredikat3 == 'Sangat Baik'){
         $TTyps = 'alert-success';
         $NNNotif = 'Terus Bekerja Dengan Baik Dan Menjaga Kualitas';
         
     }else if($HPredikat1 == 'Baik' || $HPredikat2 == 'Baik' || $HPredikat3 == 'Baik'){
         $TTyps = 'alert-info';
         $NNNotif = 'Terus Tingkatkan Kinerja Anda Agar Lebih Baik Dan Kualitas Terbaik';
     }else if ($HPredikat1 == 'Kurang' || $HPredikat2 == 'Kurang' || $HPredikat3 == 'Kurang'){
         $TTyps = 'alert-warning';
         $NNNotif = 'Terus Tingkatkan Kinerja Anda Agar Lebih Baik Dan Evaluasi Diri Agar Menjadi Lebih Baik Dan Kompeten';
         }else{
         $TTyps = 'alert-danger';
         $NNNotif = 'Harus Lebih Meningkatkan Kinerja Anda Agar Lebih Baik Dan Evaluasi Diri Agar Menjadi Lebih Baik Dan Kompeten';
     }
    
    
    if ($dtNilai[0] == 0){
        $HPredikat1 = 'Rekan Belum Menilai';
        $Ntype1 = "badge-secondary";
    }
    if ($dtNilai[1] == 0){
        $HPredikat2 = 'Rekan Belum Menilai';
        $Ntype2 = "badge-secondary";
    }
    if ($dtNilai[2] == 0){
        $HPredikat3 = 'Rekan Belum Menilai';
        $Ntype3 = "badge-secondary";
    }
    
    if ($dtNilai[0] == 0 || $dtNilai[1] == 0 || $dtNilai[2] ==0){
        $NNNotif = 'Menunggu Rekan Anda Untuk Melakukan Penilaian Terhadap Anda!';
        $TTyps = 'alert-success';
    }
    

        echo '<div class="section mt-2">';
        
        $X1 = ($dtNilai[0] /20)*100;
        $X2 = ($dtNilai[1] /20)*100;
        $X3 = ($dtNilai[2] /20)*100;
        
        echo'
        <div class="section-title">Hasil Penilaian Rekan Lain Ke Anda</div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table rounded dataTable no-footer"  role="grid">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Penilai Ke-1</th>
                            <th class="text-center">Penilai Ke-2</th>
                            <th class="text-center">Penilai Ke-3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center"><span class="badge '.$Ntype1.'">'.$dtNilai[0].'/20 ('.number_format($X1,0).'%)</span></td>
                            <td class="text-center"><span class="badge '.$Ntype2.'">'.$dtNilai[1].'/20 ('.number_format($X2,0).'%)</span></td>
                            <td class="text-center"><span class="badge '.$Ntype3.'">'.$dtNilai[2].'/20 ('.number_format($X3,0).'%)</span></td>
                        </tr>
                        <thead>
                        <tr>
                            <th colspan="4" class="text-center">PREDIKAT</th>
                        </tr>
                    </thead>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">'.$HPredikat1.'</th>
                            <th class="text-center">'.$HPredikat2.'</th>
                            <th class="text-center">'.$HPredikat3.'</th>
                        </tr>
                    </thead>
                    </tbody>
                    
                    </table>
                    
                    
                    
                </div>
                
            </div>
            <div class="alert '.$TTyps.' mt-2" role="alert">
                <ion-icon name="reader-outline"></ion-icon> '.$NNNotif.'!
            </div>';
            
            echo'
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Penilaian Rekan Kerja Pegawai Dilakukan 1 Bulan Sekali Kepada 3 Orang Pegawai Di Instansi Secara Acak. Berikan Penilaian Sesuai Dengan Pendapat Dan Kenyataan Yang Ada Di Instansi, Setelah Meng-Klik Tombol Kirim Maka Tidak Bisa Melakukan Edit Atau Me-Reset Ulang Penilaian, Jadi Harap Di Pahami!
            </div>
        </div>
    

        



        

</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>