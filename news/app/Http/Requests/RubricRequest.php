<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RubricRequest extends FormRequest
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
            'name' => 'required|unique:rubrics|string',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Пустоту читать не интересно',
            'name.unique' => 'Оригинальность на этом иссякла.',
            'name.string' => 'Вы точно не робот?',

        ];
    }
}
