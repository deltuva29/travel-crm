<?php

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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('bus_id');
            $table->enum('type', RentType::values());
            $table->decimal('price_full', 8, 2);
            $table->decimal('price_per_day', 8, 2);
            $table->string('note')->nullable();
            $table->enum('price_type', PriceType::values());
            $table->date('start_date_at');
            $table->date('end_date_at');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
