<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
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
             'name' => 'required_without:customer_id', 
             'address' => 'required_without:customer_id', 
             'contact_no' => 'required_without:customer_id', 
             'customer_id' => 'required_without:name', 
             'category.*' => 'required', 
             'width.*' => 'required',  
             'height.*' => 'required', 
             'shutter.*' => 'required',  
             'net.*' => 'required',  
             'sq_feet.*' => 'required', 
             'rate.*' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }


}
