<?php

namespace Lloricode\LaravelPandagoSdk\API\Order;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;

class FakeOrderAPI extends OrderAPI
{
    public function fakeSubmit(?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake($this->url(), $response);

        return $this;
    }

    public function fakeShow(string $orderId, ?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake($this->url().'/'.$orderId, $response);

        return $this;
    }

    public function fakeCancel(string $orderId, ?PromiseInterface $response = null): self
    {
        $response ??= Http::response(null, 203);

        $this->pandagoClient->fake($this->url().'/'.$orderId, $response);

        return $this;
    }

    public function fakeCoordinates(string $orderId, ?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake($this->url().'/'.$orderId.'/coordinates', $response);

        return $this;
    }

    public function fakeFeeEstimate(?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake($this->url().'/fee', $response);

        return $this;
    }

    public function fakeTimeEstimate(?PromiseInterface $response = null): self
    {
        $response ??= Http::response();

        $this->pandagoClient->fake($this->url().'/time', $response);

        return $this;
    }
}
