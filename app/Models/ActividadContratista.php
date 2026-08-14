<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadContratista extends Model
{
    use HasFactory;
    
    protected $table = "actividades_contratista";

    protected $fillable = [
        'activity_date',
        'description',
        'plataforma',
        'user_id'
    ];

    protected $dates = ['activity_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}