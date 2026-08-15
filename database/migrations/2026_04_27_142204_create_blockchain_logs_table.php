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
        Schema::create('blockchain_logs', function (Blueprint $table) {
            $table->id();
             $table->foreignId('research_id')->constrained('researches')->cascadeOnDelete();
             $table->string('transaction_hash');
             $table->enum('type',['upload','vote','decision']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blockchain_logs');
    }
};
