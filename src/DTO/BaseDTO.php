<?php

namespace Lloricode\LaravelPandagoSdk\DTO;

use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseDTO extends DataTransferObject
{
    protected bool $ignoreMissing = true;
}