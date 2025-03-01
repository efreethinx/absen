<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
if(!isset($_COOKIE['COOKIES_MEMBER'])){
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        session_destroy();
        header("location:./");
}else{
  echo'<!-- App Capsule -->
    <div id="appCapsule">
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <input type="file" class="upload" name="file" id="avatar" accept=".jpg, .jpeg, ,gif, .png" capture="camera">
                <a href="#">';
                if($row_user['photo'] ==''){
                echo'<img src="'.$base_url.'content/avatar.jpg" alt="image" class="imaged w100 rounded">';
                }else{
                    echo'
                    <img src="timthumb?src='.$base_url.'content/karyawan/'.$row_user['photo'].'&amp;h=100&amp;w=105" alt="avatar" class="imaged w100 rounded">';}
                        echo'
                    <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span>
                </a>
            </div>
        </div>

        <div class="section mt-2 mb-2">
            <div class="section-title">Profil</div>
            <div class="card">
                <div class="card-body">
                    <form id="update-profile">
                    <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">NIP</label>
                                <input type="text" class="form-control" value="'.$row_user['nip'].'" style="background:#eeeeee" disabled>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Email</label>
                                <input type="text" class="form-control" value="'.$row_user['employees_email'].'" style="background:#eeeeee" disabled readonly>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Nama</label>
                                <input type="text" class="form-control" id="name" name="employees_name" value="'.$row_user['employees_name'].'" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="nohp">No. Handphone</label>
                                <input type="text" class="form-control" id="nohp" name="nohp" value="'.$row_user['nohp'].'" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="nohp">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>'.$row_user['alamat'].'</textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jenis Kelamin</label>
                                <select class="form-control custom-select" name="jk">
                                <option value="1"'; if ($row_user['jk'] == '1'){echo "selected";} echo'>LAKI-LAKI</option>
                                <option value="2"'; if ($row_user['jk'] == '2'){echo "selected";} echo'>PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Tanggal Lahir</label>
                             <input type="text" name="tglhr" class="form-control datepicker" value="'.$row_user['tglhr'].'">
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jabatan</label>
                                <select class="form-control custom-select" name="position_id" disabled>';
                                      $query="SELECT * from position order by position_name ASC";
                                      $result = $connection->query($query);
                                      while($rowa = $result->fetch_assoc()) { 
                                      if($rowa['position_id'] == $row_user['position_id']){
                                        echo'<option value="'.$rowa['position_id'].'" selected>'.$rowa['position_name'].'</option>';
                                      }else{
                                        echo'<option value="'.$rowa['position_id'].'">'.$rowa['position_name'].'</option>';
                                      }
                                      }echo'
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="nohp">'; if ($row_user['position_id'] == 1){echo "Mata Pelajaran";}else{echo "Bidang";} echo'</label>';
                                if ($row_user['position_id'] == 1){
                                echo'<select id="selMapel" class="form-control month" name="bidang" required>
                                    <option value="0"'; if ($row_user['bidang'] == "-"){ echo "selected";} echo'>-Mata Pelajaran-</option>
                                    <option value="1"'; if ($row_user['bidang'] == "1"){ echo "selected";} echo'>Produktif MM</option>
                                    <option value="2"'; if ($row_user['bidang'] == "2"){ echo "selected";} echo'>Produktif TKJ</option>
                                    <option value="3"'; if ($row_user['bidang'] == "3"){ echo "selected";} echo'>Produktif AKL</option>
                                    <option value="4"'; if ($row_user['bidang'] == "4"){ echo "selected";} echo'>Produktif BDP</option>
                                    <option value="5"'; if ($row_user['bidang'] == "5"){ echo "selected";} echo'>Produktif OTKP</option>
                                    <option value="6"'; if ($row_user['bidang'] == "6"){ echo "selected";} echo'>Agama ISLAM</option>
                                    <option value="7"'; if ($row_user['bidang'] == "7"){ echo "selected";} echo'>Bahasa Indonesia</option>
                                    <option value="8"'; if ($row_user['bidang'] == "8"){ echo "selected";} echo'>Bahasa Inggris</option>
                                    <option value="9"'; if ($row_user['bidang'] == "9"){ echo "selected";} echo'>Bahasa Jepang</option>
                                    <option value="10"'; if ($row_user['bidang'] == "10"){ echo "selected";} echo'>Bahasa Sunda</option>
                                    <option value="11"'; if ($row_user['bidang'] == "11"){ echo "selected";} echo'>Matematika</option>
                                    <option value="12"'; if ($row_user['bidang'] == "12"){ echo "selected";} echo'>PJOK</option>
                                    <option value="13"'; if ($row_user['bidang'] == "13"){ echo "selected";} echo'>PLH</option>
                                    <option value="14"'; if ($row_user['bidang'] == "14"){ echo "selected";} echo'>PPKN</option>
                                    <option value="15"'; if ($row_user['bidang'] == "15"){ echo "selected";} echo'>Sejarah Indonesia</option>
                                    <option value="16"'; if ($row_user['bidang'] == "16"){echo "selected";} echo'>Seni Budaya</option>
                                    <option value="17"'; if ($row_user['bidang'] == "17"){echo "selected";} echo'>Tata Usaha</option>
                                    <option value="18"'; if ($row_user['bidang'] == "18"){echo "selected";} echo'>Bimbingan Dan Konseling</option>
                                    <option value="19"'; if ($row_user['bidang'] == "19"){echo "selected";} echo'>Produktif TKRO</option>
                                    <option value="20"'; if ($row_user['bidang'] == "20"){echo "selected";} echo'>Produktif RPL</option>
                                    <option value="21"'; if ($row_user['bidang'] == "21"){echo "selected";} echo'>Tata Boga</option>
                                    <option value="22"'; if ($row_user['bidang'] == "22"){echo "selected";} echo'>PKK</option>
                                    <option value="23"'; if ($row_user['bidang'] == "23"){echo "selected";} echo'>Kimia</option>
                                    <option value="24"'; if ($row_user['bidang'] == "24"){echo "selected";} echo'>Fisika</option>
                                </select>';
                                }else{
                                    echo'<select id="selMapel" class="form-control month" name="bidang" required>
                                    <option value="0"'; if ($row_user['bidang'] == "-"){ echo "selected";} echo'>-Bidang-</option>
                                    <option value="17"'; if ($row_user['bidang'] == "17"){echo "selected";} echo'>Tata Usaha</option>
                                </select>';
                                    
                                }
                                echo'<i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Shift</label>
                                <select class="form-control custom-select" name="shift_id" disabled>';
                                     $query="SELECT shift_id,shift_name from shift order by shift_name ASC";
                                      $result = $connection->query($query);
                                      while($rowa = $result->fetch_assoc()) {
                                      if($rowa['shift_id'] == $row_user['shift_id']){ 
                                        echo'<option value="'.$rowa['shift_id'].'" selected>'.$rowa['shift_name'].'</option>';
                                      }else{
                                        echo'<option value="'.$rowa['shift_id'].'">'.$rowa['shift_name'].'</option>';
                                      }
                                      }echo'
                                </select>
                            </div>
                        </div>


                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="password4">Lokasi Penempatan</label>
                                <select class="form-control custom-select" name="building_id" disabled>';
                                $query  ="SELECT building_id,name,address from building";
                                $result = $connection->query($query);
                                while($row = $result->fetch_assoc()) {
                                    if($row['building_id'] == $row_user['building_id']){ 
                                        echo'<option value="'.$row['building_id'].'" selected>'.$row['name'].'</option>';
                                    }else{
                                        echo'<option value="'.$row['building_id'].'">'.$row['name'].'</option>';
                                    }
                                }echo'
                                </select>
                            </div>
                        </div>

                        <hr>
                            <button type="submit" class="btn btn-primary mr-1 btn-block btn-profile">Simpan</button>
                        
                    </form>

                </div>
            </div>
        </div>

      
        <div class="section mt-2 mb-2">
            <div class="section-title">Update Password</div>
            <div class="card">
                <div class="card-body">
                    <form id="update-password">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Email</label>
                                <input type="email" class="form-control" name="employees_email" value="'.$row_user['employees_email'].'" style="background:#eeeeee" readonly>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Password baru</label>
                                <input type="password" class="form-control" name="employees_password" id="employees_password" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary mr-1 btn-block">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
        
    </div>
    <!-- * App Capsule -->
    
';

  }
  include_once 'mod/sw-footer.php';
} ?>