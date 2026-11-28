<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBarterOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasRole('pembeli') && $this->user()->status === 'active';
    }

    public function rules(): array
    {
        return [
            'source' => ['required', Rule::in(['listing', 'manual', 'cash'])],
            'offered_listing_id' => ['exclude_unless:source,listing', 'required', 'integer', 'exists:listings,id'],
            'item_name' => ['exclude_unless:source,manual', 'required', 'string', 'max:150'],
            'description' => ['exclude_unless:source,manual', 'nullable', 'string', 'max:2000'],
            'item_condition' => ['exclude_unless:source,manual', 'required', Rule::in(['like_new', 'good', 'fair', 'needs_repair'])],
            'estimated_value' => ['exclude_unless:source,manual', 'nullable', 'integer', 'min:0', 'max:9999999999'],
            'photo' => ['exclude_unless:source,manual', 'required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'cash_amount' => ['required', 'integer', 'min:0', 'max:9999999999', Rule::when($this->input('source') === 'cash', ['min:1'])],
            'message' => ['nullable', 'string', 'max:2000'],
            'agreement' => ['accepted'],
        ];
    }
}
