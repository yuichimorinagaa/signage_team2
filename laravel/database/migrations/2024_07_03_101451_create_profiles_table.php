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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('grade');
            $table->string('university');
            $table->string('profile_photo_path')->nullable()->default('profile_photo/default.png');
            $table->date('joining_date');
            $table->string('comment');
            $table->string('hobbies');
            $table->string('mbti');
            $table->string('high_school');
            $table->string('hometown');
            $table->date('birthday');
            $table->string('motto');
            $table->string('restaurants');
            $table->string('club_activities');
            $table->string('famous_person');
            $table->string('artists');
            $table->string('if_ceo');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
