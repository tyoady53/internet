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
        Schema::create('customer_billings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('billing_date');
            $table->date('tempo');
            $table->date('pay_date')->nullable();
            $table->integer('usage');
            $table->string('fines')->nullable();
            $table->string('administration_fees');
            $table->string('price_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_billings');
    }
};
