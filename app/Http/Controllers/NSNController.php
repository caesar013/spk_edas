<?php

namespace App\Http\Controllers;

use App\Models\NSN;
use App\Http\Requests\StoreNSNRequest;
use App\Http\Requests\UpdateNSNRequest;
use App\Models\Edas;

class NSNController extends Controller
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
    public function store(StoreNSNRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $nsns = NSN::where('id_edas', $id_edas)->get();

        return view('nsn', compact('edas', 'nsns'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NSN $nSN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNSNRequest $request, NSN $nSN)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NSN $nSN)
    {
        //
    }
}
