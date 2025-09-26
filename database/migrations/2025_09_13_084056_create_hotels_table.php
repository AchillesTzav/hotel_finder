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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('lite_id')->unique()->index(); // not FK, just external API ID
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip', 20)->nullable();
            $table->unsignedTinyInteger('stars')->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->unsignedInteger('reviewCount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
