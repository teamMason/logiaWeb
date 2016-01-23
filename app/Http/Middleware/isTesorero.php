<?php

namespace portalLogia\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;



class isTesorero
{
    
    private $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
       #$this->auth->user()->type != 'admin'
       if(! $this->auth->user()->isTesorero() and ! $this->auth->user()->isAdmin())
       {

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->to(route('login'));
            }
       }
       

        return $next($request);
    }
}
