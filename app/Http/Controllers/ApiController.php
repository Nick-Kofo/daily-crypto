<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class APiController extends BaseController
{
    public function getCryptoPrices()
    {
        $response = Http::withHeaders(
            ['X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')]
        )->get(
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
            ['start' => 1, 'limit' => 20, 'convert' => 'EUR']
        );

        return $response->json();
    }
}
