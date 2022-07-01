<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Callback;

use Lloricode\LaravelPandagoSdk\DTO\BaseDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\CancellationDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\DriverDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\TimelineDTO;
use Lloricode\LaravelPandagoSdk\Enum\Status;

class CallBackDTO extends BaseDTO
{
//    public $delivery_tasks // missing on production

    public string $order_id;
    public ?string $client_order_id;
    public Status $status;
    public TimelineDTO $timeline;
    public DriverDTO $driver;
    public int $created_at;
    public int $updated_at;
    public ?string $tracking_link;
    public ?CancellationDTO $cancellation;
}
