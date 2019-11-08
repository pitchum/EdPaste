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
            'pasteContent.required' => __('edpaste.validation.error.notempty'),
            'pastePassword.required_if' => __('edpaste.validation.error.password'),
            'pasteTitle.max' => __('edpaste.validation.error.maxlength'),
            'expire.required' => __('edpaste.validation.error.expiration.required'),
        ];
    }
}
