<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleQrCodeController extends Controller
{
   public function showForm()
    {
        return view('Qr.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:500',
        ]);

        $text = urlencode($request->text);

        $qrUrl = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$text}";

        return view('Qr.result', compact('qrUrl'));
    }
}
