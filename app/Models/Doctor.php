<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'national_code',
        'medical_number',
        'mobile',
        'speciality_id',
        'status',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];

    
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
}
