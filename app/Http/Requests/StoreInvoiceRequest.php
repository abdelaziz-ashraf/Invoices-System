<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'invoice_number' => 'required',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'section_id' => 'required|exists:sections,id',
            'product_id' => 'required|exists:products,id',
            'amount_collection' => 'required|numeric',
            'amount_commission' => 'required|numeric',
            'discount' => 'required|numeric',
            'rate_vat' => 'nullable',
            'value_vat' => 'nullable|numeric',
            'total' => 'required|numeric',
            'note' =>  'nullable|string',
        ];
    }
}
