<?php

$url = "https://api.mapbox.com/geocoding/v5/mapbox.places/108.354266,-6.71777.json?types=place&access_token=pk.eyJ1IjoiZnl0b2tvIiwiYSI6ImNrcms0cnI5cDBkNzYyb285M2c4Mm0xbHcifQ.cFwLjER_o_zBmvCclZrlNg";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
//var_dump($resp);

$dt = json_decode($resp, TRUE);

$city = $dt["features"][0]["text"];
$Provence = $dt["features"][0]["context"][0]["text"];

echo "Kota : " . $city . " Provinsi : ".$Provence;

//print_r($resp);


?>