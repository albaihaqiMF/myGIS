<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->char('id', 8)->primary();
            $table->string('name', 128);
            $table->char('created_by', 10);
            $table->foreign('created_by')->references('id')->on('users');
            $table->char('chief', 10)->nullable();
            $table->foreign('chief')->references('id')->on('users');

            $table->char('pg_id', 8);
            $table->foreign('pg_id')->references('id')->on('plantation_groups');
            $table->char('area_id', 8);
            $table->foreign('area_id')->references('id')->on('areas');
            $table->char('location_id', 8);
            $table->foreign('location_id')->references('id')->on('locations');

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
        Schema::dropIfExists('sections');
    }
}
