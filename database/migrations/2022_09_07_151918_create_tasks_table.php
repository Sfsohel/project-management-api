<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('menu_name')->nullable();
            $table->text('attachment')->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('module_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('priority',['Low','Medium','High','Urgent'])->default('Low');
            $table->enum('tracker',['New','Feature','Bug','Start After Discussion','Support','Change Request','Optimization','Research & Development'])->default('New');
            $table->enum('status',['Not Done','Done','In Progress','Assigned','Solved','Deployed','Testing','Test Passed','Test Failed','Reopened'])->default('Not Done');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->double('est_hour')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('impact_description')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
