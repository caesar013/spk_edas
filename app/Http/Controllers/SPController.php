<?php

namespace App\Http\Controllers;

use App\Models\SP;
use App\Http\Requests\StoreSPRequest;
use App\Http\Requests\UpdateSPRequest;
use App\Models\Edas;

class SPController extends Controller
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
    public function store(StoreSPRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $sps = SP::where('id_edas', $id_edas)->get();

        return view('sp', compact('edas', 'sps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SP $sP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSPRequest $request, SP $sP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SP $sP)
    {
        //
    }
}
