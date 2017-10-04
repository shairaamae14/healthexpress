<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


	<title>Health Express</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
        <link href="{{asset('customer/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{asset('customer/assets/css/material-kit.css')}}" rel="stylesheet"/>

        <link href="{{asset('mbootstrap-wizard/assets/css/material-bootstrap-wizard.css')}}" rel="stylesheet" />
        
</head>

<body>
    @include('wiz-layouts.navbar')
    @yield('content')
</body>
    @yield('addtl_scripts')
</html>