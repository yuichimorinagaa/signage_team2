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
            $table->string('name')->default('-')->change();
            $table->string('hobbies')->default('-')->change();
            $table->string('high_school')->default('-')->change();
            $table->string('hometown')->default('-')->change();
            $table->string('motto')->default('-')->change();
            $table->string('restaurants')->default('-')->change();
            $table->string('club_activities')->default('-')->change();
            $table->string('famous_person')->default('-')->change();
            $table->string('artists')->default('-')->change();
            $table->string('if_ceo')->default('-')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('name')->default('null')->change();
            $table->string('hobbies')->default('null')->change();
            $table->string('high_school')->default('null')->change();
            $table->string('hometown')->default('null')->change();
            $table->string('motto')->default('null')->change();
            $table->string('restaurants')->default('null')->change();
            $table->string('club_activities')->default('null')->change();
            $table->string('famous_person')->default('null')->change();
            $table->string('artists')->default('null')->change();
            $table->string('if_ceo')->default('null')->change();
        });
    }
};
