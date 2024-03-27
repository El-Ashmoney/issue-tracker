<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            DB::statement("ALTER TABLE issues MODIFY COLUMN status ENUM('Pending','On Process', 'Finished')");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            DB::statement("ALTER TABLE issues MODIFY COLUMN status ENUM('On Process', 'Finished')");
        });
    }
};