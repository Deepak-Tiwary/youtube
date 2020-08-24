<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Providers\YoutubeRepositoryInterface;


class getYoutubeVideos extends Controller
{
    
	public function search_results(Request $request)
	{
		$key = "AIzaSyA54gNx4uQjjkoDQrS7sKX7vyyN9nVHUNc";
		$search_val = $this->sanitize_string(str_replace(' ', '%20', $request->search));
		$base_url = "https://www.googleapis.com/youtube/v3/search?resource=videos&method=list&maxResults=8&key=".$key."&q=".$search_val;
		$json = file_get_contents($base_url);
		return response()->json($json);
	}
    
     
    public function getYoutubeByClass(YoutubeRepositoryInterface $youtubeRepository) 
    {
        $data = $youtubeRepository->search(request()->only(['query', 'pageToken']));
        return response()->json($data);
    }
	
	public function sanitize_string($string) 
	{
		$string = strip_tags($string);
		$string = addslashes($string);
		return filter_var($string, FILTER_SANITIZE_STRING);
	}
}


