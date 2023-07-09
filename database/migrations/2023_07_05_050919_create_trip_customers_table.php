<?php

use App\Enums\CustomerPaidType;
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
        Schema::create('trip_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('need_call')->default(false);
            $table->enum('paid_type', CustomerPaidType::values())->nullable()->default(CustomerPaidType::PAYMENT_WAITING);

            $table->foreign('trip_id')->references('id')->on('trips')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade');

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
        Schema::dropIfExists('trip_customers');
    }
};
