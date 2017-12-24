<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />


  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Health Express</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

  <!-- CSS Files -->
    <link href="{{asset('customer/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('customer/assets/css/material-kit.css')}}"" rel="stylesheet"/>

</head>
<style>
#brndhvr:hover{
text-decoration: none !important;
font-size: 30px !important;
}

</style>
<body class="landing-page">

        @include ('layouts.nav')

        @yield('content')

     
<footer class="footer">
</footer>      

</body>
  @yield('scripts')
  @include('layouts.footer')
</html>
