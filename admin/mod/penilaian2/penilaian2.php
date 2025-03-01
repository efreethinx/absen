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
  <h1>Data<small> Penilaian Rekan Kerja </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Penilaian Rekan Kerja</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Penilaian Rekan Kerja (Berdasarkan Dinilai)</b></h3>
          
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
                <th colspan="7" style="text-align:center;">Penilaian Rekan Kerja Bulan '.$blnx.' Tahun '.date('Y').'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama Dinilai</th>
              <th style="text-align:center;">Penilai 1</th>
              <th style="text-align:center;">Penilai 2</th>
              <th style="text-align:center;">Penilai 3</th>
              <th style="text-align:center;">Predikat</th>
              <th style="text-align:center;">Notif</th>
            </tr>
            </thead>
            <tbody>';
            
            
            
            
            
            $nx = 1;
            $query="SELECT * FROM link_nilai";
$result = $connection->query($query);
            if($result->num_rows > 0){
               $ids=0;
               //$idx=0;
           while ($row= $result->fetch_assoc()) {
               $ids = $row['employees_id'];
               
               $querya="SELECT * FROM employees WHERE id = '$ids'";
$resulta = $connection->query($querya);
            if($resulta->num_rows > 0){
           while ($rowa= $resulta->fetch_assoc()) {
               $namax = $rowa['employees_name'];
               
           }
            }
               
               
               
               
               $queryq="SELECT * FROM link_nilai WHERE user1 = '$ids' OR user2 = '$ids' OR user3 = '$ids'";
$resultq = $connection->query($queryq);
            if($resultq->num_rows > 0){
           while ($rowq= $resultq->fetch_assoc()) {
               $idx[] = $rowq['employees_id'];
               array_push($idx);
               $userx = $rowq['user1'];
               $usery = $rowq['user2'];
               $userz = $rowq['user3'];
               
               
            //   echo $rowq['nilai1'].'<br>'.$rowq['nilai2'].'<br>'.$rowq['nilai3'].'<br>';
               
               if ($userx == $ids){
                   $txN[] = $rowq['nilai1'];
                   array_push($txN);
                   $TNilai1 = (explode("-",$rowq['nilai1']));
                     $dtNilai[] = $TNilai1[0] + $TNilai1[1] + $TNilai1[2] + $TNilai1[3] + $TNilai1[4];
                     array_push($dtNilai);
                     //echo '<script>alert('.$TNilai1[0].');</script>';
                     //print_r($dtNilai);
               }
               
               if ($usery == $ids){
                   $txN[] = $rowq['nilai2'];
                   array_push($txN);
                   $TNilai2 = (explode("-",$rowq['nilai2']));
                     $dtNilai[] = $TNilai2[0] + $TNilai2[1] + $TNilai2[2] + $TNilai2[3] + $TNilai2[4];
                     array_push($dtNilai);
               }
               
               if ($userz == $ids){
                   $txN[] = $rowq['nilai3'];
                   array_push($txN);
                   $TNilai3 = (explode("-",$rowq['nilai3']));
                     $dtNilai[] = $TNilai3[0] + $TNilai3[1] + $TNilai3[2] + $TNilai3[3] + $TNilai3[4];
                     array_push($dtNilai);
               }
               
               
               
               
           }
            }
               echo '<tr>
                        <td>'.$nx.'</td>
                        <td style="font-weight:bold;">'.$namax.'</td>';
                        
                        
              for($i=0;$i <3;$i++){
                  
                  $queryx="SELECT * FROM employees where id= $idx[$i]";

$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
           while ($rowx= $resultx->fetch_assoc()) {
               echo '   <td class="text-center">'.$rowx['employees_name'].'<br>'.$txN[$i].'<br> Total Nilai : '.$dtNilai[$i].'</td>';
               
           }
            }
                  
              }
               $xnotif = null;
                    if ($dtNilai[0] != 0 && $dtNilai[1] != 0 && $dtNilai[2] != 0){
                        $xnotif =  '<span class="label label-success text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Selesai</span>';
                    }else if($dtNilai[0] != 0 || $dtNilai[1] != 0 || $dtNilai[2] != 0){
                        $xnotif =  '<span class="label label-primary text-center"><i class="fa fa-hourglass-half" aria-hidden="true"></i> Proses</span>';
                        
                    }else
                    {
                        $xnotif =  '<span class="label label-danger text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Belum</span>';
                    }
                    
                    if ($dtNilai[0] >= 18){
         $HPredikat1 = "Sangat Baik" ;
         $dts1 = 'success';
     }else if($dtNilai[0] >= 15)
     {
         $HPredikat1 = "Baik" ;
         $dts1 = 'info';
     }else if($dtNilai[0] >= 10)
     {
         $HPredikat1 = "Kurang" ;
         $dts1 = 'warning';
     }else
     {
         $HPredikat1 = "Sangat Kurang" ;
         $dts1 = 'danger';
     }
     
     if ($dtNilai[1] >= 18){
         $HPredikat2 = "Sangat Baik" ;
         $dts2 = 'success';
     }else if($dtNilai[1] >= 15)
     {
         $HPredikat2 = "Baik" ;
         $dts2 = 'info';
     }else if($dtNilai[1] >= 10)
     {
         $HPredikat2 = "Kurang" ;
         $dts2 = 'warning';
     }else
     {
         $HPredikat2 = "Sangat Kurang" ;
         $dts2 = 'danger';
     }
     
     if ($dtNilai[2] >= 18){
         $HPredikat3 = "Sangat Baik" ;
         $dts3 = 'success';
     }else if($dtNilai[2] >= 15)
     {
         $HPredikat3 = "Baik" ;
         $dts3 = 'info';
     }else if($dtNilai[2] >= 10)
     {
         $HPredikat3 = "Kurang" ;
         $dts3 = 'warning';
     }else
     {
         $HPredikat3 = "Sangat Kurang" ;
         $dts3 = 'danger';
     }
     
      if ($dtNilai[0] == 0){
         $HPredikat1 = "Belum Dinilai" ;
         $dts1 = 'primary';
     }
     
     if ($dtNilai[1] == 0){
         $HPredikat2 = "Belum Dinilai" ;
         $dts2 = 'primary';
     }
     
     if ($dtNilai[2] == 0){
         $HPredikat3 = "Belum Dinilai" ;
         $dts3 = 'primary';
     }
                    
                        echo '<td class="text-left"><span class="label label-'.$dts1.' btn-xs enable-tooltip">Predikat 1 : '.$HPredikat1.'</span><br> <span class="label label-'.$dts2.' btn-xs enable-tooltip">Predikat 2 : '.$HPredikat2.'</span><br> <span class="label label-'.$dts3.' btn-xs enable-tooltip">Predikat 3 : '.$HPredikat3.'</span></td>';
                        echo'<td>'.$xnotif.'</td>
                    </tr>';
               
               
               $nx++;
               unset($idx);
               unset($nilaix);
               unset($TNilai);
               unset($dtNilai);
               unset($txN);
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





      