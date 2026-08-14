<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlClick extends Model
{
    use HasFactory;

    protected $fillable = ['shortened_url_id', 'ip_address', 'user_agent', 'referer'];

    public function shortenedUrl()
    {
        return $this->belongsTo(ShortenedUrl::class);
    }
}