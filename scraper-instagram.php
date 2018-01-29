<?php

function myCurl($url)
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = json_decode(curl_exec($ch));
	curl_close($ch);
	var_dump($result);
	return $result;
}

// prendere un access token di instagram
$access_token = "2073815141.1677ed0.211954d90bef4c5ea9510e29400336e3";
// collegarsi https://api.instagram.com/v1/locations/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN e scaricare il json
// partiamo da Pisa
$lat = 43.416667;
$long = 10.716667;
$search_url = "https://api.instagram.com/v1/locations/search?lat=$lat&lng=long&access_token=$access_token";
$result = myCurl($search_url);
// a questo punto in result dovresti avere il risultato della search

// per ogni id restituito chiedere https://api.instagram.com/v1/locations/{location-id}/media/recent?access_token=ACCESS-TOKEN
foreach($result as $data => $list)
{
	for($i = 0; $i < count($list); $i++)
	{
		// salvare in una tabella locations i seguenti elementi
		$id = $list[$i]['id'];
		$lat1 = $list[$i]['lat'];
		$long1 = $list[$i]['long'];
		$name = $list[$i]['name'];
		// INSERT INTO locations(id,lat,long,name) VALUES ($id, $lat1, $long1, $name)
		
		$location_url = "https://api.instagram.com/v1/locations/$id/media/recent?access_token=$access_token";
		$result_id = myCurl($location_url);
		
		// scorrere l'array result_id e memorizzare nella tabella media
	}
}


?>