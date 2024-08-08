<?php
namespace App\Http\Validation;
class RegisterValidation {
    public function rules() {
        return
        [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|min:3|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        
        ];
    }
    public function messages() {
        return
        [

            'name.required' => 'Le nom est requis',
            'name.min' => 'Le nom doit contenir au moins 3 caractères',
            'name.max' => 'Le nom doit contenir au maximum 255 caractères',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email doit être valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
            'confirm_password.required' => 'La confirmation du mot de passe est requise',
            'confirm_password.same' => 'La confirmation du mot de passe ne correspond pas',
            'email.min' => 'L\'email doit contenir au moins 3 caractères',
        
        ]
        ;
    }
}