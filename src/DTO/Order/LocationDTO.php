<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class LocationDTO extends DataTransferObject
{
    public string $address;
    public float $latitude;
    public float $longitude;
}
