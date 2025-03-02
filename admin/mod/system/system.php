<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';

echo'
  <div class="content-wrapper">';
switch(@$_GET['op']){ 
    default:
echo'
<section class="content-header">
  <h1>System  <a href="https://absensi.leuwimunding.my.id/ranpenilaian"><button type="button" class="btn bg-blue"><i class="fa fa fa-check"></i> Reset Penilaian Kinerja</button></a></h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-dashboard"></i> Beranda</a></li>
      <li class="active">System</li>
    </ol>
</section>';
echo'
<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"  onclick="loadSettingUmum();">System</a></li>
            </ul>
            <div class="tab-content">
              <div id="load">

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->


      
</div>
</section>';
break;
}?>

</div>
<?php }?>