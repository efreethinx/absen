<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
  ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<script src="./assets/js/sweetalert.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://makitweb.com/demos/resources/select2/dist/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://makitweb.com/demos/resources/select2/dist/js/select2.min.js" type="text/javascript"></script>

  <?php
  

  
  
  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);




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

$inptdt = $_POST['inputdata'] ;
$nopg = $_POST['pegawai'];
$statxy = $_POST['status'];
$flphoto = null;
$ttk = '-6.717777,108.354266';

if ($statxy == 2)
{
    $flphoto= 'sakit.png';
    
}else if ($statxy == 3)
{
    $flphoto = 'izin.png';
    
}else
{
    
}




if ($nopg !=0 && $statxy!=0 && $inptdt !=null)
{
    //check data
    $query ="SELECT * FROM presence WHERE employees_id =$nopg AND presence_date='$date' AND present_id=1";
     $result = $connection->query($query);
    if($result->num_rows > 0){
        echo '
        <script type="text/javascript">
           swal({title:"Error!", text: "Maaf Pegawai Sudah Melakukan Presensi Hadir!", icon:"error",timer:2000,});
        </script>
        ';
    }else
    {
        $query ="SELECT * FROM presence WHERE employees_id =$nopg AND presence_date='$date' AND present_id!=1";
     $result = $connection->query($query);
     if($result->num_rows > 0){
     echo '
        <script type="text/javascript">
           swal({title:"Info", text: "Pegawai Sudah Terdata Sakit/Izin", icon:"warning",timer:2000,});
        </script>
        ';
         
     }else{
          $add ="INSERT INTO presence (employees_id,
                            presence_date,
                            time_in,
                            time_out,
                            picture_in,
                            picture_out,
                            present_id,
                            presence_address,
                            information) values('$nopg',
                            '$date',
                            '$time',
                            '15:30:00',
                            '$flphoto',
                            '$flphoto', /*picture out kosong*/
                            '$statxy', /*hadir*/
                            '$ttk',
                            '')";
                  
          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo'Sepertinya Sistem Kami sedang error!';
          } else{
              echo '
        <script type="text/javascript">
           swal({title:"Berhasil", text: "Input Data Izin/Sakit Pegawai Berhasil", icon:"success",timer:3000,}).then((result) => {
           
           });
        </script>
        ';
        }
         
     }
        
        
        
    }
    
}else
{
//   echo '
//         <script type="text/javascript">
//           swal({title:"Error!", text: "Harap Isi Data Dengan Benar!", icon:"error",timer:2000,});
//         </script>
//         '; 
    
}

 
echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
  default:
echo'
<section class="content-header">
  <h1>Data<small> Absensi</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Sakit/Izin '.$tgglx.' </li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Sakit/Izin</b></h3>
          <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <form action="" method="post">
                <input type="hidden" name="inputdata" value="presensi">';
                
               echo "<select id='selUser' class='form-control month' name='pegawai' required>";
                echo'<option value="0">-Pilih Nama Pegawai-</option>';
                 $queryx="SELECT * FROM employees";
                  $resultx = $connection->query($queryx);
                    if($resultx->num_rows > 0){
                        $noxs=0;
                        while ($rowx= $resultx->fetch_assoc()) {
                            echo'<option value="'.$rowx['id'].'">'.$rowx['employees_name'].'</option>';
                        }
                    }
                
                
              echo'
              
              </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select id="dket" class="form-control month" name="status" required>
                        <option value="0">-Pilih Keterangan-</option>
                        <option value="1">Hadir</option>
                        <option value="2">Sakit</option>
                        <option value="3">Izin</option>
                        
                    </select>
                </div>
            </div>
        <div class="col-md-4">
          <div class="btn-group pull-right">
            <button id="inputdtx" type="submit" class="btn btn-warning">Input Data</button>
            <button id="inputdtxs" type="button" class="btn btn-info">Refresh Data</button>
            <script>
            </script>
            </form>
            </div>
        </div>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="swdatatable" class="table table-bordered">
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
              <th style="text-align:center;">Nama</th>
              <th style="text-align:center;">Tanggal</th>
              <th style="text-align:center;">Jam Input</th>
              <th style="text-align:center;">Jabatan</th>
            </tr>
            </thead>
            <tbody>';
            $query="SELECT employees.*,position.position_name,presence.employees_id,presence.time_in,presence.time_out,presence.picture_in,presence.present_id,presence.presence_date,
presence.picture_out,TIMEDIFF(TIME(presence.time_in),'07:00:00') AS selisih,if (presence.time_in>'07:00:00','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM  employees,position,presence
WHERE employees.position_id=position.position_id AND presence.employees_id=employees.id AND 
presence.presence_date='$tgglx' AND presence.present_id!=1 ORDER BY presence.presence_id ASC LIMIT 50";
            $result = $connection->query($query);
            if($result->num_rows > 0){
                $xstatus= null;
                $cizin=0;
                $spulang=0;
                $ppulang=0;
                $hdr=0;
                $tlt=0;
                $no=0;
           while ($row= $result->fetch_assoc()) {
              $no++;
              echo '<tr>';
              
              if ($row['status'] == 'Telat' && $row['present_id'] == 1) {
                  $tlt++;
                  $xstatus= null;
           echo '<td class="text-center" style="background-color:Tomato;">'.$no.'</td>';
          } elseif ($row['status'] == 'Tepat Waktu' && $row['present_id'] == 1) {
              $hdr++;
              $xstatus= null;
             echo '<td class="text-center" style="background-color:MediumSeaGreen;">'.$no.'</td>';
          } else {
              $cizin++;
              if ($row['present_id'] == 2)
              {
                  $xstatus= " <font style='font-weight: bold;'>(SAKIT)</font>";
              }else if ($row['present_id'] == 3)
              {
                  $xstatus= " <font style='font-weight: bold;'>(IZIN)</font>";
              }
              
             echo '<td class="text-center" style="background-color:Orange;">'.$no.'</td>';
          }
              echo'
              
                
                
                <td>'.$row['employees_name'].''.$xstatus.'</td>
                <td>'.$row['presence_date'].'</td>
                <td class="text-center picture"><a class="image-link" href="https://absensi.skensala.tech/content/present/'.$row['picture_in'].'" target="_blank">'.$row['time_in'].'</td>';
                // if ($row['time_out'] == "00:00:00")
                // {
                //     $ppulang++;
                //     echo '<td>'.$row['time_out'].'</td>';
                // }else
                // {
                //     $spulang++;
                //  echo'<td class="text-center picture"><a class="image-link" href="https://presensi.skensala.tech/content/present/'.$row['picture_out'].'" target="_blank">'.$row['time_out'].'</td>';
                // }
                echo '<td>'.$row['position_name'].'</td>';
              echo '</tr>';}}
            echo'
            </tbody>
            <div class="row justify-content-center">
        <div class="col-md-12" style="text-align:center;">
          <p>Sakit/Izin : <span class="label label-warning">'.$cizin.' Orang</span></p>
          
        </div>
      </div>
      <br>
          </table>
          </div>
        </div>
        
    </div>
    
  </div> 
</section>';

// echo "<select id='selUser' style='width: 200px;'>
// <option value='0'>-- Select User --</option>
// <option value='1'>Yogesh singh</option>
// <option value='2'>Sonarika Bhadoria</option>
// <option value='3'>Anil Singh</option>
// <option value='4'>Vishal Sahu</option>
// <option value='5'>Mayank Patidar</option>
// <option value='6'>Vijay Mourya</option>
// <option value='7'>Rakesh sahu</option>
// </select>";

break;

case 'views':



break;

case 'view-present':


break;
}?>

</div>
<?php }?>
      
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

      <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#selUser").select2();
            $("#dket").select2();

            // Read selected option
           
        });
        </script>

      
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
     </script>





      