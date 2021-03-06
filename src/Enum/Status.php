<?php

namespace Lloricode\LaravelPandagoSdk\Enum;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self NEW()
 * @method static self RECEIVED()
 * @method static self WAITING_FOR_TRANSPORT()
 * @method static self ASSIGNED_TO_TRANSPORT()
 * @method static self COURIER_ACCEPTED_DELIVERY()
 * @method static self NEAR_VENDOR()
 * @method static self PICKED_UP()
 * @method static self COURIER_LEFT_VENDOR()
 * @method static self NEAR_CUSTOMER()
 * @method static self DELIVERED()
 * @method static self DELAYED()
 * @method static self CANCELLED()
 */
class Status extends Enum
{
    public function isCancellable(): bool
    {
        return $this->equals(
            self::NEW(),
            self::RECEIVED(),
            self::WAITING_FOR_TRANSPORT(),
        );
    }

    public function isCoordinateAvailable(): bool
    {
        return ! $this->equals(
            self::NEW(),
            self::RECEIVED(),
            self::WAITING_FOR_TRANSPORT(),
            self::ASSIGNED_TO_TRANSPORT(),
            self::COURIER_ACCEPTED_DELIVERY(),
        );
    }
}
