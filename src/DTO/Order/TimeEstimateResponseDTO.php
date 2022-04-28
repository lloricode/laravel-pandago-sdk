<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class TimeEstimateResponseDTO extends DataTransferObject
{
    public string $client_order_id;
    public string $estimated_pickup_time;
    public string $estimated_delivery_time;
}