<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class LocationDTO extends BaseDTO
{
    public string $address;
    public float $latitude;
    public float $longitude;
    public ?string $notes;
}
