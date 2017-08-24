@extends('layouts.c_master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ingredients
       <!--  <small>it all starts here</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>
    <section class="content">
<form method="post" action="{{route('cook.ingredients.create',  ['id' => $dish->id])}}">
    {{csrf_field()}}
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Ingredients</h3>
          <div class="box-body">
        <div class="row">

      <div ng-app="angularjs-starter" ng-controller="MainCtrl">
           <fieldset  data-ng-repeat="choice in choices">
             
             <div class="form-group col-md-3">
              <label>Name:</label>
                <input type="text" ng-model="choice.name" class="form-control" name="ingname" placeholder="Ingredient Name">
            
              </div>
              <div class="form-group col-md-3">
              <label>Quantity:</label>
                <input type="text" ng-model="choice.quantity" class="form-control" name="quantity" placeholder="Quantity">
            </div>
            <div class="form-group col-md-2">
              <label>Unit:</label>
               <select class="form-control">
                 <option>Cup(s)</option>
                 <option>Tablespoon</option>
                 <option>Teaspoon</option>
                  <option>Kilogram(s)</option>
                   <option>Gram(s)</option>
                    <option>Ounce(s)</option>
                     <option>Pound(s)</option>
                      <option>Liter(s)</option>
                       <option>Pinch</option>
              </select>
               </div>
            <!--    <div class="col-md-2">
         <button type="submit" class="remove btn btn-block btn-success submit " ng-show="$last" ng-click="removeChoice()"><i class="fa fa-minus"></i> Remove</button> 
        </div> -->
              <button class="remove"  ng-click="removeChoice()">-</button>
            
           </fieldset>
          
            <div class="box-footer">
        <div class="col-md-2">
         <!-- <button type="submit" class="addfields btn btn-block btn-success submit " ng-click="addNewChoice()"><i class="fa fa-plus"></i></button>  -->
         <button class="addfields remove" ng-click="addNewChoice()" style="background-color:#30BB6D">+</button>
        </div>
        </div>
          <br>
            <div class="box-footer">
        <div class="col-md-2">
         <button type="submit" class="btn btn-block btn-success submit"><i class="fa fa-plus"></i> Add Ingredients</button> 
        </div>

               
           </div>
        </div>

</form>


    </section>
    </div>
@endsection