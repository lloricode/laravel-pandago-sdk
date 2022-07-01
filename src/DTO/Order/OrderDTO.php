<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;
use Lloricode\LaravelPandagoSdk\Enum\PaymentMethod;

class OrderDTO extends BaseDTO
{
    public SenderDTO $sender;
    public RecipientDTO $recipient;
    /**
     * @var float|int
     */
    public $amount;
    public PaymentMethod $payment_method;
    public string $description;
}
