<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class GameController extends Controller
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
        if(!$request->name || !$request->year || !$request->developer || !$request->photo) {
            return response()->json(['message' => 'Informação obrigatórias estão ausentes!'])->setStatusCode(422);
        }

        try {

            // Save photo
            $png_url = "photo-".time().".png";
            $path = 'images/games/' . $png_url;
            $photo = Image::make(file_get_contents($request->photo))->save($path);     
            
            $game = new Game;
            $game->name = $request->name;
            $game->photo = $path;
            $game->year =  Carbon::create($request->year)->startOfYear()->toDateString();
            $game->developer = $request->developer;
            $game->save();

        }catch(\Exception $e) {

            return response()->json(['message' => 'Ocorreu um erro no cadastro do jogo!'])->setStatusCode(422);
        }

        return response()->json(['message' => 'Cadastro finalizado com sucesso!'])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
