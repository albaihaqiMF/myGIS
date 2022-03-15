<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrigationsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irigations_sections', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Irigation::class, 'irigation_id');
            $table->foreignIdFor(\App\Models\Section::class, 'section_id');

            $table->primary('irigation_id', 'section_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irigations_sections');
    }
}
