<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedTinyInteger('floor');
            $table->unsignedTinyInteger('garages');
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedTinyInteger('bedrooms');
            $table->decimal('monthly_rent', 7, 2);
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('apartments');
    }
}
