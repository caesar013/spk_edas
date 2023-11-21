<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Edas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
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
        $rules = [
            'id_edas' => 'required|integer|exists:edas,id',
            'name' => 'required|string|max:50',
            'weight' => 'required|numeric',
            'type' => 'required|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $criteria = Criteria::create($validator->validated());
            return response()->json([
                'status' => true,
                'id_edas' => $validator->validated()['id_edas'],
                'message' => ($criteria) ? 'Criteria added successfully' : "Failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $edas = Edas::where('id', $id_edas)->first();

        $isEmpty = $criterias->isEmpty();

        return view('criteria', compact(['criterias', 'edas', 'isEmpty']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_criteria)
    {
        $criteria = Criteria::where('id', $id_criteria)->first();
        if ($criteria) {
            return response()->json([
                'status' => true,
                'criteria' => $criteria
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Criteria not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_criteria)
    {
        $rules =
            [
                'id_edas' => 'required|integer|exists:edas,id',
                'name' => 'required|string|max:50',
                'weight' => 'required|numeric',
                'type' => 'required|string|max:50',
            ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $criteria = Criteria::where('id', $id_criteria)->first();
            if ($criteria) {
                $criteria->update($validator->validated());
                return response()->json([
                    'status' => true,
                    'message' => ($criteria) ? 'Criteria updated successfully' : "Failed"
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => 'Criteria not Found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_criteria)
    {
        $criteria = Criteria::where('id', '=', $id_criteria)->first();
        if ($criteria) {
            $criteria->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data removed successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Criteria not Found'
            ]);
        }
    }

    public function fetchData($id_edas)
    {
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        return response()->json([
            'criterias' => $criterias
        ]);
    }
}
