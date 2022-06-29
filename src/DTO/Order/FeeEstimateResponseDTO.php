<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class FeeEstimateResponseDTO extends DataTransferObject
{
    public ?string $client_order_id;
    /** @var int|float */
    public $estimated_delivery_fee;
}
