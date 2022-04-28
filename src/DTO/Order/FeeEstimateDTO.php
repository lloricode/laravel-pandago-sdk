<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class FeeEstimateDTO extends DataTransferObject
{
    public SenderDTO $sender;
    public RecipientFeeDTO $recipient;
    public float $amount;
    public string $payment_method;
    public string $description;
}
