<?php
namespace App\Http\Validation;
class LoginValidation {
    public function rules() {
        return
        [
            
            'email' => 'required|email',
            'password' => 'required|string',
            
        
        ];
    }
    public function messages() {
        return
        [

           
            'email.required' => 'Votre email est requis',
        
            'password.required' => 'Votre mot de passe est requis',
    
            
        
        ]
        ;
    }
}