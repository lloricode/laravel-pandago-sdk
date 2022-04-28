<?php

namespace Lloricode\LaravelPandagoSdk\API\Order;

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
    protected const URL = 'sg/api/v1/orders';

    public static function newFake(): FakeOrderAPI
    {
        return app(FakeOrderAPI::class);
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function submit(OrderDTO $orderDTO): OrderResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->post(self::URL, $orderDTO->toArray());

        $response->throw();

        return new OrderResponseDTO($response->collect()->toArray());
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function show(string $orderId): OrderShowResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->get(self::URL.'/'.$orderId);

        $response->throw();

        return new OrderShowResponseDTO($response->collect()->toArray());
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function cancel(string $orderId, string $reason)
    {
        $response = $this->pandagoClient
            ->client()
            ->delete(self::URL.'/'.$orderId, ['reason' => $reason]);

        $response->throw();

        return $response;
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function coordinates(string $orderId): CoordinatesDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->get(self::URL.'/'.$orderId.'/coordinates');

        $response->throw();

        return new CoordinatesDTO($response->collect()->toArray());
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function feeEstimate(FeeEstimateDTO $feeEstimateDTO): FeeEstimateResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->post(self::URL.'/fee', $feeEstimateDTO->toArray());

        $response->throw();

        return new FeeEstimateResponseDTO($response->collect()->toArray());
    }

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function timeEstimate(TimeEstimateDTO $timeEstimateDTO): TimeEstimateResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->post(self::URL.'/time', $timeEstimateDTO->toArray());

        $response->throw();

        return new TimeEstimateResponseDTO($response->collect()->toArray());
    }
}
