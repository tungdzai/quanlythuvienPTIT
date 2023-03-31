<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => __('messages.errors.required'),
            'email.email' => __('messages.errors.email'),
            'email.exists' => __('messages.errors.exists'),
            'password.required' => __('messages.errors.required'),
//            'password.regex' => __('messages.errors.regex'),
        ];
    }


    public function attributes(): \Illuminate\Foundation\Application|array|string|\Illuminate\Contracts\Translation\Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return __('messages.attributesLogin');
    }
}
