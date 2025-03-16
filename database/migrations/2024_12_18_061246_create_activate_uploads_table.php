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

        if (!Schema::hasTable('activate_uploads')) {
            Schema::create('activate_uploads', function (Blueprint $table) {
                $table->id();
                $table->integer('class_id');
                $table->integer('session_id');
                $table->integer('term_id');
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
        Schema::dropIfExists('activate_uploads');
    }
};
