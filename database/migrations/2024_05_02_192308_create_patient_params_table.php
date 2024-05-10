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
        Schema::create('patient_params', function (Blueprint $table) {
            $table->id();
            $table->integer('duration')->nullable();
            $table->integer('sectors')->nullable();
            $table->integer('size')->nullable();
            $table->integer('dot_size')->nullable();
            $table->unsignedBigInteger("patient_id")->nullable();
            $table->foreign('patient_id')->references('id')
                ->on('patients')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_params');
    }
};
