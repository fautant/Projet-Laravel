<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    // Récupération des sauces avec pagination
    $sauces = Sauce::paginate(10);

    // Utilisation de map() sur chaque élément de la collection paginée
    $sauces->getCollection()->transform(function($sauce) {
        // Initialisation des variables pour chaque sauce
        $userHasLiked = false;
        $userHasDisliked = false;

        // Décodage des utilisateurs ayant aimé ou disliké
        $usersLiked = json_decode($sauce->usersLiked, true) ?? []; // Si c'est null, on initialise un tableau vide
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? []; // Si c'est null, on initialise un tableau vide

        // Vérification si l'utilisateur a liké ou disliké
        if (in_array(auth()->id(), $usersLiked)) {
            $userHasLiked = true;
        }
        if (in_array(auth()->id(), $usersDisliked)) {
            $userHasDisliked = true;
        }

        // Ajout des informations de like/dislike pour cette sauce
        $sauce->userHasLiked = $userHasLiked;
        $sauce->userHasDisliked = $userHasDisliked;

        return $sauce;
    });

    // Retourner la vue avec les sauces et l'état de like/dislike
    return view('home')
        ->with('sauces', $sauces);
}


}

