<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }


    public function messages(): array
{
    return [
        'name.required' => 'Le nom est requis.',
        'name.min' => 'Le nom doit comporter au moins trois caractères.',
        'email.required' => 'L\'e-mail est obligatoire.',
        'email.email' => 'L\'adresse e-mail est invalide.',
        'password.required' => 'Le mot de passe est requis.',
        'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
        'password.confirmed' => 'Les champs mot de passe et confirmation de mot de passe ne correspondent pas.',
    ];
}








}
