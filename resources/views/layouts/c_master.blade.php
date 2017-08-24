<!DOCTYPE html>
<html>
<html ng-app="shanidkvApp">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Health Express</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/wizard.css')}}">

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<script src="https://api.data.gov/nrel/alt-fuel-stations/v1/nearest.json?api_key=rxdzWPm1ebJJDlpUfpmC7B9bQtRSWA8AJ3OQrnox&location=Denver+CO"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
<style>
  h1{
    color:#30BB6D;
  }

  </style>
<script type="text/javascript">

    function changeImage1() {
document.getElementById('pickup').src="{{asset('/img/take-away.svg')}}";  
document.getElementById('cooking').src="{{asset('img/cooking.svg')}}";
}

    function changeImage2() {

 document.getElementById('cooking').src="{{asset('/img/readycook.svg')}}";
 document.getElementById('pickup').src="{{asset('img/tk.svg')}}";
}

function btnCook(){
document.getElementById('header').style.backgroundColor="#DC3131";
document.getElementById('stats').innerText="Cooking";
}


function btnDel(){
  document.getElementById('header').style.backgroundColor="#31A0DC";
  document.getElementById('stats').innerText="Delivering";
}

function btnDone(){
  document.getElementById('header').style.backgroundColor="#30BB6D";
  document.getElementById('stats').innerText="Order Done";
}

/* ------------------------------------------------------- 

* Filename:     AngularJS Dynamic Form Fields
* Website:      http://www.shanidkv.com
* Description:  Shanidkv AngularJS blog
* Author:       Shanid KV shanidkannur@gmail.com

---------------------------------------------------------*/

var app = angular.module('shanidkvApp', []);

  app.controller('MainCtrl', function($scope) {

  $scope.choices = [{id: 'choice1'}, {id: 'choice2'}];
  
  $scope.addNewChoice = function() {
    var newItemNo = $scope.choices.length+1;
    $scope.choices.push({'id':'choice'+newItemNo});
  };
    
  $scope.removeChoice = function() {
    var lastItem = $scope.choices.length-1;
    $scope.choices.splice(lastItem);
  };
  
});







</script>


</head>
<body class="sidebar-mini skin-green-light fixed sidebar-collapse">
<div class="wrapper">


  @include('layouts.c_header')
  @include('layouts.sidebar')
  @yield('content')

  @include('layouts.c_footer')
</div>
<!-- ./wrapper -->  





</body>





</html>
