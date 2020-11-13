<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'homeworld_id' => 'required|exists:characters,homeworld_id',
            'name' => 'required',
            'height' => 'required|numeric|between:10,300',
            'gender' => 'required|in:male,female,n/a',
        ];
    }
}
