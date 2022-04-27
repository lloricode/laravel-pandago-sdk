<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class RecipientFeeDTO extends DataTransferObject
{
    public LocationDTO $location;
    public string $notes;
}
