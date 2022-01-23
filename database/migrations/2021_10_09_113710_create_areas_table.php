<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->char('id',8)->primary();
            $table->string('name', 128);
            $table->char('chief', 10);
            $table->foreign('chief')->references('id')->on('users');

            $table->char('pg_id', 8);
            $table->foreign('pg_id')->references('id')->on('plantation_groups');
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
        Schema::dropIfExists('areas');
    }
}
