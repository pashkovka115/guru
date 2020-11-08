<?php

namespace App\Http\Middleware;

use Closure;

class CabinetPermission
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()){
            $user = auth()->user();

            if (is_null($user->profile) or $user->profile->auth == '0'){
                return redirect()->route('site.cabinet.user.index')->withErrors('Вы не авторизованы для этого действия');
            }
        }

        return $next($request);
    }
}
