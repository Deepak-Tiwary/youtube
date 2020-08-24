<?php

namespace App\Providers;

use App\Providers\YoutubeRepositoryInterface;

class YoutubeRepository implements YoutubeRepositoryInterface
{

    private $_MAX_RESULTS = 8; // Default number of results
    private $_baseUrl;
    private $_apiKey;

    public function __construct()
    {
        $this->_baseUrl = config('app.youtube_url');
        $this->_apiKey = config('app.youtube_api_key');
    }
    
    public function search($data)
    {
        $requestUrl = "{$this->_baseUrl}/search?key={$this->_apiKey}&part=snippet&maxResults={$this->_MAX_RESULTS}";

        if (isset($data['query']) && $data['query'] != '') {
            $requestUrl .= '&q=' . urlencode($data['query']);
        }

        if (isset($data['pageToken']) && $data['pageToken'] != '') {
            $requestUrl .= "&pageToken={$data['pageToken']}";
        }

        $response = makeRequest($requestUrl, 'GET');

        if ($response['success'] && !isset($response['data']['error'])) {
            return $response;
        }
        return [
                'success' => false,
                'data' => null,
                'error' => 'No search result(s) available'
            ];
    }

}
