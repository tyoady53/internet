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
        Schema::table('customer_billings', function (Blueprint $table) {
            $table->string('water_meter_count');
            $table->string('billing_number');
            // $table->string('billing_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_billings', function (Blueprint $table) {
            //
        });
    }
};
