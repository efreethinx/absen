<?php
$DB_HOST     = 'localhost';
$DB_USER     = 'leub2483_absensi'; // User Database
$DB_PASSWD  = 'Mundingan11!'; // Password Database
$DB_NAME     = 'leub2483_absensi'; // Nama database
// -------------- Koneksi Database ------------
@define("DB_HOST", $DB_HOST);
@define("DB_USER", $DB_USER);
@define("DB_PASSWD", $DB_PASSWD);
@define("DB_NAME", $DB_NAME);
$connection = new mysqli($DB_HOST, $DB_USER, $DB_PASSWD, $DB_NAME);
if ($connection->connect_error) {
    echo 'Gagal koneksi ke database';
} else {
    $query_site  = "SELECT * FROM site LIMIT 1";
    $result_site = $connection->query($query_site);
    $row_site    = $result_site->fetch_assoc();
    extract($row_site);
}

$update = "UPDATE randem SET countx='0'";
if ($connection->query($update) === false) {
    die($connection->error . __LINE__);
    echo 'Gagal Meng-Nolkan Data Randem';
} else {
    //echo'Berhasil Meng-Nolkan Data Randem';x
}

$update = "UPDATE link_nilai SET user1='',user2='',user3=''";
if ($connection->query($update) === false) {
    die($connection->error . __LINE__);
    echo 'Gagal Meng-Nolkan Data Randem';
} else {
    //echo'Berhasil Meng-Nolkan Data Randem';x
}

$idx = null;
$total = 0;
$nilairandom = 0;
$query_absen = "SELECT * FROM employees where position_id = 1";
$result_absen = $connection->query($query_absen);
if ($result_absen->num_rows > 0) {
    while ($row_absen = $result_absen->fetch_assoc()) {
        $idx[] = $row_absen['id'];
        $coba1 = $row_absen['id'];
        $pid = $row_absen['position_id'];
        array_push($idx);



        $add = "INSERT INTO randem (employees_id,position_id,
              countx) values('$coba1','$pid',
              '0')";
        if ($connection->query($add) === false) {
            die($connection->error . __LINE__);
            echo 'Data tidak berhasil disimpan! <br>';
        } else {
            echo 'Data berhasil disimpan <br>';
        }
        $add = "INSERT INTO link_nilai (employees_id,position_id) values('$coba1','$pid')";
        if ($connection->query($add) === false) {
            die($connection->error . __LINE__);
            echo 'Data tidak berhasil disimpan! <br>';
        } else {
            echo 'Data berhasil disimpan <br>';
        }
    }
}
