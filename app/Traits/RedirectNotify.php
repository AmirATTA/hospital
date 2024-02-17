<?php

namespace App\Traits;

trait RedirectNotify
{
    public function redirectNotify($route, $type, $message, $parameter = null)
    {
        if ($parameter) {
            return redirect()->route($route, $parameter)->with('toastr', true)->with('toastType', $type)->with('toastMessage', $message);
        } else {
            return redirect()->route($route)->with('toastr', true)->with('toastType', $type)->with('toastMessage', $message);
        }
    }
}