<?php

namespace App\Http\Controllers;

use App\Models\PDA;
use App\Http\Requests\StorePDARequest;
use App\Http\Requests\UpdatePDARequest;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Edas;

class PDAController extends Controller
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
    public function store(StorePDARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $pdas = PDA::where('id_edas', $id_edas)->get();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();

        return view('pda', compact(['edas', 'pdas', 'criterias', 'alternatives']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PDA $pDA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePDARequest $request, PDA $pDA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PDA $pDA)
    {
        //
    }
}
