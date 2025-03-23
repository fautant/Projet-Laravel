<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sauce;

class ApiController extends Controller
{
    public function index()
    {
        $sauces = Sauce::paginate(10); // Affiche 10 clients par page
        return response()->json($sauces);
    }
    
   
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'name' => 'required',
            'manufacturer' => 'required',
            'description' => 'required',
            'imageUrl' => 'required',
            'mainPepper' => 'required',
            'heat' => 'required'
        ]);
    
        // Création du sauce
        $sauce = Sauce::create($request->all());
    
        // Retourne une réponse JSON avec le sauce créé et le code de statut 201
        return response()->json($sauce, 201);
    }
    
   
    public function show(string $id)
    {
        $sauce = Sauce::find($id);
    
        // Si la sauce n'est pas trouvé, renvoyer une erreur 404
        if (!$sauce) {
            return response()->json(['message' => 'Sauce non trouvé'], 404);
        }
    
        return response()->json($sauce);
    }
    
   
    public function update(Request $request, string $id)
    {
        // Validation des données reçues
        $request->validate([
            'numeroClient' => 'required',
            'nom' => 'required',
            'email' => 'required|email',
            'carteBancaire' => 'required'
        ]);
    
        // Trouver le client à mettre à jour
        $client = Client::find($id);
    
        if (!$client) {
            return response()->json(['message' => 'Client non trouvé'], 404);
        }
    
        // Mise à jour du client
        $client->update($request->all());
    
        // Retourner la réponse JSON avec le client mis à jour
        return response()->json($client);
    }
    
   
    public function destroy(string $id)
    {
       $client = Client::find($id);
       echo $client;
    
        if (!$client) {
            return response()->json(['message' => 'Client non trouvé'], 404);
        }
    
        // Supprimer le client
        $client->delete();
    
        // Retourner une réponse avec un code 204 pour indiquer que la suppression a réussi
        return response()->json(null, 204);
    }
}
