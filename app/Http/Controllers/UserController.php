<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Afficher les informations de l'utilisateur connecté.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Récupère l'utilisateur authentifié
        $user = $request->user();

        // Retourne les informations de l'utilisateur en réponse JSON
        return response()->json($user);
    }

    /**
     * Mettre à jour les informations de l'utilisateur connecté.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        // Récupère l'utilisateur authentifié
        $user = $request->user();

        // Met à jour les informations de l'utilisateur
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        // Retourne les informations mises à jour en réponse JSON
        return response()->json($user);
    }

    /**
     * Supprimer l'utilisateur connecté.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        // Récupère l'utilisateur authentifié
        $user = $request->user();

        // Supprime l'utilisateur
        $user->delete();

        // Retourne une réponse de succès
        return response()->json(['message' => 'User deleted successfully']);
    }
}
