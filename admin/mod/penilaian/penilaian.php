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
$DDTS = $rbtgl[1]."-".$rbtgl[0];

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


$getser = $_POST['reks'];

$lbulan = $_POST['vbulan'];
$ltahun = $_POST['vtahun'];

$ldata = $lbulan . "-" . $ltahun;






if ($getser == "" || $getser == null){
    
}else{
    
    $queryx="SELECT * FROM link_nilai";
$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
                while ($rowx= $resultx->fetch_assoc()) {
                    $d1 =  $rowx['employees_id'];
                    $d2 =  $rowx['position_id'];
                    $d3 =  $rowx['user1'];
                    $d4 =  $rowx['user2'];
                    $d5 =  $rowx['user3'];
                    $d6 =  $rowx['tot'];
                    $d7 =  $rowx['nilai1'];
                    $d8 =  $rowx['nilai2'];
                    $d9 =  $rowx['nilai3'];
                    
                    $add ="INSERT INTO rekap_penilaian (employees_id,
                            position_id,
                            user1,
                            user2,
                            user3,
                            tot,
                            nilai1,
                            nilai2,
                            nilai3,
                            date) values('$d1',
                            '$d2',
                            '$d3',
                            '$d4',
                            '$d5',
                            '$d6',
                            '$d7',
                            '$d8',
                            '$d9',
                            '$DDTS')";
                  
          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo'Sepertinya Sistem Kami sedang error!';
          } else{
              echo '
        <script type="text/javascript">
           swal({title:"Berhasil", text: "Rekap Data Nilai Berhasil", icon:"success",timer:3000,}).then((result) => {
           
           });
        </script>
        ';
        }
                    
                    
                }
              
            }
    
    
    
    
    
}


//echo $DDTS;

//$rbtgl[2] tgl


$queryx="SELECT count(*) as total from rekap_penilaian WHERE date = '$DDTS'";
$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
                while ($rowx= $resultx->fetch_assoc()) {
                    if ($rowx['total'] == 0){
                         $ccts = 0;
                    }else{
                        $ccts = 1;
                    }
                    
                }
              
            }
            
if ($lbulan == "" || $lbulan == null)
{
    $ldata = $DDTS;
    $cmdsx = 1;
}else{
    
    $cmdsx = 0;
    $month = $lbulan;
    $ccts = 1;
    
}            


 
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
  <div class="row text-center">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Penilaian Rekan Kerja (Berdasarkan Penilai)</b>
          
          <br>
          <br>
          <form action="" method="post">
          <input type="hidden" name="reks" value="'; echo $rbtgl[1]."-".$rbtgl[0] ;echo '">';
          if ($ccts == 0){
              
          
          
          echo '<button id="rekap" type="submit" class="btn btn-warning">Rekap Penilaian Bulan ';
          echo $blnx . " ";
          echo 'Tahun '; echo date("Y") ;
          echo '</button><br><br>';
         
          }
          echo '</form>
          
          
          <form action="" method="POST">
          <div class="row">
          <div class="col-md-4">
            <input type="hidden" class="id" value="'.$id.'" readonly">
            <div class="form-group">
              <select class="form-control month" name="vbulan" required>';
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

          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control year" name="vtahun" required>';
                $mulai= date('Y') - 0;
                for($i = $mulai;$i<$mulai + 50;$i++){
                    $sel = $i == date('Y') ? ' selected="selected"' : '';
                    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                }
                echo'
              </select>
            </div>
          </div>
          
          
          <div class="col-md-4">
          
          <div class="btn-group">
            <button id="cari" type="submit" class="btn btn-warning">Tampilkan</button>
            </form>
            </div>
            </div>
          </div>
          
          </h3>
          
          <div class="box-title" id="result">
         
      </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">';
            echo '<table id="swdatatable" class="table table-bordered">
            <thead>';
            
           
            
            
            
            $jdtgl = $rbtgl[2] . '-' . $blnx  . '-' . $rbtgl[0];
            
            
            echo '<tr>
                <th colspan="7" style="text-align:center;">Penilaian Rekan Kerja Bulan '.$blnx.' Tahun '.date('Y').'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama Penilai</th>
              <th style="text-align:center;">Dinilai 1</th>
              <th style="text-align:center;">Dinilai 2</th>
              <th style="text-align:center;">Dinilai 3</th>
              <th style="text-align:center;">Predikat</th>
              <th style="text-align:center;">Notif</th>
            </tr>
            </thead>
            <tbody>';
            
            if ($cmdsx == 1){
                $qtr = "SELECT * FROM link_nilai" ;
                
            }else{
                $qtr = "SELECT * FROM rekap_penilaian WHERE date = '$ldata'" ;
                
            }
            
            $nx = 1;
            $query = $qtr;
$result = $connection->query($query);
            if($result->num_rows > 0){
               $ids=0;
               //$idx=0;
           while ($row= $result->fetch_assoc()) {
               $ids = $row['employees_id'];
               $idx[] = $row['user1'];
               array_push($idx);
               $idx[] = $row['user2'];
               array_push($idx);
               $idx[] = $row['user3'];
               array_push($idx);
               
               $nilaix[] = $row['nilai1'];
               array_push($nilaix);
               $nilaix[] = $row['nilai2'];
               array_push($nilaix);
               $nilaix[] = $row['nilai3'];
               array_push($nilaix);
            //   $idx = $row['user1'];
            //   $idy = $row['user2'];
            //   $idz = $row['user3'];
            
            $TNilai1 = (explode("-",$nilaix[0]));
            
            $TNilai2 = (explode("-",$nilaix[1]));
            
            $TNilai3 = (explode("-",$nilaix[2]));
            
            $TNilai[] = $TNilai1[0] + $TNilai1[1] + $TNilai1[2] + $TNilai1[3] + $TNilai1[4];
            array_push($TNilai);
            
            $TNilai[] = $TNilai2[0] + $TNilai2[1] + $TNilai2[2] + $TNilai2[3] + $TNilai2[4];
            array_push($TNilai);
            
            $TNilai[] = $TNilai3[0] + $TNilai3[1] + $TNilai3[2] + $TNilai3[3] + $TNilai3[4];
            array_push($TNilai);
            
               
               $queryx="SELECT * FROM employees where id= $ids";

$resultx = $connection->query($queryx);
            if($resultx->num_rows > 0){
           while ($rowx= $resultx->fetch_assoc()) {
               
               echo '<tr>';
                    echo '<td class="text-center">'.$nx.'</td>';
                    echo '<td class="text-left" style="font-weight:bold;">'.$rowx['employees_name'].'</td>';
                    
                    if ($TNilai[0] >= 18){
         $HPredikat1 = "Sangat Baik" ;
         $dts1 = 'success';
     }else if($TNilai[0] >= 15)
     {
         $HPredikat1 = "Baik" ;
         $dts1 = 'info';
     }else if($TNilai[0] >= 10)
     {
         $HPredikat1 = "Kurang" ;
         $dts1 = 'warning';
     }else
     {
         $HPredikat1 = "Sangat Kurang" ;
         $dts1 = 'danger';
     }
     
     if ($TNilai[1] >= 18){
         $HPredikat2 = "Sangat Baik" ;
         $dts2 = 'success';
     }else if($TNilai[1] >= 15)
     {
         $HPredikat2 = "Baik" ;
         $dts2 = 'info';
     }else if($TNilai[1] >= 10)
     {
         $HPredikat2 = "Kurang" ;
         $dts2 = 'warning';
     }else
     {
         $HPredikat2 = "Sangat Kurang" ;
         $dts2 = 'danger';
     }
     
     if ($TNilai[2] >= 18){
         $HPredikat3 = "Sangat Baik" ;
         $dts3 = 'success';
     }else if($TNilai[2] >= 15)
     {
         $HPredikat3 = "Baik" ;
         $dts3 = 'info';
     }else if($TNilai[2] >= 10)
     {
         $HPredikat3 = "Kurang" ;
         $dts3 = 'warning';
     }else
     {
         $HPredikat3 = "Sangat Kurang" ;
         $dts3 = 'danger';
     }
     
     if ($TNilai[0] == 0 || $TNilai[1] == 0 || $TNilai[2] == 0){
         $HPredikat1 = "Belum Dinilai" ;
         $HPredikat2 = "Belum Dinilai" ;
         $HPredikat3 = "Belum Dinilai" ;
         $dts1 = 'primary';
         $dts2 = 'primary';
         $dts3 = 'primary';
     }
                    
                    
                    for($i=0;$i<3;$i++){
                        
                        $queryz="SELECT * FROM employees where id= $idx[$i]";
$resultz = $connection->query($queryz);
            if($resultz->num_rows > 0){
           while ($rowz= $resultz->fetch_assoc()) {
               echo '<td class="text-center"">'.$rowz['employees_name'].'<br> '.$nilaix[$i].'<br> Total : '.$TNilai[$i].'</td>';
               
           }
            }
                    }
                    
                    echo '<td class="text-left"><span class="label label-'.$dts1.' btn-xs enable-tooltip">Predikat 1 : '.$HPredikat1.'</span><br> <span class="label label-'.$dts2.' btn-xs enable-tooltip">Predikat 2 : '.$HPredikat2.'</span><br> <span class="label label-'.$dts3.' btn-xs enable-tooltip">Predikat 3 : '.$HPredikat3.'</span></td>';
                    
                    $xnotif = null;
                    if ($TNilai[0] != 0 && $TNilai[1] != 0 && $TNilai[2] != 0){
                        $xnotif =  '<span class="label label-success text-center"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Selesai</span>';
                    }else
                    {
                        $xnotif =  '<span class="label label-danger text-center"><i class="fa fa-times-circle-o" aria-hidden="true"></i> Belum</span>';
                    }
                    
                    echo '<td class="text-center">'.$xnotif.'</td>';
               echo '</tr>';
               
                }
            }
               
               
               $nx++;
               unset($idx);
               unset($nilaix);
               unset($TNilai);
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





      