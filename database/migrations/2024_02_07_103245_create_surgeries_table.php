<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_national_code');

            $table->unsignedBigInteger('basic_insurance_id')->nullable();
            $table->foreign('basic_insurance_id')->references('id')->on('insurances');

            $table->unsignedBigInteger('supp_insurance_id')->nullable();
            $table->foreign('supp_insurance_id')->references('id')->on('insurances');
            
            $table->string('document_number')->unique();
            $table->string('description')->nullable();
            $table->datetime('surgeried_at');
            $table->datetime('released_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surguries');
    }
};
