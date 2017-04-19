<?php
$url = "https://www.cia.gov/library/publications/the-world-factbook/fields/2051.html";
$ch = curl_init();
$request_headers = [
	'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8;',
	'Accept-Language: en-US,en;q=0.5',
	'Accept-Encoding: gzip, deflate',
	"Connection: keep-alive",
	"Content-Type: text/html; charset=UTF-8",
];
$options = [
	CURLOPT_URL => $url,
	CURLOPT_HTTPHEADER => $request_headers,
	CURLOPT_USERAGENT => "CURL_USERAGENT", "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:47.0) Gecko/20100101 Firefox/47.0",
	CURLOPT_CONNECTTIMEOUT => 30,
	CURLOPT_BINARYTRANSFER => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_SSL_VERIFYHOST => false,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_AUTOREFERER => true,
	CURLOPT_COOKIESESSION => true,
	CURLOPT_FILETIME => true,
	CURLOPT_FRESH_CONNECT => true,
	CURLOPT_COOKIESESSION => true,
	CURLOPT_ENCODING => "gzip, deflate, scdh",
];
unset($request_header);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);
//parse page
libxml_use_internal_errors(false);
$dom = new \DOMDocument();
@$dom->loadHTML($result);
$filename = dirname(__FILE__) . "/countries/";
//parse table to get countries and state
$xpath = new \DOMXpath($dom);
$table_data = $xpath->query("//table/tbody/tr");
$countries_list = [];
for ($i = 1; $i < $table_data->length; $i++) {
	$row = $table_data[$i]->childNodes;
	$country = $row[0]->nodeValue;
	$countries_list[] = $country;
	$states = $row[1]->nodeValue;
	$note = false;
	if (stripos($states, "note:") !== false) {
		$state_data = explode("note:", $states)[0];
		$note = true;
	}
	$state_data = ($note) ? $state_data : $states;
	if (stripos($state_data, ";") !== false) {
		$state_data = explode(";", $state_data)[1];
	}
	$state_data = explode(",", $state_data);
	$data = [
		"country" => $country,
		"states" => $state_data,
	];
	echo "$country \n";
	$content = json_encode($data, JSON_PRETTY_PRINT);
	file_put_contents($filename . $country . ".json", $content);
}
file_put_contents("countries.json", json_encode($countries_list, JSON_PRETTY_PRINT));
echo "done";