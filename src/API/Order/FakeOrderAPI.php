<?php

namespace Lloricode\LaravelPandagoSdk\API\Order;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;

class FakeOrderAPI extends OrderAPI
{
    public function fakeSubmit(?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake(self::URL, $response);

        return $this;
    }
    public function fakeShow(string $orderId, ?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake(self::URL.'/'.$orderId, $response);

        return $this;
    }

    public function fakeCancel(string $orderId,?PromiseInterface $response = null): self
    {
        $response ??= Http::response(null, 203);

        $this->pandagoClient->fake(self::URL.'/'.$orderId, $response);

        return $this;
    }

    public function fakeCoordinates(string $orderId, ?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake(self::URL.'/'.$orderId.'/coordinates', $response);

        return $this;
    }

    public function fakeFee(?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake(self::URL.'/fee', $response);

        return $this;
    }
}
