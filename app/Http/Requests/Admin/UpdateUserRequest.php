<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->user;

        return [
            'first_name' => 'required|max:32',
            'last_name'  => 'required|max:32',
            'phone'      => 'required|max:24',
            'email'      => 'required|email|unique:users,email,'.$id,
            'password'   => 'nullable|min:8|max:50',
        ];
    }
}
