<?php

namespace Lloricode\LaravelPandagoSdk\API\Order;

use Illuminate\Http\Client\Response;
use Lloricode\LaravelPandagoSdk\API\BaseAPI;
use Lloricode\LaravelPandagoSdk\DTO\Order\CoordinatesDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeEstimateDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeEstimateResponseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderResponseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderShowResponseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\TimeEstimateDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\TimeEstimateResponseDTO;

class OrderAPI extends BaseAPI
{
    protected function url(): string
    {
        return config('pandago-sdk.country_code').'/api/v1/orders';
    }

    public static function fake(): FakeOrderAPI
    {
        return app(FakeOrderAPI::class);
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function submit(OrderDTO $orderDTO): OrderResponseDTO
    {
        return new OrderResponseDTO(
            $this->pandagoClient
                ->client()
                ->post($this->url(), $orderDTO->toArray())
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function show(string $orderId): OrderShowResponseDTO
    {
        return new OrderShowResponseDTO(
            $this->pandagoClient
                ->client()
                ->get($this->url().'/'.$orderId)
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function cancel(string $orderId, string $reason): string
    {
        $response = $this->pandagoClient
            ->client()
            ->delete($this->url().'/'.$orderId, ['reason' => $reason])
            ->throw(fn (Response $response) => report($response->body()));

        $responseCollection = $response->collect();

        if ($responseCollection->isEmpty() && $response->status() === 204) {
            return __('Successful cancelled.');
        }

        return $responseCollection['message'];
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function coordinates(string $orderId): CoordinatesDTO
    {
        return new CoordinatesDTO(
            $this->pandagoClient
                ->client()
                ->get($this->url().'/'.$orderId.'/coordinates')
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function feeEstimate(FeeEstimateDTO $feeEstimateDTO): FeeEstimateResponseDTO
    {
        return new FeeEstimateResponseDTO(
            $this->pandagoClient
                ->client()
                ->post($this->url().'/fee', $feeEstimateDTO->toArray())
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function timeEstimate(TimeEstimateDTO $timeEstimateDTO): TimeEstimateResponseDTO
    {
        return new TimeEstimateResponseDTO(
            $this->pandagoClient
                ->client()
                ->post($this->url().'/time', $timeEstimateDTO->toArray())
                ->throw(fn (Response $response) => report($response->body()))
                ->collect()
                ->toArray()
        );
    }
}
