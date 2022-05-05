<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class DriverDTO extends DataTransferObject
{
    public ?string $id;
    public ?string $name;
    public ?string $phone_number;
}
