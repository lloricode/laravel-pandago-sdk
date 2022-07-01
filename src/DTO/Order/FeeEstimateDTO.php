<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;
use Lloricode\LaravelPandagoSdk\Enum\PaymentMethod;

class FeeEstimateDTO extends BaseDTO
{
    public SenderDTO $sender;
    public RecipientFeeDTO $recipient;
    public float $amount;
    public PaymentMethod $payment_method;
    public string $description;
}
