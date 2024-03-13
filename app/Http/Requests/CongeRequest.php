<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CongeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
   


     public function rules(): array
     {
         return [
             'type_conge' => 'required',
             'date_debut' => 'required|date|after:today',
             'date_fin' => 'nullable|date|after:date_debut|required_if:type_conge,congé annuel',

         ];
     }
     
    public function messages(): array
    {
        return [
            'type_conge.required' => 'Choisissez une option .',
            'date_debut.required' => 'La date de début est requise.',
            'date_debut.after' => 'Saisissez une date valide.',
            'date_fin.required_if' => 'La date de fin est requise dans  ce cas.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.'
      
            
        ];
    }
}
