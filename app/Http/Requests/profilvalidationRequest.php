<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profilvalidationRequest extends FormRequest
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
            "situation_familiale" =>'required',
            "cin" => 'required|size:7',
           "cnss"=>'required|size:12',
           "email" => 'required|email',
           "poste" => 'required',
           "contrat" => 'required',
           "sexe"=>'required',
           'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
           'tel'=>'required|size:10',
           'date_debut'=>'required|'
           
        ];
    }
    public function messages():array{

        return 
        [ 
          'nom.required'=> 'le nom est requis',
          'nom.min'=> ' le nom doit contenir au moins 3 caractères',
          'prenom.min'=> ' le prénom doit contenir au moins 3 caractères',
          'prenom.required'=> 'le prénom est requis',
          'cin.required'=> 'le code CIN est requis',
          'cnss.required'=>'le code  CNSS est requis',
           'email.required'=> 'l\'email est requis',
          'contrat.required'=> 'choississez une ',
          'poste.required'=> 'choississez une ',
          'sexe.required'=>'sélectionnez un type',
         'photo.mimes' => 'Le fichier doit être au format jpeg, png ou gif',
         'photo.max' => 'La taille du fichier doit être inférieure à 2 Mo',
         'tel.size' => 'Le  téléphone doit être composé de 10 chiffres',
         'cin.size' => 'Le  code CIN doit être composé de 7 caractères',
         'cnss.size' => 'Le  code CNSS doit être composé de 12 chiffres',
         'date_debut.required'=> 'La date de début est requise.',
         'situation_familiale.required'=>'La situation familiale est requise.'
         
         ]
    ;
    }
}
