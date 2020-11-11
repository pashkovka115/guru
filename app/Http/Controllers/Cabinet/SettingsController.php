<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function request_auth()
    {
        $user = User::where('id', auth()->id())->firstOrFail();

        if ($user) {
            $user->request = '1';
            $user->save();
        }

        return redirect()->back();
    }
}
