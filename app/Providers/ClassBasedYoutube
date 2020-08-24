<?php

namespace App\Providers;


class ClassBasedYoutube
{
	
	
	
    public function getYoutubeByClass($search_val)
    {
		$key = "AIzaSyA54gNx4uQjjkoDQrS7sKX7vyyN9nVHUNc";
		$base_url = "https://www.googleapis.com/youtube/v3/search?resource=videos&method=list&maxResults=8&key=".$key."&q=".$search_val;
		$json = file_get_contents($base_url);
		return $json;
    }

}
