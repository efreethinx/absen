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
    
$chkPakh = $_POST['akh'];
$chkJudul = $_POST['judul'];
$dtAgenda = $_POST['agenda'];
$dtImage = $_POST['image'];
$dtmg = $_FILES["image"]["name"];


if ($chkPakh == 'AGKHP'){
    
    if (($dtAgenda == '' || $dtAgenda == null) || ($dtmg == '' || $dtmg == null) || ($chkJudul == '' || $chkJudul == null)){
        echo "
        <script>
            swal({title: 'Agenda Tidak Tersimpan', text:'Harap Periksa Kembali Agenda Kegiatan Harian Pegawai, Pastika Sudah Mengisi Kegiatan Dan Photo Kegiatan', icon: 'warning', timer: 9000,});
        </script>
        ";
    }else{
         $query="SELECT * FROM agenda_kegiatan WHERE employees = '$idx' AND 	tanggal = '$date' ORDER BY id DESC";
            $result = $connection->query($query);
            $countx = 0;
            if($result->num_rows > 0){
           while ($row= $result->fetch_assoc()) {
               
               
           }
            }
            
            $countLAKH = $result->num_rows;
            $countLAKHX = $countLAKH + 1;
            
           


//$filename =''.seo_title($row_user['employees_name']).'-in-'.$date.'-'.$row_user['id'].'.jpg';


$files = $_FILES["image"]["name"];
$lokasi_file = $_FILES['image']['tmp_name'];  
$ukuran_file = $_FILES['image']['size'];
$extension = getExtension($files);
$extension = strtolower($extension);
if($extension=="jpg" || $extension=="jpeg" ){$src = imagecreatefromjpeg($lokasi_file);}
else if($extension=="png"){$src = imagecreatefrompng($lokasi_file);}
else {$src = imagecreatefromgif($lokasi_file);}
list($width,$height)=getimagesize($lokasi_file);

$width_new  = 400;
$height_new = 300;
$ratio_ori  = $width / $height_new;
$tmp=imagecreatetruecolor($width_new,$height_new);
imagecopyresampled($tmp,$src,0,0,0,0,$width_new,$height_new,$width,$height);

$filename =''.seo_title($row_user['employees_name']).'-AKHP-'.$countLAKHX.'-'.$date.'-'.$row_user['id'].'.'.$extension;
$directory= $_SERVER['DOCUMENT_ROOT']."/content/agenda/".$filename;
imagejpeg($tmp,$directory,70);
// move_uploaded_file($lokasi_file, $directory);

//             $ekstensi_diperbolehkan	= array('png','jpg');
// 			$nama = $_FILES['image']['name'];
// 			$x = explode('.', $nama);
// 			$ekstensi = strtolower(end($x));
// 			$ukuran	= $_FILES['image']['size'];
// 			$file_tmp = $_FILES['image']['tmp_name'];
			
// 			$filename = $_SERVER['DOCUMENT_ROOT'].'/content/agenda/coba.jpg';
// // 			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
// 				// if($ukuran < 1044070){			
// 					move_uploaded_file($file_tmp, $filename);
// 				// }


 
                
                 $add ="INSERT INTO agenda_kegiatan (employees,
                            tanggal,
                            nama_kegiatan,
                            keterangan,
                            gambar,
                            point,
                            note) values('$idx',
                            '$date',
                            '$chkJudul',
                            '$dtAgenda',
                            '$filename',
                            '10',
                            'Ditinjau')";
                  
          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo "
        <script>
            swal({title: 'Error', text:'Terjadi Kegagalan Sistem', icon: 'error', timer: 9000,});
        </script>
        ";
          } else{
             echo "
        <script>
            swal({title: 'Sukses', text:'Berhasil Menambahkan Data Agenda Kegiatan Harian Pegawai Hari Ini, Terima Kasih', icon: 'success', timer: 9000,});
        </script>
        ";
        echo "<script>
                                                    setTimeout(function(){ 
                                                
                                                      window.location.href = './agenda';
                                                
                                                }, 2000);
                                                </script>";
        }
                
                
         
        
    }
    
    
}
  $query="SELECT * FROM agenda_kegiatan WHERE employees = '$idx' AND tanggal = '$date'";
            $result = $connection->query($query);
            $countx = 0;
            if($result->num_rows > 0){
           while ($row= $result->fetch_assoc()) {
               
           }
            }  
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
    <div class="section mt-2">
    <div class="card">
    <div class="card-body">
        <div class="text-center">
        
        <form enctype="multipart/form-data" method="POST">
<div class="col-12">
            <div class="form-group basic">
                <div class="input-wrapper">
                <div class="section-title">Agenda Kegiatan Kerja <br>'.format_hari_tanggal($date).'</div>
                <div class="input-group mt-2 mb-2 text-center">
                <input type="text" name="judul" class="form-control " value="" placeholder="Judul Kegiatan" required>
                </div>
                    <div class="input-group text-center">
                        <textarea class="text-center" name="agenda" required>
     Agenda Kegiatan Kerja '.$namauser.' Hari Ini '.format_hari_tanggal($date).' .
  </textarea>
                        <input type="text" style="display:none;" name="iduser" class="form-control " value="'.$row_user['id'].'">
                        <input type="text" style="display:none;" name="akh" class="form-control " value="AGKHP">
                    </div>
                    <div class="col-12 justify-content-between">
                    <input class="form-control mt-2" type="file" id="imgInp" accept="image/*" onchange="readURL(event)" name="image" capture required>
                    <img id="output" src="#" class="img-fluid mt-4" alt="Responsive image"><br>
           <button type="submit" class="btn btn-primary mt-2"><ion-icon name="checkmark-outline"></ion-icon>Buat Agenda Kegiatan</button>
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
            <div class="section-title">Riwayat Agenda Kegiatan<br><center>(Laporan AKHP Anda Hari Ini : '.$result->num_rows.')</center></div>
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="8" style="text-align:center;">Agenda Kegiatan Bulan '.$monthx.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Judul</th>
              <th style="text-align:center;">Agenda</th>
              <th style="text-align:center;">Status</th>
            </tr>
            </thead>
            <tbody>';
            
            //$FLTRX = $year . '-' . $month . '-';
            $query="SELECT * FROM agenda_kegiatan WHERE employees  = '$idx' AND tanggal LIKE '$year-$month%' ORDER BY id DESC";
            $result = $connection->query($query);
            $countx = 0;
            $validasixy = 0;
            $validasix = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               $countx++;
             $idx = $row['id'];
             $nama_kegiatan = $row['nama_kegiatan'];
             $pagenda = $row['gambar'];
             $tanggal = $row['tanggal'];
             $notex = $row['note'];

             
             $ktsx = null;
            echo '<tr>';
            
            
                 echo '<td class="text-center">'.$countx.'</td>'; 
             
             
                  $ttgl = explode("-", $tanggal);
                  $tanggal = $ttgl[2] . '-' . $ttgl[1] . '-' . $ttgl[0];
                  
                  echo '<td style="text-align:center;">'.$tanggal.'</td>';
                  echo '<td style="text-align:center;">'.$nama_kegiatan.'</td>';
                  echo '<td style="text-align:center;"><a class="image-link" href="../content/agenda/'.$pagenda.'" target="_blank">Photo</a></td>';
                //   echo '<td style="text-align:center;"><a href="../content/agenda/'.$pagenda.'">Photo</a></td>';
                  echo '<td style="text-align:center;">'.$notex.'</td>';
                  echo '</tr>';
                  
             
           }
            }
            
            echo '</tbody>
            </table>
                    
                    </div>
                </div>
            </div>
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Info Kegiatan Kerja Anda Setiap Dinas Kerja, Dilakukan Setiap Hari Saat Dinas Kerja Jika Tidak Mengisi Kegiatan Kerja Maka Tidak Belum Bisa Melakukan Presensi Pulang Pada Hari Tersebut. <i><strong>Agenda Kegiatan Harian Pegawai (AKHP)</strong></i>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>