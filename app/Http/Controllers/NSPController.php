<?php

namespace App\Http\Controllers;

use App\Models\NSP;
use App\Http\Requests\StoreNSPRequest;
use App\Http\Requests\UpdateNSPRequest;
use App\Models\Edas;

class NSPController extends Controller
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
    public function store(StoreNSPRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $nsps = NSP::where('id_edas', $id_edas)->get();

        return view('nsp', compact('edas', 'nsps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NSP $nSP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNSPRequest $request, NSP $nSP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NSP $nSP)
    {
        //
    }
}
