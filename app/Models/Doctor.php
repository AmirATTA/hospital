<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Doctor extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'name',
        'national_code',
        'medical_number',
        'mobile',
        'speciality_id',
        'email',
        'status',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly($this->fillable)
        ->setDescriptionForEvent(fn(string $eventName) => 'دکتر' . ' ' . __('custom.'. $eventName));
    }

     
    public function surgeries()
    {
        return $this->belongsToMany(Surgery::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


    public function attachRoles(?array $roleNames, $onUpdate = false)
    {
        if($roleNames != null) {
            $roleIds = [];
    
            foreach ($roleNames as $roleName) {
                $role = DoctorRole::firstOrCreate(['title' => $roleName]);
    
                $roleIds[] = $role->id;

                if($onUpdate == true) {
                    $this->doctorRoles()->sync($roleIds);
                } else {
                    $this->doctorRoles()->attach($role->id);
                }
            }
        }
    }

    public function doctorRoles()
    {
        return $this->belongsToMany(DoctorRole::class);
    }

    public function doctor_surgeries()
    {
        return $this->belongsToMany(Surgery::class)
            ->withPivot('invoice_id');
    }
}
