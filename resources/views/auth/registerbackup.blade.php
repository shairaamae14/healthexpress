@extends('layouts.master')

@section('content')
<div class="container" style="margin-top:120px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label" style="color:black">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label" style="color:black">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label" style="color:black">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label" style="color:black">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact-no" class="col-md-4 control-label" style="color:black">Contact no:</label>

                            <div class="col-md-6">
                                <input id="contact-no" type="text" class="form-control" name="contact_no" required>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label" style="color:black">Provide Personal Information:</label>
                        <br>
                      
                        <div class="col-md-2">
                          <label style="color:black">Weight</label> <input id="weight" type="number" class="form-control" name="weight" required><label class="col-md-4 control-label" style="color:black">kg</label>
                        </div>
                        <div class="col-md-2">
                          <label style="color:black">Height</label> <input id="height" type="number" class="form-control" name="height" required><label class="col-md-4 control-label" style="color:black">cm</label>
                        </div>
                        <div class="col-md-2">
                        <label style="color:black">Age</label> <input id="age" type="number" class="form-control" name="age" required>
                        </div>
                        </div>
                           <div class="form-group">
                            <label class="col-md-4 control-label" style="color:black" >Location</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="location" placeholder="City" required>
                            </div>
                        </div>

                        <div class="form-group">
                         <label class="col-md-4 control-label" style="color:black">Health Goal</label>

                         <select class="col-md-4 control-label" name="goal" style="color:black">
                            <option value="Lose Weight">Lose Weight</option>
                            <option value="Maintain Weight">Maintain Weight</option>
                            <option value="Gain Weight">Gain Weight</option>
                         </select>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label" style="color:black">Allergens</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="allergen" required>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label" style="color:black">Medical Condition</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="med_condition" required>
                            </div>
                        </div>
                          <div class="form-group">
                         <label class="col-md-4 control-label" style="color:black">Lifestyle/Activeness</label>

                         <select class="col-md-4 control-label" name="lifestyle" style="color:black">
                            <option value="Sedentary Lifestyle">Sedentary Lifestyle</option>
                            <option value="Active">Active</option>
                            <option value="Extremely Active">Extremely Active</option>
                         </select>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="background-color:#30BB6D">
                                    Register
                                </button>
                            </div>
                        </div>
                        <a href="{{route('cook.register')}}">Register as Cook</a>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection