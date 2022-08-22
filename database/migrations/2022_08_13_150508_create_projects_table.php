<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('project_code')->nullable();
            $table->string('home_page')->nullable();
            $table->enum('status',['On Going','Finished'])->default('On Going');
            $table->enum('type',['General','Consultency'])->default('General');
            $table->string('attachment')->nullable();
            $table->string('client')->nullable();
            $table->string('project_cost')->nullable();
            $table->text('contact_person')->nullable();
            $table->date('start_date')->nullable();
            $table->date('awarded_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('funded_by', ['Government', 'Non Government'])->default('Government');
            $table->integer('time_revised')->nullable();
            $table->integer('cost_revised')->nullable();
            $table->text('description')->nullable();
            $table->text('objective')->nullable();
            $table->text('reference_terms')->nullable();
            $table->text('technical_document')->nullable();
            $table->text('solution_component')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
