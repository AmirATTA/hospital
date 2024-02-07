<?php

use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

function convertToJalaliDate($createdAtDate, $type)
{
    if (!$createdAtDate instanceof Carbon) {
        $createdAtDate = Carbon::parse($createdAtDate);
    }

    $date = $createdAtDate->toDateString();

    if($type === true) {
        $gregorianCreatedAtDate = \DateTime::createFromFormat('Y-m-d', $date);
    } else {
        $gregorianCreatedAtDate = \DateTime::createFromFormat('m/d/Y', $date);
    }

    $jalaliCreatedAtDate = Jalalian::fromDateTime($gregorianCreatedAtDate);
    return $jalaliCreatedAtDate->format('Y/m/d');
}