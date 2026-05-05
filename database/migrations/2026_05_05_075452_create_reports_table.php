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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('period_id')
                  ->constrained('periods')
                  ->cascadeOnDelete();
            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();

            $table->string('file_name');
            $table->enum('file_type', ['pdf', 'excel']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
