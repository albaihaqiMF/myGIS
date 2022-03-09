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
            $table->id();
            $table->char('master_id', 10)->unique();
            $table->foreign('master_id')->references('id')->on('master_groups')->cascadeOnDelete();
            $table->longText('detail')->nullable();

            $table->decimal('sw_latitude', 24, 21)->nullable();
            $table->decimal('sw_longitude', 24, 21)->nullable();
            $table->decimal('ne_latitude', 24, 21)->nullable();
            $table->decimal('ne_longitude', 24, 21)->nullable();
            $table->string('gambar_taksasi')->nullable();
            $table->string('gambar_ndvi')->nullable();

            $table->json('geometry');

            //Attributes
            $table->date('age');
            $table->string('variaty');
            $table->enum('crop', [
                'first', 'second', 'third',
            ]);
            $table->tinyInteger('forcing_time');

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
