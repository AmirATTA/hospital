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
        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // Create permissions for specialities
        $permissions = [
            'view specialities' => 'نمایش تخصص',
            'create specialities' => 'ایجاد تخصص',
            'edit specialities' => 'ویرایش تخصص',
            'delete specialities' => 'حذف تخصص',
        ];

        $permissionNames = $this->createPermissions($permissions);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialities');
    }
};
