<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class LinkContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'regex:/^(\+7|8)\d{10}$/'],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Имя обязательно для заполнения.',
            'last_name.required' => 'Имя обязательно для заполнения.',
            'first_name.min' => 'Имя должно содержать минимум :min символов.',
            'last_name.min' => 'Имя должно содержать минимум :min символов.',
            'phone.required' => 'Номер телефона обязателен для заполнения.',
            'phone.regex' => 'Номер телефона должен быть в формате +7XXXXXXXXXX или 8XXXXXXXXXX.',
            'description.max' => 'Описание не должно превышать :max символов.',
        ];
    }
}
