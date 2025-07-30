<?php

namespace App\Http\Controllers;

use App\Models\TacheRemplie;
use App\Models\Tache;
use App\Models\Projet;
use App\Models\EtapeProjet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TacheRemplieController extends Controller
{
    /**
     * Display a listing of the tache_remplie.
     */
    public function index()
    {
        $tacheRemplies = TacheRemplie::with(['projet', 'tache', 'utilisateur'])->get();
        return response()->json([
            'success' => true,
            'data' => $tacheRemplies
        ], 200);
    }

    /**
     * Store a newly created tache_remplie in storage.
     */
    public function store(Request $request)
    {
        $tache = Tache::findOrFail($request->input('id_tache'));

        // Définir les règles de validation en fonction du type_valeur
        $rules = [
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_tache' => ['required', 'exists:taches,id_tache'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'date_remplissage' => ['nullable', 'datetime'],
        ];

        // Ajouter les règles pour les champs de valeur selon type_valeur
        if ($tache->type_valeur === 'string') {
            $rules['valeur_string'] = ['nullable', 'string', 'max:255'];
            $rules['fichier_pdf'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'text') {
            $rules['valeur_texte'] = ['nullable', 'string'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'int') {
            $rules['valeur_entier'] = ['nullable', 'integer'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'date') {
            $rules['valeur_date'] = ['nullable', 'date'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
        }

        $data = $request->validate($rules);

        // Gérer le fichier PDF si la tâche est 'fichier_pdf'
        if ($tache->nom === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
            $data['valeur_string'] = $request->file('fichier_pdf')->store('pdfs/projet_' . $request->id_projet, 'public');
        }

        // Créer la tâche remplie
        $tacheRemplie = TacheRemplie::create($data);

        return response()->json([
            'success' => true,
            'data' => $tacheRemplie->load(['projet', 'tache', 'utilisateur']),
            'message' => 'Tâche remplie créée avec succès.'
        ], 201);
    }



    /**
     * Display the specified tache_remplie.
     */
    public function show(TacheRemplie $tacheRemplie)
    {
        return response()->json([
            'success' => true,
            'data' => $tacheRemplie->load(['projet', 'tache', 'utilisateur'])
        ], 200);
    }

    /**
     * Update the specified tache_remplie in storage.
     */
    public function update(Request $request, TacheRemplie $tacheRemplie)
    {
        $tache = Tache::findOrFail($request->input('id_tache'));

        // Définir les règles de validation en fonction du type_valeur
        $rules = [
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_tache' => ['required', 'exists:taches,id_tache'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'date_remplissage' => ['nullable', 'datetime'],
        ];

        // Ajouter les règles pour les champs de valeur selon type_valeur
        if ($tache->type_valeur === 'string') {
            $rules['valeur_string'] = ['nullable', 'string', 'max:255'];
            $rules['fichier_pdf'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'text') {
            $rules['valeur_texte'] = ['nullable', 'string'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'int') {
            $rules['valeur_entier'] = ['nullable', 'integer'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_date'] = ['prohibited'];
        } elseif ($tache->type_valeur === 'date') {
            $rules['valeur_date'] = ['nullable', 'date'];
            $rules['valeur_string'] = ['prohibited'];
            $rules['valeur_texte'] = ['prohibited'];
            $rules['valeur_entier'] = ['prohibited'];
        }

        $data = $request->validate($rules);

        // Gérer le fichier PDF si la tâche est 'fichier_pdf'
        if ($tache->nom === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
            // Supprimer l'ancien fichier PDF s'il existe
            if ($tacheRemplie->valeur_string) {
                Storage::disk('public')->delete($tacheRemplie->valeur_string);
            }
            $data['valeur_string'] = $request->file('fichier_pdf')->store('pdfs/projet_' . $request->id_projet, 'public');
        }

        $tacheRemplie->update($data);

        return response()->json([
            'success' => true,
            'data' => $tacheRemplie->load(['projet', 'tache', 'utilisateur']),
            'message' => 'Tâche remplie mise à jour avec succès.'
        ], 200);
    }


    /**
     * Remove the specified tache_remplie from storage.
     */
    public function destroy(TacheRemplie $tacheRemplie)
    {
        // Supprimer le fichier PDF s'il existe
        if ($tacheRemplie->tache->nom === 'fichier_pdf' && $tacheRemplie->valeur_string) {
            Storage::disk('public')->delete($tacheRemplie->valeur_string);
        }

        $tacheRemplie->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tâche remplie supprimée avec succès.'
        ], 200);
    }





    /* Les tâches remplies pour l'étape 1 (Enquête de Commodo Incommodo)*/

    public function showEtape1($id_projet)
    {
        // Vérifie si le projet existe
        $projet = Projet::find($id_projet);
        if (!$projet) {
            return response()->json([
                'success' => false,
                'message' => "Projet introuvable."
            ], 404);
        }

        // On récupère les tâches remplies pour ce projet + étape 1
        $tachesRemplies = TacheRemplie::where('id_projet', $id_projet)
            ->whereHas('tache', function ($query) {
                $query->where('id_etape', 1); // seulement étape 1
            })
            ->with(['tache', 'utilisateur'])
            ->get();

        $resultats = $tachesRemplies->map(function ($item) {
            $tache = $item->tache;
            $valeur = $item->valeur_date ?? $item->valeur_string ?? $item->valeur_texte;

            $chemin_pdf = null;
            $url_pdf = null;

            if ($tache->nom === 'fichier_pdf' && $item->valeur_string) {
                $chemin_pdf = $item->valeur_string;
                $url_pdf = asset(Storage::url($chemin_pdf));
            }

            return [
                'id_tache_remplie' => $item->id,
                'tache' => [
                    'id' => $tache->id_tache,
                    'nom' => $tache->nom,
                    'type_valeur' => $tache->type_valeur
                ],
                'valeur' => $valeur,
                'chemin_pdf' => $chemin_pdf,
                'url_pdf' => $url_pdf,
                'utilisateur' => $item->utilisateur?->nom ?? null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $resultats
        ]);
    }

    public function storeEtape1(Request $request)
    {
        // Messages d'erreur
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_utilisateur.exists' => 'L\'utilisateur spécifié n\'existe pas.',
            '*.date' => 'La valeur doit être une date valide.',
            '*.string' => 'La valeur doit être une chaîne de caractères.',
            '*.max' => 'La valeur ne doit pas dépasser 255 caractères.',
            'fichier_pdf.file' => 'Le fichier PDF doit être un fichier valide.',
            'fichier_pdf.mimes' => 'Le fichier doit être un PDF.',
            'fichier_pdf.max' => 'Le fichier PDF ne doit pas dépasser 10 Mo.',
            'id_projet.etape_not_associated' => 'Le projet n\'est pas associé à l\'étape 1 dans etapes_projets.',
        ];

        // Valider les données saisies par l'utilisateur
        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'approbation' => ['nullable', 'date'],
            'num_enregistrement' => ['nullable', 'string', 'max:255'],
            'enregistrement' => ['nullable', 'date'],
            'responsable' => ['nullable', 'string', 'max:255'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'observations' => ['nullable', 'string'],
            'fichier_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ], $messages);

        // Vérifier si le projet est associé à l'étape 1 dans etapes_projets
        $etapeProjet = EtapeProjet::where('id_projet', $data['id_projet'])
            ->where('id_etape', 1)
            ->first();

        if (!$etapeProjet) {
            return response()->json([
                'success' => false,
                'message' => 'Le projet n\'est pas associé à l\'étape 1 dans etapes_projets.'
            ], 400);
        }

        // Récupérer les tâches de l'étape 1 depuis la table taches
        $taches = Tache::where('id_etape', 1)->get()->keyBy('nom');

        // Mapping des champs de la requête aux noms des tâches
        $fieldMap = [
            'Approbation' => 'approbation',
            'Num_enregistrement' => 'num_enregistrement',
            'Enregistrement' => 'enregistrement',
            'Responsable' => 'responsable',
            'Date debut' => 'date_debut',
            'Date fin' => 'date_fin',
            'Observations' => 'observations',
            'fichier_pdf' => 'fichier_pdf',
        ];

        // Définir les champs exemptés (aucun statut à gérer)
        $exemptedFields = ['responsable', 'num_enregistrement', 'date_debut', 'date_fin', 'fichier_pdf'];

        // Vérifier que toutes les tâches attendues existent
        foreach ($fieldMap as $nom => $field) {
            if (!$taches->has($nom)) {
                return response()->json([
                    'success' => false,
                    'message' => "La tâche '$nom' n'existe pas pour l'étape 1."
                ], 400);
            }
        }

        // Créer les tâches remplies dans une transaction
        try {
            DB::beginTransaction();
            $tachesRemplies = [];

            foreach ($fieldMap as $nom => $field) {
                $tache = $taches[$nom];
                // L'utilisateur fournit la valeur (ex. 'approbation', 'num_enregistrement')
                $value = null;
                if ($field === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
                    $value = $request->file('fichier_pdf')->store('pdfs/projet_' . $data['id_projet'], 'public');
                } elseif (array_key_exists($field, $data) && $field !== 'fichier_pdf') {
                    $value = $data[$field];
                }

                // Créer un enregistrement seulement si une valeur est fournie
                if ($value !== null) {
                    $tachesRemplies[] = TacheRemplie::create([
                        'id_projet' => $data['id_projet'],
                        'id_tache' => $tache->id_tache,
                        'id_utilisateur' => $data['id_utilisateur'],
                        match ($tache->type_valeur) {
                            'date' => 'valeur_date',
                            'string' => 'valeur_string',
                            'text' => 'valeur_texte',
                            default => throw new \Exception("Type de valeur inconnu : {$tache->type_valeur}")
                        } => $value,
                    ]);
                }
            }

            DB::commit();

            // Charger les relations pour la réponse
            foreach ($tachesRemplies as $tacheRemplie) {
                $tacheRemplie->load(['projet', 'tache', 'utilisateur']);
            }

            return response()->json([
                'success' => true,
                'data' => $tachesRemplies,
                'message' => 'Tâches remplies pour l\'étape 1 créées avec succès.'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création : ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateEtape1(Request $request)
    {
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_utilisateur.exists' => 'L\'utilisateur spécifié n\'existe pas.',
            '*.date' => 'La valeur doit être une date valide.',
            '*.string' => 'La valeur doit être une chaîne de caractères.',
            '*.max' => 'La valeur ne doit pas dépasser 255 caractères.',
            'fichier_pdf.file' => 'Le fichier PDF doit être un fichier valide.',
            'fichier_pdf.mimes' => 'Le fichier doit être un PDF.',
            'fichier_pdf.max' => 'Le fichier PDF ne doit pas dépasser 10 Mo.',
        ];

        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'approbation' => ['nullable', 'date'],
            'num_enregistrement' => ['nullable', 'string', 'max:255'],
            'enregistrement' => ['nullable', 'date'],
            'responsable' => ['nullable', 'string', 'max:255'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'observations' => ['nullable', 'string'],
            'fichier_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ], $messages);

        $etapeProjet = EtapeProjet::where('id_projet', $data['id_projet'])
            ->where('id_etape', 1)
            ->first();

        if (!$etapeProjet) {
            return response()->json([
                'success' => false,
                'message' => 'Le projet n\'est pas associé à l\'étape 1.'
            ], 400);
        }

        $taches = Tache::where('id_etape', 1)->get()->keyBy('nom');

        $fieldMap = [
            'Approbation' => 'approbation',
            'Num_enregistrement' => 'num_enregistrement',
            'Enregistrement' => 'enregistrement',
            'Responsable' => 'responsable',
            'Date debut' => 'date_debut',
            'Date fin' => 'date_fin',
            'Observations' => 'observations',
            'fichier_pdf' => 'fichier_pdf',
        ];

        try {
            DB::beginTransaction();
            $tachesRemplies = [];

            foreach ($fieldMap as $nom => $field) {
                if (!$taches->has($nom)) {
                    return response()->json([
                        'success' => false,
                        'message' => "La tâche '$nom' n'existe pas pour l'étape 1."
                    ], 400);
                }

                $tache = $taches[$nom];
                $value = null;

                if ($field === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
                    // Enregistre le fichier
                    $value = $request->file('fichier_pdf')->store('pdfs/projet_' . $data['id_projet'], 'public');
                } elseif (array_key_exists($field, $data)) {
                    $value = $data[$field];
                }

                if ($value !== null) {
                    $tacheRemplie = TacheRemplie::where('id_projet', $data['id_projet'])
                        ->where('id_tache', $tache->id_tache)
                        ->first();

                    $valeurColonne = match ($tache->type_valeur) {
                        'date' => 'valeur_date',
                        'string' => 'valeur_string',
                        'text' => 'valeur_texte',
                        default => throw new \Exception("Type de valeur inconnu : {$tache->type_valeur}")
                    };

                    if ($tacheRemplie) {
                        $tacheRemplie->update([
                            'id_utilisateur' => $data['id_utilisateur'],
                            $valeurColonne => $value
                        ]);
                    } else {
                        $tacheRemplie = TacheRemplie::create([
                            'id_projet' => $data['id_projet'],
                            'id_tache' => $tache->id_tache,
                            'id_utilisateur' => $data['id_utilisateur'],
                            $valeurColonne => $value
                        ]);
                    }

                    $tacheRemplie->load(['projet', 'tache', 'utilisateur']);

                    // ✅ Ajouter chemin + URL publique si c’est un fichier
                    if ($tache->nom === 'fichier_pdf') {
                        $url = Storage::url($value); // /storage/pdfs/projet_X/fichier.pdf
                        $tacheRemplie->chemin_pdf = $value;
                        $tacheRemplie->url_pdf = asset($url);
                    }

                    $tachesRemplies[] = $tacheRemplie;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $tachesRemplies,
                'message' => 'Tâches mises à jour avec succès pour l\'étape 1.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteEtape1($id_projet)
    {
        // Vérifie si le projet existe
        $projet = Projet::find($id_projet);
        if (!$projet) {
            return response()->json([
                'success' => false,
                'message' => 'Projet introuvable.'
            ], 404);
        }

        // Récupère les taches_remplies liées à l'étape 1
        $tachesRemplies = TacheRemplie::where('id_projet', $id_projet)
            ->whereHas('tache', function ($query) {
                $query->where('id_etape', 1);
            })
            ->with('tache')
            ->get();

        foreach ($tachesRemplies as $tacheRemplie) {
            $tache = $tacheRemplie->tache;

            // Supprimer le fichier PDF s’il s’agit de la tâche fichier_pdf
            if ($tache->nom === 'fichier_pdf' && $tacheRemplie->valeur_string) {
                $chemin = $tacheRemplie->valeur_string;
                if (Storage::exists($chemin)) {
                    Storage::delete($chemin);
                }
            }

            // Supprimer la ligne tache_remplie
            $tacheRemplie->delete();
        }

        return response()->json([
            'success' => true,
            'message' => "Toutes les données de l'étape 1 ont été supprimées avec succès."
        ]);
    }

    /* Les tâches remplies pour l'étape 2 (Etablissement de l\'état parcellaire et plan parcellaire)*/

    public function showEtape2($id_projet)
    {
        $projet = Projet::find($id_projet);
        if (!$projet) {
            return response()->json([
                'success' => false,
                'message' => "Projet introuvable."
            ], 404);
        }

        $etapeAssociee = EtapeProjet::where('id_projet', $id_projet)
            ->where('id_etape', 2)
            ->exists();

        if (!$etapeAssociee) {
            return response()->json([
                'success' => false,
                'message' => "Le projet $id_projet n'est pas associé à l'étape 2."
            ], 400);
        }

        $tachesRemplies = TacheRemplie::where('id_projet', $id_projet)
            ->whereHas('tache', fn($q) => $q->where('id_etape', 2))
            ->with(['tache', 'utilisateur'])
            ->get();

        $resultats = $tachesRemplies->map(function ($item) {
            $tache = $item->tache;
            $valeur = $item->valeur_date ?? $item->valeur_string ?? $item->valeur_texte;

            $chemin_pdf = null;
            $url_pdf = null;

            if ($tache->nom === 'fichier_pdf' && $item->valeur_string) {
                $chemin_pdf = $item->valeur_string;
                $url_pdf = asset(Storage::url($chemin_pdf));
            }

            return [
                'id_tache_remplie' => $item->id,
                'tache' => [
                    'id' => $tache->id_tache,
                    'nom' => $tache->nom,
                    'type_valeur' => $tache->type_valeur
                ],
                'valeur' => $valeur,
                'chemin_pdf' => $chemin_pdf,
                'url_pdf' => $url_pdf,
                'utilisateur' => $item->utilisateur?->nom
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $resultats
        ]);
    }

    public function storeEtape2(Request $request)
    {
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_utilisateur.exists' => 'L\'utilisateur spécifié n\'existe pas.',
            '*.date' => 'La valeur doit être une date valide.',
            '*.string' => 'La valeur doit être une chaîne de caractères.',
            '*.max' => 'La valeur ne doit pas dépasser 255 caractères.',
            'fichier_pdf.file' => 'Le fichier PDF doit être un fichier valide.',
            'fichier_pdf.mimes' => 'Le fichier doit être un PDF.',
            'fichier_pdf.max' => 'Le fichier PDF ne doit pas dépasser 10 Mo.',
        ];

        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'num_visa' => ['nullable', 'string', 'max:255'],
            'VISA' => ['nullable', 'date'],
            'responsable' => ['nullable', 'string', 'max:255'],
            'observations' => ['nullable', 'string'],
            'fichier_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ], $messages);

        // 🔐 Vérifie que l'étape 1 est bien terminée (statut = "termine")
        $etape1 = EtapeProjet::where('id_projet', $data['id_projet'])
            ->where('id_etape', 1)
            ->first();

        if (!$etape1 || strtolower($etape1->statut) !== 'termine') {
            return response()->json([
                'success' => false,
                'message' => "Impossible d'enregistrer l'étape 2 : l'étape 1 n'est pas encore terminée."
            ], 403);
        }

        // Vérifie que l'étape 2 est bien associée au projet
        $etape2 = EtapeProjet::where('id_projet', $data['id_projet'])
            ->where('id_etape', 2)
            ->first();

        if (!$etape2) {
            return response()->json([
                'success' => false,
                'message' => 'Le projet n\'est pas associé à l\'étape 2.'
            ], 400);
        }

        // 📦 Récupère les tâches liées à l'étape 2
        $taches = Tache::where('id_etape', 2)->get()->keyBy('nom');

        $fieldMap = [
            'num visa' => 'num_visa',
            'VISA' => 'VISA',
            'Responsable' => 'responsable',
            'Observations' => 'observations',
            'fichier_pdf' => 'fichier_pdf',
        ];

        try {
            DB::beginTransaction();
            $tachesRemplies = [];

            foreach ($fieldMap as $nom => $field) {
                if (!$taches->has($nom)) {
                    return response()->json([
                        'success' => false,
                        'message' => "La tâche '$nom' n'existe pas pour l'étape 2."
                    ], 400);
                }

                $tache = $taches[$nom];
                $value = null;

                if ($field === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
                    $value = $request->file('fichier_pdf')->store('pdfs/projet_' . $data['id_projet'], 'public');
                } elseif (array_key_exists($field, $data)) {
                    $value = $data[$field];
                }

                if ($value !== null) {
                    $tachesRemplies[] = TacheRemplie::create([
                        'id_projet' => $data['id_projet'],
                        'id_tache' => $tache->id_tache,
                        'id_utilisateur' => $data['id_utilisateur'],
                        match ($tache->type_valeur) {
                            'date' => 'valeur_date',
                            'string' => 'valeur_string',
                            'text' => 'valeur_texte',
                            default => throw new \Exception("Type de valeur inconnu : {$tache->type_valeur}")
                        } => $value,
                    ]);
                }
            }

            // ✅ Passe automatiquement l'étape 2 en "en cours" si pas encore
            if (!in_array(strtolower($etape2->statut), ['termine', 'en_cours'])) {
                $etape2->statut = 'en_cours';
                $etape2->date_debut = now();
                $etape2->save();
            }

            DB::commit();

            foreach ($tachesRemplies as $tacheRemplie) {
                $tacheRemplie->load(['projet', 'tache', 'utilisateur']);
            }

            return response()->json([
                'success' => true,
                'data' => $tachesRemplies,
                'message' => 'Tâches remplies pour l\'étape 2 créées avec succès.'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création : ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateEtape2(Request $request)
    {
        $messages = [
            'id_projet.required' => 'L\'identifiant du projet est requis.',
            'id_projet.exists' => 'Le projet spécifié n\'existe pas.',
            'id_utilisateur.exists' => 'L\'utilisateur spécifié n\'existe pas.',
            '*.date' => 'La valeur doit être une date valide.',
            '*.string' => 'La valeur doit être une chaîne de caractères.',
            '*.max' => 'La valeur ne doit pas dépasser 255 caractères.',
            'fichier_pdf.file' => 'Le fichier PDF doit être un fichier valide.',
            'fichier_pdf.mimes' => 'Le fichier doit être un PDF.',
            'fichier_pdf.max' => 'Le fichier PDF ne doit pas dépasser 10 Mo.',
        ];

        $data = $request->validate([
            'id_projet' => ['required', 'exists:projets,id_projet'],
            'id_utilisateur' => ['nullable', 'exists:utilisateurs,id'],
            'num_visa' => ['nullable', 'string', 'max:255'],
            'VISA' => ['nullable', 'date'],
            'responsable' => ['nullable', 'string', 'max:255'],
            'observations' => ['nullable', 'string'],
            'fichier_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ], $messages);

        // Vérifie que le projet est lié à l’étape 2
        $etapeProjet = EtapeProjet::where('id_projet', $data['id_projet'])
            ->where('id_etape', 2)
            ->first();

        if (!$etapeProjet) {
            return response()->json([
                'success' => false,
                'message' => "Le projet n'est pas associé à l'étape 2."
            ], 400);
        }

        // Récupère les tâches de l’étape 2
        $taches = Tache::where('id_etape', 2)->get()->keyBy('nom');

        $fieldMap = [
            'num visa' => 'num_visa',
            'VISA' => 'VISA',
            'Responsable' => 'responsable',
            'Observations' => 'observations',
            'fichier_pdf' => 'fichier_pdf',
        ];

        try {
            DB::beginTransaction();
            $tachesRemplies = [];

            foreach ($fieldMap as $nom => $field) {
                if (!$taches->has($nom)) {
                    return response()->json([
                        'success' => false,
                        'message' => "La tâche '$nom' n'existe pas pour l'étape 2."
                    ], 400);
                }

                $tache = $taches[$nom];
                $value = null;

                if ($field === 'fichier_pdf' && $request->hasFile('fichier_pdf')) {
                    $value = $request->file('fichier_pdf')->store('pdfs/projet_' . $data['id_projet'], 'public');
                } elseif (array_key_exists($field, $data)) {
                    $value = $data[$field];
                }

                if ($value !== null) {
                    $tacheRemplie = TacheRemplie::where('id_projet', $data['id_projet'])
                        ->where('id_tache', $tache->id_tache)
                        ->first();

                    $colonne = match ($tache->type_valeur) {
                        'date' => 'valeur_date',
                        'string' => 'valeur_string',
                        'text' => 'valeur_texte',
                        default => throw new \Exception("Type de valeur inconnu : {$tache->type_valeur}")
                    };

                    if ($tacheRemplie) {
                        $tacheRemplie->update([
                            'id_utilisateur' => $data['id_utilisateur'],
                            $colonne => $value
                        ]);
                    } else {
                        $tacheRemplie = TacheRemplie::create([
                            'id_projet' => $data['id_projet'],
                            'id_tache' => $tache->id_tache,
                            'id_utilisateur' => $data['id_utilisateur'],
                            $colonne => $value
                        ]);
                    }

                    $tacheRemplie->load(['tache', 'projet', 'utilisateur']);

                    // Si c’est un PDF, ajouter chemin et URL
                    if ($tache->nom === 'fichier_pdf' && $colonne === 'valeur_string') {
                        $tacheRemplie->chemin_pdf = $value;
                        $tacheRemplie->url_pdf = asset(Storage::url($value));
                    }

                    $tachesRemplies[] = $tacheRemplie;
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $tachesRemplies,
                'message' => "Tâches de l'étape 2 mises à jour avec succès."
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour : ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteEtape2($id_projet)
    {
        $tachesRemplies = TacheRemplie::where('id_projet', $id_projet)
            ->whereHas('tache', fn($q) => $q->where('id_etape', 2))
            ->with('tache')
            ->get();

        if ($tachesRemplies->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "Aucune tâche remplie pour l'étape 2 du projet $id_projet."
            ], 404);
        }

        foreach ($tachesRemplies as $tacheRemplie) {
            $tache = $tacheRemplie->tache;

            if ($tache->nom === 'fichier_pdf' && $tacheRemplie->valeur_string) {
                $chemin = $tacheRemplie->valeur_string;
                if (Storage::exists($chemin)) {
                    Storage::delete($chemin);
                }
            }

            $tacheRemplie->delete();
        }

        return response()->json([
            'success' => true,
            'message' => "Toutes les données de l'étape 2 du projet $id_projet ont été supprimées avec succès."
        ]);
    }
}
