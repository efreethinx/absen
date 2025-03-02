<?php
$DB_HOST 	= 'localhost';
$DB_USER 	= 'leub2483_absensi'; // User Database
$DB_PASSWD  = 'Mundingan11!'; // Password Database
$DB_NAME 	= 'leub2483_absensi'; // Nama database
// -------------- Koneksi Database ------------
@define("DB_HOST", $DB_HOST);
@define("DB_USER", $DB_USER);
@define("DB_PASSWD" , $DB_PASSWD);
@define("DB_NAME", $DB_NAME);
$connection = NEW mysqli( $DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME );
if ($connection->connect_error){
		echo 'Gagal koneksi ke database';
	} else {
		$query_site  = "SELECT * FROM site LIMIT 1";
		$result_site = $connection->query($query_site);
		$row_site    = $result_site->fetch_assoc();
		extract($row_site);
}

$update ="UPDATE randem SET countx='0'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Meng-Nolkan Data Randem';
              } else{
                  //echo'Berhasil Meng-Nolkan Data Randem';x
              }
              
$update ="UPDATE link_nilai SET user1='',user2='',user3=''";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Meng-Nolkan Data Randem';
              } else{
                  //echo'Berhasil Meng-Nolkan Data Randem';x
              }              

$idx = null;
$total = 0;
$nilairandom = 0;
$query_absen="SELECT * FROM employees where position_id = 1";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $idx[] = $row_absen['id'];
                                                $coba1 = $row_absen['id'];
                                                $pid = $row_absen['position_id'];
                                                array_push($idx);
                                                
                                                
                                                
    //                                             $add ="INSERT INTO randem (employees_id,position_id,
    //           countx) values('$coba1','$pid',
    //           '0')";
    // if($connection->query($add) === false) {
    //     die($connection->error.__LINE__); 
    //     echo'Data tidak berhasil disimpan! <br>';
    // } else{
    //     echo'Data berhasil disimpan <br>';
    // }
    //                                             $add ="INSERT INTO link_nilai (employees_id,position_id) values('$coba1','$pid')";
    // if($connection->query($add) === false) {
    //     die($connection->error.__LINE__); 
    //     echo'Data tidak berhasil disimpan! <br>';
    // } else{
    //     echo'Data berhasil disimpan <br>';
    // }
                                                
                                                
                                                
                                            }
                                        }
                                        //print_r($idx);
                                        
$total = count($idx);
//echo 'Total Data'.$total.'<br>';x
$datawal = $idx[0];


function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


for ($i = 1 ; $i <= $total; $i++)
{
    $nilaicount = 0;
   $query_absen="SELECT * FROM randem WHERE countx < 3 AND position_id = 1";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $idt[] = $row_absen['employees_id'];
                                                array_push($idt);
                                                // $nilaicount = $row_absen['countx'];
                                                
                                                
                                            }
                                        }

$totalx = count($idt);                                              

// $nilaicount = $nilaicount +1;

//echo '  <br>  <br>Random : <br>';x

$nilairandom = randomGen(0,($totalx - 1),3);
//print_r($nilairandom);x

//echo '  <br>  <br>Data Id : '.$idt[0].' <br> <br>';x


$datawalx = $idt[0];

$data1 = $idt[$nilairandom[0]];
$data2 = $idt[$nilairandom[1]];
$data3 = $idt[$nilairandom[2]];

$IDDDX = null;
$query_absen="SELECT * FROM link_nilai WHERE id_link = '$i'";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $IDDDX = $row_absen['employees_id'];
                                            }
                                        }

// if($IDDDX == $data1 || $IDDDX == $data2 || $IDDDX == $data3){
//     echo '<script>location.reload();</script>';
// }

while ($IDDDX == $data1 || $IDDDX == $data2 || $IDDDX == $data3) {
    # code...
    $nilairandom = randomGen(0,($totalx - 1),3);

    $data1 = $idt[$nilairandom[0]];
    $data2 = $idt[$nilairandom[1]];
    $data3 = $idt[$nilairandom[2]];
}

// echo 'Data Ke 1 : '. $data1.'<br>';x
// echo 'Data Ke 2 : '. $data2.'<br>';x
// echo 'Data Ke 3 : '. $data3.'<br>';x




$query_absen="SELECT * FROM randem WHERE employees_id = '$data1' ";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $nilaicount = $row_absen['countx'];
                                                
                                                if ($nilaicount < 3){
                                                    
                                                    $nilaicount = $nilaicount +1;
                                                    
                                                    $update ="UPDATE randem SET countx='$nilaicount' WHERE employees_id='$data1'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Menambah';
              } else{
                  //echo'Berhasil Menambah';x
              }
                                                  

                                                    
                                                    
                                                }
                                                
                                                
                                            }
                                        }
                                        
                                        

$query_absen="SELECT * FROM randem WHERE employees_id = '$data2' ";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $nilaicount = $row_absen['countx'];
                                                
                                                if ($nilaicount < 3){
                                                    
                                                    $nilaicount = $nilaicount +1;
                                                    
                                                    $update ="UPDATE randem SET countx='$nilaicount' WHERE employees_id='$data2'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Menambah';
              } else{
                  //echo'Berhasil Menambah';x
              }
                                                    
                                                    
                                                }
                                                
                                                
                                            }
                                        }
                                        
                                        
$query_absen="SELECT * FROM randem WHERE employees_id = '$data3' ";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                $nilaicount = $row_absen['countx'];
                                                
                                                if ($nilaicount < 3){
                                                    
                                                    $nilaicount = $nilaicount +1;
                                                    
                                                    $update ="UPDATE randem SET countx='$nilaicount' WHERE employees_id='$data3'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Menambah';
              } else{
                  //echo'Berhasil Menambah';x
              }
                                                    
                                                    
                                                }
                                                
                                                
                                            }
                                        }                                        


//menambah data acak untuk penilaian
// $IDDDX = null;
// $query_absen="SELECT * FROM link_nilai WHERE id_link = '$i' ";
//                                         $result_absen = $connection->query($query_absen);
//                                         if($result_absen->num_rows > 0){
//                                             while ($row_absen= $result_absen->fetch_assoc()) {
//                                                 $IDDDX = $row_absen['employees_id'];
//                                             }
//                                         }

// if($IDDDX == $data1 || $IDDDX == $data2 || $IDDDX == $data3){
//     echo '<script>location.reload();</script>';
// }


$update ="UPDATE link_nilai SET user1 = '$data1',user2 = '$data2', user3 = '$data3' WHERE id_link='$i'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Menambah';
              } else{
                  //echo'Berhasil Menambah';x
              }






// $update ="UPDATE randem SET countx='$nilaicount' WHERE employees_id='$data1'";
//               if($connection->query($update) === false) { 
//                   die($connection->error.__LINE__); 
//                   echo'Gagal Menambah';
//               } else{
//                   echo'Berhasil Menambah';
//               }


//  $add ="INSERT INTO link_nilai (employees_id,
//               user1,user2,user3,tot) values('$datawalx',
//               '$data1','$data2','$data3','0')";
//     if($connection->query($add) === false) {
//         die($connection->error.__LINE__); 
//         echo'Data tidak berhasil disimpan! <br>';
//     } else{
//         echo'Data berhasil disimpan <br>';
//     }



unset($idt);
$idt = array();
                                        
}

//check kalau ada data masih kosong

$query_absen="SELECT * FROM link_nilai WHERE position_id = 1 AND (user1='' OR user2='' OR user3='')";
                                        $result_absen = $connection->query($query_absen);
                                        if($result_absen->num_rows > 0){
                                            while ($row_absen= $result_absen->fetch_assoc()) {
                                                 //echo 'Data Kosong Pada Urutan Ke : '.$row_absen['id_link'].'<br>';
                                                
                                                
                                                
                                                $update ="UPDATE randem SET countx='0'";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Meng-Nolkan Data Randem';
              } else{
                  //echo'Berhasil Meng-Nolkan Data Randem';x
              }
              
              $update ="UPDATE link_nilai SET user1='',user2='',user3='',nilai1='',nilai2='',nilai3='',tot=''";
              if($connection->query($update) === false) { 
                  die($connection->error.__LINE__); 
                  echo'Gagal Mengkosongkan Link Nilai';
              } else{
                  //echo'Berhasil Mengkosongkan Link Nilai';x
                  echo '<script>location.reload();</script>';
              }
                                                
                                                
                                            }
                                        }else{
                                         //echo '<script>window.location.href = "https://skensala.tech/tester2.php";</script>';   
                                        }



                                        echo '<script>window.location.href = "https://absensi.leuwimunding.my.id/ranpenilaianx";</script>';   
//echo '<script>window.location.href = "https://presensi.skensala.tech/admin/system";</script>';

// $add ="INSERT INTO link_nilai (employees_id,
//               user1,
//               user2,
//               user3) values('$datawal',
//               '$data1',
//               '$data2',
//               '$data3')";
//     if($connection->query($add) === false) {
//         die($connection->error.__LINE__); 
//         echo'Data tidak berhasil disimpan!';
//     } else{
//         echo'Data berhasil disimpan!';
//     }




?>