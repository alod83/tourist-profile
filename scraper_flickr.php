<?php

function myCurl($url)
{
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = json_decode(curl_exec($ch));
	curl_close($ch);
	return $result;
}

$api_key="79593d3db6c800d9321f76960c2a2cae";

$lat = 43.713;
$long = 10.400;
$base_url = "https://api.flickr.com/services/rest/?method=";
$end_url="&api_key=$api_key&lat=$lat&lon=$long&format=json&nojsoncallback=1";


$photos_search_url=$base_url."flickr.photos.search".$end_url;
$result = myCurl($photos_search_url);

// scorro la lista delle foto
$photo_list = $result->photos->photo;

for($i = 0; $i < count($photo_list); $i++)
{
	$photo_id = $photo_list[$i]->id;
	//echo $photo_id."\n";
	// per ogni foto prendo i commenti
	$photo_comments_url = $base_url."flickr.photos.comments.getList&api_key=$api_key&photo_id=".$photo_id."&format=json&nojsoncallback=1";
	$comments_result = myCurl($photo_comments_url);
	
	if(isset($comments_result->comments->comment))
	{
		echo $photo_id."<br>";
		$comment_list = $comments_result->comments->comment;
		for($j = 0; $j < count($comment_list); $j++)
		{
			$comment = $comment_list[$j]->_content;
			echo $comment."<br>";
		}
	}
}
?>