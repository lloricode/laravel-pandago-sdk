<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class FeeEstimateResponseDTO extends BaseDTO
{
    public ?string $client_order_id;
    /** @var int|float */
    public $estimated_delivery_fee;
}
