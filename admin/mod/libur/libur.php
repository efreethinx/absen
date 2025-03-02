<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
  require_once'../library/phpqrcode/qrlib.php'; 
echo'
  <div class="content-wrapper">';
    switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>Data<small> Libur Nasional</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Libur</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Libur Nasional</b></h3>
          <div class="box-tools pull-right">';
          if($level_user == 1){
            echo'
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus"></i> Tambah Baru</button>';}
          else{
            echo'
            <button type="button" class="btn btn-success access-failed"><i class="fa fa-plus"></i> Tambah Baru</button>';
            }
          echo'
          </div>
        </div>
<div class="box-body">
<table id="swdatatable" class="table table-bordered">
  <thead>
  <tr>
    <th style="width:20px" class="text-center">No</th>
    <th>Tanggal Libur</th>
    <th>Lama Libur</th>
    <th>Keterangan Libur</th>
    <th style="width:170px" class="text-center">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT * FROM libur_kerja order by id_libur  DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=0;
 while ($row= $result->fetch_assoc()) {
    $no++;
    echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['tanggal_libur'].'</td>
      <td>'.$row['lama_libur'].' Hari</td>
      <td>'.$row['ket_libur'].'</td>
      <td class="text-right">
        <div class="btn-group">';
          if($level_user == 1){
          echo'
          <a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row['id_libur'];?>';getElementById('txtlibur').value='<?PHP echo $row['tanggal_libur'];?>';getElementById('txtlama').value='<?PHP echo $row['lama_libur'];?>';getElementById('txtKet').value='<?PHP echo $row['ket_libur'];?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a>
          <?php echo'
          <buton data-id="'.$row['id_libur'].'" class="btn btn-xs btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';}
        else{
        echo'
          <button type="button" class="btn btn-warning btn-xs access-failed enable-tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> Ubah</button>
          <buton type="button" class="btn btn-xs btn-danger access-failed" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
        }
        echo'
        </div>

      </td>
    </tr>';}}
  echo'
  </tbody>
</table>
      </div>
    </div>
  </div> 
</section>

<!-- Add -->
<div class="modal fade" id="modalAdd" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Baru</h4>
      </div>
      <form class="form validate add-lokasi">
      <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Libur</label>
            <input type="text" name="tglLibur" id="txtin" class="form-control" value="'; 
            $tgllNow = $day . '-' . $month . '-' . $year ;
            echo $tgllNow .'" required="">
        </div>

        <div class="form-group">
            <label>Lama Libur</label>
           <input type="number" class="form-control" name="lamaLibur" required>
        </div>
        <div class="form-group">
            <label>Keterangan Libur</label>
            <input type="text" class="form-control" name="ketLibur" required>
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

<!-- MODAL EDIT -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Data</h4>
      </div>
      <form class="form update-lokasi" method="post">
       <input type="hidden" name="id" id="txtid" required" value="" readonly>
      <div class="modal-body">
          <div class="form-group">
              <label>Tanggal Libur</label>
              <input type="text" class="form-control" id="txtlibur" name="tanggalLibur" required>
          </div>

          <div class="form-group">
            <label>Lama Libur</label>
            <input type="number" class="form-control" id="txtlama" name="lamaLibur" required>
        </div>
          <div class="form-group">
            <label>Keterangan Libur</label>
            <input type="text" class="form-control" id="txtKet" name="Keterangan" required>
        </div>
          
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Simpan</button>
        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
      </div>
    </form>
    </div>
  </div>
</div>';
break;

case 'view':

echo'
<section class="content-header">
  <h1>Edit Data<small> Karyawan</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li><a href="./'.$mod.'"> Data Lokasi</a></li>
      <li class="active">Kode QR</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>KODE QR Lokasi</b></h3>
        </div>

      <div class="box-body">';
      if(!empty($_GET['id'])){
      $id     =  mysqli_real_escape_string($connection,epm_decode($_GET['id'])); 
      $query  ="SELECT * from building WHERE building_id='$id'";
      $result = $connection->query($query);
      if($result->num_rows > 0){
      $row  = $result->fetch_assoc();
      $codeContents = $row['code'];
      $tempdir = '../content/building/';

      #parameter inputan
      $isi_teks = $codeContents;
      $namafile = $row['building_id'].".png";
      $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
      $ukuran = 10; //batasan 1 paling kecil, 10 paling besar
      $padding = 1;
      QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

     // QRcode::png($codeContents, $tempdir.''.$codeContents.'.png', QR_ECLEVEL_L, 20, 2);
      echo'
      <div class="col-md-4" id="printarea">
         <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-warning text-center">
              <div class="text-center" style="display:inline-block">
                <img class="img-responsive text-center" src="'.$tempdir.''.$row['building_id'].'.png" alt="QR CODE" width="150">
              </div>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Kantor : '.$row['name'].'</a></li>
                <li><a href="#">Lokasi : '.$row['address'].'</a></li>
              </ul>
            </div>

            <div class="box-footer hidden-print">
                <button type="button" class="btn btn-primary btn-print"><i class="fa fa-check"></i> Cetak</button>
                <a class="btn btn-default pull-right" href="./'.$mod.'"><i class="fa fa-remove"></i> Kembali</a>
            </div>

          </div>
        </div>
      ';
      }else{
         echo'<section class="content">
            <div class="error-page">
              <h2 class="headline text-yellow"> 404</h2>
              <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
                <p>
                Saat ini data yang Anda cari tidak ditemukan<br>
                <a class="btn btn-primary" href="./">return to dashboard</a>
                </p>
              </div>
            </div>
          </section>';
      }}
        echo'
      </div>
    </div>
  </div> 
</section>';

break;
}?>

</div>
<?php }?>