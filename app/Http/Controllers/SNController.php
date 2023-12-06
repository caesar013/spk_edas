<?php

namespace App\Http\Controllers;

use App\Models\SN;
use App\Http\Requests\StoreSNRequest;
use App\Http\Requests\UpdateSNRequest;
use App\Models\Edas;

class SNController extends Controller
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
    public function store(StoreSNRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $sns = SN::where('id_edas', $id_edas)->get();

        return view('sn', compact('edas', 'sns'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SN $sN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSNRequest $request, SN $sN)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SN $sN)
    {
        //
    }
}
