<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class WebController extends BaseController
{
    public function getCryptos()
    {
        $response = Http::withHeaders(
            ['X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')]
        )->get(
            'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
            ['start' => 1, 'limit' => 20, 'convert' => 'EUR']
        );

        if (!isset($response->json()['data'])) {
            throw new Exception('Api did not returned data');
        }

        $cryptos = [];
        if ($response->json())
        foreach ($response->json()['data'] as $cryptocurrency) {
            $crypto = new Crypto(
                $cryptocurrency['name'] ?? '',
                $cryptocurrency['quote']['EUR']['price'] ?? '',
                $cryptocurrency['quote']['EUR']['market_cap'] ?? '',
            );
            $cryptos[] = $crypto;
        }

        return View(
            'welcome',
            [
                'cryptos' => $cryptos
            ]
        );
    }
}
