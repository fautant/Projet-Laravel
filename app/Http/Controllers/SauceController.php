<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;

class SauceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $clients = Client::all();
        $sauces= Sauce::paginate(10);
        return view('sauces.index', compact('sauces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sauces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255', // Added string and max length constraints
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|mimes:jpeg,jpg,png|max:2048', // Added max file size validation (2MB)
            'mainPepper' => 'required|string|max:255',
            'heat' => 'required|integer|min:1|max:10' // Added integer and range constraints for heat
        ]);
        
        // Handle the image upload
        $image = $request->file('imageUrl');
        
        // Ensure the image is valid and not empty
        if ($image) {
            // Generate a unique file name
            $imageName = $request->name . '.png';
            // Move the image to the public images directory
            $image->move(public_path('images'), $imageName);
        }
        
        // Prepare data to insert into the database
        $data = $request->all();
        
        // Merge userId into the data array
        $data = array_merge($data, ['userId' => $userId]);
        
        // Create the new Sauce entry in the database
        Sauce::create($data);
        
        // Redirect back to the home route with a success message
        return redirect()->route('home')->with('success', 'Sauce créée avec succès.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //return view('sauces.show', ["sauce" => Sauce::where('name', $name)->first()]);
        return view('sauces.show', ["sauce" => Sauce::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$sauce = Sauce::where('name', $name)->first();
        //return view('sauces.edit', ["sauce" => $sauce]);
        return view('sauces.edit', ["sauce" => Sauce::find($id)]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = auth()->id();

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255', // Added string and max length constraints
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'imageUrl' => 'required|mimes:jpeg,jpg,png|max:2048', // Added max file size validation (2MB)
            'mainPepper' => 'required|string|max:255',
            'heat' => 'required|integer|min:1|max:10' // Added integer and range constraints for heat
        ]);
        
        // Handle the image upload
        $image = $request->file('imageUrl');
        
        // Ensure the image is valid and not empty
        if ($image) {
            // Generate a unique file name
            $imageName = $request->name . '.png';
            // Move the image to the public images directory
            $image->move(public_path('images'), $imageName);
        }
        
        // Prepare data to insert into the database
        $data = $request->all();
        
        // Merge userId into the data array
        $data = array_merge($data, ['userId' => $userId]);
        
        $sauce = Sauce::find($id);
        $sauce->update($data);
        
        // Redirect back to the home route with a success message
        return redirect()->route('home')->with('success', 'Sauce mis à jour avec succès.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $sauce = Sauce::find($id);
        $sauce->delete();

        return redirect()->route('home')->with('success','Client suprrimé avec succès');
    }

    public function like(string $id)
    {
        // Récupérer l'élément existant dans la base de données
        $sauce = Sauce::find($id); // Trouver la sauce par son ID

        // Vérifier si la colonne JSON existe déjà et décodez-la, sinon créez un tableau vide
        $usersLiked = json_decode($sauce->usersLiked, true) ?? []; // Si c'est null, on initialise un tableau vide
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? []; // Si c'est null, on initialise un tableau vide


        // Vérifier si l'utilisateur est déjà dans la liste 'usersLiked'
        if (!in_array(auth()->id(), $usersLiked)) {
            // Si l'utilisateur n'est pas déjà dans la liste, on l'ajoute
            $usersLiked[] = auth()->id();
            
            // Mettre à jour la colonne avec les nouvelles données JSON
            $sauce->usersLiked = json_encode($usersLiked);
            $sauce->increment('likes');

            $userHasLiked = true;
            $userHasDisliked = false;

            if (in_array(auth()->id(), $usersDisliked)) {
                $usersDisliked = array_diff($usersDisliked, [auth()->id()]);
                $sauce->usersDisliked = json_encode($usersDisliked);

                if ($sauce->dislikes > 0) {
                    $sauce->decrement('dislikes');
                }
            }
            // Sauvegarder la mise à jour
            $sauce->save();

            // Retourner une réponse de succès (par exemple)
            return redirect()->route('home')->with('success','Client suprrimé avec succès');
        }
        
    }

    public function dislike(string $id)
    {
         // Récupérer l'élément existant dans la base de données
        $sauce = Sauce::find($id); // Trouver la sauce par son ID

        // Vérifier si la colonne JSON existe déjà et décodez-la, sinon créez un tableau vide
        $usersLiked = json_decode($sauce->usersLiked, true) ?? []; // Si c'est null, on initialise un tableau vide
        $usersDisliked = json_decode($sauce->usersDisliked, true) ?? []; // Si c'est null, on initialise un tableau vide


        // Vérifier si l'utilisateur est déjà dans la liste 'usersLiked'
        if (!in_array(auth()->id(), $usersDisliked)) {
            // Si l'utilisateur n'est pas déjà dans la liste, on l'ajoute
            $usersDisliked[] = auth()->id();
            
            // Mettre à jour la colonne avec les nouvelles données JSON
            $sauce->usersDisliked = json_encode($usersDisliked);
            $sauce->increment('dislikes');

            $userHasLiked = false;
            $userHasDisliked = true;

            if (in_array(auth()->id(), $usersLiked)) {
                $usersLiked = array_diff($usersLiked, [auth()->id()]);
                $sauce->usersLiked = json_encode($usersLiked);

                if ($sauce->likes > 0) {
                    $sauce->decrement('likes');
                }
            }
            // Sauvegarder la mise à jour
            $sauce->save();

            // Retourner une réponse de succès (par exemple)
            return redirect()->route('home')->with('success','Client suprrimé avec succès');
        }
    }

}
