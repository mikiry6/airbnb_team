<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'title'=>['required', 'min:5', 'max:50'],
            'description'=>['required', 'min:5', 'max:150'],
            'prix'=>['required','numeric','min:1'],
            'max_pers'=>['required','numeric'],
            'pays_id'=>['required'],
            'image'=>['image','max:2048']
        ];
    }
}
