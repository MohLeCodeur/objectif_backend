<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Validation\LoginValidation;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\RegisterValidation;

class UserController extends Controller
{
    protected $registerValidation;
    protected $loginValidation;

    public function __construct(RegisterValidation $registerValidation, LoginValidation $loginValidation) {
        $this->registerValidation = $registerValidation;
        $this->loginValidation = $loginValidation;
    }

    public function register(Request $request) {
        // Valide les données de la requête
        $validator = Validator::make($request->all(), $this->registerValidation->rules(), $this->registerValidation->messages());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 401); // Code de statut HTTP 422 Unprocessable Entity
        }

        // Crée un nouvel utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->input('password')),
            'api_token' => Str::random(60),
        ]);

        // Retourne la réponse JSON avec les informations de l'utilisateur créé
        return response()->json($user);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), $this->loginValidation->rules(), $this->loginValidation->messages());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 401); // Code de statut HTTP 422 Unprocessable Entity
        }

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = User::where('email', $request->input('email'))->firstOrFail();
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Mauvais identifiants de connexion'], 401);
        }
    }
}
