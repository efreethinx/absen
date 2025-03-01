<?php @session_start();

require_once'../../../library/sw-config.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
  header('location:../../login/');
  exit;
}
else{
  require_once'../../login/login_session.php';
switch (htmlentities(@$_GET['action'])){
case 'system':
    
    $query="SELECT * FROM system";
            $result = $connection->query($query);
            if($result->num_rows > 0){
               while ($row= $result->fetch_assoc()) {
                   $idx = $row['id'];
                   $latitude_dt = $row['latitude'];
                   $longitude_dt = $row['longitude'];
                   $batas = $row['batas'];
                   $masuk = $row['masuk'];
                   $pulang = $row['pulang'];
                   $notif = $row['notif'];
                   $active = $row['active'];
                   $anotif = $row['info_active'];
                   $WFH = $row['WFH'];
                   $FACE = $row['face'];
                   $NPK = $row['npk'];
                   $LOCKDEVICE = $row['lockdevice'];
                   $MODDEVICE = $row['moddevice'];
                   $AKHP = $row['modeakh'];
                   $CAKHP = $row['countakh'];
                   
               }
            }
    
    
    echo'
    <form id="validate" class="form-horizontal update-setting" enctype="multipart/form-data" autocomplete="of">
        <div class="form-group">
          <!--<label class="col-sm-2 control-label">No </label>-->
          <div class="col-sm-6">
            <span style="display:none;" class="form-control" value="1" required="">'.$idx.'</span>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label">Mode Presensi </label>
          <div class="col-sm-6">
            <select class="form-control" name="wfh">
                <option '; if ($WFH == 2){echo ' selected ';}  echo ' value="2">WFO</option>
                <option '; if ($WFH == 1){echo ' selected ';} echo' value="1">WFH</option>
            </select>
          </div>
        </div>



        <div class="form-group">
          <label class="col-sm-2 control-label">Latitude </label>
          <div class="col-sm-6">
            <input type="text" name="latitude"  class="form-control" value="'.$latitude_dt.'" required="required">
          </div>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label">Longitude </label>
          <div class="col-sm-6">
           <input type="text" name="longitude"  class="form-control" value="'.$longitude_dt.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Batas </label>
          <div class="col-sm-6">
            <input type="number" name="batas"  class="form-control" value="'.$batas.'" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Jam Mulai Presensi </label>
          <div class="col-sm-6">
            <input type="number" name="masuk"  class="form-control" value="'.$masuk.'" min="100" max="1100" required="required">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Jam Stop Presensi </label>
          <div class="col-sm-6">
            <input type="number" name="pulang" class="form-control" value="'.$pulang.'" min="1200" max="2359" required="required">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Notifikasi User </label>
          <div class="col-sm-6">
          <textarea class="form-control" name="notif" rows="5" cols="50" required="required">'.$notif.'</textarea>
            <!--<input type="text" name="notif" class="form-control" value="'.$notif.'" required="required">-->
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Presensi Aktif </label>
          <div class="col-sm-6">
            <select class="form-control" name="active">
                <option '; if ($active == 1){echo ' selected ';}  echo ' value="1">Aktif</option>
                <option '; if ($active == 2){echo ' selected ';} echo' value="2">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Info Presensi Aktif/Tidak </label>
          <div class="col-sm-6">
          <textarea class="form-control" name="ainfo" rows="5" cols="50" required="required">'.$anotif.'</textarea>
            <!--<input type="text" name="ainfo" class="form-control" value="'.$anotif.'" required="required">-->
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Mode Face Detect </label>
          <div class="col-sm-6">
            <select class="form-control" name="face">
                <option '; if ($FACE == 'ON'){echo ' selected ';}  echo ' value="ON">Aktif</option>
                <option '; if ($FACE == 'OFF'){echo ' selected ';} echo' value="OFF">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tampil Nama Penilai 0 </label>
          <div class="col-sm-6">
            <select class="form-control" name="npk">
                <option '; if ($NPK == 'ON'){echo ' selected ';}  echo ' value="ON">Aktif</option>
                <option '; if ($NPK == 'OFF'){echo ' selected ';} echo' value="OFF">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Lock Device </label>
          <div class="col-sm-6">
            <select class="form-control" name="lockdevice">
                <option '; if ($LOCKDEVICE == 'ON'){echo ' selected ';}  echo ' value="ON">Aktif</option>
                <option '; if ($LOCKDEVICE == 'OFF'){echo ' selected ';} echo' value="OFF">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Mode Device </label>
          <div class="col-sm-6">
            <select class="form-control" name="moddevice">
                <option '; if ($MODDEVICE == 'ALL'){echo ' selected ';}  echo ' value="ALL">ALL</option>
                <option '; if ($MODDEVICE == 'PHONE'){echo ' selected ';} echo' value="PHONE">PHONE</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">AKHP </label>
          <div class="col-sm-6">
            <select class="form-control" name="akhp">
                <option '; if ($AKHP == 'ON'){echo ' selected ';}  echo ' value="ON">AKTIF</option>
                <option '; if ($AKHP == 'OFF'){echo ' selected ';} echo' value="OFF">TIDAK AKTIF</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Minimal AKHP </label>
          <div class="col-sm-6">
             <input type="number" name="cakhp"  class="form-control" value="'.$CAKHP.'" min="0" max="10" required="required">
          </div>
        </div>

        
        

      <!-- /.box-body -->
      <div class="box-footer">
        <label class="col-sm-2 control-label"></label>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">';
        if($level_user ==1){
          echo'
          <button type="submit" class="btn bg-blue"><i class="fa fa fa-check"></i> Simpan</button>';}
        else{
          echo'<button type="button" class="btn bg-blue access-failed"><i class="fa fa fa-check"></i> Simpan</button>';
        }
        echo'
          <button type="reset" class="btn btn-danger">Reset</a>
        </div>
      </div>
      <!-- /.box-footer -->
  </form>';

break;
}}