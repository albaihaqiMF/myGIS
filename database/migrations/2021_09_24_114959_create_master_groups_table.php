<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_groups', function (Blueprint $table) {
            $table->char('id', 16)->primary();
            $table->string('name', 32);
            $table->char('chief', 10);
            $table->foreign('chief')->references('id')->on('users');

            //ID
            $table->string('code');

            $table->integer('pg');
            $table->integer('area');
            $table->integer('location');
            $table->integer('section');
            $table->integer('plot');
            $table->enum('type', [
                'PG', 'AREA', 'LOC', 'SECT', 'PLOT'
            ]);
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
        Schema::dropIfExists('master_groups');
    }
}
