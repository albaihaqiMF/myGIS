<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plots', function (Blueprint $table) {
            $table->char('id', 8)->primary();
            $table->string('name', 128);
            $table->char('chief', 10);
            $table->foreign('chief')->references('id')->on('users');

            $table->char('pg_id', 8);
            $table->foreign('pg_id')->references('id')->on('plantation_groups');
            $table->char('area_id', 8);
            $table->foreign('area_id')->references('id')->on('areas');
            $table->char('location_id', 8);
            $table->foreign('location_id')->references('id')->on('locations');
            $table->char('section_id', 8);
            $table->foreign('section_id')->references('id')->on('sections');
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
        Schema::dropIfExists('plots');
    }
}
