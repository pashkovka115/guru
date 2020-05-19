<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function show()
    {
        $settings = get_settings('help');
        return view('pages.help.show', ['settings' => $settings]);
    }
}
