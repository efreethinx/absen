<?php
$inp = file_get_contents('localhost/neural'); //$inp = file_get_contents('https://absensi.leuwimunding.my.id/neural');
$tempArray = json_decode($inp);
$jsonData = json_encode($tempArray);
echo $jsonData;
