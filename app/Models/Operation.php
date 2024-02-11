<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Operation extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'name',
        'price',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly($this->fillable);
    }
        
    public function surgeries()
    {
        return $this->belongsToMany(Surgery::class);
    }
}
