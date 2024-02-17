<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DoctorSurgery extends Model
{
    use HasFactory, LogsActivity;
        
    protected $fillable = [
        'doctor_id',
        'doctor_role_id',
        'surgery_id',
        'invoice_id',
        'status',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => 'پرداخت پزشک' . ' ' . __('custom.'. $eventName));
    }
}
