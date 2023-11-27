<?php

namespace App\Http\Controllers;

use App\Models\Subcriteria;
use App\Http\Requests\StoreSubcriteriaRequest;
use App\Http\Requests\UpdateSubcriteriaRequest;
use App\Models\Criteria;
use App\Models\Edas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcriteriaController extends Controller
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
            'id_criteria' => 'required|integer|exists:criterias,id',
            'value' => 'required|numeric',
            'information' => 'required|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => 'Not valid'
            ]);
        } else {
            $subcriteria = Subcriteria::create($validator->validated());
            return response()->json([
                'status' => true,
                'message' => ($subcriteria) ? 'Subcriteria added successfully' : "Failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_criteria)
    {
        $subcriterias = Subcriteria::where('id_criteria', $id_criteria)->get();
        $criteria = Criteria::where('id', $id_criteria)->first();

        return view('subcriteria', compact(['subcriterias', 'criteria']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_subcriteria)
    {
        $subcriteria = Subcriteria::where('id', $id_subcriteria)->first();
        if ($subcriteria) {
            return response()->json([
                'status' => true,
                'subcriteria' => $subcriteria
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Subcriteria not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_subcriteria)
    {
        $rules = [
            'id_criteria' => 'required|integer|exists:criterias,id',
            'value' => 'required|numeric',
            'information' => 'required|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => 'Not valid'
            ]);
        } else {
            $subcriteria = Subcriteria::where('id', $id_subcriteria)->first();
            if ($subcriteria) {
                $subcriteria->update($validator->validated());
                return response()->json([
                    'status' => true,
                    'message' => 'Subcriteria updated successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => 'Subcriteria not Found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_subcriteria)
    {
        $subcriteria = Subcriteria::where('id', $id_subcriteria)->first();
        if ($subcriteria) {
            $subcriteria->delete();

            return response()->json([
                'status' => true,
                'message' => 'Subcriteria deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'Subcriteria not Found'
            ]);
        }
    }

    public function fetchData($id_criteria)
    {
        $subcriterias = Subcriteria::where('id_criteria', $id_criteria)->get();

        $data = [
            'subcriterias' => $subcriterias,
        ];

        return response()->json($data);
    }
}
