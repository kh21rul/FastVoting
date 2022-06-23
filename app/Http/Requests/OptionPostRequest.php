<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'between:5,60'],
            'description' => ['nullable', 'string', 'max:65535'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'description' => strip_tags($this->description, [
                // Allowed tags
<<<<<<< HEAD
                '<div>', '<strong>', '<em>', '<p>', '<a>', '<del>', '<br>', '<pre>', '<blockquote>', '<h1>', '<ul>', '<li>'
=======
                '<div>', '<strong>', '<em>', '<p>', '<a>', '<del>', '<br>', '<pre>', '<blockquote>', '<h1>', '<ul>', '<ol>', '<li>'
>>>>>>> 4f2cf85ddb7dae647315d770d7c49d08765a5b4b
            ]),
        ]);
    }
}
