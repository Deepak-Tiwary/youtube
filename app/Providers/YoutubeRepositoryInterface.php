<?php

namespace App\Providers;

interface YoutubeRepositoryInterface
{

    /**
     * Search method to return list of videos
     *
     * @param array $data Should contain searck keyword/pageToken
     * 
     * @return void
     */
    public function search(array $data);
}
