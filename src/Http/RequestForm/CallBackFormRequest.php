<?php

namespace Lloricode\LaravelPandagoSdk\Http\RequestForm;

use Illuminate\Foundation\Http\FormRequest;
use Lloricode\LaravelPandagoSdk\DTO\Callback\CallBackDTO;
use Lloricode\LaravelPandagoSdk\Enum\CallBackStatuses;
use Spatie\Enum\Laravel\Rules\EnumRule;

class CallBackFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', new EnumRule(CallBackStatuses::class)],
        ];
    }

    public function toDTO(): CallBackDTO
    {
        return new CallBackDTO([
                'status' => CallBackStatuses::from($this->validated()['status']),
            ] + $this->all());
    }
}
