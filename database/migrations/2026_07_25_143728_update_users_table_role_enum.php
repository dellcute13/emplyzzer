<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update any existing 'Staff' roles to 'User'
        DB::table('users')->where('role', 'Staff')->update(['role' => 'User']);

        // Alter enum column in MySQL
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Administrator', 'Manager', 'User') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Update any existing 'User' roles to 'Staff'
        DB::table('users')->where('role', 'User')->update(['role' => 'Staff']);

        // Alter enum column back to original
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('Administrator', 'Manager', 'Staff') NOT NULL");
    }
};
