<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBarterCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('pembeli')
            && $this->user()->status === 'active';
    }

    public function rules(): array
    {
        return [
            'delivery_method' => ['required', Rule::in(['cod', 'shipping'])],
            'delivery_address' => ['required', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'delivery_method' => 'metode serah terima',
            'delivery_address' => 'alamat atau titik temu',
            'notes' => 'catatan',
        ];
    }
}
