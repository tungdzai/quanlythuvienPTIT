<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'birthday' => 'required|date|before:-18 years',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.errors.required'),
            'email.email' => __('messages.errors.regex'),
            'email.unique' => __('messages.errors.unique'),
            'name.required' => __('messages.errors.required'),
            'birthday.required' => __('messages.errors.required'),
            'birthday.before' => __('messages.errors.birthday_18'),
        ];
    }

    public function attributes()
    {
        return __('messages.attributes.user');
    }
}
