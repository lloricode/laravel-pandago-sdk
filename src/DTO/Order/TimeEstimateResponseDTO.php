<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class TimeEstimateResponseDTO extends DataTransferObject
{
//    public ?string $client_order_id;
    public string $estimated_pickup_time;
    public string $estimated_delivery_time;

    /**
     * @return array<string, string>
     */
    public function toDateReadable(string $format = 'm/d/Y h:i A', string $timezone = null): array
    {
        return [
            'estimated_pickup_time' => now()->parse($this->estimated_pickup_time, $timezone)->format($format),
            'estimated_delivery_time' => now()->parse($this->estimated_delivery_time, $timezone)->format($format),
        ];
    }
}
