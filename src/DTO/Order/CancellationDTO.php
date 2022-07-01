<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class CancellationDTO extends BaseDTO
{
    public string $reason;
    public string $source;
}
