<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('user_id')->nullable();
            $table->string('fuel_per_100_km')->nullable();
            $table->string('seats')->default(0);
            $table->string('seats_max')->default(0);
            $table->string('fuel_in_litres')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('type')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('repair')->default(false);
            $table->boolean('crash')->default(false);
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
        Schema::dropIfExists('buses');
    }
};
