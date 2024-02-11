<?php

namespace App\Models;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Surgery extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'patient_name',
        'patient_national_code',
        'basic_insurance_id',
        'supp_insurance_id',
        'document_number',
        'description',
        'surgeried_at',
        'released_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly($this->fillable);
    }

    // creating record in operation_surgery table
    public function attachOperations(?array $operationNames, $onUpdate = false)
    {
        if($operationNames != null) {
            $operationIds = [];
    
            foreach ($operationNames as $operationName) {
                $operation = Operation::firstOrCreate(['name' => $operationName]);
    
                $operationIds[] = $operation->id;
                
                if($onUpdate == true) {
                    $this->operations()->sync($operationIds);
                } else {
                    $this->operations()->attach($operation->id);
                }
            }
        }
    }

    public function operations()
    {
        return $this->belongsToMany(Operation::class);
    }


    // creating record in doctor_surgery table
    public function attachDoctors(?array $ids, $onUpdate = false)
    {
        if($ids != null) {
            $doctorIds = [];
            $doctorRoleIds = [];
            foreach ($ids as $value) {
                if($value != null) {
                    [$firstNumber, $secondNumber] = explode(", ", $value);
                    $doctorIds[] = $firstNumber;
                    $doctorRoleIds[] = $secondNumber;
                }
            }
            
            $doctorsWithRoles = [];

            foreach ($doctorIds as $index => $doctorId) {
                $doctorsWithRoles[$doctorId][] = $doctorRoleIds[$index];
            }
            
            foreach ($doctorsWithRoles as $doctorId => $doctorRoleIds) {
                if($onUpdate == true) {
                    foreach ($doctorRoleIds as $doctorRoleId) {
                        $this->doctors()->sync($doctorId, ['doctor_role_id' => $doctorRoleId]);
                    }
                } else {
                    foreach ($doctorRoleIds as $doctorRoleId) {
                        $this->doctors()->attach($doctorId, ['doctor_role_id' => $doctorRoleId]);
                    }
                }
            }

        }
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
