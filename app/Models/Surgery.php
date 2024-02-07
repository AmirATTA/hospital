<?php

namespace App\Models;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surgery extends Model
{
    use HasFactory;
    
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
}
