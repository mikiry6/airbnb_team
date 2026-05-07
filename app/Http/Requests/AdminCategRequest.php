<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AdminCategRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title'=>['required', 'min:2', 'max:20']
        ];
    }

    public function messages(){

        return [
            'title.required'=>'Le titre est requis',
            'title.max'=>'20 lettres max',
            'title.min'=>'2 lettres min'
        ];
    }
}
