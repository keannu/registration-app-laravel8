<?php

namespace App\Http\Middleware;

use \Closure;
use Illuminate\Http\Request;

/**
 * Class CheckIsAdmin
 * @author Keannu Rim Kristoffer C. Regala <keannu>
 * @since 2022.05.01
 */
class CheckIsAdmin
{
    /**
     * handle
     * @param Request $oRequest
     * @param Closure $oClosure
     * @return mixed
     */
    public function handle(Request $oRequest, Closure $oClosure)
    {
        $sIsAdmin = session()->get('is_admin');
        if (empty($sIsAdmin) === true || $sIsAdmin !== 'T') {
            return redirect()->route('dashboard.main');
        }

        return $oClosure($oRequest);
    }
}
