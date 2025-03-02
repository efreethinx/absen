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
  <h1>Data<small> Pengumuman</small></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">Data Pengumuman</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Data Pengumuman</b></h3>
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
    <th>Tanggal</th>
    <th>Title</th>
    <th>Perihal</th>
    <th>Pengumuman</th>
    <th>Pinned</th>
    <th style="width:90px" class="text-center">Aksi</th>
  </tr>
  </thead>
  <tbody>';
  $query="SELECT * FROM pengumuman ORDER BY idNotif DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
  $no=1;
 while ($row= $result->fetch_assoc()) {
  
  $pnd = $row['pinned'];
  $pndcs = null;
  
  if($pnd == 1){
      $pndcs = '<span class="btn btn-success pull-left"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
 Pinned</span>';
  }else{
      $pndcs = '<span class="btn btn-warning pull-left"><i class="fa fa-window-close" aria-hidden="true"></i>
 Un-Pinned</span>';
  }
  
  $untext = strip_tags($row['pengumuman']);
  $untext = trim(preg_replace('/\s\s+/', ' ', $untext));
   echo'
    <tr>
      <td class="text-center">'.$no.'</td>
      <td>'.$row['tanggal'].'</td>
      <td>'.$row['title'].'</td>
      <td>'.$row['perihal'].'</td>
      <td><p>'.$row['pengumuman'].'</p></td>
      <td>'.$pndcs.'</td>
      <td class="text-right">
        <div class="btn-group">';
          if($level_user == 1){
          echo'
          <a href="#modalEdit" class="btn btn-warning btn-xs enable-tooltip" title="Edit" data-toggle="modal"';?> onclick="getElementById('txtid').value='<?PHP echo $row['idNotif'];?>';getElementById('txttitle').value='<?PHP echo $row['title'];?>';getElementById('txttgl').value='<?PHP echo $row['tanggal'];?>';getElementById('txtperihal').value='<?PHP echo $row['perihal'];?>';getElementById('txtpinned').value='<?PHP echo $row['pinned'];?>';getElementById('txtpengumuman').value='<?PHP echo $untext;?>';"><i class="fa fa-pencil-square-o"></i> Ubah</a>
          <?php echo'
          <buton data-id="'.$row['idNotif'].'" class="btn btn-xs btn-danger delete" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';}
        else{
        echo'
          <button type="button" class="btn btn-warning btn-xs access-failed enable-tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i> Ubah</button>
          <buton type="button" class="btn btn-xs btn-danger access-failed" title="Hapus"><i class="fa fa-trash-o"></i> Hapus</button>';
        }
        echo'
        </div>

      </td>
      </tr>';
     $no++;
 }
  }
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
            <label>Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
             <input type="text" class="form-control" name="tanggal" value="'.$date.'" readonly required>
        </div>
        
        <div class="form-group">
            <label>Perihal</label>
            <input type="text" class="form-control" name="perihal" required>
            
        </div>
        
        <div class="form-group">
            <label>Isi Pengumuman</label>
            <textarea class="form-control address" name="pengumuman" rows="3" required></textarea>
        </div>
        
        <div class="form-group">
            <label>Pinned</label>
            <select class="form-control" name="pinned">
                <option value="1">Ya</option>
                <option value="2">Tidak</option>
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
       <input type="hidden" name="id" id="txtid" required" value="">
      <div class="modal-body">
          <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" id="txttitle" name="title" required>
          </div>

        <div class="form-group">
            <label>Tanggal</label>
             <input type="text" class="form-control" id="txttgl" name="tanggal" readonly required>
            
        </div>
        
          <div class="form-group">
            <label>Perihal</label>
            <input type="text" class="form-control" id="txtperihal" name="perihal" required>
        </div>
          <div class="form-group">
            <label>Isi Pengumuman</label>
            <textarea class="form-control address" id="txtpengumuman" name="pengumuman" rows="3" required></textarea>
        </div>
        <div class="form-group">
           <label>Pinned</label>
            <select class="form-control" id="txtpinned" name="pinned">
                <option value="1">Ya</option>
                <option value="2">Tidak</option>
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