<?php

namespace App\Traits;

trait RedirectNotify
{
    public function redirectNotify($route, $type, $message)
    {
        return redirect(route($route))->with('toastr', true)->with('toastType', $type)->with('toastMessage', $message);
    }
}