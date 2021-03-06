@extends('layouts.master')
<style>
    .steps:hover{
        font-size: 30px !important;
        color:#30bb6d !important;
    }

</style>
@section('content')

<div class="wrapper">
    <div class="header header-filter" style="background-image: url('{{asset('img/bgindextry.png')}}');">
        <div class="container" id="about">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="title lbl">Give yourself a healthy break!</h1>

                    <br />
                    <a href="./login" class="btn btn-danger btn-raised btn-lg" style="background-color: #30bb6d">
                        Order Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center section-landing" id="works">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="title" >About</h2>
                        <h5 class="description">Health Express lets you choose your favorite meals may it be
                        through Express or Planned. It also helps you decide in choosing healthier food choices
                        to match your goals!</h5>
                    </div>
                </div>

                <div class="features">
                    <div class="row">
                        <h2 class="title" >4 Easy steps</h2>
                        <div class="col-md-3">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="fa fa-4x fa-plus-square text-success sr-icons"></i>
                                </div>
                                <h4 class="info-title steps">Create Account</h4>
                                <p>Sign up to get a glimpse and try our application!</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="fa fa-4x fa-mouse-pointer text-success sr-icons"></i>
                                </div>
                                <h4 class="info-title steps">Choose an option</h4>
                                <p>We cater two options - Express Meals and Planned Meals. Express Meals are for
                                one-time orders while on Planned Meals, you can plan out your meal for the how many days, week, or a month.</p>
                                                               </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="fa fa-4x  fa-shopping-cart text-success sr-icons"></i>
                                </div>
                                <h4 class="info-title steps">Choose meal and pay</h4>
                                <p>Choose your desired meal then pay.</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="info">
                                <div class="icon icon-success">
                                    <i class="fa fa-4x fa-heart text-success sr-icons"></i>
                                </div>
                                <h4 class="info-title steps">Happy Eating</h4>
                                <p>Enjoy and savor your sumptuous meals!</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="section landing-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center title">Contact us</h2>
                        <h4 class="text-center description">Further inquiries? Don't hesitate to reach us!</h4>
                        <form class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Name</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Your Email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">Your Messge</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 text-center">
                                    <button class="btn btn-primary btn-raised">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @endsection

    @section('scripts')
    <!--   Core JS Files   -->
      <script src="{{asset('customer/assets/js/jquery.min.js')}}" type="text/javascript"></script>
      <!-- <script src="{{asset('customer/assets/js/bootstrap.min.js')}}" type="text/javascript"></script> -->
      <script src="{{asset('customer/assets/js/material.min.js')}}"></script>

      <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
      <script src="{{asset('customer/assets/js/material-kit.js')}}" type="text/javascript"></script>
       <script type="text/javascript">
        window_width = $(window).width();

        if (window_width >= 992){
            big_image = $('.wrapper > .header');

            $(window).on('scroll', materialKitDemo.checkScrollForParallax);
        }
    </script>
    @endsection