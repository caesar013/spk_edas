<?php

namespace App\Http\Controllers;

use App\Models\NDA;
use App\Http\Requests\StoreNDARequest;
use App\Http\Requests\UpdateNDARequest;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Edas;

class NDAController extends Controller
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
    public function store(StoreNDARequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $ndas = NDA::where('id_edas', $id_edas)->get();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();

        return view('nda', compact(['edas', 'ndas', 'criterias', 'alternatives']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NDA $nDA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNDARequest $request, NDA $nDA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NDA $nDA)
    {
        //
    }
}
