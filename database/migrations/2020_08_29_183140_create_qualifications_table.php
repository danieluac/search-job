<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId("seeker_id")->constrained("seekers")->onDelete("cascade");
            $table->foreignId('degree_id')->constrained('degrees')->onDelete("cascade");
            $table->string("course");
            $table->string("place_degree");
            $table->year("issue_year");
            $table->year("end_year")->nullable();
            $table->enum("status",['attending','attended']);
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
        Schema::dropIfExists('qualifications');
    }
}
