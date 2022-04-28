<?php

namespace Lloricode\LaravelPandagoSdk\API\Order;

use Lloricode\LaravelPandagoSdk\API\BaseAPI;
use Lloricode\LaravelPandagoSdk\DTO\Order\CoordinatesDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeResponseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderResponseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderShowResponseDTO;

class OrderAPI extends BaseAPI
{
    protected const URL = 'sg/api/v1/orders';

    public function submit(OrderDTO $orderDTO): OrderResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->post(self::URL, $orderDTO->toArray());

        $response->throw();

        return new OrderResponseDTO($response->collect()->toArray());
    }

    public function show(string $orderId): OrderShowResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->get(self::URL.'/'.$orderId);

        $response->throw();

        return new OrderShowResponseDTO($response->collect()->toArray());
    }

    public function cancel(string $orderId, string $reason)
    {
        $response = $this->pandagoClient
            ->client()
            ->delete(self::URL.'/'.$orderId, ['reason' => $reason]);

        $response->throw();

        return $response;
    }

    public function coordinates(string $orderId): CoordinatesDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->get(self::URL.'/'.$orderId.'/coordinates');

        $response->throw();

        return new CoordinatesDTO($response->collect()->toArray());
    }

    public function feeEstimate(FeeDTO $feeDTO): FeeResponseDTO
    {
        $response = $this->pandagoClient
            ->client()
            ->post(self::URL.'/fee', $feeDTO->toArray());

        $response->throw();

        return new FeeResponseDTO($response->collect()->toArray());
    }
}
