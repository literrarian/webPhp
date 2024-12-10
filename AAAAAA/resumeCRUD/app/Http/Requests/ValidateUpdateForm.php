<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateForm extends FormRequest
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
            'FIO' => 'required|string|regex:/^\w{1,}\s\w{1,}\s\w{1,}$/iu',
            'Stage' => 'required|min:0|max:60|numeric',
            'Phone' => 'required|regex:/[0-9]{2}-[0-9]{2}-[0-9]{2}/',
            'staff_id' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'FIO.required' => 'Какого ваше фамильё?',
            'FIO.string' => 'Вы больше чем число, имя в строку пожалуйста',
            'FIO.regex' => 'ФИО  в три слова',

            'staff_id.required' => 'Какого ваше профессьё?',
            'staff_id.numeric' => 'Профессьё нормально укажите',

            'Phone.regex' =>'Ну там же указан формат телефона, ну',
            'Phone.required' => 'Телефончик укажите',

            'Stage.required' => 'Сколько на каторге?',
            'Stage.numeric' => 'Стаж в годах измеряется, а не в метрах',
            'Stage.min' => 'Стаж в годах измеряется, а не в метрах',

            'Image.required' => 'Без фотокарточки не принимаем',
            'Image.image' => 'Это не картинка, мне нужна картинка',
            'Image.mimes' => 'Допускаемые типы: jpeg, png, jpg, gif',
            'Image.max' => 'Превышен макс. размер в 2МБ'
        ];
    }
}
