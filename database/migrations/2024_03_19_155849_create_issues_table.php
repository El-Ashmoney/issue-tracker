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
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('issue_id');
            $table->text('issue_description');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('assignee_id');
            $table->enum('scale', ['Low', 'Medium', 'High']);
            $table->unsignedBigInteger('company_id');
            $table->string('time_duration')->nullable();
            $table->date('issue_date');
            $table->enum('status', ['On Process', 'Finished']);
            $table->enum('azure_status', ['Pending', 'Resolved', 'Closed', 'Not Listed']);

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->foreign('owner_id')->references('owner_id')->on('issue_owners');
            $table->foreign('assignee_id')->references('assignee_id')->on('issue_assignees');
            $table->foreign('company_id')->references('company_id')->on('companies');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};