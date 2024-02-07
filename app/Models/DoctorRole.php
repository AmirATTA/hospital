<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'required',
        'status',
    ];
    
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
