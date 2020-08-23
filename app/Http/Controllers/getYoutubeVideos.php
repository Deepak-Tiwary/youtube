<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getYoutubeVideos extends Controller
{
    
	public function search_results(Request $request)
	{
		$base_url_prefix = "https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=8&q=";
		$search_val = $this->sanitize_string($request->search);
		$base_url_postfix = "&type=video&key=AIzaSyDbwf-g7rDrTAQEixOHMcA_2AW10L2VS6A";
		$json = file_get_contents($base_url_prefix.$search_val.$base_url_postfix);
		return response()->json($json);
	}
	
	public function sanitize_string($string) 
	{
		$string = strip_tags($string);
		$string = addslashes($string);
		//return filter_var($string, FILTER_SANITIZE_STRING);
        return $string;
	}
}
