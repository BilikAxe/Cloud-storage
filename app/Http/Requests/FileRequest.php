<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required|file|max:10 * 1024'
        ];
    }


    public function messages(): array
    {
        return [
            'required' => 'Выберите файл для загрузки',
            'max' => [
                'file' => 'Размер файл должен быть не более :max килобайт',
            ],
        ];
    }
}
