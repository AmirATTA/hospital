<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DoctorRole extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'required',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly($this->fillable);
    }
    
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
