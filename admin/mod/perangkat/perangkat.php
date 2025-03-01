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
$hri = $_POST['hari'] ;
$bln = $_POST['bulan'] ;
$thnn = $_POST['tahun'] ;

  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);

$tgglx = $thnn . '-' . $bln . '-' . $hri ;
// echo 'Nih :'.$hri;

if ($tgglx == '' || $tgglx == null || $tgglx == '--')
{
   $tgglx =  $date;
}

$blnx = null;
            
$rbtgl = explode("-", $tgglx);

$nxtgl = $rbtgl[2];

//$rbtgl[2] tgl

$cmdAllrest = $_POST['cmdAllReset'];

$gtsPegawai = $_POST['idPegawai'];
$gtsresetLogin = $_POST['TresetLogin'];
$gtTresetDevice = $_POST['TresetDevice'];
$gtTresetCount = $_POST['TresetCount'];


if($cmdAllrest == 'ALLPEG'){
    
     $update ="UPDATE employees set created_cookies='-', mlogin='0' ";
     if($connection->query($update) === false) { 
        die($connection->error.__LINE__);
         echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Melakukan Reset Login Semua Pegawai, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
     }else{
          echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Melakukan Reset Login Semua Pegawai', icon: 'success', timer: 5000,});
        </script>";
     }
    
}


if($gtsPegawai != null || $gtsPegawai != ''){
    $query="SELECT * FROM employees WHERE id= $gtsPegawai";
            $result = $connection->query($query);
            $countx = 0;
            $validasixy = 0;
            $validasix = null;
            if($result->num_rows > 0){
                
           while ($row= $result->fetch_assoc()) {
               $idx = $row['id'];
             $nama = $row['employees_name'];
            //  var_dump($nama);
            //  die;
           }
           
            }
            
            
            if($gtTresetCount == 'RESETCOUNT'){
        $update ="UPDATE employees set countres='3' where id=$gtsPegawai";
     if($connection->query($update) === false) { 
        die($connection->error.__LINE__);
         echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Melakukan Reset Login USer $nama, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
     }else{
          echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Melakukan Reset Count Reset User $nama', icon: 'success', timer: 5000,});
        </script>";
         
     }
    }
            
            
    
    if($gtTresetDevice == 'RESETDEVICE'){
        $update ="UPDATE employees set devices='',created_cookies='-', mlogin='0' where id=$gtsPegawai";
     if($connection->query($update) === false) { 
        die($connection->error.__LINE__);
         echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Melakukan Reset Login USer $nama, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
     }else{
          echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Melakukan Reset Device User $nama', icon: 'success', timer: 5000,});
        </script>";
         
     }
    }
            
            
    
    if($gtsresetLogin == 'RESETLOGIN'){
         $update ="UPDATE employees set created_cookies='-', mlogin='0' where id=$gtsPegawai";
     if($connection->query($update) === false) { 
        die($connection->error.__LINE__);
         echo "<script>
            swal({title: 'Info Sistem', text:'Gagal Melakukan Reset Login USer $nama, Silahkan Coba Lagi.', icon: 'error', timer: 5000,});
        </script>";
     }else{
          echo "<script>
            swal({title: 'Info Sistem', text:'Sukses Melakukan Reset Login User $nama', icon: 'success', timer: 5000,});
        </script>";
         
     }
              
        
    }
    
}

 
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
  default:
echo'
<section class="content-header">
  <h1>Setting<small> Data Perangkat Pegawai</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Setting Perangkat </li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Daftar Perangkat Pegawai</b>
          <form action="" method="POST">
  <input type="hidden" name="cmdAllReset" value="ALLPEG">
   <button class="btn btn-warning btn-xs enable-tooltip" type="submit" name="resetLogin"><i class="fa fa-key" aria-hidden="true"></i> Reset All Login</button>
  </form>
          </h3>
    <div class="box-title" id="result">
         
      </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">';
            echo '<table id="swdatatable" class="table table-bordered">';
            
           
            
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
            
        echo '

      <thead>
      <tr>
                <th colspan="8" style="text-align:center;">Daftar Device User</th>
        </tr>
        
        <tr>
            <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Last Login</th>
              <th style="text-align:center;">Device</th>
              <th style="text-align:center;">Reset Count</th>
              <th style="text-align:center;">Reset Device</th>
              <th style="text-align:center;">Reset Login</th>
              <th style="text-align:center;">Block</th>
        </tr>
        </thead><tbody>';
                
               $query="SELECT employees.*, position.position_name, shift.shift_name, building.name FROM employees,position,shift,building WHERE
employees.position_id=position.position_id AND employees.shift_id = shift.shift_id AND employees.building_id = building.building_id ORDER BY employees.employees_name ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               
               $idchk = $row['id'];
               $namachk = $row['employees_name'];
               $jabatanchk = $row['position_name'];
               $RegDevices = $row['devices'];
               $shiftchk = $row['shift_name'];
               $lokasitchk = $row['name'];
               $gthLlogin = $row['created_login'];
               $gthMlogin = $row['mlogin'];
               $gthCooki = $row['created_cookies'];
               $gtCountres = $row['countres'];
               //$gthNotif = "info";
               
               if ($gthMlogin == '1' && $gthMlogin != '-' ){
                   $gthNotif = "warning";
                   $gthChks = "MediumSeaGreen";
               }else{
                   $gthNotif = "secondary";
                   $gthChks = "#283747";
               }
               
               if ($RegDevices != '' || $RegDevices != null ){
                   $gtDeviceNotif = "info";
               }else{
                   $gtDeviceNotif = "secondary";
               }
               
               if($gtCountres < 1){
                   $gtCountresNotif = "primary";
               }else{
                   $gtCountresNotif = "secondary";
               }
               
               $nox++;
                  echo '<tr>';
                  echo '<td class="text-center" style="background-color:'.$gthChks.';color:#F8F9F9;">'.$nox.'</td>';
                  echo '<td>'.$namachk.' ('.$jabatanchk.')</td>';
                  echo '<td style="text-align:center;">'.$gthLlogin.'</td>';
                  echo '<td style="text-align:center;">'.$RegDevices.'</td>';
                  echo '<td style="text-align:center;">
                  <form action="" method="POST">
                    <input type="hidden" name="idPegawai" value="'.$idchk.'">
                    <input type="hidden" name="TresetCount" value="RESETCOUNT">
                    <button class="btn btn-'.$gtCountresNotif.' btn-xs enable-tooltip" type="submit" name="resetCount"><i class="fa fa-repeat" aria-hidden="true"></i>
 Reset Count</button>
                  </form>
                  </td>';
                  echo '<td style="text-align:center;">
                  <form action="" method="POST">
                    <input type="hidden" name="idPegawai" value="'.$idchk.'">
                    <input type="hidden" name="TresetDevice" value="RESETDEVICE">
                    <button class="btn btn-'.$gtDeviceNotif.' btn-xs enable-tooltip" type="submit" name="resetDevice"><i class="fa fa-mobile" aria-hidden="true"></i>
 Reset Device</button>
                  </form>
                  </td>';
                  echo '<td style="text-align:center;">
                  <form action="" method="POST">
                    <input type="hidden" name="idPegawai" value="'.$idchk.'">
                    <input type="hidden" name="TresetLogin" value="RESETLOGIN">
                    <button class="btn btn-'.$gthNotif.' btn-xs enable-tooltip" type="submit" name="resetLogin"><i class="fa fa-key" aria-hidden="true"></i>
 Reset Login</button>
                  </form>
                  </td>';
                  echo '<td style="text-align:center;">
                  <form action="#" method="POST">
                    <input type="hidden" name="idPegawai" value="'.$idchk.'">
                    <input type="hidden" name="TBlocked" value="BLOCKED">
                    <button class="btn btn-danger btn-xs enable-tooltip" type="button" name="blocked"><i class="fa fa-window-close-o" aria-hidden="true"></i>
 Block</button>
                  </form>
                  </td>';
                  echo '</tr>';
               
           }
           
            }
                
            
      
      
          echo '</tbody></table>
          </div>
        </div>
        
    </div>
    
  </div> 
</section>';

break;

case 'views':



break;

case 'view-present':


break;
}?>

</div>
<?php }?>

      <script type="text/javascript" src="https://github.com/niklasvh/html2canvas/releases/download/0.5.0-alpha1/html2canvas.js"></script>
      <script>
         //convert table to image            
      </script>
      
     
      
      
      
      
      
     
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
         pageLength: 10,
        lengthMenu: [10, 20, 50, 100, 200, 500]
    } );
} );

$(document).on('click', '.btn-modal', function(){
    $('#modal-location').modal();
    var latitude  = $(this).attr("data-latitude");
    var longitude = $(this).attr("data-longitude");
    var name = $('.employees_name').html();
    var id  = $(this).attr("data-idx");
    $(".modal-title-name").html(name);
    document.getElementById("iframe-map").innerHTML ='<iframe src="mod/alpha/map.php?latitude='+latitude+'&longitude='+longitude+'&name='+name+'&idx='+id+'" frameborder="0" width="100%" height="400px" marginwidth="0" marginheight="0" scrolling="no">';
});

     </script>





      