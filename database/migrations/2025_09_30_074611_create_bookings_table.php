<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('play_station_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('delivery_address');
            $table->string('delivery_city');
            $table->string('delivery_postal_code');
            $table->datetime('start_datetime');
            $table->datetime('end_datetime');
            $table->enum('rental_type', ['hourly', 'daily']);
            $table->integer('duration'); // hours or days
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'delivered', 'returned', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
