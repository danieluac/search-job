<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpiriencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiriences', function (Blueprint $table) {
            $table->id();
            $table->foreignId("seeker_id")->constrained("seekers")->onDelete("cascade");
            $table->string("position")->nullable();
            $table->string("company_name")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->enum("status",['attending','attended'])->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('expiriences');
    }
}
