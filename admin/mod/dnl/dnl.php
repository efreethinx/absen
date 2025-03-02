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

$idvalidasi = $_POST['idvalidate'];

//echo '<script>alert("'.$idvalidasi.'");</script>';

if ($idvalidasi == '' || $idvalidasi == null){
    
}else
{
    $update ="UPDATE pengajuan_dnl SET akses=1 WHERE id='$idvalidasi'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Memvalidasi Pengajuan Dinas Luar, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
              } else{
                  //echo $dtakhir;
                  echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Memvalidasi Pengajuan Dinas Luar.', icon: 'success', timer: 5000,});
        </script>";
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
  <h1>Pengajuan<small>  Dinas Luar </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Pengajuan Dinas Luar</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Pengajuan Dinas Luar</b></h3>
          
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
            $chtgl = $rbtgl[2] . '-' . $rbtgl[1]  . '-' . $rbtgl[0];
            
            echo '<tr>
                <th colspan="8" style="text-align:center;">Pengajuan Dinas Luar SMKN 1 LEUWIMUNDING</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Pengajuan</th>
              <th style="text-align:center;">Validasi</th>
              <th style="text-align:center;">Keterangan</th>
              <th style="text-align:center;">Action</th>
            </tr>
            </thead>
            <tbody>';
            $query="SELECT employees.*,pengajuan_dnl.*,position.* FROM employees, pengajuan_dnl,position WHERE employees.id = pengajuan_dnl.employess_id AND employees.position_id = position.position_id ORDER By pengajuan_dnl.id DESC";
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
             
             $ttgl = explode("-", $tanggal);
             $tanggal = $ttgl[2] . '-' . $ttgl[1] . '-' . $ttgl[0];
             
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
            //  if ($akses =='0')
            //       {
            //           $ktsy='Sudah Valid';
            //       }
            //       else
            //       {
            //           $ktsy='Belum Di Validasi';
            //       }
             
             echo '<tr>';
              if ($akses == '0')
             {
                echo '<td class="text-center" style="background-color:orange;color:#F8F9F9;">'.$countx.'</td>'; 
             }else
             {
                 echo '<td class="text-center" style="background-color:#6fa8dc;color:#F8F9F9;">'.$countx.'</td>'; 
             }
                  
                  echo '<td style="text-align:center;">'.$nama.'</td>';
                  
                  
                  
                  echo '<td style="text-align:center;">'.$tanggal.'</td>';
                  echo '<td style="text-align:center;">'.$jabatan.'</td>';
                  if ($pengajuan =='4')
                  {
                    echo '<td style="text-align:center;">Dinas Luar</td>';
                  }else
                  {
                    echo '<td style="text-align:center;">Dirumahkan</td>';
                  }
                  if($akses== '0')
                  {
                      echo '<td style="text-align:center;"><span class="label label-warning">Belum Di Validasi</span></td>';
                  }else
                  {
                      echo '<td style="text-align:center;"><span class="label label-success">Sudah Di Validasi</span></td>';
                  }
                   echo '<td style="text-align:center;">'.$keterangan.'</td>';
                   
                   if($akses == '0')
                  {
                      if ($chtgl != $tanggal){
                          echo '<td style="text-align:center;"><span class="label label-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Kadaluarsa</span></td>';
                      }else{
                          echo'<td style="text-align:center;">
        <a href="#modalValidasi" class="btn btn-warning btn-xs enable-tooltip" title="Validasi" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $idx;?>';getElementById('txtnama').value='<?PHP echo $nama;?>';getElementById('txttanggal').value='<?PHP echo $tanggal;?>';getElementById('txtketerangan').value='<?PHP echo $keterangan;?>';getElementById('txtjabatan').value='<?PHP echo $jabatan;?>';"><i class="fa fa fa-check"></i> Validasi</a></td>
                   <?PHP 
                      }
                
                
                
                
                  }else
                  {
                      echo '<td style="text-align:center;"><i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i></td>';
                  }
                  
                  echo '</tr>';
             
            
             
              
             
              }
            }
            echo'
            </tbody>';
          echo '</table>
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
        <h4 class="modal-title">Validasi Dinas Luar</h4>
      </div>
      <form action="https://absensi.leuwimunding.my.id/admin/dnl" method="POST" class="form update-user">
      <input type="hidden" name="idvalidate" id="txtid" required" value="" readonly>
      <div class="modal-body">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" id="txtnama" name="fullname" required readonly>
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" class="form-control" id="txtjabatan" name="jabatan" readonly required>
        </div>

        <div class="form-group">
            <label>Tanggal Pengajuan</label>
            <input type="text" class="form-control" id="txttanggal" name="tanggal" readonly required>
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
  text: "Apakah Anda Akan Melakukan Validasi Pada Akun Ini ?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((verify) => {
  if (verify) {
    swal("Akun Berhasil Di Validasi", {
      title: "Sukses",icon: "success",timer:3000
    });
  } else {
    swal("Akun Ditangguhkan Untuk Di Validasi!", {
      title: "Ditangguhkan",icon: "info",timer:3000
    });
  }
});
}
     </script>





      