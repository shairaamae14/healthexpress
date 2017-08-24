<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Health Express</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{{asset('wizard/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('wizard/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('wizard/css/form-elements.css')}}">
        <link rel="stylesheet" href="{{asset('wizard/css/style.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
     
<style>
#linkss li a:hover{
    color:#30BB6D;
}

</style>
    </head>

    <body style="background-image:url('{{asset('img/bgsignin.jpg')}}')">
 
        @include('wiz-layouts.navbar')

     
        @yield('content')

        @yield('addtl_scripts')
       

        @include('wiz-layouts.footer')

    </body>

</html>