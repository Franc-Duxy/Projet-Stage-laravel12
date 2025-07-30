<?php

namespace App\Http\Controllers;

use App\Models\EtapeProjet;
use Illuminate\Http\Request;

class EtapeProjetController extends Controller
{
    /**
     * Lister toutes les étapes de projets.
     */
    public function index()
    {
        $etapeProjets = EtapeProjet::with(['projet', 'etape'])->get();
        return response()->json([
            'success' => true,
            'data' => $etapeProjets
        ], 200);
    }

    /**
     * Créer une nouvelle étape de projet.
     */
    public function store(Request $request)
    {
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_etape.required' => 'L\'identifiant de l\'étape est requis.',
            'id_etape.exists' => 'L\'étape spécifiée n\'existe pas.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être l\'un des suivants : en_attente, en_cours, termine.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];

        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_etape' => ['required', 'exists:etapes,id_etape'],
            'statut' => ['required', 'in:en_attente,en_cours,termine'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
        ], $messages);

        $etapeProjet = EtapeProjet::create($data);

        return response()->json([
            'success' => true,
            'data' => $etapeProjet->load(['projet', 'etape']),
            'message' => 'Étape de projet créée avec succès.'
        ], 201);
    }

    /**
     * Afficher une étape de projet spécifique.
     */
    public function show(EtapeProjet $etapeProjet)
    {
        return response()->json([
            'success' => true,
            'data' => $etapeProjet->load(['projet', 'etape'])
        ], 200);
    }

    /**
     * Mettre à jour une étape de projet.
     */
    public function update(Request $request, EtapeProjet $etapeProjet)
    {
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_etape.required' => 'L\'identifiant de l\'étape est requis.',
            'id_etape.exists' => 'L\'étape spécifiée n\'existe pas.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être l\'un des suivants : en_attente, en_cours, termine.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];

        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_etape' => ['required', 'exists:etapes,id_etape'],
            'statut' => ['required', 'in:en_attente,en_cours,termine'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
        ], $messages);

        $etapeProjet->update($data);

        return response()->json([
            'success' => true,
            'data' => $etapeProjet->load(['projet', 'etape']),
            'message' => 'Étape de projet mise à jour avec succès.'
        ], 200);
    }

    /**
     * Supprimer une étape de projet.
     */
    public function destroy(EtapeProjet $etapeProjet)
    {
        $etapeProjet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Étape de projet supprimée avec succès.'
        ], 200);
    }
}
