<?php

namespace App\Http\Controllers;

use App\Models\Edas;
use App\Http\Requests\UpdateEdasRequest;
use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EdasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('edas');
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
            'name' => 'required|string|max:50',
            'id_user' => 'required|integer|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $serv = Edas::create($validator->validated());
            return response()->json([
                'status' => true,
                'message' => ($serv) ? 'EDAS added successfully' : "Failed"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Edas $edas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_edas)
    {
        $edas = Edas::where('id', '=', $id_edas)->first();
        if ($edas) {
            return response()->json([
                'status' => true,
                'edas' => $edas
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'EDAS not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_edas)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'id_user' => 'required|integer|exists:users,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->messages()
            ]);
        } else {
            $edas = Edas::where('id', '=', $id_edas)->first();
            if ($edas) {
                $edas->update($validator->validated());
                return response()->json([
                    'status' => true,
                    'message' => 'Data updated successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => 'EDAS not Found'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_edas)
    {
        $edas = Edas::where('id', '=', $id_edas)->first();
        if ($edas) {
            $edas->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data removed successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => 'EDAS not Found'
            ]);
        }
    }

    public function fetchData()
    {
        $edas = Edas::where('id_user', '=', Auth::user()->id)->get();
        $edas_count = count($edas);
        if ($edas_count > 0) {
            $criterias_count = count(Criteria::where('id_edas', '=', $edas->first()->id)->get());
            $alternatives_count = count(Alternative::where('id_edas', '=', $edas->first()->id)->get());
        } else {
            $criterias_count = 0;
            $alternatives_count = 0;
        }

        return response()->json([
            'edas_count' => $edas_count,
            'criterias_count' => $criterias_count,
            'alternatives_count' => $alternatives_count,
        ]);
    }


    public function fetchEdas()
    {
        $edas = Edas::where('id_user', '=', Auth::user()->id)->get()->loadCount(['criterias', 'alternatives']);

        return response()->json([
            'edas' => $edas,
            'edas_count' => count($edas),
        ]);
    }
}
