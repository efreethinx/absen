<?php

$fullurl = ($_SERVER['PHP_SELF']);
$trimmed = trim($fullurl, ".php");
$canonical = rtrim($trimmed, '/' . '/?');

if (empty($connection)) {
    header('location:./404');
} else {
    
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
    
    //  //echo '<script>alert("'.$row_user["id"].'");</script>';
    // $query_absen="SELECT * FROM pengajuan_dnl WHERE employess_id = '74'";
    //     $result_absen = $connection->query($query_absen);
    //     if($result_absen->num_rows > 0){
    //         //echo '<script>alert("'.$row_user["id"].'");</script>';
    //             while ($row_absen= $result_absen->fetch_assoc()) {
    //                 //echo '<script>alert("'.$row_user["id"].'");</script>';
    //             }
    //     }
    
    echo '
<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>

  <!--Viewport -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>

  <!--Canonical-->
  <meta content="all" name="robots"/>
  <link href="' . $site_url . '" rel="home"/>
  <link href="' . $site_url . '' . $fullurl . '" rel="canonical"/>

  <!--Title-->
  <title>' . $site_name . '</title>
  <meta name="description" content="Halaman Pengguna ' . $site_name . ', ' . $site_description . '"/>
  <meta name="keywords" content="absensi online, aplikasi absensi, aplikasi absensi online, sistem absensi online, absensi online pemerintah, absensi online perusahaan"/>

  <!--OG-->
  <meta content="website" property="og:type"/>
  <meta content="' . $site_name . '" property="og:title"/>
  <meta content="' . $site_description . '" property="og:description"/>
  <meta content="' . $site_url . '' . $canonical . '" property="og:url"/>
  <meta content="' . $site_name . '" property="og:site_name"/>
  <meta content="' . $site_name . '" property="og:headline"/>
  <meta content="' . $site_url . '/content/logo/absensionline.jpg" property="og:image"/>
  <meta content="1920" property="og:image:width"/>
  <meta content="1080" property="og:image:height"/>
  <meta content="id_ID" property="og:locale"/>
  <meta content="en_US" property="og:locale:alternate"/>
  <meta content="true" property="og:rich_attachment"/>
  <meta content="true" property="pinterest-rich-pin"/>
  <meta content="" property="fb:app_id"/>
  <meta content="" property="fb:pages"/>
  <meta content="" property="fb:admins"/>
  <meta content="" property="fb:profile_id"/>
  <meta content="' . $site_name . '" property="article:author"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="skensala" name="twitter:site"/>
  <meta content="skensala" name="twitter:creator"/>
  <meta content="' . $site_url . '' . $canonical . '" property="twitter:url"/>
  <meta content="' . $site_name . '" property="twitter:title"/>
  <meta content="' . $site_description . '" property="twitter:description"/>
  <meta content="' . $site_url . '/content/logo/absensionline.jpg" property="twitter:image"/>

  <!--Webapp-->
  <link href="' . $site_url . '/manifest.json" rel="manifest"/>
  <meta content="' . $site_url . '" name="msapplication-starturl"/>
  <meta content="' . $site_url . '" name="start_url"/>
  <meta content="' . $site_name . '" name="application-name"/>
  <meta content="' . $site_name . '" name="apple-mobile-web-app-title"/>
  <meta content="' . $site_name . '" name="msapplication-tooltip"/>
  <meta content="#00B4FF" name="theme_color"/>
  <meta content="#00B4FF" name="theme-color"/>
  <meta content="#FFFFFF" name="background_color"/>
  <meta content="#00B4FF" name="msapplication-navbutton-color"/>
  <meta content="#00B4FF" name="msapplication-TileColor"/>
  <meta content="#00B4FF" name="apple-mobile-web-app-status-bar-style"/>
  <meta content="true" name="mssmarttagspreventparsing"/>
  <meta content="yes" name="apple-mobile-web-app-capable"/>
  <meta content="yes" name="mobile-web-app-capable"/>
  <meta content="yes" name="apple-touch-fullscreen"/>
  <link href="' . $site_url . '/favicon.png" rel="apple-touch-icon"/>
  <link href="' . $site_url . '/favicon.png" rel="shortcut icon" type="image/x-icon"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="32x32"/>
  <meta content="' . $site_url . '/content/logo/favicon.png" name="msapplication-TileImage"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="apple-touch-icon"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="48x48"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="72x72"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="96x96"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="168x168"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="192x192"/>
  <link href="' . $site_url . '/content/logo/favicon.png" rel="icon" sizes="512x512"/>

  <!--Author-->
  <meta content="' . $site_name . '" name="author" />
  <meta content="FyOs" name="publisher"/>

  <!--verification-->
  <meta name="yandex-verification" content=""/>
  <meta name="p:domain_verify" content=""/>
  <meta name="msvalidate.01" content=""/>
  <meta name="google-site-verification" content="" />
  <meta name="dmca-site-verification" content=""/>
  <meta name="facebook-domain-verification" content=""/>

  <!--Location-->
  <meta content="ID" name="geo.region"/>
  <meta content="Indonesia" name="geo.country"/>
  <meta content="Indonesia" name="geo.placename"/>
  <meta content="x;x" name="geo.position"/>
  <meta content="x,x" name="ICBM"/>

  <!--resource-->
  <link href="//fonts.googleapis.com" rel="preconnect dns-prefetch"/>
  <link href="//api.github.com" rel="preconnect dns-prefetch"/>
  <link href="//api.mapbox.com" rel="preconnect dns-prefetch"/>
  <link href="//cdnjs.cloudflare.com" rel="preconnect dns-prefetch"/>
  <link href="//unpkg.com" rel="preconnect dns-prefetch"/>
  <link href="//kit.fontawesome.com" rel="preconnect dns-prefetch"/>

  <!--CSS-->
  <link rel="stylesheet" href="' . $site_url . '/mod/assets/css/style.css">
  <link rel="stylesheet" href="' . $site_url . '/mod/assets/css/sw-custom.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">';
  
  $dtFinfo = $year . "-" . $month . "-";
  $query_info="SELECT * FROM pengumuman WHERE pinned=1 AND tanggal LIKE '%$dtFinfo%'";
      $infoNew = $connection->query($query_info);

$InfoNewx = $infoNew->num_rows;

if ($InfoNewx > 0){
//     $file_name = "pristine-6091.mp3";
// echo '<audio autoplay="true" style="display:none;">
//       <source src="'.$file_name.'">
//       </audio>';
}

if ($mod == 'agenda'){
    echo '<script src="https://cdn.tiny.cloud/1/82pyanmgok300hfkhuwz3qmjap534kit1wfsb7n8ijhomr7r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>';
    
    
    echo "<script>
  var readURL= function(event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function(){
      var dataURL = reader.result;
      var output = document.getElementById('output');
      output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
  };
</script>";
}
  
   if($mod == 'profile'){
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
}

if($mod == 'calender'){
    echo'<link rel="stylesheet" href="' . $site_url . '/mod/assets/css/main.css">';
     echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
     
     echo '<style>
     .fc-sun {color:red; background-color: red; }
    .fc-sat {color:red; background-color: red;  }
     .fc-min {color:red; background-color: red; }
    .fc-sab {color:red; background-color: red;  }
  </style>'; 
     
}

if($mod =='present'){
        
        echo '<script src="'.$base_url.'mod/face-api.js"></script>';
       
      
    }
  
  if ($mod == 'info' || $mod == 'profile') {
      echo '
  <link rel="stylesheet" type="text/css" href="https://makitweb.com/demos/resources/select2/dist/css/select2.min.css">
  <script src="https://makitweb.com/demos/resources/select2/dist/js/select2.min.js" type="text/javascript"></script>
      ';
      
  }
  
 
  
    if ($mod == 'history' || $mod == 'profile' || $mod == 'rekan' || $mod == 'rekan2') {
        echo '
    <link rel="stylesheet" href="' . $site_url . '/mod/assets/js/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="' . $site_url . '/mod/assets/js/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="' . $site_url . '/mod/assets/js/plugins/magnific-popup/magnific-popup.css">';
    }

    echo '
    <script src="'.$base_url.'mod/assets/js/sweetalert.min.js"></script>';
    if($mod=='terbaik'){
    echo '<script src="'.$base_url.'mod/assets/js/lib/jquery.min.js"></script>';    
    }
    
    if($mod =='present'){
       echo '<style>
     
  </style>'; 
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.sendDataButton').bind('click.demo', function(e){

                $button = $(this);
                e.preventDefault();

                $.ajax({
                    url: 'http://demo.mobiledetect.net/?page=addItem',
                    type: 'POST',
                    dataType: 'jsonp',
                    data: {
                            remoteDetails:  $('#remoteDetails').val(),
                            remoteAnswer:   $(this).attr('data-answer'),
                            uaStringFromJS: escape(navigator.userAgent),
                            deviceWidth:    $(window).width(),
                            deviceHeight:   $(window).height(),
                            source:         'demoFeedback'
                    },
                    beforeSend: function(){
                        $button.html('Loading...');
                    },
                    success: function(r){
                        $('#feedbackForm').html('<p class="response">'+r.msg+'</p>');
                    }
                });

            });

            $.ajax({
                url: 'http://demo.mobiledetect.net/?page=addItem',
                type: 'POST',
                dataType: 'jsonp',
                data: {
                        //uaStringFromJS: escape(navigator.userAgent),
                        deviceWidth:    $(window).width(),
                        deviceHeight:   $(window).height(),
                        devicePixelRatio: (typeof window.devicePixelRatio !== 'undefined' ? window.devicePixelRatio : 0),
                        'source':         'demoVisitor'
                },
                success: function(r){
                    try { console.log(r); } catch (e) { }
                }
            });


        });
    </script>
    <?php
    
echo '</head>

<body>
<div class="loading"><div class="spinner-border text-primary" role="status"></div></div>
  <!-- loader -->
    <div id="loader">
        <img src="' . $site_url . '/mod/assets/img/logo-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->';
    if (isset($_COOKIE['COOKIES_MEMBER'])) {
        echo '
<!-- App Header -->
    <div class="appHeader bg-danger text-light">';
        echo '<div class="left">
        <a href="#" class="headerButton">
        <!-- <ion-icon name="menu-outline"></ion-icon> -->
            
        </a>
        </div>';
        //dropright
         echo '<div class="left">
             <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                  <img src="' . $site_url . '/content/logox.png" alt="image" class="imaged w32">
                  <a href="#" class="dropdown-toggle notification" style="color:white" data-toggle="modal" data-target="#sidebarPanel">
              <i class="fa fa-bell-o animation-element" style="animation: tilt-shaking 0.25s linear infinite;"></i>
              <blink><span class="label label-danger badgex" style="font-size:13px">'.$InfoNewx.'</span></blink>
            </a>
             </a>
         </div>';
        echo '<div class="pageTitle">
            <img src="' . $site_url . '/content/' . $site_logo . '" alt="logo" class="logo">
        </div>
        <div class="right">
            <div class="headerButton" data-toggle="dropdown" id="dropdownMenuLink" aria-haspopup="true">';
        if ($row_user['photo'] == '') {
            // echo '<img src="' . $site_url . '/content/avatar.jpg" alt="image" class="imaged w40">';
             echo '<img src="timthumb?src=' . $site_url . '/content/avatar.jpg" alt="image" class="imaged w32">';
        } else {
            // echo '
            //     <img src="' . $site_url . '/content/karyawan/' . $row_user['photo'] . '" alt="image" class="imaged w40">';
            echo '<img src="timthumb?src=' . $site_url . '/content/karyawan/' . $row_user['photo'] . '" alt="image" class="imaged w32">';
        }
        echo '
               <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'; ?>
        <a class="dropdown-item" onclick="location.href='profile';" href="profile">
            <ion-icon size="small" name="person-outline"></ion-icon>Profil
        </a>
        <a class="dropdown-item" onclick="location.href='logout';" href="logout">
            <ion-icon size="small" name="log-out-outline"></ion-icon>Keluar
        </a>
        </div>
        </div>
        </div>
        </div>
<?php
        echo '<!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <!-- profile box -->
                    <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">';
        if ($row_user['photo'] == '') {
            echo '<img src="' . $site_url . '/content/avatar.jpg" alt="image" class="imaged w36">';
        } else {
            echo '<img src="' . $site_url . '/content/karyawan/' . $row_user['photo'] . '" class="imaged w36">';
        }
        
        
        
                        $typeOS = null; 
                $versionOS = null;
                $ctsx = 1;
            foreach($detect->getProperties() as $name => $match):
                $check = $detect->version($name);
                
                if($check!==false):
                    // echo $name . " | " . var_dump($check);
                    if($ctsx == 1){
                        $Browserx = $name;
                        $versionBrowserx = $check;
                    }
                    if($ctsx == 4){
                        $typeOS = $name;
                        $versionOS = $check;
                    }
                $ctsx++;
                endif;
                endforeach;
                        
                        $datax = $detect->getMatchesArray();
                        $datax1 = (explode(";",$datax[0]));
                        $datax2 = (explode(")",$datax1[1]));
                        $iduserJY = $row_user['id'];
                        
                        // $iduserJY = $row_user['id'];
        $query_absen="SELECT * FROM employees where id=$iduserJY";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $LCKDEVICE = $row_absen['devices'];
                                                $COUNRESSCH = $row_absen['countres'];
                                            }
                                        }
        
        echo '
                        </div>
                        <div class="in">
                            <strong>' . ucfirst($row_user['employees_name']) . '</strong>
                            <div class="text-muted">' . $row_user['employees_code'] . '</div>';
                            // echo '<center><strong>Device</strong><div class="text-muted">'.$datax1[0].'('.$typeOS. " ".$versionOS.') - '.$deviceType.' </div></center>';
                        echo '</div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                            <ion-icon name="close-outline"></ion-icon>
                        </a>
                    </div>
                    <!-- * profile box -->
              
                    <!-- menu -->
                    <div class="listview-title mt-1">MENU UTAMA</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="./" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div> Home 
                            </a>
                        </li>
                         <li>
                            <a href="./notifikasi" class="item">
                                <div class="icon-box bg-primary">
                                   <ion-icon name="mail-unread-outline"></ion-icon>
                                </div> Notifikasi (<font color="green">New : '.$InfoNewx.'</font>)
                            </a>
                        </li>
                        <li>
                            <a href="./profile" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div> Profil
                            </a>
                        </li>
                        <!--<li>
                            <a href="./present" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="camera-outline"></ion-icon>
                                </div> Presensi
                            </a>
                        </li>-->
                        <li>
                            <a href="./id-card" class="item">
                                <div class="icon-box bg-primary">
                                  <ion-icon name="id-card-outline"></ion-icon>
                                </div> ID Card
                            </a>
                        </li>
                        <li>
                            <a href="./history" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div> Riwayat
                            </a>
                        </li>';
                        if($COUNRESSCH > 0){
                            $lnkDelDev = './deldev';
                        }else
                        {
                            $lnkDelDev = './';
                        }
                         echo ' <li>
                            <a href="'.$lnkDelDev.'" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                </div> Reset Device (<font color="red">Tersisa : '.$COUNRESSCH.'</font>)
                            </a>
                        </li>';
                        
                        echo '<li>
                            <a href="./logout" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </div> Keluar
                            </a>
                        </li>';
                        
                        echo '<br><center><strong>Device</strong><br><div class="text-muted">'.$datax1[0].' (FyOs) - '.$deviceType.' ('.$Browserx."-".$versionBrowserx.')</div></center>';
                        
                        // echo '<br><center><strong>Device</strong><br><div class="text-muted">'.$datax1[0].' ('.$typeOS. " ".$versionOS.') - '.$deviceType.' ('.$Browserx."-".$versionBrowserx.')</div></center>';
                        
                        $chksMlogin = $row_user['mlogin'];
                        
                        $query_absen="SELECT * FROM system where id=1";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $MODDEVICE = $row_absen['moddevice'];
                                                $LOCKEDDEVICE = $row_absen['lockdevice'];
                                            }
                                        }
                        
                            
                       
                        
                        if ($chksMlogin == 0 || $chksMlogin == '0'){
                            echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Data Login Atau Sesi Anda Sekarang Direset Oleh Admin / Pimpinan, Silahkan Login Kembali Atau Hubungi Admin IT!', icon: 'warning', timer: 10000,});
            
            setTimeout(function(){ 
                                                
                                                      window.location.href = './logout';
                                                
                                                }, 4000);
            
        </script>
        ";
                        }
                        
                   if ($MODDEVICE == 'PHONE'){     
                        
                        if ($datax1[0] != "Android" || $deviceType != 'phone'){
                            echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Silahkan Update Aplikasi Ke Versi Terbaru Di link.skensala.my.id/PRESENSI Dan Gunakan Device Android!', icon: 'warning', timer: 10000,});
            
            setTimeout(function(){ 
                                                
                                                      window.location.href = './logout';
                                                
                                                }, 5000);
            
        </script>
        ";
                        }
                        }
                        // $iduserJY = $row_user['id'];
        // $query_absen="SELECT * FROM employees where id=$iduserJY";
        //                                 $result_absen = $connection->query($query_absen);
        //                                 if($result_absen->num_rows > 0){
        //                                     while ($row_absen= $result_absen->fetch_assoc()) {
        //                                         $LCKDEVICE = $row_absen['devices'];
        //                                     }
        //                                 }
                                        
                                        if ($LOCKEDDEVICE == 'ON'){
                                        
                    if($LCKDEVICE == '' || $LCKDEVICE == null){
                        $update ="UPDATE employees SET devices='$versionBrowserx' WHERE id='$iduserJY'";
                            if($connection->query($update) === false) { 
                                die($connection->error.__LINE__); 
                                //echo'Penyetelan password baru gagal, silahkan nanti coba kembali!';
                            } else{
                                //echo'success';
                                //mail($to, $subject, $pesan, $headers);
                            }
                    }else{
                        
                        if($LCKDEVICE != $versionBrowserx){
                        echo "
        <script>
            swal({title: 'Peringatan Sistem', text:'Akses Ditolak Karena Device Berbeda', icon: 'warning', timer: 10000,});
            
            setTimeout(function(){ 
                                                
                                                      window.location.href = './logout';
                                                
                                                }, 3000);
            
        </script>
        ";
                        
                    }
                    }
                                        }
                        
                        
                        // echo '<br><center><strong>Device</strong><br><div class="text-muted">('.$Browserx."-".$versionBrowserx.')</div></center>';
                        
                    echo '</ul>
                    <!-- * menu -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->';
    }
} ?>