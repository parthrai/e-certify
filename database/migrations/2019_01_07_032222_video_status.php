<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideoStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('video_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->boolean('vid1')->default(false);
            $table->boolean('vid2')->default(false);
            $table->boolean('vid3')->default(false);
            $table->boolean('vid4')->default(false);
            $table->boolean('vid5')->default(false);
            $table->boolean('vid6')->default(false);
            $table->boolean('vid7')->default(false);
            $table->boolean('vid8')->default(false);
            $table->boolean('vid9')->default(false);
            $table->boolean('vid10')->default(false);
            $table->boolean('vid11')->default(false);
            $table->boolean('vid12')->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('video_statuses');
    }
}
