<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Order;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;

class OrderResponseDTO extends BaseDTO
{
    public string $order_id;
    public ?string $client_order_id;
    public SenderDTO $sender;
    public RecipientDTO $recipient;
    /**
     * @var float|int
     */
    public $amount;

    public string $payment_method;
    public bool $coldbag_needed;
    public string $status;
    public string $description;
    public int $delivery_fee;
    public TimelineDTO $timeline;
    public DriverDTO $driver;
    public int $created_at;
    public int $updated_at;
    public ?array $delivery_tasks;
}
