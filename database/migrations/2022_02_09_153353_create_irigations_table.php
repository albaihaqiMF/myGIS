<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irigations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('created_by', 10);
            $table->char('plantation_group_id', 10);
            $table->foreign('created_by')->references('id')->on('users');
            $table->json('geometry');
            $table->enum('state', [
                'empty', 'quarter', 'half', 'full'
            ])->nullable();
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
        Schema::dropIfExists('irigations');
    }
}
