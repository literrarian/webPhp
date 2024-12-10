<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|unique:articles|string',
            'lid' => 'required|min:5|max:100|string',
            'content' => 'required|min:5|unique:articles|string',
            'rubrics_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Пустоту читать не интересно',
            'title.unique' => 'Фу, плагиат в названии статьи',
            'title.string' => 'Вы точно не робот?',

            'lid.required' => 'Аннотацию лень было написать?',
            'lid.string' => 'Пора бы поставить капчу на сайт',
            'lid.min' => 'Как-то маловато',
            'lid.max' => 'Ну и портянка, покороче можно?',

            'content.required' => 'Пустоту читать не интересно',
            'content.unique' => 'Фу, плагиат статьи',
            'content.min' => 'На статью не тянет, мало',
            'content.string'=>'Не, ну точно робот',

            'rubrics_id.required' => 'Без рубрики не пущу',

            'image.required' => 'Без фотокарточки не принимаем',
            'image.image' => 'Это не картинка, мне нужна картинка',
            'image.mimes' => 'Допускаемые типы: jpeg, png, jpg, gif',
            'image.max' => 'Превышен макс. размер в 2МБ'
        ];
    }
}
