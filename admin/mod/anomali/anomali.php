<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="./assets/js/sweetalert.min.js"></script>

<?php

$namapost = $_POST['fullnamex'];
$idvalidasi = $_POST['idvalidate'];
$chkcode = $_POST['code'];
$chxtypex = $_POST['typex'];
$kodeupdate = null;

if ($chkcode == '' || $chkcode == null)
{
    
}else
{
    $nowcode = explode("-", $chkcode);
    $kodeupdate = $nowcode[1] . '-' . $nowcode[2];

}

//echo '<script>alert("'.$idvalidasi.' - '.$kodeupdate.' - '.$chxtypex.'");</script>';

if ($idvalidasi == '' || $idvalidasi == null){
    
}else
{
    if($chxtypex == '1'){
        
         $update ="UPDATE employees SET employees_code='$kodeupdate' WHERE id='$idvalidasi'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Verify User, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
              }else
              {
                 echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Verify User.', icon: 'success', timer: 5000,});
        </script>"; 
              }
        
    }else if($chxtypex == '2'){
        //$jdx = 'XX-' . $kodeupdate;
        $update ="UPDATE employees SET employees_code='XX-$kodeupdate' WHERE id='$idvalidasi'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__);
                  echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Memberikan Sangsi User, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
              }else
              {
                 echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Memberikan Sangsi User.', icon: 'success', timer: 5000,});
        </script>"; 
              } 
              }else if($chxtypex == '3'){
            $update ="DELETE FROM presence WHERE presence_id = $idvalidasi";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Menghapus Presensi User.', icon: 'error', timer: 5000,});
        </script>";
              }else
              {
                 echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Menghapus Presensi User ".$namapost.".', icon: 'success', timer: 5000,});
        </script>"; 
              }
              }
        
    }

$tgglx =  $date;

$blnx = null;
            
$rbtgl = explode("-", $tgglx);

$nxtgl = $rbtgl[2];

//$rbtgl[2] tgl


 
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
  default:
echo'
<section class="content-header">
  <h1>Data<small> Anomali Data </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Anomali Data</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Anomali Data</b></h3>
          
          <div class="box-title" id="result">
         
      </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">';
            echo '<table id="swdatatable" class="table table-bordered">
            <thead>';
            
           
            
            if ($rbtgl[1] == 1)
            {
                $blnx = 'Januari';
            }else if ($rbtgl[1] == 2)
            {
                $blnx = 'Februari';
            }else if ($rbtgl[1] == 3)
            {
                $blnx = 'Maret';
            }else if ($rbtgl[1] == 4)
            {
                $blnx = 'April';
            }else if ($rbtgl[1] == 5)
            {
                $blnx = 'Mei';
            }else if ($rbtgl[1] == 6)
            {
                $blnx = 'Juni';
            }else if ($rbtgl[1] == 7)
            {
                $blnx = 'Juli';
            }else if ($rbtgl[1] == 8)
            {
                $blnx = 'Agustus';
            }else if ($rbtgl[1] == 9)
            {
                $blnx = 'September';
            }else if ($rbtgl[1] == 10)
            {
                $blnx = 'Oktober';
            }else if ($rbtgl[1] == 11)
            {
                $blnx = 'November';
            }else if ($rbtgl[1] == 12)
            {
                $blnx = 'Desember';
            }
            
            $jdtgl = $rbtgl[2] . '-' . $blnx  . '-' . $rbtgl[0];
            
            
            echo '<tr>
                <th colspan="7" style="text-align:center;">Anomali Data Sampai Tanggal '.$jdtgl.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Absen Masuk</th>
              <th style="text-align:center;">Absen Pulang</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Aksi</th>
            </tr>
            </thead>
            <tbody>';
            $query="SELECT employees.*,position.position_name,presence.employees_id,presence.presence_date,presence.time_in,presence.time_out,presence.picture_in,presence.present_id,presence.presence_address,presence.presence_id,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'07:00:00') AS selisih,if (presence.time_in>'07:00:00','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.position_id=position.position_id AND presence.employees_id=employees.id ORDER BY presence.presence_id ASC";
            $result = $connection->query($query);
            if($result->num_rows > 0){
                $xstatus= null;
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
                $idpresensi = 0;
           while ($row= $result->fetch_assoc()) {
              
              //$INITall = $row['presence_address'];
              $INITall = (explode(",",$row['presence_address']));
              $initLT = $INITall[0];
              $initLG = $INITall[1];
              $XinitLT = strlen($initLT);
              $XinitLG = strlen($initLG);
              if ($XinitLG > 12 || $XinitLT > 12)
              {
                  
                  $idpresensi = $row['presence_id'];
                  $no++;
                  $initML = 1;
                  $infoInit = "Manipulasi Absen";
                  
                  echo '<tr>';
                  echo '<td class="text-center" style="background-color:Black;color:white;">'.$no.'</td>';
                   echo '<td>'.$row['employees_name'].' (Terdeteksi Manipulasi Presensi)</td>';
                   echo '<td class="text-center">'.$row['presence_date'].'</td>';
                   echo'<td class="text-center picture"><a class="image-link" href="../content/present/'.$row['picture_in'].'" target="_blank">'.$row['time_in'].'</td>';
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
                 echo'<td class="text-center picture"><a class="image-link" href="../content/present/'.$row['picture_out'].'" target="_blank">'.$row['time_out'].'</td>';
                }
                echo '<td class="text-center">'.$row['position_name'].'</td>';
                echo'<td style="text-align:center;">
        <a href="#modalHapus" class="btn btn-danger btn-xs enable-tooltip" title="sangsi" data-toggle="modal"';?> onclick="getElementById('txtidy').value='<?PHP echo $idpresensi;?>';getElementById('txtnamay').value='<?PHP echo $row['employees_name'];?>';getElementById('txtcodey').value='<?PHP echo $row['employees_code'];?>';getElementById('txtketerangany').value='<?PHP echo 'Hapus Presensi Manipulasi';?>';getElementById('txttanggay').value='<?PHP echo $row['presence_date'];?>';"><i class="fa fa fa-check"></i>Hapus Presensi</a></td>
                   <?PHP 
                echo '</tr>';
                  
              }else
              {
                  $initML = 0;
                  $infoInit = "";
              }
              
              
                
                
              }}
            echo'
            </tbody>';
            
        
        echo '
      <thead>
      <tr>
                <th colspan="7" style="text-align:center;">Pegawai Terdeteksi Manipulasi Presensi / Anomali Data</th>
        </tr>
        
        <tr>
            <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;" colspan="2">Code</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Verify</th>
              <th style="text-align:center;">Sangsi</th>
        </tr>
        </thead><tbody>';
                
               $query="SELECT employees.*, position.position_name, shift.shift_name, building.name FROM employees,position,shift,building WHERE
employees.position_id=position.position_id AND employees.shift_id = shift.shift_id AND employees.building_id = building.building_id AND employees.	employees_code LIKE 'X%'  ORDER BY employees.id ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               $nox++;
               $idchk = $row['id'];
               $namachk = $row['employees_name'];
               $jabatanchk = $row['position_name'];
               $shiftchk = $row['shift_name'];
               $lokasitchk = $row['name'];
               $chexsangsi = explode("-", $row['employees_code']);
               
                echo '<tr>';
               if ($chexsangsi[0] == 'XY')
               {
                   echo '<td class="text-center" style="background-color:#283747;color:#F8F9F9;">'.$nox.'</td>';
                   echo '<td>'.$namachk.'</td>';
               }else
               {
                   echo '<td class="text-center" style="background-color:tomato;color:#F8F9F9;">'.$nox.'</td>';
                   echo '<td style="font-weight: bold;">'.$namachk.' (Dikenai Sangsi)</td>';
               }
                  
                  
                  echo '<td colspan="2" class="text-center">'.$row['employees_code'].'</td>';
                  echo '<td style="text-align:center;">'.$jabatanchk.'</td>';
                
                if ($chexsangsi[0] == 'XY')
               {
                   echo'<td style="text-align:center;">
        <a href="#modalValidasi" class="btn btn-primary btn-xs enable-tooltip" title="Verify" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $idchk;?>';getElementById('txtnama').value='<?PHP echo $namachk;?>';getElementById('txtcode').value='<?PHP echo $row['employees_code'];?>';getElementById('txtketerangan').value='<?PHP echo 'Verify Akun User';?>';getElementById('txtjabatan').value='<?PHP echo $jabatanchk;?>';"><i class="fa fa fa-check"></i> Verify User</a></td>
                   <?PHP 
                   
                    echo'<td style="text-align:center;">
        <a href="#modalSangsi" class="btn btn-danger btn-xs enable-tooltip" title="sangsi" data-toggle="modal"';?> onclick="getElementById('txtidx').value='<?PHP echo $idchk;?>';getElementById('txtnamax').value='<?PHP echo $namachk;?>';getElementById('txtcodex').value='<?PHP echo $row['employees_code'];?>';getElementById('txtketeranganx').value='<?PHP echo 'Pemberian Sangsi Manipulasi Presensi';?>';getElementById('txtjabatanx').value='<?PHP echo $jabatanchk;?>';"><i class="fa fa fa-check"></i>Berikan Sangsi User</a></td>
                   <?PHP 
               }else
               {
                   
                   
                    echo'<td style="text-align:center;">
        <a href="#modalValidasi" class="btn btn-primary btn-xs enable-tooltip" title="Verify" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $idchk;?>';getElementById('txtnama').value='<?PHP echo $namachk;?>';getElementById('txtcode').value='<?PHP echo $row['employees_code'];?>';getElementById('txtketerangan').value='<?PHP echo 'Verify Akun User';?>';getElementById('txtjabatan').value='<?PHP echo $jabatanchk;?>';"><i class="fa fa fa-check"></i> Verify User</a></td>
                   <?PHP 
                   
                   echo '<td style="text-align:center;"><span class="btn btn-danger btn-xs enable-tooltip">Sudah Di Sangsi <i class="fa fa-check-circle" aria-hidden="true"></i></span></td>';
                   
               }
                      echo '</tr>';
               
           }
           
            }
                
            
      
      
          echo '</tbody></table>
          </div>
        </div>
        
    </div>
    
  </div> 
</section>';



echo'
<div class="modal fade" id="modalValidasi" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Validasi Anomali User</h4>
      </div>
      <form action="" method="POST" class="form update-user">
      <input type="hidden" name="idvalidate" id="txtid" required" value="" readonly>
      <input type="hidden" name="typex" id="typex" required" value="1" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="txtnama" name="fullname" required readonly>
        </div>

        <div class="form-group">
            <label>Code</label>
            <input type="text" class="form-control" id="txtcode" name="code" readonly required>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" class="form-control" id="txtjabatan" name="jabatan" readonly required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" id="txtketerangan" name="keterangan" readonly>
            
        </div>

        <div class="form-group">';
        
        echo'
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Validasi</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';


echo'
<div class="modal fade" id="modalSangsi" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sangsi Anomali User</h4>
      </div>
      <form action="" method="POST" class="form update-user">
      <input type="hidden" name="idvalidate" id="txtidx" required" value="" readonly>
      <input type="hidden" name="typex" id="typex" required" value="2" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="txtnamax" name="fullnamex" required readonly>
        </div>

        <div class="form-group">
            <label>Code</label>
            <input type="text" class="form-control" id="txtcodex" name="code" readonly required>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" class="form-control" id="txtjabatanx" name="jabatanx" readonly required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" id="txtketeranganx" name="keterangan" readonly>
            
        </div>

        <div class="form-group">';
        
        echo'
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Validasi</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';


echo'
<div class="modal fade" id="modalHapus" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Manipulasi Presensi</h4>
      </div>
      <form action="" method="POST" class="form update-user">
      <input type="hidden" name="idvalidate" id="txtidy" required" value="" readonly>
      <input type="hidden" name="typex" id="typex" required" value="3" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="txtnamay" name="fullnamex" required readonly>
        </div>

        <div class="form-group">
            <label>Code</label>
            <input type="text" class="form-control" id="txtcodey" name="code" readonly required>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" id="txtketerangany" name="keterangan" readonly required>
        </div>

        <div class="form-group">
            <label>tanggal</label>
            <input type="text" class="form-control" id="txttanggay" name="tanggal" readonly>
            
        </div>

        <div class="form-group">';
        
        echo'
        </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Hapus</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';



break;

case 'views':



break;

case 'view-present':


break;
}?>

</div>
<?php }?>

      
      
     
      
      
      
      
      
     
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

      
      
     <script>
        $(document).ready(function() {
    $('#swdatatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
         pageLength: 50,
        lengthMenu: [10, 20, 50, 100, 200, 500]
    } );
} );

function ignorex() {
  swal({
  title: "Anda Yakin?",
  text: "Apakah Anda Akan Melakukan Verify Pada Akun Ini ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((verify) => {
  if (verify) {
    swal("Akun Berhasil Di Verify", {
      title: "Sukses",icon: "success",timer:3000
    });
  } else {
    swal("Akun Ditangguhkan Untuk Di Verify!", {
      title: "Ditangguhkan",icon: "info",timer:3000
    });
  }
});
}
     </script>





      