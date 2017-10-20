<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Allergens;
use App\MedicalConditions;
use App\Preparation;
use App\UnitMeasurement;
use App\BestEaten;
use App\User;
use App\Dish;
use App\DishIngredient;
use App\IngredientList;
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

    public function matrix()
    {
        $user = Auth::user();
        $allergies = $user->allergies;
        $medcondition = $user->conditions;
  
        $dishes = Dish::all();
        $recommendation = array();
        $compare_first = array();
        
        $count = 0;

        if(!$allergies || !$medcondition) {
          for ($i=0; $i < count($dishes); $i++) {
            $nfacts = $dishes[$i]->nfacts;
                for ($k=0; $k < count($nfacts); $k++) { 
                    if($nfacts[$k]['calories'] <= $user['dcr']) {
                        $recommendation[$count] = $dishes[$i];
                        $count++;
                    }
                }
            }  
        }
        else {
            for ($j=0; $j < count($dishes); $j++) { 
                $ingredients = $dishes[$j]->ingredients;
                   
                    for ($h=0; $h < count($ingredients); $h++) { 
                    
                        $restrictions = collect([$medcondition[$j]->restrictions]);

                        $filter = $restrictions->filter(function ($value, $key) {
                            dd($value['id']);
                            
                        });
                        
                        dd($filter->all());
                // dd($ingredients[3]['Protein_g']);
                        // if( $ingredients[0]->Protein_g <= $restrictions['Protein_g']) {
                        //     $recommendation[$count] = $dishes[$j];

                        //     $count++;
                        // }
                        // else {
                        //    $count = 1 ;
                        // }
                        // dd($restrictions);
                        // $this->restrict($restrictions, $ingredients);
                        // dd($restrictions);

                    }
                 
            }
        }

        dd($ingredients);
        dd($count);


        dd($recommendation);
        //    if($calories <= $dcr) {
            
        
        // }
        // else{
        //     dd('wtf');
        // }
    
        
        
         // for ($i=0; $i < count($dishes); $i++) { 
         //        $facts = $list[18]->nfacts;
         //         dd($facts);
         //            for ($k=0; $k < count($ingredients) ; $k++) { 
         //               if($facts[$k]['Water_g'] <= 16) {
         //                    $recommendation[$i] = $dishes[$i];
         //                    $count++;
         //                }
         //            }
                
            
         // }
      
       // $sample = User::findOrFail(1);
       // $data = $sample->lifestyle;
       // dd($data);
  
            // dd($recommendation[3]['dish_name']);
        // dd(count($recommendation));
         
        // dd($another);
     
        // dd($dishes->besteaten);
       
        return view('admin.matrix', compact('user', 'recommendation', 'allergies', 'medcondition'));
    }

    public function restrict($restrictions, $ingredients) {
       
        $count = 0;
        $res = collect([$restrictions]);
        $ing = collect([$ingredients]);
        // $res = $res->each(function($item, $key) {
        //     $res->intersect
        // });
        // $intersect = $ing->intersectKey($res);
        // $res = $res->every(function($value, $key) {
        //     $data = $res->diffAssoc([$ing]);
        // });
       
        // $keyed = $res->mapWithKeys(function($item) {

        //     dd($item);
        // });
        // dd($count);
        // dd(count($restrictions));


        // $res = json_decode(json_encode($restrictions),true);
        
        // for ($i=0; $i < count($restrictions); $i++) { 
        //     dd($restrictions['id']);
        // }
        
        // dd($c);
        // foreach ($variable as $key) {
        //     dd($key)
        // }
        // for ($i=0; $i < count($restrictions); $i++) { 
        //     isset()
        // }

        
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

    public function recommendation() {

    }
}
