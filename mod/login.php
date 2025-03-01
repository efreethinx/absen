<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
    // var_dump($_COOKIE['COOKIES_MEMBER']);
    // die;
if(!isset($_COOKIE['COOKIES_MEMBER'])){

$query = mysqli_query($connection, "SELECT max( employees_code) as kodeTerbesar FROM employees");
$data = mysqli_fetch_array($query);
$kode_karyawan = $data['kodeTerbesar'];
$urutan = (int) substr($kode_karyawan, 3, 3);
$urutan++;
$huruf = "OM";
$kode_karyawan = $huruf . sprintf("%03s", $urutan);

// $VersiAPP = $_GET['app'];
        
//         if ($VersiAPP == '2.7')
//         {
           
//         }else
//         {
//           echo '<script>alert("Applikasi Presensi Skensala Anda Adalah Versi Lama, Silahkan Update Ke Versi Terbaru Yaitu Versi 2.7")
//           window.location.href = "https://link.skensala.my.id/PRESENSI";
//           </script>'; 
           
           
//         }

 echo'
 
 <!-- App Capsule -->
    <div id="appCapsule">
        <div style="background:#007bff;border-radius:30px;margin:0 16px;padding:10px 15px" class="section text-center">
            <!--<h1 style="color:#FFFFFF;font-size:24px;"><i class="fa fa-user"></i> Login</h1>--!>
            <img src="'.$site_url.'/content/'.$site_logo.'" height="70">
            <h2 style="color:#FFFFFF;">Aplikasi Absensi Kehadiran Pegawai</h2>
        </div>
        <div class="section mb-5 p-2">
            <form id="form-login">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan E-mail" required>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
        
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-links mt-2">
                    <!--<div>
                        <a class="btn btn-primary" href="/registrasi"><i class="fa fa-user-plus"></i>&nbsp; Register</a>
                    </div>-->
                    <div>
                        <a class="btn btn-primary" href="."><i class="fa fa-refresh"></i>&nbsp; Refresh</a>
                    </div>
                    <div>
                        <a class="btn btn-warning" href="#"><i class="fa fa-key"></i>&nbsp; Reset Password</a>
                    </div>
                </div>

                

                <div class="form-button-group transparent">
                   <button type="submit" class="btn btn-success btn-block"><ion-icon name="log-in"></ion-icon> Login</button>
                   <!--<a href="oauth/google" class="btn btn-warning btn-block"><ion-icon name="logo-google"></ion-icon> Login with Google</a>-->
                </div>

            </form>
        </div>

    </div>
    
     <footer class="text-muted text-center">
    Developed by <a href="https://skensala.my.id/" rel="dofollow" target="_blank">FyOs</a> - <a href="https://skensala.my.id/" rel="dofollow" target="_blank">FyTeam</a> - <a class="credits" href="https://skensala.my.id" rel="nofollow" target="_blank">SKENSALA</a>
  </footer>
    <!-- * App Capsule -->';
    // var_dump($_COOKIE['COOKIES_MEMBER']);
    // // die;
}
  else{
      header('location:./home');
  }

  include_once 'mod/sw-footer.php';
} ?>