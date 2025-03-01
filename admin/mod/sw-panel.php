<?php if(empty($connection)){
  header('location:./404');
} else {
    $admsx = $_SESSION['SESSION_ID'];

echo'<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="slimScrollDiv">
    <section class="sidebar">
      <!-- Sidebar user panel -->
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>';
      if($mod =='home'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./"><i class="fa fa-home"></i><span>Dashboard</span></a></li>';
      if ($admsx == 1){
      if($mod =='karyawan' OR $mod=='jabatan' OR $mod=='shift' OR $mod=='lokasi'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
      echo'
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='karyawan'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./karyawan"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>';
            if($mod =='jabatan'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>';
            if($mod =='shift'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="shift"><i class="fa fa-circle-o"></i> Data Jam Kerja</a></li>';
            if($mod =='libur'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="libur"><i class="fa fa-circle-o"></i> Data Libur Kerja</a></li>';
            if($mod =='lokasi'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./lokasi"><i class="fa fa-circle-o"></i> Data Lokasi</a></li>
          </ul>
        </li>';
      }
      if($mod =='absensi'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./absensi"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Data Presensi</span></a></li>';
      
      if($mod =='jadwal'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./jadwal"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Jadwal Mengajar</span></a></li>';
      
    //   if($mod =='now'){echo'<li class="active">'; }else{echo'<li>';}
    //   echo'<a href="./now"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Data Hari Ini</span></a></li>';
    
     if($mod =='alpha' OR $mod=='akhp'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
       echo'
          <a href="#">
            <i class="fa fa-book" aria-hidden="true"></i> <span>Data Pegawai Hari Ini</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='alpha'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./alpha"><i class="fa fa-address-book" aria-hidden="true"></i>
 Data Presensi Hari Ini</a></li>';
            if($mod =='akhp'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./akhp"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
 Data AKHP Pegawai</a></li>
 </ul>
        </li>';
      
       if($mod =='anomali' OR $mod=='perangkat'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
       echo'
          <a href="#">
            <i class="fa fa-laptop" aria-hidden="true"></i> <span>Devices</span>
            <span class="pull-right-container">
              <i class="fa fa-server" aria-hidden="true"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='anomali'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./anomali"><i class="fa fa-bullhorn" aria-hidden="true"></i>
 Anomali</a></li>';
            if($mod =='perangkat'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./perangkat"><i class="fa fa-mobile" aria-hidden="true"></i>
 Perangkat</a></li>';
 if($mod =='pengumuman'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./pengumuman"><i class="fa fa-telegram" aria-hidden="true"></i>
 Pengumuman</a></li>
          </ul>
        </li>';
      
      if($mod =='izin'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./izin"><i class="fa fa-users" aria-hidden="true"></i> <span>Input Data Sakit/Izin</span></a></li>';
      
      if($mod =='dnl'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./dnl"><i class="fa fa-car" aria-hidden="true"></i> <span>Pengajuan Dinas Luar</span></a></li>';
      if ($admsx == 1){
      if($mod =='penilaian' OR $mod=='penilaian2' OR $mod=='terbaik'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
       echo'
          <a href="#">
            <i class="fa fa-handshake-o"></i> <span>Penilaian Rekan Kerja</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='penilaian'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./penilaian"><i class="fa fa-comments-o"></i> View Penilai</a></li>';
            if($mod =='penilaian2'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./penilaian2"><i class="fa fa-random"></i> View Dinilai</a></li>';
             if($mod =='terbaik'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./terbaik"><i class="fa fa-heart-o text-red"></i> Guru Terbaik</a></li>
          </ul>
        </li>';
}
        if ($admsx == 1){
        if($mod =='setting' OR $mod=='system'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
       echo'
          <a href="#">
            <i class="fa fa-wrench"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='setting'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./setting"><i class="fa fa-cogs"></i> Pengaturan</a></li>';
            if($mod =='system'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./system"><i class="fa fa-key"></i> System</a></li>
          </ul>
        </li>';
      
      }
    if ($admsx == 1){
      if($mod =='user'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./user"><i class="fa fa-user"></i> <span>Administrator</span></a></li>';}?>
      <li><a href="javascript:void();" onClick="location.href='./logout';"><i class="fa fa-sign-out text-red"></i>  <span>Keluar</span></a></li>
  <?php echo'
      </ul>
    </section>
  </div>
    <!-- /.sidebar -->
  </aside>';
  }?>