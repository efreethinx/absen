<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php'); 

switch (@$_GET['action']){
case 'add':
function acakangkahuruf($panjang){
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};}
        return $string;
    }
$code   =  'SW'.acakangkahuruf(3).'/'.$year.'';

  $error = array();
  
  if (empty($_POST['tglLibur'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $tglLibur = mysqli_real_escape_string($connection, $_POST['tglLibur']);
  }

  if (empty($_POST['lamaLibur'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $lamaLibur= mysqli_real_escape_string($connection, $_POST['lamaLibur']);
  }
  if (empty($_POST['ketLibur'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $ketLibur= mysqli_real_escape_string($connection, $_POST['ketLibur']);
  }
  

 

    $add ="INSERT INTO libur_kerja (tanggal_libur,ket_libur,lama_libur) values('$tglLibur','$ketLibur','$lamaLibur')"; 
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }
break;

/* ------------------------------
    Update
---------------------------------*/
case 'update':
 $error = array();
   if (empty($_POST['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_POST['id']);
  }

  if (empty($_POST['tanggalLibur'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $tanggalLibur= mysqli_real_escape_string($connection, $_POST['tanggalLibur']);
  }

  if (empty($_POST['lamaLibur'])) {
      //$error[] = 'tidak boleh kosong';
      $lamaLibur= 0;
    } else {
      $lamaLibur= mysqli_real_escape_string($connection, $_POST['lamaLibur']);
  }
  
  if (empty($_POST['Keterangan'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $Keterangan= mysqli_real_escape_string($connection, $_POST['Keterangan']);
  }
  

  if (empty($error)) { 
    $update="UPDATE libur_kerja SET tanggal_libur='$tanggalLibur',
            ket_libur='$Keterangan',lama_libur='$lamaLibur' WHERE id_libur='$id'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
    }

break;
/* --------------- Delete ------------*/
case 'delete':
  $id       = $_POST['id'];
  
  $deleted  = "DELETE FROM libur_kerja WHERE id_libur='$id'";
    if($connection->query($deleted) === true) {
        echo'success';
      } else { 
        //tidak berhasil
        echo'Data tidak berhasil dihapus.!';
        die($connection->error.__LINE__);
    }
break;

}

}
