<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantationGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantation_groups', function (Blueprint $table) {
            $table->id();
            $table->char('master_id', 10)->unique();
            $table->foreign('master_id')->references('id')->on('master_groups')->cascadeOnDelete();
            $table->longText('detail')->nullable();

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
        Schema::dropIfExists('plantation_groups');
    }
}
