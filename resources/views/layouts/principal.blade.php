<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

	<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">



    <link rel="stylesheet" href="css/styles.css">

	

    <link rel="icon" type="image/png" href="img/semilla_ico.png" />





    

    

</head>



<body>

	

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">

		    <span class="navbar-toggler-icon"></span>

		  </button>

		  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">

		    <a class="navbar-brand" href="#">Hidden brand</a>

		    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

		      <li class="nav-item active">

		        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>

		      </li>

		      <li class="nav-item">

		        <a class="nav-link" href="#">Link</a>

		      </li>

		      <li class="nav-item">

		        <a class="nav-link disabled" href="#">Disabled</a>

		      </li>

		    </ul>

		    

		      <a href="{{ route('login') }}" ><span class="glyphicon glyphicon-user"></span><button type="button" class="btn btn-raised btn-warning "><i class="fa fa-user fa-2x" title="Login"> </i>Login</button></a>

		    

		  </div>

	</nav>

             



	<div class="container-fluid">



  
	    @include('../alerts.success')
        @include('../alerts.request')
   

		@yield('content')

		

	</div>









   



@include('layouts.footer')

            







                                    

    <!-- /Start your project here-->



    <!-- SCRIPTS -->

    <!-- JQuery -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>

	<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>

	<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

     

    





</body>



</html>



