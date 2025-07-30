<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the utilisateurs.
     */
    public function index()
    {
        $utilisateurs = Utilisateur::with('tachesRemplies')->get();
        return response()->json([
            'success' => true,
            'data' => $utilisateurs
        ], 200);
    }

    /**
     * Store a newly created utilisateur in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'CIN.unique' => 'Le numéro CIN est déjà utilisé.',
            'CIN.size' => 'Le CIN doit contenir exactement 12 caractères.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'CIN' => ['required', 'string', 'size:12', 'unique:utilisateurs,CIN'],
            'departement' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:utilisateurs,email'],
            'mot_de_passe' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,utilisateur'],
        ], $messages);

        // Hacher le mot de passe
        $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);

        $utilisateur = Utilisateur::create($data);

        return response()->json([
            'success' => true,
            'data' => $utilisateur->load('tachesRemplies'),
            'message' => 'Utilisateur créé avec succès.'
        ], 201);
    }

    /**
     * Display the specified utilisateur.
     */
    public function show(Utilisateur $utilisateur)
    {
        return response()->json([
            'success' => true,
            'data' => $utilisateur->load('tachesRemplies')
        ], 200);
    }

    /**
     * Update the specified utilisateur in storage.
     */
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $messages = [
            'CIN.unique' => 'Le numéro CIN est déjà utilisé.',
            'CIN.size' => 'Le CIN doit contenir exactement 12 caractères.',
            'email.unique' => 'L\'adresse email est déjà utilisée.',
        ];

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'CIN' => ['required', 'string', 'size:12', 'unique:utilisateurs,CIN,' . $utilisateur->id],
            'departement' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:utilisateurs,email,' . $utilisateur->id],
            'mot_de_passe' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:admin,utilisateur'],
        ],$messages);

        // Hacher le mot de passe si fourni
        if (isset($data['mot_de_passe'])) {
            $data['mot_de_passe'] = Hash::make($data['mot_de_passe']);
        } else {
            unset($data['mot_de_passe']); // Ne pas modifier le mot de passe si non fourni
        }

        $utilisateur->update($data);

        return response()->json([
            'success' => true,
            'data' => $utilisateur->load('tachesRemplies'),
            'message' => 'Utilisateur mis à jour avec succès.'
        ], 200);
    }

    /**
     * Remove the specified utilisateur from storage.
     */
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return response()->json([
            'success' => true,
            'message' => 'Utilisateur supprimé avec succès.'
        ], 200);
    }
}
