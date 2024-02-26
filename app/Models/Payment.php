<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use HasFactory, LogsActivity;
        
    protected $fillable = [
        'invoice_id',
        'amount',
        'pay_type',
        'due_date',
        'receipt',
        'description',
        'status',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => 'پرداختی' . ' ' . __('custom.'. $eventName));
    }
}
