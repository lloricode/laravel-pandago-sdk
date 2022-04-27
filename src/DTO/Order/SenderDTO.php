<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class SenderDTO extends DataTransferObject
{
    public string $name;
    public string $phone_number;
    public LocationDTO $location;
    public string $notes;
}