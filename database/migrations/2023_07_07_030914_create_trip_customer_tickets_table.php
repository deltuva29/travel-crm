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
        Schema::create('trip_customer_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_customer_id')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('code')->unique()->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('trip_customer_id')->references('id')->on('trip_customers')
                ->onDelete('cascade');
            $table->foreign('trip_id')->references('id')->on('trips')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('trip_customer_tickets');
    }
};
