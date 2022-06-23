<?php

namespace App\Http\Requests;

use App\Traits\TrixEditorValidation;
use Illuminate\Foundation\Http\FormRequest;

class OptionPostRequest extends FormRequest
{
    use TrixEditorValidation;

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
            'description' => $this->validateTrixInput($this->description),
        ]);
    }
}
