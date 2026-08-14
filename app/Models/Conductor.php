<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conductor extends Model
{
    //
     protected $table = "conductores";
    protected $fillable = 
   						 [
				    	'cedula',
				    	'nameE',
				    	'lastnameE'
   						 ];

}
