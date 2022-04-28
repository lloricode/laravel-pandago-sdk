<?php

namespace Lloricode\LaravelPandagoSdk\DTO\Auth;

class Token extends \Spatie\DataTransferObject\DataTransferObject
{
    public string $access_token;
    public int $expires_in;
    public string $scope;
    public string $token_type;
}
