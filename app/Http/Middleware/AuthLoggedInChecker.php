<?php

namespace App\Http\Middleware;

use \Closure;
use Illuminate\Http\Request;

/**
 * Class AuthLoggedInChecker
 * 
 * @author Keannu Rim Kristoffer C. Regala <keannu>
 * @since 2022.05.01
 */
class AuthLoggedInChecker
{
    /**
     * handle
     * @param Request $oRequest
     * @param Closure $oClosure
     * @return mixed
     */
    public function handle(Request $oRequest, Closure $oClosure)
    {
        if (empty(session()->get('username')) === false) {
            return redirect('dashboard');
        }

        return $oClosure($oRequest);
    }
}
