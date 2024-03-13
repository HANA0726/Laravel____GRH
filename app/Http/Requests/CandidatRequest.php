<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatRequest extends FormRequest
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
            'nom'=>'required|min:3',
            'prenom'=>'required|min:3',
            'tel' =>'required|size:10',
           'email' => 'required|email',
           'poste' => 'required',
           'formation' => 'required',
           'cv'=>'required|mimes:pdf|max:4096',
           'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'lt'=>'required|mimes:pdf|max:4096'
            
        ];

    }
    public function messages():array
{
    return [
        'nom.required' => 'Le  nom est requis',
        'nom.min' => 'Le champ nom doit contenir au moins 3 caractères',
        'prenom.required' => 'Le champ prenom est requis',
        'prenom.min' => 'Le champ prenom doit contenir au moins 3 caractères',
        'tel.required' => 'Le téléphone est requis',
        'tel.size' => 'Le  téléphone doit être composé de 10 chiffres',
        'email.required' => 'L\'email est requis',
        'email.email' => 'Veuillez entrer une adresse email valide',
        'poste.required' => 'Choisissez une option ',
        'formation.required' => 'Choisissez une option',
        'cv.required' => 'Veuillez joindre votre CV',
        'cv.mimes' => 'Votre Cv doit être au format PDF.',
        'cv.max' => 'La taille du CV ne doit pas dépasser :4 Mo',
        'photo.required' => 'Veuillez joindre votre photo',
        'photo.mimes' => 'Le format de la photo doit être JPG, PNG, GIF ou SVG',
        'photo.max' => 'La taille de la photo ne doit pas dépasser :2 Mo',
        'lt.required' => 'Veuillez joindre votre lettre de motivation',
        'lt.mimes' => 'Le format de la lettre de motivation doit être PDF',
        'lt.max' => 'La taille de la lettre de motivation ne doit pas dépasser: 4 Mo'
    ];
}

}
