<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allergens;
use App\MedicalConditions;
use App\Preparation;
use App\UnitMeasurement;
use App\BestEaten;

class AdminController extends Controller
{
    
    public function index()
    {
        $allergens = Allergens::all();
        $medcons = MedicalConditions::all();
        $preparation = Preparation::all();
        $measurements = UnitMeasurement::all();
        $besteaten = BestEaten::all();

        return view('admin.dashboard', compact('allergens', 'medcons', 'preparation', 'measurements','besteaten'));
    }


    public function createAllergens()
    {
        
    }


    public function storeAllergens(Request $request)
    {
        $allergens = Allergens::create(['allergen_name' => $request['aname'], 'status' => 1]);

        return redirect()->back();
    }

    public function storeMedCon(Request $request)
    {
        $allergens = MedicalConditions::create(['medcon_name' => $request['mname'],'status' => 1]);

        return redirect()->back();
    }

    public function storePreparation(Request $request) 
    {
        $preparation = Preparation::create(['p_name' => $request['pname'], 'status' => 1]);

        return redirect()->back();
    }

    public function storeMeasurement(Request $request) 
    {
        $preparation = UnitMeasurement::create(['um_name' => $request['umname'], 'status' => 1]);

        return redirect()->back();
    }

    public function storeBestEaten(Request $request) 
    {
        $preparation = BestEaten::create(['name' => $request['bename'], 'start_time' => $request['start'], 'end_time'=> $request['end'], 'status' => 1]);

        return redirect()->back();
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

  
    public function updateAllergens(Request $request, $id)
    {
        $allergens = Allergens::where('allergen_id', $id)->update(['allergen_name' => $request['aname']]);

        return redirect()->back();
    }

    public function updateMedCon(Request $request, $id)
    {
        $medcon = MedicalConditions::where('medcon_id', $id)->update(['medcon_name' => $request['mname']]);

        return redirect()->back();
    }

    public function updatePreparation(Request $request, $id)
    {
        $medcon = MedicalConditions::where('p_id', $id)->update(['p_name' => $request['pname']]);

        return redirect()->back();
    }

    public function updateMeasurement(Request $request, $id)
    {
        $medcon = MedicalConditions::where('um_id', $id)->update(['um_name' => $request['umname']]);

        return redirect()->back();
    }
    public function updateBestEaten(Request $request, $id)
    {
        $medcon = MedicalConditions::where('be_id', $id)->update(['name' => $request['bename']]);

        return redirect()->back();
    }

    public function deleteAllergen(Request $request)
    {
        $allergen = Allergen::where('allergen_id', $request['id'])->delete();

        return redirect()->back();
    }

    public function deleteMedCon(Request $request)
    {
        $medcon = MedicalConditions::where('medcon_id', $request['id'])->delete();

        return redirect()->back();
    }

    public function deletePreparation(Request $request)
    {
        $medcon = Preparation::where('p_id', $request['id'])->delete();

        return redirect()->back();
    }

    public function deleteMeasurement(Request $request)
    {
        $medcon = UnitMeasurement::where('um_id', $request['id'])->delete();

        return redirect()->back();
    }

    public function deleteBestEaten($id)
    {
        $medcon = BestEaten::where('be_id', $id)->delete();

        return redirect()->back();
    }
}
