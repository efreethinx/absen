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
    
    echo '<link rel="stylesheet" type="text/css" href="https://makitweb.com/demos/resources/select2/dist/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://makitweb.com/demos/resources/select2/dist/js/select2.min.js" type="text/javascript"></script>';
    
    
    
    $idx = $row_user['id'];
    $NPegawai1 = $_POST['pegawai1'];
    $NPegawai2 = $_POST['pegawai2'];
    
    if (($NPegawai1 == '' || $NPegawai1 == null ) || ($NPegawai2 == '' || $NPegawai2 == null)){
        
    }else if($NPegawai1 == 0 || $NPegawai2 == 0){
        
        echo "<script>
            swal({title: 'Info Sistem', text:'Maaf Untuk Pemilihan Pegawai Tidak Boleh Ada Yang Kosong Atau Belum Memilih. Silahkan Ulangi Kembali.', icon: 'warning', timer: 5000,});
        </script>";
        
    }else if($NPegawai1 == $NPegawai2 || $NPegawai2 == $NPegawai1){
        
        echo "<script>
            swal({title: 'Info Sistem', text:'Maaf Untuk Pemilihan Pegawai Tidak Boleh Dengan Orang Yang Sama, Harus Berbeda. Silahkan Ulangi Kembali.', icon: 'warning', timer: 5000,});
        </script>";
        
    }else
    {
        $query_absen="SELECT * FROM guru_terbaik WHERE employees_id = '$idx' and tanggal LIKE '$year%'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             echo "<script>
            swal({title: 'Info Sistem', text:'Anda Sudah Melakukan Penilaian Pegawai Terbaik Periode $year.', icon: 'error', timer: 5000,});
        </script>";
        
        // while ($row_absen= $result_absen->fetch_assoc()) {
        //     $DPegawai1 = $row_absen['pegawai1'];
        //     $DPegawai2 = $row_absen['pegawai1'];
        // }
        
        
        }else{
            
            $add ="INSERT INTO guru_terbaik (employees_id,
              pegawai1,
              pegawai2,
              tanggal) values('$idx',
              '$NPegawai1',
              '$NPegawai2',
              '$date')";
    if($connection->query($add) === false) {
        die($connection->error.__LINE__); 
        //echo'Data tidak berhasil disimpan!';
    } else{
        //echo'success';
        echo "<script>
            swal({title: 'Info Sistem', text:'Terima Kasih Sudah Memilih Pegawai Terbaik Periode $year.', icon: 'success', timer: 5000,});
        </script>";
    }
            
        }
    }
    
  $query_absen="SELECT * FROM guru_terbaik WHERE employees_id = '$idx' and tanggal LIKE '$year%'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
        while ($row_absen= $result_absen->fetch_assoc()) {
            $DPegawai1 = $row_absen['pegawai1'];
            $DPegawai2 = $row_absen['pegawai2'];
            }
        }

if (($DPegawai1 != '' || $DPegawai1 != null || $DPegawai1 != 0)||($DPegawai2 != '' || $DPegawai2 != null || $DPegawai2 != 0)){
    
    $Typs1 = 'disabled';
    $Typs2 = 'style="displaye:none;"';
    
    
}    
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
    <div class="section mt-2">
    <div class="card">
    <div class="card-body">
    <form action="" method="post">
        <div class="row text-center">
        <div class="col-sm-12 col-md-12">
            <div class="form-group basic">
                <div class="input-wrapper">
                <div class="section-title">Pemilihan Pegawai Terbaik '.$year.'<br> Menurut : <i><b><u>'.$row_user['employees_name'].'</i></b></u></div>
                <hr class="mb-2">
                <div class="alert alert-info mt-5 mb-2" role="alert">Pegawai Terbaik 1<br><ion-icon name="people-outline"></ion-icon> </a>
            </div>
                
                    <div class="input-group">';
                    echo '<select id="terbaik1" class="form-control" name="pegawai1" '.$Typs1.' required>';
                    echo'<option value="0">---Pilih Pegawai 1---</option>';
                    
                    $queryx="SELECT * FROM employees WHERE position_id = 1";
                  $resultx = $connection->query($queryx);
                    if($resultx->num_rows > 0){
                        $noxs=0;
                        while ($rowx= $resultx->fetch_assoc()) {
                            if($idx == $rowx['id']){
                                
                            }else{
                                if($DPegawai1 == $rowx['id']){
                                echo'<option value="'.$rowx['id'].'" selected>'.$rowx['employees_name'].'</option>';
                                }else{
                                echo'<option value="'.$rowx['id'].'">'.$rowx['employees_name'].'</option>';
                                }
                            }
                            
                            
                        }
                    }

                          echo '</select>
                        <div class="input-group-addon">
                            <!--<ion-icon name="calendar-outline"></ion-icon>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="col-sm-12 col-md-12 mt-2">
            <div class="form-group basic">
                <div class="input-wrapper">
                <hr>
                <div class="alert alert-info mt-5 mb-2" role="alert">Pegawai Terbaik 2<br><ion-icon name="people-outline"></ion-icon> </a>
            </div>
                    <div class="input-group">';
                        echo '<select id="terbaik2" class="form-control" name="pegawai2" '.$Typs1.' required>';
                    echo'<option value="0">---Pilih Pegawai 2---</option>';
                    
                    $queryx="SELECT * FROM employees WHERE position_id = 1";
                  $resultx = $connection->query($queryx);
                    if($resultx->num_rows > 0){
                        $noxs=0;
                        while ($rowx= $resultx->fetch_assoc()) {
                            if($idx == $rowx['id']){
                                
                            }else{
                                if($DPegawai2 == $rowx['id']){
                                echo'<option value="'.$rowx['id'].'" selected>'.$rowx['employees_name'].'</option>';
                                }else{
                                echo'<option value="'.$rowx['id'].'">'.$rowx['employees_name'].'</option>';
                                }
                            }
                        }
                    }

                          echo '</select>
                        <div class="input-group-addon">
                            <!--<ion-icon name="calendar-outline"></ion-icon>-->
                        </div>
                    </div>

                </div>
            </div> 
        </div>
        <div class="col-sm-12 col-md-12 justify-content-between mb-2">
           <button type="submit" class="btn btn-primary mt-1" '.$Typs2.' '.$Typs1.'><ion-icon name="checkmark-done-outline"></ion-icon> Kirim Penilaian</button>
           
           <button type="reset" class="btn btn-warning mt-1" value="Reset" '.$Typs1.'><ion-icon name="code-working-outline"></ion-icon> Reset</button>
           
           </form>
        </div>
        

                
            
        
        </div>       
    </div>
    </div>
    </div>
    
    

        <div class="section mt-2">
            <!--<div class="section-title">Data Absensi</div>-->
            <div class="card">
                <div class="table-responsive">
                    
                </div>
            </div>
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Harap Memilih Sesuai Pendapat Diri Anda Sendiri, Beserta Sesuai Dengan Fakta Keadaan Yang Ada Di Instansi Anda. Setelah Mengirim Penilaian Maka Tidak Bisa Diubah Dan Menilai Lagi, Jadi Harap Dipahami, Terima Kasih!</a>
            </div>
            
           
            
        </div>
    

        



        

</div>';

echo '<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#terbaik1").select2();
            $("#terbaik2").select2();

            // Read selected option
           
        });
        </script>';

  }
  include_once 'mod/sw-footer.php';
} ?>