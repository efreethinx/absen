<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php'); 
$extensionList = array("jpg", "png", "ico");
switch (@$_GET['action']){
/* ------------------------------
    Update
---------------------------------*/
case 'update':

if($level_user ==1){
$error = array();
if (empty($_POST['latitude'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xlatitude = mysqli_real_escape_string($connection, $_POST['latitude']);
}

if (empty($_POST['longitude'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xlongitude = mysqli_real_escape_string($connection,$_POST['longitude']);
}

if (empty($_POST['batas'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xbatas = mysqli_real_escape_string($connection,$_POST['batas']);
}


if (empty($_POST['masuk'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xmasuk = mysqli_real_escape_string($connection,$_POST['masuk']);
}

if (empty($_POST['pulang'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xpulang = mysqli_real_escape_string($connection,$_POST['pulang']);
}

if (empty($_POST['notif'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xnotif = mysqli_real_escape_string($connection,$_POST['notif']);
}

if (empty($_POST['active'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xactive = mysqli_real_escape_string($connection,$_POST['active']);
}

if (empty($_POST['ainfo'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xainfo = mysqli_real_escape_string($connection,$_POST['ainfo']);
}

if (empty($_POST['wfh'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xwfh = mysqli_real_escape_string($connection,$_POST['wfh']);
}

if (empty($_POST['face'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xface = mysqli_real_escape_string($connection,$_POST['face']);
}

if (empty($_POST['npk'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xnpk = mysqli_real_escape_string($connection,$_POST['npk']);
}

if (empty($_POST['lockdevice'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xlockdevice = mysqli_real_escape_string($connection,$_POST['lockdevice']);
}

if (empty($_POST['moddevice'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xmoddevice = mysqli_real_escape_string($connection,$_POST['moddevice']);
}

if (empty($_POST['akhp'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xakhp = mysqli_real_escape_string($connection,$_POST['akhp']);
}

if (empty($_POST['cakhp'])) {
        $error[] = 'tidak boleh kosong';
    } else {
    $xcakhp = mysqli_real_escape_string($connection,$_POST['cakhp']);
}


if (empty($error)) { 
    $update = "UPDATE system SET latitude='$xlatitude',
                      longitude='$xlongitude',
                      batas='$xbatas',
                      masuk='$xmasuk',
                      pulang='$xpulang',
                      notif='$xnotif',
                      active='$xactive',
                      info_active='$xainfo',
                      WFH='$xwfh',
                      face='$xface',
                      npk='$xnpk',
                      lockdevice='$xlockdevice',
                      moddevice='$xmoddevice',
                      modeakh='$xakhp',
                      countakh='$xcakhp' WHERE id=1"; 
    if($connection->query($update) === false) { 
      die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }



}else{
   echo'Anda tidak memiliki hak akses!';
}
break;

}

}
