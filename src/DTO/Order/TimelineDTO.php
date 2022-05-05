<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class TimelineDTO extends DataTransferObject
{
    public ?string $estimated_pickup_time;
    public ?string $estimated_delivery_time;
}
