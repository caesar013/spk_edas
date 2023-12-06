<?php

namespace App\Http\Controllers;

use App\Models\Average;
use App\Http\Requests\StoreAverageRequest;
use App\Http\Requests\UpdateAverageRequest;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\DecisionMatrix;
use App\Models\Edas;

class AverageController extends Controller
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
    public function store(StoreAverageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $averages = Average::where('id_edas', $id_edas)->get();

        return view('average', compact('edas', 'averages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Average $average)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAverageRequest $request, Average $average)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Average $average)
    {
        //
    }
}
