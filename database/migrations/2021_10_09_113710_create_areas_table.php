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
            $table->id();
            $table->foreignId('plantation_group_id')->constrained('plantation_groups');
            $table->char('master_id', 10)->unique();
            $table->foreign('master_id')->references('id')->on('master_groups')->cascadeOnDelete();
            $table->longText('detail')->nullable();

            $table->json('geometry');

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
