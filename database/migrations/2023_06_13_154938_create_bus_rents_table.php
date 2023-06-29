<?php

use App\Enums\LocationOfRentType;
use App\Enums\PriceType;
use App\Enums\RentType;
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
        Schema::create('bus_rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->enum('type', RentType::values())->nullable();
            $table->enum('location', LocationOfRentType::values())->nullable();
            $table->decimal('price_full', 8, 2)->nullable();
            $table->decimal('price_per_day', 8, 2)->nullable();
            $table->string('note')->nullable();
            $table->enum('price_type', PriceType::values())->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')
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
        Schema::dropIfExists('bus_rents');
    }
};
