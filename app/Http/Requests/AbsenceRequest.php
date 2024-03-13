<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceRequest extends FormRequest
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
            'raisons'=>'required|min:10',
            'Pj'=>'required|mimes:pdf|max:4096',
        ];
    }


    public function messages():array
    {
        return[
        'Pj.required' => 'Veuillez joindre votre certificat ',
        'Pj.mimes' => 'Votre fichier doit être au format PDF.',
        'Pj.max' => 'La taille du  votre fichier  ne doit pas dépasser :4 Mo',
        'raisons.required' => 'Ce champs  est requis',
        'raisons.min' => 'Le champ doit contenir au moins 10 caractères',
        ];
    }
}
