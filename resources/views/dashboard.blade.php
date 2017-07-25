@extends('layouts.master')

@section('content')



<section class="bg-primary" style="background-color:#30BB6D;height:500px">
<div class="container">
    <h2>List of Orders</h2>
    <hr class="primary" style="border-color:#30BB6D">
</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 text-center">
                <div class="service-box">
                    <img src="img/pestochickenandveggie.jpg" style="height:120px">
                <h3>Pesto Chicken and Veggie</h3>
                <p class="text-muted">Lorem ipsum dolor sit amet, eos et alia nostro argumentum.</p>
                </div>
            </div>
    <div class="col-lg-3 col-md-3 text-center">
        <div class="service-box">
            <i class="fa fa-4x fa-paper-plane text-primary sr-icons"></i>
            <h3>Choose an option</h3>
            <p class="text-muted">Lorem ipsum dolor sit amet, eos et alia nostro argumentum.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 text-center">
        <div class="service-box">
            <i class="fa fa-4x fa-newspaper-o text-primary sr-icons"></i>
            <h3>Choose food and pay</h3>
            <p class="text-muted">Lorem ipsum dolor sit amet, eos et alia nostro argumentum.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 text-center">
        <div class="service-box">
            <i class="fa fa-4x fa-heart text-primary sr-icons"></i>
            <h3>Happy Eating</h3>
            <p class="text-muted">Lorem ipsum dolor sit amet, eos et alia nostro argumentum.</p>
        </div>
    </div>
   
    </div>

</div>

</section>
    <script src="/css/orders.css"></script>
    

@endsection