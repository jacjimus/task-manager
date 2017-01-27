<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->enum('schedule_type' , ['static' , 'dynamic', 'task_comments']);
            $table->text('static_repeat_days')->nullable();
            $table->enum('dynamic_repeat' ,['once', 'daily', 'weekly', 'monthly'])->nullable();
            $table->enum('status', ['active' , 'inactive']);
            $table->timestamp('runtime');
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
        Schema::table('notification_schedules', function (Blueprint $table) {
            //
        });
    }
}
