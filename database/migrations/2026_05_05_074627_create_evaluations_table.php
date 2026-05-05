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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employees')
                  ->cascadeOnDelete();

            $table->foreignId('criteria_id')
                  ->constrained('criterias')
                  ->cascadeOnDelete();

            $table->foreign('period_id')
                  ->constrained('periods')
                  ->cascadeOnDelete();
            $table->decimal('score', 5, 2);
            $table->timestamps();

            //optional tidak doubel input
            $table->unique(['employee_id', 'criteria_id', 'period_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
