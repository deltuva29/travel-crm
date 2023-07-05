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
        Schema::create('trip_trip_participants', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('trip_trip_participant_id')->nullable();
            $table->longText('note')->nullable();
            $table->boolean('need_call')->default(false);
            $table->boolean('paid')->default(false);
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('trips')
                ->onDelete('cascade');
            $table->foreign('trip_trip_participant_id')->references('id')->on('customers')
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
        Schema::dropIfExists('trip_participants');
    }
};
