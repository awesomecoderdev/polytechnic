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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->integer("technology_id")->default(0);
            $table->integer("collage_id")->default(0);
            $table->string('name')->nullable();
            $table->enum("semester", ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"])->default("1st");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
