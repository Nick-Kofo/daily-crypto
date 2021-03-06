<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class WebController extends BaseController
{
    public function index()
    {
        return View(
            'welcome',
            [
                'topCryptos' => $this->getTopCryptos(),
                'trendingCryptos' => $this->getTrendingCryptos(),
                'popularTweets' => $this->getPopularTweets()
            ]
        );
    }

    private function getTopCryptos(): array
    {
        $response = Http::withHeaders(['X-CMC_PRO_API_KEY' => env('COINMARKETCAP_API_KEY')])
        ->get(
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

        return $cryptos;
    }

    private function getTrendingCryptos(): array
    {
        $response = Http::get('https://api.coingecko.com/api/v3/search/trending');

        if (!isset($response->json()['coins'])) {
            throw new Exception('Api did not returned coins');
        }

        $cryptos = [];
        if ($response->json())
        foreach ($response->json()['coins'] as $cryptocurrency) {
            $crypto = new Crypto(
                $cryptocurrency['item']['name'] ?? ''
            );
            $cryptos[] = $crypto;
        }

        return $cryptos;
    }

    private function getPopularTweets(): array
    {
        $response = Http::withHeaders(['Authorization' => sprintf('Bearer %s', env('TWEETER_BEARER_TOKEN'))])
        ->get(
            'https://api.twitter.com/2/tweets/search/recent',
            ['query' => '#crypto']
        );

        echo '<pre>'; print_r(json_encode($response->json()['data'])); die;

        if (!isset($response->json()['coins'])) {
            throw new Exception('Api did not returned coins');
        }

        $cryptos = [];
        if ($response->json())
        foreach ($response->json()['coins'] as $cryptocurrency) {
            $crypto = new Crypto(
                $cryptocurrency['item']['name'] ?? ''
            );
            $cryptos[] = $crypto;
        }

        return $cryptos;
    }
}
