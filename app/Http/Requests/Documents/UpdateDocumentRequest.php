<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
            'document_type' => ['required'],
            'number' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:documents,number,' . $this->document . ',id,deleted_at,NULL'],
            'date' => ['required'],
            'other_side_name' => ['required'],
            'contract_id' => ['required_unless:document_type,Müqavilə'],
            'currency' => ['required'],
            'price' => ['required'],
            'tags' => ['required'],
            'uploaded_file' => [],

            'contract_type' => ['required_if:document_type,Müqavilə', 'in:Partnyorluq,Xidmət,Alqı-satqı'],
            'shopping' => ['required_if:document_type,Müqavilə'],
            'other_side_type' => ['required_if:document_type,Müqavilə']
        ];
    }

    public function messages()
    {
        return [
            'number.required' => 'Daxil edin.',
            'number.regex' => 'Format yanlışdır.',
            'number.unique' => 'Bu artıq istifadə edilib.',

            'date.required' => 'Daxil edin.',
            'other_side_name.required' => 'Daxil edin.',

            'contract_id.required_unless' => 'Daxil edin.',
            'addition_id.required_unless' => 'Daxil edin.',

            'currency.required' => 'Daxil edin.',
            'price.required' => 'Daxil edin.',
            'tags.required' => 'Daxil edin.',

            'contract_type.required_if' => 'Daxil edin.',
            'shopping.required_if' => 'Daxil edin.',
            'other_side_type.required_if' => 'Daxil edin.',
            'product_service_name.required_if' => 'Daxil edin.',
            'product_service_number_integer.required_if' => 'Daxil edin.',
            'product_service_number_string.required_if' => 'Daxil edin.',

//            'uploaded_file.mimes' => 'Faylın formatı pdf olmalıdır.',
        ];

    }

}
