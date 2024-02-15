<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __invoke()
    {
        $id = auth()->user()->id;
        $instruments = Instrument::where('band_id', $id)->get();
        // dd($instruments);
        return view('home', compact('instruments')); //Aquí recojo la lista entera de instrumentos y se la paso a la vista con el nombre instrumentos
    }

    function add_view()
    {
        return view('add');
    }

    function add_instrument(Request $request)
    {

        $this->validate($request, [
            'instrumentFamilies' => 'required|min:5|max:50',
            'type' => 'required|min:3|max:30',
            'brand' => 'required|min:3|max:30',
            'model' => 'required|min:9|max:20',
            'serial_number' => 'required|min:3|max:15',
            'acquisition_date' => 'required',
            'state' => 'required|min:3|max:50',
            'comment' => 'min:3|max:100',
        ]);

        $band_id = auth()->user()->id;
        ;

        $file = $request->file('image');
        $destinationPath = "uploads/instruments";

        if ($file) {
            $file_name = $file->getClientOriginalName();
            if ($file->move($destinationPath, $file_name)) {
                echo "Update success";
            } else {
                echo "Update failed";
            }
        } else {
            $file_name = "default_img.jpg";
            echo "No file uploaded.";
        }

        $file_name = "uploads/instruments/" . $file_name;
        $instrument = Instrument::create([
            'band_id' => $band_id,
            'family' => $request->instrumentFamilies,
            'type' => $request->type,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'acquisition_date' => $request->acquisition_date,
            'state' => $request->state,
            'comment' => $request->comment,
            'image' => $file_name,
        ]);

        $instrument->save();

        return redirect()->route('home');
    }

    function filter(Request $request)
    {
        //dd($request);
        $instruments = json_decode($request->input('instruments'), true);

        $family = $request->input('instrumentFamilies');
        $type = $request->input('type');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $serial = $request->input('serial');

        // Filtra el array de instrumentos
        $filteredInstruments = array_filter($instruments, function ($instrument) use ($brand, $type, $model, $family, $serial) {
            // Verifica cada condición solo si el campo correspondiente no está vacío
            $familyCondition = empty($family) || str_contains(strtolower($instrument['family']), strtolower($family));
            $typeCondition = empty($type) || strtolower($instrument['type']) === strtolower($type);
            $brandCondition = empty($brand) || str_contains(strtolower($instrument['brand']), strtolower($brand));
            $modelCondition = empty($model) || str_contains(strtolower($instrument['model']), strtolower($model));
            $serialCondition = empty($serial) || str_contains(strtolower($instrument['serial_number']), strtolower($serial));

            return $brandCondition && $typeCondition && $modelCondition && $familyCondition && $serialCondition;
        });

        // Explicación: se itera el array de instrumentos instrumento a instrumento, y cada instrumento campo a campo, usando array_filter.
        // Queremos comparar los valores del formulario con los valores del array de instrumentos.
        // Si el campo recogido por el formulario está vacío, no es un condicionante para el filtro, por lo tanto, se verifica la condición, ese campo no se compara.
        // En el caso de que sí que haya un valor en el formulario, se compara el valor del instrumento con el del formulario.
        // Esto se va a realizar campo por campo, y si todos cumplen la condición (true), este elemento se añade al array.
        // Los instrumentos que no cumplan alguna de las condiciones, no se añaden al array.

        return view('home', ['instruments' => $filteredInstruments, 'old_brand' => $brand, 'old_family' => $family, 'old_model' => $model, 'old_type' => $type, 'old_serial' => $serial]);
    }
}
