<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

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


 
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
  default:
echo'
<section class="content-header">
  <h1>Setting<small> Jadwal Mapel </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Setting Jadwal Mapel </li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Guru</b></h3>
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
                <th colspan="6" style="text-align:center;">Daftar Nama Guru</th>
        </tr>
        
        <tr>
            <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Shift</th>
              <th style="text-align:center;">Lokasi</th>
              <th style="text-align:center;">Detail</th>
        </tr>
        </thead><tbody>';
                
               $query="SELECT employees.*, position.position_name, shift.shift_name, building.name FROM employees,position,shift,building WHERE
employees.position_id=position.position_id AND employees.shift_id = shift.shift_id AND employees.building_id = building.building_id AND employees.position_id = 1 ORDER BY employees.employees_name ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               
               $idchk = $row['id'];
               $namachk = $row['employees_name'];
               $jabatanchk = $row['position_name'];
               $shiftchk = $row['shift_name'];
               $lokasitchk = $row['name'];
               
               $nox++;
                  echo '<tr>';
                  echo '<td class="text-center" style="background-color:#283747;color:#F8F9F9;">'.$nox.'</td>';
                  echo '<td>'.$namachk.'</td>';
                  echo '<td style="text-align:center;">'.$jabatanchk.'</td>';
                  echo '<td style="text-align:center;">'.$shiftchk.'</td>';
                  echo '<td style="text-align:center;">'.$lokasitchk.'</td>';
                  echo '<td style="text-align:center;">
                  <form action="./mapel" method="POST">
                    <input type="hidden" name="idPegawai" value="'.$idchk.'">
                    <button class="btn btn-warning btn-xs enable-tooltip" type="submit" name="lihatPegawai"><i class="fa fa-eye" aria-hidden="true"></i> Check</button>
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





      