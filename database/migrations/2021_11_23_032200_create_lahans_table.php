<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lahans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 127);
            $table->string('slug');
            $table->tinyInteger('created_by')->nullable();
            $table->decimal('sw_latitude', 24, 21);
            $table->decimal('sw_longitude', 24, 21);
            $table->decimal('ne_latitude', 24, 21);
            $table->decimal('ne_longitude', 24, 21);
            $table->string('gambar_taksasi');
            $table->string('gambar_ndvi');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('lahans');
    }
}
