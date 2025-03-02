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
  
  if (empty($_POST['idPegawaix'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $idPegawaix = mysqli_real_escape_string($connection, $_POST['idPegawaix']);
  }

  if (empty($_POST['hari'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $hari= mysqli_real_escape_string($connection, $_POST['hari']);
  }
  if (empty($_POST['mapel'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $mapel= mysqli_real_escape_string($connection, $_POST['mapel']);
  }
  if (empty($_POST['jamke'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $jamke= mysqli_real_escape_string($connection, $_POST['jamke']);
  }
  if (empty($_POST['masuk'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $masuk= mysqli_real_escape_string($connection, $_POST['masuk']);
  }
  if (empty($_POST['keluar'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $keluar= mysqli_real_escape_string($connection, $_POST['keluar']);
  }
  if (empty($_POST['lama'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $lama= mysqli_real_escape_string($connection, $_POST['lama']);
  }
  if (empty($_POST['kelas'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $kelas= mysqli_real_escape_string($connection, $_POST['kelas']);
  }
  if (empty($_POST['tapel'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $tapel= mysqli_real_escape_string($connection, $_POST['tapel']);
  }
  if (empty($_POST['semester'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $semester= mysqli_real_escape_string($connection, $_POST['semester']);
  }

  if (empty($error)) { 

    $add ="INSERT INTO  jadwal (id_pegawai,hari,mapel,jamke,jam_awal,jam_akhir,lama,kelas,tapel,semester) values('$idPegawaix','$hari','$mapel','$jamke','$masuk','$keluar','$lama','$kelas','$tapel','$semester')"; 
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan masih ada yang kosong..!';
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

  if (empty($_POST['name'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $name= mysqli_real_escape_string($connection, $_POST['name']);
  }

  if (empty($_POST['address'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $address= mysqli_real_escape_string($connection, $_POST['address']);
  }
  
  if (empty($_POST['latitude'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $latitude= mysqli_real_escape_string($connection, $_POST['latitude']);
  }
  if (empty($_POST['longitude'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $longitude= mysqli_real_escape_string($connection, $_POST['longitude']);
  }
   if (empty($_POST['city'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $city= mysqli_real_escape_string($connection, $_POST['city']);
  }

  if (empty($error)) { 
    $update="UPDATE building SET name='$name',
            address='$address',latitude='$latitude',longitude='$longitude',city='$city' WHERE building_id='$id'"; 
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
  $id       = mysqli_real_escape_string($connection,epm_decode($_POST['id']));
  $query ="SELECT building,building_id,employees.id FROM building,employees WHERE building.building_id=employees.building_id AND building='$id'";
  $result = $connection->query($query);
  if(!$result->num_rows > 0){
  $deleted  = "DELETE FROM building WHERE building_id='$id'";
    if($connection->query($deleted) === true) {
        echo'success';
      } else { 
        //tidak berhasil
        echo'Data tidak berhasil dihapus.!';
        die($connection->error.__LINE__);
    }}else{
      echo'Lokasi digunakan, Data tidak dapat dihapus.!';
    }
break;

}

}
