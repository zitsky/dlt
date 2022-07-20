<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'first_name'=>['required'],
            'last_name'=>['required'],
            'country_id'=>['required','exists:countries,id'],
            'emails'=>['min:1'],
            'websites'=>['min:1'],
            'emails.*.email'=>['required',Rule::unique('customer_emails',"email")->whereNot("customer_id",$id)],
            'websites.*.website'=>['required',Rule::unique('customer_websites',"website")->whereNot("customer_id",$id)]
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'=>'defaults.errors.required',
            'last_name.required'=>'defaults.errors.required',
            'country_id.required'=>'defaults.errors.required',
            'websites.required'=>'defaults.errors.required',
            'emails.required'=>'defaults.errors.required',
            'emails.*.email.unique'=>'defaults.errors.alreadyuse',
            'websites.*.website.unique'=>'defaults.errors.alreadyuse',
        ];
    }
}
