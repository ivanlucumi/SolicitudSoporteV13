<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  

  <title>@yield('title')</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style>
 .{
     font-family: Arial, Helvetica, sans-serif;
 }
  .active{
    background-color:#BEBCBC;
  }

  .bg-danger {
    background-color: #d51b23!important;
  }

  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid black;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }

  h2 { 
    display: block;
    font-size: 1.5em;
    margin-top: 0.83em;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
  }

  span.derecha{
    display: block;
    float: right
  }

  span.izquierda{
    display: block;
    float: left
  }
 </style>
   
</head>
<body>
  
  <!--<div  style="background-color: #f2dede !important;">-->
  <div style="margin: 20px 30px;">
    <p style="text-align: center;"> 
      <h3><strong><center>SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMÁTICOS – DISAJ CALI</center></strong>
      </h3> 
    </p>
    <br>
      
    <h3 style="text-align: center;">
      <strong style="color:red;">
        @yield('cabecera')
      </strong>
    </h3>
      
    @yield('content')
    
    <p><span class="izquierda"><b><strong>Copyright &copy; 2018-2023<a href="#"> SIRIS</a>.</strong> All rights reserved.</b></span><span class="derecha"><b>Consejo Superior de la Judicatura - Cali</b></span></p> 

  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</body>
</html>
