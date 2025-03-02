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
$idPegawai = $_POST['idPegawai'];


  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);



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
          <div class="box-tools pull-right">';
          if($level_user == 1){
            echo'
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Jadwal</button>';}
          else{
            echo'
            <button type="button" class="btn btn-success access-failed"><i class="fa fa-plus"></i> Tambah Jadwal</button>';
            }
          echo'
          </div>
    <div class="box-title" id="result">
         
      </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">';
            echo '<table id="swdatatable" class="table table-bordered">';
            
           
            
             $query="SELECT employees.*, position.position_name, shift.shift_name, building.name FROM employees,position,shift,building WHERE
employees.position_id=position.position_id AND employees.shift_id = shift.shift_id AND employees.building_id = building.building_id AND employees.id =$idPegawai ORDER BY employees.employees_name ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               $namachk = $row['employees_name'];
           }
            }
            
        echo '

      <thead>
      <tr>
                <th colspan="7" style="text-align:center;">Jadwal Mengajar '.$namachk.' </th>
        </tr>
        
        <tr>
            <th style="width: 10px;">No</th>
              <th style="text-align:center;">SENIN</th>
              <th style="text-align:center;">SELASA</th>
              <th style="text-align:center;">RABU</th>
              <th style="text-align:center;">KAMIS</th>
              <th style="text-align:center;">JUMAT</th>
              <th style="text-align:center;">SABTU</th>
                      </tr>
        </thead><tbody>';
                
               $query="SELECT * FROM jadwal WHERE id_pegawai='$idPegawai' ORDER BY hari ASC, jamke ASC";

$result = $connection->query($query);
            if($result->num_rows > 0){
                $statkehadiran=0;
                $chkdata=0;
                $nox = 0;
           while ($row= $result->fetch_assoc()) {
               
               $idchk = $row['id_pegawai'];
               $hari = $row['hari'];
               $mapel = $row['mapel'];
               $jamke = $row['jamke'];
               $jam_awal = $row['jam_awal'];
               $jam_akhir = $row['jam_akhir'];
               $lama = $row['lama'];
               $kelas = $row['kelas'];
               $tapel = $row['tapel'];
               $semester = $row['semester'];
               
                if($hari == 1){
                   $A1_hari[] = $hari;
                   array_push($A1_hari);
                   
                   $A1_mapel[] = $mapel;
                   array_push($A1_mapel);
                   
                   $A1_jamke[] = $jamke;
                   array_push($A1_jamke);
                    
                   $A1_masuk[] = $jam_awal;
                   array_push($A1_masuk);
                   
                   $A1_pulang[] = $jam_akhir;
                   array_push($A1_pulang);
                   
                   $A1_lama[] = $lama;
                   array_push($A1_lama);
                   
                   $A1_kelas[] = $kelas;
                   array_push($A1_kelas);
                   
                   $A1_tapel[] = $tapel;
                   array_push($A1_tapel);
                   
                   $A1_semester[] = $semester;
                   array_push($A1_semester);
                }else if($hari == 2){
                   $A2_hari[] = $hari;
                   array_push($A2_hari);
                   
                   $A2_mapel[] = $mapel;
                   array_push($A2_mapel);
                   
                   $A2_jamke[] = $jamke;
                   array_push($A2_jamke);
                    
                   $A2_masuk[] = $jam_awal;
                   array_push($A2_masuk);
                   
                   $A2_pulang[] = $jam_akhir;
                   array_push($A2_pulang);
                   
                   $A2_lama[] = $lama;
                   array_push($A2_lama);
                   
                   $A2_kelas[] = $kelas;
                   array_push($A2_kelas);
                   
                   $A2_tapel[] = $tapel;
                   array_push($A2_tapel);
                   
                   $A2_semester[] = $semester;
                   array_push($A2_semester);
                }else if($hari == 3){
                   $A3_hari[] = $hari;
                   array_push($A3_hari);
                   
                   $A3_mapel[] = $mapel;
                   array_push($A3_mapel);
                   
                   $A3_jamke[] = $jamke;
                   array_push($A3_jamke);
                    
                   $A3_masuk[] = $jam_awal;
                   array_push($A3_masuk);
                   
                   $A3_pulang[] = $jam_akhir;
                   array_push($A3_pulang);
                   
                   $A3_lama[] = $lama;
                   array_push($A3_lama);
                   
                   $A3_kelas[] = $kelas;
                   array_push($A3_kelas);
                   
                   $A3_tapel[] = $tapel;
                   array_push($A3_tapel);
                   
                   $A3_semester[] = $semester;
                   array_push($A3_semester);
                }else if($hari == 4){
                   $A4_hari[] = $hari;
                   array_push($A4_hari);
                   
                   $A4_mapel[] = $mapel;
                   array_push($A4_mapel);
                   
                   $A4_jamke[] = $jamke;
                   array_push($A4_jamke);
                    
                   $A4_masuk[] = $jam_awal;
                   array_push($A4_masuk);
                   
                   $A4_pulang[] = $jam_akhir;
                   array_push($A4_pulang);
                   
                   $A4_lama[] = $lama;
                   array_push($A4_lama);
                   
                   $A4_kelas[] = $kelas;
                   array_push($A4_kelas);
                   
                   $A4_tapel[] = $tapel;
                   array_push($A4_tapel);
                   
                   $A4_semester[] = $semester;
                   array_push($A4_semester);
                }else if($hari == 5){
                   $A5_hari[] = $hari;
                   array_push($A5_hari);
                   
                   $A5_mapel[] = $mapel;
                   array_push($A5_mapel);
                   
                   $A5_jamke[] = $jamke;
                   array_push($A5_jamke);
                    
                   $A5_masuk[] = $jam_awal;
                   array_push($A5_masuk);
                   
                   $A5_pulang[] = $jam_akhir;
                   array_push($A5_pulang);
                   
                   $A5_lama[] = $lama;
                   array_push($A5_lama);
                   
                   $A5_kelas[] = $kelas;
                   array_push($A5_kelas);
                   
                   $A5_tapel[] = $tapel;
                   array_push($A5_tapel);
                   
                   $A5_semester[] = $semester;
                   array_push($A5_semester);
                }
                
               
               
               $nox++;
                  
               
           }
           
            }
            
            // echo '<tr>';
            //         echo '<td>Total Data '.count($A1_hari).'</td>';
            //       echo '</tr>';
                
                    
                    $CT1 = count($A1_hari);
                    $CT2 = count($A2_hari);
                    $CT3 = count($A3_hari);
                    $CT4 = count($A4_hari);
                    $CT5 = count($A5_hari);
                    
                    $Tarray = max($CT1,$CT2,$CT3,$CT4,$CT5);
                    $CKS1 == 0;
                    $CKS2 == 0;
                    
                    for($i=1;$i <=15 ;$i++){
                        
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        $x = $i-1;
                        for ($j=1;$j <7 ;$j++){
                            
                                
                                for($k=0;$k <=15 ;$k++){
                                    if ($j == 1){
                                        if ($A1_hari[$k] == '' || $A1_hari[$k] == null){
                                            if ($k<3){
                                            echo '<td>-</td>';    
                                            }
                                            
                                        }else{
                                            if($A1_jamke[$k] == $i){
                                                echo '<td>'.$A1_mapel[$k].'</td>';
                                            }
                                        }
                                        
                                    }else if ($j == 2){
                                        if ($A2_hari[$k] == '' || $A2_hari[$k] == null){
                                            if ($k<2){
                                            echo '<td>-</td>';    
                                            }
                                            
                                        }else{
                                            if($A2_jamke[$k] == $i){
                                                echo '<td>'.$A2_mapel[$k].'</td>';
                                            }
                                        }
                                        
                                    }
                                    else if ($j == 3){
                                        if ($A3_hari[$k] == '' || $A3_hari[$k] == null){
                                            if ($k<2){
                                            echo '<td>-</td>';    
                                            }
                                            
                                        }else{
                                            if($A3_jamke[$k] == $i){
                                                echo '<td>'.$A3_mapel[$k].'</td>';
                                            }
                                        }
                                        
                                    }else if ($j == 4){
                                        if ($A4_hari[$k] == '' || $A4_hari[$k] == null){
                                            if ($k<1){
                                            echo '<td>-</td>';    
                                            }
                                            
                                        }else{
                                            if($A4_jamke[$k] == $i){
                                                echo '<td>'.$A4_mapel[$k].'</td>';
                                            }
                                        }
                                        
                                    }else if ($j == 5){
                                        if ($A5_hari[$k] == '' || $A5_hari[$k] == null){
                                            if ($k<2){
                                            echo '<td>-</td>';    
                                            }
                                            
                                        }else{
                                            if($A5_jamke[$k] == $i){
                                                echo '<td>'.$A5_mapel[$k].'</td>';
                                            }
                                        }
                                        
                                    }else if($j == 6){
                                        
                                    }
                                }
                            
                                 
                            
                            
                                
                            
                          
                        }
                         
                        echo '</tr>';
                        
                    }
      
      
          echo '</tbody></table>
          </div>
        </div>
        
    </div>
    
  </div> 
</section>';

echo '
<!-- Add -->
<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Jadwal</h4>
      </div>
      <form class="form validate add-mapel">
      <div class="modal-body">
        <div class="form-group">
            <label>Hari</label>
            <input type="hidden" class="form-control" name="idPegawaix" value="'.$idPegawai.'">
                   <select class="form-control valid" name="hari" required="">
                      <option value="">- Pilih -</option>
                      <option value="1">SENIN</option>
                      <option value="2">SELASA</option>
                      <option value="3">RABU</option>
                      <option value="4">KAMIS</option>
                      <option value="5">JUMAT</option>
                      <option value="6">SABTU</option>
                  </select>
        </div>

        <div class="form-group col-md-12">
            <label>Mata Pelajaran</label><br>';
            echo "<select id='selMapel' class='form-control valid' name='mapel' required>";
                echo'<option value="0">-Mata Pelajaran-</option>';
                 $queryx="SELECT * FROM mapel";
                  $resultx = $connection->query($queryx);
                    if($resultx->num_rows > 0){
                        $noxs=0;
                        while ($rowx= $resultx->fetch_assoc()) {
                            echo'<option value="'.$rowx['mapel'].'">'.$rowx['mapel'].'</option>';
                        }
                    }
                
                
              echo'
              
              </select>
        </div>
        <div class="form-group">
            <label>Jam Ke-</label>
             <select class="form-control valid" name="jamke" required="">
                      <option value="">- Pilih -</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                  </select>
        </div>
        
        <div class="form-group">
            <label>Jam Masuk</label>
            <input type="text" class="form-control" name="masuk" required>
        </div>
        
        <div class="form-group">
            <label>Jam Selesai</label>
            <input type="text" class="form-control" name="keluar" required>
        </div>
        <div class="form-group">
            <label>Lama Waktu</label>
            <input type="text" class="form-control" name="lama" required>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <input type="text" class="form-control" name="kelas" required>
        </div>
        <div class="form-group">
            <label>Tahun Pelajaran</label>
            <input type="text" class="form-control" name="tapel" required>
        </div>
        <div class="form-group">
            <label>Semester</label>
            <select class="form-control valid" name="semester" required="">
                      <option value="">- Pilih -</option>
                      <option value="1">Semester Ganjil</option>
                      <option value="2">Semester Genap</option>
                  </select>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>
';

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
            $("#selMapel").select2();


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





      