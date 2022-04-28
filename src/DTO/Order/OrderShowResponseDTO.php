<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

class OrderShowResponseDTO extends OrderResponseDTO
{
    public string $description;
    public string $tracking_link;
    public ?CancellationDTO $cancellation;
}
