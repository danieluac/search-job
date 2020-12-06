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
            $table->string("job_position");
            $table->text("job_description");
            $table->date("start_date");
            $table->date("end_date");
            $table->integer("job_number");
            $table->date("active_area");
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
