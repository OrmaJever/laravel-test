<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentIpnRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'signature' => 'required|string',
            'payload' => 'required|array',
            'payload.user_id' => 'required|integer',
            'payload.plan_id' => 'required|integer'
        ];
    }
}
