<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $category = new Category;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
        }catch(\Exception $e) {

            return response()->json(['message' => 'Ocorreu um erro no cadastro da categoria!'])->setStatusCode(422);
        }

        return response()->json(['message' => 'Categoria cadastrada com sucesso!'])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Display all resources.
     */
    public function all(Request $request)
    {
        $categories = Category::all();
        
        $collect = collect();
        $aux_array = array();

        foreach($categories as $category) {

            $aux_array['id'] = $category->id;
            $aux_array['name'] = $category->name;
            $aux_array['description'] = $category->description;

            $collect->push($aux_array);

            $aux_array = [];
        }

        return $collect->toArray();
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();

        if(!$category) {
            return response()->json(['message' => 'Categoria não encontrada com esse id!'])->setStatusCode(422);
        }

        try {
            $category->delete();

        }catch(\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar excluir a categoria!'])->setStatusCode(422);
        }

        return response()->json(['message' => 'Categoria deletada!'])->setStatusCode(201);
    }
}
