<?php

namespace portalLogia\Http\Middleware;

use Closure;

class Role
{
    protected $hierachy = [
        'administrador' => 7,
        'tesorero'    => 6,
        'secretario'      => 5,
        'venerable'     => 4,
        'maestro'       => 3,
        'companero'     => 2,
        'aprendiz'      => 1

    ];
    public function handle($request, Closure $next, $role)
    {
        $user = auth()->user();

        if($this->hierachy[$user->role] < $this->hierachy[$role])
        {
            abort(404);
        }
        return $next($request);
    }
}
