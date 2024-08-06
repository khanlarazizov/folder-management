<?php

namespace App\Http\Requests\Uploads;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'mimes:pdf']
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Daxil edin.',
            'file.mimes' => 'Faylın formatı pdf olmalıdır.',
        ];
    }
}
