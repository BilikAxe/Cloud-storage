<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileDownloadRequest extends FormRequest
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
            'fileId' => 'required|int'
        ];
    }


    public function messages(): array
    {
        return [
            'required' => 'Такого id нет',
            'int' => 'Данные должны быть числом',
        ];
    }
}
