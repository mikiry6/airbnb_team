<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChambreFormRequest extends FormRequest
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

            // 'user_id'=>['nullable'],
            'hotel_id'=>['nullable'],
            'titre'=>['required', 'min:3','max:20'],
            'type_logement'=>['required'],
            'description'=>['required', 'min:15', 'max:200'],
            'prix'=>['required','integer','min:0','max:99999999'],
            'nb_chambre'=>['required','integer', 'min:1', 'max:50'],
            'nb_douche'=>['required','integer', 'min:0', 'max:50'],
            'nb_wc'=>['required','integer', 'min:0', 'max:50'],
            'image_principale'=>['required','image'],
            'image_1'=>['nullable','image'],
            'image_2'=>['nullable','image'],
            'image_3'=>['nullable','image'],
          
        ];
    }
}
