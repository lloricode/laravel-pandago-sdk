<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class OrderShowResponseDTO extends OrderResponseDTO
{
    public string $description;
    public string $tracking_link;
    public CancellationDTO $cancellation;
}