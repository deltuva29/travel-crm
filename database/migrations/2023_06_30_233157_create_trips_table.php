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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedBigInteger('route_id')->nullable();
            $table->unsignedInteger('distance')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price', 9, 2)->default(0.00);
            $table->date('arrived_at')->nullable();
            $table->time('arrived_back_at', $precision = 0)->nullable();
            $table->date('departure_at')->nullable();
            $table->time('departure_back_at', $precision = 0)->nullable();
            $table->timestamps();

            $table->foreign('bus_id')->references('id')->on('buses')
                ->onDelete('cascade');

            $table->foreign('route_id')->references('id')->on('routes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
