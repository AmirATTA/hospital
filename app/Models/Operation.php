<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'price',
        'status',
    ];
        
    public function surgeries()
    {
        return $this->belongsToMany(Surgery::class);
    }
}
