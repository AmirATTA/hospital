<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSurgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_id',
        'surgery_id',
    ];

    protected $table = 'operation_surgery';

}