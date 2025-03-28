<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;
use Illuminate\Support\Facades\Auth;

class SauceController extends Controller
{
    // Affiche toutes les sauces
    public function index()
    {
        //$sauces = Sauce::all();
        $sauces= Sauce::paginate(10);
        return view('sauces.index', compact('sauces'));
    }

    // Affiche le formulaire de création d'une sauce
    public function create()
    {
        return view('sauces.create');
    }

    // Stocke une nouvelle sauce en base
    public function store(Request $request)
    {
        $userId = Auth::id();

        // Regex
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|mimes:jpeg,jpg,png|max:2048',
            'mainPepper' => 'required|string|max:255',
            'heat' => 'required|integer|min:1|max:10'
        ]);
        
        // Image
        $image = $request->file('imageUrl');
        if ($image) {
            $imageName = $request->name . '.png';
            $image->move(public_path('storage/sauces'), $imageName);
        }
        
        $data = $request->all();
        $data = array_merge($data, ['userId' => $userId]);
        Sauce::create($data);

        return redirect()->route('sauces.index')->with('success', 'Sauce créée avec succès.');
        
    }

    // Affiche une sauce spécifique
    public function show($id)
    {
        return view('sauces.show', ["sauce" => Sauce::find($id)]);
    }

    // Affiche le formulaire d'édition d'une sauce
    public function edit($id)
    {
        return view('sauces.edit', ["sauce" => Sauce::find($id)]);
    }

    // Met à jour une sauce
    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        // Regex
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|mimes:jpeg,jpg,png|max:2048',
            'mainPepper' => 'required|string|max:255',
            'heat' => 'required|integer|min:1|max:10'
        ]);
        
        // Image
        $image = $request->file('imageUrl');
        if ($image) {
            $imageName = $request->name . '.png';
            $image->move(public_path('storage/sauces'), $imageName);
        }
        
        $data = $request->all();
        $data = array_merge($data, ['userId' => $userId]);
        
        $sauce = Sauce::find($id);
        $sauce->update($data);

        return redirect()->route('sauces.index')->with('success', 'Sauce mise à jour avec succès.');
    }

    // Supprime une sauce
    public function destroy($id)
    {
        $sauce = Sauce::find($id);
        $sauce->delete();

        return redirect()->route('sauces.index')->with('success','Sauce supprimée avec succès');
    }

    public function like($id)
    {
        $sauce = Sauce::find($id);

        $usersLiked = json_decode($sauce->usersLiked, true) ?? []; // Si c'est null, on initialise un tableau vide
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? []; // Pareil

        // Vérifier si l'utilisateur est déjà dans la liste 'usersLiked'
        if (!in_array(Auth::id(), $usersLiked)) {
            // Si l'utilisateur n'est pas déjà dans la liste, on l'ajoute
            $usersLiked[] = Auth::id();
            
            // Mettre à jour la colonne avec les nouvelles données JSON
            $sauce->usersLiked = json_encode($usersLiked);
            $sauce->increment('likes');

            if (in_array(Auth::id(), $usersDisliked)) {
                $usersDisliked = array_diff($usersDisliked, [Auth::id()]);
                $sauce->usersDisliked = json_encode($usersDisliked);

                if ($sauce->dislikes > 0) {
                    $sauce->decrement('dislikes');
                }
            }
            // Sauvegarder la mise à jour
            $sauce->save();

            return redirect()->route('sauces.index')->with('success','Vous avez liké avec succès');
        }
        return redirect()->route('sauces.index')->with('fail','Vous aviez déjà liké');
        
    }

    public function dislike($id)
    {
        $sauce = Sauce::find($id);

        $usersLiked = json_decode($sauce->usersLiked, true) ?? []; // Si c'est null, on initialise un tableau vide
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? []; // Pareil

        // Vérifier si l'utilisateur est déjà dans la liste 'usersDisliked'
        if (!in_array(Auth::id(), $usersDisliked)) {
            // Si l'utilisateur n'est pas déjà dans la liste, on l'ajoute
            $usersDisliked[] = Auth::id();
            
            // Mettre à jour la colonne avec les nouvelles données JSON
            $sauce->usersDisliked = json_encode($usersDisliked);
            $sauce->increment('dislikes');

            if (in_array(Auth::id(), $usersLiked)) {
                $usersLiked = array_diff($usersLiked, [Auth::id()]);
                $sauce->usersLiked = json_encode($usersLiked);

                if ($sauce->likes > 0) {
                    $sauce->decrement('likes');
                }
            }
            
            $sauce->save();

            return redirect()->route('sauces.index')->with('success','Vous avez disliké avec succès');
        }
        return redirect()->route('sauces.index')->with('fail','Vous aviez déjà disliké');
    }
}
