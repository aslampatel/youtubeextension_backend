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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('youtube_link')->nullable();
            $table->string('poster')->nullable();
            $table->string('channel_info')->nullable();
            $table->string('watch_method')->nullable();
            $table->enum('video',['yes','no'])->default('yes');
            $table->enum('subscribe_channel',['yes','no'])->default('yes');
            $table->enum('video_comment',['yes','no'])->default('yes');
            $table->enum('video_like',['yes','no'])->default('yes');
            $table->enum('like_comment',['yes','no'])->default('no');
            $table->enum('traffic_soure',['affiliate','search','direct'])->default('search');
            $table->integer('min_time')->default(30);
            $table->integer('max_time')->default(120);
            $table->integer('add_skip')->default(20);
            $table->enum('limit_budget',['yes','no'])->default('no');
            $table->float('budget')->default(0);
            $table->float('used_coin')->default(1);
            $table->timestamps();
            
        });

        Schema::table('campaigns', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
