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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices');

            $table->bigInteger('amount');
            $table->enum('pay_type', ['cash', 'cheque']);

            $table->datetime('due_date')->nullable();
            $table->string('receipt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);

            $table->timestamp('notified_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
