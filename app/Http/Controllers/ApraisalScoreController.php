<?php

namespace App\Http\Controllers;

use App\Models\ApraisalScore;
use App\Http\Requests\StoreApraisalScoreRequest;
use App\Http\Requests\UpdateApraisalScoreRequest;
use App\Models\Alternative;
use App\Models\Edas;

class ApraisalScoreController extends Controller
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
    public function store(StoreApraisalScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        $apraisalscores = ApraisalScore::where('id_edas', $id_edas)->get();

        return view('apraisalscore', compact('edas', 'alternatives', 'apraisalscores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApraisalScore $apraisalScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApraisalScoreRequest $request, ApraisalScore $apraisalScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApraisalScore $apraisalScore)
    {
        //
    }
}
