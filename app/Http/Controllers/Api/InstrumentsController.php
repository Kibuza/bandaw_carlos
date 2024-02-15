<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstrumentsController extends Controller
{

    public function index()
    {

        $user = auth()->user();

        if ($user) {
            $instruments = Instrument::where('band_id', $user->id)->get();

            if ($instruments->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'instruments' => $instruments
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'instruments' => 'Instruments not found'
                ], 404);
            }

        } else {
            return response()->json([
                'status' => 401,
                'mensaje' => 'Usuario no autenticado'
            ], 401);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'family' => 'required|string',
            'type' => 'required|min:3',
            'brand' => 'required|min:2',
            'model' => 'required|min:3',
            'serial_number' => 'required|min:4',
            'acquisition_date' => 'required|date',
            'state' => 'required|min:3|max:50',
            'comment' => 'min:3|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ]);
        } else {

            $id_band = auth()->user()->id;

            $instrument = Instrument::create([
                'family' => $request->family,
                'type' => $request->type,
                'brand' => $request->brand,
                'model' => $request->model,
                'serial_number' => $request->serial_number,
                'acquisition_date' => $request->acquisition_date,
                'state' => $request->state,
                'comment' => $request->comment,
                'band_id' => $id_band,

            ]);
        }

        if ($instrument->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => "Instrument added to the database"
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something go wrong'
            ], 500);
        }
    }

    public function show($id)
    {
        $instruments = Instrument::find($id);

        if ($instruments) {
            return response()->json([
                'status' => 200,
                'message' => $instruments
            ], 200);
            //Esto hay que cambiarlo
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Instrument not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'family' => 'required|string',
            'type' => 'required|min:3',
            'brand' => 'required|min:2',
            'model' => 'required|min:3',
            'serial_number' => 'required|min:4',
            'acquisition_date' => 'required|date',
            'state' => 'required|min:3|max:50',
            'comment' => 'min:3|max:100',
        ]);



        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ]);
        } else {

            $instrument = Instrument::find($id);
            $id_band = auth()->user()->id;

            $instrument->family = $request->family;
            $instrument->type = $request->type;
            $instrument->brand = $request->brand;
            $instrument->model = $request->model;
            $instrument->serial_number = $request->serial_number;
            $instrument->acquisition_date = $request->acquisition_date;
            $instrument->state = $request->state;
            $instrument->comment = $request->comment;
            $instrument->band_id = $id_band;

            $instrument->save();
        }

        if ($instrument) {
            return response()->json([
                'status' => 200,
                'message' => "Instrument updated correctly"
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something go wrong'
            ], 500);
        }
    }

    public function destroy($id)
    {

        $instruments = Instrument::find($id);

        if ($instruments) {
            $instruments->delete();
            return response()->json([
                'status' => 200,
                'message' => "Instrument deleted",
            ], 200);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Instrument not found'
            ], 404);
        }
    }
}
