<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoterPostRequest extends FormRequest
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
            'email' => ['required', 'email:rfc,dns', 'max:255', 'unique:voters,email,NULL,id,event_id,' . $this->route('id')],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => 'This email is already registered in this event.',
        ];
    }
}
