<?php

// $data_set1 = json_decode(file_get_contents("data/countries.json"), true);
// $data_set2 = json_decode(file_get_contents("data/countrie_cia.json"), true);

// $country_data = json_decode(file_get_contents("data/all.json"), true)["Results"];

// for ($i = 0; $i < count($data_set1); $i++) {
// 	$code = $data_set1[$i]["iso2"];
// 	$data = $country_data[$code];
// 	unset($data['CountryInfo']);
// 	file_put_contents("data/countries/$code.json", json_encode($data, JSON_PRETTY_PRINT));
// }
//
$folder = dirname(dirname(__DIR__)) . "/Geographyyerf/countries/";
$files = scandir($folder);
print_r($files);