<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('category_id');
            $table->integer('created_by');
            $table->integer('assignee');
            $table->dateTime('created_on');
            $table->dateTime('due_date');
            $table->text('notif_depts', 100);
            $table->text('notif_users', 100);
            $table->boolean('notif_users_status');
            $table->boolean('notif_dept_status');
            $table->enum('access_level' , ['Public' , 'Private']);
            $table->enum('priority', ['Low', 'Medium' , 'High']);
            $table->enum('status', ['New', 'On-going' , 'Complete' , 'Due']);
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
    }
}
