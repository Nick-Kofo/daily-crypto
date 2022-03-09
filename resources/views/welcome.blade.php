<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daily Crypto</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        >

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous">
        </script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <h3>Top Cryptos</h3>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Market Cap</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($topCryptos as $key => $crypto)
                    <tr>
                    <td>{{ $crypto->getName() }}</td>
                    <td>{{ $crypto->getPrice() }}</td>
                    <td>{{ $crypto->getMarketCap() }}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Trending Cryptos</h3>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($trendingCryptos as $key => $crypto)
                    <tr>
                    <td>{{ $crypto->getName() }}</td>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
