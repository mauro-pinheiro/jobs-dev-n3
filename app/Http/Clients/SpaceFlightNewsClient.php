<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class SpaceFlightNewsClient
{
    private $baseUri;

    public function __construct()
    {
        $this->baseUri = 'https://spaceflightnewsapi.net/api/v2';
    }

    public function getReports()
    {
        $url = "{$this->baseUri}/reports";
        return json_decode(Http::get($url)->body(), true);
    }
}
