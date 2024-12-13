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
        Schema::create('ticket_validation', function (Blueprint $table) {
            $table->id('id_ticketvalidation');
            $table->foreignId('id_order')->constrained('order');
            $table->foreignId('id_ticket')->constrained('ticket');
            $table->timestamps('validation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_validation');
    }
};
