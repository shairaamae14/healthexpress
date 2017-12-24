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
use App\ToleranceValues;
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
   
        $allergies = User::join('user_allergens', 'user_allergens.user_id', 'users.id')
                        ->join('allergens', 'user_allergens.allergen_id', 'allergens.allergen_id')
                        ->where('id', $user->id)
                        ->first();
        // dd($allergies);
        if($allergies) {
        $tol_values = ToleranceValues::where('aid', $allergies->allergen_id)
                                ->where('level', $allergies->tolerance_level)
                                ->first();
        }   
        $medcondition = $user->conditions;

        $comparisons = array('protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium',
                            'sat_fat', 'cholesterol');

        $dishes = Dish::all();
        $recommendation = [];
        $separate = [];
        $compare_first = [];
        
        $count = 0;
        $ct = 0;
        $scount = 0;

        

    if(!$allergies && count($medcondition) == 0) {
        
          for ($i=0; $i < count($dishes); $i++) {
            $nfacts = $dishes[$i]->nfacts;
            for ($k=0; $k < count($nfacts); $k++) { 
                if($nfacts['calories'] <= $user['dcr']) {
                    $recommendation[$count] = $dishes[$i];
                }
            }
            $count++;
        }  
    }
    else if($allergies && count($medcondition) == 0) {
        
        for ($var=0; $var < count($dishes); $var++) { 
            $ingredients = $dishes[$j]->ingredients;
            for($ing = 0 ; $ing < count($ingredients); $ing++) {
                $res = $ingredients[$ing]->Shrt_Desc;
                if(preg_match('/'.$allergies['allergen_name'].'/i', $ingredients[$ing]->Shrt_Desc)) {
                     $protein = $tol_values['threshold_value'] /100;
                    if($tol_values['level'] == 'High') {
                        $recommendation[$ct] = $dishes[$var];
                    }
                    else if($tol_values['level'] == 'Medium') {
                        $proteinMin = $tol_values['min'] / 100;
                        $proteinMax = $tol_values['max'] / 100;
                        if($ingredients[$ing]->Protein_g <= $proteinMin || $ingredients[$ing]->Protein_g <= $proteinMax) {
                            $recommendation[$ct] = $dishes[$var];
                        }
                    }
                    else {
                        if($ingredients[$ing]->Protein_g < $protein) {
                            $recommendation[$ct] = $dishes[$var];
                        }
                    }
                }
                else {
                     $recommendation[$ct] = $dishes[$var];
                }
            }
        $ct++;

        }
    }
    else if(!$allergies && count($medcondition) != 0) {
     
        for ($ind=0; $ind < count($dishes); $ind++) { 
            $nfacts = $dishes[$ind]->nfacts;
            for ($l=0; $l < count($medcondition); $l++) {
                    $restrictions = $medcondition[$l]->restrictions;
                    for ($index=0; $index < count($restrictions); $index++) { 
                       for ($x=0; $x < count($comparisons); $x++) { 
                            if($nfacts[$comparisons[$x]] <= $restrictions[$index][$comparisons[$x]]) {
                                    $recommendation[$ct] = $dishes[$ind];

                            }   
                       }
                   }
               }
           $ct++;
        }
    }
    else if($allergies && count($medcondition) != 0){
        
        for ($j=0; $j < count($dishes); $j++) { 
            $nfacts = $dishes[$j]->nfacts;
            $ingredients = $dishes[$j]->ingredients;
             for($ing = 0 ; $ing < count($ingredients); $ing++) {
                for ($l=0; $l < count($medcondition); $l++) {
                    $restrictions = $medcondition[$l]->restrictions;
                    for ($index=0; $index < count($restrictions); $index++) { 
                       for ($x=0; $x < count($comparisons); $x++) { 

                        $protein = $tol_values['threshold_value'] /100;
                            
                            if(preg_match('/'.$allergies['allergen_name'].'/i', $ingredients[$ing]->Shrt_Desc)) {

                                 // dd($ingredients[1]->Shrt_Desc);
                                
                                if($tol_values['level'] == 'High') {

                                    if($nfacts[$comparisons[$x]] <= $restrictions[$index][$comparisons[$x]]) {
                                        $recommendation[$ct] = $dishes[$j];
                                    }
                                }
                                else if($tol_values['level'] == 'Medium') {

                                    $proteinMin = $tol_values['min'] / 100;
                                    $proteinMax = $tol_values['max'] / 100;
                                    if($ingredients[$ing]->Protein_g <= $proteinMin || $ingredients[$ing]->Protein_g <= $proteinMax) {
                                        $recommendation[$ct] = $dishes[$var];
                                    }
                                }
                                
                                else if($tol_values['level'] == 'Low'){
                                    // dd($ingredients[$ing]->Shrt_Desc);
                                    if($ingredients[$ing]->Protein_g < $protein && $nfacts[$comparisons[$x]] <= $restrictions[$index][$comparisons[$x]]) {

                                        $recommendation[$ct] = $dishes[$j];
                                    }
                                    // else {
                                    //     if($nfacts[$comparisons[$x]] <= $restrictions[$index][$comparisons[$x]]) {
                                    //         $recommendation[$ct] = $dishes[$j];
                                    //     }
                                    // }
                                }
                                }
                                else {
                                    if($nfacts[$comparisons[$x]] <= $restrictions[$index][$comparisons[$x]]) {
                                            $recommendation[$ct] = $dishes[$j];
                                    }  
                                }
                               

                            }
                         
                       }
                        
                    }
                }
                $ct++; 
            }
            
            

        }
    
    // dd($recommendation);
    // dd(count($recommendation));


  

    return view('admin.matrix', compact('user', 'recommendation', 'allergies', 'medcondition'));
}

public function allergyRestrict($allergies, $nfacts, $user) {
    $allergies = User::join('user_allergens', 'user_allergens.user_id', 'users.id')
                    ->where('id', $user->id)
                    ->get();
    $tol_values = ToleranceValues::where('aid', $user->allergen_id)
                                ->where('level', $user->tolerance_level)
                                ->first();
    for ($nf=0; $nf < count($nfacts); $nf++) { 

            $protein = $nfacts['protein'] * 100;
            if($tol_values['level'] == 'Low') {
                  if($protein < $tol_values['threshold_value']) {

                  }
            }
            else if($tol_values['level'] == 'Medium') {
                if($protein >= $tol_values['min'] || $protein <= $tol_values) {

                }
            }
            else {
                if($protein < $tol_values['threshold_value'] ) {

                }
            }
            
            // dd($protein);
           

    }
    
}
public function restrict($restrictions, $ingredients) {

    $result = array();
    $count = 0;
    $res = collect([$restrictions]);
    $ing = collect([$ingredients]);
   
    // for ($i=0; $i < count($restrictions); $i++) { 
    //     if($restrictions[$i]['Energ_Kcal'] != 0) {
    //         $result[$count] = 'Energ_Kcal';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Protein_g'] != 0) {
    //         $result[$count] = 'Protein_g';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Carbohydrt_g'] != 0) {
    //         $result[$count] = 'Carbohydrt_g';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Fiber_TD_g'] != 0) {
    //         $result[$count] = 'Fiber_TD_g';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Calcium_mg'] != 0) {
    //         $result[$count] = 'Calcium_mg';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Sodium_mg'] != 0) {
    //         $result[$count] = 'Sodium_mg';
    //         $count++;
    //     }
    //     if($restrictions[$i]['Cholestrl_mg'] != 0) {
    //         $result[$count] = 'Cholestrl_mg';
    //         $count++;
    //     }
    // }
    dd($result);
    // $matrix = $restrictions->crossJoin($ingredients);
    // dd($matrix->all());
    // $res = json_decode(json_encode($restrictions),true);
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

public function storeTolerance(Request $request) 
{
    $preparation = ToleranceValues::create(['aid' => $request['allergen'],'level' => $request['level'], 'threshold_value' => $request['value'], 'min'=> $request['min'], 'max' => $request['min']]);

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
 $dishes = \App\Dish::all()->load('nfacts');
    $user = \App\User::find(23)->load('conditions.restrictions','allergies.tol_values');
    $ctr=0;
    $count = 0;
    $recommended_dish = array();
    for ($i=0; $i < count($dishes); $i++) { 
        
            foreach ($user->allergies as $allergy) {
                $ingredients = $dishes[$i]->ingredients()->where('ingredient_list.Shrt_Desc', 'NOT LIKE', '%'.$allergy->allergen_name.'%')->get();
                
                    for ($x=0; $x < count($ingredients); $x++) { 
                        $protein = $allergy->tol_values->threshold_value /100;
                        // dd($protein);
                        switch ($allergy->tol_values->level) {
                        case 'High':
                            break;
                        case 'Medium':
                            $proteinMin = $allergy->min / 100;
                            $proteinMax = $allergy->max / 100;
                            if($ingredients[$x]->Protein_g > $proteinMin || $ingredients->Protein_g > $proteinMax) {
                                $ctr++;
                                $recommended_dish[$i] = $dishes[$i];
                            }

                            break;
                        case 'Low':
                            if($ingredients[$x]->Protein_g < $protein) {
                                $ctr++;
                                $recommended_dish[$i] = $dishes[$i];
                                // dd($recommended_dish);
                                // dd($dishes[$i]);
                            }
                            break;
                        
                        default:
                            # code...
                            break;
                        }
                    }
                    
                }
         
        }
}

public function  unitTest(){
   $dishes = \App\Dish::all()->load('nfacts');
   // dd(\App\Dish::with('ingredients')->get());

    $user = \App\User::find(23)->load('conditions.restrictions','allergies.tol_values');
      $comparisons = ['calories', 'protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium','sat_fat', 'cholesterol'];
    $ctr=0;
    $count = 0;
    $recommended_dish = collect();
            foreach ($user->allergies as $allergy) {
                $list = \App\Dish::whereHas('ingredients', function($query) use($allergy){
                     $protein = $allergy->tol_values->threshold_value /100;
                    switch ($allergy->tol_values->level) {
                        case 'High':
                            break;
                        case 'Medium':
                            $proteinMin = $allergy->min / 100;
                            $proteinMax = $allergy->max / 100;
                            $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')
                            ->where('Protein_g', '<', $proteinMin)->orWhere('Protein_g', '<=', $proteinMax);
                            break;
                        case 'Low':
                        // dd($protein);
                           $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%')->where('Protein_g', '<', $protein);
                   
                            break;
                        
                        default:
                            # code...
                            break;
                        }

               })->get();
                $list2 = \App\Dish::whereDoesntHave('ingredients', function($query) use($allergy){
                    $query->where('Shrt_Desc', 'LIKE', '%'.$allergy->allergen_name.'%');
               })->get();
            }


            if(count($list) !=0 && count($list2) !=0) {
                $first = $list->load('nfacts');
                $second = $list2->load('nfacts');
                for ($i=0; $i < count($first); $i++) { 
                   for ($x=0; $x < count($second); $x++) { 
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ($condition->restrictions[0][$comparison] < $first[$i]->nfacts[$comparison] && $condition->restrictions[0][$comparison] < $second[$x]->nfacts[$comparison]) {
                            
                                    $recommended_dish = $first[$i];
                                    $recommended_dish = $second[$x];
                                }
                            }
                        }
                   }
               }


            }
            else if(count($list) !=0 && count($list2) == 0) {
                $first = $list->load('nfacts');
                  for ($i=0; $i < count($first); $i++) {  
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ($condition->restrictions[0][$comparison] < $first[$i]->nfacts[$comparison]) {
                            
                                    $recommended_dish = $first[$i];
                                }
                            }
                        }
               }
            }
            else if(count($list2) !=0 && count($list) == 0) {
                $second = $list2->load('nfacts');
                   for ($x=0; $x < count($second); $x++) { 
                        foreach ($user->conditions as $condition) { 
                            foreach ($comparisons as $comparison) {
                                if ( $condition->restrictions[0][$comparison] < $second[$x]->nfacts[$comparison]) {
                                    $recommended_dish = $second[$x];
                                }
                            }
                        }
                   }     
            }
              
            
               
               
               dd($recommended_dish);
}
public function test2() {
    $dishes = \App\Dish::all()->load('nfacts');
    $user = \App\User::find(23)->load('conditions.restrictions','allergies.tol_values');
    $comparisons = ['calories', 'protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium','sat_fat', 'cholesterol'];

    // dd($user);
    for ($i=0; $i < count($dishes); $i++) {
    foreach ($user->conditions as $condition) { 
        foreach ($comparisons as $comparison) {
            if ($condition->restrictions[0][$comparison] < $dishes[$i]->nfacts[$comparison]) {
                $ctr ++;
                $recommended_dish = $dishes[$i];
            }
        }
    }
    }
    
}

public function test()
{
    $dishes = \App\Dish::all()->load('nfacts');
    $user = \App\User::find(23)->load('conditions.restrictions','allergies.tol_values');
    $comparisons = ['protein', 'total_fat', 'carbohydrate', 'fibre', 'sodium',
                            'sat_fat', 'cholesterol'];
    $ctr=0;
    $_ctr=0;
    $recommended_dish = collect();
    $separated_dish = collect();
    for ($i=0; $i < count($dishes); $i++) {
        if (!$ctr) { 
            foreach ($user->conditions as $condition) { 
                foreach ($comparisons as $comparison) {
                    if ($condition->restrictions[0][$comparison] < $dishes[$i]->nfacts[$comparison]) {
                        $ctr ++;
                        $recommended_dish = $dishes[$i];
                    }
                }
            }
           
        }else{
            $separated_dish = $dishes[$i];
            // break;
        }
    

    if (!$_ctr) {

        

            if (!$_ctr) {
                foreach ($user->allergies as $allergy) { 
                    $ingredients = $dishes[$i]->ingredients()->where('ingredient_list.Shrt_Desc', 'NOT LIKE', '%'.$allergy->allergen_name.'%')->get();
                    for ($x=0; $x < count($ingredients); $x++) { 
                        $protein = $allergy->tol_values->threshold_value /100;
                        // dd($protein);
                        switch ($allergy->tol_values->level) {
                        case 'High':
                            break;
                        case 'Medium':
                            $proteinMin = $allergy->min / 100;
                            $proteinMax = $allergy->max / 100;
                            if($ingredients[$x]->Protein_g > $proteinMin || $ingredients->Protein_g > $proteinMax) {
                                $_ctr++;
                                $recommended_dish = $dishes[$i];
                            }

                            break;
                        case 'Low':
                            if($ingredients[$x]->Protein_g > $protein) {
                                $_ctr++;
                                $recommended_dish = $dishes[$i];
                                // dd($recommended_dish);
                            }
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    }
                    
                }
            }else{
                $separated_dish = $dishes[$i];
                // break;
            }
        
    }else{
        $separated_dish = $dishes[$i];
        $ctr++;
    }
    }
    if ($ctr == 0 && $_ctr == 0) {
        echo 'biya daot';
        // do something 
        $ctr == 0;
        $_ctr == 0;
        dd($separated_dish);
    }
    else
    {
        dd($recommended_dish);
    }
}
}
