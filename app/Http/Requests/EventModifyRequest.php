<?php

namespace App\Http\Requests;

use App\Traits\TrixEditorValidation;
use Illuminate\Foundation\Http\FormRequest;

class EventModifyRequest extends FormRequest
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
            'title' => ['required', 'string', 'between:8,60'],
            'description' => ['nullable', 'string', 'max:65535'],
            'started_at' => ['nullable', 'date', 'after:now', 'required_with:finished_at'],
            'finished_at' => ['nullable', 'date', 'after:started_at', 'required_with:started_at'],
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
