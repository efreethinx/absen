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
  
  if (empty($_POST['title'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $title = mysqli_real_escape_string($connection, $_POST['title']);
  }

  if (empty($_POST['tanggal'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $tanggal= mysqli_real_escape_string($connection, $_POST['tanggal']);
  }
  if (empty($_POST['perihal'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $perihal= mysqli_real_escape_string($connection, $_POST['perihal']);
  }
  if (empty($_POST['pengumuman'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $pengumuman= mysqli_real_escape_string($connection, $_POST['pengumuman']);
  }
  if (empty($_POST['pinned'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $pinned= mysqli_real_escape_string($connection, $_POST['pinned']);
  }
  

  if (empty($error)) { 

    $add ="INSERT INTO pengumuman (title,tanggal,perihal,pengumuman,pinned) values('$title','$tanggal','$perihal','$pengumuman','$pinned')"; 
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

  $error = array();
  
  if (empty($_POST['title'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $title = mysqli_real_escape_string($connection, $_POST['title']);
  }

  if (empty($_POST['tanggal'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $tanggal= mysqli_real_escape_string($connection, $_POST['tanggal']);
  }
  if (empty($_POST['perihal'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $perihal= mysqli_real_escape_string($connection, $_POST['perihal']);
  }
  if (empty($_POST['pengumuman'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $pengumuman= mysqli_real_escape_string($connection, $_POST['pengumuman']);
  }
  if (empty($_POST['pinned'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $pinned= mysqli_real_escape_string($connection, $_POST['pinned']);
  }
  

  if (empty($error)) { 
    $update="UPDATE pengumuman SET title='$title',perihal='$perihal',pengumuman='$pengumuman',pinned='$pinned' WHERE idNotif='$id'"; 
    // var_dump($update);
    // echo var_dump($update);
    // end;
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
  $id       = mysqli_real_escape_string($connection,($_POST['id']));
  
  $deleted  = "DELETE FROM pengumuman WHERE idNotif='$id'";
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
