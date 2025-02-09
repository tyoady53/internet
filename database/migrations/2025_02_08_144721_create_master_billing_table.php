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
        Schema::create('master_billings', function (Blueprint $table) {
            $table->id();
            $table->string('billing_name');
            $table->string('package',3);
            $table->string('unit');
            $table->integer('price');
            $table->enum('is_active',[0,1])->default(1);
            $table->string('encrypted_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_billings');
    }
};
