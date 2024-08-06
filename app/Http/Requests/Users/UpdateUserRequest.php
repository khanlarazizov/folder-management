<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:users,name,' . $this->user . ',id,deleted_at,NULL'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user . ',id,deleted_at,NULL'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Daxil edin.',
            'name.unique' => 'Bu artıq istifadə edilib.',

            'email.required' => 'Daxil edin.',
            'email.unique' => 'Bu artıq istifadə edilib.',

            'password.required' => 'Daxil edin.',
            'password.min' => 'Ən azı 6 simvol daxil edin.',
        ];
    }
}
