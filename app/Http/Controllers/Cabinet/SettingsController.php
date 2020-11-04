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
        $user = User::with('profile')->where('id', auth()->id())->firstOrFail();

        if ($user->profile) {
            $user->profile->request = '1';
            $user->profile->save();
        }

        return redirect()->back();
    }
}
