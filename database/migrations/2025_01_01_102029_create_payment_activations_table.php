<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('payment_activations')) {
            Schema::create('payment_activations', function (Blueprint $table) {
                $table->id();
                $table->integer('class_id')->nullable();
                $table->integer('session_id');
                $table->integer('term_id');
                $table->integer('payment_type_id')->nullable();
                $table->integer('status')->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_activations');
    }
};
