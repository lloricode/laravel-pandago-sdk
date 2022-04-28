<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class CoordinatesDTO extends DataTransferObject
{
    public string $client_order_id;
    public float $latitude;
    public float $longitude;
    public int $updated_at;
}
