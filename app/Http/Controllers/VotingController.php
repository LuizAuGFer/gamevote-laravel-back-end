<?php

namespace App\Http\Controllers;

use App\Models\voting;
use App\Http\Requests\StorevotingRequest;
use App\Http\Requests\UpdatevotingRequest;

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
    public function store(StorevotingRequest $request)
    {
        //
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
