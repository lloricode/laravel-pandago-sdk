<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class CancellationDTO extends DataTransferObject
{
    public string $reason;
    public string $source;
}
