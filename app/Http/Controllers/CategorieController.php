<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       try {
        $categories=Categorie::all();
        return response()->json($categories);//retiur liste des categorie au format json
       }
       catch (\Exception $e) {
        return response()->json("catégorie non disponible") ;
       }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categorie=new Categorie([
                'nomcategorie'=> $request->input('nomcategorie'),
                'imagecategorie'=> $request->input('imagecategorie'),
            ]);
            $categorie->save();
            return response()->json($categorie);
        }
        catch (\Exception $e) {
            return response()->json("problémé d'ajout de catégorie") ;


        }

    }


    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        try {
            
            $categorie=Categorie::findOrFail($id);
            return response()->json($categorie);
        }
        catch (\Exception $e) {
            return response()->json("problémé de récupération de categorie") ;


        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->update($request->all());
            return response()->json($categorie);

        }
        catch (\Exception $e) {
           // return response()->json("problémé de modification  de catégorie") ;
           return response()->json("probléme de modification {$e->getMessage()},{$e->getCode()}") ;


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorie=Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json("categorie supprimée avec succées");
            
            
        }
        catch (\Exception $e) {
            return response()->json("problémé de suppression de categorie") ;


        }
    }
}