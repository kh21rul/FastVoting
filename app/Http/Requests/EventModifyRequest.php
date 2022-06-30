<?php

namespace App\Http\Requests;

use App\Traits\TimeConverter;
use App\Traits\TrixEditorValidation;
use Illuminate\Foundation\Http\FormRequest;

class EventModifyRequest extends FormRequest
{
    use TrixEditorValidation, TimeConverter;

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
            'timezone' => ['nullable', 'string', 'timezone', 'required_with:started_at,finished_at'],
            'started_at' => ['nullable', 'date', 'after:now', 'required_with:timezone,finished_at'],
            'finished_at' => ['nullable', 'date', 'after:started_at', 'required_with:timezone,started_at'],
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
            // Convert `started_at` and `finished_at` from local time to server time.
            'started_at' => $this->convertStringTimeToServerTime($this->started_at, $this->timezone) ?? $this->started_at,
            'finished_at' => $this->convertStringTimeToServerTime($this->finished_at, $this->timezone) ?? $this->finished_at,
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'started_at.required_with' => 'This field must be filled.',
            'finished_at.required_with' => 'This field must be filled.',
            'timezone.required_with' => 'This field must be filled.',
        ];
    }
}
