<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Sauce;

class SauceApiController extends Controller
{
    // Récupérer toutes les sauces
    public function index()
    {
        return response()->json(Sauce::all(), Response::HTTP_OK);
    }

    // Créer une nouvelle sauce
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'heat' => 'required|integer|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        // Création et renvoie sauce par le modèle
        $sauce = Sauce::create($validated);

        // Envoie de la réponse par l'API
        return response()->json($sauce, Response::HTTP_CREATED);
    }

    // Afficher une sauce spécifique
    public function show($id)
    {
        $sauce = Sauce::find($id);

        if (!$sauce) {
            return response()->json(['message' => 'Sauce non trouvée'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($sauce, Response::HTTP_OK);
    }

    // Modifier une sauce
    public function update(Request $request, $id)
    {
        $sauce = Sauce::find($id);

        if (!$sauce) {
            return response()->json(['message' => 'Sauce non trouvée'], Response::HTTP_NOT_FOUND);
        }

        // Validation des données
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'heat' => 'sometimes|required|integer|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        $sauce->update($validated);

        // Envoie de la réponse par l'API
        return response()->json($sauce, Response::HTTP_OK);
    }

    // Supprimer une sauce
    public function destroy($id)
    {
        $sauce = Sauce::find($id);

        if (!$sauce) {
            return response()->json(['message' => 'Sauce non trouvée'], Response::HTTP_NOT_FOUND);
        }

        // Suppression de la sauce
        $sauce->delete();

        // Envoie de la réponse par l'API
        return response()->json(['message' => 'Sauce supprimée'], Response::HTTP_OK);
    }
}
