<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateGreaterThanOrEqual implements Rule
{
    public function passes($attribute, $value)
    {
        $inputDate = strtotime($value);
        $currentDate = strtotime(date('Y-m-d'));

        return $inputDate >= $currentDate;
    }

    public function message()
    {
        return ':attribute باید از تاریخ حال جلو تر باشد';
    }
}