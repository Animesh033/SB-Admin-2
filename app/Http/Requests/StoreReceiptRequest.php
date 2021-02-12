<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id.*' => 'required',
            'description.*' => 'required',
            'hsn_code.*' => 'required',
            'qty.*' => 'required',
            'rate.*' => 'required',
            'taxable_value.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.*.required' => 'Please select the customer.',
            'description.*.required' => 'Description is required.',
            'hsn_code.*.required' => 'HSN code is required.',
            'qty.*.required' => 'Quantity is required.',
            'rate.*.required' => 'Rate is required.',
            'taxable_value.*.required' => 'Taxable value is required.',
        ];
    }
}