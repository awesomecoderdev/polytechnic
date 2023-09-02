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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer("teacher_id")->default(0);
            $table->integer("shift_id")->default(0);
            $table->integer("collage_id")->default(0);
            $table->integer("technology_id")->default(0);
            $table->enum("semester", ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"])->default("1st");
            $table->text("text")->nullable();
            $table->text("metadata")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
