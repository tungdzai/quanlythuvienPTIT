<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'title'=>'required',
            'author'=>'required',
            'year'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>__('messages.errors.required'),
            'author.required'=>__('messages.errors.required'),
            'year.required'=>__('messages.errors.required'),
            'price.required'=>__('messages.errors.required'),
            'quantity.required'=>__('messages.errors.required'),
            'description.required'=>__('messages.errors.required'),
        ];
    }
    public function attributes()
    {
        return __('messages.attributes.book');
    }
}
