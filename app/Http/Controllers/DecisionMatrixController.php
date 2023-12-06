<?php

namespace App\Http\Controllers;

use App\Events\DecisionMatrixUpdated;
use App\Models\DecisionMatrix;
use App\Http\Requests\StoreDecisionMatrixRequest;
use App\Http\Requests\UpdateDecisionMatrixRequest;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Edas;
use App\Models\Subcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DecisionMatrixController extends Controller
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
    public function store(StoreDecisionMatrixRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_edas)
    {
        $edas = Edas::where('id', $id_edas)->first();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        $subcriterias = Subcriteria::where('id_edas', $id_edas)->get();
        $decisionmatrix = DecisionMatrix::where('id_edas', $id_edas)->get();
        $status_criteria = $criterias->count() > 0 ? true : false;
        $status_alternative = $alternatives->count() > 0 ? true : false;
        $status_subcriteria = $criterias->count() == Subcriteria::where('id_edas', $id_edas)->get()->groupBy('id_criteria')->count() ? true : false;

        return view('decisionmatrix', compact(['edas', 'criterias', 'alternatives', 'subcriterias', 'decisionmatrix', 'status_criteria', 'status_alternative', 'status_subcriteria']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_edas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_edas)
    {
        $rules =
            [
                'id_alternative' => 'required|integer|exists:alternatives,id',
                'id_criteria' => 'required|integer|exists:criterias,id',
                'id_subcriteria' => 'required|integer|exists:subcriterias,id',
            ];

        $messages =
            [
                'required' => 'The :attribute field is required.',
                'integer' => 'The :attribute must be an integer.',
                'between' => 'The :attribute must be between :min - :max.',
            ];

        $data = $request->all();
        $validator = [];
        foreach ($data as $key => $value) {
            if ($value['id_subcriteria'] == 0) {
                continue;
            }
            $validator[$key] = Validator::make($value, $rules, $messages);
            if ($validator[$key]->fails()) {
                dd($validator[$key]->messages(), $key, $value);
                return response()->json([
                    'status' => false,
                    'error' => $validator[$key]->messages()
                ]);
            } else {
                $dm = DecisionMatrix::updateOrCreate(
                    [
                        'id_alternative' => $value['id_alternative'],
                        'id_criteria' => $value['id_criteria'],
                        'id_edas' => $id_edas,
                    ],
                    [
                        'id_subcriteria' => $value['id_subcriteria'],
                    ]
                );
            }
        }
        $dms = DecisionMatrix::where('id_edas', $id_edas)->get();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        if ($dms->count() == $criterias->count() * $alternatives->count()) {
            event(new DecisionMatrixUpdated($dms, $criterias, $alternatives));
        }
        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DecisionMatrix $decisionMatrix)
    {
        //
    }

    public function fetchData($id_edas)
    {
        $decisionmatrix = DecisionMatrix::where('id_edas', $id_edas)->get();
        $criterias = Criteria::where('id_edas', $id_edas)->get();
        $alternatives = Alternative::where('id_edas', $id_edas)->get();
        $subcriterias = Subcriteria::where('id_edas', $id_edas)->get();

        return response()->json([
            'decisionmatrix' => $decisionmatrix,
            'criterias' => $criterias,
            'alternatives' => $alternatives,
            'subcriterias' => $subcriterias,
        ]);
    }
}
