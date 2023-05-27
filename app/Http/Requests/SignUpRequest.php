<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'user_name' => 'required|min:2|unique:users',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|min:6',
        ];
    }


    public function messages(): array
    {
        return [
            "required" => "Поле :attribute не должно быть пустым.",
            'alpha' => 'Поле :attribute должно содержать только буквы.',
            'string' => 'Поле :attribute должен быть строкой.',
            'email' => 'Введите действительный :attribute.',
            'min' => [
                'array' => 'The :attribute must have at least :min items.',
                'file' => 'The :attribute must be at least :min kilobytes.',
                'numeric' => 'The :attribute must be at least :min.',
                'string' => 'Поле :attribute должно быть не короче :min символов.',
            ]
        ];
    }


    public function attributes(): array
    {
        return [
            "lastname" => "\"Фамилия\"",
            'firstname' => "\"Имя\"",
            "patronymic" => "\"Отчество\"",
            "email" => "\"Емейл\"",
            "password" => "\"Пароль\""
        ];
    }
}
