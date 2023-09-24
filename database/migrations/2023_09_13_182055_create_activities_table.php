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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('village_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->text('address_details')->nullable();
            $table->enum('status', ['waiting', 'on progress', 'finish'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
