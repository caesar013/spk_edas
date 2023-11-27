<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Http\Requests\StoreAlternativeRequest;
use App\Http\Requests\UpdateAlternativeRequest;
use App\Models\Criteria;
use App\Models\Edas;
use App\Models\Subcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlternativeController extends Controller
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
        ];

        $messages =
            [
                'required' => 'The :attribute field is required.',
                'integer' => 'The :attribute must be an integer.',
            ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $alternative = Alternative::create($validator->validated());
            return response()->json([
                'status' => true,
                'message' => ($alternative) ? 'Alternative added successfully' : "Failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $edas = Edas::find($id_edas)->first();
        $status_criteria = $criterias->count() > 0 ? true : false;
        $status_subcriteria = $criterias->count() == Subcriteria::where('id_edas', $id_edas)->get()->groupBy('id_criteria')->count() ? true : false;
        return view('alternative', compact('alternatives', 'edas', 'status_criteria', 'status_subcriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_alternative)
    {
        $alternative = Alternative::where('id', $id_alternative)->first();
        if ($alternative) {
            return response()->json([
                'status' => true,
                'alternative' => $alternative,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Alternative not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_alternative)
    {
        $rules = [
            'id_edas' => 'required|integer|exists:edas,id',
            'name' => 'required|string|max:50',
        ];

        $messages =
            [
                'required' => 'The :attribute field is required.',
                'integer' => 'The :attribute must be an integer.',
            ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $alternative = Alternative::where('id', $id_alternative)->update($validator->validated());
            return response()->json([
                'status' => true,
                'message' => ($alternative) ? 'Alternative updated successfully' : "Failed"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_alternative)
    {
        $alternative = Alternative::where('id', $id_alternative)->first();
        if ($alternative) {
            $alternative->delete();
            return response()->json([
                'status' => true,
                'message' => 'Alternative deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Alternative not found',
            ]);
        }
    }

    public function fetchData($id_edas)
    {
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        return response()->json([
            'alternatives' => $alternatives,
        ]);
    }
}
