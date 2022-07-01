<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class TimelineDTO extends BaseDTO
{
    public ?string $estimated_pickup_time;
    public ?string $estimated_delivery_time;
}
