<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<?php

$query_absen="SELECT * FROM shift WHERE shift_name = 'FULL TIME'";
        $result_absen = $connection->query($query_absen);
        if($result_absen->num_rows > 0){
             while ($row_absen= $result_absen->fetch_assoc()) {
                 $shift_time_in = $row_absen['time_in'];
             }
        }

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
  <h1>Data<small> AKHP </small></h1>
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
          <h3 class="box-title"><b>Data Hari Ini <i><u>Agenda Kegiatan Harian Pegawai (AKHP)</u></i></b></h3>
          
          <div class="row">
          <form action="" method="POST">
          <div class="col-md-3">
          <div class="form-group">
          <select class="form-control month" name="hari" required>';
                for ($i=1;$i <= 31;$i++)
                {
                    if ($i <10){
                        $jx = "0".$i;
                    }else{
                        $jx = $i;
                    }
                    
                    if ($nxtgl == $i)
                    {
                     echo'<option value="'.$jx.'" selected>'.$jx.'</option>';   
                    }else
                    {
                    echo'<option value="'.$jx.'">'.$jx.'</option>';
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
                if($month ==11){echo'<option value="11" selected>November</option>';}else{echo'<option value="11">November</option>';}
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
            <button id="convert" type="button" class="btn btn-info">Convert To Image</button>
            
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
                <th colspan="8" style="text-align:center;">Data <i><u>AKHP</u></i> Tanggal : '.$jdtgl.'</th>
            </tr>
            <tr>
              <th style="width: 10px;">No</th>
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Jabatan</th>
              <th style="text-align:center;">Judul Kegiatan</th>
              <th style="text-align:center;">Keterangan</th>
              <th style="text-align:center;">Gambar</th>
              <th style="text-align:center;">Note</th>
              <th style="text-align:center;">Aksi</th>
            </tr>
            </thead>
            <tbody>';
            $query="SELECT employees.*,agenda_kegiatan.*,position.position_name FROM  employees,position,agenda_kegiatan
WHERE agenda_kegiatan.employees = employees.id AND employees.position_id=position.position_id AND 
agenda_kegiatan.tanggal='$tgglx' ORDER BY agenda_kegiatan.employees , agenda_kegiatan.id  ASC";
            $result = $connection->query($query);
            if($result->num_rows > 0){
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
           while ($row= $result->fetch_assoc()) {
              $no++;
              $idxs = $row['id'];

              echo '<tr>';
             
             echo '<td class="text-center" style="background-color:MediumSeaGreen;">'.$no.'</td>';
                
             echo '<td>'.$row['employees_name'].''.$xstatus.'</td>';
             
              echo '<td class="text-center">'.$row['position_name'].'</td>';
             
             echo '<td class="text-center font-weight-bold">'.$row['tanggal'].'<br><strong>'.$row['nama_kegiatan'].'</strong></td>';
             
             echo '<td class="text-justify font-weight-bold"><strong>'.$row['keterangan'].'</strong></td>';
             
             echo '<td class="text-center"><a href="../content/agenda/'.$row['gambar'].'" target="_blank">Photo</a></td>';
             
             echo '<td class="text-center font-weight-bold">PTS +'.$row['point'].'<br><br><i><strong>'.$row['note'].'</strong></i></td>';
             
             echo '<td class="text-center">
             <button class="btn btn-warning pull-center btn-sm"><i class="fa fa-times"></i> Tolak</button>
             <br>
             <br>
             <button class="btn btn-primary pull-center btn-sm"><i class="fa fa-check"></i> Approve</button>
             </td>';
             
              echo '</tr>';}}
           
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
         function convertToImage() {
            var resultDiv = document.getElementById("result");
            html2canvas(document.getElementById("swdatatable"), {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    result.innerHTML = '<a id="nowx" download="<?php echo "Presensi_".$jdtgl;?>.jpeg" href="'+img+'">Download Image</a>';
                    }
                    
                    
            });
            document.getElementById("nowx").click();
         }        
         //click event
         var convertBtn = document.getElementById("convert");
         convertBtn.addEventListener('click', convertToImage);
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
         pageLength: 20,
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





      