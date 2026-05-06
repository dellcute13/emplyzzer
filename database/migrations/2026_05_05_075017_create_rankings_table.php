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
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                  ->constrained('employes')
                  ->cascadeOnDelete();

            $table->foreignId('period_id')
                  ->constrained('periods')
                  ->cascadeOnDelete();

            $table->decimal('preference_value', 10, 6);
            $table->integer('rank');
            $table->enum('status', ['excellent','good','poor']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};
