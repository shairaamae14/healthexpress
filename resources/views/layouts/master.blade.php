<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Health Express</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />  
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->

  <!-- CSS Files -->
    <link href="{{asset('customer/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('customer/assets/css/material-kit.css')}}" rel="stylesheet"/>
    <link href="{{asset('customer/assets/css/demo.css')}}" rel="stylesheet" />
       <link href="{{asset('css/card.css')}}" rel="stylesheet" />


    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
</head>

<body class="landing-page">

        @include ('layouts.nav')
      <div class="main main-raised">
            <div class="container">
                <div class="section text-center section-landing">
        @yield('content')

        </div>
        </div>
        </div>

        @include('layouts.footer')

</body>

</html>
