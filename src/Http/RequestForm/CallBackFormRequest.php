<?php

namespace Lloricode\LaravelPandagoSdk\Http\RequestForm;

use Illuminate\Foundation\Http\FormRequest;
use Lloricode\LaravelPandagoSdk\DTO\Callback\CallBackDTO;

class CallBackFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function toDTO(): CallBackDTO
    {
        return new CallBackDTO($this->all());
    }
}
