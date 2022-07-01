<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

class OrderShowResponseDTO extends OrderResponseDTO
{
//    public $proof_of_delivery_url; // missing on production

    public string $description;
    public ?string $tracking_link;
    public ?CancellationDTO $cancellation;
}
