<?php

namespace App\Http\Controllers;

use App\Models\voting;
use App\Http\Requests\StorevotingRequest;
use App\Http\Requests\UpdatevotingRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class VotingController extends Controller
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
        
        if( $request->is_active == true) {
            $voting_verification = Voting::where('is_active', true)->first();
            if($voting_verification) {
                return response()->json(['message' => 'Já existe uma votação ativa!'])->setStatusCode(422);
            }
        }

        try {

            // Save photo
            $png_url = "photo-".time().".png";
            $path = 'images/voting/' . $png_url;
            $photo = Image::make(file_get_contents($request->photo))->save($path);    

            $voting = new Voting;
            $voting->name = $request->name;
            $voting->expires_in = $request->expires_in;
            $voting->is_active = true;
            $voting->photo = $path;
            $voting->save();

        }catch(\Exception $e){
            return response()->json(['message' => 'Ocorreu um erro no cadastro da votação!'])->setStatusCode(422);
        }

        return response()->json(['message' => 'Cadastro finalidado!'])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(voting $voting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevotingRequest $request, voting $voting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(voting $voting)
    {
        //
    }
}
