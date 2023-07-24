<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsMaster
{
    const ROLE_MASTER = 3;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

        $isMaster = $user->roles->contains(self::ROLE_MASTER);

        if(!$isMaster){
            return response()->json([
                'succes' => false,
                'message' => 'No existe en esta ruta'
            ],404);
        }
        return $next($request);
    }
}
