@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading" style="font-size:20px;"><strong>CHOOSE YOUR OPTION</strong></div>
                <div class="panel-body">
                   <a href="{{'/menu'}}"><img src="{{URL::asset('/img/express.png')}}" style="width:250px;float:left;padding-left:50px"/></a>
                   <a href="#"><img src="{{URL::asset('/img/planner.png')}}" style="width:250px;float:right;padding-right:50px"/></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection