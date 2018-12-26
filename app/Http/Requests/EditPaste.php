<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPaste extends FormRequest
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
            'pasteTitle' => 'max:70',
            'pasteContent' => 'required',
            'pastePassword' => 'required_if:privacy,password',
            'expire' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pasteContent.required' => 'Your paste cannot be empty.',
            'pastePassword.required_if' => 'Please enter a password.',
            'pasteTitle.max' => 'Title must not exceed 70 characters.',
            'expire.required' => 'Paste expiration is required.',
        ];
    }
}
