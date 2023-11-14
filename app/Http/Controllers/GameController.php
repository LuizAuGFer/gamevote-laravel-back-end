<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use File;

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

        $game = Game::where('name', $request->name)->where('developer', $request->developer)->first();

        if($game) {
            return response()->json(['message' => 'Já existe um jogo cadastrado com esse nome!'])->setStatusCode(422);
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
    public function query(Request $request)
    {
        $games = Game::where('name', 'like','%'.$request->name.'%')->get();
        $collect = collect();
        $aux_array = array();

        foreach($games as $game) {
            $aux_array['id'] = $game->id;
            $aux_array['name'] = $game->name;
            $aux_array['year'] = $game->year;
            $aux_array['developer'] = $game->developer;

            $collect->push($aux_array);

            $aux_array = [];
        }

        return $collect->toArray();
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
    public function update(Request $request)
    {
        $game = Game::where('id', $request->game_id)->first();

        if(!$game) {
            return response()->json(['message' => 'Jogo não encontrado com esse id!'])->setStatusCode(422);
        }

       try {
        
            // Update photo
            if($request->photo) {

                if (file_exists($game->photo)){
                // Remove
                if(File::exists($game->photo)) {
                        File::delete($game->photo);
                    }
                }

                // Save photo
                $png_url = "photo-".time().".png";
                $path = 'images/games/' . $png_url;
                $photo = Image::make(file_get_contents($request->photo))->save($path);    

                $game->update(['photo' => $path]);
            }
        

            $game->update([
                'name' => $request->name,
                'year' => $request->year,
                'developer' => $request->developer
            ]);

       }catch(\Exception $e) {

        return response()->json(['message' => 'Ocorreu um erro ao tentar atualizar o jogo!'])->setStatusCode(422);

       }

       return response()->json(['message' => 'Atualização finalizada com sucesso!'])->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $game = Game::where('id', $request->game_id)->first();

        if(!$game) {
            return response()->json(['message' => 'Jogo não encontrado com esse id!'])->setStatusCode(422);
        }

        try {

            // Remove photo
            if(File::exists($game->photo)) {
                File::delete($game->photo);
            }

            $game->delete();

        }catch(\Exception $e) {
            return response()->json(['message' => 'Erro ao tentar excluir o jogo!'])->setStatusCode(422);
        }

        return response()->json(['message' => 'Jogo deletado'])->setStatusCode(201);
    }
}
