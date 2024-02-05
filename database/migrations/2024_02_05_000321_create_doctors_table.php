<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_code', 20)->nullable();
            $table->string('medical_number')->nullable();
            $table->string('mobile', 20)->unique();
            $table->string('password');
            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('speciality_id');
            $table->foreign('speciality_id')->references('id')->on('specialities');
            
            $table->rememberToken();
            $table->timestamps();
        });
        
        // Create permissions for doctors
        $permissions = [
            'view doctors' => 'نمایش دکتر ها',
            'create doctors' => 'ایجاد دکتر ها',
            'edit doctors' => 'ویرایش دکتر ها',
            'delete doctors' => 'حذف دکتر ها',
        ];

        $permissionNames = $this->createPermissions($permissions);
        $rolePermissions = $this->assignPermissions($permissions, 'Doctor');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
