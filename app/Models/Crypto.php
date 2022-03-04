<?php

namespace App\Models;

class Crypto
{
    private string $name;

    private string $price;

    private string $marketCap;


    public function __construct(string $name, string $price, string $marketCap)
    {
        $this->name = $name;
        $this->price = $price;
        $this->marketCap = $marketCap;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getMarketCap(): string
    {
        return $this->marketCap;
    }
}
