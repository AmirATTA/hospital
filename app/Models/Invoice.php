<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use HasFactory, LogsActivity;
        
    protected $fillable = [
        'amount',
        'description',
        'doctor_id',
        'status',
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => 'صورت حساب ها' . ' ' . __('custom.'. $eventName));
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
    
    public function paymentSum()
    {
        return $totalPaymentsAmount = $this->payments()->sum('amount');
    }

    public function doctors()
    {
        return $this->belongsTo(Invoice::class);
    }

}
