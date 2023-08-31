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
        Schema::create("students", function (Blueprint $table) {
            $table->id();
            $table->integer("technology_id")->default(0);
            $table->integer("collage_id")->default(0);
            $table->string("first_name");
            $table->string("last_name")->nullable();
            $table->string("email")->unique();
            $table->string("password");
            $table->string("phone", 15)->unique();
            $table->string("image")->nullable();
            $table->enum("gender", ["male", "female"])->default("male");
            $table->enum("semester", ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"])->default("1st");
            $table->string("roll")->nullable();
            $table->string("reg")->nullable();
            $table->string("shift")->nullable();
            $table->string("session")->nullable();
            $table->string("technology")->nullable();
            $table->text("metadata")->nullable();
            $table->timestamp("dob")->nullable();
            $table->timestamp("email_verified_at")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("students");
    }
};
