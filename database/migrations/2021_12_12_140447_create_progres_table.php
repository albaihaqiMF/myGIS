<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres', function (Blueprint $table) {
            $table->id();
            $table->string('catatan')->nullable();
            $table->char('progres_by', 10);
            $table->char('lahan_id', 10);
            $table->foreign('progres_by')->references('id')->on('users');
            $table->foreign('lahan_id')->references('id')->on('lahans');
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
        Schema::dropIfExists('progres');
    }
}
