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
            $table->integer('customer_id');
            $table->string('billing_date');
            $table->string('package_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('discount');
            $table->string('total');
            $table->date('pay_date')->nullable();
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
