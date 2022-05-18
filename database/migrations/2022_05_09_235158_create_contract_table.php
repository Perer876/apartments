<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Apartment;
use App\Models\Tenant;
use App\Models\User;

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
            $table->foreignidFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignidFor(Apartment::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Tenant::class)->constrained()->onDelete('cascade');
            $table->date('start_at');
            $table->unsignedInteger('amount');
            $table->string('period', 15);
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
