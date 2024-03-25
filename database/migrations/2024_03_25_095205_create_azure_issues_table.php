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
        Schema::create('azure_issues', function (Blueprint $table) {
            $table->unsignedBigInteger('work_item_id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('project');
            $table->string('issue_assignee');
            $table->string('status');
            $table->string('priority');
            $table->string('discipline');
            $table->string('teams');
            $table->string('source');
            $table->string('worked_time');
            $table->string('description_of_close');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('azure_issues');
    }
};