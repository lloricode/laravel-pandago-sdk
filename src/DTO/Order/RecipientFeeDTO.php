<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class RecipientFeeDTO extends BaseDTO
{
    public string $name;
    public string $phone_number;
    public LocationDTO $location;
    public string $notes;
}
