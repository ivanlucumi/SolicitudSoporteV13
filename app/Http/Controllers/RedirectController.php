<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use App\Models\UrlClick;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($code)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $code)->firstOrFail();

        // Registrar el click
        $shortenedUrl->incrementClickCount();
        
        UrlClick::create([
            'shortened_url_id' => $shortenedUrl->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referer' => request()->headers->get('referer')
        ]);

        //dd($shortenedUrl->original_url);
        return redirect($shortenedUrl->original_url);
        
        
    }
}