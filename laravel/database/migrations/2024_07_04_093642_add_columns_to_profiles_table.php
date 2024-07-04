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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('grade')->nullable()->default('-')->change();
            $table->string('university')->nullable()->default('-')->change();
            $table->string('hobbies');
            $table->string('mbti')->nullable()->default('-');
            $table->string('high_school');
            $table->string('hometown');
            $table->date('birthday')->default('2000-01-01');
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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('grade')->nullable()->default(null)->change();
            $table->string('university')->nullable()->default(null)->change();
            $table->dropColumn('hobbies');
            $table->dropColumn('mbti');
            $table->dropColumn('high_school');
            $table->dropColumn('hometown');
            $table->dropColumn('birthday');
            $table->dropColumn('motto');
            $table->dropColumn('restaurants');
            $table->dropColumn('club_activities');
            $table->dropColumn('famous_person');
            $table->dropColumn('artists');
            $table->dropColumn('if_ceo');
        });
    }
};
