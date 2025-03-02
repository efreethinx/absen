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





//echo '<script>alert("'.$idvalidasi.' - '.$kodeupdate.' - '.$chxtypex.'");</script>';


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
  <h1>Data<small> Penilaian Guru Terbaik Tahun '.$year.' </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Penilaian Guru Terbaik Tahun '.$year.'</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Penilaian Guru Terbaik Tahun '.$year.'</b></h3>
          
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
                <th colspan="7" style="text-align:center;">Penilaian Guru Terbaik Tahun '.$year.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama Guru</th>
              <th style="text-align:center;">Poling</th>
              <th style="text-align:center;">Predikat</th>
            </tr>
            </thead>
            <tbody>';
            
            $chs = 0;
            $querya="SELECT count(*) as total from guru_terbaik WHERE tanggal LIKE '2021%'";
                $resulta = $connection->query($querya);
                $Total=0;
                if($resulta->num_rows > 0){
                    while ($rowa= $resulta->fetch_assoc()) {
                        $TData = $rowa['total'];
                    }
                }
            
            
            
            
            $nx = 1;
            $query="SELECT * FROM employees WHERE position_id = 1";
$result = $connection->query($query);
            if($result->num_rows > 0){
               $ids=0;
               
               //$idx=0;
           while ($row= $result->fetch_assoc()) {
               $ids = $row['id'];
               $NamaGuru = $row['employees_name'];
               
               $queryf="SELECT * from guru_terbaik WHERE employees_id = $ids";
                $resultf = $connection->query($queryf);
                if($resultf->num_rows > 0){
                        $chks = 'style="background-color:MediumSeaGreen;"';
                    }else{
                        $chks = '';
                    }
                
               
               
               
               echo '
               <tr>
                    <td class="text-center" '.$chks.'>'.$nx.'</td>
                    <td>'.$NamaGuru.'</td>
               ';
               $querya="SELECT count(*) as total from guru_terbaik WHERE pegawai1 = '$ids' OR pegawai2 = '$ids' AND tanggal LIKE '2021%'";
                $resulta = $connection->query($querya);
                $Total=0;
                $PerDt = 0;
                if($resulta->num_rows > 0){
                    while ($rowa= $resulta->fetch_assoc()) {
                            $Total = $rowa['total'];
                            $PerDt = $TData * 0.25;
                            if ($Total >= $PerDt ){
                                $Ketx = 'Kandidat';
                            }else{
                                $Ketx = '-';
                            }
                            
                            echo '<td class="text-center">'.$Total.'/'.($TData*2).'</td>';
                            echo '<td class="text-center">'.$Ketx.'</td>';
                            
               
                    }
                }
                echo '</tr>';
               $nx++;
                }
            }
            
            
            echo '</tbody>';
            
        
       
      
          echo '</table>
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
         pageLength: 15,
        lengthMenu: [10, 20, 50, 100, 200, 500]
    } );
} );
     </script>





      