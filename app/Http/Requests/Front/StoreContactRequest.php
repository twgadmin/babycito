<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|max:65',    //|regex:/^[\pL\s\-]+$/u
            'email' => 'required|email:rfc,dns',
            'phone' => 'required|numeric||min:6',
            'message' => 'required|min:10|max:500',
        ];
    }
}
