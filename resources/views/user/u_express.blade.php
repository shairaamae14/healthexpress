@extends('layouts.u_shop')

@section('content')
<!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Health Express</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="row">
               
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                    <h4><a href="{{ url('dish/'.$dishes[0]['$id']) }}">
                    {{$dishes[0]['dish_name']}}</a>
                                </h4>
                                <h4 class="pull-right">Php {{$dishes[0]['dish_price']}}</h4>
                                <p>{{$dishes[0]['dish_desc']}}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">15 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption">
                                <h4><a href="/dish/{{$dishes[1]['dish_id']}}">{{$dishes[1]['dish_name']}}</a>
                                </h4>
                                <h4 class="pull-right">Php {{$dishes[1]['dish_price']}}</h4>
                                <p>{{$dishes[1]['dish_desc']}}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">12 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="http://placehold.it/320x150" alt="">
                            <div class="caption"> 
                                <h4><a href="./dish/{{$dishes[2]['dish_id']}}">{{$dishes[2]['dish_name']}}</a>
                                </h4>
                                <h4 class="pull-right">Php {{$dishes[2]['dish_price']}}</h4>
                                <p>{{$dishes[2]['dish_desc']}}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">31 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="ordermode" value="express_meal">

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->


<!-- 	{{$dishes[0]['dish_name']}}
	{{$dishes[0]['dish_price']}}
	{{$dishes[0]['dish_desc']}} -->
	

	

    
@endsection