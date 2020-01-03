<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $current_user =  Auth::user();
            if($current_user->is_notify==1){
                $current_user->is_notify=0;
                $current_user->save();
            }
            $expireAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-'.Auth::user()->id,true,$expireAt);
//            Cache::has('user-is-online-'.$user_id); $this->id;
        }
        return $next($request);
    }
}
