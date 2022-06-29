<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\Enum\PaymentMethod;
use Spatie\DataTransferObject\DataTransferObject;

class FeeEstimateDTO extends DataTransferObject
{
    public SenderDTO $sender;
    public RecipientFeeDTO $recipient;
    public float $amount;
    public PaymentMethod $payment_method;
    public string $description;
}
