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
  <link rel="icon" type="image/png" href="{{asset('img/favicon-16x16.png')}}" sizes="16x16" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />  
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"> -->

  <!-- CSS Files -->
    <link href="{{asset('customer/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('customer/assets/css/material-kit.css')}}" rel="stylesheet"/>
    <link href="{{asset('customer/assets/css/demo.css')}}" rel="stylesheet" />
       <link href="{{asset('css/card.css')}}" rel="stylesheet" />
       <link rel="stylesheet" type="text/css" href="{{asset('css/pace-theme-minimal.css')}}">


    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

  <style>
    pre.prettyprint{
        background-color: #eee;
        border: 0px;
        margin-bottom: 60px;
        margin-top: 30px;
        padding: 20px;
        text-align: left;
    }
    .atv, .str{
        color: #05AE0E;
    }
    .tag, .pln, .kwd{
        color: #3472F7;
    }
    .atn{
        color: #2C93FF;
    }
    .pln{
        color: #333;
    }
    .com{
        color: #999;
    }
    .space-top{
        margin-top: 50px;
    }
    .btn-primary .caret{
        border-top-color: #3472F7;
        color: #3472F7;
    }
    .area-line{
        border: 1px solid #999;
        border-left: 0;
        border-right: 0;
        color: #666;
        display: block;
        margin-top: 20px;
        padding: 8px 0;
        text-align: center;
    }
    .area-line a{
        color: #666;
    }
    .container-fluid{
        padding-right: 15px;
        padding-left: 15px;
    }
    .table-shopping .td-name{
      min-width: 130px;
    }
  </style>
  
</head>

<body class="components-page">


    @include('user-layouts.nav')

    @yield('content')
</body>

  @yield('addtl_scripts')

</html>
