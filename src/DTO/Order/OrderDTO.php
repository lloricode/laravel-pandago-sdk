<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class OrderDTO extends DataTransferObject
{
    public SenderDTO $sender;
    public RecipientDTO $recipient;
    public float $amount;
    public string $payment_method;
    public string $description;
}
