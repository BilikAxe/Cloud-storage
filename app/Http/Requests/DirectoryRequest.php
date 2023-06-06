<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DirectoryRequest extends FormRequest
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
            'directoryName' => 'required|string'
        ];
    }


    public function messages(): array
    {
        return [
            'required' => 'Дайте название дериктории',
            'string' => 'Поле должно быть строкой',
        ];
    }
}
