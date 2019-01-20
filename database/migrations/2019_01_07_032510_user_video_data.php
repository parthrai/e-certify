<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserVideoData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('video_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->double('vid1')->default(0);
            $table->double('vid2')->default(0);
            $table->double('vid3')->default(0);
            $table->double('vid4')->default(0);
            $table->double('vid5')->default(0);
            $table->double('vid6')->default(0);
            $table->double('vid7')->default(0);
            $table->double('vid8')->default(0);
            $table->double('vid9')->default(0);
            $table->double('vid10')->default(0);
            $table->double('vid11')->default(0);
            $table->double('vid12')->default(0);


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

        Schema::dropIfExists('video_datas');
    }
}
