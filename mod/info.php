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
   
   
   $namaSaya = $row_user['employees_name'];
   
   $idPegawai = $_POST['idPegawai'];
   $bulanchek = $_POST['bulanchek'];
   
   if ($idPegawai == '' || $idPegawai == null){
       
       ?>
        <script>
        window.location.replace("https://presensi.skensala.tech/login&app=2.7");
        </script>
       <?php
       
   }else{
       
   }
    
    $checkhari = hari();
   
    
    //$filter ="MONTH(presence_date) ='$month'";
    //$namauser = $row_user['employees_name'];
    $idtsx = $row_user['id'];
    $infoxts= null;
    $stats = null;
    $dtx = null;
    
$hri = $_POST['hari'] ;
$bln = $_POST['bulan'] ;
$thnn = $_POST['tahun'] ;

  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);
  
  $query_absen="SELECT * FROM employees WHERE id = $idPegawai";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $NamaPegawaix = $row_absen['employees_name'];
                 $Jabatanx = $row_absen['position_id'];
                 $Shiftx = $row_absen['shift_id'];
                 $Ruanganx = $row_absen['building_id'];
                 $JKx = $row_absen['jk'];
                 $JKt = $row_absen['jk'];
                 $Alamatx = $row_absen['alamat'];
                 $Bidangx = $row_absen['bidang'];
                 
                 if($JKx == 1){
                     $JKx = "Bapak";
                 }else{
                     $JKx = "Ibu";
                 }
                 
                 $NoHP = $row_absen['nohp'];
                 $Tglhrx = $row_absen['tglhr'];
                 $Emailx = $row_absen['employees_email'];
                 $NIPx = $row_absen['nip'];
                 $Photox = $row_absen['photo'];
             }
        }
  
  

$tgglx = $thnn . '-' . $bln . '-' . $hri ;
// echo 'Nih :'.$hri;

if ($tgglx == '' || $tgglx == null || $tgglx == '--')
{
   $tgglx =  $date;
}
    
$blnx = null;
            
$rbtgl = explode("-", $tgglx);

$nxtgl = $rbtgl[2];
//2022-01-10
$tggly = $rbtgl[0] . "-" . $rbtgl[1] . "-1";



if ($bulanchek != '' || $bulanchek != null){
    $tggly = $year . "-" . $bulanchek . "-1";
    $a_date = $tggly;
    $lastDateOfMonth =  date("Y-m-t", strtotime($a_date));

    $tgglx = $lastDateOfMonth;
    
    $month = $bulanchek;
    
    $fflter = "presence.presence_date LIKE '$year-$bulanchek%'";
    $tglFLibur = $bulanchek . "-" . $year;
    
     $ttlLBR = 0;
      $query1 = "SELECT * FROM libur_kerja WHERE tanggal_libur LIKE '%$tglFLibur'";
$result1 = $connection->query($query1);
  if($result1->num_rows > 0){
      while ($row1= $result1->fetch_assoc()) {
          $ttlLBR += $row1['lama_libur'];
          //echo $ttlLBR;
      }
  }
    
    $WeekDay = (countWork($year,$bulanchek,array(0,6)) - $ttlLBR);
    
}else{
    $fflter = "presence.presence_date BETWEEN '$tggly' AND '$tgglx'";
    $tglFLibur = $rbtgl[1] . "-" . $rbtgl[0];
    
     $ttlLBR = 0;
      $query1 = "SELECT * FROM libur_kerja WHERE tanggal_libur LIKE '%$tglFLibur'";
$result1 = $connection->query($query1);
  if($result1->num_rows > 0){
      while ($row1= $result1->fetch_assoc()) {
          $ttlLBR += $row1['lama_libur'];
          //echo $ttlLBR;
      }
  }
    
    $WeekDay = (countWork($year,$month,array(0,6)) - $ttlLBR);
}
    
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
    
    $checkhari = hari();
    if ($checkhari =='Sabtu' || $checkhari =='Minggu'){
        $infoHRekan = 'Tidak Ada Presensi Hari Ini,<br> Dikarenakan Sekarang Adalah Hari <b><i><u>'.$checkhari.'</u></i></b> Yaitu Libur Akhir Pekan. <br> Selamat Berlibur <b><i><u>'.$namauser.'</u></i></b>';
    }else{
     $infoHRekan = 'Info Rekan Kerja Yang Sudah Presensi Hari Ini <br>'.format_hari_tanggal($date);   
    }
    
    
  echo'<!-- App Capsule -->
    <div id="appCapsule">
    
    <div class="section mt-3 text-center">
            <div class="avatar-section">
                ';
                if($Photox ==''){
                echo'<img src="'.$base_url.'content/avatar.jpg" alt="image" class="imaged w150 ">';
                }else{
                    echo'
                    <img src="timthumb?src='.$base_url.'content/karyawan/'.$Photox.'&amp;h=100&amp;w=105" alt="avatar" class="imaged w150 ">';}
                        echo'
                    <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span>
            </div>
        </div>
        
        <div class="section mt-2 mb-2">
            <div class="section-title">Info Profile '.$JKx.' '.$NamaPegawaix.'</div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">NIP</label>
                                <input type="text" class="form-control" value="'.$NIPx.'" style="background:#eeeeee" disabled>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                    
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Email</label>
                                <input type="text" class="form-control" value="'.$Emailx.'" style="background:#eeeeee" disabled>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="email4">Nama</label>
                                <input type="text" class="form-control" id="name" name="employees_name" value="'.$NamaPegawaix.'" disabled>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>';
                        
                        if ($JKt == 1){
                            $callyx = "Pak ";
                        }else{
                            $callyx = "Bu ";
                        }
                        
                        $getXno = substr($NoHP,1);
                        $getXno = "+62" . $getXno;
                        echo'<div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="nohp">No. Handphone</label> <a href="whatsapp://send?phone='.$getXno.'&text=Hi '.$NamaPegawaix.', Ini Saya '.$namaSaya.'. " class="text-center">Kirim Pesan Ke '.$callyx.' '.$NamaPegawaix.'</a>

                                <input type="text" class="form-control" id="nohp" name="nohp" value="'.$NoHP.'" disabled>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="nohp">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" disabled>'.$Alamatx.'</textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jenis Kelamin</label>
                                <select class="form-control custom-select" name="jk" disabled>
                                <option value="1"'; if ($JKt == '1'){echo "selected";} echo'>LAKI-LAKI</option>
                                <option value="2"'; if ($JKt == '2'){echo "selected";} echo'>PEREMPUAN</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Tanggal Lahir</label>
                             <input type="text" name="tglhr" class="form-control datepicker" value="'.$Tglhrx.'" disabled>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="select4">Jabatan</label>
                                <select class="form-control custom-select" name="position_id" disabled>';
                                      $query="SELECT * from position order by position_name ASC";
                                      $result = $connection->query($query);
                                      while($rowa = $result->fetch_assoc()) { 
                                      if($rowa['position_id'] == $Jabatanx){
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
                                <label class="label" for="nohp">'; if ($Jabatanx == 1){echo "Mata Pelajaran";}else{echo "Bidang";} echo'</label>
                                <select id="selUser" class="form-control month" name="pegawai" disabled>';
                                
                                if ($Jabatanx == 1){
                                    echo '<option value="0"'; if ($Bidangx == "-"){ echo "selected";} echo'>-Mata Pelajaran-</option>';
                                }else{
                                    echo '<option value="0"'; if ($Bidangx == "-"){ echo "selected";} echo'>-Bidang-</option>';
                                }
                                    echo'<option value="1"'; if ($Bidangx == "1"){ echo "selected";} echo'>Produktif MM</option>
                                    <option value="2"'; if ($Bidangx == "2"){ echo "selected";} echo'>Produktif TKJ</option>
                                    <option value="3"'; if ($Bidangx == "3"){ echo "selected";} echo'>Produktif AKL</option>
                                    <option value="4"'; if ($Bidangx == "4"){ echo "selected";} echo'>Produktif BDP</option>
                                    <option value="5"'; if ($Bidangx == "5"){ echo "selected";} echo'>Produktif OTKP</option>
                                    <option value="6"'; if ($Bidangx == "6"){ echo "selected";} echo'>Agama ISLAM</option>
                                    <option value="7"'; if ($Bidangx == "7"){ echo "selected";} echo'>Bahasa Indonesia</option>
                                    <option value="8"'; if ($Bidangx == "8"){ echo "selected";} echo'>Bahasa Inggris</option>
                                    <option value="9"'; if ($Bidangx == "9"){ echo "selected";} echo'>Bahasa Jepang</option>
                                    <option value="10"'; if ($Bidangx == "10"){ echo "selected";} echo'>Bahasa Sunda</option>
                                    <option value="11"'; if ($Bidangx == "11"){ echo "selected";} echo'>Matematika</option>
                                    <option value="12"'; if ($Bidangx == "12"){ echo "selected";} echo'>PJOK</option>
                                    <option value="13"'; if ($Bidangx == "13"){ echo "selected";} echo'>PLH</option>
                                    <option value="14"'; if ($Bidangx == "14"){ echo "selected";} echo'>PPKN</option>
                                    <option value="15"'; if ($Bidangx == "15"){ echo "selected";} echo'>Sejarah Indonesia</option>
                                    <option value="16"'; if ($Bidangx == "16"){echo "selected";} echo'>Seni Budaya</option>
                                    <option value="17"'; if ($Bidangx == "17"){echo "selected";} echo'>Tata Usaha</option>
                                    <option value="18"'; if ($Bidangx == "18"){echo "selected";} echo'>Bimbingan Dan Konseling</option>
                                    <option value="19"'; if ($Bidangx == "19"){echo "selected";} echo'>Produktif TKRO</option>
                                    <option value="20"'; if ($Bidangx == "20"){echo "selected";} echo'>Produktif RPL</option>
                                    <option value="21"'; if ($Bidangx == "21"){echo "selected";} echo'>Tata Boga</option>
                                    <option value="22"'; if ($Bidangx == "22"){echo "selected";} echo'>PKK</option>
                                    <option value="23"'; if ($Bidangx == "23"){echo "selected";} echo'>Kimia</option>
                                    <option value="24"'; if ($Bidangx == "24"){echo "selected";} echo'>Fisika</option>
                                </select>
                                <i class="clear-input">
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
                                      if($rowa['shift_id'] == $Shiftx){ 
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
                                    if($row['building_id'] == $Ruanganx){ 
                                        echo'<option value="'.$row['building_id'].'" selected>'.$row['name'].'</option>';
                                    }else{
                                        echo'<option value="'.$row['building_id'].'">'.$row['name'].'</option>';
                                    }
                                }echo'
                                </select>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    
           <div class="section mt-2">
            <div class="card">
                <div class="table-responsive">
                    <div class="dnl">
                    <table id="swdatatable" class="table table-bordered">
            <thead>
            <tr>
                <th colspan="8" style="text-align:center;">Data Presensi '.$JKx.' '.$NamaPegawaix.'<br>Dari Tanggal '.format_hari_tanggal($tggly).' - '.format_hari_tanggal($tgglx).'</th>
            </tr>
            <tr>
              <th style="width: 10px;">#</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Presensi Masuk</th>
              <th style="text-align:center;">Presensi Pulang</th>
              <th style="text-align:center;">Lama Telat</th>
              <th style="text-align:center;">Keterangan</th>
            </tr>
            </thead>
            <tbody>';
            
            $query_absen="SELECT * FROM shift WHERE shift_name = 'FULL TIME'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $shift_time_in = $row_absen['time_in'];
             }
        }
            
            $TotalTelat = 0;
            
            $TWFO = 0;
            $TWFH = 0;
            $query="SELECT employees.*,position.position_name,presence.employees_id,presence.presence_date,presence.time_in,presence.time_out,presence.picture_in,presence.present_id,presence.presence_address,presence.information,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'$shift_time_in') AS selisih,if (presence.time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.id=$idPegawai AND employees.position_id=position.position_id AND presence.employees_id=employees.id AND $fflter ORDER BY presence.presence_id ASC LIMIT 50";
            $result = $connection->query($query);
             $xstatus= null;
                $dnl = 0;
                $cizin=0;
                $spulang=0;
                $ppulang=0;
                $hdr=0;
                $tlt=0;
                $no=0;
                $INITall = 0;
                $initML = 0;
                $initLT = 0;
                $initLG = 0;
                $XinitLT = 0;
                $XinitLG = 0;
                $infoInit = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               $no++;
               
               
               $CtglInfs = explode("-", $row['presence_date']);
               $tglInfs = $CtglInfs[2] . "-" . $CtglInfs[1] . "-" . $CtglInfs[0];
               
               $statTelat = 'black';
               $perhitungantelat = "Tepat Waktu";
              $idxs = $row['id'];
              $selisihwaktu = $row['selisih'];
            //   $dnlinfo = '';
              //$INITall = $row['presence_address'];
              $INITall = (explode(",",$row['presence_address']));
              $initLT = $INITall[0];
              $initLG = $INITall[1];
              $XinitLT = strlen($initLT);
              $XinitLG = strlen($initLG);
              if ($XinitLG > 11 || $XinitLT > 11)
              {
                  $initML = 1;
                  $infoInit = "Manipulasi Absen";
                  
              }else
              {
                  $initML = 0;
                  $infoInit = "";
              }
             //$keterangan = $row['keterangan'];
             echo "<tr>";
             
              if ($row['status'] == 'Telat' && $row['present_id'] == 1 && $row['information'] != 'DNL') {
                  $tlt++;
                  $xstatus= null;
                  
                  if ($initML == 1){
                   echo '<td class="text-center" style="background-color:Black;color:white;">'.$no.'</td>';
                  
              }else
              {
                  echo '<td class="text-center" style="background-color:Tomato;color:black;font-weight: bold;">'.$no.'</td>';
                  
                  list($hh,$mm,$ss)= explode(':',$selisihwaktu);
                  $perhitungantelat = (($hh * 60)+($mm)) . " Menit";
                  $TotalTelat += (($hh * 60)+($mm));
                  $statTelat = 'Red';
              }
                  
           
          }elseif ($row['status'] == 'Tepat Waktu' && $row['present_id'] == 1 && $row['information'] != 'DNL') {
              $hdr++;
              $xstatus= null;
              
              if ($initML == 1){
                   echo '<td class="text-center" style="background-color:Black;color:white;">'.$no.'</td>';
                  
              }else
              {
                  echo '<td class="text-center" style="background-color:MediumSeaGreen;color:black;font-weight: bold;">'.$no.'</td>'; 
              }
              
            
          }elseif($row['present_id'] == 1 && $row['information'] == 'DNL')
          {
              $dnl++;
              
              $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '$idxs' and tanggal = '$date'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $keteranganx = $row_absen['keterangan'];
                 $akses = $row_absen['akses'];
             }
             if ($akses == '1')
             {
                 echo '<td class="text-center" style="background-color:DodgerBlue;color:black;">'.$no.'</td>'; 
              $xstatus= " <font style='font-weight: bold;'>(Dinas Luar : $keteranganx )</font>";
             }
             
        }
              
              
          }else {
              $cizin++;
              if ($row['present_id'] == 2)
              {
                  $xstatus= " <font style='font-weight: bold;'>(Sakit)</font>";
              }else if ($row['present_id'] == 3)
              {
                  $xstatus= " <font style='font-weight: bold;'>(Izin)</font>";
              }
              
             echo '<td class="text-center" style="background-color:Orange;">'.$no.'</td>';
          }
          
          if ($initML == 1){
                    echo '<td style="color:red;font-weight:bold;">'.$row['employees_name'].' (Terdeteksi Manipulasi Presensi)</td>';
                    
                }else
                {
                    echo '<td style="color:black;font-weight:bold;">'.$row['employees_name'].''.$xstatus.'</td>';
                }
                
                 echo '<td class="text-center" style="color:black;font-weight: bold;">'.$tglInfs.'</td>';
                
                echo'
                
                <td class="text-center picture"><a class="image-link" href="./content/present/'.$row['picture_in'].'" target="_blank">'.$row['time_in'].'</td>';
                if ($row['time_out'] == "00:00:00" && $row['present_id'] == 1)
                {
                    $ppulang++;
                    //echo '<td>'.$row['time_out'].'</td>';
                    echo '<td class="text-center">-</td>';
                }else if ($row['time_out'] == "00:00:00" && $row['present_id'] != 1)
                {
                    // echo '<td>'.$row['time_out'].'</td>';
                    echo '<td class="text-center">'.$row['time_out'].'</td>';
                }else
                {
                    $spulang++;
                 echo'<td class="text-center picture"><a class="image-link" href="./content/present/'.$row['picture_out'].'" target="_blank">'.$row['time_out'].'</td>';
                }
                
                echo '<td class="text-center" style="color:'.$statTelat.';font-weight: bold;">'.$perhitungantelat.'</td>';
                
                if ($row['information'] == "WFH"){
                    echo '<td class="text-center" style="color:blue;font-weight: bold;">WORK FROM HOME ('.$row['information'].')</td>';
                    $TWFH++;
                }else if($row['information'] == "" || $row['information'] == null){
                     echo '<td class="text-center" style="color:black;font-weight: bold;"> WORK FROM OFFICE (WFO) </td>';
                     $TWFO++;
                }else{
                    echo '<td class="text-center" style="color:black;font-weight: bold;">'.$row['information'].'</td>';
                }
                
                
                
                
             
             echo "</tr>";
                  
             
           }
            }
            
            echo '</tbody>
            </table>
                    
                    </div>
                </div>
            </div>
           
           <div class="section mt-2 mb-2">
            <div class="section-title">Info Presensi '.$JKx.' '.$NamaPegawaix.'</div>
            <div class="section-title text-center">Tahun '.$year.' Bulan</div>
            
            <div class="col-md-12">
            <form action="" method="POST">
            <input type="hidden" class="idP" name="idPegawai" value="'.$idPegawai.'" readonly">
            <div class="form-group">
              <select class="form-control month" name="bulanchek" required>';
                if($month ==1){echo'<option value="01" selected>Januari</option>';}else{echo'<option value="01">Januari</option>';}
                if($month ==2){echo'<option value="02" selected>Februari</option>';}else{echo'<option value="02">Februari</option>';}
                if($month ==3){echo'<option value="03" selected>Maret</option>';}else{echo'<option value="03">Maret</option>';}
                if($month ==4){echo'<option value="04" selected>April</option>';}else{echo'<option value="04">April</option>';}
                if($month ==5){echo'<option value="05" selected>Mei</option>';}else{echo'<option value="05">Mei</option>';}
                if($month ==6){echo'<option value="06" selected>Juni</option>';}else{echo'<option value="06">Juni</option>';}
                if($month ==7){echo'<option value="07" selected>Juli</option>';}else{echo'<option value="07">Juli</option>';}
                if($month ==8){echo'<option value="08" selected>Agustus</option>';}else{echo'<option value="08">Agustus</option>';}
                if($month ==9){echo'<option value="09" selected>September</option>';}else{echo'<option value="09">September</option>';}
                if($month ==10){echo'<option value="10" selected>Oktober</option>';}else{echo'<option value="10">Oktober</option>';}
                if($month ==11){echo'<option value="11" selected>November</option>';}else{echo'<option value="11">November</option>';}
                if($month ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
              echo'
              </select>
            </div>
          </div>
          
          <div class="col-md-12 text-center">
          
          <div class="btn-group pull-right">
            <button id="cari" type="submit" class="btn btn-warning">Tampilkan</button>
            </form>
            </div>
            </div>
            <br>
            
            <div class="card">
                <div class="card-body">';
                
                
                $hours = floor($TotalTelat / 60);
                $minutes = ($TotalTelat % 60);
                
                $THari = floor($hours/8);
                
               
  
  
      
      $bblnx = ambilbulan($month);
                
                
                echo '<div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="text4">Total Terlambat</label>
                                <font color="black">Dalam Menit : </font> <font color="red"><b>'.$TotalTelat.' Menit</b></font>
                                </br>
                                <font color="black">Dalam Jam &nbsp; : </font> <font color="red"><b>'.$hours.' Jam '.$minutes.' Menit</b></font>
                                </br>
                                <font color="black">Dalam Hari &nbsp; : </font> <font color="red"><b>'.$THari.' Hari</b></font>
                                </br>
                                <hr>
                                <label class="label" for="text4">Info Presensi</label>
                                <font color="black">Hari Kerja : </font> <font color="black"><b>'.($WeekDay).' Hari</b></font>
                                </br>
                                <font color="black">Hadir : </font> <font color="black"><b>'.($tlt+$hdr+$dnl).' Hari | (WFH : '.$TWFH.' | WFO : '.($TWFO - $cizin).')</b></font>
                                </br>
                                <font color="black">Izin/Sakit : </font> <font color="black"><b> <font color="orange">'.($cizin).' Hari</b></font></font>
                                </br>
                                <font color="black">Tepat Waktu : </font> <font color="green"><b>'.($hdr).' Hari</b></font>
                                </br>
                                <font color="black">Terlambat : </font> <font color="red"><b>'.($tlt).' Hari</b></font>
                                </br>
                                <font color="black">Dinas Luar : </font> <font color="blue"><b>'.($dnl).' Hari</b></font>
                                </br>
                                 <font color="black">Tidak hadir : </font> <font color="red"><b>'.(($WeekDay-($tlt+$hdr+$dnl))- $cizin).' Hari</b></font>
                                 </br>
                                 <font color="black">Total Pinalti : </font> <font color="red"><b>'.((($WeekDay-($tlt+$hdr+$dnl)) + $THari) - $cizin).' Hari</b></font>
                            </div>
                        </div>
                
                </div>
                </div>
            </div>
            
            
             <div class="alert alert-info mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Berikut Adalah Informasi Presensi Rekan Kerja Dari <b><u>'.$NamaPegawaix.'</b></u> , Harap Untuk Saling Mengingatkan Dalam Presensi Dan Prestasi Kerja.</a>
            </div>
        </div>
    


</div>';

  }
  include_once 'mod/sw-footer.php';
} ?>