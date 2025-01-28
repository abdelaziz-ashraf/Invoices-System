<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_number' => 'string',
            'invoice_date' => 'date',
            'due_date' => 'date',
            'section_id' => 'exists:sections,id',
            'product_id' => 'exists:products,id',
            'amount_collection' => 'numeric',
            'amount_commission' => 'numeric',
            'discount' => 'numeric',
            'rate_vat' => 'string',
            'value_vat' => 'numeric',
            'total' => 'numeric',
            'note' =>  'string',
        ];
    }
}
