<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Apartment;
use App\Models\Tenant;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->foreignidFor(Apartment::class)->constrained();
            $table->foreignIdFor(Tenant::class)->constrained();
            $table->date('start_at');
            $table->date('end_at');
            $table->decimal('monthly_rent', 7, 2);
            $table->date('cancelled_at')->nullable();
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
        Schema::dropIfExists('contract');
    }
}
