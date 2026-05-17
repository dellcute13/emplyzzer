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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('nip', 30)->unique();
            $table->string('name', 100);
            $table->enum('gender', ['P','L']);
            $table->string('photo')->nullable();

            $table->foreignId('position_id')
                  ->constrained('positions')
                  ->cascadeOnDelete();

            $table->foreignId('department_id')
                  ->constrained('departments')
                  ->cascadeOnDelete();

            $table->date('join_date')->nullable();
            $table->enum('status', ['permanent', 'contract']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
