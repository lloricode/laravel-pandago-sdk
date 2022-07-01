<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class CoordinatesDTO extends BaseDTO
{
    public ?string $client_order_id;
    public float $latitude;
    public float $longitude;
    public int $updated_at;
}
