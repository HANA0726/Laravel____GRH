<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationRequest extends FormRequest
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
            'titre'=>'required',
            'date_debut'=>'required|date|after:today',
            'date_fin'=>'required|date|after:date_debut'
        ];
    }
    public function messages(): array
    {
        return [
            'titre.required' => 'Saisissez  un thème.',
            'date_debut.required'=>'Saisissez une date.',
            'date_fin.required'=>'Saisissez une date.',
            'date_debut.after' => 'Saisissez une date valide.',
            'date_fin.after' => 'Saisissez une date valide.',
        ];
    }
}
