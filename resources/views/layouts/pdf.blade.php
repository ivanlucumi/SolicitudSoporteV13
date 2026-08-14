<!DOCTYPE html>
<htmlzzz>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')<?php $time = time(); echo date("d-m-Y", $time);?></title>
    <style type="text/css">
    	
      * {
    		margin:7px; padding:7px;
  		}

  		body{
    		font:14px Arial, serif;
  		}
      	
      table{
      	/*width: 70px;*/
      	margin: 0 auto;
      	border: 1px solid;
      	border-collapse: collapse;
        width: 100%;
      }

      td,th{
     		border:1px solid #ccc; padding:10px;
  		}

  		thead{
  		  width:100%;position:fixed;
  		  height:109px;
  		}

  		caption{
  			border:1px solid #ccc; padding:10px; font: 20px;
  		}

    </style>
     <style>
      *{ font-family: DejaVu Sans !important;}
    </style>
     <!-- GOOGLE FONTS-->
</head>
<body>    
   @yield('content')
</body>
</html>