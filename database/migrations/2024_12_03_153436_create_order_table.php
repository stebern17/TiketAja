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
        Schema::create('order', function (Blueprint $table) {
            $table->id('id_order')->autoIncrement();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_event');
            $table->foreign('id_event')->references('id_event')->on('events')->onDelete('cascade');
            $table->integer('ticket_code');
            $table->enum('payment_method', ['bank_transfer', 'gopay', 'qris']);
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->integer('total_price');
            $table->string('transaction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
        
    }
};
