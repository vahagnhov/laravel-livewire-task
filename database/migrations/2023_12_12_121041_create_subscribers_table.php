<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('country', 255);
            $table->date('date_of_birth');
            $table->boolean('married')->default(0);
            $table->date('date_of_marriage')->nullable();
            $table->string('marriage_country')->nullable();
            $table->boolean('widowed')->nullable();
            $table->boolean('previously_married')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
