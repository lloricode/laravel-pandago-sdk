<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class DriverDTO extends BaseDTO
{
    public ?string $id;
    public ?string $name;
    public ?string $phone_number;
}
