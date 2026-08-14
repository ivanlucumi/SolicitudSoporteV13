<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_code'];

    public function clicks()
    {
        return $this->hasMany(UrlClick::class);
    }

    public function incrementClickCount()
    {
        $this->increment('click_count');
    }
    
   /* public function lastClick()
{
    // alguna definición aquí
}*/
}