<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string("job_title");
            $table->string("job_location")->nullable();
            $table->text("job_description")->nullable();
            $table->date("end_date")->nullable();
            $table->integer("job_number")->nullable();
            $table->integer("state")->nullable();
            $table->foreignId("activity_id")->constrained("activities")->onDelete("cascade");
            $table->foreignId("degree_id")->constrained("degrees")->onDelete("cascade");
            $table->foreignId("company_id")->constrained("companies")->onDelete("cascade");
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
        Schema::dropIfExists('jobs');
    }
}
