<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class FeeResponseDTO extends DataTransferObject
{
    public string $client_order_id;
    public float $estimated_delivery_fee;
}