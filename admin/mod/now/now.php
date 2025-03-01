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
  <h1>Data<small> Presensi </small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Hari Ini '.$tgglx.' </li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Hari Ini</b></h3>
          
          <div class="row">
          <form action="" method="POST">
          <div class="col-md-3">
          <div class="form-group">
          <select class="form-control month" name="hari" required>';
                for ($i=1;$i <= 31;$i++)
                {
                    if ($nxtgl == $i)
                    {
                     echo'<option value="'.$i.'" selected>'.$i.'</option>';   
                    }else
                    {
                    echo'<option value="'.$i.'">'.$i.'</option>';
                    }
                    
                }
              echo'
              </select>
          </div>
          </div>
          
          <div class="col-md-3">
            <input type="hidden" class="id" value="'.$id.'" readonly">
            <div class="form-group">
              <select class="form-control month" name="bulan" required>';
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
                if($month ==11){echo'<option value="12" selected>November</option>';}else{echo'<option value="12">November</option>';}
                if($month ==12){echo'<option value="12" selected>Desember</option>';}else{echo'<option value="12">Desember</option>';}
              echo'
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control year" name="tahun" required>';
                $mulai= date('Y') - 0;
                for($i = $mulai;$i<$mulai + 50;$i++){
                    $sel = $i == date('Y') ? ' selected="selected"' : '';
                    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                }
                echo'
              </select>
            </div>
          </div>
          
          
          <div class="col-md-3">
          
          <div class="btn-group pull-right">
            <button id="cari" type="submit" class="btn btn-warning">Tampilkan</button>
            <!--<button id="convert" type="button" class="btn btn-primary">Convert Image</button>-->
            <button type="button" class="btn btn-primary">Ekspor/Cetak</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#" class="btn-print" data-id="pdf">PDF</a></li>
                    <li><a id="evexcel" href="#" class="btn-print" data-id="excel">EXCEL</a></li>
                    <li><a id="printedx" href="#" class="btn-print" data-id="print">PRINT</a></li>
                    <li><a id="convert" href="#" class="btn-print" data-id="print">JPG</a></li>
                  </ul>
            </form>
            </div>
            </div>
          </div>
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
                <th colspan="5" style="text-align:center;">Data Presensi Tanggal : '.$jdtgl.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th>Nama</th>
              <th>Absen Masuk</th>
              <th>Absen Pulang</th>
              <th>Jabatan</th>
            </tr>
            </thead>
            <tbody>';
            $query="SELECT employees.*,position.position_name,presence.employees_id,presence.time_in,presence.time_out,presence.picture_in,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'07:00:00') AS selisih,if (presence.time_in>'07:00:00','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.position_id=position.position_id AND presence.employees_id=employees.id AND 
presence.presence_date='$tgglx' ORDER BY presence.presence_id ASC LIMIT 50";
            $result = $connection->query($query);
            if($result->num_rows > 0){
                $spulang=0;
                $ppulang=0;
                $hdr=0;
                $tlt=0;
                $no=0;
           while ($row= $result->fetch_assoc()) {
              $no++;
              echo '<tr>';
              
              if ($row['status'] == 'Telat') {
                  $tlt++;
           echo '<td class="text-center" style="background-color:Tomato;">'.$no.'</td>';
          } elseif ($row['status'] == 'Tepat Waktu') {
              $hdr++;
             echo '<td class="text-center" style="background-color:MediumSeaGreen;">'.$no.'</td>';
          } else {
             echo '<td class="text-center" style="background-color:DodgerBlue;">'.$no.'('.$row['status'].')</td>';
          }
              echo'
              
                
                
                <td>'.$row['employees_name'].'</td>
                <td class="text-center picture"><a class="image-link" href="https://presensi.skensala.tech/content/present/'.$row['picture_in'].'" target="_blank">'.$row['time_in'].'</td>';
                if ($row['time_out'] == "00:00:00")
                {
                    $ppulang++;
                    echo '<td>'.$row['time_out'].'</td>';
                }else
                {
                    $spulang++;
                 echo'<td class="text-center picture"><a class="image-link" href="https://presensi.skensala.tech/content/present/'.$row['picture_out'].'" target="_blank">'.$row['time_out'].'</td>';
                }
                echo '<td>'.$row['position_name'].'</td>';
              echo '</tr>';}}
            echo'
            </tbody>
            <div class="row justify-content-center">
        <div class="col-md-4">
          <p>Hadir Tepat Waktu : <span class="label label-success">'.$hdr.' Orang</span></p>
          <p>Telat Presensi Masuk : <span class="label label-warning">'.$tlt.' Orang</span></p>
          
        </div>

        <div class="col-md-4">';
        $totalx = $hdr + $tlt;
        $blm = $result_count->num_rows - $totalx;
        echo '<p>Total Pegawai &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="label label-info">'.$result_count->num_rows.' Orang</span></p>
        <p>Total Presensi Hadir : <span class="label label-primary">'. ($hdr + $tlt) .' Orang</span></p>
      <p>Belum Presensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="label label-danger">'.$blm.' Orang</span></p>
          
        </div>';
        
        echo '<div class="col-md-4">
          
          <p>Presensi Pulang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span class="label label-success">'.$spulang.' Orang</span></p>
          <p>Belum Presensi Pulang : <span class="label label-danger">'.$ppulang.' Orang</span></p>
        </div>
      </div>
      <br>
      <div class="row">
      <div class="col-md-4">';
      $prehadir = number_format(((($hdr + $tlt) / $result_count->num_rows) *100),2);
      $pretdk = number_format((100 - $prehadir),2);
      echo '<p>Persentase Hadir : <span class="label label-primary">'. $prehadir .' %</span></p>
      <p>Persentase Tidak Hadir : <span class="label label-primary">'. $pretdk .' %</span></p>
      
      </div>
      <div class="col-md-4">';
      $pretpt = number_format((($hdr  / ($hdr + $tlt)) *100),2);
      $pretdktpt = number_format((100 - $pretpt),2);
      echo '<p>Persentase Tepat Waktu : <span class="label label-primary">'. $pretpt .' %</span></p>
      <p>Persentase Tidak Tepat : <span class="label label-primary">'. $pretdktpt .' %</span></p>
      
      </div>
      <div class="col-md-4">';
      $preplng = number_format(((($spulang) / ($hdr + $tlt)) *100),2);
      $pretplg = number_format((100 - $preplng),2);
      echo '<p>Persentase Pulang : <span class="label label-primary">'. $preplng .' %</span></p>
      <p>Persentase Tidak Pulang : <span class="label label-primary">'. $pretplg .' %</span></p>
      </div>
      </div>
      
      <tr>
                <td colspan="2">Hadir Tepat Waktu : <span class="label label-success">'.$hdr.' Orang</span></td>
                <td colspan="2">Total Pegawai  : <span class="label label-info">'.$result_count->num_rows.' Orang</span></td>
                <td colspan="1">Presensi Pulang  : <span class="label label-success">'.$spulang.' Orang</span></td>
            </tr>
      <tr>
                 <td colspan="2">Telat Presensi Masuk : <span class="label label-warning">'.$tlt.' Orang</span></td>
                <td colspan="2">Total Presensi Hadir : <span class="label label-primary">'. ($hdr + $tlt) .' Orang</span></td>
                <td colspan="1">Belum Presensi Pulang : <span class="label label-danger">'.$ppulang.' Orang</span></td>
                
            </tr>
      <tr>
                <td colspan="5" style="text-align:center;">Belum Presensi   : <span class="label label-danger">'.$blm.' Orang</span></td>
                
            </tr>
            <tr>
                 <td colspan="2">Persentase Hadir : <span class="label label-primary">'. $prehadir .' %</span></td>
                <td colspan="2">Persentase Tepat Waktu : <span class="label label-primary">'. $pretpt .' %</span></td>
                <td colspan="1">Persentase Pulang : <span class="label label-primary">'. $preplng .' %</span></td>
                
            </tr>
            <tr>
                 <td colspan="2">Persentase Tidak Hadir : <span class="label label-primary">'. $pretdk .' %</span></td>
                <td colspan="2">Persentase Tidak Tepat : <span class="label label-primary">'. $pretdktpt .' %</span></td>
                <td colspan="1">Persentase Tidak Pulang : <span class="label label-primary">'. $pretplg .' %</span></td>
                
            </tr>
      
          </table>
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
         function convertToImage() {
            var resultDiv = document.getElementById("result");
            html2canvas(document.getElementById("swdatatable"), {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    result.innerHTML = '<a id="nowx" download="<?php echo $date;?>.jpeg" href="'+img+'">Download Image</a>';
                    }
                    
                    
            });
            document.getElementById("nowx").click();
         }        
         //click event
         var convertBtn = document.getElementById("convert");
         convertBtn.addEventListener('click', convertToImage);
      </script>
      
      <script>
          function printData()
            {
               var divToPrint=document.getElementById("swdatatable");
               newWin= window.open("");
               newWin.document.write(divToPrint.outerHTML);
               newWin.print();
               newWin.close();
            }
            var convertBtn = document.getElementById("printedx");
            convertBtn.addEventListener('click', printData);
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
        ]
    } );
} );
     </script>





      